@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <h3 class="mb-4">Edit Event: {{ $event->title }}</h3>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Event Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $event->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date & Time</label>
                            <input type="datetime-local" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $event->date->format('Y-m-d\TH:i')) }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $event->location) }}" required>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (IDR) - 0 for Free</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', (int)$event->price) }}" min="0" required>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ticket Quota</label>
                            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota', $event->quota) }}" min="1" required>
                            @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Event Poster (Leave blank to keep current)</label>
                        @if($event->image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($event->image) }}" alt="Current Poster" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
