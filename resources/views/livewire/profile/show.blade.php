<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center space-x-4 mb-6">
            <div class="flex-shrink-0">
                <!-- User Avatar -->
                <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-2xl text-gray-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
            </div>
            <div class="ml-auto">
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue transition-colors">
                    {{ __('messages.edit_profile') }}
                </a>
            </div>
            {{-- <div class="ml-auto">
                <a href="{{ route('profile.update-password') }}" class="bg-primary-red text-white px-4 py-2 rounded-md hover:bg-secondary-red transition-colors">
                    {{ __('messages.update_password') }}
                </a>
            </div> --}}
            <div class="ml-auto">
                <a href="{{ route('profile.update-password') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                    {{ __('messages.update_password') }}
                </a>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ __('messages.contact_information') }}</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-600">{{ __('messages.phone') }}</label>
                            <p class="text-gray-900">{{ Auth::user()->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">{{ __('messages.address') }}</label>
                            <p class="text-gray-900">{{ Auth::user()->address ?: __('messages.not_provided') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">{{ __('messages.country') }}</label>
                            <p class="text-gray-900">{{ Auth::user()->country ?: __('messages.not_provided') }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ __('messages.account_details') }}</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-600">{{ __('messages.member_since') }}</label>
                            <p class="text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                        </div>
                        {{-- <div>
                            <label class="text-sm text-gray-600">{{ __('messages.account_status') }}</label>
                            <p class="text-gray-900">
                                @if(Auth::user()->email_verified_at)
                                    <span class="text-green-600">{{ __('Verified') }}</span>
                                @else
                                    <span class="text-yellow-600">{{ __('Pending Verification') }}</span>
                                @endif
                            </p>
                        </div> --}}
                        <div>
                            <label class="text-sm text-gray-600">{{ __('messages.account_type') }}</label>
                            <p class="text-gray-900">
                                @if(Auth::user()->is_admin)
                                    <span class="text-blue-600">{{ __('messages.administrator') }}</span>
                                @else
                                    <span>{{ __('messages.regular_user') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
