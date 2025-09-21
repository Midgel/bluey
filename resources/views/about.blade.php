<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sobre o BLUEY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-bluey-primary mb-6">
                    Sobre o BLUEY
                </h1>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    Dedicado ao bem-estar e cuidado dos nossos amigos de quatro patas,
                    oferecendo informações confiáveis e dicas práticas para uma vida saudável.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-foreground mb-6">Nossa Missão</h2>
                    <p class="text-muted-foreground text-lg mb-6">
                        No BLUEY, acreditamos que todo animal merece uma vida plena e saudável.
                        Nossa missão é fornecer informações precisas, dicas práticas e orientações
                        especializadas para ajudar tutores a cuidarem melhor de seus pets.
                    </p>
                    <p class="text-muted-foreground text-lg">
                        Trabalhamos para criar uma comunidade informada e engajada, onde o amor
                        pelos animais se traduz em cuidado responsável e bem-estar animal.
                    </p>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/icon.png') }}" alt="Bluey Logo"
                         class="w-64 h-64 mx-auto rounded-3xl shadow-2xl"
                    />
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-foreground mb-12">
                    Nossos Valores
                </h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-bluey-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-8 h-8 text-bluey-primary"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-foreground mb-3">Amor pelos Animais</h3>
                        <p class="text-muted-foreground">
                            Cada conteúdo é criado com amor e respeito pelos nossos companheiros peludos.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-bluey-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield w-8 h-8 text-bluey-primary"><path d="M20 13c0 5-6 9-8 9s-8-4-8-9V5l8-3 8 3v8Z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-foreground mb-3">Informação Confiável</h3>
                        <p class="text-muted-foreground">
                            Baseamos nosso conteúdo em evidências científicas e expertise veterinária.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-bluey-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target w-8 h-8 text-bluey-primary"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-foreground mb-3">Foco no Bem-estar</h3>
                        <p class="text-muted-foreground">
                            Priorizamos sempre a saúde física e mental dos animais em nossas orientações.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-bluey-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-8 h-8 text-bluey-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-foreground mb-3">Comunidade</h3>
                        <p class="text-muted-foreground">
                            Construímos uma rede de tutores responsáveis e cuidadosos com seus pets.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-2xl p-8 md:p-12">
                <h2 class="text-3xl font-bold text-center text-foreground mb-8">
                    O que Oferecemos
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-bluey-primary mb-4">Artigos Especializados</h3>
                        <p class="text-muted-foreground">
                            Conteúdo detalhado sobre saúde, nutrição, comportamento e cuidados gerais
                            com animais de estimação.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-bluey-primary mb-4">Dicas Práticas</h3>
                        <p class="text-muted-foreground">
                            Orientações simples e aplicáveis para o dia a dia, facilitando o cuidado
                            responsável com seus pets.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-bluey-primary mb-4">Informação Atualizada</h3>
                        <p class="text-muted-foreground">
                            Mantemos nosso conteúdo sempre atualizado com as mais recentes descobertas
                            da medicina veterinária.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>