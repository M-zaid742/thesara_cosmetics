@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Profile</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="form-group">
            <label>Skin Type</label>
            <input type="text" name="skin_type" class="form-control" value="{{ $profile->skin_type ?? '' }}" required>
        </div>
        <div class="form-group">
            <label>Concerns</label>
            <textarea name="concerns" class="form-control" required>{{ $profile->concerns ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ $profile->age ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection