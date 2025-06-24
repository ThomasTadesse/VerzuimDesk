<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Welcome to VerzuimDesk</h1>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-6 max-w-md mx-auto bg-gray-50 !bg-gray-50 p-6 rounded-lg shadow">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-semibold mb-2 block" />
            <div class="flex items-center">
                <span class="flex items-center mr-3">
                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <x-text-input id="email"
                    class="block w-full py-3 px-4 border border-gray-200 rounded-lg focus:ring-sky-400 focus:border-sky-400 transition-all duration-200"
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="your@email.com"
                    required
                    autofocus
                    autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-sky-500 hover:text-sky-700 hover:underline transition duration-200">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center">
                <span class="flex items-center mr-3">
                    <svg class="w-5 h-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <x-text-input id="password"
                    class="block w-full py-3 px-4 border border-gray-200 rounded-lg focus:ring-sky-400 focus:border-sky-400 transition-all duration-200"
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox"
                   class="rounded border-gray-300 text-sky-500 shadow-sm focus:ring-sky-400 focus:ring-opacity-50 transition duration-200"
                   name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-600 cursor-pointer">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit"
                    class="w-full px-6 py-3 text-white bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 active:scale-95 font-semibold">
                {{ __('Sign In') }}
            </button>
        </div>

        <!-- Register -->
        <div class="text-center text-sm mt-6">
            <span class="text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}"
               class="text-sky-500 hover:text-sky-700 hover:underline font-medium ml-1">
                {{ __('Register now') }}
            </a>
        </div>
    </form>
</x-guest-layout>
