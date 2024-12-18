<div class="">
    <div class="bg-light p-4 rounded">
        <h1 class="text-2xl font-bold mb-4 text-primary">{{ __('messages.notifications') }}</h1>
        <div class="card border-0 shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0 "
                        style="table-layout: fixed; width: 100%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                @if (Auth::user()->is_admin)

                                <th class="" style="width: 15%;">{{ __('messages.user_name') }}
                                </th>
                                @endif
                                <th class="" style="width: 15%;">{{ __('messages.table_title') }}</th>
                                <th class="" style="width: 45%;">{{ __('messages.table_message') }}</th>
                                <th class="" style="width: 10%;">{{ __('messages.date') }}</th>
                                <th class="" style="width: 15%;">{{ __('messages.table_actions') }}
                                </th>
                            </tr>
                        </thead>
                        {{-- @dd($notification['request_id']) --}}
                        <tbody>
                            @foreach ($notifications as $notification)
                            {{-- @dd($notification) --}}
                                <tr class="hover:bg-gray-100">
                                    @if (Auth::user()->is_admin)

                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{-- <a href="{{ route('user.profile', ['id' => $notification['user']->id]) }}"> --}}
                                        {{ $notification['user'] }}
                                        {{-- </a> --}}
                                    </td>
                                    @endif
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <a class="text-info fw-bolder font-monospace"
                                            href="{{ route('requests.show', ['id' => $notification['request_id']]) }}">
                                            {{ $notification['title'] }}
                                        </a>
                                    </td>
                                    <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $notification['message'] }}
                                    </td>
                                    <td style=" white-space: nowrap; text-overflow: ellipsis;">
                                        {{-- {{ $notification['created_at'] }} --}}
                                        {{ $notification['created_at']->diffForHumans() }}
                                    </td>
                                    <td>
                                        <button wire:click="show('{{ $notification['id'] }}')"
                                            class="btn btn-sm btn-outline-info">
                                            {{ __('messages.show') }}
                                        </button>

                                        <button wire:click="delete('{{ $notification['id'] }}', '{{ $notification['request_id']}}')"
                                         class="btn btn-sm btn-outline-danger">
                                         {{ __('messages.delete') }}
                                     </button>




                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Notification Details Modal -->
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.notification_details') }}</h5>
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($selectedNotification)
                        <p><strong>{{ __('messages.message_title') }}:</strong>
                            @if (app()->getLocale() == 'en')
                            {{ $selectedNotification->en_title }}
                            @else
                            {{ $selectedNotification->ar_title }}
                            @endif
                            </p>
                        <p><strong>{{ __('messages.message') }}:</strong>
                            @if (app()->getLocale() == 'en')
                            {{ $selectedNotification->en_message }}
                            @else
                            {{ $selectedNotification->ar_message }}
                            @endif
                        </p>
                        <p><strong>{{ __('messages.request_page') }}:</strong>
                            <a class="btn btn-primary"
                                href="{{ route('requests.show', ['id' => $selectedNotification->request_id]) }}">
                                ID # {{ $selectedNotification->request_id }}
                            </a>
                        </p>
                        <p><strong>{{ __('messages.created_at') }}:</strong> {{ $selectedNotification->created_at }}
                        </p>
                    @else
                        <p>{{ __('messages.no_notification_details_available') }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        wire:click="closeModal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
