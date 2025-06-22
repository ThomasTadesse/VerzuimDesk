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
<h2 class="text-2xl font-semibold mb-4">Gemiddeld verzuim voor klas {{ $klas }}</h2>

<div class="mb-6">
    <canvas id="verzuimChart" height="100"></canvas>
</div>

<a href="/select-klas" class="text-blue-500 underline">Terug naar selectie</a>

            </div>
        </div>
    </div>
</x-layout>

<script>
    const ctx = document.getElementById('verzuimChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Gemiddeld verzuim'],
            datasets: [{
                label: '{{ $klas }}',
                data: [{{ $gemiddelde }}],
                backgroundColor: '#3b82f6',
                borderColor: '#1d4ed8',
                borderWidth: 1,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
