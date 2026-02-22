@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container section">
    <div class="d-flex justify-content-between align-items-start align-items-md-center flex-wrap gap-2 mb-4">
        <div>
            <span class="hero-tag">ACCOUNT</span>
            <h3 class="section-title mb-1">My Profile</h3>
            <p class="text-muted mb-0">Your details, skin profile, and order history.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-dark hero-btn">Edit Profile</a>
            <a href="{{ route('shop') }}" class="btn btn-outline-dark hero-btn">Continue Shopping</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <!-- Left column: basic user info -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($user->profile_image)
                            <img
                                src="{{ asset('storage/'.$user->profile_image) }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle"
                                style="width: 96px; height: 96px; object-fit: cover;"
                            >
                        @else
                            <i class="bi bi-person-circle text-secondary" style="font-size: 72px;"></i>
                        @endif
                    </div>
                    <h4 class="card-title mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ $user->email }}</p>
                    <p class="small text-muted mb-3">Member since {{ $user->created_at->format('M Y') }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">Edit Skin Profile</a>
                </div>
            </div>

            <!-- Quick stats -->
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0">Account Summary</h6>
                </div>
                <div class="card-body">
                    @php
                        $orderCount = $user->orders->count();
                        $totalSpent = $user->orders->sum('total');
                    @endphp

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Orders</span>
                        <strong>{{ $orderCount }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="text-muted">Total spent</span>
                        <strong>${{ number_format($totalSpent ?? 0, 2) }}</strong>
                    </div>
                </div>
            </div>

            <!-- Skin profile summary -->
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0">Skin Profile</h6>
                </div>
                <div class="card-body">
                    @if($user->profile)
                        <p><strong>Skin Type:</strong> {{ $user->profile->skin_type }}</p>
                        <p><strong>Concerns:</strong> {{ $user->profile->concerns }}</p>
                        <p><strong>Age:</strong> {{ $user->profile->age }}</p>
                    @else
                        <p class="text-muted mb-0">No skin profile yet. <a href="{{ route('profile.edit') }}">Create one now</a>.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right column: order history / purchased products -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order History</h5>
                </div>
                <div class="card-body">
                    @if($user->orders->isEmpty())
                        <p class="text-muted mb-0">You haven't placed any orders yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td>{{ ucfirst($order->status ?? 'pending') }}</td>
                                        <td>${{ number_format($order->total ?? 0, 2) }}</td>
                                        <td>
                                            @if($order->orderItems->isEmpty())
                                                <span class="text-muted">No items</span>
                                            @else
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($order->orderItems as $item)
                                                        <li>
                                                            {{ $item->product->name ?? 'Product #'.$item->product_id }}
                                                            × {{ $item->quantity }}
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
