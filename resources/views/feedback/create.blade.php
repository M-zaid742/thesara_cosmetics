@extends('layouts.app')

@section('title', 'Feedback - Thesara Cosmetics')

@section('content')
<div class="container py-5" style="max-width: 760px;">
    <div class="thesara-page-header mb-4">
        <h1>Share Feedback</h1>
        <p>Tell us about your experience so we can improve your skincare journey.</p>
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
        <form action="{{ route('feedback.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="order_id" class="form-label fw-semibold">Related Order (Optional)</label>
                <select name="order_id" id="order_id" class="form-select">
                    <option value="">No specific order</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" @selected((string) old('order_id', $preselectedOrderId) === (string) $order->id)>
                            #{{ $order->id }} - {{ ucfirst($order->status) }} - {{ $order->created_at->format('d M Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label fw-semibold">Subject</label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="form-control"
                    value="{{ old('subject') }}"
                    maxlength="120"
                    placeholder="Example: Product quality, delivery, service"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="message" class="form-label fw-semibold">Message</label>
                <textarea
                    name="message"
                    id="message"
                    class="form-control"
                    rows="6"
                    maxlength="2000"
                    placeholder="Write your feedback here"
                    required
                >{{ old('message') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">Submit Feedback</button>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to My Orders</a>
            </div>
        </form>
    </div>
</div>
@endsection
