<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home') }}
            </h2>
            <span class="px-3 py-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
<h2 class="text-xl font-bold mb-4">Upload verzuimgegevens (Excel)</h2>

<form action="{{ route('verzuim.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <input type="file" name="file" class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
        file:rounded-full file:border-0 file:text-sm file:font-semibold
        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>

    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        Uploaden
    </button>
</form>
            </div>
        </div>
    </div>
</x-layout>
