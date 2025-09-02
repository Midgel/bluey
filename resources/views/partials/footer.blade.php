<footer class="bg-card border-t border-border">
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo e descrição -->
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('images/icon.png') }}" alt="Bluey Logo" class="w-12 h-12 rounded-xl" />
                    <div>
                        <h3 class="text-2xl font-bold text-bluey-primary">BLUEY</h3>
                        <p class="text-sm text-muted-foreground">Bem-estar Animal</p>
                    </div>
                </div>
                <p class="text-muted-foreground mb-6 max-w-md leading-relaxed">
                    Dedicados a promover o bem-estar animal através de conteúdo educativo, dicas práticas e histórias
                    inspiradoras que conectam pessoas e pets.
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.instagram.com" target="_blank">
                        <button
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent h-10 w-10 text-muted-foreground hover:text-bluey-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-instagram w-5 h-5">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </button>
                    </a>
                    <a href="https://www.facebook.com" target="_blank">
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent h-10 w-10 text-muted-foreground hover:text-bluey-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-facebook w-5 h-5">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </button>
                </a>
                <a href="https://x.com" target="_blank">
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent h-10 w-10 text-muted-foreground hover:text-bluey-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-twitter w-5 h-5">
                            <path
                                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                            </path>
                        </svg>
                    </button>
                </a>
                </div>
            </div>
            <!-- Navegação -->
            <div>
                <h4 class="font-semibold text-foreground mb-4">Navegação</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('welcome') }}"
                            class="text-muted-foreground hover:text-bluey-primary transition-colors">Início</a></li>
                    <li><a href="{{ route('articles.index') }}"
                            class="text-muted-foreground hover:text-bluey-primary transition-colors">Artigos</a></li>
                    <li><a href="{{ route('articles.index') }}"
                            class="text-muted-foreground hover:text-bluey-primary transition-colors">Categorias</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-muted-foreground hover:text-bluey-primary transition-colors">Sobre</a></li>
                </ul>
            </div>
            <!-- Categorias -->
            <div>
                <h4 class="font-semibold text-foreground mb-4">Categorias</h4>
                @php
                    $categories = App\Models\Category::all();
                  @endphp
                <ul class="space-y-3">
                    @foreach ($categories as $category)
                        <li>
                            <a href="/articles?category={{ $category->description }}"
                                class="text-muted-foreground hover:text-bluey-primary transition-colors">
                                {{ $category->description }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Barra inferior -->
        <div class="border-t border-border mt-12 pt-8 flex flex-col md:flex-row items-center justify-between">
            <p class="text-muted-foreground text-sm">
                © 2025 BLUEY. Feito com <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-heart w-4 h-4 inline text-red-500 mx-1">
                    <path
                        d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                    </path>
                </svg> para nossos amigos de quatro patas.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="" class="text-muted-foreground hover:text-bluey-primary text-sm transition-colors">
                    Privacidade
                </a>
                <a href="" class="text-muted-foreground hover:text-bluey-primary text-sm transition-colors">
                    Termos
                </a>
            </div>
        </div>
    </div>
</footer>