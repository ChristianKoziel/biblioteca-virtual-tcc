<nav id="mobile-menu" 
     class="md:hidden bg-white shadow-lg {{ $isHidden ? 'hidden' : '' }} fixed inset-x-0 top-16 z-50 transition-all duration-300 transform -translate-y-2 opacity-0">
    <div class="flex flex-col items-center py-4 space-y-3">
        @foreach($menuItems as $item)
            <a href="{{ $item['href'] }}" 
               class="text-gray-700 font-medium hover:text-blue-500 transition duration-300">
                {{ $item['label'] }}
            </a>
        @endforeach
        
        <button id="share-pdf-mobile" 
                class="bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold px-5 py-2 rounded-full shadow-md hover:from-green-600 hover:to-green-800 hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
            <i class="fas fa-share-alt mr-2"></i>
            <span>Compartilhar PDF</span>
        </button>
    </div>
</nav>