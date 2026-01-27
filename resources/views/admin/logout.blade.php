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
        <h2>Logout</h2>
        <p class="subtitle">Are you sure you want to logout from admin panel?</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf

            <button type="submit" class="btn btn-primary">
                Logout
            </button>

            <div style="margin-top:15px;">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary" style="width:100%;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
