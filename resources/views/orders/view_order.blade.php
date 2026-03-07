@extends('layouts.app')

@section('title', 'My Orders - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 800px;">

    <h2 class="fw-bold mb-4">My Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <div style="font-size: 3rem;">📦</div>
            <h5 class="mt-3 text-muted">No orders yet</h5>
            <a href="{{ route('shop') }}" class="btn btn-dark mt-3">Start Shopping</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">

                {{-- Order Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="fw-bold">Order #{{ $order->id }}</span>
                        <span class="text-muted ms-2" style="font-size: 0.85rem;">
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </span>
                    </div>
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning text-dark
                        @elseif($order->status == 'shipped') bg-info text-dark
                        @elseif($order->status == 'delivered') bg-success
                        @else bg-secondary
                        @endif px-3 py-2">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                {{-- Order Items --}}
                @foreach($order->orderItems as $item)
                <div class="d-flex align-items-center gap-3 mb-2">
                    <img src="{{ asset($item->product->image_url) }}"
                         alt="{{ $item->product->name }}"
                         style="width: 55px; height: 55px; object-fit: contain;
                                border-radius: 8px; border: 1px solid #eee;">
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">
                            {{ $item->product->name }}
                        </p>
                        <p class="mb-0 text-muted" style="font-size: 0.8rem;">
                            Qty: {{ $item->quantity }} × Rs {{ number_format($item->price, 2) }}
                        </p>
                    </div>
                    <span class="fw-semibold" style="font-size: 0.9rem;">
                        Rs {{ number_format($item->quantity * $item->price, 2) }}
                    </span>
                </div>
                @endforeach

                <hr>

                {{-- Order Footer --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div style="font-size: 0.85rem;" class="text-muted">
                        📍 {{ $order->city }} &nbsp;|&nbsp;
                        💳 {{ strtoupper($order->payment_method) }}
                    </div>
                    <div class="fw-bold">
                        Total: Rs {{ number_format($order->total, 2) }}
                    </div>
                </div>

            </div>
        </div>
        @endforeach

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection