{{-- resources/views/orders/track-result.blade.php --}}
@extends('layouts.app')

@section('title', 'Order Tracking - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 800px;">

    <div class="thesara-page-header" style="padding-bottom: 16px;">
        <h1>Order #{{ $order->id }} Tracking</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <div class="thesara-card p-4 mb-4">
        <h5 class="fw-bold mb-3" style="font-family: var(--font-heading); color: var(--text-primary);">Order Information</h5>
        <div class="row g-3" style="font-size: 0.92rem;">
            <div class="col-6 col-md-4" style="color: var(--text-muted);">Status</div>
            <div class="col-6 col-md-8">
                <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : 'warning' }} rounded-pill px-3 py-2">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="col-6 col-md-4" style="color: var(--text-muted);">Total</div>
            <div class="col-6 col-md-8 fw-semibold">Rs {{ number_format($order->total, 2) }}</div>

            <div class="col-6 col-md-4" style="color: var(--text-muted);">Address</div>
            <div class="col-6 col-md-8">{{ $order->address }}</div>

            <div class="col-6 col-md-4" style="color: var(--text-muted);">Payment</div>
            <div class="col-6 col-md-8">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>

            <div class="col-6 col-md-4" style="color: var(--text-muted);">Tracking ID</div>
            <div class="col-6 col-md-8">{{ $order->tracking_id ?? 'Not available yet' }}</div>

            <div class="col-6 col-md-4" style="color: var(--text-muted);">Order Date</div>
            <div class="col-6 col-md-8">{{ $order->created_at->format('d M Y, h:i A') }}</div>
        </div>
    </div>

    <div class="thesara-card p-4 mb-4">
        <h5 class="fw-bold mb-3" style="font-family: var(--font-heading); color: var(--text-primary);">Items Ordered</h5>

        @forelse($order->orderItems as $item)
        <div class="d-flex align-items-center gap-3 mb-3">
            <img src="{{ asset($item->product->image_url ?? '') }}" alt="{{ $item->product->name ?? 'Product' }}"
                 style="width: 55px; height: 55px; object-fit: contain; border-radius: var(--radius-sm); border: 1px solid var(--border-light);">
            <div class="flex-grow-1">
                <p class="mb-0 fw-semibold" style="font-size: 0.92rem;">{{ $item->product->name ?? 'Product removed' }}</p>
                <p class="mb-0" style="font-size: 0.82rem; color: var(--text-muted);">
                    Qty: {{ $item->quantity }} × Rs {{ number_format($item->price, 2) }}
                </p>
            </div>
            <span class="fw-semibold">Rs {{ number_format($item->price * $item->quantity, 2) }}</span>
        </div>
        @empty
            <p class="text-muted text-center">No items found.</p>
        @endforelse
    </div>

    <div class="d-flex gap-3">
        <a href="{{ route('track.order') }}" class="btn btn-dark flex-grow-1 py-2">
            <i class="bi bi-search me-2"></i>Track Another
        </a>
        <a href="{{ url('/') }}" class="btn btn-outline-secondary flex-grow-1 py-2">
            ← Back to Home
        </a>
    </div>

</div>
@endsection