<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Redefinir Senha</h2>
        <p class="text-gray-600 mt-2">Informe seu e-mail para receber o link de redefinição</p>
    </div>

    <div class="mb-6 p-4 bg-blue-50 text-blue-800 rounded-lg">
        <i class="fas fa-info-circle mr-2"></i>
        {{ __('Esqueceu sua senha? Informe seu e-mail e enviaremos um link para criar uma nova senha.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div class="relative">
            <x-text-input 
                id="email" 
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus
                placeholder="Seu e-mail cadastrado"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700">
            <i class="fas fa-paper-plane mr-2"></i>
            {{ __('Enviar Link de Redefinição') }}
        </x-primary-button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-1"></i>
            {{ __('Voltar para o login') }}
        </a>
    </div>
</x-guest-layout>