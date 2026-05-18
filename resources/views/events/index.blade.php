@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">+ Create New Event</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Quota</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td class="align-middle fw-bold">{{ $event->title }}</td>
                    <td class="align-middle">{{ $event->date->format('d M Y, H:i') }}</td>
                    <td class="align-middle">
                        @if($event->price > 0)
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        @else
                            <span class="badge bg-success">Free</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ $event->tickets()->count() }} / {{ $event->quota }}</td>
                    <td class="align-middle">
                        <a href="{{ route('events.show.public', $event) }}" class="btn btn-sm btn-outline-info">View</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">You haven't created any events yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $events->links('pagination::bootstrap-5') }}
</div>
@endsection
