<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Student Details') }}
            </h2>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-white rounded hover:bg-gray-400">
                Terug naar Studenten
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                        <div class="md:flex">
                            <div class="md:w-1/3 bg-blue-50 dark:bg-gray-700 p-6">
                                <div class="text-center">
                                    <div class="w-32 h-32 rounded-full bg-blue-200 dark:bg-blue-800 mx-auto flex items-center justify-center">
                                        <span class="text-3xl font-bold text-blue-800 dark:text-blue-200">
                                            {{ strtoupper(substr($student->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <h2 class="mt-4 text-xl font-bold">{{ $student->name }}</h2>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $student->student_number }}</p>
                                </div>
                                <div class="mt-6 flex justify-center space-x-2">
                                    <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="md:w-2/3 p-6">
                                <h3 class="text-lg font-semibold border-b pb-2 mb-4">Persoonlijke Informatie</h3>
                                
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Leeftijdsgroep</p>
                                        <p class="font-medium">{{ $student->age_group }}</p>
                                    </div>
                                    
                                    <!-- Absentie grafiek -->
                                    <div class="md:col-span-2 mt-4">
                                        <h4 class="text-sm text-gray-600 dark:text-gray-400 mb-2">Absentie Overzicht</h4>
                                        <div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow-inner">
                                            <canvas id="absenceChart" height="200"></canvas>
                                        </div>
                                    </div>
                                    
                                    @if(isset($student->email))
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                                        <p class="font-medium">{{ $student->email }}</p>
                                    </div>
                                    @endif

                                    @if(isset($student->phone))
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Telefoon</p>
                                        <p class="font-medium">{{ $student->phone }}</p>
                                    </div>
                                    @endif

                                    @if(isset($student->address))
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Adres</p>
                                        <p class="font-medium">{{ $student->address }}</p>
                                    </div>
                                    @endif

                                    @if(isset($student->class))
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Klas</p>
                                        <p class="font-medium">{{ $student->class }}</p>
                                    </div>
                                    @endif
                                </div>

                                @if(isset($student->notes))
                                <div class="mt-6">
                                    <h4 class="font-medium mb-2">Notities</h4>
                                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                        <p>{{ $student->notes }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Verzuim section - if you have absence data -->
                                @if(isset($absences) && count($absences) > 0)
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold border-b pb-2 mb-4">Recente Verzuim</h3>
                                    <div class="space-y-2">
                                        @foreach($absences as $absence)
                                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded flex justify-between">
                                            <div>
                                                <span class="font-medium">{{ $absence->date->format('d-m-Y') }}</span>
                                                <span class="text-sm text-gray-600 dark:text-gray-400 ml-2">{{ $absence->type }}</span>
                                            </div>
                                            <div>
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $absence->is_authorized ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                                    {{ $absence->is_authorized ? 'Geautoriseerd' : 'Ongeautoriseerd' }}
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('absenceChart').getContext('2d');
            
            // Haal data op uit de controller via blade
            const attendanceData = @json($attendanceData ?? []);
            
            // Bereid labels en datasets voor
            const labels = attendanceData.map(item => item.month);
            const authorizedData = attendanceData.map(item => item.excused_absence);
            const unauthorizedData = attendanceData.map(item => item.unexcused_absence);
            
            // Calculate totals for doughnut chart
            const totalAuthorized = authorizedData.reduce((acc, val) => acc + parseFloat(val), 0);
            const totalUnauthorized = unauthorizedData.reduce((acc, val) => acc + parseFloat(val), 0);
            
            // Create two charts side by side
            const absenceChartEl = document.getElementById('absenceChart');
            const absenceChartCtx = absenceChartEl.getContext('2d');
            
            // Configure the stacked bar chart for monthly data
            const stackedBarChart = new Chart(absenceChartCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Geoorloofd Verzuim',
                            data: authorizedData,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Ongeoorloofd Verzuim',
                            data: unauthorizedData,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Verzuimtrend'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y.toFixed(1);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Maand'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Absentie'
                            },
                            ticks: {
                                precision: 1
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
            
            // Add a pie chart after the main chart
            const pieChartContainer = document.createElement('div');
            pieChartContainer.className = 'mt-6';
            pieChartContainer.innerHTML = '<h4 class="text-sm text-gray-600 dark:text-gray-400 mb-2">Verdeling Verzuim</h4><div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow-inner"><canvas id="absencePieChart" height="200"></canvas></div>';
            absenceChartEl.parentNode.parentNode.appendChild(pieChartContainer);
            
            const pieCtx = document.getElementById('absencePieChart').getContext('2d');
            const pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Geoorloofd', 'Ongeoorloofd'],
                    datasets: [{
                        data: [totalAuthorized, totalUnauthorized],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 99, 132, 0.7)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = totalAuthorized + totalUnauthorized;
                                    const percentage = Math.round((context.parsed / total) * 100);
                                    return context.label + ': ' + context.parsed.toFixed(1) + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
