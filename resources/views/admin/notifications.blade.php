@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">
                        <i class="fas fa-bell mr-2" style="color:#d4a017;"></i> Notifications
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Notifications</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-outline shadow-sm" style="border-top: 3px solid #d4a017;">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title font-weight-bold text-uppercase" style="letter-spacing:1px;">
                        All Notifications
                    </h3>
                    <span class="badge badge-secondary">{{ $notifications->count() }} notifications</span>
                </div>

                <div class="card-body p-0">
                    @if($notifications->count() === 0)
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-bell-slash fa-3x mb-3" style="color:#d4a017; opacity:.5;"></i>
                            <p class="mb-0">No notifications yet.</p>
                        </div>
                    @else
                    <table class="table table-hover mb-0">
                        <thead style="background:#f9f3ec;">
                            <tr>
                                <th width="40">#</th>
                                <th width="120">Type</th>
                                <th>Message</th>
                                <th width="120">User</th>
                                <th width="130">Date</th>
                                <th width="80">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notif)
                            <tr class="{{ !$notif->read ? 'font-weight-bold' : '' }}"
                                style="{{ !$notif->read ? 'background:#fffbf4;' : '' }}">
                                <td class="align-middle text-muted small">{{ $notif->id }}</td>
                                <td class="align-middle">
                                    @php
                                        $iconMap = [
                                            'order'   => ['fas fa-shopping-bag', 'warning'],
                                            'user'    => ['fas fa-user-plus',    'info'],
                                            'message' => ['fas fa-envelope',     'primary'],
                                            'review'  => ['fas fa-star',         'success'],
                                        ];
                                        $key   = strtolower($notif->type ?? '');
                                        $icon  = $iconMap[$key][0] ?? 'fas fa-info-circle';
                                        $color = $iconMap[$key][1] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $color }} px-2 py-1">
                                        <i class="{{ $icon }} mr-1"></i>
                                        {{ ucfirst($notif->type ?? 'System') }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    {{ Str::limit($notif->message, 100) }}
                                </td>
                                <td class="align-middle text-muted small">
                                    {{ $notif->user->name ?? 'System' }}
                                </td>
                                <td class="align-middle text-muted small">
                                    {{ $notif->created_at->format('d M Y') }}<br>
                                    <span style="font-size:11px;">{{ $notif->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($notif->read)
                                        <span class="badge badge-light border">Read</span>
                                    @else
                                        <span class="badge badge-warning">New</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
