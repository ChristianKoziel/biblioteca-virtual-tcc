<header class="bg-gradient-to-r from-blue-50 to-indigo-50 shadow-lg border-b border-gray-200">
    <div class="container mx-auto px-6 py-3 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center group">
                <span class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition duration-300 ease-in-out">
                    Bookfy
                </span>
                <span class="ml-1 text-2xl text-indigo-600 group-hover:animate-pulse">📚</span>
            </a>
        </div>
    
        <!-- Caixa de pesquisa desktop -->
        <div class="hidden md:flex flex-grow mx-6 relative">
            <form action="{{ route('home') }}" method="GET" class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Pesquisar livros, autores ou categorias..." 
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all duration-200 bg-white">
            </form>
        </div>
    
        <!-- Menu Desktop - visível apenas em desktop -->
        <nav class="hidden md:flex items-center space-x-1">
            <!-- Menu de Categorias -->
            <div class="dropdown-container relative">
                <button id="categories-btn" class="px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center">
                    <span class="mr-1">📚</span> Categorias
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 dropdown-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="categories-menu" class="dropdown-menu absolute left-0 mt-1 w-48 bg-white shadow-lg rounded-md py-1 hidden z-50">
                    @foreach($categories as $category)
                        <a href="{{ route('home', ['filter' => 'category', 'value' => $category]) }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                           {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Menu de Autores -->
            <div class="dropdown-container relative">
                <button id="authors-btn" class="px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center">
                    <span class="mr-1">✍️</span> Autores
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 dropdown-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="authors-menu" class="dropdown-menu absolute left-0 mt-1 w-48 bg-white shadow-lg rounded-md py-1 hidden z-50">
                    @foreach($authors as $author)
                        <a href="{{ route('home', ['filter' => 'author', 'value' => $author]) }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                           {{ $author }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Outros itens do menu -->
            <a href="#" class="px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center">
                <span class="mr-1">🔥</span> Mais lidos
            </a>
            
            <!-- Botão de Compartilhar PDF -->
            <div class="ml-4">
                <a href="{{ route('share.pdf') }}" class="bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-medium px-4 py-2 rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-700 hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <span>Compartilhar</span>
                </a>
            </div>
        </nav>
        
        <!-- Controles Mobile (Pesquisa, Menu e Avatar) -->
        <div class="flex items-center space-x-2 md:hidden">
            <!-- Ícone de pesquisa no mobile -->
            <button id="mobile-search-toggle" class="p-2 rounded-full text-gray-700 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            
            <!-- Ícone do menu hamburguer -->
            <button id="menu-toggle" class="p-2 rounded-full text-gray-700 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Avatar do usuário mobile -->
            <button id="mobile-avatar-btn" class="flex items-center focus:outline-none">
                <img src="storage/usuario.png" alt="Usuário" class="h-8 w-8 rounded-full border-2 border-indigo-200 hover:border-indigo-400 shadow-md transition-all duration-200">
            </button>
        </div>
        
        <!-- Avatar do usuário - visível apenas em desktop -->
        <div class="relative z-50 ml-4 hidden md:block">
            <div class="flex items-center">
                <button id="avatar-btn" class="flex items-center focus:outline-none" aria-expanded="false">
                    <img src="storage/usuario.png" alt="Usuário" class="h-10 w-10 rounded-full border-2 border-indigo-200 hover:border-indigo-400 shadow-md transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown do avatar -->
            <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden overflow-hidden border border-gray-100 transform origin-top-right transition-all duration-200">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    Meu Perfil
                </a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    Minhas Leituras
                </a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    Favoritos
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    Configurações
                </a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-red-600 transition-colors">
                    Sair
                </a>
            </div>
        </div>
    </div>
    
    <!-- Barra de pesquisa mobile -->
    <div id="mobile-search" class="hidden md:hidden px-4 py-3 bg-white border-t border-gray-200">
        <form action="{{ route('home') }}" method="GET" class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="search" placeholder="Pesquisar livros, autores ou categorias..." 
                value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all duration-200 bg-white">
        </form>
    </div>
    
    <!-- Menu Mobile (oculto por padrão) -->
    <div id="mobile-menu" class="hidden md:hidden px-4 py-3 bg-white border-t border-gray-200">
        <div class="space-y-2">
            <!-- Categorias Mobile -->
            <div class="mobile-dropdown-container">
                <button class="mobile-dropdown-btn w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="mr-2">📚</span> Categorias
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden bg-gray-50 rounded-md py-1 mt-1">
                    @foreach($categories as $category)
                        <a href="{{ route('home', ['filter' => 'category', 'value' => $category]) }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                           {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Autores Mobile -->
            <div class="mobile-dropdown-container">
                <button class="mobile-dropdown-btn w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="mr-2">✍️</span> Autores
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden bg-gray-50 rounded-md py-1 mt-1">
                    @foreach($authors as $author)
                        <a href="{{ route('home', ['filter' => 'author', 'value' => $author]) }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                           {{ $author }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Outros itens mobile -->
            <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center">
                <span class="mr-2">🔥</span> Mais lidos
            </a>
            
            <!-- Botão Compartilhar Mobile -->
            <a href="{{ route('share.pdf') }}" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200 flex items-center">
                <span class="mr-2">📤</span> Compartilhar PDF
            </a>
        </div>
    </div>
    
    <!-- Dropdown mobile do avatar (oculto por padrão) -->
    <div id="mobile-user-menu" class="hidden md:hidden px-4 py-3 bg-white border-t border-gray-200">
        <div class="flex items-center mb-4 pb-2 border-b border-gray-200">
            <img src="storage/usuario.png" alt="Usuário" class="h-10 w-10 rounded-full border-2 border-indigo-200 mr-3">
            <div>
                <p class="font-medium text-gray-800">Nome do Usuário</p>
                <p class="text-sm text-gray-500">usuario@email.com</p>
            </div>
        </div>
        <div class="space-y-2">
            <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                Meu Perfil
            </a>
            <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                Minhas Leituras
            </a>
            <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                Favoritos
            </a>
            <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-all duration-200">
                Configurações
            </a>
            <div class="pt-2 mt-2 border-t border-gray-200">
                <a href="#" class="block w-full px-3 py-2 rounded-md font-medium text-red-600 hover:bg-red-50 transition-all duration-200">
                    Sair
                </a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== DROPDOWN DESKTOP =====
    const categoriesBtn = document.getElementById('categories-btn');
    const categoriesMenu = document.getElementById('categories-menu');
    const authorsBtn = document.getElementById('authors-btn');
    const authorsMenu = document.getElementById('authors-menu');
    const avatarBtn = document.getElementById('avatar-btn');
    const avatarDropdown = document.getElementById('dropdown');
    
    // Fecha todos os dropdowns ao carregar a página
    function closeAllDropdowns() {
        [categoriesMenu, authorsMenu, avatarDropdown].forEach(dropdown => {
            if (dropdown) dropdown.classList.add('hidden');
        });
    }
    
    // Inicializa todos os dropdowns fechados
    closeAllDropdowns();
    
    // Configura o dropdown de categorias
    if (categoriesBtn && categoriesMenu) {
        categoriesBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = !categoriesMenu.classList.contains('hidden');
            
            // Fecha todos os menus primeiro
            closeAllDropdowns();
            
            // Abre apenas se não estava aberto antes
            if (!isOpen) {
                categoriesMenu.classList.remove('hidden');
            }
        });
    }
    
    // Configura o dropdown de autores
    if (authorsBtn && authorsMenu) {
        authorsBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = !authorsMenu.classList.contains('hidden');
            
            // Fecha todos os menus primeiro
            closeAllDropdowns();
            
            // Abre apenas se não estava aberto antes
            if (!isOpen) {
                authorsMenu.classList.remove('hidden');
            }
        });
    }
    
    // Configura o dropdown do avatar
    if (avatarBtn && avatarDropdown) {
        avatarBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = !avatarDropdown.classList.contains('hidden');
            
            // Fecha todos os menus primeiro
            closeAllDropdowns();
            
            // Abre apenas se não estava aberto antes
            if (!isOpen) {
                avatarDropdown.classList.remove('hidden');
            }
        });
    }

    // ===== MOBILE CONTROLS =====
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileSearch = document.getElementById('mobile-search');
    const mobileUserMenu = document.getElementById('mobile-user-menu');
    const mobileSearchToggle = document.getElementById('mobile-search-toggle');
    const mobileAvatarBtn = document.getElementById('mobile-avatar-btn');
    
    // Hamburguer menu toggle
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
            mobileSearch.classList.add('hidden');
            mobileUserMenu.classList.add('hidden');
        });
    }

    // Search toggle
    if (mobileSearchToggle && mobileSearch) {
        mobileSearchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileSearch.classList.toggle('hidden');
            mobileMenu.classList.add('hidden');
            mobileUserMenu.classList.add('hidden');
        });
    }
    
    // User menu toggle
    if (mobileAvatarBtn && mobileUserMenu) {
        mobileAvatarBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileUserMenu.classList.toggle('hidden');
            mobileMenu.classList.add('hidden');
            mobileSearch.classList.add('hidden');
        });
    }
    
    // Fecha menus ao clicar fora
    document.addEventListener('click', function() {
        closeAllDropdowns();
        if (mobileMenu) mobileMenu.classList.add('hidden');
        if (mobileSearch) mobileSearch.classList.add('hidden');
        if (mobileUserMenu) mobileUserMenu.classList.add('hidden');
    });
    
    // Previne o fechamento ao clicar dentro dos menus
    const allMenus = [
        categoriesMenu, 
        authorsMenu, 
        avatarDropdown,
        mobileMenu,
        mobileSearch,
        mobileUserMenu
    ].filter(menu => menu !== null);
    
    allMenus.forEach(menu => {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Dropdowns mobile
    document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const menu = this.nextElementSibling;
            const icon = this.querySelector('svg');
            
            // Fecha todos os outros dropdowns mobile
            document.querySelectorAll('.mobile-dropdown-menu').forEach(m => {
                if (m !== menu) {
                    m.classList.add('hidden');
                    const otherIcon = m.previousElementSibling.querySelector('svg');
                    if (otherIcon) otherIcon.style.transform = '';
                }
            });
            
            // Alterna o menu atual
            menu.classList.toggle('hidden');
            
            // Rotaciona o ícone
            if (icon) {
                icon.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
            }
        });
    });
});
</script>

