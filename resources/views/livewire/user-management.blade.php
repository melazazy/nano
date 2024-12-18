<section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
    <div class="container d-flex justify-content-center h-100 overflow-scroll">
        <div class="row justify-content-center form-bg-image">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">
                            {{ $userId ? __('messages.edit_user') : __('messages.create_user') }}
                        </h1>
                    </div>

                    {{-- @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session('message') }}
                        </div>
                    @endif --}}

                    <form action="{{ route('manage.users', ['locale' => app()->getLocale()]) }}"
                        wire:submit.prevent="createOrUpdateUser">
                        <div class="form-group mb-4">
                            <label for="name">{{ __('messages.name') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" wire:model="name" placeholder="{{ __('messages.enter_users_name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">{{ __('messages.email') }}</label>
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" wire:model="email"
                                    placeholder="{{ __('messages.example_company_com') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone">{{ __('messages.phone_number_optional') }}</label>
                            <div class="input-group">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" wire:model="phone"
                                    placeholder="{{ __('messages.enter_phone_number') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- @if (!$userId) --}}
                        <div class="form-group mb-4">
                            <label for="password">{{ __('messages.password') }}</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" wire:model="password" placeholder="{{ __('messages.password') }}"
                                    @if (!$userId) required @endif>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    wire:model="password_confirmation"
                                    placeholder="{{ __('messages.confirm_password') }}"
                                    @if (!$userId) required @endif>
                            </div>
                        </div>
                        {{-- @endif --}}

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="country">{{ __('messages.country_optional') }}</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    id="country" wire:model="country"
                                    placeholder="{{ __('messages.enter_country') }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-4">
                                <label for="postal_code">{{ __('messages.postal_code_optional') }}</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                    id="postal_code" wire:model="postal_code"
                                    placeholder="{{ __('messages.enter_postal_code') }}">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="role">{{ __('messages.user_role') }}</label>
                            <div class="input-group">
                                <select class="form-control @error('role') is-invalid @enderror" id="role"
                                    wire:model="role" required>
                                    <option value="user" selected>{{ __('messages.user') }}</option>
                                    <option value="admin">{{ __('messages.admin') }}</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ $userId ? __('messages.update_user') : __('messages.create_user') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
