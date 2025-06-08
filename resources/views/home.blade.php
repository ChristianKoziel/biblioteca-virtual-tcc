@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if(request('search') && $pdfs->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="font-semibold">Nenhum livro encontrado para "{{ request('search') }}"</p>
                </div>
                <p class="mt-2">Sugestões:
                    <ul class="list-disc list-inside ml-4">
                        <li>Verifique se digitou corretamente</li>
                        <li>Tente termos mais genéricos</li>
                        <li>Explore nossas categorias ou autores</li>
                    </ul>
                </p>
            </div>
        @endif
        <!-- Grid de livros -->
        <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($pdfs as $pdf)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 hover:shadow-lg transition-transform duration-300 flex flex-col h-full">
                    <!-- Capa do livro -->
                    <div class="relative pt-[140%]">
                        <img src="{{ asset('storage/' . $pdf->image_path.'.jpg') }}" 
                             alt="Capa do livro {{ $pdf->title }}" 
                             class="absolute top-0 left-0 w-full h-full object-contain cursor-pointer"
                             onclick="openBookPopup('{{ $pdf->title }}', '{{ $pdf->author }}', '{{ $pdf->description }}', '{{ route('book.download', $pdf->id) }}', '{{ asset('storage/' . $pdf->image_path.'.jpg') }}')">
                    </div>
                    
                    <!-- Detalhes do livro -->
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex-grow">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $pdf->title }}</h3>
                            <p class="text-gray-600">por {{ $pdf->author }}</p>
                        </div>
                        <div class="mt-4">
                            @auth
                                <a href="{{ route('book.download', $pdf->id) }}" class="block w-full">
                                    <button class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
                                        Baixar PDF
                                    </button>
                                </a>
                            @else
                                <button onclick="showLoginPopup()" 
                                        class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
                                    Faça login para baixar
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Paginação -->
        <div class="mt-8 flex justify-center">
            {{ $pdfs->links() }}
        </div>
    </div>
    
    <!-- Popup de detalhes do livro -->
    <div id="book-popup" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-start mb-4">
                <h2 id="popup-title" class="text-2xl font-bold text-gray-800"></h2>
                <button onclick="closePopup()" class="text-gray-500 hover:text-gray-700 text-2xl">
                    &times;
                </button>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3 flex justify-center">
                    <img id="popup-image" src="" alt="Capa do livro" 
                         class="max-h-96 object-contain rounded-lg border border-gray-200">
                </div>
                
                <div class="w-full md:w-2/3">
                    <p id="popup-author" class="text-lg text-gray-600 mb-4"></p>
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Descrição</h3>
                        <p id="popup-description" class="text-gray-600"></p>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        @auth
                            <a id="popup-download-pdf" href="#" 
                               class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg flex items-center gap-2 transition">
                                <i class="fas fa-download"></i>
                                Baixar PDF
                            </a>
                        @else
                            <button onclick="showLoginPopup()"
                                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg flex items-center gap-2 transition">
                                <i class="fas fa-sign-in-alt"></i>
                                Faça login para baixar
                            </button>
                        @endauth
                        
                        <button onclick="closePopup()"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg transition">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Popup de login -->
    <div id="login-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Login necessário</h2>
                <button onclick="hideLoginPopup()" class="text-gray-500 hover:text-gray-700 text-2xl">
                    &times;
                </button>
            </div>
            
            <p class="mb-6 text-gray-600">Você precisa estar logado para baixar este livro.</p>
            
            <div class="flex flex-col space-y-3">
                <a href="{{ route('login') }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-center transition">
                    Fazer Login
                </a>
                <a href="{{ route('register') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded text-center transition">
                    Criar Conta
                </a>
            </div>
        </div>
    </div>

    <script>
        // Funções para controlar os popups
        function openBookPopup(title, author, description, pdfUrl, imageUrl) {
            document.getElementById('popup-title').textContent = title;
            document.getElementById('popup-author').textContent = 'por ' + author;
            document.getElementById('popup-description').textContent = description || 'Nenhuma descrição disponível.';
            document.getElementById('popup-image').src = imageUrl;
            
            // Configura o link de download no popup
            const downloadBtn = document.getElementById('popup-download-pdf');
            if (downloadBtn) {
                downloadBtn.href = pdfUrl;
            }
            
            document.getElementById('book-popup').classList.remove('hidden');
        }
        
        function closePopup() {
            document.getElementById('book-popup').classList.add('hidden');
        }
        
        function showLoginPopup() {
            document.getElementById('login-popup').classList.remove('hidden');
        }
        
        function hideLoginPopup() {
            document.getElementById('login-popup').classList.add('hidden');
        }
    </script>
@endsection