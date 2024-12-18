<div>
    <form action="{{ route('document.upload', ['locale' => app()->getLocale()]) }}" wire:submit.prevent="uploadDocument">
        <div class="space-y-4">
            <div>
                <label for="document" class="block text-sm font-medium text-gray-700">{{ __('messages.upload_document') }}</label>
                <input type="file" id="document" wire:model="document" 
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-primary-red file:text-white
                              hover:file:bg-secondary-red">
                @error('document') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-300">{{ __('messages.upload_document') }}</button>
        </div>
    </form>
</div>