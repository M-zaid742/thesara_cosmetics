@extends('layouts.app')

@section('content')
<div class="container section">
    <div class="d-flex justify-content-between align-items-start align-items-md-center flex-wrap gap-2 mb-4">
        <div>
            <span class="hero-tag">ACCOUNT</span>
            <h3 class="section-title mb-1">Edit Profile</h3>
            <p class="text-muted mb-0">Update your photo and skin profile details.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.show') }}" class="btn btn-outline-dark hero-btn">Back to Profile</a>
            <a href="{{ route('shop') }}" class="btn btn-dark hero-btn">Shop</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0">Profile Photo</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if(Auth::user()->profile_image)
                            <img
                                src="{{ asset('storage/'.Auth::user()->profile_image) }}"
                                alt="{{ Auth::user()->name }}"
                                class="rounded-circle"
                                style="width: 72px; height: 72px; object-fit: cover;"
                            >
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                 style="width: 72px; height: 72px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 48px;"></i>
                            </div>
                        @endif
                        <div>
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-muted small">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Upload new photo</label>
                        <input type="file" name="profile_image" form="profile-update-form" class="form-control" accept="image/*">
                        <div class="form-text">JPG, PNG, or WEBP. Max 2MB.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0">Skin Profile</h6>
                </div>
                <div class="card-body">
                    <form id="profile-update-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Skin Type</label>
                                <input type="text" name="skin_type" class="form-control" value="{{ $profile->skin_type ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" value="{{ $profile->age ?? '' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Concerns</label>
                                <textarea name="concerns" class="form-control" rows="4" required>{{ $profile->concerns ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection