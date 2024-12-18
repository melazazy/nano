<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}" dir="{{ __('messages.direction') }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            $contactInfo = \App\Models\CompanyData::first();
            
        @endphp
        @if (app()->getLocale() == 'ar')
            {{-- @dd($contactInfo); --}}
            <title>{{ $contactInfo->ar_name }}</title>
            @else
            {{-- @dd($contactInfo); --}}
            <title>{{ $contactInfo->en_name }}</title>
        @endif
        {{-- <title>{{ $datainfo->lang == 'ar' ? $datainfo->ar_name : $datainfo->en_name }}</title>
        <title>{{ config('app.name', 'Laravel') }}</title> --}}

        {{-- <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/lang.css') }}" />

    </head>
    <body class="">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.auth-navigation />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
    </body>
</html>
