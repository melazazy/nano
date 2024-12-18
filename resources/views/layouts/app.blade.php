<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="home" > --}}
        <html lang="{{ app()->getLocale() }}" dir="{{ __('messages.direction') }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- jQuery (load first) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Conditionally include RTL CSS for Arabic -->
    <!-- Scripts -->
    <!-- Goldenspeed Assets -->
    <link rel="stylesheet" href="{{ asset('css/goldenspeed.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/lang.css') }}" />
    {{-- @if (app()->getLocale() === 'ar')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif --}}
</head>
<body style="font-size:13px;">
    @hasSection('content')
        @yield('content')
    @else
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}

                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot ?? '' }}
            </main>
        </div>
    @endif

    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Initialize slick carousel
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 3000
            });

            // Initialize animations
            $('.animated').addClass('animate__animated');
            $('.fadeInUpShort').addClass('animate__fadeInUp');

            // Scroll animations
            $(window).scroll(function() {
                $('.fadeInUpShort').each(function() {
                    var elementPos = $(this).offset().top;
                    var topOfWindow = $(window).scrollTop();
                    var windowHeight = $(window).height();

                    if (elementPos < topOfWindow + windowHeight - 50) {
                        $(this).addClass("animate__animated animate__fadeInUp");
                    }
                });
            });

            // Loader animation
            setTimeout(function() {
                $('.loader-first').fadeOut();
            }, 1000);
        });
    </script>
</body>
</html>
