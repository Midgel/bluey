<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel de Artigos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Todos os Artigos</h1>
        <div class="mb-8">
            <a href="/admin/articles/create?token={{ request()->token }}"
                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 bg-blue-400 text-white hover:bg-bluey-primary/90">
                Criar Novo Artigo
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)

                <div
                    class="group hover:shadow-xl transition-all duration-300 border-0 shadow-md hover:-translate-y-2 bg-card overflow-hidden cursor-pointer rounded-lg">
                    {{-- <a href="/admin/articles/{{ $article->id }}/edit?token={{request()->token}}"> --}}
                        <a href="/admin/articles/show/{{ $article->id }}?token={{request()->token}}">
                            <div class="relative overflow-hidden">
                                @if(!empty($article->image))
                                    <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                                @else
                                    <img src="{{ asset('images/dog-care.jpg') }}" alt="{{ $article->title }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center rounded-full border border-transparent px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-bluey-primary/90 text-white hover:bg-bluey-primary">
                                        {{ $article->category->description }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col p-6 space-y-3">
                                <h3
                                    class="text-xl font-bold text-foreground group-hover:text-bluey-primary transition-colors line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-muted-foreground line-clamp-3 leading-relaxed">
                                    {{ Str::words($article->body, 20) }}
                                </p>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="flex items-center space-x-4 text-sm text-muted-foreground">
                                    <span>{{ $article->author }}</span>
                                    <span>•</span>
                                    <span>{{ $article->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                </div>
            @endforeach
        </div>
    </main>

    @include('partials.footer')
</body>

</html>