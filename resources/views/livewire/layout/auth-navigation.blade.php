<nav class=" shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('home') }}" class="text-2xl font-bold">
                {{ __('messages.title') }}
            </a>


            <div class="hidden md:flex items-center space-x-8">
                <ul class="lang-switcher text-black animate" data-animation="fadeInUpShort" data-duration="1900">
                    <select onchange="window.location.href=this.value"
                        class="rounded-md py-2  ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20]">
                        <option value="{{ route('lang.change', ['lang' => 'en']) }}"{{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('messages.english') }}
                        </option>
                        <option value="{{ route('lang.change', ['lang' => 'ar']) }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>{{ __('messages.arabic') }}
                        </option>
                    </select>
                </ul>
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center hover:bg-gray-100 transition-colors">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- profile dropdown -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-lg">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('messages.dashboard') }}
                            </a>

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
                @endauth
            </div>

            <div class="md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="text-white hover:text-primary-red">
                    <svg class="h-6 w-6" x-show="!isOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="isOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="md:hidden" x-show="isOpen">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @auth
                    @if (Auth::user()->is_admin)
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.dashboard') }}</a>
                        <a href="{{ route('services.manage') }}"
                            class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.manage_services') }}</a>
                    @endif
                    <a href="{{ route('profile') }}"
                        class="block px-3 py-2 text-white hover:text-primary-red transition-colors">{{ __('messages.profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-3 py-2 text-white hover:text-primary-red transition-colors">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>


