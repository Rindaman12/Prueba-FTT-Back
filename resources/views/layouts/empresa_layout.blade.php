<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('FTT', 'FTT') }}</title>

    {{-- STYLE --}}
    <link rel="preload" href="{{ mix('css/empresa.css') }}" as="style" onload="this.rel='stylesheet'"><noscript><link rel="stylesheet" href="{{ mix('css/empresa.css') }}"></noscript>
            <!-- Fonts -->
        
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,700,900&amp;subset=latin-ext" rel="stylesheet">
</head>
    

<body>
    <main id="empresa">
        @section('main')
        @show 
    </main>   
    <!-- Scripts -->
    <script src="{{asset('js/manifest.js')}}" defer></script>
    <script src="{{asset('js/vendor.js')}}" defer></script>
    <script src="{{ mix('js/empresa.js') }}" defer></script>
 


</html>
