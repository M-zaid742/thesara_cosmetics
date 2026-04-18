@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">Products</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.products.create') }}"
                       class="btn btn-sm font-weight-bold text-uppercase px-4"
                       style="background:#1a1208;color:#d4a017;border-radius:50px;">
                        <i class="fas fa-plus mr-1"></i> Add Product
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if(session('product_success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-2"></i>{{ session('product_success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            @endif

            {{-- Filter Bar --}}
            <div class="card mb-3" style="border-top:3px solid #d4a017;">
                <div class="card-body py-2">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="form-inline">
                        <input type="text" name="search" class="form-control form-control-sm mr-2"
                               placeholder="Search by name..." value="{{ request('search') }}" style="width:220px;">
                        <select name="category" class="form-control form-control-sm mr-2">
                            <option value="">All Categories</option>
                            @foreach(['serum','cleanser','moisturizer','toner','sunscreen','exfoliator','acne'] as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-dark mr-2">Filter</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    </form>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="card card-outline shadow-sm" style="border-top:3px solid #d4a017;">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title font-weight-bold text-uppercase" style="letter-spacing:1px;">
                        All Products
                    </h3>
                    <span class="badge badge-secondary">{{ $products->total() }} total</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f9f3ec;">
                            <tr>
                                <th width="60">Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td class="align-middle">
                                    @if($product->image_url)
                                        <img src="{{ asset($product->image_url) }}"
                                             alt="{{ $product->name }}"
                                             style="width:50px;height:50px;object-fit:cover;border-radius:8px;border:2px solid #d4a017;">
                                    @else
                                        <div style="width:50px;height:50px;background:#f0e6d3;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span class="font-weight-bold">{{ $product->name }}</span>
                                    @if($product->subtitle)
                                        <br><small class="text-muted">{{ $product->subtitle }}</small>
                                    @endif
                                    @if($product->badge)
                                        <span class="badge badge-warning ml-1">{{ $product->badge }}</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-light border text-capitalize">
                                        {{ $product->category ?? '—' }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold">
                                    Rs. {{ number_format($product->price, 0) }}
                                    @if($product->old_price)
                                        <br><small class="text-muted text-decoration-line-through">
                                            Rs. {{ number_format($product->old_price, 0) }}
                                        </small>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($product->stock !== null)
                                        <span class="{{ $product->stock < 5 ? 'text-danger font-weight-bold' : '' }}">
                                            {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($product->is_featured)
                                        <i class="fas fa-star text-warning" title="Featured"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                    No products found.
                                    <a href="{{ route('admin.products.create') }}">Add one now.</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($products->hasPages())
                <div class="card-footer bg-white">
                    {{ $products->links() }}
                </div>
                @endif
            </div>

        </div>
    </section>
</div>
@endsection
