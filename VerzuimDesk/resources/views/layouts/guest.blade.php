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
    <link href="https://fonts.googleapis.com/css2?family=Protest+Guerrilla&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: rgb(56, 189, 248);
            --primary-dark: rgb(14, 165, 233);
            --shadow-soft: 0 10px 25px rgba(56, 189, 248, 0.1);
            --shadow-medium: 0 15px 35px rgba(56, 189, 248, 0.15);
        }
        
        .bg-gradient-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
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
        
        .pattern-bg {
            background-image: 
                radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px),
                radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px, 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        
        .login-container {
            max-width: 460px;
            width: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen w-screen bg-cover bg-center bg-gradient-custom pattern-bg flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-5 pointer-events-none"></div>
        
        <div class="login-container">
            <div class="flex flex-col items-center">
                <div class="mb-8 flex justify-center">
                    <div class="rounded-full bg-white p-5 shadow-lg w-26 h-26 flex items-center justify-center floating-animation">
                        <span class="text-sky-400 font-bold text-4xl tracking-tight">VD</span>
                    </div>
                </div>
                
                <div class="w-full px-8 py-8 bg-white bg-opacity-90 glass-effect shadow-2xl overflow-hidden rounded-2xl border-t-4 border-sky-400">
                    {{ $slot }}
                </div>
                
                <div class="mt-6 text-white text-center text-sm opacity-80">
                    &copy; {{ date('Y') }} VerzuimDesk | All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</body>
</html>
