@if($articles->isEmpty())
    <div class="text-center py-16">
        <h2 class="text-3xl font-bold text-gray-400 mb-4">Nenhum artigo encontrado.</h2>
        <p class="text-gray-500">Tente outra pesquisa ou explore as categorias.</p>
    </div>
@else
    <!-- Grade de Artigos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <!-- Loop para exibir os artigos dinamicamente -->
        @foreach ($articles as $article)
            <div
                class="group hover:shadow-xl transition-all duration-300 border-0 shadow-md hover:-translate-y-2 bg-card overflow-hidden cursor-pointer">
                <!-- Imagem -->
                <a href="/articles/{{$article->id}}">
                    <div class="relative overflow-hidden">
                        @if(!empty($article->image))
                            <img src="{{ Storage::disk('s3')->url($article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                        @else
                            <img src="{{ asset('images/dog-care.jpg') }}" alt="{{ $article->title }}"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                        @endif

                        <!-- Crachá de Categoria e Tempo de Leitura -->
                        <div class="absolute top-4 left-4">
                            <span
                                class="inline-flex items-center rounded-full border border-transparent px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-bluey-primary/90 text-white hover:bg-bluey-primary">
                                {{ $article->category->description }}
                            </span>
                        </div>
                    </div>
                    <!-- Conteúdo do Cartão -->
                    <div class="flex flex-col p-6 space-y-3">
                        <h3
                            class="text-xl font-bold text-foreground group-hover:text-bluey-primary transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h3>
                        <p class="text-muted-foreground line-clamp-3 leading-relaxed">
                            {{ Str::words($article->body, 20) }}
                        </p>
                    </div>
                    <!-- Rodapé do Cartão com Autor e Data -->
                    <div class="p-6 pt-0">
                        <div class="flex items-center space-x-4 text-sm text-muted-foreground">
                            <span>{{ $article->author }}</span>
                            <span>•</span>
                            <span>{{ $article->created_at->format('d m Y') }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif