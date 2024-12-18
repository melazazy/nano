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
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.edit_request') }}</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manage.requests', ['locale' => app()->getLocale()]) }}" wire:submit.prevent="save">
                        @if (Auth::user()->is_admin)
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">{{ __('messages.status') }}</label>
                                <select id="status" wire:model="editRequest.status" class="form-control">
                                    <option value="pending">{{ __('messages.pending') }}</option>
                                    <option value="in_progress">{{ __('messages.in_progress') }}</option>
                                    <option value="complated">{{ __('messages.complated') }}</option>
                                </select>
                            </div>

                            <!-- Notes -->
                            <div class="form-group">
                                <label for="notes">{{ __('messages.notes') }}</label>
                                <textarea id="notes" wire:model="editRequest.notes" class="form-control">{{ $editRequest['notes'] ?? '' }}</textarea>
                            </div>

                            <!-- Expiry Date -->
                            <div class="form-group">
                                <label for="expiry_date">{{ __('messages.expiry_date') }}</label>
                                <input type="date" id="expiry_date" wire:model="editRequest.expiry_date"
                                    class="form-control" value="{{ $editRequest['expiry_date'] ?? '' }}">
                            </div>
                        @endif

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">{{ __('messages.price') }}</label>
                            <input type="number" id="price" wire:model="editRequest.price" class="form-control"
                                value="{{ $editRequest['price'] ?? '' }}">
                        </div>

                        <!-- Documents -->
                        <div class="form-group">
                            <label for="documents">{{ __('messages.documents') }}</label>
                            @if (isset($editRequest['documents']) && is_array($editRequest['documents']))
                                <ul class="list-group mb-2">
                                    @foreach ($editRequest['documents'] as $index => $document)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                wire:model="editRequest.documents.{{ $index }}"
                                                class="form-control" value="{{ $document }}">
                                            <button type="button" class="btn btn-danger btn-sm ml-2"
                                                wire:click="removeDocument({{ $index }})">{{ __('messages.remove') }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="addDocument">{{ __('messages.add_document') }}</button>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
