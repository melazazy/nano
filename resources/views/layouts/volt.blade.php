<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ __('messages.direction') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.title') }}</title>

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- Core CSS -->
    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/lang.css') }}" />

</head>

<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="{{ route('home') }}">
            <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/light.svg') }}"
                alt="{{ __('messages.title') }}" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="{{ __('messages.toggle_navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ asset('assets/img/team/profile-picture-3.png') }}"
                            class="card-img-top rounded-circle border-white" alt="User Photo">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">{{ __('messages.hello') }}, {{ Auth::user()->name }}</h2>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                                <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <ul class="nav flex-column pt-3 pt-md-0 p-1">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('assets/img/brand/light.svg') }}" height="20" width="20"
                                alt="Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">{{ __('messages.home') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('messages.dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">
                    <a href="{{ route('notifications') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">{{ __('messages.notifications') }}</span>
                    </a>
                </li>


                @if (Auth::user()->is_admin)
                    <li class="nav-item {{ request()->routeIs('dmin.*') ? 'active' : '' }}">
                        <a href="{{ route('manage.admin') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2h-8zm3 4h6v4h-6V6zm6 6h-6v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.manage_admins') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <a href="{{ route('manage.users') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2h-8zm3 4h6v4h-6V6zm6 6h-6v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.manage_users') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <a href="{{ route('manage.services') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2h-8zm3 4h6v4h-6V6zm6 6h-6v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.manage_services') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('requests.*') ? 'active' : '' }}">
                        <a href="{{ route('manage.requests') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2h-8zm3 4h6v4h-6V6zm6 6h-6v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.manage_requests') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.info') ? 'active' : '' }}">
                        <a href="{{ route('company.info') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.company_info') }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item {{ request()->routeIs('manage.requests') ? 'active' : '' }}">
                        <a href="{{ route('manage.requests') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2h-8zm3 4h6v4h-6V6zm6 6h-6v2h6v-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">{{ __('messages.requests') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <main class="content">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown ms-lg-3">
                            <select onchange="window.location.href=this.value"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white">
                                {{-- <option>{{ __('messages.language') }}</option> --}}
                                <option value="{{ route('lang.change', ['lang' => 'en']) }}"
                                    {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('messages.english') }}
                                </option>
                                <option
                                    value="{{ route('lang.change', ['lang' => 'ar']) }}"{{ app()->getLocale() == 'ar' ? 'selected' : '' }}>
                                    {{ __('messages.arabic') }}</option>
                            </select>
                        </li>
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="{{ asset('assets/img/team/profile-picture-3.png') }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span
                                            class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <!-- dashboard Dropdown - User information -->
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('messages.profile') }}
                                </a>
                                <div role="separator" class="dropdown-divider my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <svg class="dropdown-icon text-danger me-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        {{ __('messages.logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="py-4">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>
    <!-- Core JavaScripts -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets/js/volt.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @livewireScripts
</body>

</html>
