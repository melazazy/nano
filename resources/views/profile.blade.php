<x-app-layout>
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
                    <a href="{{ route('profile.edit') }}" class="bg-primary-red text-white px-4 py-2 rounded-md hover:bg-secondary-red transition-colors">
                        {{ __('messages.edit_profile') }}
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Contact Informatioasdsadsadn</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-gray-600">Phone</label>
                                <p class="text-gray-900">{{ Auth::user()->phone }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Address</label>
                                <p class="text-gray-900">{{ Auth::user()->address ?: 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Country</label>
                                <p class="text-gray-900">{{ Auth::user()->country ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Account Details</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-gray-600">Member Since</label>
                                <p class="text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Account Status</label>
                                <p class="text-gray-900">
                                    @if(Auth::user()->email_verified_at)
                                        <span class="text-green-600">Verified</span>
                                    @else
                                        <span class="text-yellow-600">Pending Verification</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-600">Account Type</label>
                                <p class="text-gray-900">
                                    @if(Auth::user()->is_admin)
                                        <span class="text-blue-600">Administrator</span>
                                    @else
                                        <span>Regular User</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
