@extends('layouts.app')

@section('content')

{{-- ✅ Link external CSS --}}
<link rel="stylesheet" href="{{ asset('css/product.css') }}">

<!-- Breadcrumb Navigation -->
<div class="breadcrumb-nav">
    <a href="/">Home</a> / 
    <a href="/products">Products</a> / 
    <a href="/products?category={{ $product->category }}">{{ $product->category }}</a> / 
    <span>{{ $product->name }}</span>
</div>

<div class="product-container">
    <div class="product-grid">
        <!-- Left: Image Gallery -->
        <div class="image-gallery">
            <div class="main-image-container">
                @if($product->images->count() > 0)
                    <img id="mainImage" src="{{ asset('uploads/products/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                @else
                    <img id="mainImage" src="{{ asset('uploads/products/' . $product->image_url) }}" alt="{{ $product->name }}">
                @endif
                <div class="zoom-badge">🔍 Hover to zoom</div>
            </div>

            @if($product->images->count() > 0)
                <div class="thumbnail-grid">
                    @foreach($product->images as $index => $img)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                            onclick="changeImage(this, '{{ asset('uploads/products/' . $img->image_path) }}')">
                            <img src="{{ asset('uploads/products/' . $img->image_path) }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Product Details -->
        <div class="product-details">
            <div class="product-badge">Premium Quality</div>
            
            <h1 class="product-name">{{ $product->name }}</h1>
            
            <div class="product-category">
                <span>{{ $product->category }}</span>
                <span>•</span>
                <span>{{ $product->brand }}</span>
            </div>

            <div class="rating-section">
                <div class="stars">★★★★★</div>
                <span class="rating-text">4.8 (124 reviews)</span>
            </div>

            <div class="price-section">
                <div class="current-price">Rs {{ number_format($product->price) }}</div>
                <div class="price-note">Inclusive of all taxes • Free shipping on orders over Rs 3,000</div>
            </div>

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

            <p class="product-description">{{ $product->description }}</p>

            <div class="action-section">
                <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-primary" @if($product->stock == 0) disabled @endif>
                        🛒 Add to Cart
                    </button>
                </form>

                <form action="{{ route('wishlist.add') }}" method="POST" style="flex: 1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn-secondary">
                        ♡ Save to Wishlist
                    </button>
                </form>
            </div>

            <!-- Product Features -->
            <div class="features-grid">
                <div class="feature-item">
                    <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="feature-text">100% Authentic Products</div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    <div class="feature-text">Easy Returns & Exchange</div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="feature-text">Fast Delivery (2-5 days)</div>
                </div>

                <div class="feature-item">
                    <svg class="feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <div class="feature-text">Secure Payment Options</div>
                </div>
            </div>

            <!-- Accordion Section -->
            <div class="accordion-container">
                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Product Details & Ingredients</span>
                        <span class="accordion-icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p><strong>Key Ingredients:</strong></p>
                            <p>Water (Aqua), Glycerin, Vitamin E, Aloe Vera Extract, SPF 50 Complex, Hyaluronic Acid, Green Tea Extract, and other skin-friendly ingredients.</p>
                            <br>
                            <p><strong>Benefits:</strong></p>
                            <p>Provides broad-spectrum protection, deeply moisturizes, non-greasy formula, suitable for all skin types, dermatologically tested.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span>How to Use</span>
                        <span class="accordion-icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p>Apply generously on face and neck 15 minutes before sun exposure. Reapply every 2-3 hours or after swimming, sweating, or towel drying.</p>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Customer Reviews (124)</span>
                        <span class="accordion-icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <div class="review-item">
                                <div class="review-header">
                                    <span class="reviewer-name">Ayesha K.</span>
                                    <span class="review-stars">★★★★★</span>
                                </div>
                                <p class="review-text">"Absolutely love this sunscreen! It's lightweight and gives my skin a soft glow."</p>
                            </div>
                            <div class="review-item">
                                <div class="review-header">
                                    <span class="reviewer-name">Sara M.</span>
                                    <span class="review-stars">★★★★☆</span>
                                </div>
                                <p class="review-text">"Perfect for oily skin! Doesn't feel greasy at all."</p>
                            </div>
                            <div class="review-item">
                                <div class="review-header">
                                    <span class="reviewer-name">Fatima R.</span>
                                    <span class="review-stars">★★★★★</span>
                                </div>
                                <p class="review-text">"Been using this for weeks — it's my new favorite!"</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span>Shipping & Returns</span>
                        <span class="accordion-icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <div class="accordion-body">
                            <p><strong>Shipping:</strong> Free shipping on orders over Rs 3,000. Standard delivery takes 2-5 business days.</p>
                            <br>
                            <p><strong>Returns:</strong> 7-day easy return policy. Products must be unused and in original packaging.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ✅ Link external JS --}}
<script src="{{ asset('js/product.js') }}"></script>

@endsection