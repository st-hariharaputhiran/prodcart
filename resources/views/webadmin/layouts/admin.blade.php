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
        @vite(['css/app.css', 'js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        

        <div class="min-h-screen bg-gray-100">
        @include('webadmin.layouts.header')

        @include('webadmin.layouts.sidebar')
 
        @yield('content')
        @stack('css')
        @stack('js')
        @include('webadmin.layouts.footer')

            
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
