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
      <a href="{{ route('products.index') }}" class="btn btn-theme mt-2"> Browse Products</a>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="category-section py-5 text-center">
    <div class="container">
      <h2 class="section-title mb-4">Shop By Category</h2>
      <div class="row justify-content-center g-4">

        @foreach($categories as $category)
        <div class="col-6 col-md-2">
          <a href="{{ route('products.category', $category->slug) }}" class="text-decoration-none text-dark">
            <div class="category-card">
              @if($category->image_url)
                <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}">
              @else
                <img src="{{ asset('images/default-category.png') }}" alt="{{ $category->name }}">
              @endif
              <h6>{{ $category->name }}</h6>
            </div>
          </a>
        </div>
        @endforeach

      </div>
    </div>
  </section>


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
                  {{-- FIXED: use image_url column (no storage/ prefix needed) --}}
                  <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                </a>
              </div>

              <div class="product-info">
                <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                  <h5 class="product-title">{{ $product->name }}</h5>
                </a>
                <p class="product-subtitle">{{ $product->subtitle }}</p>
                <div class="price">
                  <span class="new-price">Rs. {{ number_format($product->price, 2) }}</span>
                  @if($product->old_price)
                    <span class="old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
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