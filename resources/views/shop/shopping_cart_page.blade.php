@extends('layouts.app')

@section('title', 'Shopping Cart - Thesara Cosmetics')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">Your Shopping Cart</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($carts->count() > 0)
    <div class="row">

        {{-- Cart Items --}}
        <div class="col-lg-8">
            @foreach($carts as $item)
            <div class="cart-item mb-3">
                <div class="row align-items-center">

                    {{-- Product Image --}}
                    <div class="col-md-3 text-center">
                        <img src="{{ asset($item->product->image_url) }}"
                             alt="{{ $item->product->name }}"
                             class="img-fluid rounded"
                             style="height: 100px; object-fit: contain;">
                    </div>

                    {{-- Product Info --}}
                    <div class="col-md-4">
                        <a href="{{ route('product.show', $item->product->id) }}"
                           class="text-decoration-none text-dark">
                            <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                        </a>
                        <p class="text-muted mb-1">{{ $item->product->brand }}</p>
                        <p class="fw-semibold item-price">
                            Rs {{ number_format($item->product->price, 2) }}
                        </p>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Subtotal: Rs {{ number_format($item->product->price * $item->quantity, 2) }}
                        </p>
                    </div>

                    {{-- Quantity Controls --}}
                    <div class="col-md-3 d-flex align-items-center justify-content-center gap-2">
                            {{-- Decrease --}}
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit" class="quantity-btn btn-decrease" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                            </form>

                            <input type="text" value="{{ $item->quantity }}"
                                   class="quantity-input" readonly>

                            {{-- Increase --}}
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="quantity-btn btn-increase">+</button>
                            </form>
                    </div>

                    {{-- Remove Button --}}
                    <div class="col-md-2 text-end">
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-4">
            <div class="summary-box">
                <h5 class="fw-bold mb-3">Order Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Items ({{ $carts->sum('quantity') }})</span>
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

                @if($shipping > 0)
                    <div class="alert alert-info py-2 px-3 mb-2" style="font-size: 0.8rem;">
                        🛍️ Add Rs {{ number_format(3000 - $subtotal, 2) }} more for free shipping!
                    </div>
                @endif

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                    <span>Total</span>
                    <span>Rs {{ number_format($total, 2) }}</span>
                </div>

                {{-- Guest warning --}}
                @if($isGuest)
                    <div class="alert alert-warning py-2 px-3 mb-3" style="font-size: 0.85rem;">
                        <a href="{{ route('login') }}">Login</a> to save your cart and checkout.
                    </div>
                @endif

                {{-- Checkout Button --}}
                @if($isGuest)
                    <a href="{{ route('login') }}" class="btn btn-dark w-100 py-2">
                        <i class="fas fa-lock me-2"></i>Login to Checkout
                    </a>
                @else
                    <a href="{{ route('checkout') }}" class="btn btn-dark w-100 py-2">
                        <i class="fas fa-lock me-2"></i>Proceed to Checkout
                    </a>
                @endif

                <a href="{{ route('shop') }}" class="btn btn-outline-secondary w-100 py-2 mt-2">
                    ← Continue Shopping
                </a>
            </div>
        </div>

    </div>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <i class="fas fa-shopping-bag fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-dark px-5 py-2">
                Start Shopping
            </a>
        </div>
    @endif

</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection