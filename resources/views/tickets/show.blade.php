@extends('layouts.app')

@push('styles')
<style>
    .neubrutal-shadow {
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
    }
    .neubrutal-shadow-sm {
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
    }
    .ticket-cutout {
        position: relative;
    }
    .ticket-cutout::before, .ticket-cutout::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: #fcf9f2; /* same as body bg */
        border: 2px solid #1c1c18;
        border-radius: 50%;
        top: calc(100% - 10px);
        z-index: 10;
    }
    .ticket-cutout::before { left: -12px; }
    .ticket-cutout::after { right: -12px; }

    /* Success Pop Animation */
    @keyframes success-pop {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }
    .animate-success-pop {
        animation: success-pop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }

    /* Confetti Styles */
    @keyframes confetti-fall {
        0% {
            top: -20px;
            opacity: 1;
            transform: translateX(0) rotate(0deg);
        }
        100% {
            top: 100vh;
            opacity: 0;
            transform: translateX(100px) rotate(720deg);
        }
    }
    .neubrutal-confetti {
        position: absolute;
        pointer-events: none;
        border: 1.5px solid #1c1c18;
        box-shadow: 1px 1px 0px 0px rgba(0,0,0,1);
        z-index: 100;
    }

    /* Print Styles */
    @media print {
        header, footer, nav, .action-buttons, .back-link, #share-toast {
            display: none !important;
        }
        body {
            background-color: #ffffff !important;
        }
        main {
            padding: 0 !important;
            margin-top: 20px !important;
            max-width: 100% !important;
        }
        .neubrutal-shadow {
            box-shadow: none !important;
            border: 2px solid #1c1c18 !important;
        }
        .ticket-cutout::before, .ticket-cutout::after {
            background-color: #ffffff !important;
            border: 2px solid #1c1c18 !important;
        }
    }
</style>
@endpush

@section('content')
@if(session('success'))
    <div id="confetti-container" class="fixed inset-0 pointer-events-none z-50 overflow-hidden"></div>
@endif

<!-- Shared Link Toast -->
<div id="share-toast" class="hidden fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-primary-container text-on-primary-container border-2 border-on-surface px-6 py-3 hard-shadow font-label-md flex items-center gap-2 transition-all">
    <span class="material-symbols-outlined">share</span>
    TICKET LINK COPIED TO CLIPBOARD!
</div>

