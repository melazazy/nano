<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;


new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(['email' => $this->email]);

        // $status = Password::sendResetLink(
        //     $this->only('email')
        // );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
};

?>

<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
    <div class="container">
        <p class="text-center">
            <a href="{{ route('home') }}" class="d-flex align-items-center justify-content-center">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                {{ __('messages.back_to_homepage') }}

            </a>
        </p>
        <div class="row justify-content-center form-bg-image" data-background-lg="{{ asset('assets/img/illustrations/forgot-password.svg') }}" style="background: url({{ asset('assets/img/illustrations/forgot-password.svg') }});">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">{{ __('messages.forgot_password') }}</h1>
                        <p class="text-gray">{{ __('messages.enter_email_to_reset_password') }}</p>
                    </div>

                    <form wire:submit="sendPasswordResetLink" class="mt-4">
                        <div class="form-group mb-4">
                            <label for="email">{{ __('messages.email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                </span>
                                <input wire:model="email" type="email" class="form-control" placeholder="example@company.com" required>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('messages.send_reset_link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
