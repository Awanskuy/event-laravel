@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-dark text-white py-3">
                <h4 class="mb-0 text-center">Validate Ticket (Check-In)</h4>
            </div>
            <div class="card-body p-5">
                <p class="text-center text-muted mb-4">Scan the QR code or manually enter the code to validate a ticket.</p>
                <form action="{{ route('admin.tickets.validate.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">QR Code String / UUID</label>
                        <input type="text" name="qr_code" class="form-control form-control-lg text-center @error('qr_code') is-invalid @enderror" placeholder="Enter ticket code here..." required autofocus autocomplete="off">
                        @error('qr_code') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Validate Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
