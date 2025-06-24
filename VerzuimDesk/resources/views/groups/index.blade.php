<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Groepen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Alle Groepen</h3>
                        <a href="{{ route('groups.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Nieuwe Groep Toevoegen
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

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Code</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Naam</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groups as $group)
                                    <tr>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $group->code }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $group->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('groups.show', $group) }}" class="text-blue-500 hover:text-blue-700 p-1" title="Bekijken">
                                                    ⓘ
                                                </a>
                                                <a href="{{ route('groups.edit', $group) }}" class="text-yellow-500 hover:text-yellow-700 p-1" title="Bewerken">
                                                    ✎
                                                </a>
                                                <form action="{{ route('groups.destroy', $group) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Verwijderen">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center">Geen groepen gevonden.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $groups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
