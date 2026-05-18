@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0 mt-4 text-center">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">Your E-Ticket</h4>
            </div>
            <div class="card-body p-5">
                <h3 class="fw-bold mb-1">{{ $ticket->event->title }}</h3>
                <p class="text-muted mb-4">{{ $ticket->event->date->format('d M Y, H:i') }} | {{ $ticket->event->location }}</p>

                @if($ticket->status === 'pending')
                    <div class="alert alert-warning">
                        <strong>Payment Required</strong><br>
                        Please complete your payment of Rp {{ number_format($ticket->event->price, 0, ',', '.') }} to activate this ticket.
                    </div>
                    <form action="{{ route('transactions.pay', $ticket->transaction) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg w-100">Simulate Payment</button>
                    </form>
                @else
                    <div class="mb-4 bg-light p-4 rounded d-inline-block border">
                        <!-- Display QR Code -->
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->generate($ticket->qr_code) !!}
                    </div>
                    <p class="text-muted small mb-0">Show this QR code at the entrance</p>
                    <p class="fw-bold mt-2 text-primary">Ticket ID: {{ substr($ticket->qr_code, 0, 8) }}</p>

                    @if($ticket->status === 'used')
                        <div class="alert alert-secondary mt-3">
                            <i class="bi bi-check-circle-fill"></i> This ticket has already been used for check-in.
                        </div>
                    @else
                        <div class="alert alert-success mt-3">
                            <i class="bi bi-check-circle-fill"></i> Ticket is Active and ready to use.
                        </div>
                    @endif
                @endif
            </div>
            <div class="card-footer text-muted text-start bg-light">
                <small>Booked by: {{ $ticket->user->name }} ({{ $ticket->user->email }})</small>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">← Back to My Tickets</a>
        </div>
    </div>
</div>
@endsection
