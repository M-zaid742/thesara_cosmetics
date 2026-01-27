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
        <h2>Create Account</h2>
        <p class="subtitle">Join our glowing community – shop, track orders & get AI skin tips.</p>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="form-group">
                <i class="bi bi-person"></i>
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full Name">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-envelope"></i>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn-primary">Create Account</button>

            <div class="switch">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
                &nbsp;•&nbsp;
                <a href="{{ route('admin.login') }}">Admin login</a>
            </div>
        </form>
    </div>
</div>
@endsection
