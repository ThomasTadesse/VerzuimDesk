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
                <h1 class="text-3xl font-bold mb-4">Welcome to VerzuimDesk</h1>
                <p class="mb-4">Your comprehensive absence management solution.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 border rounded-lg">
                        <h2 class="text-xl font-semibold mb-2">Quick Links</h2>
                        <ul class="list-disc list-inside">
                            <li>View Absences</li>
                            <li>Report New Absence</li>
                            <li>View Reports</li>
                        </ul>
                    </div>
                    <div class="p-4 border rounded-lg">
                        <h2 class="text-xl font-semibold mb-2">Recent Activity</h2>
                        <p>No recent activities to display.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>