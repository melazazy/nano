<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
    <div class="container">
        <p class="text-center">
            <a href="{{ route('home') }}" class="d-flex align-items-center justify-content-center">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                {{ __('messages.back_to_homepage') }}
            </a>
        </p>
        <div class="row justify-content-center form-bg-image" data-background-lg="{{ asset('assets/img/illustrations/signin.svg') }}" style="background: url({{ asset('assets/img/illustrations/signin.svg') }});">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">{{ __('messages.create_account') }}</h1>
                    </div>
                    <form action="{{ route('umanage.users', ['locale' => app()->getLocale()]) }}" wire:submit.prevent="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control" id="name" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" class="form-control" id="email" wire:model="email" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                            <input type="password" class="form-control" id="password" wire:model="password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                            <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>