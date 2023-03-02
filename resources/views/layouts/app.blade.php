<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>

<body class="flex items-center justify-center bg-fixed bg-cover" style="background-image: url({{asset('/images/E.png')}})">
    {{ $slot }}
    @livewire('notifications')
</body>

</html>