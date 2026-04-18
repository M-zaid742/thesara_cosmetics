@extends('layouts.app')

@section('title', 'Browse Products - Thesara Cosmetics')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/browse.css') }}">

    <!-- FILTER BAR -->
    <section class="filter-section">
        <div class="container">
            <form method="GET" action="{{ route('products.index') }}" class="filter-form">
                <input type="text" name="search" class="filter-input" placeholder="Search products…"
                    value="{{ request('search') }}">
                <select name="category" class="filter-select">
                    <option value="">All Categories</option>
                    <option value="cleanser" {{ request('category') == 'cleanser' ? 'selected' : '' }}>Cleanser</option>
                    <option value="serum" {{ request('category') == 'serum' ? 'selected' : '' }}>Serum</option>
                    <option value="moisturizer" {{ request('category') == 'moisturizer' ? 'selected' : '' }}>Moisturizer
                    </option>
                    <option value="sunscreen" {{ request('category') == 'sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                    <option value="exfoliator" {{ request('category') == 'exfoliator' ? 'selected' : '' }}>Exfoliator</option>
                    <option value="toner" {{ request('category') == 'toner' ? 'selected' : '' }}>Toner</option>
                    <option value="acne" {{ request('category') == 'acne' ? 'selected' : '' }}>Acne Treatment</option>
                </select>
                <button type="submit" class="btn-filter">Filter</button>
                @if(request('search') || request('category'))
                    <a href="{{ route('products.index') }}" class="btn-clear">Clear</a>
                @endif
            </form>
        </div>
    </section>

    <!-- PRODUCTS GRID -->
    <section class="products-section">
        <div class="container">

            <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
                <div>
                    @if(request('category'))
                        <h1 class="category-title text-capitalize">{{ request('category') }}</h1>
                    @else
                        <h1 class="category-title">All Products</h1>
                    @endif
                    @if($products->total() > 0)
                        <p class="results-count mb-0">{{ $products->total() }} product{{ $products->total() != 1 ? 's' : '' }} in this collection</p>
                    @endif
                </div>
            </div>

            <div class="product-grid">
                @forelse($products as $product)
                    <div class="product-card">

                        <div class="product-img">
                            <a href="{{ route('product.show', $product->id) }}">
                                @if($product->image_url)
                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" loading="lazy">
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
                                <p class="product-subtitle text-truncate">{{ $product->description }}</p>
                            @endif

                            <div class="product-footer mt-auto">
                                <span class="product-price">Rs. {{ number_format($product->price, 2) }}</span>
                                @if(isset($product->old_price) && $product->old_price)
                                    <span class="product-old-price">Rs. {{ number_format($product->old_price, 2) }}</span>
                                @endif
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-add-bag">
                                    <i class="bi bi-bag-plus me-2"></i>Add to Bag
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <h3>No products found</h3>
                        <p>Try adjusting your search or filter.</p>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </section>

    <script src="{{ asset('js/browse.js') }}"></script>

@endsection