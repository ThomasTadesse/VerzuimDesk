<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VerzuimDesk') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: rgb(56, 189, 248);
            --primary-dark: rgb(14, 165, 233);
            --shadow-soft: 0 10px 25px rgba(56, 189, 248, 0.1);
            --shadow-medium: 0 15px 35px rgba(56, 189, 248, 0.15);
        }

        .bg-gradient-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .pattern-bg {
            background-image: 
                radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px),
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px, 40px 40px;
            background-position: 0 0, 20px 20px;
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
                box-shadow: var(--shadow-soft);
            }
            50% {
                transform: translateY(-15px);
                box-shadow: var(--shadow-medium);
            }
            100% {
                transform: translateY(0px);
                box-shadow: var(--shadow-soft);
            }
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="relative min-h-screen w-full pattern-bg flex items-center justify-center overflow-hidden" style="background-color: rgb(56, 189, 248);">
        <div class="absolute inset-0 bg-black opacity-5 pointer-events-none z-0"></div>

        <div class="relative z-10 max-w-lg w-full px-4 sm:px-6">
            <div class="flex flex-col items-center space-y-8">
                <!-- Logo / Avatar -->
                <div class="flex justify-center">
                    <div class="rounded-full bg-white p-6 shadow-lg w-28 h-28 flex items-center justify-center floating-animation">
                        <span class="text-sky-400 font-bold text-4xl tracking-tight">V
                            <svg class="h-6 w-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Content Slot -->
                <div class="w-full bg-white bg-opacity-90 glass-effect shadow-2xl overflow-hidden rounded-2xl border-t-4 border-sky-400 px-8 py-10">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <footer class="text-white text-center text-sm opacity-80 pt-4">
                    &copy; {{ date('Y') }} VerzuimDesk | All Rights Reserved
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
