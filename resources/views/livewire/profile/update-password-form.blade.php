<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Volt\Component;

new 
class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
}; ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ __('messages.update_password') }}</h1>

        <form wire:submit="updatePassword" class="space-y-6">
            <div class="form-group mb-4">
                <label for="current_password">{{ __('messages.current_password') }}</label>
                <div class="input-group">
                    <input type="password" 
                        class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" 
                        wire:model="current_password" 
                        placeholder="{{ __('messages.current_password') }}"
                        required>
                    @error('current_password')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password">{{ __('messages.new_password') }}</label>
                <div class="input-group">
                    <input type="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        id="password" 
                        wire:model="password" 
                        placeholder="{{ __('messages.new_password') }}"
                        required>
                    @error('password')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                <div class="input-group">
                    <input type="password" 
                        class="form-control" 
                        id="password_confirmation"
                        wire:model="password_confirmation"
                        placeholder="{{ __('messages.confirm_password') }}"
                        required>
                </div>
            </div>

            <div class=" form-group flex space-x-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    {{ __('messages.cancel') }}
                </a>
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('messages.save') }}</x-primary-button>

                    <x-action-message class="me-3" on="password-updated">
                        {{ __('messages.saved') }}
                    </x-action-message>
                </div>
            </div>
        </form>
    </div>
</div>