@extends('layouts.admin')

@section('page-title', 'Validasi Tiket')

@section('content')
<div class="space-y-stack-lg">

    {{-- Page Header --}}
    <div class="border-2 border-on-surface p-stack-md bg-surface-container-low neubrutal-shadow flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <div>
            <h1 class="font-headline-lg text-xl font-black uppercase mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">qr_code_scanner</span>
                Validasi Tiket
            </h1>
            <p class="font-body-md text-sm text-on-surface-variant">
                Pindai kode QR atau masukkan kode tiket secara manual untuk check-in peserta.
            </p>
        </div>
    </div>

    {{-- Validation Form --}}
    <div class="max-w-xl mx-auto">
        <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">

            {{-- Card Header --}}
            <div class="p-4 border-b-2 border-on-surface bg-inverse-surface text-inverse-on-surface flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                <h2 class="font-headline-md text-base uppercase tracking-wider">Stasiun Check-In</h2>
            </div>

            {{-- Card Body --}}
            <div class="p-6 md:p-8 space-y-6">

                {{-- QR Code Icon --}}
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 border-2 border-on-surface bg-surface-container-low neubrutal-shadow-sm mb-3">
                        <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">qr_code_2</span>
                    </div>
                    <p class="text-on-surface-variant font-body-md text-sm">
                        Masukkan kode QR atau UUID tiket di bawah ini
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('admin.tickets.validate.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="font-label-md text-xs uppercase text-on-surface-variant block">
                            Kode QR / ID Tiket
                        </label>
                        <input type="text"
                               name="qr_code"
                               class="w-full bg-surface-container-low border-2 border-on-surface p-4 text-center font-mono text-base
                                      focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all
                                      placeholder:text-on-surface-variant/30 placeholder:font-body-md
                                      @error('qr_code') border-error bg-error-container/20 @enderror"
                               placeholder="e.g. a3f8b2c1-9d4e-4f6a-8b7c..."
                               value="{{ old('qr_code') }}"
                               required
                               autofocus
                               autocomplete="off" />
                        @error('qr_code')
                            <p class="text-error text-xs font-mono font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-primary text-on-primary p-4 border-2 border-on-surface neubrutal-shadow
                                   font-headline-md text-sm uppercase tracking-wider
                                   hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none
                                   active:translate-x-[4px] active:translate-y-[4px]
                                   transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        Validasi Tiket
                    </button>
                </form>
            </div>

            {{-- Card Footer --}}
            <div class="px-6 py-3 border-t-2 border-on-surface/10 bg-surface-container-low">
                <div class="flex items-center justify-center gap-4 text-[10px] font-mono text-on-surface-variant/60 uppercase">
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 bg-primary-container border border-on-surface inline-block"></span>
                        Aktif = Valid
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 bg-tertiary-container border border-on-surface inline-block"></span>
                        Terpakai = Ditolak
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 bg-error-container border border-on-surface inline-block"></span>
                        Menunggu = Belum Bayar
                    </span>
                </div>
            </div>
        </div>

        {{-- Info Box --}}
        <div class="mt-stack-lg border-2 border-dashed border-on-surface/30 p-4 bg-surface-container-low space-y-2">
            <h3 class="font-label-md text-xs uppercase text-on-surface-variant flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">info</span>
                Cara Kerja
            </h3>
            <ul class="space-y-1 text-sm text-on-surface-variant font-body-md">
                <li class="flex items-start gap-2">
                    <span class="font-mono text-primary font-bold">1.</span>
                    Setiap tiket punya kode QR unik yang dibuat saat pembelian.
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-mono text-primary font-bold">2.</span>
                    Pindai atau ketik kode untuk memvalidasi status tiket.
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-mono text-primary font-bold">3.</span>
                    Tiket valid ditandai sebagai "terpakai" setelah check-in.
                </li>
            </ul>
        </div>
    </div>

</div>
@endsection
