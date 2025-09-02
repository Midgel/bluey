<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Post;

//Rotas públicas
// 1 - Rota para a página inicial
Route::get('/', [ArticleController::class, 'welcome'])->name('welcome');

//2 -  Rota para a página inicial
Route::get('/welcome', [ArticleController::class, 'welcome'])->name('welcome');

//3 - Rota para a página de LISTA de artigos
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

//4 - Rota para a página de detalhes de um único artigo
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('show');

//5 - Rota para a página "Sobre"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Nova rota para incrementar a contagem de e-mails
Route::post('/articles/{id}/increment-email', [ArticleController::class, 'incrementEmail'])->name('articles.increment.email');

//Rotas protegidas - Acesso apenas para administradores autenticados

//1 - Rota para o painel de administração de artigos (protegido por middleware)
Route::get('/admin/articles', [ArticleController::class, 'index'])->middleware('token.access');

//2 - Rota para a página de detalhes de um único artigo ADMIN
Route::get('/admin/articles/show/{id}', [ArticleController::class, 'admin_show'])->middleware('token.access');;

//3 - Rota para a página de criação de um novo artigo (o formulário)
Route::get('/admin/articles/create', [ArticleController::class, 'create'])->middleware('token.access');

//4 - Rota para processar a criação de um artigo
Route::post('/admin/articles', [ArticleController::class, 'store'])->middleware('token.access');

//5 - Rota para a página de edição de um artigo
Route::get('/admin/articles/{id}/edit', [ArticleController::class, 'edit'])->middleware('token.access');

//6 - Rota para processar a atualização de um artigo
Route::post('/admin/articles/{id}', [ArticleController::class, 'update'])->middleware('token.access');

//7 - Rota para deletar um artigo
Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->middleware('token.access');