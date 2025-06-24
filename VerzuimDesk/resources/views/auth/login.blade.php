<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <h1 class="text-2xl font-bold text-center mb-8 text-gray-800">Welcome to VerzuimDesk</h1>
    
    <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="w-full">
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium mb-1" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </span>
                <x-text-input id="email" class="block p-3 pl-10 w-full border-gray-200 rounded-lg focus:ring-sky-400 focus:border-sky-400 transition-all duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')"
                    placeholder="your@email.com"
                    required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="w-full">
            <div class="flex justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-1" />
                @if (Route::has('password.request'))
                    <a class="text-sm text-sky-500 hover:text-sky-700 hover:underline transition duration-200"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </span>
                <x-text-input id="password" class="block p-3 pl-10 w-full border-gray-200 rounded-lg focus:ring-sky-400 focus:border-sky-400 transition-all duration-200" 
                    type="password" 
                    name="password" 
                    required
                    placeholder="••••••••"
                    autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-sky-500 shadow-sm focus:border-sky-400 focus:ring focus:ring-sky-400 focus:ring-opacity-50 transition duration-200"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full px-6 py-3.5 text-white bg-gradient-to-r from-sky-400 to-sky-500 hover:from-sky-500 hover:to-sky-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-semibold text-center transform hover:scale-[1.02] active:scale-[0.98]">
                {{ __('Sign In') }}
            </button>
        </div>

        <div class="text-center text-sm mt-6">
            <span class="text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-sky-500 hover:text-sky-700 hover:underline ml-1 font-medium">
                Register now
            </a>
        </div>
    </form>
</x-guest-layout>
