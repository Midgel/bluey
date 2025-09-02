<main>
    <!-- Seção Hero -->
    <section class="relative py-20 px-4 overflow-hidden">
        <!-- Gradiente de Fundo -->
        <div class="absolute inset-0 bg-gradient-to-br from-bluey-light via-background to-bluey-secondary/20"></div>

        <!-- Formas Flutuantes (efeito visual) -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-bluey-secondary/30 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-bluey-accent/20 rounded-full blur-xl animate-pulse delay-1000"></div>

        <div class="container mx-auto relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Crachá -->
                <div class="inline-flex items-center space-x-2 bg-bluey-light border border-bluey-secondary/50 rounded-full px-6 py-2 mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4 text-bluey-primary">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                        <path d="M20 3v4"></path>
                        <path d="M22 5h-4"></path>
                        <path d="M4 17v2"></path>
                        <path d="M5 18H3"></path>
                    </svg>
                    <span class="text-sm font-medium text-bluey-primary">Cuidando do bem-estar animal</span>
                </div>
                <!-- Título Principal -->
                <h1 class="text-5xl md:text-7xl font-bold text-foreground mb-6 leading-tight">
                    Amor e
                    <span class="bg-gradient-to-r from-bluey-primary to-bluey-secondary bg-clip-text text-transparent"> Cuidado </span>
                    para nossos
                    <span class="bg-gradient-to-r from-bluey-primary to-bluey-secondary bg-clip-text text-transparent"> Amigos</span>
                </h1>
                <!-- Subtítulo -->
                <p class="text-xl md:text-2xl text-muted-foreground mb-10 max-w-3xl mx-auto leading-relaxed">
                    Descubra dicas, cuidados e histórias inspiradoras sobre o mundo animal.
                    Juntos, podemos fazer a diferença na vida dos nossos companheiros de quatro patas.
                </p>
                <!-- Botões de CTA -->
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="{{route('articles.index')}}" class="inline-flex items-center justify-center whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 h-11 bg-blue-400 hover:bg-bluey-primary/90 px-8 py-6 text-lg rounded-xl shadow-lg hover:shadow-xl duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-5 h-5 mr-2 group-hover:scale-110 transition-transform">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                        </svg>
                        Explorar Artigos
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="{{route('about')}}">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border bg-background h-11 rounded-md px-8 border-bluey-primary text-bluey-primary hover:bg-bluey-light px-8 py-6 text-lg transition-all duration-300">
                        Sobre o BLUEY
                    </button>
                </a>
                </div>
                <!-- Estatísticas -->
                <div class="grid grid-cols-3 gap-8 mt-16 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-bluey-primary mb-2">500+</div>
                        <div class="text-sm text-muted-foreground">Artigos publicados</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-bluey-primary mb-2">10k+</div>
                        <div class="text-sm text-muted-foreground">Leitores mensais</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-bluey-primary mb-2">1k+</div>
                        <div class="text-sm text-muted-foreground">Animais ajudados</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Artigos em Destaque -->
    <section class="py-20 px-4 bg-gradient-to-b from-background to-bluey-light/50">
        <div class="container mx-auto">
            <!-- Cabeçalho da Seção -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-foreground mb-6">
                    Artigos em
                    <span class="bg-gradient-to-r from-bluey-primary to-bluey-secondary bg-clip-text"> Destaque</span>
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Conteúdo especializado para você cuidar melhor do seu melhor amigo
                </p>
            </div>
            <!-- Grade de Artigos -->
            @include('partials.articles')
            <!-- CTA -->
            <div class="text-center">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border bg-background h-11 rounded-md px-8 border-bluey-primary text-bluey-primary hover:bg-bluey-primary hover:text-white transition-all duration-300 group">
                    Ver Todos os Artigos
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
</main>
