<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Studenten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Alle Studenten</h3>
                        <a href="{{ route('students.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Nieuwe Student Toevoegen
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Filter section -->
                    <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="font-medium mb-2">Filter Studenten</h4>
                        <form action="{{ route('students.index') }}" method="GET" class="flex flex-wrap gap-4">
                            <div class="w-full md:w-auto">
                                <label for="search" class="block text-sm mb-1">Zoeken</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    placeholder="Naam of studentnummer..." 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600">
                            </div>
                            <div class="w-full md:w-auto">
                                <label for="age_group" class="block text-sm mb-1">Leeftijdsgroep</label>
                                <select name="age_group" id="age_group" class="w-full px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600">
                                    <option value="">Alle leeftijdsgroepen</option>
                                    <option value="<18" {{ request('age_group') === '<18' ? 'selected' : '' }}>Jonger dan 18</option>
                                    <option value="18-22" {{ request('age_group') === '18-22' ? 'selected' : '' }}>18 t/m 22 jaar</option>
                                    <option value="23+" {{ request('age_group') === '23+' ? 'selected' : '' }}>23 en ouder</option>
                                </select>
                            </div>
                            <div class="w-full md:w-auto flex items-end">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Filteren
                                </button>
                                @if(request()->has('search') || request()->has('age_group'))
                                    <a href="{{ route('students.index') }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Card layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($students as $student)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-600">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">{{ $student->name }}</h3>
                                    <div class="mb-2 text-sm">
                                        <span class="font-semibold">Studentnummer:</span> {{ $student->student_number }}
                                    </div>
                                    <div class="mb-4 text-sm">
                                        <span class="font-semibold">Leeftijdsgroep:</span> {{ $student->age_group }}
                                    </div>
                                    <div class="flex justify-end space-x-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                        <a href="{{ route('students.show', $student) }}" class="text-blue-500 hover:text-blue-700 p-1" title="Bekijken">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('students.edit', $student) }}" class="text-yellow-500 hover:text-yellow-700 p-1" title="Bewerken">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Verwijderen">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full p-4 text-center bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <p>Geen studenten gevonden.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
