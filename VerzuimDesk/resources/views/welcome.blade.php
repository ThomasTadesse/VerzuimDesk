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
                <div class="text-sm text-white space-y-2 max-h-40 overflow-y-auto">
                    <div class="border-b border-white/20 pb-1">
                        <div class="font-medium">Vandaag, 09:00-10:30</div>
                        <div class="text-white/80">Projectbespreking</div>
                    </div>
                    <div class="border-b border-white/20 pb-1">
                        <div class="font-medium">Morgen, 13:00-14:30</div>
                        <div class="text-white/80">Leerlingengesprekken</div>
                    </div>
                    <div class="border-b border-white/20 pb-1">
                        <div class="font-medium">{{ now()->addDays(3)->format('d M') }}, 11:00-12:00</div>
                        <div class="text-white/80">Teamvergadering</div>
                    </div>
                    <div>
                        <div class="font-medium">{{ now()->addDays(5)->format('d M') }}, 10:00-11:30</div>
                        <div class="text-white/80">Workshop verzuimbeleid</div>
                    </div>
                </div>
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
    // Fetch real attendance data from database
    fetch('/attendance-stats')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('aanwezigChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Aanwezig', 'Geoorloofd afwezig', 'Ongeoorloofd afwezig', 'Niet geregistreerd'],
                    datasets: [{
                        data: [
                            data.present, 
                            data.excused, 
                            data.unexcused,
                            data.unregistered
                        ],
                        backgroundColor: ['#3b82f6', '#facc15', '#ef4444', '#94a3b8'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: { color: 'white' }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching attendance data:', error);
            // Fallback to dummy data if API call fails
            const ctx = document.getElementById('aanwezigChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Aanwezig', 'Geoorloofd afwezig', 'Ongeoorloofd afwezig'],
                    datasets: [{
                        data: [75, 15, 10],
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
        });
</script>