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
        <script type="text/javascript" src="{{ route("base") }}/js/qrcode.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <div class="w-full bg-emerald-500 inline-flex justify-between p-5 text-white text-lg">
            <h3 class="font-bold">QRCODE INAGURASI</h3>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="cursor-pointer text-sm" :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
        <div class="w-full flex flex-col justify-center items-center p-5">
            <table class="w-full text-center">
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['code'] }}</td>
                        <td>{{ $item['status'] == "unused" ? "Belum Digunakan" : "Sudah Digunakan" }}</td>
                        <td><div id="qr-{{ $item['code'] }}" class="w-[100px] py-5"></div></td>
                    </tr>
                @endforeach
            </table>
            {{ $data->links() }}
        </div>

        
        <script type="text/javascript">
            let page = window.location.href.split("?page=")[1] ?? 1;
            
            let pageData = parseInt(page+"0");
            let data = [page == 1 ? 1 : pageData-9, page == 1 ? 10 : pageData];
            // console.log(data);
            
            for (let n = data[0]; n <= data[1]; n++) {
                var docID ="qr-INA-" + n.toString().padStart(4, "0");

                var code ="INA-" + n.toString().padStart(4, "0");
                var link = "https://tiket.agsa.site/verify/" + btoa(code);
                new QRCode(document.getElementById(docID), link);
            }
        </script>
    </body>
</html>