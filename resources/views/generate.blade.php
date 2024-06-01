<?php 

$classUsed = "text-xs text-white font-semibold p-2 bg-red-600 rounded-md";
$classUnused = "text-xs text-white font-semibold p-2 bg-emerald-600 rounded-md";

?>

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

        <div class="w-full bg-emerald-600 inline-flex justify-between p-5 text-white text-lg md:px-10">
            <h3 class="font-bold">QR TIKET INAGURASI</h3>
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
        <div class="w-full flex justify-end px-8 mt-10">
            <input id="search" type="text" placeholder="Cari ID Tiket ...">
            <button onclick="search()" class="px-2 bg-emerald-600 text-white md:mr-10">Cari</button>
        </div>
        <table class="w-full text-center table-auto mt-10">
            <thead>
                <tr class="text-xl">
                    <th>NO</th>
                    <th>ID TIKET</th>
                    <th>STATUS</th>
                    <th>QR CODE</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['code'] }}</td>
                    <td>
                        @if ($item['status'] == "unused")
                            <span class="{{ $classUnused }}">Belum Digunakan</span>
                        @else
                            <span class="{{ $classUsed }}">Sudah Digunakan</span>
                        @endif
                    </td>
                    <td class="inline-flex items-center"><div id="qr-{{ $item['code'] }}" class="w-[50px] md:w-[100px] py-5"></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="md:w-full my-5 px-10">
            {{ $data->links() }}
        </div>

        
        <script type="text/javascript">
            // Generate QR Code
            generate();
            function generate(){
                let hasSearch = window.location.href.split("?search=")[1] ?? null;

                if(hasSearch == null || hasSearch == ""){
                    let page = window.location.href.split("?page=")[1] ?? 1;
                    let pageData = parseInt(page+"0");
                    let data = [page == 1 ? 1 : pageData-9, page == 1 ? 10 : pageData];
                    
                    for (let n = data[0]; n <= data[1]; n++) {
                        var docID ="qr-INA-" + n.toString().padStart(4, "0");
        
                        var code ="INA-" + n.toString().padStart(4, "0");
                        var link = "https://inaguration.agsa.site/verify/" + btoa(code);
                        new QRCode(document.getElementById(docID), link);
                    }
                }else{
                    var docID ="qr-" + hasSearch;
                    var link = "https://inaguration.agsa.site/verify/" + btoa(hasSearch);
                    new QRCode(document.getElementById(docID), link);
                }
            }

            // Search
            function search() {
                var value = document.getElementById("search").value.toUpperCase();
                if (value != "") {
                    window.location.href = "/dashboard?search=" + value;
                }
            }
        </script>
    </body>
</html>