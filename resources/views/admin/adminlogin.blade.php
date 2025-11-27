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
        <h2>Welcome Back</h2>
        <p class="subtitle">Login to continue shopping and track your orders.</p>

        <form method="POST" action=" " novalidate>
            @csrf


            <div class="form-group">
                <i class="bi bi-envelope"></i>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address" autofocus>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="options">
                <div>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary">Login</button>

        
        </form>
    </div>
</div>
@endsection