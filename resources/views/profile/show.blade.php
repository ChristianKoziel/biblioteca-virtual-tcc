@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho do Perfil -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Banner do Perfil -->
            <div class="h-48 bg-gradient-to-r from-indigo-500 to-blue-600 relative">
                @if(Auth::user()->avatar)
                <div class="absolute -bottom-16 left-6">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                         alt="Avatar" 
                         class="h-32 w-32 rounded-full border-4 border-white shadow-lg object-cover">
                </div>
                @endif
            </div>
            
            <!-- Informações do Usuário -->
            <div class="pt-20 px-6 pb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
                        <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->bio)
                        <p class="mt-2 text-gray-700">{{ Auth::user()->bio }}</p>
                        @endif
                    </div>
                    <a href="{{ route('profile.edit') }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Editar Perfil
                    </a>
                </div>
                
                <!-- Estatísticas -->
                <div class="mt-6 flex space-x-6">
                    <div class="text-center">
                        <span class="block text-2xl font-bold text-indigo-600">{{ $books->total() }}</span>
                        <span class="text-gray-600">Livros Cadastrados</span>
                    </div>
                    <!-- Adicione mais estatísticas conforme necessário -->
                </div>
            </div>
        </div>
        
        <!-- Seção dos Livros do Usuário -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Meus Livros</h2>
            
            @if($books->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600">Você ainda não cadastrou nenhum livro.</p>
                <a href="{{ route('share.pdf') }}" 
                   class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                   Compartilhar meu primeiro livro
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative pb-3/4 h-48">
                        <img src="{{ asset('storage/' . $book->image_path.'.jpg') }}" 
                             alt="Capa do livro {{ $book->title }}" 
                             class="absolute h-full w-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 truncate">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-sm">{{ $book->author }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                                {{ $book->category }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('book.download', $book->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-800" 
                                   title="Download">
                                   📥
                                </a>
                                {{-- <a href="{{ route('books.edit', $book->id) }}" 
                                   class="text-blue-600 hover:text-blue-800" 
                                   title="Editar">
                                   ✏️ --}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Paginação -->
            <div class="mt-6">
                {{ $books->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection