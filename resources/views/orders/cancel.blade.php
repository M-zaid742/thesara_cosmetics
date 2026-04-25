@extends('layouts.app')

@section('title', 'Cancel Order - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 760px;">
    <div class="thesara-page-header mb-4">
        <h1>Cancel Order</h1>
        <p>Select your order and tell us why you need to cancel it.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="thesara-card p-4">
        <form action="{{ route('orders.cancel.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="order_id" class="form-label fw-semibold">Order</label>
                <select name="order_id" id="order_id" class="form-select" required>
                    <option value="">Select an order</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" @selected(old('order_id') == $order->id)>
                            #{{ $order->id }} - {{ ucfirst($order->status) }} - Rs {{ number_format($order->total, 2) }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Delivered and already cancelled orders cannot be cancelled.</small>
            </div>

            <div class="mb-4">
                <label for="reason" class="form-label fw-semibold">Reason</label>
                <textarea
                    name="reason"
                    id="reason"
                    class="form-control"
                    rows="5"
                    placeholder="Please share the reason for cancellation"
                    required
                >{{ old('reason') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">Submit Cancellation</button>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to My Orders</a>
            </div>
        </form>
    </div>
</div>
@endsection
