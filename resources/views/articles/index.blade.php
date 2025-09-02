<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Todos os Artigos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    @include('partials.header')

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6 text-center">Todos os Artigos</h1>
        @include('partials.articles')
    </main>

    @include('partials.footer')
</body>

</html>