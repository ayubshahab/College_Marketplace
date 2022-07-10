{{-- layout serves as the base template for all pages --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        {{-- for ajax post calls  CSRF token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>College Marketplace</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        {{-- for tiny slider --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
        

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

        {{-- for alpine js --}}
        {{-- for flash message --}}
        <script src="//unpkg.com/alpinejs" defer></script>

        {{-- css for the homepage and all other general styling--}}
        <link rel="stylesheet" types ="text/css" href="/css/styles.css" />

        {{-- for carousel --}}
        <link rel="stylesheet" types ="text/css" href="/css/carousel.css">

        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>    

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <header style="height: 70px; width: 100%; position: relative;">
            {{-- import the navigation bar --}}
            @include('partials._navigationBar')
        </header>
        {{-- <div class="loading-page" id='loading-page'>
            <div class="loading-icon">
                <i class="fa fa-spinner fa-spin" style=" color:var(--red-accent-color);"></i>
            </div>
        </div> --}}

        <div class="loader-wrapper">
            <span class="loader">
                <span class="loader-inner">
                </span>
            </span>
        </div>

        <x-flash-message />
        {{-- this is body where anything can be shown --}}
        {{-- search results, default listings, and etc --}}

        {{$slot}}
        
        {{-- the footer section --}}
        @include('partials._footer')

         <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
            function displayLoadingPage(){
                var page = document.getElementById('loading-page');
                page.style.display="flex";
            }

            window.addEventListener('change', (event) => {
                document.getElementById('loading-page');
                page.style.display='none';
            });
            window.addEventListener('load', (event) => {
                document.getElementById('loading-page');
                page.style.display='none';
            });
            $(document).ready(function(){
            $(window).on("load",function(){
                $(".loader-wrapper").fadeOut("slow");
            });
            });

        </script>
    </body>
</html>
