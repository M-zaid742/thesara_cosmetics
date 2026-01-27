@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Notifications</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
                <tr>
                    <td>{{ $notification->type }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->read ? 'Read' : 'Unread' }}</td>
                    <td>
                        @if(!$notification->read)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Mark as Read</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No notifications found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $notifications->links() }} <!-- Pagination links -->
</div>
@endsection