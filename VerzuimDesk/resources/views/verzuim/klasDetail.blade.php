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
<h2 class="text-2xl font-semibold mb-4">Verzuimgegevens voor klas {{ $klas }}</h2>

<div class="mb-6">
    <canvas id="klasChart" height="120"></canvas>
</div>

<p class="mb-4 font-medium">Gemiddeld verzuim in deze klas: <strong>{{ $gemiddelde }} uur</strong></p>

<table class="w-full table-auto border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2 text-left">Leerling</th>
            <th class="border px-4 py-2 text-right">Verzuim (uren)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studenten as $student)
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2">{{ $student->leerling }}</td>
                <td class="border px-4 py-2 text-right">{{ $student->totaal_verzuim }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="/select-klas" class="mt-6 inline-block text-blue-500 hover:underline">← Terug naar klasselectie</a>

            </div>
        </div>
    </div>

</x-layout>


<script>
    const ctx = document.getElementById('klasChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($studenten->pluck('leerling')) !!},
            datasets: [{
                label: 'Verzuimuren',
                data: {!! json_encode($studenten->pluck('totaal_verzuim')) !!},
                backgroundColor: '#60a5fa',
                borderColor: '#2563eb',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Uren verzuim'
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 60,
                        minRotation: 45
                    }
                }
            }
        }
    });
</script>