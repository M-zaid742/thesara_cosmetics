@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">
                        <i class="fas fa-envelope mr-2" style="color:#d4a017;"></i> Messages
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Messages</li>
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
                        Customer Messages
                    </h3>
                    <span class="badge badge-secondary">{{ $messages->count() }} messages</span>
                </div>

                <div class="card-body p-0">
                    @if($messages->count() === 0)
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3" style="color:#d4a017; opacity:.5;"></i>
                            <p class="mb-0">No messages yet.</p>
                        </div>
                    @else
                    <table class="table table-hover mb-0">
                        <thead style="background:#f9f3ec;">
                            <tr>
                                <th width="40">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th width="130">Received</th>
                                <th width="80">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $msg)
                            <tr class="{{ !$msg->is_read ? 'font-weight-bold' : '' }}" style="{{ !$msg->is_read ? 'background:#fffbf4;' : '' }}">
                                <td class="align-middle text-muted small">{{ $msg->id }}</td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2 d-flex align-items-center justify-content-center"
                                             style="width:36px;height:36px;border-radius:50%;background:#d4a017;color:#fff;font-size:14px;flex-shrink:0;">
                                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                                        </div>
                                        {{ $msg->name }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if(!empty($msg->email))
                                        <a href="mailto:{{ $msg->email }}" class="text-dark">{{ $msg->email }}</a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span title="{{ $msg->message }}">
                                        {{ Str::limit($msg->message, 80) }}
                                    </span>
                                </td>
                                <td class="align-middle text-muted small">
                                    {{ $msg->created_at->format('d M Y') }}<br>
                                    <span style="font-size:11px;">{{ $msg->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($msg->is_read)
                                        <span class="badge badge-success">Read</span>
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
