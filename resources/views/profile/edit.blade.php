@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header da Edição -->
            <div class="bg-indigo-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Editar Perfil</h2>
                <p class="text-indigo-200">Atualize suas informações pessoais</p>
            </div>
            
            <!-- Formulário -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('patch')

                <!-- Seção Avatar -->
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative group">
                        <div class="avatar-upload">
                            <img id="avatar-preview" 
                                 src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('storage/usuario.png') }}" 
                                 class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg group-hover:opacity-75 transition-opacity">
                            
                            <label for="avatar" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="flex-1 space-y-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        <p class="text-sm text-gray-500">Membro desde {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <!-- Seção Informações Básicas -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações Pessoais</h3>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- Campo Nome -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Campo Email (readonly) -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100" readonly>
                                <p class="mt-1 text-sm text-gray-500">O e-mail não pode ser alterado.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Campo Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Biografia</label>
                        <textarea id="bio" name="bio" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('bio', auth()->user()->bio) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Fale um pouco sobre você e seus interesses literários.</p>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Seção de Ações -->
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('profile.show') }}" 
                       class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview do avatar
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('avatar-preview').src = event.target.result;
                
                // Efeito visual de confirmação
                const avatar = document.getElementById('avatar-preview');
                avatar.classList.add('ring-2', 'ring-green-500');
                setTimeout(() => {
                    avatar.classList.remove('ring-2', 'ring-green-500');
                }, 2000);
            };
            reader.readAsDataURL(file);
        }
    });

    // Validação em tempo real
    document.querySelector('form').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        
        if (!name || !email) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios.');
        }
    });
</script>
@endpush

<style>
.avatar-upload {
    position: relative;
    display: inline-block;
}

.avatar-upload:hover img {
    opacity: 0.8;
}

.avatar-upload label {
    transition: all 0.3s ease;
}
</style>
@endsection