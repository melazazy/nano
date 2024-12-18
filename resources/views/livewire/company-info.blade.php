<div class="container">
    <h1>{{ __('messages.edit_company_info') }}</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="form-group mb-3">
            <label for="name_en">{{ __('messages.company_name_en') }}</label>
            <input type="text" class="form-control" id="name_en" wire:model="name_en" required>
        </div>

        <div class="form-group mb-3">
            <label for="name_ar">{{ __('messages.company_name_ar') }}</label>
            <input type="text" class="form-control" id="name_ar" wire:model="name_ar" required>
        </div>

        <div class="form-group mb-3">
            <label for="address_en">{{ __('messages.company_address_en') }}</label>
            <input type="text" class="form-control" id="address_en" wire:model="address_en" required>
        </div>

        <div class="form-group mb-3">
            <label for="address_ar">{{ __('messages.company_address_ar') }}</label>
            <input type="text" class="form-control" id="address_ar" wire:model="address_ar" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone">{{ __('messages.phone') }}</label>
            <input type="text" class="form-control" id="phone" wire:model="phone">
        </div>

        <div class="form-group mb-3">
            <label for="email">{{ __('messages.email') }}</label>
            <input type="email" class="form-control" id="email" wire:model="email">
        </div>

        <div class="form-group mb-3">
            <label for="website">{{ __('messages.website') }}</label>
            <input type="url" class="form-control" id="website" wire:model="website">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>