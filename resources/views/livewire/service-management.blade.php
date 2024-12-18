<div class="">
    @if (Auth::user()->is_admin)
        <a href="{{ route('create.service') }}" class="btn btn-primary btn-lg rounded-pill shadow">{{ __('messages.create_service') }}</a>
    @endif
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">{{ __('messages.manage_service_requests') }}</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                @if (Auth::user()->is_admin)
                                    <th class="border-0"">User</th>
                                @endif
                                <th class="border-0"">Service</th>
                                <th class="border-0"">Status</th>
                                <th class="border-0"">Price</th>
                                <th class="border-0"">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr class="hover:bg-gray-100">
                                    @if (Auth::user()->is_admin)
                                        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                            {{ $request->user->name }}</td>
                                    @endif
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->service->name }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ ucfirst($request->status) }}</td>

                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        @if ($request->price == '0')
                                            ###
                                        @else
                                            {{ $request->price }}
                                        @endif
                                    </td>
                                    <td>

                                        @if (Auth::user()->is_admin)
                                            <button class="btn btn-sm btn-success"
                                                wire:click="edit({{ $request->id }})">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="delete({{ $request->id }})">Delete</button>
                                        @else
                                            {{-- <button class="btn btn-sm btn-warning" --}}
                                            <a href="{{ route('requests.show', ['id' => $request->id]) }}" style="background-color: #ff6b5b " class="btn btn-sm btn-warning">View</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
