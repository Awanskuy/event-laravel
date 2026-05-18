@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>My Tickets</h3>
        </div>

        @forelse($tickets as $ticket)
        <div class="card shadow-sm border-0 mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($ticket->event->image)
                        <img src="{{ Storage::url($ticket->event->image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Event Image">
                    @else
                        <div class="bg-light h-100 d-flex align-items-center justify-content-center text-muted rounded-start">No Image</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title fw-bold mb-1">{{ $ticket->event->title }}</h5>
                            <span class="badge @if($ticket->status == 'active') bg-success @elseif($ticket->status == 'used') bg-secondary @else bg-warning text-dark @endif">
                                {{ strtoupper($ticket->status) }}
                            </span>
                        </div>
                        <p class="text-muted small mb-3">{{ $ticket->event->date->format('d M Y, H:i') }} | {{ $ticket->event->location }}</p>
                        
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-outline-primary btn-sm">View Ticket</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 bg-white shadow-sm rounded">
            <h5 class="text-muted mb-3">You don't have any tickets yet.</h5>
            <a href="{{ route('home') }}" class="btn btn-primary">Browse Events</a>
        </div>
        @endforelse

        <div class="mt-3">
            {{ $tickets->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
