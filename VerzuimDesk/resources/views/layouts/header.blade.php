<header class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center px-1 py-1 bg-sky-400 custom-shadow">
    <div class="flex">
        <a href="{{ url('/') }}"><img class="h-14 w-auto mr-6 ml-6" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&amp;shade=600"></a>
        <div>
            <h1 class="text-2xl font-bold">Portaal</h1>
            <p class="text-sm text-gray-700">VerzuimDesk</p>
        </div>
        <a href="{{ url('/verzuim/import') }}" class="ml-6 mt-3 text-lg font-semibold text-black hover:text-gray-600">Importeren</a>
        <a href="{{ url('/verzuim/upload') }}" class="ml-6 mt-3 text-lg font-semibold text-black hover:text-gray-600">Uploaden</a>
        <a href="{{ url('/verzuim/resultaat') }}" class="ml-6 mt-3 text-lg font-semibold text-black hover:text-gray-600">zoeken</a>
        <a href="{{ url('/verzuim/select') }}" class="ml-6 mt-3 text-lg font-semibold text-black hover:text-gray-600">inzagen</a>
    </div>
    <div class="mr-6">
        @auth
            <a href="{{ url('/profile') }}" class="text-lg font-semibold text-black hover:text-gray-600">Profiel</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="ml-4 text-lg font-semibold text-black hover:text-gray-600">Uitloggen</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="text-lg font-semibold text-black hover:text-gray-600">Inloggen</a>
        @endauth
    </div>
</header>