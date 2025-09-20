<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Simula o S3 para não fazer uploads reais durante os testes
        Storage::fake('s3');
    }

    public function test_it_can_create_article_with_image_successfully()
    {
        // Arrange - Preparar os dados necessários
        $category = Category::create(['description' => 'Saúde Animal']);

        $file = UploadedFile::fake()->image('pet-care.jpg', 800, 600);

        $articleData = [
            'title' => 'Cuidados Essenciais com seu Pet',
            'body' => 'Este artigo apresenta dicas importantes para manter a saúde do seu animal de estimação...',
            'author' => 'Dr. Veterinário Silva',
            'id_category' => $category->id,
            'image' => $file,
            'qt_views' => 0,    // Campo obrigatório
            'qt_emails' => 0,   // Campo obrigatório
            'token' => 'seu-token-secreto' // Token correto do middleware
        ];

        // Act - Executar a ação com o token correto
        $response = $this->post('/admin/articles', $articleData);

        // Assert - Verificar os resultados

        // 1. Verifica se o redirecionamento foi correto
        $response->assertRedirect('/admin/articles?token=seu-token-secreto');

        // 2. Verifica se a mensagem de sucesso foi definida na sessão
        $response->assertSessionHas('success', 'Artigo criado com sucesso!');

        // 3. Verifica se o artigo foi salvo no banco de dados
        $this->assertDatabaseHas('posts', [
            'title' => 'Cuidados Essenciais com seu Pet',
            'body' => 'Este artigo apresenta dicas importantes para manter a saúde do seu animal de estimação...',
            'author' => 'Dr. Veterinário Silva',
            'id_category' => $category->id,
            'qt_views' => 0,
            'qt_emails' => 0,
        ]);

        // 4. Verifica se a imagem foi enviada para o S3 (simulado)
        Storage::disk('s3')->assertExists('homolog/' . $file->hashName());

        // 5. Verifica se realmente foi criado apenas 1 post
        $this->assertEquals(1, Post::count());
    }

    public function test_it_validates_required_fields_when_creating_article()
    {
        // Act - Tentar criar artigo sem dados obrigatórios (mas com token correto)
        $response = $this->post('/admin/articles', [
            'token' => 'seu-token-secreto'
        ]);

        // Assert - Verificar se há redirecionamento (Laravel redireciona em caso de erro de validação)
        $response->assertStatus(302);

        // Verifica se nenhum post foi criado
        $this->assertEquals(0, Post::count());
    }

    public function test_it_prevents_creating_article_with_duplicate_title()
    {
        // Arrange - Criar um artigo existente com todos os campos obrigatórios
        $category = Category::create(['description' => 'Alimentação']);

        Post::create([
            'id_category' => $category->id,
            'title' => 'Título Já Existente',
            'body' => 'Conteúdo original',
            'author' => 'Autor Original',
            'image' => 'homolog/existing-image.jpg',
            'qt_views' => 0,    // Campo obrigatório
            'qt_emails' => 0,   // Campo obrigatório
        ]);

        $file = UploadedFile::fake()->image('new-image.jpg');

        // Act - Tentar criar outro artigo com o mesmo título
        $response = $this->post('/admin/articles', [
            'title' => 'Título Já Existente',
            'body' => 'Novo conteúdo',
            'author' => 'Novo Autor',
            'id_category' => $category->id,
            'image' => $file,
            'qt_views' => 0,    // Campo obrigatório
            'qt_emails' => 0,   // Campo obrigatório
            'token' => 'seu-token-secreto'
        ]);

        // Assert - Verificar se houve erro de validação (status 302 = redirecionamento com erro)
        $response->assertStatus(302);

        // Deve existir apenas o primeiro post
        $this->assertEquals(1, Post::count());
    }

    public function test_it_blocks_access_without_valid_token()
    {
        $category = Category::create(['description' => 'Teste']);
        $file = UploadedFile::fake()->image('test.jpg');

        // Ação - Tentar acessar sem token
        $response = $this->post('/admin/articles', [
            'title' => 'Teste sem token',
            'body' => 'Conteúdo...',
            'author' => 'Autor',
            'id_category' => $category->id,
            'image' => $file,
            'qt_views' => 0,
            'qt_emails' => 0,
        ]);

        // Assertividade - Deve retornar erro 401
        $response->assertStatus(401);
        $response->assertSeeText('Acesso negado. Token de segurança não encontrado ou inválido.');

        // Nenhum post deve ser criado
        $this->assertEquals(0, Post::count());
    }
}
