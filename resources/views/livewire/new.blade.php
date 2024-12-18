<!-- Main Content -->
<div class="container mx-auto px-4 py-8 !important">
    <div class="service-card">
        <div class="service-content">
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            @if ($request->service->image_url)
                <img src="{{ asset('storage/services/images/' . $request->service->image_url) }}"
                    alt="{{ $request->service->name }}" class="service-image">
            @endif

            @if (auth()->user()->is_admin)
                <!-- Update Request Form -->
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.update_request') }}</h3>
                    <form wire:submit.prevent="updateRequest" class="space-y-4">
                        <!-- Status Update -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.status') }}</label>
                            <select wire:model.live="status" class="form-control">
                                <option value="pending">{{ __('messages.pending') }}</option>
                                <option value="active">{{ __('messages.active') }}</option>
                                <option value="in_progress">{{ __('messages.in_progress') }}</option>
                                <option value="completed">{{ __('messages.completed') }}</option>
                                <option value="cancelled">{{ __('messages.cancelled') }}</option>
                            </select>
                        </div>

                        <!-- Price Update -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.price') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number"
                                       wire:model.live="price"
                                       id="price"
                                       step="0.01"
                                       min="0"
                                       class="form-control pl-7"
                                       placeholder="{{ __('messages.enter_price') }}">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="btn btn-primary w-full"
                                wire:loading.attr="disabled"
                                wire:target="updateRequest">
                            <span wire:loading.remove wire:target="updateRequest">
                                {{ __('messages.update_request') }}
                            </span>
                            <span wire:loading wire:target="updateRequest">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                {{ __('messages.updating') }}
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Document Upload Form -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold mb-4">{{ __('messages.price_offer_documents') }}</h3>
                    <form wire:submit.prevent="uploadPriceOffer" class="space-y-4">
                        <div>
                            <input type="file"
                                   wire:model="priceOfferDocument"
                                   class="form-control"
                                   accept=".pdf,.doc,.docx">
                            @error('priceOfferDocument')
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                                class="btn btn-primary w-full"
                                wire:loading.attr="disabled"
                                wire:target="uploadPriceOffer">
                            <span wire:loading.remove wire:target="uploadPriceOffer">
                                <i class="fas fa-upload mr-1"></i>
                                {{ __('messages.upload_document') }}
                            </span>
                            <span wire:loading wire:target="uploadPriceOffer">
                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                {{ __('messages.uploading') }}
                            </span>
                        </button>
                    </form>
                </div>
            @endif
        </div>
        <!-- [Rest of the view remains unchanged] -->
    </div>
</div>

<!-- Footer -->
<footer class="s-footer">
    <div class="container">
        <div class="footer__wrap">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.rights') }}</p>
        </div>
    </div>
</footer>
</div>
