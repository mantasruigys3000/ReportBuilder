<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Report builder</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script src="https://kit.fontawesome.com/657ce564b8.js" crossorigin="anonymous"></script>

        @livewireStyles
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>


        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-300">

            <!-- Page Heading -->
{{--            @if (isset($header))--}}
{{--                <header class="bg-white shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}
            <div class=" z-50 fixed bg-white flex flex-row justify-between items-center pr-2 w-full  ">
                <div class="" >
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <div class="flex flex-row items-center ">
                    <p class="mx-2 font-bold">Hello {{auth()->user()->name}}</p>
                    <a class="px-2 py-1 font-bold bg-red-500 text-white rounded-md" href="/logoutuser">logout</a>
                </div>
            </div>

            <livewire:sidebar-navbar ></livewire:sidebar-navbar>


            <!-- Page Content -->
            <main class="pl-48 pt-16 relative ">
                <div class="  px-4 py-4 ">
                    <div class=" px-4 py-4  ">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
