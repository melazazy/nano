@extends('layouts.app')

@section('title', __('messages.title'))

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}
    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            z-index: 100;
        }

        .whatsapp-float img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .whatsapp-float:hover img {
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .services__item:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, #001f3d 0, #000000 100%);
            opacity: 0;
            transition: .5s;
            z-index: 0;
            box-shadow: 0 0 25px rgba(0, 0, 0, .5);
        }
    </style>
@endpush

@section('content')
    <div>
        <!-- WhatsApp Floating Button -->
        <a href="https://wa.me/{{ $phoneNumber }}" class="whatsapp-float" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon">
        </a>

        <!-- Loader -->
        <div class="loader-first">
            <div>
                <img src="{{ asset('assets/goldenspeed/loader.png') }}" alt="Loader" style="width: 80%;margin:auto;">
            </div>
        </div>

        <!-- Header -->
        <header class="s-header">
            <div class="container">
                <div class="header__wrapper">
                    <div class="brand-logo animate" data-animation="fadeInUpShort" data-duration="1000">
                        <a style="background-image: url({{ asset('assets/goldenspeed/logo.png') }});width: 150px;background-position: right;"
                            href="/">
                            <span class="sr-only">{{ __('messages.welcome') }}</span>
                        </a>
                    </div>
                    <div class="toggle-menu">
                        <a href="javascript:">
                            <span></span><span></span><span></span><span></span>
                        </a>
                    </div>
                    <nav class="navigation">
                        {{-- home links --}}
                        <ul id="menu-menu-1-arabic" class="nav__menu animate">
                            <li class='menu__item '>
                                <a href='/'
                                    class='menu__link anchor--hover  active  menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1427 current_page_item'>{{ __('messages.home') }}
                                </a>
                            </li>
                            <li class='menu__item '>
                                <a href='#about'
                                    class='menu__link anchor--hover  menu-item menu-item-type-post_type menu-item-object-page'>{{ __('messages.about') }}</a>
                            </li>
                            <li class='menu__item '>
                                <a href='#services'
                                    class='menu__link anchor--hover  menu-item menu-item-type-post_type menu-item-object-page'>{{ __('messages.services') }}</a>
                            </li>
                            <li class='menu__item '>
                                <a href='#contactus'
                                    class='menu__link anchor--hover  menu-item menu-item-type-post_type menu-item-object-page'>{{ __('messages.contact') }}</a>
                            </li>
                        </ul>
                        {{-- social icons --}}
                        <ul class="social-wrap animate" data-animation="fadeInUpShort" data-duration="1600">
                            <li>
                                <a href="https://twitter.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/twitter-w.svg') }}" alt="Twitter" height="24"
                                        width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/insta-w.svg') }}" alt="Instagram" height="24"
                                        width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/linkedin-w-01.svg') }}" alt="LinkedIn"
                                        height="24" width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/facebook-w-01.svg') }}" alt="Facebook"
                                        height="24" width="24">
                                </a>
                            </li>
                        </ul>
                        {{-- auth dropdown --}}
                        @auth
                            <div style="margin: auto auto auto 0!important;" class="position-relative text-center" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="menu__link dropdown hover:text-primary-red transition-colors">
                                    {{ Auth::user()->name }}
                                    <svg class="icon" style="height: 20px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="position-absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg z-10">
                                    @if (Auth::user()->is_admin)
                                        <a href="{{ route('dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                    @else
                                        <a href="{{ route('dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('messages.dashboard') }}
                                        </a>
                                        <a href="{{ route('profile') }}"
                                            class="block py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('messages.profile') }}
                                        </a>
                                    @endif

                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- guest link --}}
                        @else
                            <ul style="margin: auto auto auto 0!important;" class="nav__menu" data-animation="fadeInUpShort"
                                data-duration="1900">
                                <li class="menu__item">
                                    <a href="{{ route('login') }}"
                                        class='menu__link anchor--hover  menu-item menu-item-type-post_type menu-item-object-page'>{{ __('messages.login') }}</a>
                                </li>
                                <li class="menu__item">
                                    <a href="{{ route('register') }}"
                                        class='menu__link anchor--hover  menu-item menu-item-type-post_type menu-item-object-page'>{{ __('messages.register') }}</a>
                                </li>
                            </ul>
                        @endauth
                        {{-- Languages switch --}}
                        <ul class="lang-switcher animate" data-animation="fadeInUpShort" data-duration="1900">
                            <select onchange="window.location.href=this.value"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white">
                                <option value="{{ route('lang.change', ['lang' => 'en']) }}"{{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('messages.english') }}
                                </option>
                                <option value="{{ route('lang.change', ['lang' => 'ar']) }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>{{ __('messages.arabic') }}
                                </option>
                            </select>
                        </ul>

                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="section section--hero">
                <div class="dotted"></div>
                <div class="hero__img"></div>
                <div class="hero__caption">
                    <div class="container">
                        <div class="inner-container" style="padding: 0">
                            <div class="hero__title">
                                <h1 class="animate" style="margin-bottom: 0px;" data-animation="fadeInUpShort"
                                    data-duration="2300">
                                    <span>
                                        {{ __('messages.welcome') }}
                                    </span>
                                    <br>
                                    <span>
                                        {{ __('messages.innovators') }}
                                    </span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- About Section -->
            <section class="section section--about" style="padding: 0;" id="about">
                <div class="block vision-mission--block" style="padding: 0">
                    <div class="container">
                        <div class="inner-container" style="padding: 80px 0;">
                            <div class="sec-header">
                                <h1 class="head-line text-center animate" data-animation="fadeInUpShort"
                                    data-duration="200">{{ __('messages.about') }}</h1>
                                <p>
                                    {{ __('messages.about_description') }}
                                </p>
                            </div>
                            <div class="twocol-row">
                                <div class="row__col">
                                    <div class="text-wrap mission--wrap">
                                        <h3 class="heading-line animate" data-animation="fadeInUpShort"
                                            data-duration="600">
                                            {{ __('messages.mission') }}</h3>
                                        <p class="animate" data-animation="fadeInUpShort" data-duration="800">
                                            {{ __('messages.mission_description') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row__col">
                                    <div class="text-wrap vision--wrap">
                                        <div class="sec-header">
                                            <h3 class="heading-line animate" data-animation="fadeInUpShort"
                                                data-duration="200">{{ __('messages.vision') }}</h3>
                                            <p class="animate" data-animation="fadeInUpShort" data-duration="400">
                                                <span></span>
                                            </p>
                                        </div>
                                        <p class="animate" data-animation="fadeInUpShort" data-duration="600">
                                            {{ __('messages.vision_description') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="sec-header">
                                <h1 class="head-line text-center animate" data-animation="fadeInUpShort"
                                    data-duration="200">{{ __('messages.why_choose_us') }}</h1>
                                <p>
                                    {{ __('messages.why_choose_us_description') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section class="section section--services" id="services">
                <div class="container">
                    <div class="service__wrapper">
                        <div class="inner-container">
                            <div class="sec-header">
                                <p class="head-line animate" style="color: white" data-animation="fadeInUpShort"
                                    data-duration="200">{{ __('messages.services') }}</p>
                            </div>

                            <ul class="services__list">
                                {{-- @dd($services) --}}
                                @foreach ($services as $service)
                                    <li class="services__item cursor-pointer"
                                        onclick="window.location.href='{{ route('services.show', ['locale' => app()->getLocale(), 'service' => $service['id']]) }}'">
                                        <div class="service__icon home__service animate" data-animation="fadeInUpShort"
                                            data-duration="300"></div>
                                        <h3 class="animate" data-animation="fadeInUpShort" data-duration="500">
                                            {{ $service['title'] }}
                                        </h3>
                                        <p class="animate" data-animation="fadeInUpShort" data-duration="700">
                                            {{ $service['description'] }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            @php
            $contactInfo = \App\Models\CompanyData::first(); // Retrieve the first record from the info table
            // @dd($contactInfo);
            // Default values if no record is found
            $phone = $contactInfo->phone ?? '+971503418180';
            $email = $contactInfo->email ?? 'goldenspeed55@gmail.com';
            $headquarters = $contactInfo->headquarters ?? __('messages.headquarters');
            $uae_location = $contactInfo->uae_location ?? __('messages.uae_abu_dhabi');
        @endphp
            <!-- Contact Section -->
            <section class="section section--contact gray--back" id="contactus">
                <div class="container">
                    <div class=" bg-white">
                        <div class="row__col">
                            <div class="contact-wrap">
                                <div class="inner-container">
                                    <p class="head-line animate" data-animation="fadeInUpShort" data-duration="300">
                                        {{ __('messages.contact') }}</p>
                                    <h4 class="animate" data-animation="fadeInUpShort" data-duration="700">
                                        {{ __('messages.headquarters') }}<br>{{ __('messages.uae_abu_dhabi') }}</h4>
                                    <p class="add-wrap animate" data-animation="fadeInUpShort" data-duration="700">
                                        <span><a class="anchor--hover" href="tel:{{ $phone }}"></a></span>
                                    </p>

                                    <p class="add-wrap animate" data-animation="fadeInUpShort" data-duration="700">
                                        {{ __('messages.contact_center') }} <span><a class="anchor--hover"
                                            href="tel:{{ $phone }}">{{ $phone }}</a></span></p>
                                    <p class="add-wrap animate" data-animation="fadeInUpShort" data-duration="700">
                                        {{ __('messages.email_us') }} <span><a class="anchor--hover"
                                            href="mailto:{{ $email }}">{{ $email }}</a></span>
                                    </p>
                                    <ul class="social-wrap animate" data-animation="fadeInUpShort" data-duration="1600">
                                        <li>
                                            <a href="https://twitter.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/twitter-w.svg') }}" alt="Twitter"
                                                    height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/insta-w.svg') }}" alt="Instagram"
                                                    height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/company/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/linkedin-w-01.svg') }}"
                                                    alt="LinkedIn" height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/facebook-w-01.svg') }}"
                                                    alt="Facebook" height="24" width="24">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="s-footer">
            <div class="container">
                <div class="footer__wrap">
                    <p class="animate" data-animation="fadeInUpShort" data-duration="200"> 2024
                        {{ __('messages.all_rights_reserved') }}</p>
                    <p class="animate" data-animation="fadeInUpShort" data-duration="200">
                        <a href="https://nanots.ae">
                            <img src="{{ asset('assets/goldenspeed/nts.ico') }}" alt="" style="width: 80px;">
                            Powered By NTS
                        </a>
                    </p>
                </div>
            </div>
        </footer>
    </div>
@endsection
