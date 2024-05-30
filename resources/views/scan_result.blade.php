<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <h3 class="w-full bg-emerald-500 inline-flex justify-center p-5 text-white text-lg">Hasil Scan</h3>
        <div class="w-full flex flex-col justify-center items-center p-5">
            {{ $data }}

            <a href="{{ route('scan') }}" class="bg-emerald-500 text-white font-bold py-2 px-4 rounded-md mt-10">Scan Ulang</a>
        </div>

    </body>
</html>