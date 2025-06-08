<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        
        .bg-gradient-main {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .book-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .book-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }
        
        .floating-search {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .dropdown-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px, 30px 30px;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.3); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.6); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-main">
    <!-- Header -->
    <header class="glass-effect shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#" class="flex items-center group">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mr-3 animate-float">
                            <i class="fas fa-book-open text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Bookfy
                        </span>
                    </a>
                </div>
        
                <!-- Search Bar -->
                <div class="hidden md:flex flex-grow mx-8 relative">
                    <form class="relative w-full max-w-2xl mx-auto">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-indigo-400"></i>
                        </div>
                        <input type="text" 
                               placeholder="Pesquisar livros, autores ou categorias..." 
                               class="w-full pl-12 pr-4 py-3 floating-search rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 text-gray-700">
                    </form>
                </div>
        
                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-2">
                    <div class="relative group">
                        <button class="px-4 py-2 rounded-xl font-medium text-gray-700 hover:text-indigo-600 hover:bg-white/50 transition-all duration-300 flex items-center">
                            <i class="fas fa-list mr-2"></i>Categorias
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 dropdown-glass rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Ficção</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Romance</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Tecnologia</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Autoajuda</a>
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <button class="px-4 py-2 rounded-xl font-medium text-gray-700 hover:text-indigo-600 hover:bg-white/50 transition-all duration-300 flex items-center">
                            <i class="fas fa-pen-fancy mr-2"></i>Autores
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 dropdown-glass rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">J.K. Rowling</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">George Orwell</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Stephen King</a>
                        </div>
                    </div>
                    
                    <button class="px-4 py-2 rounded-xl font-medium text-gray-700 hover:text-indigo-600 hover:bg-white/50 transition-all duration-300 flex items-center">
                        <i class="fas fa-fire mr-2"></i>Populares
                    </button>
                    
                    <button class="ml-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center">
                        <i class="fas fa-plus mr-2"></i>Compartilhar
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern py-16 text-center text-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-float">
                    Biblioteca Digital <span class="text-yellow-300">Infinita</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-indigo-100">
                    Descubra, compartilhe e baixe milhares de livros em PDF gratuitamente
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <div class="bg-white/20 backdrop-blur-lg rounded-full px-8 py-4 flex items-center">
                        <i class="fas fa-book text-yellow-300 mr-3"></i>
                        <span class="font-semibold">12,450+ Livros</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-lg rounded-full px-8 py-4 flex items-center">
                        <i class="fas fa-download text-green-300 mr-3"></i>
                        <span class="font-semibold">85,320+ Downloads</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-lg rounded-full px-8 py-4 flex items-center">
                        <i class="fas fa-users text-blue-300 mr-3"></i>
                        <span class="font-semibold">5,678+ Usuários</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 -mt-8 relative z-10">
        <!-- Featured Books Grid -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">
                <i class="fas fa-star text-yellow-400 mr-3"></i>
                Livros em Destaque
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <!-- Book Card 1 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">O Poder do Hábito</h3>
                        <p class="text-gray-600 text-sm mb-3">Charles Duhigg</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>

                <!-- Book Card 2 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">1984</h3>
                        <p class="text-gray-600 text-sm mb-3">George Orwell</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>

                <!-- Book Card 3 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">O Alquimista</h3>
                        <p class="text-gray-600 text-sm mb-3">Paulo Coelho</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>

                <!-- Book Card 4 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">Clean Code</h3>
                        <p class="text-gray-600 text-sm mb-3">Robert Martin</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>

                <!-- Book Card 5 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1519791883288-dc8bd696e667?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">Sapiens</h3>
                        <p class="text-gray-600 text-sm mb-3">Yuval Harari</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>

                <!-- Book Card 6 -->
                <div class="book-card rounded-2xl shadow-xl overflow-hidden group">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=400&fit=crop" 
                             alt="Capa do livro" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-2">
                                <button class="flex-1 bg-green-500 hover:bg-green-600 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-1"></i> Baixar
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-600 py-2 px-3 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 mb-1 line-clamp-2">Dom Casmurro</h3>
                        <p class="text-gray-600 text-sm mb-3">Machado de Assis</p>
                        <button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Baixar PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="glass-effect rounded-3xl p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                <i class="fas fa-layer-group text-indigo-500 mr-3"></i>
                Explore por Categoria
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="group cursor-pointer">
                    <div class="bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl p-6 text-white text-center transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-heart text-3xl mb-3"></i>
                        <h3 class="font-bold text-lg">Romance</h3>
                        <p class="text-sm opacity-90">1,234 livros</p>
                    </div>
                </div>
                
                <div class="group cursor-pointer">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl p-6 text-white text-center transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-code text-3xl mb-3"></i>
                        <h3 class="font-bold text-lg">Tecnologia</h3>
                        <p class="text-sm opacity-90">892 livros</p>
                    </div>
                </div>
                
                <div class="group cursor-pointer">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl p-6 text-white text-center transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-seedling text-3xl mb-3"></i>
                        <h3 class="font-bold text-lg">Autoajuda</h3>
                        <p class="text-sm opacity-90">567 livros</p>
                    </div>
                </div>
                
                <div class="group cursor-pointer">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl p-6 text-white text-center transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-magic text-3xl mb-3"></i>
                        <h3 class="font-bold text-lg">Ficção</h3>
                        <p class="text-sm opacity-90">2,045 livros</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="glass-effect rounded-3xl p-12 pulse-glow">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Compartilhe Conhecimento
                </h2>
                <p class="text-xl text-gray-600 mb-8">
                    Tem um livro incrível? Compartilhe com nossa comunidade!
                </p>
                <button class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-12 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-plus mr-3"></i>
                    Compartilhar Meu Livro
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="glass-effect mt-16 py-8">
        <div class="container mx-auto px-6 text-center">
            <div class="flex items-center justify-center mb-4">
                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-book-open text-white"></i>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Bookfy
                </span>
            </div>
            <p class="text-gray-600 mb-2">
                © 2024 Bookfy. Compartilhe conhecimento, baixe livros gratuitamente.
            </p>
            <p class="text-sm text-gray-500">
                Construído com ❤️ para os amantes de livros
            </p>
        </div>
    </footer>
</body>
</html>