<style>
    /* Estilos para os dropdowns */
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999; /* Aumentado para garantir que fique acima de outros elementos */
    min-width: 12rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    border-radius: 0.375rem;
    overflow: hidden;
    display: block;
}

/* Dropdown mobile */
.mobile-dropdown-menu {
    max-height: 0;
    overflow: hidden;
    border-radius: 0.375rem;
    transition: max-height 0.3s ease-out;
}

.mobile-dropdown-menu:not(.hidden) {
    max-height: 500px; /* Ajuste conforme necessário */
}

/* Rotação do ícone dropdown */
.mobile-dropdown-btn svg {
    transition: transform 0.3s ease;
}

.mobile-dropdown-btn svg.rotate-180 {
    transform: rotate(180deg);
}

/* Melhoria visual para os botões mobile */
.mobile-dropdown-btn {
    transition: all 0.2s;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    text-align: left;
}

.mobile-dropdown-btn.active {
    background-color: rgba(79, 70, 229, 0.05);
    color: rgba(79, 70, 229, 1);
}

/* Melhorias para toque em dispositivos móveis */
@media (max-width: 767px) {
    .mobile-dropdown-btn, 
    #mobile-menu a,
    #menu-toggle, 
    #mobile-search-toggle, 
    #mobile-avatar-btn {
        min-height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
    }
    
    /* Melhora o espaçamento nos submenus mobile */
    .mobile-dropdown-menu a {
        padding-left: 1.5rem;
    }
    
    /* Destaque visual para o item ativo */
    .mobile-dropdown-btn.active {
        font-weight: 500;
    }
}
/* Garante que os dropdowns não apareçam antes do JS carregar */
.dropdown-menu, .mobile-dropdown-menu {
    display: none;
}

/* JavaScript irá controlar a visibilidade */
.dropdown-menu:not(.hidden), .mobile-dropdown-menu:not(.hidden) {
    display: block;
}
</style>