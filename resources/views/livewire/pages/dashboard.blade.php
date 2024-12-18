<div>
    <div class="container mx-auto px-2 py-2">
        @if (Auth::user()->is_admin)
            <!-- Admin Content -->
            <div class="row">
                {{-- total services --}}
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <a href="{{ route('manage.services') }}">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div
                                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="d-sm-none">
                                            <h2 class="h5">{{ __('messages.services') }}</h2>
                                            <h3 class="fw-extrabold mb-1">{{ $stats['total_services'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h6 text-gray-400 mb-0">{{ __('messages.services') }}</h2>
                                            <h3 class="fw-extrabold mb-2">{{ $stats['total_services'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- total users --}}
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <a href="{{ route('manage.users') }}">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div
                                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="d-sm-none">
                                            <h2 class="h5">{{ __('messages.users') }}</h2>
                                            <h3 class="fw-extrabold mb-1">{{ $stats['total_users'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h6 text-gray-400 mb-0">{{ __('messages.users') }}</h2>
                                            <h3 class="fw-extrabold mb-2">{{ $stats['total_users'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- total requests --}}
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <a href="{{ route('manage.requests') }}">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div
                                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="d-sm-none">
                                            <h2 class="h5">{{ __('messages.requests') }}</h2>
                                            <h3 class="fw-extrabold mb-1">{{ $stats['total_requests'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h6 text-gray-400 mb-0">{{ __('messages.requests') }}</h2>
                                            <h3 class="fw-extrabold mb-2">{{ $stats['total_requests'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">{{ __('messages.pending_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-1">{{ $stats['total_pending_requests'] }}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">{{ __('messages.pending_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-2">{{ $stats['total_pending_requests'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">{{ __('messages.in_progress_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-1">{{ $stats['total_in_progress_requests'] }}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">{{ __('messages.in_progress_requests') }}
                                        </h2>
                                        <h3 class="fw-extrabold mb-2">{{ $stats['total_in_progress_requests'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">{{ __('messages.completed_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-1">{{ $stats['total_completed_requests'] }}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">{{ __('messages.completed_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-2">{{ $stats['total_completed_requests'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="row d-block d-xl-flex align-items-center">
                                <div
                                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                    <div class="icon-shape icon-shape-warning rounded me-4 me-sm-0">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="d-sm-none">
                                        <h2 class="h5">{{ __('messages.cancelled_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-1">{{ $stats['total_cancelled_requests'] }}</h3>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-7 px-xl-0">
                                    <div class="d-none d-sm-block">
                                        <h2 class="h6 text-gray-400 mb-0">{{ __('messages.cancelled_requests') }}</h2>
                                        <h3 class="fw-extrabold mb-2">{{ $stats['total_cancelled_requests'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin-content">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('messages.monthly_requests_chart') }}
                    </h2>
                    <canvas id="monthlyRequestsChart" width="400" height="200"></canvas>
                </div>
            </div>
        @else
            <!-- User Content -->

            <div class="user-content">
                <div class="mt-2">
                    <h2 class="text-xl text-center font-semibold text-gray-800 mb-4">{{ __('messages.overview') }}
                    </h2>
                    <div class="row">
                        {{--  total requests --}}
                        <div class="col-12 col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                    {{-- <a href="{{ route('manage.services') }}"> --}}
                                    <div class="row d-block d-xl-flex align-items-center">
                                        <div
                                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="d-sm-none">
                                                <h2 class="h5">{{ __('messages.requests') }}</h2>
                                                <h3 class="fw-extrabold mb-1">{{ $userStats['your_requests'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-7 px-xl-0">
                                            <div class="d-none d-sm-block">
                                                <h2 class="h6 text-gray-400 mb-0">{{ __('messages.requests') }}</h2>
                                                <h3 class="fw-extrabold mb-2">{{ $userStats['your_requests'] }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </a> --}}
                                </div>
                            </div>
                        </div>
                        {{--  completed requests --}}
                        <div class="col-12 col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                    {{-- <a href="{{ route('manage.users') }}"> --}}
                                    <div class="row d-block d-xl-flex align-items-center">
                                        <div
                                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="d-sm-none">
                                                <h2 class="h5">{{ __('messages.completed_requests') }}</h2>
                                                <h3 class="fw-extrabold mb-1">
                                                    {{ $userStats['your_completed_requests'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-7 px-xl-0">
                                            <div class="d-none d-sm-block">
                                                <h2 class="h6 text-gray-400 mb-0">
                                                    {{ __('messages.completed_requests') }}</h2>
                                                <h3 class="fw-extrabold mb-2">
                                                    {{ $userStats['your_completed_requests'] }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- pending requests  --}}
                        <div class="col-12 col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                    {{-- <a href="{{ route('manage.users') }}"> --}}
                                    <div class="row d-block d-xl-flex align-items-center">
                                        <div
                                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                            <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="d-sm-none">
                                                <h2 class="h5">{{ __('messages.pending') }}</h2>
                                                <h3 class="fw-extrabold mb-1">
                                                    {{ $userStats['your_pending_requests'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-7 px-xl-0">
                                            <div class="d-none d-sm-block">
                                                <h2 class="h6 text-gray-400 mb-0">{{ __('messages.pending') }}</h2>
                                                <h3 class="fw-extrabold mb-2">
                                                    {{ $userStats['your_pending_requests'] }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- cancelled requests --}}
                        <div class="col-12 col-sm-6 col-xl-3 mb-4">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                    {{-- <a href="{{ route('manage.requests') }}"> --}}
                                    <div class="row d-block d-xl-flex align-items-center">
                                        <div
                                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                            <div class="icon-shape icon-shape-danger rounded me-4 me-sm-0">
                                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="d-sm-none">
                                                <h2 class="h5">{{ __('messages.cancelled_requests') }}</h2>
                                                <h3 class="fw-extrabold mb-1">
                                                    {{ $userStats['your_cancelled_requests'] }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-7 px-xl-0">
                                            <div class="d-none d-sm-block">
                                                <h2 class="h6 text-gray-400 mb-0">
                                                    {{ __('messages.cancelled_requests') }}</h2>
                                                <h3 class="fw-extrabold mb-2">
                                                    {{ $userStats['your_cancelled_requests'] }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($userStats['your_requests'] >0)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <canvas id="userMonthlyRequestsChart" width="400" height="200"></canvas>
                    </div>
                    @endif
                </div>

            </div>
        @endif
        @if (Auth::user()->is_admin)
            <script>
                // Monthly Requests Chart
                var ctx = document.getElementById('monthlyRequestsChart').getContext('2d');
                var monthlyRequestsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            '{{ __('messages.january') }}',
                            '{{ __('messages.february') }}',
                            '{{ __('messages.march') }}',
                            '{{ __('messages.april') }}',
                            '{{ __('messages.may') }}',
                            '{{ __('messages.june') }}',
                            '{{ __('messages.july') }}',
                            '{{ __('messages.august') }}',
                            '{{ __('messages.september') }}',
                            '{{ __('messages.october') }}',
                            '{{ __('messages.november') }}',
                            '{{ __('messages.december') }}'
                        ],
                        datasets: [{
                                label: '{{ __('messages.pending_requests') }}',
                                data: [
                                    {{ $chartData['january_pending'] ?? 0 }},
                                    {{ $chartData['february_pending'] ?? 0 }},
                                    {{ $chartData['march_pending'] ?? 0 }},
                                    {{ $chartData['april_pending'] ?? 0 }},
                                    {{ $chartData['may_pending'] ?? 0 }},
                                    {{ $chartData['june_pending'] ?? 0 }},
                                    {{ $chartData['july_pending'] ?? 0 }},
                                    {{ $chartData['august_pending'] ?? 0 }},
                                    {{ $chartData['september_pending'] ?? 0 }},
                                    {{ $chartData['october_pending'] ?? 0 }},
                                    {{ $chartData['november_pending'] ?? 0 }},
                                    {{ $chartData['december_pending'] ?? 0 }}
                                ],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: '{{ __('messages.cancelled_requests') }}',
                                data: [
                                    {{ $chartData['january_cancelled'] ?? 0 }},
                                    {{ $chartData['february_cancelled'] ?? 0 }},
                                    {{ $chartData['march_cancelled'] ?? 0 }},
                                    {{ $chartData['april_cancelled'] ?? 0 }},
                                    {{ $chartData['may_cancelled'] ?? 0 }},
                                    {{ $chartData['june_cancelled'] ?? 0 }},
                                    {{ $chartData['july_cancelled'] ?? 0 }},
                                    {{ $chartData['august_cancelled'] ?? 0 }},
                                    {{ $chartData['september_cancelled'] ?? 0 }},
                                    {{ $chartData['october_cancelled'] ?? 0 }},
                                    {{ $chartData['november_cancelled'] ?? 0 }},
                                    {{ $chartData['december_cancelled'] ?? 0 }}
                                ],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: '{{ __('messages.completed_requests') }}',
                                data: [
                                    {{ $chartData['january_completed'] ?? 0 }},
                                    {{ $chartData['february_completed'] ?? 0 }},
                                    {{ $chartData['march_completed'] ?? 0 }},
                                    {{ $chartData['april_completed'] ?? 0 }},
                                    {{ $chartData['may_completed'] ?? 0 }},
                                    {{ $chartData['june_completed'] ?? 0 }},
                                    {{ $chartData['july_completed'] ?? 0 }},
                                    {{ $chartData['august_completed'] ?? 0 }},
                                    {{ $chartData['september_completed'] ?? 0 }},
                                    {{ $chartData['october_completed'] ?? 0 }},
                                    {{ $chartData['november_completed'] ?? 0 }},
                                    {{ $chartData['december_completed'] ?? 0 }}
                                ],
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            },
                            {
                                label: '{{ __('messages.in_progress_requests') }}',
                                data: [
                                    {{ $chartData['january_in_progress'] ?? 0 }},
                                    {{ $chartData['february_in_progress'] ?? 0 }},
                                    {{ $chartData['march_in_progress'] ?? 0 }},
                                    {{ $chartData['april_in_progress'] ?? 0 }},
                                    {{ $chartData['may_in_progress'] ?? 0 }},
                                    {{ $chartData['june_in_progress'] ?? 0 }},
                                    {{ $chartData['july_in_progress'] ?? 0 }},
                                    {{ $chartData['august_in_progress'] ?? 0 }},
                                    {{ $chartData['september_in_progress'] ?? 0 }},
                                    {{ $chartData['october_in_progress'] ?? 0 }},
                                    {{ $chartData['november_in_progress'] ?? 0 }},
                                    {{ $chartData['december_in_progress'] ?? 0 }}
                                ],
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '{{ __('messages.requests_count') }}'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: '{{ __('messages.title') }}'
                            }
                        }
                    }
                });
            </script>
        @else
        @if(count($userStats['monthly_requests'])>0);
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const monthlyData = @json($userStats['monthly_requests']);
                    const months = monthlyData.map(item => item.month);
                    const counts = monthlyData.map(item => item.count);

                    const ctx = document.getElementById('userMonthlyRequestsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Number of Requests',
                                data: counts,
                                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                                borderColor: 'rgb(59, 130, 246)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                title: {
                                    display: false
                                }
                            }
                        }
                    });
                });
            </script>
        @endif
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
