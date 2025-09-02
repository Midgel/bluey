<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Criar um Novo Artigo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center mb-10">Criar Novo Artigo</h1>

            <div class="bg-card shadow-lg rounded-lg p-8">
                <form action="/admin/articles?token={{request()->token}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="id_category"
                                class="block text-sm font-medium text-muted-foreground mb-2">Categoria</label>
                            <select name="id_category" id="id_category" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-muted-foreground mb-2">Título</label>
                            <input type="text" id="title" name="title" required
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
                                                                            hover:file:bg-blue-100" />
                            @error('image')
                                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-muted-foreground mb-2">Corpo do
                                Artigo</label>
                            <textarea id="body" name="body" rows="10" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors"></textarea>
                            @error('body')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="author"
                                class="block text-sm font-medium text-muted-foreground mb-2">Autor</label>
                            <input type="text" id="author" name="author" required
                                class="w-full p-3 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">
                            @error('author')
                                <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-400 text-black py-3 px-6 rounded-md font-semibold hover:bg-bluey-primary/90 transition-colors">
                                Salvar Artigo
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