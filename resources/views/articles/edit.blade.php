<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Artigo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center mb-10">Editar Artigo</h1>

            <div class="bg-card shadow-lg rounded-lg p-8">
                <form action="/admin/articles/{{ $article->id }}?token={{request()->token}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-muted-foreground mb-2">Título</label>
                            <input type="text" id="title" name="title" value="{{ $article->title }}" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">
                            @error('title')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagem do Artigo:</label>
                            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500
                                                                            file:mr-4 file:py-2 file:px-4
                                                                            file:rounded-full file:border-0
                                                                            file:text-sm file:font-semibold
                                                                            file:bg-blue-50 file:text-blue-700
                                                                            hover:file:bg-blue-100"/>
                            @error('image')
                                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-muted-foreground mb-2">Corpo do
                                Artigo</label>
                            <textarea id="body" name="body" rows="10" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">{{ $article->body }}</textarea>
                            @error('body')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="author"
                                class="block text-sm font-medium text-muted-foreground mb-2">Autor</label>
                            <input type="text" id="author" name="author" value="{{ $article->author }}" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">
                            @error('author')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="/admin/articles?token={{request()->token}}"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-border text-foreground hover:bg-accent hover:text-accent-foreground mr-2">
                                Voltar para a lista
                            </a>
                            <button type="submit"
                                class="bg-blue-500 text-white py-3 px-6 rounded-md font-semibold hover:bg-blue-600 transition-colors">
                                Atualizar Artigo
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>

</html>