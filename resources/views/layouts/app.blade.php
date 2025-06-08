<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Bookfy'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Styles específicos de páginas -->
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Header -->
    @include('partials.header', [
        'categories' => $categories ?? [],
        'authors' => $authors ?? []
    ])

    <!-- Conteúdo principal -->
    <main class="container mx-auto px-4 py-8 relative z-10 min-h-[calc(100vh-160px)]">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Modais e popups -->
    @stack('modals')
    
    <!-- Scripts específicos de páginas -->
    @stack('scripts')

    <!-- Scripts do Vite -->
    @vite(['resources/js/app.js'])

    <!-- Scripts específicos -->
    @stack('scripts')
</body>
</body>
</html>