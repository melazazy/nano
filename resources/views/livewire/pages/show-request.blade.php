@extends('layouts.app')

@section('title', __('messages.request') . ' #' . $request->id)

@push('styles')
    <style>
        /* Header Styles */
        .s-header {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .header__wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navigation {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav__menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .menu__link {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .menu__link:hover {
            color: #E53935;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            min-width: 200px;
            z-index: 50;
        }

        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #1a1a1a;
            text-decoration: none;
            transition: background 0.3s;
        }

        .dropdown-item:hover {
            background: #f5f5f5;
        }

        /* Service Card Styles */
        .service-card {
            padding-top: 5rem;
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin: 2rem auto;
            max-width: 1200px;
            display: flex;
            gap: 2rem;
        }

        .service-image {
            /* width: 50%; */
            height: 500px;
            object-fit: cover;
        }

        .service-content {
            width: 50%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .service-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .service-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .status-active {
            background-color: #E8F5E9;
            color: #2E7D32;
        }

        .service-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .service-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            flex: 1;
            padding: 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-whatsapp {
            background-color: #4CAF50;
            color: white;
        }

        .btn-whatsapp:hover {
            background-color: #388E3C;
        }

        .btn-request {
            background-color: #E53935;
            color: white;
        }

        .btn-request:hover {
            background-color: #C62828;
        }

        @media (max-width: 768px) {
            .service-card {
                flex-direction: column;
            }

            .service-image,
            .service-content {
                width: 100%;
            }

            .service-image {
                height: 300px;
            }

            .service-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="s-header">
            <div class="container mx-auto px-4">
                <div class="header__wrapper">
                    <div class="brand-logo">
                        <a href="/" class="block"
                            style="background-image: url({{ asset('assets/goldenspeed/logo.png') }}); width: 150px; height: 50px; background-position: right; background-size: contain; background-repeat: no-repeat;">
                            <span class="sr-only">{{ __('messages.welcome') }}</span>
                        </a>
                    </div>

                    <nav class="navigation">
                        <ul class="nav__menu">
                            <li class="menu__item">
                                <a href="/" class="menu__link">{{ __('messages.home') }}</a>
                            </li>

                        </ul>
                        @auth
                            <div style="margin: auto auto auto 0!important;" class="position-relative" x-data="{ open: false }">
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
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
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
                        @else
                            <ul class="nav__menu animate" data-animation="fadeInUpShort" data-duration="1900"
                                style="margin: auto auto auto 0!important;">
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
                        <li class="nav-item dropdown ms-lg-3">
                            <select onchange="window.location.href=this.value"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white">
                                <option value="{{ route('lang.change', ['lang' => 'en']) }}"
                                    {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('messages.english') }}
                                </option>
                                <option
                                    value="{{ route('lang.change', ['lang' => 'ar']) }}"{{ app()->getLocale() == 'ar' ? 'selected' : '' }}>
                                    {{ __('messages.arabic') }}</option>
                            </select>
                        </li>

                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8 !important">
            <div class="service-card">
                <div class="service-content">
                    @if ($request->service->image_url)
                        <img src="{{ asset('storage/services/images/' . $request->service->image_url) }}"
                            alt="{{ $request->service->name }}" class="service-image">
                    @endif
                </div>
                <div class="service-content">
                    <h1 class="service-title">
                        @if (app()->getLocale() === 'en')
                            {{ $request->service->en_name }}
                        @else
                            {{ $request->service->ar_name }}
                        @endif
                        <span class="text-2xl font-bold text-danger">#{{ $request->id }}</span>
                    </h1>

                    <div class="service-status {{ $request->status === 'active' ? 'status-active' : 'status-inactive' }}">
                        <i class="{{ $request->service->icon }}"></i>
                        {{ ucfirst(__('messages.' . $request->status)) }}
                    </div>
                    <div class="service-status }}">
                        <h3>{{ __('messages.price') }} {{ $request->price }} {{ __('messages.aed') }}</h3>
                    </div>

                    <p class="service-description">
                        @if (app()->getLocale() === 'en')
                            {!! nl2br(e($request->service->en_description)) !!}
                        @else
                            {!! nl2br(e($request->service->ar_description)) !!}
                        @endif
                    </p>


                    @if ($request->documents && is_string($request->documents))
                        @php
                            $documents = json_decode($request->documents, true);
                        @endphp
                    @else
                        @php
                            $documents = $request->documents;
                        @endphp
                    @endif

                    <!-- Price Offer Documents Section -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">{{ __('messages.price_offer_documents') }}</h3>
                        <div class="space-y-4">
                            @if ($priceOfferDocuments->isNotEmpty() || count($legacyDocuments) > 0)
                                <!-- New Documents from documents table -->
                                @foreach ($priceOfferDocuments as $document)
                                    <div class="bg-white p-4 rounded-lg shadow-sm flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ Storage::url($document->file_url) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download mr-1"></i>
                                                    {{ __('messages.download') }}
                                                </a>
                                            </div>
                                        </div>
                                @endforeach
                            @else
                                <p class="text-gray-500">{{ __('messages.no_documents_uploaded') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Service Files Section -->
                    <div class="related-files mt-4">
                        <h3 class="text-lg font-semibold mb-3">{{ __('messages.related_files') }}</h3>
                        {{-- @if ($request->service->files && count($request->service->files) > 0) --}}
                        @if ($documents && count($documents) > 0)

                            <div class="file-list space-y-2">
                                {{-- @foreach ($request->service->files as $file) --}}
                                @foreach ($documents as $document)
                                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded-md">

                                        <a href="{{ url(asset('/storage/' . $document)) }}" target="_blank"
                                            class="btn btn-sm btn-download bg-blue-500 text-info px-3 py-1 rounded hover:bg-blue-600 transition-colors">
                                            <i class="fas fa-download mr-1"></i>
                                            {{ __('messages.download') }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('messages.no_related_files') }}</p>
                        @endif
                    </div>

                </div>
                <div>
                    <p class="text-center">
                        <a href="{{ route('manage.requests') }}" class=" btn btn-primary ">
                            {{ __('messages.back_to_requests') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="s-footer">
            <div class="container">
                <div class="footer__wrap">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.rights') }}</p>
                </div>
            </div>
        </footer>

    </div>
@endsection
