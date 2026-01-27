@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Skin Analysis Result</h1>
    <p>Detected conditions: {{ $analysis->analysis_result }}</p>
    <h2>Recommendations</h2>
    <ul>
        @foreach($recommendations as $product)
            <li>{{ $product->name }} - ${{ $product->price }}</li>
        @endforeach
    </ul>
    <p class="alert alert-warning">{{ $disclaimer }}</p>
</div>
@endsection