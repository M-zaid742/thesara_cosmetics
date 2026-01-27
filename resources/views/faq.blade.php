{{-- resources/views/faq.blade.php --}}
@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">

<section class="faq-hero container">
    <h1 class="faq-title">Frequently Asked Questions</h1>
    <p class="faq-subtitle">Find answers to the most common questions about Thesara Cosmetics.</p>
</section>

<section class="faq-section container">
    <div class="faq-list">

        @foreach($faqs as $faq)
        <div class="faq-item">
            <button class="faq-question">
                {{ $faq['question'] }}
                <span class="arrow">+</span>
            </button>
            <div class="faq-answer">
                <p>{{ $faq['answer'] }}</p>
            </div>
        </div>
        @endforeach

    </div>
</section>

<script src="{{ asset('js/faq.js') }}" defer></script>
@endsection
