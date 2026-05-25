@extends('layouts.app')

@section('content')
@php
    $event = $transaction->ticket->event;
    $bookingFee = 5000;
    $tax = 2500;
    $total = $event->price + $bookingFee + $tax;
@endphp

<main class="max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
    <!-- Back navigation -->
    <a href="{{ route('events.show.public', $event) }}"
       class="inline-flex items-center gap-2 bg-surface border-2 border-on-surface px-4 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all font-label-md uppercase mb-stack-md"
       style="text-decoration:none;">
        <span class="material-symbols-outlined">arrow_back</span> Kembali ke Event
    </a>

    <!-- Stepper -->
    <div class="mb-stack-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-stack-md border-2 border-on-surface p-stack-md bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="flex items-center gap-stack-sm opacity-50">
            <span class="w-8 h-8 flex items-center justify-center bg-surface border-2 border-on-surface font-label-md text-label-md">1</span>
            <span class="font-label-md text-label-md uppercase">Tiket</span>
        </div>
        <div class="hidden md:block h-0.5 flex-grow bg-on-surface mx-4"></div>
        <div class="flex items-center gap-stack-sm">
            <span class="w-8 h-8 flex items-center justify-center bg-primary text-on-primary border-2 border-on-surface font-label-md text-label-md">2</span>
            <span class="font-label-md text-label-md uppercase">Pembayaran</span>
        </div>
        <div class="hidden md:block h-0.5 flex-grow bg-on-surface mx-4"></div>
        <div class="flex items-center gap-stack-sm opacity-50">
            <span class="w-8 h-8 flex items-center justify-center bg-surface border-2 border-on-surface font-label-md text-label-md">3</span>
            <span class="font-label-md text-label-md uppercase">Ringkasan</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Main Content Area: Payment Details -->
        <div class="lg:col-span-8 space-y-stack-lg">
            
            <!-- Step 2: Payment Details -->
            <section class="bg-surface border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="bg-secondary text-on-secondary p-stack-md border-b-2 border-on-surface">
                    <h2 class="font-headline-md text-headline-md uppercase">Pembayaran</h2>
                </div>
                
                <div class="p-stack-md grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <!-- Contact Info -->
                    <div class="md:col-span-2">
                        <label class="font-label-md text-label-md uppercase mb-2 block">Nama Lengkap</label>
                        <input class="w-full p-3 border-2 border-on-surface bg-background font-body-md focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all" value="{{ Auth::user()->name }}" type="text" readonly/>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="font-label-md text-label-md uppercase mb-2 block">Alamat Email</label>
                        <input class="w-full p-3 border-2 border-on-surface bg-background font-body-md focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all" value="{{ Auth::user()->email }}" type="email" readonly/>
                    </div>
                    
                    <!-- Payment Method Graphic Selection -->
                    <div class="md:col-span-2 pt-stack-sm">
                        <label class="font-label-md text-label-md uppercase mb-2 block">Metode Pembayaran</label>
                        <div class="grid grid-cols-3 gap-stack-sm">
                            <button class="border-2 border-on-surface p-stack-sm flex flex-col items-center justify-center bg-primary-fixed shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-1 active:shadow-none transition-all" type="button">
                                <span class="material-symbols-outlined mb-1" data-icon="credit_card">credit_card</span>
                                <span class="font-label-sm text-label-sm uppercase">Kartu</span>
                            </button>
                            <button class="border-2 border-on-surface p-stack-sm flex flex-col items-center justify-center bg-surface hover:bg-surface-container-high transition-all" type="button">
                                <span class="material-symbols-outlined mb-1" data-icon="account_balance_wallet">account_balance_wallet</span>
                                <span class="font-label-sm text-label-sm uppercase">Dompet</span>
                            </button>
                            <button class="border-2 border-on-surface p-stack-sm flex flex-col items-center justify-center bg-surface hover:bg-surface-container-high transition-all" type="button">
                                <span class="material-symbols-outlined mb-1" data-icon="qr_code_2">qr_code_2</span>
                                <span class="font-label-sm text-label-sm uppercase">Crypto</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Card Details -->
                    <div class="md:col-span-2">
                        <label class="font-label-md text-label-md uppercase mb-2 block">Nomor Kartu</label>
                        <div class="relative">
                            <input class="w-full p-3 pl-12 border-2 border-on-surface bg-background font-body-md focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all" placeholder="0000 0000 0000 0000" type="text"/>
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 opacity-50" data-icon="lock">lock</span>
                        </div>
                    </div>
                    <div>
                        <label class="font-label-md text-label-md uppercase mb-2 block">Masa Berlaku</label>
                        <input class="w-full p-3 border-2 border-on-surface bg-background font-body-md focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all" placeholder="MM / YY" type="text"/>
                    </div>
                    <div>
                        <label class="font-label-md text-label-md uppercase mb-2 block">CVV</label>
                        <input class="w-full p-3 border-2 border-on-surface bg-background font-body-md focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all" placeholder="123" type="text"/>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar: Order Summary -->
        <aside class="lg:col-span-4">
            <div class="sticky top-24 space-y-stack-md">
                <!-- Event Poster Preview -->
                <div class="bg-surface border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <img class="w-full h-48 object-cover border-b-2 border-on-surface" src="{{ $event->image_url }}" alt="{{ $event->title }}"/>
                    <div class="p-stack-md">
                        <h3 class="font-headline-md text-headline-md uppercase mb-1">{{ $event->title }}</h3>
                        <div class="flex items-center gap-stack-sm text-on-surface-variant mb-2">
                            <span class="material-symbols-outlined text-sm" data-icon="calendar_month">calendar_month</span>
                            <span class="font-label-sm text-label-sm uppercase">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-stack-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm" data-icon="location_on">location_on</span>
                            <span class="font-label-sm text-label-sm uppercase">{{ $event->location }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Summary Card -->
                <div class="bg-surface border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="p-stack-md border-b-2 border-on-surface">
                        <h2 class="font-headline-md text-headline-md uppercase">Ringkasan Pesanan</h2>
                    </div>
                    <div class="p-stack-md space-y-stack-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">1x Tiket</span>
                            <span class="font-label-md text-label-md">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Biaya Pemesanan</span>
                            <span class="font-label-md text-label-md">Rp {{ number_format($bookingFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Pajak &amp; Layanan</span>
                            <span class="font-label-md text-label-md">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="pt-stack-md mt-stack-md border-t-2 border-dashed border-on-surface">
                            <div class="flex justify-between items-end">
                                <span class="font-headline-md text-headline-md uppercase">Total</span>
                                <span class="font-display-lg text-headline-md text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-stack-md pt-0">
                        <form action="{{ route('transactions.pay', $transaction) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-primary text-on-primary border-2 border-on-surface py-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all group">
                                <span class="font-headline-md text-headline-md uppercase flex items-center justify-center gap-stack-sm">
                                    Konfirmasi Pembayaran
                                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform" data-icon="arrow_forward">arrow_forward</span>
                                </span>
                            </button>
                        </form>
                        <p class="text-center text-on-surface-variant font-label-sm text-label-sm mt-stack-sm italic">
                            Pembayaran aman oleh KARCIS-Pay
                        </p>
                    </div>
                </div>
                
                <!-- Ticket Stub Effect Tip -->
                <div class="relative bg-tertiary-fixed border-2 border-on-surface p-stack-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-background border-2 border-on-surface"></div>
                    <div class="absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-background border-2 border-on-surface"></div>
                    <div class="flex items-center gap-stack-md">
                        <span class="material-symbols-outlined text-4xl" data-icon="confirmation_number">confirmation_number</span>
                        <div>
                            <p class="font-label-md text-label-md uppercase">Pengiriman Instan</p>
                            <p class="text-body-md text-sm">Tiket langsung dikirim ke ponselmu setelah pembayaran dikonfirmasi.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </aside>
    </div>
</main>
@endsection