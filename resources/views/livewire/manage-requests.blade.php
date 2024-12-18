<div class="">
    @if (!Auth::user()->is_admin)
        <a href="{{ route('request.service') }}" class="btn btn-primary btn-lg rounded-pill shadow">{{ __('messages.request_service') }}</a>
    @endif
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">{{ __('messages.manage_service_requests') }}</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="statusFilter">{{ __('messages.filter_by_status') }}</label>
                    <select id="statusFilter" wire:model.live="statusFilter" class="form-control">
                        <option value="">{{ __('messages.all') }}</option>
                        <option value="pending">{{ __('messages.pending') }}</option>
                        <option value="in_progress">{{ __('messages.in_progress') }}</option>
                        <option value="completed">{{ __('messages.completed') }}</option>
                        <option value="canceled">{{ __('messages.canceled') }}</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                @if (Auth::user()->is_admin)
                                    <th class="">{{ __('messages.user') }}</th>
                                @endif
                                <th class="">{{ __('messages.service') }}</th>
                                <th class="">{{ __('messages.status') }}</th>
                                <th class="">{{ __('messages.price') }}</th>
                                <th class="">{{ __('messages.date') }}</th>
                                <th class="">{{ __('messages.table_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($requests) --}}
                            @foreach ($requests as $request)
                                <tr class="hover:bg-gray-100">
                                    @if (Auth::user()->is_admin)
                                        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                            {{ $request->user->name }}</td>
                                    @endif
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        @if(app()->getLocale() == 'en')
                                        {{ $request->service->en_name }}
                                        @else
                                        {{ $request->service->ar_name}}
                                        @endif
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ ucfirst(__('messages.'.$request->status)) }}</td>

                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        @if ($request->price == '0')
                                            ###
                                        @else
                                            {{ $request->price }}
                                        @endif
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $request->created_at->diffForHumans() }}
                                    </td>
                                    <td>

                                        @if (Auth::user()->is_admin)
                                            <a href="{{ route('request.update', ['id' => $request->id]) }}" class="btn btn-sm btn-success">
                                                {{ __('messages.edit') }}</a>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="delete({{ $request->id }})">
                                                {{ __('messages.delete') }}
                                            </button>
                                        @else
                                            {{-- <button class="btn btn-sm btn-warning" --}}
                                            <a href="{{ route('requests.show', ['id' => $request->id]) }}" style="background-color: #ff6b5b " class="btn btn-sm btn-warning">{{ __('messages.view') }}</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                      <!-- Pagination Links -->
    {{-- <div class="mt-3">
        {{ $allRequests->links() }}
    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
