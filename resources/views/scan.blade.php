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

        <h3 class="w-full bg-emerald-500 inline-flex justify-center p-5 text-white text-lg">Scan QR Code!</h3>
        <div class="w-full flex justify-center p-5">
            <canvas></canvas>
        </div>
        <div class="w-full flex justify-center p-5">
            <select></select>
        </div>

        <span id="hasil"></span>
        <ul></ul>

        <script type="text/javascript" src="{{ route("base") }}/js/qrcodelib.js"></script>
        <script type="text/javascript" src="{{ route("base") }}/js/webcodecamjs.js"></script>
        <script type="text/javascript">
        	var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
            var arg = {
                resultFunction: function(result) {
                    window.location.href = result.code;
                }
            };

            // for changing camera
            var decoder = new WebCodeCamJS("canvas").buildSelectMenu('select', 'environment|back').init(arg).play();
            
            document.querySelector('select').addEventListener('change', function(){
            	decoder.stop().play();
            });
        </script>

    </body>
</html>