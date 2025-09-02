<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function welcome()
    {
        $articles = Post::all();
        $categories = Category::all();
        return view('welcome', ['articles' => $articles, 'categories' => $categories]);
    }

    public function about()
    {
        return view('about');
    }
    
    // Método para exibir um único artigo e incrementar as visualizações
    public function show(string $id)
    {
        $article = Post::findOrFail($id);
        $article->increment('qt_views');
        return view('articles.show', compact('article'));
    }

    // Método para exibir todos os artigos
    public function index(Request $request)
    {
        $articles = Post::query();

        // Se a requisição tem um parâmetro de 'category'
        if ($request->has('category')) {
            $categoryDescription = $request->get('category');
            $category = Category::where('description', $categoryDescription)->first();

            if ($category) {
                $articles->where('id_category', $category->id);
            } else {
                $articles = collect([]); // Retorna uma coleção vazia se a categoria não for encontrada
            }
        }

        // Se a requisição tem um parâmetro de 'search'
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $articles->where('title', 'like', "%{$searchTerm}%")
                     ->orWhere('body', 'like', "%{$searchTerm}%");
        }

        $articles = $articles->get();

        // Se a rota for '/admin/articles', exibe a view do painel
        if (request()->route()->uri() === 'admin/articles') {
            return view('articles.admin-index', ['articles' => $articles]);
        }

        // Por padrão, exibe a view pública
        return view('articles.index', ['articles' => $articles]);
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', ['categories' => $categories]);
    }

    // Método para processar o formulário e salvar no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'image' => ['nullable', 'image'],
            'body' => ['required', 'string'],
            'author' => ['required', 'string'],
            'id_category' => ['required', 'exists:categories,id'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Primeiro, salvamos o arquivo e obtemos o caminho dele no S3
            $path = Storage::disk('s3')->putFile('posts', $request->file('image'), 'public');

            // Depois, usamos o método url() do Storage principal para gerar a URL completa
            $imagePath = Storage::url($path);
        }

        Post::create([
            'id_category' => $request->id_category,
            'title' => $request->title,
            'image' => $imagePath,
            'body' => $request->body,
            'author' => $request->author,
            'qt_views' => 0,
            'qt_emails' => 0,
        ]);

        $token = $request->input('token');
        return redirect('/admin/articles?token=' . $token);
    }

    public function edit(string $id)
    {
        $article = Post::findOrFail($id);
        $categories = Category::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:posts,title,' . $id],
            'image' => ['nullable', 'image'],
            'body' => ['required', 'string'],
            'author' => ['required', 'string'],
            'id_category' => ['required', 'exists:categories,id'],
        ]);

        $article = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            // Verifica se a imagem antiga existe antes de tentar deletar
            if ($article->image) {
                // A imagem antiga tem o caminho completo (URL), então precisamos extrair o caminho no S3
                $path = str_replace(Storage::url(''), '', $article->image);
                Storage::disk('s3')->delete($path);
            }
            $imagePath = Storage::disk('s3')->putFile('posts', $request->file('image'), 'public');
            $article->image = Storage::url($imagePath); // Salva a URL completa
        }

        $article->update($request->except('image'));
        
        $token = $request->input('token');
        return redirect('/articles/' . $article->id . '/edit?token=' . $token)->with('success', 'Artigo atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $article = Post::findOrFail($id);
        // Verifica se a imagem existe antes de tentar deletar
        if ($article->image) {
            $path = str_replace(Storage::url(''), '', $article->image);
            Storage::disk('s3')->delete($path);
        }
        $article->delete();
        return redirect('/articles');
    }

    // Novo método para incrementar a contagem de e-mails
    public function incrementEmail(string $id)
    {
        $article = Post::findOrFail($id);
        $article->increment('qt_emails');
        return response()->json(['success' => true]);
    }
}
