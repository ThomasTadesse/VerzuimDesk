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
            <a href="{{ route('students.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">Students</a>
            <a href="{{ route('teachers.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">Teachers</a>
            <a href="{{ route('subjects.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">Subjects</a>
            <a href="{{ route('groups.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">Groups</a>
            <a href="{{ route('attendances.index') }}" class="text-gray-900 hover:bg-sky-500 px-3 py-2 rounded-md text-sm font-medium">Attendance</a>
        </nav>
    </div>
    @endauth
    
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