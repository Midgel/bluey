<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <article class="prose prose-lg max-w-none">
                <!-- Título do Artigo -->
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $article->title }}</h1>

                <!-- Informações do Autor e Categoria -->
                <div class="flex items-center space-x-4 mb-6 text-muted-foreground text-sm">
                    <div class="flex items-center">
                        <span class="mr-1">Por:</span>
                        <span>{{ $article->author }}</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center">
                        <span class="mr-1">Categoria:</span>
                        <span>{{ $article->category->description }}</span>
                    </div>
                </div>

                <!-- Imagem em Destaque -->
                <div class="mb-8">
                    @if(!empty($article->image))
                        <img src="{{ $article->image }}" alt="{{ $article->title }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                    @else
                        <img src="{{ asset('images/dog-care.jpg') }}" alt="{{ $article->title }}"
                            class="w-full h-96 object-cover rounded-lg shadow-sm" />
                    @endif

                </div>

                <!-- Conteúdo do Artigo -->
                <div class="text-base text-gray-700 leading-relaxed">
                    {{ $article->body }}
                </div>
            </article>

            <!-- Ações do Administrador -->
            <div class="mt-10 flex space-x-4">
                <a href="/admin/articles?token={{request()->token}}"
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-border text-foreground hover:bg-accent hover:text-accent-foreground">
                    Voltar para a lista
                </a>
                <a href="/admin/articles/{{ $article->id }}/edit?token={{request()->token}}"
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-blue-500 text-white hover:bg-blue-600">
                    Editar Artigo
                </a>
                <form action="/admin/articles/{{ $article->id }}?token={{request()->token}}" method="POST"
                    class="inline-flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-red-500 text-white hover:bg-red-600">
                        Deletar Artigo
                    </button>
                </form>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>

</html>