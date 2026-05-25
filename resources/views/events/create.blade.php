@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-surface border-2 border-on-surface shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8">
    <h1 class="text-2xl font-black uppercase border-b-2 border-on-surface pb-3 mb-6 text-on-surface">
        Buat Event Baru
    </h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Judul Event</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium">
            @error('title') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Deskripsi</label>
            <textarea name="description" rows="4" required
                      class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium resize-none">{{ old('description') }}</textarea>
            @error('description') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal & Lokasi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Tanggal &amp; Waktu</label>
                <input type="datetime-local" name="date" value="{{ old('date') }}" required
                       class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium">
                @error('date') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" required
                       class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium">
                @error('location') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Harga & Kuota --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Harga Tiket (IDR) &mdash; 0 untuk Gratis</label>
                <input type="number" name="price" value="{{ old('price', 0) }}" min="0" required
                       class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium">
                @error('price') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Kuota Tiket</label>
                <input type="number" name="quota" value="{{ old('quota', 100) }}" min="1" required
                       class="border-2 border-on-surface rounded-none bg-background focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] px-4 py-2 w-full font-medium">
                @error('quota') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Kategori</label>
            <select name="category" required
                    class="border-2 border-on-surface rounded-none bg-background px-4 py-2 w-full font-medium appearance-none cursor-pointer">
                @foreach(['music' => 'Music', 'tech' => 'Tech', 'art' => 'Art', 'food' => 'Food'] as $value => $label)
                    <option value="{{ $value }}" {{ old('category') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('category') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
        </div>

        {{-- Poster --}}
        <div>
            <label class="block font-bold text-on-surface mb-1 uppercase text-sm tracking-wide">Poster Event (Opsional)</label>
            <input type="file" name="image" accept="image/*"
                   class="border-2 border-on-surface rounded-none bg-background px-4 py-2 w-full font-medium file:mr-4 file:border-2 file:border-on-surface file:bg-primary file:text-on-primary file:font-bold file:uppercase file:px-3 file:py-1 file:cursor-pointer">
            @error('image') <p class="text-error font-bold text-sm mt-1 border-l-4 border-error pl-2">{{ $message }}</p> @enderror
        </div>

        {{-- Aksi --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="bg-primary text-on-primary border-2 border-on-surface font-bold px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all uppercase tracking-wide">
                Buat Event
            </button>
            <a href="{{ route('events.manage') }}"
               class="bg-surface text-on-surface border-2 border-on-surface font-bold px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all uppercase tracking-wide inline-block">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
