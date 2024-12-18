
<nav x-data="{ isScrolled: false, isOpen: false }" @scroll.window="isScrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-gray-800 shadow-lg': isScrolled, 'bg-transparent': !isScrolled }"
    class="fixed w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                Creative<span class="text-primary-red">{{ __('messages.services') }}</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-white hover:text-primary-red transition-colors">{{ __('messages.home') }}</a>
                <a href="#services" class="text-white hover:text-primary-red transition-colors">{{ __('messages.services') }}</a>
                <a href="#about" class="text-white hover:text-primary-red transition-colors">{{ __('messages.about') }}</a>
                <a href="#contact" class="text-white hover:text-primary-red transition-colors">{{ __('messages.contact') }}</a>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-white hover:text-primary-red transition-colors">
                                {{ __('messages.hello') }} {{ Auth::user()->name }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            {{-- home page dropdown --}}
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg">
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
                        <a href="{{ route('login') }}" class="text-white hover:text-primary-red transition-colors">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}"
                            class="text-white hover:text-primary-red transition-colors">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Navigation Button -->
            <button @click="isOpen = !isOpen" class="md:hidden focus:outline-none text-white"
                aria-label="{{ __('messages.toggle_navigation') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.home') }}</a>
                <a href="#services"
                    class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.services') }}</a>
                <a href="#about" class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.about') }}</a>
                <a href="#contact"
                    class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.contact') }}</a>

                <!-- Mobile Auth Links -->
                <div class="pt-4 border-t border-gray-700 space-y-2">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center text-white hover:text-primary-red transition-colors w-full">
                                {{ __('messages.hello') }} {{ Auth::user()->name }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg">
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
                        <a href="{{ route('login') }}"
                            class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}"
                            class="block bg-primary-red text-white px-6 py-2 rounded-full hover:bg-secondary-red transition-colors text-center mx-3">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
