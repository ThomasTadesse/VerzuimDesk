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

   <div class="flex min-h-screen">

     {{-- Main content --}}
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-xl font-semibold">Welkom terug</h1>
            </div>
            <div class="text-sm">
                Datum:  {{ now()->format('d M Y') }}
            </div>
        </div>

        {{-- Sections --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

            <div class="rounded-lg p-4" style="background-color: rgb(56, 189, 248);">
                <h2 class="text-lg font-bold mb-2">Agenda</h2>
                <p class="text-sm text-white/80">Geen activiteiten</p>
            </div>

            <div class="rounded-lg p-4" style="background-color: rgb(56, 189, 248);">
                <h2 class="text-lg font-bold mb-2">Zaken</h2>
                <p class="text-sm text-white/80">Geen zaken met openstaande taken</p>
            </div>

            <div class="rounded-lg p-4 md:col-span-2" style="background-color: rgb(56, 189, 248);">
                <h2 class="text-lg font-bold mb-2">inzicht studenten aanwezigheid</h2>
                <p class="text-sm text-white/80 mb-2">Overzicht huidig collegejaar</p>
                <canvas id="aanwezigChart" height="150"></canvas>
            </div>

        </div>
    </main>
</div>
</div>

</x-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    const ctx = document.getElementById('aanwezigChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Aanwezig', 'Geoorloofd afwezig', 'Ongeoorloofd afwezig'],
            datasets: [{
                data: [75, 15, 10], // Dummy data: 75% aanwezig, 15% geoorloofd afwezig, 10% ongeoorloofd afwezig
                backgroundColor: ['#3b82f6', '#facc15', '#ef4444'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: { color: 'white' }
                }
            }
        }
    });
</script>