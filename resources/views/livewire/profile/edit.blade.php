<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.edit_profile') }}</h1>

        <form wire:submit="updateProfile" class="space-y-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('messages.name') }}</label>
                <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('name') <span class="text-red-600 text-sm">{{ __('messages.name_required') }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('messages.email') }}</label>
                <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('email') <span class="text-red-600 text-sm">{{ __('messages.email_required') }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('messages.phone') }}</label>
                <input wire:model="phone" type="tel" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('phone') <span class="text-red-600 text-sm">{{ __('messages.phone_required') }}</span> @enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">{{ __('messages.address') }}</label>
                <textarea wire:model="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red"></textarea>
                @error('address') <span class="text-red-600 text-sm">{{ __('messages.address_required') }}</span> @enderror
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700">{{ __('messages.country') }}</label>
                <input wire:model="country" type="text" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                @error('country') <span class="text-red-600 text-sm">{{ __('messages.country_required') }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-red hover:bg-secondary-red">
                    {{ __('messages.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</div>