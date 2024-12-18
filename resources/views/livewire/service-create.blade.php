<div class="container mt-5">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-3 text-center text-gray-800">
                {{ $serviceId ? __('messages.edit_service') : __('messages.create_service') }}
            </h1>

            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form
                action="{{ $serviceId ? route('services.edit', ['locale' => app()->getLocale(), 'id' => $serviceId]) : route('create.service', ['locale' => app()->getLocale()]) }}"
                wire:submit.prevent="save" class="mt-4">
                {{-- show data come from livewire using dd() function --}}
                    {{-- @dd($this); --}}

                <!-- Service Name -->
                <div class="form-group mb-4">
                    <label for="en_name" class="form-label">{{ __('messages.english_name') }} <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="en_name-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.28a2 2 0 01-1.17 1.83l-3.83 1.92a2 2 0 00-1 1.75V16a1 1 0 01-1 1h-6a1 1 0 01-1-1v-1.42a2 2 0 00-1-1.75l-3.83-1.92A2 2 0 012 11.28V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input id="en_name" type="text" wire:model="en_name"
                            class="form-control rounded @error('en_name') is-invalid @enderror"
                            placeholder="{{ __('messages.enter_english_name') }}" required aria-describedby="en_nameError"
                            maxlength="255">
                    </div>
                    @error('en_name')
                        <div id="en_nameError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group mb-4">
                    <label for="en_description" class="form-label">{{ __('messages.english_description') }} <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="en_description-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <textarea id="en_description" wire:model="en_description" class="form-control rounded @error('en_description') is-invalid @enderror"
                            rows="4" placeholder="{{ __('messages.english_service_description') }}" required aria-describedby="en_descriptionError"
                            maxlength="1000"></textarea>
                    </div>
                    @error('en_description')
                        <div id="en_descriptionError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Arabic Name -->
                <div class="form-group mb-4">
                    <label for="ar_name" class="form-label">{{ __('messages.arabic_name') }} <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="ar_name-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.28a2 2 0 01-1.17 1.83l-3.83 1.92a2 2 0 00-1 1.75V16a1 1 0 01-1 1h-6a1 1 0 01-1-1v-1.42a2 2 0 00-1-1.75l-3.83-1.92A2 2 0 012 11.28V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input id="ar_name" type="text" wire:model="ar_name"
                            class="form-control rounded @error('ar_name') is-invalid @enderror"
                            placeholder="{{ __('messages.enter_arabic_name') }}" required aria-describedby="ar_nameError"
                            maxlength="255">
                    </div>
                    @error('ar_name')
                        <div id="ar_nameError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Arabic Description -->
                <div class="form-group mb-4">
                    <label for="ar_description" class="form-label">{{ __('messages.arabic_description') }} <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="ar_description-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <textarea id="ar_description" wire:model="ar_description" class="form-control rounded @error('ar_description') is-invalid @enderror"
                            rows="4" placeholder="{{ __('messages.arabic_service_description') }}" required aria-describedby="ar_descriptionError"
                            maxlength="1000"></textarea>
                    </div>
                    @error('ar_description')
                        <div id="ar_descriptionError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image File -->
                <div class="form-group mb-4">
                    <label for="image" class="form-label">{{ __('messages.service_image') }}
                        ({{ __('messages.optional') }})</label>
                    <input type="file" id="image" wire:model="image"
                        class="form-control rounded @error('image') is-invalid @enderror" accept="image/*">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($existingImage)
                        <div class="mt-2">
                            <img src="{{ Storage::url('services/images/' . $existingImage) }}"
                                alt="{{ __('messages.existing_service_image') }}" class="img-thumbnail"
                                style="max-width: 200px;">
                        </div>
                    @endif
                    @if ($image)
                        <div class="mt-2">
                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <!-- Status -->
                <div class="form-group mb-4">
                    <label for="status" class="form-label">{{ __('messages.status') }} <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="status-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                        <select id="status" wire:model="status"
                            class="form-control rounded @error('status') is-invalid @enderror" required
                            aria-describedby="statusError">
                            <option value="">{{ __('messages.select_status') }}</option>
                            <option value="active">{{ __('messages.active') }}</option>
                            <option value="inactive">{{ __('messages.inactive') }}</option>
                        </select>
                    </div>
                    @error('status')
                    <div id="statusError" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                    {{-- Titles  --}}
                    <div class="form-group mb-4">
                        <label for="file_count" class="form-label">{{ __('messages.file_count') }} <span class="text-danger">*</span></label>
                        <input id="file_count" type="number" wire:model.live="file_count" class="form-control rounded @error('file_count') is-invalid @enderror" placeholder="{{ __('messages.enter_file_count') }}" required min="0">
                        @error('file_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English File Titles -->
                    <div class="form-group mb-4">
                        <label for="title_en" class="form-label">{{ __('messages.title_en') }} <span class="text-danger">*</span></label>
                        <div id="title_en_container">
                            @for ($i = 0; $i < $file_count; $i++)
                                <input type="text" wire:model="title_en.{{ $i }}" class="form-control mb-2 rounded @error('title_en.' . $i) is-invalid @enderror" placeholder="{{ __('messages.enter_file_title_en') }}" required>
                                @error('title_en.' . $i)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endfor
                        </div>
                    </div>

                    <!-- Arabic File Titles -->
                    <div class="form-group mb-4">
                        <label for="title_ar" class="form-label">{{ __('messages.title_ar') }} <span class="text-danger">*</span></label>
                        <div id="title_ar_container">
                            @for ($i = 0; $i < $file_count; $i++)
                                <input type="text" wire:model="title_ar.{{ $i }}" class="form-control mb-2 rounded @error('title_ar.' . $i) is-invalid @enderror" placeholder="{{ __('messages.enter_file_title_ar') }}" required>
                                @error('title_ar.' . $i)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endfor
                        </div>
                    </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary"
                        :disabled="!isFormValid">
                        <span wire:loading.remove>
                            {{ $serviceId ? __('messages.update_service') : __('messages.create_service') }}
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ __('messages.processing') }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
