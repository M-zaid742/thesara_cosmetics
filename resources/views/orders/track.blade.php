@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }} Tracking</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Tracking ID:</strong> {{ $order->tracking_id ?? 'Not available yet' }}</p>
        </div>
    </div>

    <h2>Order Items</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product unavailable' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No items in this order.</td></tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection