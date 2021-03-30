<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DodoTracking') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Chart -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <main class="grid gap-x-8 gap-y-8 grid-cols-12 py-8 md:py-12 px-8 justify-center md:px-12 ">
            @if(session('registration-success')) 
                <div class="w-full  col-span-12 md:col-span-12">
                    <x-alert-success >{{ session('registration-success') }}</x-alert-success>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
</body>

</html>