<main class="flex-grow flex flex-col items-center px-margin-mobile py-stack-lg max-w-2xl mx-auto w-full gap-stack-lg">
    
    <!-- Success Header -->
    <div class="text-center w-full">
        @if($ticket->status === 'active')
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-container border-2 border-on-surface neubrutal-shadow rounded-full mb-stack-md animate-success-pop">
                <span class="material-symbols-outlined text-3xl text-on-primary-container" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg uppercase mb-stack-sm tracking-tight text-primary">
                YOU'RE GOING TO {{ strtoupper($ticket->event->title) }}!
            </h1>
            <p class="font-body-md text-on-surface-variant max-w-md mx-auto">
                Order #{{ strtoupper(substr($ticket->qr_code, 0, 8)) }} confirmed. Your digital ticket is ready.
            </p>
        @elseif($ticket->status === 'used')
            <div class="inline-flex items-center justify-center w-16 h-16 bg-surface-container-highest border-2 border-on-surface neubrutal-shadow rounded-full mb-stack-md">
                <span class="material-symbols-outlined text-3xl text-on-surface" style="font-variation-settings: 'FILL' 1;">assignment_turned_in</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg uppercase mb-stack-sm tracking-tight">
                TICKET CHECKED IN
            </h1>
            <p class="font-body-md text-on-surface-variant max-w-md mx-auto">
                Ticket #{{ strtoupper(substr($ticket->qr_code, 0, 8)) }} was scanned at the entrance. Hope you have/had a blast!
            </p>
        @else
            <div class="inline-flex items-center justify-center w-16 h-16 bg-error-container border-2 border-on-surface neubrutal-shadow rounded-full mb-stack-md animate-pulse">
                <span class="material-symbols-outlined text-3xl text-on-error-container" style="font-variation-settings: 'FILL' 1;">pending</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg uppercase mb-stack-sm tracking-tight text-error">
                PAYMENT IS PENDING
            </h1>
            <p class="font-body-md text-on-surface-variant max-w-md mx-auto">
                Please complete your payment of ${{ number_format($ticket->event->price, 2) }} to activate this ticket.
            </p>
        @endif
    </div>

    <!-- TICKET CARD (Stub Aesthetic) -->
    <section class="w-full bg-white border-2 border-on-surface neubrutal-shadow overflow-hidden flex flex-col relative transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
        
        <!-- Ticket Header / Branding -->
        <div class="p-stack-md border-b-2 border-on-surface bg-primary-container flex justify-between items-center">
            <h2 class="font-label-md uppercase tracking-wider text-on-primary-container flex items-center gap-2">
                <span class="material-symbols-outlined">confirmation_number</span>
                {{ config('app.name', 'KARCIS') }} TICKET
            </h2>
            <span class="bg-on-surface text-white px-2 py-1 text-[10px] font-mono tracking-widest uppercase">
                {{ $ticket->status }}
            </span>
        </div>

        <div class="p-stack-md flex flex-col md:flex-row gap-stack-md">
            <!-- Event Image -->
            <div class="w-full md:w-40 h-36 bg-surface-container-highest border-2 border-on-surface overflow-hidden shrink-0 relative">
                <img alt="{{ $ticket->event->title }}" class="w-full h-full object-cover transition-all duration-300 hover:scale-105" 
                     src="{{ $ticket->event->image ? asset('storage/' . $ticket->event->image) : 'https://placehold.co/600x400/56642b/ffffff?text=Event' }}"/>
                @if($ticket->status === 'used')
                    <div class="absolute inset-0 bg-on-surface bg-opacity-70 flex items-center justify-center">
                        <span class="text-white font-headline-md text-xs border-2 border-white px-2 py-1 rotate-[-12deg] tracking-widest uppercase">USED</span>
                    </div>
                @endif
            </div>

            <!-- Event Details -->
            <div class="flex-grow grid grid-cols-2 gap-y-3">
                <div class="col-span-2">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">EVENT</p>
                    <p class="font-headline-md text-base leading-tight uppercase text-on-surface">
                        {{ $ticket->event->title }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">DATE</p>
                    <p class="font-bold text-sm text-on-surface">
                        {{ $ticket->event->date->format('M d, Y') }}
                    </p>
                    <p class="text-xs text-on-surface-variant mt-0.5">
                        {{ $ticket->event->date->format('g:i A') }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">TICKET TYPE</p>
                    <p class="font-bold text-sm text-on-surface">
                        {{ $ticket->event->price > 0 ? 'General Admission' : 'Free Entry' }}
                    </p>
                </div>
                <div class="col-span-2">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">LOCATION</p>
                    <div class="flex items-center gap-1 mt-0.5 text-on-surface">
                        <span class="material-symbols-outlined text-sm shrink-0">location_on</span>
                        <p class="font-bold text-sm truncate">{{ $ticket->event->location }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashed Divider with Ticket Cutouts -->
        <div class="ticket-cutout flex items-center px-4 py-2 bg-white">
            <div class="w-full border-t-2 border-dashed border-on-surface-variant"></div>
        </div>

        <!-- Ticket Footer Details -->
        <div class="p-stack-md flex flex-wrap justify-between items-center bg-surface-container-low gap-3 border-t border-on-surface-variant border-opacity-10">
            <div class="flex items-center gap-2">
                <div class="bg-on-surface text-white px-2 py-1 text-[10px] font-mono">
                    ID: {{ strtoupper(substr($ticket->qr_code, 0, 8)) }}
                </div>
                @if($ticket->transaction)
                    <div class="bg-primary-container text-on-primary-container px-2 py-1 text-[10px] font-mono hidden sm:inline-block">
                        TRANS: #{{ str_pad($ticket->transaction->id, 6, '0', STR_PAD_LEFT) }}
                    </div>
                @endif
            </div>
            
            <div class="font-headline-md uppercase text-base text-on-surface flex items-center gap-1">
                <span>TOTAL:</span>
                <span class="text-primary font-extrabold">${{ number_format($ticket->event->price, 2) }}</span>
            </div>
        </div>
    </section>

    <!-- QR CODE PREVIEW CARD -->
    <section class="w-full bg-white border-2 border-on-surface neubrutal-shadow p-stack-lg flex flex-col items-center gap-stack-md transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
        
        <div class="relative w-44 h-44 bg-primary-container border-2 border-on-surface p-2.5 flex items-center justify-center neubrutal-shadow-sm">
            @if($ticket->status === 'pending')
                <!-- Locked QR State -->
                <div class="bg-white p-2 border-2 border-on-surface w-full h-full flex flex-col items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-4xl text-error animate-pulse">lock</span>
                    <span class="font-label-sm text-[10px] uppercase text-error tracking-wider">Locked</span>
                </div>
            @else
                <!-- Active QR State -->
                <div class="bg-white p-1 border-2 border-on-surface w-full h-full flex items-center justify-center">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(140)->margin(0)->generate($ticket->qr_code) !!}
                </div>
            @endif
        </div>

        <div class="text-center w-full px-4">
            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">
                DIGITAL TICKET SIGNATURE
            </p>
            <p class="font-headline-md text-sm md:text-base tracking-wider break-all text-on-surface font-mono">
                {{ strtoupper($ticket->qr_code) }}
            </p>
            <p class="font-body-md text-xs text-on-surface-variant mt-2 max-w-sm mx-auto">
                @if($ticket->status === 'active')
                    Please present this screen or printed copy at check-in. The QR code is secure and unique to you.
                @elseif($ticket->status === 'used')
                    Scanned at event entrance. Checked in by {{ $ticket->user->name }}.
                @else
                    This QR code will be generated immediately after your payment goes through.
                @endif
            </p>
        </div>
    </section>

    <!-- Action Buttons -->
    <div class="w-full flex flex-col sm:flex-row gap-stack-md action-buttons">
        @if($ticket->status === 'pending')
            <!-- Pending Payment Actions -->
            <form action="{{ route('transactions.pay', $ticket->transaction) }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full bg-primary text-on-primary border-2 border-on-surface font-headline-md py-4 neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase">
                    SIMULATE PAYMENT
                </button>
            </form>
            <a href="{{ route('checkout', $ticket->transaction) }}" class="flex-1 text-center bg-secondary-container text-on-secondary-container border-2 border-on-surface font-headline-md py-4 neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase decoration-none block">
                GO TO CHECKOUT
            </a>
        @else
            <!-- Standard E-Ticket Actions -->
            <button onclick="window.print()" class="flex-1 bg-primary-container text-on-primary-container border-2 border-on-surface font-headline-md py-4 neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase">
                PRINT / SAVE PDF
            </button>
            <button onclick="shareTicket()" class="flex-1 bg-secondary-container text-on-secondary-container border-2 border-on-surface font-headline-md py-4 neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase">
                SHARE TICKET
            </button>
        @endif
    </div>

    <!-- Back to dashboard / tickets link -->
    <a class="flex items-center gap-1.5 text-on-surface-variant hover:text-on-surface transition-colors back-link font-label-md tracking-wider uppercase decoration-none py-2" 
       href="{{ route('tickets.index') }}">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        <span>MY TICKETS DASHBOARD</span>
    </a>

</main>
@endsection

@push('scripts')
<script>
    // Confetti generator for celebratory mood on successful payments
    @if(session('success'))
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById("confetti-container");
        if (!container) return;
        
        const colors = ['#56642b', '#8e4c3c', '#caa844', '#fea995', '#d9eaa3', '#ffe08c'];
        const shapes = ['rounded-full', '']; // circles & squares
        
        for (let i = 0; i < 40; i++) {
            const particle = document.createElement("div");
            const size = Math.floor(Math.random() * 12) + 8; // 8px to 20px
            const color = colors[Math.floor(Math.random() * colors.length)];
            const shape = shapes[Math.floor(Math.random() * shapes.length)];
            
            particle.className = `neubrutal-confetti ${shape}`;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.backgroundColor = color;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `-20px`;
            
            // Animation values
            const duration = Math.random() * 2 + 1.5; // 1.5s to 3.5s
            const delay = Math.random() * 0.4;
            particle.style.animation = `confetti-fall ${duration}s linear ${delay}s forwards`;
            
            container.appendChild(particle);
        }
    });
    @endif

    // Share Ticket link script
    function shareTicket() {
        const shareData = {
            title: 'My Ticket for {{ $ticket->event->title }}',
            text: 'I\'m going to {{ $ticket->event->title }}! Here\'s my digital ticket.',
            url: window.location.href
        };

        if (navigator.share && navigator.canShare && navigator.canShare(shareData)) {
            navigator.share(shareData).catch(console.error);
        } else {
            // Copy URL fallback
            navigator.clipboard.writeText(window.location.href).then(() => {
                const toast = document.getElementById('share-toast');
                if (!toast) return;
                
                toast.classList.remove('hidden');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 3000);
            }).catch(err => {
                console.error('Could not copy ticket URL: ', err);
            });
        }
    }
</script>
@endpush
