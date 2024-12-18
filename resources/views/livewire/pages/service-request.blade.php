<div class="container mx-auto mt-2">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-3 text-center text-gray-800">{{ __('messages.request_service') }}</h1>

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

            <form action="{{ route('request.service', ['locale' => app()->getLocale()]) }}" wire:submit.prevent="submit"
                class="mt-4">
                <!-- Service Selection -->
                <div class="form-group mb-4">
                    <label for="service">{{ __('messages.service_name') }}</label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="service-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.28a2 2 0 01-1.17 1.83l-3.83 1.92a2 2 0 00-1 1.75V16a1 1 0 01-1 1h-6a1 1 0 01-1-1v-1.42a2 2 0 00-1-1.75l-3.83-1.92A2 2 0 012 11.28V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <select wire:model.live="service_id" class="form-control rounded"
                            placeholder="{{ __('messages.select_service') }}" required>
                            <option value="">{{ __('messages.select_service') }}</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id == $service_id ? 'selected' : '' }}>
                                    @if (app()->getLocale() == 'en')
                                        {{ $service->en_name }}
                                    @else
                                        {{ $service->ar_name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                </div>
                {{-- @dd($this); --}}
                {{-- <!-- Document Upload -->
                <div class="form-group mb-4">
                    <label for="documents">{{ __('messages.documents') }}</label>
                    <div class="input-group">
                        <span class="input-group-text rounded" id="documents-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input id="attachfile" type="file" wire:model="documents" multiple
                            class="form-control rounded" placeholder="{{ __('messages.choose_files') }}">
                    </div>
                    @if ($errors->has('documents.*'))
                        @foreach ($errors->get('documents.*') as $err)
                            <x-input-error :messages="$err" class="mt-2" />
                        @endforeach
                    @endif
                </div> --}}


                <!-- File Uploads with Titles -->
                <div class="form-group mb-4">
                    @if ($this->filesCount > 0)<label>{{ __('messages.required_documents') }}</label>  <br /> @endif
                    @for ($i = 0; $i < $this->filesCount; $i++)
                    {{-- @dd($this); --}}
                        <label for="document_{{ $i }}">
                            {{ app()->getLocale() == 'ar' ? $title_ar[$i] : $title_en[$i] }} <span class="text-danger">*</span>
                        </label>
                        <input type="file" wire:model="documents.{{ $i }}"
                            class="form-control mb-2 rounded @error('documents.' . $i) is-invalid @enderror"
                            id="document_{{ $i }}" required>
                        @error('documents.' . $i)
                            <x-input-error :messages="$message" class="mt-2" />
                        @enderror
                    @endfor
                </div>

                <!-- Notes -->
                <div class="form-group mb-4">
                    <label for="notes">{{ __('messages.notes') }}</label>
                    <div class="input-group rounded">
                        <span class="input-group-text rounded" id="notes-addon">
                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.6 8.25a1.5 1.5 0 0 0-1.5 1.5v6a1.5 1.5 0 0 0 1.5 1.5h4a1.5 1.5 0 0 0 1.5-1.5v-6a1.5 1.5 0 0 0-1.5-1.5h-4zm-10 0A1.5 1.5 0 0 0 2.1 9.75v6a1.5 1.5 0 0 0 1.5 1.5h4a1.5 1.5 0 0 0 1.5-1.5v-6a1.5 1.5 0 0 0-1.5-1.5h-4z" />
                                <path
                                    d="M13.6 9.75a.75.75 0 0 0-.75-.75h-4a.75.75 0 0 0-.75.75V16.5c0 .414.336.75.75.75h4a.75.75 0 0 0 .75-.75V9.75zM3.6 9.75a.75.75 0 0 0-.75-.75h-4a.75.75 0 0 0-.75.75V16.5c0 .414.336.75.75.75h4a.75.75 0 0 0 .75-.75V9.75z" />
                            </svg>
                        </span>
                        <textarea wire:model="notes" class="form-control rounded" rows="4" placeholder="{{ __('messages.notes') }}"></textarea>
                    </div>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" wire:loading.attr="disabled" class="btn btn-primary">
                        <span wire:loading.remove>{{ __('messages.request') }}</span>
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
