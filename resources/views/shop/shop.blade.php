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
          <img src="{{ asset('images/categories/cleanser.png') }}" alt="Cleanser">
          <h6>Cleanser</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/categories/serum.png') }}" alt="Serum">
          <h6>Serum</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/categories/moisturizer.png') }}" alt="Moisturizer">
          <h6>Moisturizer</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/categories/sunscreen.png') }}" alt="Sunscreen">
          <h6>Sunscreen</h6>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="category-card">
          <img src="{{ asset('images/categories/exfoliator.png') }}" alt="Exfoliator">
          <h6>Exfoliator</h6>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- PRODUCTS -->
<section id="products" class="product-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-4">Featured Products</h2>
    <div class="row g-4">

      <!-- PRODUCT 1 -->
      <div class="col-md-3 col-6">
        <div class="product-card">
          <div class="product-image">
            <img src="{{ asset('images/products/thesara_cleanser.png') }}" alt="Amino Cleanser">
          </div>
          <div class="product-info">
            <h6>Gentle Amino Cleanser</h6>
            <p>$22.00 <span class="discount">$29.00</span></p>
            <button class="btn btn-theme w-100 mt-2">Add to Cart</button>
          </div>
        </div>
      </div>

      <!-- PRODUCT 2 -->
      <div class="col-md-3 col-6">
        <div class="product-card">
          <div class="product-image">
            <img src="{{ asset('images/products/thesara_serum.png') }}" alt="Vitamin Serum">
          </div>
          <div class="product-info">
            <h6>Vitamin Radiance Serum</h6>
            <p>$30.00 <span class="discount">$39.00</span></p>
            <button class="btn btn-theme w-100 mt-2">Add to Cart</button>
          </div>
        </div>
      </div>

      <!-- PRODUCT 3 -->
      <div class="col-md-3 col-6">
        <div class="product-card">
          <div class="product-image">
            <img src="{{ asset('images/products/thesara_moisturizer.png') }}" alt="Hydra Moisturizer">
          </div>
          <div class="product-info">
            <h6>Hydra Balance Moisturizer</h6>
            <p>$25.00 <span class="discount">$30.00</span></p>
            <button class="btn btn-theme w-100 mt-2">Add to Cart</button>
          </div>
        </div>
      </div>

      <!-- PRODUCT 4 -->
      <div class="col-md-3 col-6">
        <div class="product-card">
          <div class="product-image">
            <img src="{{ asset('images/products/thesara_sunscreen.png') }}" alt="HydraGuard SPF 50">
          </div>
          <div class="product-info">
            <h6>HydraGuard SPF 50</h6>
            <p>$27.00 <span class="discount">$34.00</span></p>
            <button class="btn btn-theme w-100 mt-2">Add to Cart</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Shop JS -->
<script src="{{ asset('js/shop.js') }}"></script>
@endsection
