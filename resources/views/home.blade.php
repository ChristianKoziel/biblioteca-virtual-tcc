@extends('layouts.app')

@section('content')
    <!-- Menu mobile componentizado -->

    <div class="container mx-auto px-4 py-8">
        <!-- Grid de livros CORRIGIDO -->
        <div class="grid grid-cols-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($pdfs as $pdf)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 hover:shadow-lg transition-transform duration-300 flex flex-col h-full">
                    <!-- Capa do livro -->
                    <div class="relative pt-[140%]">
                        <img src="{{ asset('storage/' . $pdf->image_path . '.jpg') }}" 
                             alt="Capa do livro {{ $pdf->title }}" 
                             class="absolute top-0 left-0 w-full h-full object-contain cursor-pointer"
                             onclick="openBookPopup('{{ $pdf->title }}', '{{ $pdf->author }}', '{{ $pdf->description }}', '{{ asset('storage/' . $pdf->file_path) }}', '{{ asset('storage/' . $pdf->image_path . '.jpg') }}')">
                    </div>
                    <!-- Detalhes do livro -->
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex-grow">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $pdf->title }}</h3>
                            <p class="text-gray-600">por {{ $pdf->author }}</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ asset('storage/' . $pdf->file_path) }}" download class="block w-full">
                                <button class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
                                    Baixar PDF
                                </button>
                            </a>
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
                        <a id="popup-download-pdf" href="#" download
                           class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg flex items-center gap-2 transition">
                            <i class="fas fa-download"></i>
                            Baixar PDF
                        </a>
                        
                        <button onclick="closePopup()"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-lg transition">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Outros popups -->
    <div id="login-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <!-- ... conteúdo do popup de login ... -->
    </div>
    
    <div id="epub-dev-popup" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-[60] hidden">
        <!-- ... conteúdo do popup EPUB ... -->
    </div>

@endsection