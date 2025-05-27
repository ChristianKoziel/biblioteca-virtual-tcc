@extends('layouts.app')
@section('head')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-100 py-4 sm:py-8">
    <div class="max-w-6xl mx-auto px-2 sm:px-4 lg:px-8">
        <!-- Cabeçalho do Perfil -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Banner do Perfil -->
            <div class="h-32 sm:h-48 bg-gradient-to-r from-indigo-500 to-blue-600 relative">
                @if(Auth::user()->avatar)
                <div class="absolute -bottom-12 sm:-bottom-16 left-3 sm:left-6">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                         alt="Avatar" 
                         class="h-24 w-24 sm:h-32 sm:w-32 rounded-full border-4 border-white shadow-lg object-cover">
                </div>
                @endif
            </div>
            
            <!-- Informações do Usuário -->
            <div class="pt-16 sm:pt-20 px-3 sm:px-6 pb-4 sm:pb-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start space-y-3 sm:space-y-0">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl sm:text-3xl font-bold text-gray-800 truncate">{{ Auth::user()->name }}</h1>
                        <p class="text-sm sm:text-base text-gray-600 truncate">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->bio)
                        <p class="mt-2 text-sm sm:text-base text-gray-700 line-clamp-3">{{ Auth::user()->bio }}</p>
                        @endif
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('profile.edit') }}" 
                           class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-indigo-600 text-white text-sm sm:text-base rounded-lg hover:bg-indigo-700 transition text-center block">
                            Editar Perfil
                        </a>
                    </div>
                </div>
                
                <!-- Estatísticas -->
                <div class="mt-4 sm:mt-6 flex justify-center sm:justify-start">
                    <div class="text-center">
                        <span class="block text-xl sm:text-2xl font-bold text-indigo-600">{{ $books->total() }}</span>
                        <span class="text-sm sm:text-base text-gray-600">Livros Cadastrados</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Seção dos Livros do Usuário -->
        <div class="mt-6 sm:mt-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 px-1">Meus Livros</h2>
            
            @if($books->isEmpty())
            <div class="bg-white rounded-lg shadow p-4 sm:p-6 text-center mx-1 sm:mx-0">
                <p class="text-gray-600 text-sm sm:text-base">Você ainda não cadastrou nenhum livro.</p>
                <a href="{{ route('share.pdf') }}" 
                   class="mt-3 sm:mt-4 inline-block px-4 py-2 bg-indigo-600 text-white text-sm sm:text-base rounded-lg hover:bg-indigo-700 transition">
                   Compartilhar meu primeiro livro
                </a>
            </div>
            @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 px-1 sm:px-0">
                @foreach($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-32 sm:h-48">
                        <img src="{{ asset('storage/' . $book->image_path.'.jpg') }}" 
                             alt="Capa do livro {{ $book->title }}" 
                             class="absolute h-full w-full object-cover">
                    </div>
                    <div class="p-2 sm:p-4">
                        <h3 class="font-bold text-sm sm:text-lg text-gray-800 truncate">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-xs sm:text-sm truncate">{{ $book->author }}</p>
                        <div class="mt-2 sm:mt-3 flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full truncate max-w-full">
                                {{ $book->category }}
                            </span>
                            <div class="flex justify-center sm:justify-end space-x-2 sm:space-x-2">
                                <button onclick="downloadBook({{ $book->id }})" 
                                   class="action-btn text-indigo-600 hover:text-indigo-800 p-1 sm:p-2" 
                                   title="Download">
                                   📥
                                </button>
                                <button onclick="openEditModal({{ $book->id }})"
                                    class="action-btn text-blue-600 hover:text-blue-800 p-1 sm:p-2"
                                    title="Editar">
                                    ✏️
                                </button>
                                <button 
                                    onclick="confirmDelete({{ $book->id }}, '{{ addslashes($book->title) }}')"
                                    class="action-btn text-red-600 hover:text-red-800 p-1 sm:p-2"
                                    title="Excluir">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Paginação -->
            <div class="mt-4 sm:mt-6 px-1 sm:px-0">
                {{ $books->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de Edição - Otimizado para Mobile -->
<div id="editBookModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-2 sm:p-4">
    <div class="bg-white rounded-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
        <!-- Header do Modal -->
        <div class="sticky top-0 bg-white border-b border-gray-200 px-4 sm:px-6 py-3 sm:py-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Editar Livro</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Conteúdo do Modal -->
        <div class="px-4 sm:px-6 py-4">
            <form id="editBookForm">
                @csrf
                <input type="hidden" id="editBookId" name="id">
                
                <div class="space-y-4">
                    <div>
                        <label for="editTitle" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" id="editTitle" name="title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    
                    <div>
                        <label for="editAuthor" class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                        <input type="text" id="editAuthor" name="author" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    
                    <div>
                        <label for="editCategory" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                        <select id="editCategory" name="category" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Selecione uma categoria</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="editDescription" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea id="editDescription" name="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm resize-none"></textarea>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Footer do Modal -->
        <div class="sticky bottom-0 bg-gray-50 border-t border-gray-200 px-4 sm:px-6 py-3 sm:py-4 rounded-b-lg">
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end space-y-2 space-y-reverse sm:space-y-0 sm:space-x-3">
                <button type="button" onclick="closeEditModal()" 
                        class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded-md hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" form="editBookForm"
                        class="w-full sm:w-auto px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
                    Salvar Alterações
                </button>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Popula as categorias no select
document.addEventListener('DOMContentLoaded', function() {
    const categories = [
        'Administração, Negócios e Economia',
        'Arte, Cinema e Fotografia',
        'Artesanato, Casa e Estilo de Vida',
        'Autoajuda',
        'Biografias e Histórias Reais',
        'Ciências',
        'Computação, Informática e Mídias Digitais',
        'Crônicas, Humor e Entretenimento',
        'Direito',
        'Educação, Referência e Didáticos',
        'Engenharia e Transporte',
        'Erótico',
        'Esportes e Lazer',
        'Fantasia, Horror e Ficção Científica',
        'Gastronomia e Culinária',
        'História',
        'HQs, Mangás e Graphic Novels',
        'Infantil',
        'Literatura e Ficção',
        'Medicina',
        'Policial, Suspense e Mistério',
        'Política, Filosofia e Ciências Sociais',
        'Religião e Espiritualidade',
        'Romance',
        'Saúde e Família',
        'Turismo e Guias de Viagem',
        'Inglês e Outras Línguas',
        'Jovens e Adolescentes'
    ];
    
    const select = document.getElementById('editCategory');
    categories.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat;
        option.textContent = cat;
        select.appendChild(option);
    });
});

function downloadBook(bookId) {
    window.location.href = `/books/${bookId}/download`;
}

function confirmDelete(bookId, bookTitle) {
    Swal.fire({
        title: 'Tem certeza?',
        html: `Você está prestes a excluir o livro <strong>"${bookTitle}"</strong>. Esta ação não pode ser desfeita!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        // Configurações para mobile
        width: '90%',
        customClass: {
            popup: 'swal-mobile'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            deleteBook(bookId);
        }
    });
}

function deleteBook(bookId) {
    Swal.fire({
        title: 'Excluindo...',
        html: 'Por favor, aguarde',
        allowOutsideClick: false,
        showConfirmButton: false,
        width: '90%',
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/books/${bookId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Excluído!',
                text: data.message,
                icon: 'success',
                width: '90%',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
        } else {
            Swal.fire({
                title: 'Erro!',
                text: data.message || 'Ocorreu um erro ao excluir o livro.',
                icon: 'error',
                width: '90%'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Erro!',
            text: 'Falha na comunicação com o servidor.',
            icon: 'error',
            width: '90%'
        });
        console.error('Error:', error);
    });
}

function openEditModal(bookId) {
    Swal.fire({
        title: 'Carregando...',
        allowOutsideClick: false,
        showConfirmButton: false,
        width: '90%',
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/books/${bookId}/edit`)
        .then(response => response.json())
        .then(book => {
            Swal.close();
            
            document.getElementById('editBookId').value = book.id;
            document.getElementById('editTitle').value = book.title;
            document.getElementById('editAuthor').value = book.author;
            document.getElementById('editDescription').value = book.description || '';
            document.getElementById('editCategory').value = book.category;
            
            document.getElementById('editBookModal').classList.remove('hidden');
            
            // Previne scroll do body quando modal está aberto
            document.body.style.overflow = 'hidden';
        })
        .catch(error => {
            Swal.fire({
                title: 'Erro!', 
                text: 'Não foi possível carregar os dados do livro.',
                icon: 'error',
                width: '90%'
            });
            console.error('Error:', error);
        });
}

function closeEditModal() {
    document.getElementById('editBookModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Fecha modal ao clicar fora dele
document.getElementById('editBookModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

document.getElementById('editBookForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const bookId = document.getElementById('editBookId').value;
    
    Swal.fire({
        title: 'Salvando...',
        allowOutsideClick: false,
        showConfirmButton: false,
        width: '90%',
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/books/${bookId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500,
                width: '90%'
            }).then(() => {
                closeEditModal();
                window.location.reload();
            });
        } else {
            Swal.fire({
                title: 'Erro!', 
                text: data.message || 'Erro ao atualizar o livro.',
                icon: 'error',
                width: '90%'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Erro!', 
            text: 'Falha na comunicação com o servidor.',
            icon: 'error',
            width: '90%'
        });
        console.error('Error:', error);
    });
});

// Previne zoom no iOS ao focar inputs
document.addEventListener('DOMContentLoaded', function() {
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.fontSize = '16px';
            });
        });
    }
});
</script>

<style>
    .action-btn {
        transition: all 0.2s ease;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        min-height: 32px;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
        background-color: rgba(0,0,0,0.05);
    }
    
    /* Melhorias para mobile */
    @media (max-width: 640px) {
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* SweetAlert responsivo */
        .swal-mobile {
            font-size: 14px !important;
        }
        
        /* Modal responsivo */
        #editBookModal .max-h-\[90vh\] {
            max-height: 90vh;
        }
        
        /* Melhoria para inputs no iOS */
        input, select, textarea {
            font-size: 16px !important;
        }
    }
    
    /* Scroll suave para modal */
    #editBookModal {
        backdrop-filter: blur(2px);
    }
    
    /* Animação suave para modal */
    #editBookModal:not(.hidden) {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
@endsection