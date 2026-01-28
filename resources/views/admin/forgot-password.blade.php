@extends('layouts.app')

@section('content')
<!-- Auth Page Stylesheet -->
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-container">
    <!-- Visual side using splash image -->
    <div class="auth-image">
        <div class="overlay">
            <h1>Thesara Cosmetics</h1>
            <p>Elevate your natural beauty</p>
        </div>
    </div>

    <!-- Form side -->
    <div class="auth-form">
        <h2>Update Password</h2>
        <p class="subtitle">Enter your current password and choose a new password.</p>

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="current_password" type="password" class="@error('current_password') is-invalid @enderror" name="current_password" required placeholder="Current Password" autofocus>
                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="new_password" type="password" class="@error('new_password') is-invalid @enderror" name="new_password" required placeholder="New Password">
                @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="new_password_confirmation" type="password" class="@error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required placeholder="Confirm New Password">
                @error('new_password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>

            <div style="margin-top:15px;">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary" style="width:100%;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
