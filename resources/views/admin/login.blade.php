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

        <form id="loginForm"
              method="POST"
              action="{{ route('login') }}"
              data-user-action="{{ route('login') }}"
              data-admin-action="{{ route('admin.login.submit') }}"
              novalidate>
            @csrf

            <!-- Role selection to match Register page -->
            <div class="role-toggle" aria-label="Account type">
                <div class="role-option">
                    <input type="radio" id="role_user" name="role" value="user" {{ old('role','user')==='user' ? 'checked' : '' }}>
                    <label class="role-label" for="role_user">User</label>
                </div>
                <div class="role-option">
                    <input type="radio" id="role_admin" name="role" value="admin" {{ old('role')==='admin' ? 'checked' : '' }}>
                    <label class="role-label" for="role_admin">Admin</label>
                </div>
            </div>

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

            <div class="switch">
                New here? <a href="{{ route('register') }}">Create an account</a>
                &nbsp;•&nbsp;
                <a href="{{ route('admin.login') }}">Admin login</a>
            </div>
        </form>
    </div>
</div>
<script>
    // Switch login action between user and admin submissions without backend changes
    (function(){
        const form = document.getElementById('loginForm');
        const radios = document.querySelectorAll('input[name="role"]');
        const setAction = () => {
            const role = document.querySelector('input[name="role"]:checked')?.value || 'user';
            form.action = role === 'admin' ? form.dataset.adminAction : form.dataset.userAction;
        };
        radios.forEach(r => r.addEventListener('change', setAction));
        setAction();
    })();
    </script>
@endsection
@extends('layouts.app')
