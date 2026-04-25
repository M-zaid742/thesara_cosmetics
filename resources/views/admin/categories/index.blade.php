@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-theme shadow-sm" style="background: #1a1208; color: #d4a017; border-radius: 50px; padding: 10px 25px;">
                        <i class="fas fa-plus-circle mr-2"></i> Add New Category
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline shadow" style="border-top: 3px solid #d4a017;">
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th width="80">Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Products Count</th>
                                <th width="150" class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image_url)
                                            <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <div style="width: 50px; height: 50px; background: #eee; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle font-weight-bold">{{ $category->name }}</td>
                                    <td class="align-middle text-muted">{{ $category->slug }}</td>
                                    <td class="align-middle">{{ $category->products()->count() }}</td>
                                    <td class="text-right align-middle">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-info mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        No categories found. <a href="{{ route('admin.categories.create') }}">Create one now</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($categories->hasPages())
                    <div class="card-footer bg-white">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
