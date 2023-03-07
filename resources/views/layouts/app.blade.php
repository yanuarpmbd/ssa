<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/images/lambang-bpk.png')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles
    @livewireScripts
    @stack('scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="flex items-center justify-center bg-fixed bg-auto" style="background-image: url({{asset('/images/G.png')}})">
    {{ $slot }}
    @livewire('notifications')
</body>

</html>