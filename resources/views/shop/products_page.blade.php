@extends('layouts.app')

@section('title', 'Shop - Thesara Cosmetics')

@section('content')

<!-- Shop Page Stylesheet -->
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">

<!-- HERO SECTION -->
<section class="shop-hero-section text-center">
  <div class="container">
    <h1 class="fw-bold">Discover Our Skin Care Collection</h1>
    <p>Explore premium Thesara products crafted to enhance your natural glow.</p>
    <a href="#products" class="btn btn-theme mt-2">Shop Now</a>
  </div>
</section>

<!-- CATEGORIES -->
<section class="category-section py-5 text-center">
  <div class="container">
    <h2 class="section-title mb-4">Shop By Category</h2>
    <div class="row justify-content-center g-4">

      <div class="col-6 col-md-2">
        <a href="{{ route('products.category', 'cleanser') }}" class="text-decoration-none text-dark">
          <div class="category-card">
            <img src="{{ asset('images/seller1.png') }}" alt="Cleanser">
            <h6>Cleanser</h6>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-2">
        <a href="{{ route('products.category', 'serum') }}" class="text-decoration-none text-dark">
          <div class="category-card">
            <img src="{{ asset('images/seller1.png') }}" alt="Serum">
            <h6>Serum</h6>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-2">
        <a href="{{ route('products.category', 'moisturizer') }}" class="text-decoration-none text-dark">
          <div class="category-card">
            <img src="{{ asset('images/seller2.png') }}" alt="Moisturizer">
            <h6>Moisturizer</h6>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-2">
        <a href="{{ route('products.category', 'sunscreen') }}" class="text-decoration-none text-dark">
          <div class="category-card">
            <img src="{{ asset('images/seller3.png') }}" alt="Sunscreen">
            <h6>Sunscreen</h6>
          </div>
        </a>
      </div>

      <div class="col-6 col-md-2">
        <a href="{{ route('products.category', 'exfoliator') }}" class="text-decoration-none text-dark">
          <div class="category-card">
            <img src="{{ asset('images/seller4.png') }}" alt="Exfoliator">
            <h6>Exfoliator</h6>
          </div>
        </a>
      </div>

    </div>
  </div>
</section>


<!-- FEATURED PRODUCTS -->
<section class="featured-products py-5" id="products">
  <div class="container">
    <h2 class="section-title text-center mb-5 fw-bold">Featured Products</h2>

    <div class="row justify-content-center g-4">

      @forelse($featuredProducts as $product)
      <div class="col-md-3 col-sm-6">
        <div class="product-card">

          @if($product->badge)
            <div class="product-badge {{ in_array($product->badge, ['Save $5', 'Top Rated']) ? 'gold' : '' }}">
              {{ $product->badge }}
            </div>
          @endif

          <div class="product-img">
            <a href="{{ route('product.show', $product->id) }}">
              <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
            </a>
          </div>

          <div class="product-info">
            <h5 class="product-title">{{ $product->name }}</h5>
            <p class="product-subtitle">{{ $product->subtitle }}</p>
            <div class="price">
              <span class="new-price">${{ number_format($product->price, 2) }}</span>
              @if($product->old_price)
                <span class="old-price">${{ number_format($product->old_price, 2) }}</span>
              @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <button type="submit" class="add-btn">Add to Bag</button>
            </form>
          </div>

        </div>
      </div>
      @empty
        <p class="text-center text-muted">No featured products available.</p>
      @endforelse

    </div>
  </div>
</section>

<!-- Shop JS -->
<script src="{{ asset('js/shop.js') }}"></script>
@endsection