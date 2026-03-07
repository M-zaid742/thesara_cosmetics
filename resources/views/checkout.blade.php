@extends('layouts.app')

@section('title', 'Checkout - Thesara Cosmetics')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Checkout</h2>

    {{-- Error / Success Messages --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="is_buy_now" value="{{ $isBuyNow ? 1 : 0 }}">

        <div class="row">

            {{-- Left: Billing & Payment --}}
            <div class="col-lg-7">

                {{-- Billing Information --}}
                <div class="checkout-box p-4 mb-4">
                    <h5 class="fw-bold mb-3">Billing Information</h5>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ Auth::user()->name }}"
                               placeholder="Enter your full name" required>
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ Auth::user()->email }}"
                               placeholder="example@gmail.com" required>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control"
                               placeholder="+92 300 1234567" required>
                        @error('phone')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shipping Address</label>
                        <textarea name="address" class="form-control" rows="3"
                                  placeholder="House #, Street, City" required></textarea>
                        @error('address')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control"
                               placeholder="Lahore, Karachi, Islamabad..." required>
                        @error('city')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="checkout-box p-4">
                    <h5 class="fw-bold mb-3">Payment Method</h5>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio"
                               name="payment_method" value="cod" id="cod" checked>
                        <label class="form-check-label" for="cod">
                            💵 Cash on Delivery (COD)
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               name="payment_method" value="card" id="card">
                        <label class="form-check-label" for="card">
                            💳 Credit/Debit Card
                        </label>
                    </div>

                    @error('payment_method')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- Right: Order Summary --}}
            <div class="col-lg-5">
                <div class="summary-box p-4">
                    <h5 class="fw-bold mb-3">
                        Order Summary
                        @if($isBuyNow)
                            <span class="badge bg-warning text-dark ms-2"
                                  style="font-size: 0.7rem;">Buy Now</span>
                        @endif
                    </h5>

                    {{-- Items List --}}
                    @foreach($items as $item)
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
                                Qty: {{ $item->quantity }} ×
                                Rs {{ number_format($item->product->price, 2) }}
                            </p>
                        </div>
                        <span class="fw-semibold">
                            Rs {{ number_format($item->quantity * $item->product->price, 2) }}
                        </span>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rs {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>
                            @if($shipping == 0)
                                <span class="text-success fw-semibold">Free</span>
                            @else
                                Rs {{ number_format($shipping, 2) }}
                            @endif
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span>
                        <span>Rs {{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2">
                        <i class="fas fa-check me-2"></i>Place Order
                    </button>

                    <a href="{{ $isBuyNow ? route('shop') : route('cart.index') }}"
                       class="btn btn-outline-secondary w-100 py-2 mt-2">
                        ← {{ $isBuyNow ? 'Continue Shopping' : 'Back to Cart' }}
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection