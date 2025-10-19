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
        <div class="category-card">
          <img src="{{ asset('images/seller1.png') }}" alt="Cleanser">

          <h6>Cleanser</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/seller1.png') }}" alt="Cleanser">
          <h6>Serum</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/seller2.png') }}"  alt="Moisturizer">
          <h6>Moisturizer</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
        <img src="{{ asset('images/seller3.png') }}"  alt="Sunscreen">
          <h6>Sunscreen</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
        <img src="{{ asset('images/seller4.png') }}"  alt="Exfoliator">
          <h6>Exfoliator</h6>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="featured-products py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5 fw-bold">Featured Products</h2>

    <div class="row justify-content-center g-4">

      <!-- Product Card -->
      <div class="col-md-3 col-sm-6">
        <div class="product-card">
          <div class="product-badge">Bestseller</div>
          <div class="product-img">
            <img src="{{ asset('images/seller1.png') }}" alt="Moisture Boost">
          </div>
          <div class="product-info">
            <h5 class="product-title">Gentle Amino Cleanser</h5>
            <p class="product-subtitle">For all skin types</p>
            <div class="price">
              <span class="new-price">$22.00</span>
              <span class="old-price">$29.00</span>
            </div>
            <button class="add-btn">Add to Bag</button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="col-md-3 col-sm-6">
        <div class="product-card">
          <div class="product-badge gold">Save $5</div>
          <div class="product-img">
            <img src="{{ asset('images/seller2.png') }}" alt="Vitamin Serum">
          </div>
          <div class="product-info">
            <h5 class="product-title">Vitamin Radiance Serum</h5>
            <p class="product-subtitle">Brightening & glow</p>
            <div class="price">
              <span class="new-price">$27.00</span>
              <span class="old-price">$32.00</span>
            </div>
            <button class="add-btn">Add to Bag</button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="col-md-3 col-sm-6">
        <div class="product-card">
          <div class="product-badge">New</div>
          <div class="product-img">
            <img src="{{ asset('images/seller3.png') }}" alt="Hydra Moisturizer">
          </div>
          <div class="product-info">
            <h5 class="product-title">Hydra Balance Moisturizer</h5>
            <p class="product-subtitle">Hydration boost</p>
            <div class="price">
              <span class="new-price">$25.00</span>
              <span class="old-price">$30.00</span>
            </div>
            <button class="add-btn">Add to Bag</button>
          </div>
        </div>
      </div>

      <!-- Product Card -->
      <div class="col-md-3 col-sm-6">
        <div class="product-card">
          <div class="product-badge gold">Top Rated</div>
          <div class="product-img">
            <img src="{{ asset('images/seller4.png') }}" alt="SPF 50 Sunscreen">
          </div>
          <div class="product-info">
            <h5 class="product-title">HydraGuard SPF 50</h5>
            <p class="product-subtitle">Protect & nourish</p>
            <div class="price">
              <span class="new-price">$27.00</span>
              <span class="old-price">$34.00</span>
            </div>
            <button class="add-btn">Add to Bag</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Shop JS -->
<script src="{{ asset('js/shop.js') }}"></script>
@endsection
