<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Service Management</h2>

                <!-- Service Form -->
                <div class="mb-8">
                    <form wire:submit.prevent="save" class="space-y-6">
                        @if (session()->has('message'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                            <input type="text" id="name" wire:model="name" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" wire:model="description" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon Class</label>
                            <input type="text" id="icon" wire:model="icon" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                            @error('icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Service Image</label>
                            <input type="file" id="image" wire:model="image" 
                                class="mt-1 block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary-red file:text-white
                                        hover:file:bg-secondary-red">
                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            
                            @if ($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded">
                                </div>
                            @elseif ($service && $service->image_url)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($service->image_url) }}" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" wire:model="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-red focus:ring-primary-red">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-300">
                            Save Service
                        </button>
                    </form>
                </div>

                <!-- Services List -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Existing Services</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if($service->image_url)
                                    <img src="{{ Storage::url($service->image_url) }}" 
                                         alt="{{ $service->name }}" 
                                         class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h4 class="font-semibold text-lg mb-2">{{ $service->name }}</h4>
                                    <p class="text-gray-600 text-sm mb-4">{{ $service->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm {{ $service->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                        <a href="{{ route('services.edit', $service) }}" 
                                           class="text-primary-red hover:text-secondary-red">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>