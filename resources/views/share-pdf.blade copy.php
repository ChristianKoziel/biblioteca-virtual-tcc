<!-- resources/views/share-pdf.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compartilhar PDF - Bookfy</title>
    <!-- Carregar o CSS e o JS com o vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-3xl font-extrabold text-gray-800 ml-2 hover:text-blue-600 transition duration-300 ease-in-out">
                    Bookfy
                </a>
            </div>
        
            <!-- Caixa de pesquisa -->
            <div class="flex-grow mx-6">
                <input type="text" placeholder="Pesquisar livros..." class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
            </div>
        
            <!-- Ícone do menu para celular -->
            <div class="block md:hidden md:block ml-4 mr-4">
                <button id="menu-toggle" class="text-gray-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        
            <!-- Menus de navegação -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-700 font-medium hover:text-blue-500 transition-all duration-300">📚 Categorias</a>
                <a href="#" class="text-gray-700 font-medium hover:text-blue-500 transition-all duration-300">✍️ Autores</a>
                <!-- Aplicando uma margem inferior -->
                <a href="#" class="text-gray-700 font-medium hover:text-blue-500 transition-all duration-300 mb-3 mr-4">🔥 Mais lidos</a>
            </nav>
            
            <!-- Filtros e Botão de Compartilhamento -->
            <div class="flex items-center space-x-4">
                <!-- Botão compartilhar PDF -->
                <a href="{{ route('share.pdf') }}" class="hidden md:block ml-4 mr-4">
                    <button id="share-pdf-btn" class="bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold px-6 py-2 rounded-full shadow-md hover:from-green-600 hover:to-green-800 hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 8h6m0 0v6m0-6l-9 9m9-9l-9-9M9 21H3m0 0V9m0 12l9-9m-9 9l9 9"></path>
                        </svg>
                        <span>Compartilhar PDF</span>
                    </button>
                </a>
            </div>
            
            <!-- Avatar do usuário com dropdown -->
            <div class="relative z-[100]">
                <!-- Avatar -->
                <img src="storage/usuario.png" alt="Usuário" class="h-10 w-10 rounded-full border border-gray-300 shadow-md cursor-pointer" id="avatar">

                <!-- Dropdown -->
                <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden">
                    <ul class="py-2">
                        <li>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Configurações</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </header>

    <!-- Menu para celular (inicialmente escondido) -->
    <nav id="mobile-menu" class="md:hidden bg-white shadow-md hidden">
        <div class="flex flex-col items-center py-4">
            <a href="#" class="text-gray-700 hover:text-blue-500 py-2">Categorias</a>
            <a href="#" class="text-gray-700 hover:text-blue-500 py-2">Autores</a>
            <a href="#" class="text-gray-700 hover:text-blue-500 py-2">Mais lidos</a>

            <!-- Botão Compartilhar PDF -->
            <button id="share-pdf-mobile" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-2">
                Compartilhar PDF
            </button>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Compartilhe seus livros em PDF</h1>
            <p class="text-lg text-gray-600">Ajude a comunidade e a biblioteca a crescer. Compartilhe conhecimento e faça parte dessa rede de leitores apaixonados.</p>
        </div>

        <!-- Formulário de upload de PDF -->
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título do Livro</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Ex: Como fazer amigos e influenciar pessoas" 
                        required
                    >
                </div>
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                    <input 
                        type="text" 
                        id="author" 
                        name="author" 
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Ex: Dale Carnegie" 
                        required
                    >
                </div>
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select 
                        id="category" 
                        name="category" 
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required
                    >
                        <option value="">Selecione uma categoria</option>
                        <option value="Administração, Negócios e Economia">Administração, Negócios e Economia</option>
                        <option value="Arte, Cinema e Fotografia">Arte, Cinema e Fotografia</option>
                        <option value="Artesanato, Casa e Estilo de Vida">Artesanato, Casa e Estilo de Vida</option>
                        <option value="Autoajuda">Autoajuda</option>
                        <option value="Biografias e Histórias Reais">Biografias e Histórias Reais</option>
                        <option value="Ciências">Ciências</option>
                        <option value="Computação, Informática e Mídias Digitais">Computação, Informática e Mídias Digitais</option>
                        <option value="Crônicas, Humor e Entretenimento">Crônicas, Humor e Entretenimento</option>
                        <option value="Direito">Direito</option>
                        <option value="Educação, Referência e Didáticos">Educação, Referência e Didáticos</option>
                        <option value="Engenharia e Transporte">Engenharia e Transporte</option>
                        <option value="Erótico">Erótico</option>
                        <option value="Esportes e Lazer">Esportes e Lazer</option>
                        <option value="Fantasia, Horror e Ficção Científica">Fantasia, Horror e Ficção Científica</option>
                        <option value="Gastronomia e Culinária">Gastronomia e Culinária</option>
                        <option value="História">História</option>
                        <option value="HQs, Mangás e Graphic Novels">HQs, Mangás e Graphic Novels</option>
                        <option value="Infantil">Infantil</option>
                        <option value="LGBTQ+">LGBTQ+</option>
                        <option value="Literatura e Ficção">Literatura e Ficção</option>
                        <option value="Medicina">Medicina</option>
                        <option value="Policial, Suspense e Mistério">Policial, Suspense e Mistério</option>
                        <option value="Política, Filosofia e Ciências Sociais">Política, Filosofia e Ciências Sociais</option>
                        <option value="Religião e Espiritualidade">Religião e Espiritualidade</option>
                        <option value="Romance">Romance</option>
                        <option value="Saúde e Família">Saúde e Família</option>
                        <option value="Turismo e Guias de Viagem">Turismo e Guias de Viagem</option>
                        <option value="Inglês e Outras Línguas">Inglês e Outras Línguas</option>
                        <option value="Jovens e Adolescentes">Jovens e Adolescentes</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Ex: Um clássico sobre relacionamentos interpessoais, com dicas práticas para melhorar sua comunicação e influência no dia a dia." 
                        required
                    ></textarea>
                </div>
                <div class="mb-6">
                    <label for="pdf" class="block text-sm font-medium text-gray-700">Arquivo PDF</label>
                    <input 
                        type="file" 
                        id="pdf" 
                        name="pdf_file" 
                        accept="application/pdf" 
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        required
                    >
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Compartilhar Livro</button>
                </div>
            </form>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Bookfy. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Script para alternar o menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Toggle do menu mobile
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Toggle do dropdown do usuário
    const avatar = document.getElementById('avatar');
    const dropdown = document.getElementById('dropdown');

    if (avatar && dropdown) {
        avatar.addEventListener('click', function(event) {
            event.stopPropagation(); // Impede que o clique propague para o documento
            dropdown.classList.toggle('hidden');
        });

        // Fechar o dropdown ao clicar fora dele
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target) && !avatar.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // Fechar o menu mobile ao clicar em um link
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    });
    </script>
</body>
</html>