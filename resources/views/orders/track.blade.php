{{-- resources/views/orders/track.blade.php --}}
@extends('layouts.app')

@section('title', 'Track Order - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <div class="thesara-page-header">
        <h1>Track Your Order</h1>
        <p>Enter your order ID below to check the status of your delivery.</p>
    </div>

    <div class="thesara-card p-4">
        @if(session('error'))
            <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
        @endif

        <form action="{{ route('track.result') }}" method="GET">
            <div class="mb-4">
                <label for="order_id" class="form-label fw-semibold" style="color: var(--text-primary);">Order ID</label>
                <input type="number" 
                       name="order_id" 
                       id="order_id"
                       class="form-control form-control-lg text-center"
                       style="border: 1px solid var(--border-light); border-radius: var(--radius-sm); background: var(--bg-body);"
                       placeholder="e.g. 12345" 
                       required 
                       autofocus>
            </div>
            <button type="submit" class="btn btn-dark w-100 py-2">
                <i class="bi bi-search me-2"></i>Track Order
            </button>
        </form>
    </div>
</div>
@endsection