<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Bem-vindo de volta!</h2>
        <p class="text-gray-600">Faça login para acessar seus livros</p>
    </div>
    
    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div class="relative">
            <x-text-input 
                id="email" 
                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 peer" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="email"
                placeholder=" " 
            />
            <label for="email" class="absolute left-4 top-4 text-gray-500 transition-all duration-300 peer-focus:-translate-y-5 peer-focus:scale-85 peer-focus:text-indigo-600 peer-[:not(:placeholder-shown)]:-translate-y-5 peer-[:not(:placeholder-shown)]:scale-85">
                <i class="fas fa-envelope mr-2"></i>{{ __('E-mail') }}
            </label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="relative">
            <x-text-input 
                id="password" 
                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 peer"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder=" "
            />
            <label for="password" class="absolute left-4 top-4 text-gray-500 transition-all duration-300 peer-focus:-translate-y-5 peer-focus:scale-85 peer-focus:text-indigo-600 peer-[:not(:placeholder-shown)]:-translate-y-5 peer-[:not(:placeholder-shown)]:scale-85">
                <i class="fas fa-lock mr-2"></i>{{ __('Senha') }}
            </label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembrar de mim & Esqueci a senha -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        </div>

        <!-- Botão de Login -->
        <x-primary-button class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white py-4 rounded-xl font-semibold text-lg shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <i class="fas fa-sign-in-alt mr-2"></i>
            {{ __('Entrar') }}
        </x-primary-button>
    </form>
    
    <!-- Link para Cadastro -->
    <div class="text-center mt-6 pt-6 border-t border-gray-200">
        <p class="text-gray-600">
            Não tem uma conta? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                Cadastre-se gratuitamente
            </a>
        </p>
    </div>
</x-guest-layout>