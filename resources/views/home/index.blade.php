@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 mb-4 text-center mt-4">
        <h1 class="display-5 fw-bold">Find the Best Events</h1>
        <p class="text-muted">Book your tickets digitally and check in easily with QR Codes.</p>
    </div>
</div>

<div class="row">
    @forelse($events as $event)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            @if($event->image)
                <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-secondary" style="height: 200px;">
                    <span>No Image Available</span>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title text-truncate">{{ $event->title }}</h5>
                <p class="card-text text-muted mb-2 small">
                    <strong>📍 Location:</strong> {{ $event->location }} <br>
                    <strong>📅 Date:</strong> {{ $event->date->format('d M Y, H:i') }}
                </p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fs-5 fw-bold text-primary">
                        @if($event->price > 0)
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        @else
                            <span class="badge bg-success">FREE</span>
                        @endif
                    </span>
                    <a href="{{ route('events.show.public', $event) }}" class="btn btn-outline-primary btn-sm px-3">Details</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <h4 class="text-muted">No upcoming events right now.</h4>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $events->links('pagination::bootstrap-5') }}
</div>
@endsection
