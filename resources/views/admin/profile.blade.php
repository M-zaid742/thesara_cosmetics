@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/css/admin-profile.css') }}">

<div class="admin-profile-wrapper">
    <div class="profile-card">
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <div class="profile-header">
            <!-- Clickable avatar -->
            <div class="avatar" id="avatar-preview" onclick="document.getElementById('profile-image-input').click()">
                @if(auth('admin')->user()->profile_image)
                    <img src="{{ asset('storage/' . auth('admin')->user()->profile_image) }}" alt="Profile Image">
                @else
                    <i class="bi bi-person"></i>
                @endif
            </div>
            <div class="info">
                <h2>Admin Profile</h2>
                <p>Thesara Cosmetics Administration</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Hidden input inside form -->
            <input type="file" name="profile_image" id="profile-image-input" accept="image/*" onchange="previewImage(event)" style="display:none">

            <div class="form-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ auth('admin')->user()->name }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="{{ auth('admin')->user()->email }}" disabled>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <input type="text" value="{{ auth('admin')->user()->role }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" rows="3" placeholder="Write something about yourself...">{{ auth('admin')->user()->bio }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn-save">Update Profile</button>
                <a href="{{ route('admin.password.form') }}" class="btn-save" style="background:#8b6a2e; margin-left:10px;">Change Password</a>
                <a href="{{url('admin/logout')}} "class="btn-save" style="background:#b03030; margin-left:10px;">Logout</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('avatar-preview');
        output.innerHTML = '<img src="'+reader.result+'" alt="Profile Image">';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
