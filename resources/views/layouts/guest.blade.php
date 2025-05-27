<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .book-pattern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }
        .book-pattern::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px, 30px 30px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .book-icon { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body class="min-h-screen book-pattern flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 book-icon">
                <i class="fas fa-book-open text-3xl text-indigo-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Bookfy</h1>
            <p class="text-indigo-100">Sua biblioteca digital pessoal</p>
        </div>
        
        <!-- Content Card -->
        <div class="glass-card rounded-2xl shadow-2xl p-8 backdrop-blur-sm">
            {{ $slot }}
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-indigo-100 text-sm">
                © 2025 Bookfy. Compartilhe conhecimento, baixe livros.
            </p>
        </div>
    </div>
</body>
</html>