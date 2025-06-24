<header class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-1 py-1 bg-sky-400 custom-shadow">
    <div class="flex">
        <a href="{{ url('/') }}">
            <svg class="h-14 w-auto mr-6 ml-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold">Portaal</h1>
            <p class="text-sm text-gray-700">VerzuimDesk</p>
        </div>
    </div>

    @auth
    <div class="flex-grow flex justify-center">
        <nav class="hidden md:flex space-x-4">
            <a href="{{ route('students.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">{{ __('messages.students') }}</a>
            <a href="{{ route('teachers.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">{{ __('messages.teachers') }}</a>
            <a href="{{ route('subjects.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">{{ __('messages.subjects') }}</a>
            <a href="{{ route('groups.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">{{ __('messages.groups') }}</a>
            <a href="{{ route('attendances.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">{{ __('messages.attendance') }}</a>
        </nav>
    </div>
    @endauth
    
    <div class="mr-6 flex items-center">
        @auth
            <a href="{{ url('/profile') }}" class="text-lg font-semibold text-black hover:text-gray-600">{{ __('messages.profile') }}</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="ml-4 text-lg font-semibold text-black hover:text-gray-600">{{ __('messages.logout') }}</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="text-lg font-semibold text-black hover:text-gray-600">{{ __('messages.login') }}</a>
        @endauth

        <!-- Language Toggle -->
        <div class="flex items-center space-x-2 ml-4">
            <span class="text-sm font-medium">EN</span>
            <button id="language-toggle" class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200"
                onclick="toggleLanguage()"
                aria-checked="{{ app()->getLocale() === 'nl' ? 'true' : 'false' }}">
                <span class="sr-only">Toggle language</span>
                <span class="toggle-dot inline-block h-4 w-4 transform rounded-full bg-white transition {{ app()->getLocale() === 'nl' ? 'translate-x-6' : 'translate-x-1' }}"></span>
            </button>
            <span class="text-sm font-medium">NL</span>
        </div>
    </div>
</header>

<script>
    function toggleLanguage() {
        const toggle = document.getElementById('language-toggle');
        const dot = toggle.querySelector('.toggle-dot');
        const currentLang = toggle.getAttribute('aria-checked') === 'true' ? 'nl' : 'en';
        const newLang = currentLang === 'nl' ? 'en' : 'nl';
        
        // Toggle the dot position
        if (currentLang === 'nl') {
            dot.classList.remove('translate-x-6');
            dot.classList.add('translate-x-1');
            toggle.setAttribute('aria-checked', 'false');
        } else {
            dot.classList.remove('translate-x-1');
            dot.classList.add('translate-x-6');
            toggle.setAttribute('aria-checked', 'true');
        }
        
        // Set a cookie to remember the language preference
        document.cookie = `language=${newLang};path=/;max-age=31536000`;
        
        // Reload the page to apply the language change
        window.location.href = "{{ route('language.switch', [], false) }}?lang=" + newLang;
    }
</script>