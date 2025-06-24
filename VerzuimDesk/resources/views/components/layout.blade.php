<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portaal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main class="container mx-auto mt-6 px-6">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow"></div>
    @include('layouts.footer')
</body>

</html>