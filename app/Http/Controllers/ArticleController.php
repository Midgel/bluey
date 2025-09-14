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


        if (request()->route()->uri() === 'admin/articles/show/{id}') {
            return view('articles.admin-show', ['article' => $article]);
        } else {
            $article->increment('qt_views');
        }

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'image' => ['nullable', 'image'],
            'body' => ['required', 'string'],
            'author' => ['required', 'string'],
            'id_category' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $filename = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->store('homolog', ["disk" => "s3", 'visibility' => 'public']);
                if ($path === false) {
                    dd('Falha no upload para o S3');
                }
            }
        } else {
            dd('Nenhum arquivo chegou na request');
        }

        Post::create([
            'id_category' => $request->id_category,
            'title' => $request->title,
            'image' => $path,
            'body' => $request->body,
            'author' => $request->author,
            'qt_views' => 0,
            'qt_emails' => 0,
        ]);

        $token = $request->input('token');
        return redirect('/admin/articles?token=' . $token)->with('success', 'Artigo criado com sucesso!');
    }


    public function edit(string $id)
    {
        $article = Post::findOrFail($id);
        $categories = Category::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories]);
    }



    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => ['required', 'string', 'max:255', 'unique:posts,title,' . $id],
                'image' => ['nullable', 'image'], // A regra 'image' valida se o arquivo é uma imagem
                'body' => ['required', 'string'],
                'author' => ['required', 'string'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        $article = Post::findOrFail($id);
        $imagePath = $article->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Deleta a imagem antiga do bucket, se existir
            if ($imagePath) {
                dd('existe imagem');
                $filename = $request->file('image')->getClientOriginalName();
                $delete = Storage::exists($imagePath);

                if ($delete === true) {
                    Storage::delete($imagePath);
                }
            } else {
                // dd('não existe imagem');
            }

            // Faz upload da nova imagem usando store() no S3
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store(
                'homolog',
                ['disk' => 's3', 'visibility' => 'public']
            );
            if ($path === false) {
                return back()->with('error', 'Falha no upload da nova imagem para o S3');
            }
        }

        $article->update([
            'title'       => $request->title,
            'body'        => $request->body,
            'image'       => $path ?? $imagePath,  
            'author'      => $request->author,
            'id_category' => $article->id_category,
        ]);

        $token = $request->input('token');
        return redirect('/admin/articles?token=' . $token)
            ->with('success', 'Artigo atualizado com sucesso!');
    }


    public function destroy(string $id)
    {
        $article = Post::findOrFail($id);
        $imagePath = $article->image;
        // Deleta a imagem do S3, se existir
        if ($imagePath) {
            $delete = Storage::exists($imagePath);
            if ($delete === true) {
                Storage::delete($imagePath);
            }
        }
        $article->delete();
        return redirect('/admin/articles');
    }

    // Novo método para incrementar a contagem de e-mails
    public function incrementEmail(string $id)
    {
        $article = Post::findOrFail($id);
        $article->increment('qt_emails');
        return response()->json(['success' => true]);
    }
}
