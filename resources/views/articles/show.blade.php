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
            <!-- Seção de Contato -->
            <div class="mt-16 max-w-4xl mx-auto">
                <div class="bg-card rounded-2xl p-8 md:p-12">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-foreground mb-4">
                            Entre em Contato
                        </h3>
                        <p class="text-muted-foreground mb-6">
                            Tem alguma dúvida sobre o artigo ou quer compartilhar sua experiência? Envie-nos uma
                            mensagem!
                        </p>
                        <a href="mailto:contato@bluey.com?subject=Dúvida sobre o artigo: {{ $article->title }}"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-11 px-8 py-2 bg-blue-400 text-white hover:bg-bluey-primary/90"
                            id="email-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail w-5 h-5 mr-2">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            Enviar E-mail
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="mt-10 flex space-x-4">
                <a href="/articles"
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-border text-foreground hover:bg-accent hover:text-accent-foreground">
                    Voltar para artigos
                </a>
            </div>
        </div>
    </main>

    @include('partials.footer')
    <script>
        document.getElementById('email-link').addEventListener('click', function (e) {
            fetch('/articles/{{ $article->id }}/increment-email', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Contagem de e-mails incrementada com sucesso.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao incrementar a contagem de e-mails:', error);
                });
        });
    </script>
</body>

</html>