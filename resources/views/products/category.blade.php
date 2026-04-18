@extends('layouts.app')

@section('title', ucfirst($category) . ' - Thesara Cosmetics')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/browse.css') }}">

    <!-- PRODUCTS GRID -->
    <section class="products-section">
        <div class="container">

            <h2 class="category-title">{{ ucfirst($category) }}</h2>

            @if($products->count() > 0)
                <p class="results-count">{{ $products->count() }} product{{ $products->count() != 1 ? 's' : '' }} found</p>
            @endif

            <div class="product-grid">
                @forelse($products as $product)
                    <div class="product-card">

                        <div class="product-img">
                            <a href="{{ route('product.show', $product->id) }}">
                                @if($product->image_url)
                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="no-img">🧴</div>
                                @endif
                            </a>
                            @if($product->badge)
                                <span class="product-badge">{{ $product->badge }}</span>
                            @elseif($product->stock <= 5 && $product->stock > 0)
                                <span class="product-badge">Low Stock</span>
                            @endif
                        </div>

                        <div class="product-info">
                            <a href="{{ route('product.show', $product->id) }}" class="product-name-link">
                                <h5 class="product-name">{{ $product->name }}</h5>
                            </a>
                            @if($product->subtitle)
                                <p class="product-subtitle">{{ $product->subtitle }}</p>
                            @else
                                <p class="product-subtitle">{{ Str::limit($product->description, 40) }}</p>
                            @endif

                            <div class="product-footer">
                                <span class="product-price">Rs. {{ number_format($product->price, 2) }}</span>
                                @if(isset($product->old_price) && $product->old_price)
                                    <span class="product-old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
                                @endif
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-add-bag">Add to Bag</button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="empty-state py-5 text-center w-100">
                        <div class="mb-4">
                            <i class="bi bi-search" style="font-size: 4rem; color: #e5c57c; opacity: 0.5;"></i>
                        </div>
                        <h3 class="fw-bold mb-3" style="color: #3b2c20;">No Products Found</h3>
                        <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">
                            We don't have any products in the <strong>{{ $category }}</strong> collection right now. 
                            Check back later or browse our full range.
                        </p>
                        <a href="{{ route('shop') }}" class="btn btn-dark px-5 py-2" style="border-radius: 50px;">Browse All Products</a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection