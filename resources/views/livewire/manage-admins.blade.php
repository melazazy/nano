<div class="">
    <a href="{{ route('admin.management') }}" class="btn btn-primary btn-lg rounded-pill shadow">{{ __('messages.add_admin') }}</a>
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">{{ __('messages.manage_admins') }}</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 rounded"
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="border-0" style="width: 25%;">{{ __('messages.name') }}</th>
                                <th class="border-0" style="width: 25%;">{{ __('messages.email') }}</th>
                                <th class="border-0" style="width: 25%;">{{ __('messages.role') }}</th>
                                <th class="border-0" style="width: 25%;">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100">
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $user->name }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $user->email }}</td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ __('messages.admin') }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit', ['id' => $user->id]) }}"
                                            class="btn btn-sm btn-outline-primary">{{ __('messages.edit') }}</a>

                                        <button wire:click="delete({{ $user->id }})"
                                            class="btn btn-sm btn-outline-danger">{{ __('messages.delete') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.edit_user') }}</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manage.users', ['locale' => app()->getLocale()]) }}" wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="name">{{ __('messages.name') }}</label>
                            <input type="text" id="name" class="form-control" wire:model.defer="editUser.name">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('messages.email') }}</label>
                            <input type="email" id="email" class="form-control" wire:model.defer="editUser.email">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
