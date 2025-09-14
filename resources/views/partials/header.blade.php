<header class="bg-card border-b border-border sticky top-0 z-50 backdrop-blur-sm bg-card/95">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/icon.png') }}" alt="Bluey Logo" class="w-12 h-12 rounded-xl" />
                <div>
                    <h1 class="text-2xl font-bold text-bluey-primary">BLUEY</h1>
                    <p class="text-sm text-muted-foreground">Bem-estar Animal</p>
                </div>
            </div>
            <!-- Navegação -->
            <nav class="flex items-center space-x-4 md:space-x-8">
                <a href="{{ route('welcome') }}"
                   class="flex items-center space-x-2 text-foreground hover:text-bluey-primary transition-colors" title="Inicio">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house w-4 h-4" data-lov-id="src/components/Header.tsx:20:14" data-lov-name="Home" data-component-path="src/components/Header.tsx" data-component-line="20" data-component-file="Header.tsx" data-component-name="Home" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                    <span class="hidden md:inline">Início</span>
                </a>
                <a href="{{ route('articles.index') }}"
                   class="flex items-center space-x-2 text-foreground hover:text-bluey-primary transition-colors" title="Artigos">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-heart w-4 h-4">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                        </path>
                    </svg>
                    <span class="hidden md:inline">Artigos</span>
                </a>
                <div class="relative inline-block text-left" title="Categorias">
                    <button type="button"
                            class="flex items-center space-x-2 text-foreground hover:text-bluey-primary transition-colors"
                            id="menu-button" aria-expanded="true" aria-haspopup="true" onclick="toggleDropdown()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-book-open w-4 h-4">
                            <path d="M12 7v14"></path>
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                            </path>
                        </svg>
                        <span class="hidden md:inline">Categorias</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-chevron-down w-3 h-3">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div id="category-menu"
                         class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                         role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a href="{{ route('articles.index') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                               tabindex="-1">Todas as Categorias</a>
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $category)
                                <a href="{{ route('articles.index', ['category' => $category->description]) }}"
                                   class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                                    {{ $category->description }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a class="flex items-center space-x-2 text-foreground hover:text-bluey-primary transition-colors" href="{{ route('about') }}" title="Sobre">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-info w-4 h-4" data-lov-id="src/components/Header.tsx:28:14" data-lov-name="Info"
                         data-component-path="src/components/Header.tsx" data-component-line="28" data-component-file="Header.tsx"
                         data-component-name="Info" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>
                    </svg>
                    <span class="hidden md:inline">Sobre</span>
                </a>
            </nav>
            <!-- Pesquisa e Ações -->
            <div class="flex items-center space-x-4 ml-2">
                <form action="/articles" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Pesquisar..."
                           class="w-40 p-2 pr-10 border border-border rounded-md bg-input focus:ring-2 focus:ring-bluey-primary focus:border-bluey-primary transition-colors">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('category-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</header>
