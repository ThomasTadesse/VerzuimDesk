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

<h2 class="text-xl font-bold mb-4">Selecteer een klas om het gemiddelde verzuim te bekijken</h2>

<form action="" method="GET" onsubmit="window.location.href='/klas/' + this.klas.value; return false;">
    <select name="klas" id="klas" class="...">
        @foreach($klassen as $klas)
            <option value="{{ $klas }}">{{ $klas }}</option>
        @endforeach
    </select>
    <button type="submit" class="...">Bekijk verzuim</button>
</form>

            </div>
        </div>
    </div>
</x-layout>
