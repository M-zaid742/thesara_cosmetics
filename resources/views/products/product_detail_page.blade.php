@extends('layouts.app')

@section('title', $product->name . ' - Thesara Cosmetics')

@section('content')

<link rel="stylesheet" href="{{ asset('css/product.css') }}">

<!-- Breadcrumb Navigation -->
<div class="breadcrumb-nav">
    <a href="/">Home</a> / 
    <a href="{{ route('shop') }}">Products</a> / 
    <a href="{{ route('products.category', $product->category) }}">
        {{ ucfirst($product->category) }}
    </a> / 
    <span>{{ $product->name }}</span>
</div>

<div class="product-container">
    <div class="product-grid">

        <!-- Left: Image Gallery -->
        <div class="image-gallery">
            <div class="main-image-container">
                @if($product->images->count() > 0)
                    <img id="mainImage" 
                         src="{{ asset($product->images->first()->image_path) }}" 
                         alt="{{ $product->name }}">
                @else
                    <img id="mainImage" 
                         src="{{ asset($product->image_url) }}" 
                         alt="{{ $product->name }}">
                @endif
                <div class="zoom-badge">🔍 Hover to zoom</div>
            </div>

            @if($product->images->count() > 0)
                <div class="thumbnail-grid">
                    @foreach($product->images as $index => $img)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                             onclick="changeImage(this, '{{ asset($img->image_path) }}')">
                            <img src="{{ asset($img->image_path) }}" 
                                 alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Product Details -->
        <div class="product-details">

            <div class="product-badge">
                {{ $product->badge ?? 'Premium Quality' }}
            </div>

            <h1 class="product-name">{{ $product->name }}</h1>

            <div class="product-category">
                <span>{{ ucfirst($product->category) }}</span>
                <span>•</span>
                <span>{{ $product->brand }}</span>
            </div>

            @php 
                $avgRating = $product->reviews->avg('rating') ?? 0;
                $reviewCount = $product->reviews->count();
            @endphp

            <div class="rating-section">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($avgRating) ? '★' : '☆' }}
                    @endfor
                </div>
                <span class="rating-text">
                    {{ $reviewCount > 0 ? number_format($avgRating, 1) : 'No ratings yet' }}
                    ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
                </span>
            </div>

            <!-- Price -->
            <div class="price-section">
                <div class="current-price">
                    Rs {{ number_format($product->price) }}
                </div>

                @if($product->old_price)
                    <div class="old-price">
                        Rs {{ number_format($product->old_price) }}
                    </div>
                @endif

                <div class="price-note">
                    Inclusive of all taxes • Free shipping on orders over Rs 3,000
                </div>
            </div>

            <!-- Stock -->
            @if($product->stock > 0)
                <div class="stock-status in-stock">
                    <span class="stock-dot"></span>
                    In Stock • {{ $product->stock }} units available
                </div>
            @else
                <div class="stock-status out-of-stock">
                    <span class="stock-dot"></span>
                    Out of Stock
                </div>
            @endif

            <!-- Description -->
            <p class="product-description">
                {{ $product->description }}
            </p>

            <!-- Action Buttons -->
            <div class="action-section">

                <!-- Add to Cart -->
                <form action="{{ route('cart.add') }}" method="POST" style="flex:1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-secondary w-100"
                            @if($product->stock == 0) disabled @endif>
                        🛒 Add to Cart
                    </button>
                </form>

                <!-- Buy Now -->
                <form action="{{ route('buy.now') }}" method="POST" style="flex:1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-primary w-100"
                            @if($product->stock == 0) disabled @endif>
                        ⚡ Buy Now
                    </button>
                </form>


            </div>

            <!-- Features -->
            <div class="features-grid">
                <div class="feature-item">✔ 100% Authentic Products</div>
                <div class="feature-item">↩ Easy Returns & Exchange</div>
                <div class="feature-item">🚚 Fast Delivery (2-5 days)</div>
                <div class="feature-item">🔒 Secure Payment Options</div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/product.js') }}"></script>

@endsection