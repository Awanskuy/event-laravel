@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow-sm border-0 mt-4">
            @if($event->image)
                <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="max-height: 400px; object-fit: cover;">
            @endif
            <div class="card-body p-4">
                <h2 class="fw-bold">{{ $event->title }}</h2>
                <div class="d-flex align-items-center mb-4 mt-3">
                    <span class="badge bg-primary fs-6 me-3">
                        @if($event->price > 0)
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        @else
                            FREE
                        @endif
                    </span>
                    <span class="text-muted"><i class="bi bi-people-fill"></i> Quota: {{ $event->quota }} people</span>
                </div>

                <div class="row mb-4 bg-light p-3 rounded">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted"><strong>📅 Date & Time</strong></p>
                        <p class="mb-0">{{ $event->date->format('l, d F Y') }} <br> {{ $event->date->format('H:i') }} WIB</p>
                    </div>
                    <div class="col-md-6 border-start">
                        <p class="mb-1 text-muted"><strong>📍 Location</strong></p>
                        <p class="mb-0">{{ $event->location }}</p>
                    </div>
                </div>

                <h5 class="fw-bold mt-4">About this Event</h5>
                <p class="text-secondary" style="white-space: pre-line;">{{ $event->description }}</p>

                <hr class="my-4">
                
                <div class="text-center">
                    @auth
                        @if(Auth::user()->role === 'user')
                            <form action="{{ route('tickets.store', $event) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg px-5">Book Ticket Now</button>
                            </form>
                        @elseif(Auth::user()->role === 'organizer' && Auth::id() === $event->user_id)
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-secondary">Edit Event</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Login to Book Ticket</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
