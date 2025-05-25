<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - Bookfy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Editar Livro: {{ $book->title }}</h1>
        
        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" value="{{ $book->title }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div class="mb-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $book->description }}</textarea>
            </div>
            
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Categoria</label>
                <select name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="{{ $book->category }}">{{ $book->category }}</option>
                    <!-- Adicione outras categorias aqui -->
                </select>
            </div>
            
            <div class="mb-4">
                <label for="pdf_file" class="block text-sm font-medium text-gray-700">Arquivo PDF (opcional)</label>
                <input type="file" name="pdf_file" id="pdf_file" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>