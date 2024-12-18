<div class="min-h-screen bg-gray-50">
    <!-- Main Content -->
    <div class="container mx-auto">
        <div class="bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold">{{ __('messages.request_id', ['id' => $request->id]) }}</h1>
                <div class="service-status flex items-center">
                    <i class="fas fa-circle text-info-500 text-xs animate-pulse mr-2"></i>
                    {{-- {{ ucfirst($request->status) }} --}}
                    {{ __('messages.' . $request->status) }}
                </div>
            </div>

            <!-- Request Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card card-body border-0 shadow mb-4">
                    <h2 class="h5 mb-4">{{ __('messages.request_information') }}</h2>
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-around">
                        <div class="me-3">
                            <!-- Avatar -->
                            {{-- @dd($request->service->image_url); --}}
                            @if ($request->service->image_url)

                                <img class="rounded avatar-xl"
                                    src="{{ asset('storage/services/images/' . $request->service->image_url) }}"
                                    alt="{{ $request->service->name }}">
                            @endif

                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <div class="d-flex">
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1">
                                                @if (app()->getLocale() === 'en')
                                                    {{ $request->service->en_name }}
                                                @else
                                                    {{ $request->service->ar_name }}
                                                @endif

                                            </div>
                                        <div class="text-gray small"> {{ $request->price ? $request->price :( (app()->getLocale() === 'en') ? 'Not specified' : 'غير محدد')  }} AED
                                        </div>
                                        <div class="text-gray small">
                                            {{ $request->created_at ? $request->created_at->format('Y-m-d H:i:s') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <div class="d-flex">
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1">{{ __('messages.uploaded_documents') }}
                                        </div>
                                        {{-- @dd($request->documents) --}}
                                        @if (is_array($request->documents) && count($request->documents) > 0)
                                            <div class="text-gray small">
                                                @foreach ($request->documents as $key => $document)
                                                    <div>
                                                        {{-- <span>{{ basename($document) }}</span> --}}
                                                        <span>{{ ($key + 1) }}</span>

                                                        <a href="{{ url(asset('/storage/' . $document)) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-download bg-blue-500 text-info px-3 py-1 rounded hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-download mr-1"></i>
                                                            {{ __('messages.download') }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500 italic"></p>
                                            <div class="text-gray small">{{ __('messages.no_documents_uploaded') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="file-field">
                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                <div class="d-flex">
                                    <div class="d-md-block text-left">
                                        <div class="fw-normal text-dark mb-1">
                                            {{ __('messages.uploaded_price_offer_documents') }}</div>
                                        @if (is_array($priceOfferDocuments) && count($priceOfferDocuments) > 0)
                                            <div class="text-gray small">
                                                @foreach ($priceOfferDocuments as $document)
                                                    <div>
                                                        <span>{{ basename($document['original_name']) }}</span>
                                                        <a href="{{ Storage::url($document['file_url']) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-download bg-blue-500 text-info px-3 py-1 rounded hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-download mr-1"></i>
                                                            {{ __('messages.download') }}
                                                        </a>
                                                        {{-- </div> --}}

                                                        @if (Auth::user()->is_admin)
                                                            <button wire:click="deleteDocument({{ $document['id'] }})"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                                {{ __('messages.delete') }}
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-gray small">
                                                {{ __('messages.no_price_offer_documents_uploaded') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forms Section -->
            <div class="d-flex grid grid-cols-1 gap-6 h-[25vh] overflow-y-auto">

                <!-- Update Request Form -->
                <div class="card card-body border-0 shadow">
                    <h3 class="h5 mb-4">{{ __('messages.update_request') }}</h3>
                    <form
                        action="{{ route('request.update', ['locale' => app()->getLocale(), 'id' => $request->id]) }}"
                        method="POST" wire:submit.prevent="updateRequest" class="space-y-4">
                        @csrf
                        <!-- Status Update -->
                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.status') }}</label>
                            <select wire:model.live="status"
                                class="form-control w-full p-2 border border-gray-300 rounded">
                                <option value="pending">{{ __('messages.pending') }}</option>
                                <option value="in_progress">{{ __('messages.in_progress') }}</option>
                                <option value="completed">{{ __('messages.completed') }}</option>
                                <option value="canceled">{{ __('messages.canceled') }}</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price Update -->
                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.price') }}:
                            </label>
                            <input type="number" wire:model.live="price" id="price" step="0.01" min="0"
                                class="form-control w-full p-2 pl-7 border border-gray-300 rounded" placeholder="00.00">
                            @error('price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="expiry_date">{{ __('messages.expiry_date') }}</label>
                            <input
                                type="datetime-local"
                                wire:model="expiry_date"
                                id="expiry_date"
                                class="form-control"
                                {{-- value="{{ $expiry_date ? $expiry_date->format('Y-m-d\TH:i') : '' }}"> --}}
                                value="{{ $expiry_date ? \Carbon\Carbon::parse($expiry_date)->format('Y-m-d\TH:i') : '' }}">

                            @error('expiry_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="expiry_date">{{ __('Expiry Date') }}</label>
                            <input type="datetime-local" wire:model="expiry_date" class="form-control" >
                            @error('expiry_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-full relative">
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
                <div class="card card-body border-0 shadow">
                    <h3 class="h5 mb-4">{{ __('messages.upload_price_offer') }}</h3>
                    <form
                        action="{{ route('request.update', ['locale' => app()->getLocale(), 'id' => $request->id]) }}"
                        method="POST" wire:submit.prevent="uploadPriceOffer" class="space-y-4">
                        <div>
                            <input type="file" wire:model="priceOfferDocument" class="form-control"
                                accept=".pdf,.doc,.docx">
                            <div wire:loading wire:target="priceOfferDocument">
                                <span class="text-sm text-gray-500">{{ __('messages.uploading') }}</span>
                            </div>
                            @error('priceOfferDocument')
                                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled"
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
            </div>
        </div>
    </div>
</div>
