{{-- resources/views/about.blade.php --}}
@extends('layouts.app')


@section('title', 'About Us')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

<section class="about-hero" aria-label="About hero">
  <div class="container about-hero-inner">
    <div class="about-hero-left">
      <span class="badge">Premium Cosmetic</span>
      <h1 class="brand-title">{{ $brand['tagline'] ?? 'Reveal The Beauty Of Skin' }}</h1>
      <p class="brand-lead">{{ $brand['mission'] ?? 'Elevate your natural beauty ...' }}</p>
      <a href="{{ url('/shop') }}" class="btn-primary" aria-label="Explore our shop">Explore Now</a>
    </div>

    <figure class="about-hero-right">
      <img src="{{ asset($brand['hero_image'] ?? 'images/serum.PNG') }}" 
           alt="{{ $brand['hero_alt'] ?? 'Featured product' }}" 
           class="category-img" loading="lazy">
    </figure>
  </div>
</section>

<section class="brand-story container">
  <div class="grid two-col">
    <div>
      <h2>Our Story</h2>
      <p>THESARA COSMETICS started with a simple idea: create luxurious skin products that are gentle and effective. Our formulas blend science and nature to deliver real results.</p>
      <ul class="values">
        <li><strong>Natural Ingredients</strong> — Clean, ethically-sourced actives.</li>
        <li><strong>Science-Backed</strong> — Formulated with dermatologists.</li>
        <li><strong>Sustainable</strong> — Eco-friendly packaging & practices.</li>
      </ul>
    </div>
    <div>
      <h2>Our Mission</h2>
      <p>To help every person feel confident in their skin by providing premium, cruelty-free skincare made with love and tested for results.</p>
      <blockquote class="quote">“Beauty is health — healthy skin, confident you.”</blockquote>
    </div>
  </div>
</section>

<section class="team container" aria-labelledby="team-heading">
  <h2 id="team-heading" class="section-title">Meet The Team</h2>
  <div class="team-grid">
    @forelse($team ?? [] as $member)
      @php
        $slug = \Illuminate\Support\Str::slug($member['name'] ?? 'member');
      @endphp
      <article class="team-card" aria-labelledby="member-{{ $slug }}">
          <img src="{{ asset($member['avatar'] ?? 'images/person-icon-1682 copy.png') }}" 
              alt="{{ $member['name'] ?? 'Team member' }}" 
              class="category-img" loading="lazy">
        <h3 id="member-{{ $slug }}">{{ $member['name'] ?? 'Name' }}</h3>
        <p class="role">{{ $member['role'] ?? '' }}</p>
        <p class="bio">{{ $member['bio'] ?? '' }}</p>
        <button class="more-btn" data-name="{{ $member['name'] ?? '' }}" aria-label="View {{ $member['name'] ?? 'profile' }}">View</button>
      </article>
    @empty
      <p class="muted">No team members to display yet.</p>
    @endforelse
  </div>
</section>

<section class="cta container">
  <div class="cta-inner">
    <h3>Ready to glow?</h3>
    <p>Explore our product range and find the perfect routine for your skin.</p>
    <a href="{{ url('/shop') }}" class="btn-secondary">Shop Now</a>
  </div>
</section>

<script src="{{ asset('js/about.js') }}" defer></script>
@endsection