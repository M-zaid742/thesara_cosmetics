@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container section">

    {{-- Page header --}}
    <div class="mb-4">
        <span class="hero-tag">ACCOUNT</span>
        <h3 class="section-title mb-1">My Profile</h3>
        <p class="text-muted mb-0">Your details, skin profile, and order history.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4">

        {{-- Left column --}}
        <div class="col-md-4">

            {{-- User info card --}}
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        @if($user->profile_image)
                            <img
                                src="{{ asset('storage/'.$user->profile_image) }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle"
                                style="width: 96px; height: 96px; object-fit: cover;"
                            >
                        @else
                            <div style="
                                width: 96px; height: 96px; border-radius: 50%;
                                background: #f0ece6; display: flex; align-items: center;
                                justify-content: center; margin: 0 auto;
                                font-size: 2rem; color: #5a4634;
                            ">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-1">{{ $user->email }}</p>
                    <p class="text-muted small mb-3">Member since {{ $user->created_at->format('M Y') }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-dark btn-sm px-4">Edit Profile</a>
                </div>
            </div>

            {{-- Account summary --}}
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0 pb-0">
                    <h6 class="mb-0">Account Summary</h6>
                </div>
                <div class="card-body pt-2">
                    @php
                        $orderCount = $user->orders->count();
                        $totalSpent = $user->orders->sum('total');
                    @endphp
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted small">Total orders</span>
                        <strong>{{ $orderCount }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="text-muted small">Total spent</span>
                        <strong>${{ number_format($totalSpent ?? 0, 2) }}</strong>
                    </div>
                </div>
            </div>

            {{-- Skin profile --}}
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0 pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Skin Profile</h6>
                    <a href="{{ route('profile.edit') }}" class="small text-muted">Edit</a>
                </div>
                <div class="card-body pt-2">
                    @if($user->profile)
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted small">Skin type</span>
                            <span class="small fw-semibold">{{ $user->profile->skin_type }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted small">Concerns</span>
                            <span class="small fw-semibold">{{ $user->profile->concerns }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted small">Age</span>
                            <span class="small fw-semibold">{{ $user->profile->age }}</span>
                        </div>
                    @else
                        <p class="text-muted small mb-0">
                            No skin profile yet.
                            <a href="{{ route('profile.edit') }}">Create one now</a>.
                        </p>
                    @endif
                </div>
            </div>

        </div>

        {{-- Right column: order history --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Order History</h5>
                </div>
                <div class="card-body">
                    @if($user->orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-bag text-muted" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-3 mb-3">No orders yet.</p>
                            <a href="{{ route('shop') }}" class="btn btn-dark btn-sm px-4">Start Shopping</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="small text-muted fw-semibold">Order #</th>
                                        <th class="small text-muted fw-semibold">Date</th>
                                        <th class="small text-muted fw-semibold">Status</th>
                                        <th class="small text-muted fw-semibold">Total</th>
                                        <th class="small text-muted fw-semibold">Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td class="small">#{{ $order->id }}</td>
                                        <td class="small">{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            @php $status = $order->status ?? 'pending'; @endphp
                                            <span class="badge rounded-pill
                                                @if($status === 'delivered') bg-success
                                                @elseif($status === 'cancelled') bg-danger
                                                @elseif($status === 'processing') bg-warning text-dark
                                                @else bg-secondary
                                                @endif
                                            " style="font-size: 11px;">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td class="small fw-semibold">${{ number_format($order->total ?? 0, 2) }}</td>
                                        <td>
                                            @if($order->orderItems->isEmpty())
                                                <span class="text-muted small">—</span>
                                            @else
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($order->orderItems as $item)
                                                        <li class="small">
                                                            {{ $item->product->name ?? 'Product #'.$item->product_id }}
                                                            <span class="text-muted">× {{ $item->quantity }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection