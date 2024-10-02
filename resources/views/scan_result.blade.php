@php
    function dateTime($date){
        $result = Carbon\Carbon::parse($date)->locale('id');
        $result->settings(['formatFunction' => 'translatedFormat']);
        return $result->format('l, j F Y - h:i a');
    }
@endphp

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

        <h3 class="w-full {{ $data['status'] == "used" ? "bg-red-500" : "bg-emerald-500" }} inline-flex justify-center p-5 text-white text-lg">Ticket Verify</h3>

        @if ($data['status'] == 'unused')
            <div class="w-full flex flex-col justify-center items-center p-5 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-48 text-emerald-500">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <span class="text-3xl">Terverifikasi</span>
                <span class="mt-5 text-lg">Tiket anda terdaftar dan berhasil digunakan.</span>
                <span class="mt-5 text-lg font-bold">Waktu Scan</span>
                <span class="text-lg">{{dateTime($data->updated_at)}}</span>
                <span class="mt-14 text-sm">Anda akan dialihkan ke halaman scan ulang dalam 5 detik...</span>
                <span class="text-sm italic text-gray-500">(atau bisa langsung klik tombol dibawah)</span>

                <a href="{{ route('scan') }}" class="bg-emerald-500 text-white font-bold py-2 px-4 rounded-md mt-5">Scan Ulang</a>
            </div>
            <script type="text/javascript">
                window.setTimeout(function(){
                    window.location.href = "/scan";
                }, 5000);
            </script>
        @else
            <div class="w-full flex flex-col justify-center items-center p-5 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-48 text-red-500">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                </svg>
                <span class="text-3xl">Ticket Used</span>
                <span class="mt-5 text-lg">Tiket anda sudah discan dan digunakan.</span>
                <span class="mt-5 text-lg font-bold">Waktu Scan</span>
                <span class="text-lg">{{dateTime($data->updated_at)}}</span>
                <span class="mt-14 text-sm">Jika anda merasa ini salah, silahkan hubungi sekretariat.</span>
                {{-- <span class="text-sm italic text-gray-500">(atau bisa langsung klik tombol dibawah)</span> --}}

                <a href="{{ route('scan') }}" class="bg-emerald-500 text-white font-bold py-2 px-4 rounded-md mt-5">Scan Ulang</a>
            </div>
        @endif

    </body>
</html>