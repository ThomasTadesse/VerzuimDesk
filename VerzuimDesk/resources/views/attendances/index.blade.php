<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Aanwezigheid') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Aanwezigheidsregistraties</h3>
                        <a href="{{ route('attendances.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Nieuwe Aanwezigheid Registreren
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
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Datum</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Student</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Docent</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Vak</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Groep</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Aanwezig %</th>
                                    <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-700 text-left">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->student->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->teacher->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->subject->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->group->name }}</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">{{ $attendance->present_percentage }}%</td>
                                        <td class="px-4 py-2 border-b border-gray-300 dark:border-gray-700">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('attendances.show', $attendance) }}" class="text-blue-500 hover:text-blue-700 p-1" title="Bekijken">
                                                    ⓘ
                                                </a>
                                                <a href="{{ route('attendances.edit', $attendance) }}" class="text-yellow-500 hover:text-yellow-700 p-1" title="Bewerken">
                                                    ✎
                                                </a>
                                                <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
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
                                        <td colspan="7" class="px-4 py-2 text-center">Geen aanwezigheidsregistraties gevonden.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
