@extends('layouts.app')

@section('title', 'Order Confirmed - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 750px;">

    {{-- Success Header --}}
    <div class="text-center mb-5">
        <div style="font-size: 4rem;">✅</div>
        <h2 class="fw-bold mt-3" style="font-family: var(--font-heading);">Order Placed Successfully!</h2>
        <p style="color: var(--text-secondary);">Thank you, {{ $order->name }}. Your order has been received.</p>
        <span class="badge px-3 py-2" style="font-size: 0.85rem; background: var(--brand-gold); color: var(--brand-dark);">
            Order #{{ $order->id }}
        </span>
    </div>

    {{-- Order Info --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3" style="font-family: var(--font-heading);">Order Details</h5>
            <div class="row g-2" style="font-size: 0.9rem;">
                <div class="col-6 text-muted">Date</div>
                <div class="col-6 fw-semibold">{{ $order->created_at->format('d M Y, h:i A') }}</div>

                <div class="col-6 text-muted">Status</div>
                <div class="col-6">
                    <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="col-6 text-muted">Payment Method</div>
                <div class="col-6 fw-semibold">{{ strtoupper($order->payment_method) }}</div>

                <div class="col-6 text-muted">Shipping To</div>
                <div class="col-6 fw-semibold">{{ $order->address }}, {{ $order->city }}</div>

                <div class="col-6 text-muted">Phone</div>
                <div class="col-6 fw-semibold">{{ $order->phone }}</div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3" style="font-family: var(--font-heading);">Items Ordered</h5>

            @foreach($order->orderItems as $item)
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ asset($item->product->image_url) }}"
                     alt="{{ $item->product->name }}"
                     style="width: 60px; height: 60px; object-fit: contain;
                            border-radius: 8px; border: 1px solid #eee;">
                <div class="flex-grow-1">
                    <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">
                        {{ $item->product->name }}
                    </p>
                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">
                        Qty: {{ $item->quantity }} × Rs {{ number_format($item->price, 2) }}
                    </p>
                </div>
                <span class="fw-semibold">
                    Rs {{ number_format($item->quantity * $item->price, 2) }}
                </span>
            </div>
            @endforeach

            <hr>

            <div class="d-flex justify-content-between mb-1" style="font-size: 0.9rem;">
                <span class="text-muted">Subtotal</span>
                <span>Rs {{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
                <span class="text-muted">Shipping</span>
                <span>
                    @if($order->shipping == 0)
                        <span class="text-success fw-semibold">Free</span>
                    @else
                        Rs {{ number_format($order->shipping, 2) }}
                    @endif
                </span>
            </div>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total</span>
                <span>Rs {{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-flex gap-3">
        <a href="{{ route('orders.index') }}"
           class="btn btn-dark flex-grow-1 py-2">
            📦 View My Orders
        </a>
        <a href="{{ route('shop') }}"
           class="btn btn-outline-secondary flex-grow-1 py-2">
            🛍️ Continue Shopping
        </a>
    </div>

</div>
@endsection
