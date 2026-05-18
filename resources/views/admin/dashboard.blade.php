@extends('layouts.app')

@push('styles')
<style>
    .neubrutal-shadow {
        box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
    }
    .neubrutal-shadow-sm {
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
    }
    .neubrutal-shadow-lg {
        box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
    }
    
    .status-badge {
        border: 2px solid #1c1c18;
        box-shadow: 1px 1px 0px 0px rgba(0,0,0,1);
    }
</style>
@endpush

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg space-y-stack-lg">
    
    <!-- Title & System Telemetry Header -->
    <div class="border-2 border-on-surface p-stack-md bg-surface-container-low neubrutal-shadow flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-display-lg text-2xl md:text-4xl font-black uppercase mb-1">
                KARCIS OPERATIONS CONTROL
            </h1>
            <p class="font-body-md text-on-surface-variant max-w-2xl">
                Real-time system telemetry, transactional auditing, ticket validation records, and platform controls.
            </p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <span class="w-3.5 h-3.5 bg-primary-container rounded-full border-2 border-on-surface animate-pulse"></span>
            <span class="font-mono text-xs font-bold uppercase tracking-wider text-on-surface-variant">TELEMETRY ONLINE</span>
        </div>
    </div>

    <!-- Bento Analytics Matrix Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
        
        <!-- Metric Panel 1: Revenue -->
        <div class="border-2 border-on-surface p-stack-md bg-primary-fixed neubrutal-shadow flex flex-col justify-between h-44 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-primary-fixed-variant uppercase tracking-wider font-bold mb-1">
                    GROSS SYSTEM REVENUE
                </p>
                <h3 class="font-headline-lg text-2xl md:text-3xl text-on-primary-fixed leading-none">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto">
                <span class="text-on-primary-fixed-variant font-mono text-[10px] uppercase font-bold">100% PAID SETTLEMENTS</span>
                <span class="material-symbols-outlined text-on-primary-fixed-variant text-2xl" style="font-variation-settings: 'FILL' 1;">payments</span>
            </div>
        </div>

        <!-- Metric Panel 2: Tickets Sold -->
        <div class="border-2 border-on-surface p-stack-md bg-secondary-fixed neubrutal-shadow flex flex-col justify-between h-44 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-secondary-fixed-variant uppercase tracking-wider font-bold mb-1">
                    TOTAL TICKETS RESERVED
                </p>
                <h3 class="font-headline-lg text-2xl md:text-3xl text-on-secondary-fixed leading-none">
                    {{ number_format($totalTickets) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto">
                <span class="text-on-secondary-fixed-variant font-mono text-[10px] uppercase font-bold">ACTIVE &amp; USED COUNT</span>
                <span class="material-symbols-outlined text-on-secondary-fixed-variant text-2xl" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
            </div>
        </div>

        <!-- Metric Panel 3: Active Events -->
        <div class="border-2 border-on-surface p-stack-md bg-tertiary-fixed neubrutal-shadow flex flex-col justify-between h-44 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-tertiary-fixed-variant uppercase tracking-wider font-bold mb-1">
                    TOTAL LISTED EVENTS
                </p>
                <h3 class="font-headline-lg text-2xl md:text-3xl text-on-tertiary-fixed leading-none">
                    {{ number_format($totalEvents) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto">
                <span class="text-on-tertiary-fixed-variant font-mono text-[10px] uppercase font-bold">LIVE STAGE LISTINGS</span>
                <span class="material-symbols-outlined text-on-tertiary-fixed-variant text-2xl" style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
        </div>

        <!-- Metric Panel 4: Active Users -->
        <div class="border-2 border-on-surface p-stack-md bg-surface-bright border-dashed neubrutal-shadow flex flex-col justify-between h-44 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-surface-variant uppercase tracking-wider font-bold mb-1">
                    REGISTERED USERS
                </p>
                <h3 class="font-headline-lg text-2xl md:text-3xl text-on-surface leading-none">
                    {{ number_format($totalUsers) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto">
                <span class="text-on-surface-variant font-mono text-[10px] uppercase font-bold">
                    {{ $organizerCount }} ORGS • {{ $adminCount }} ADMINS
                </span>
                <span class="material-symbols-outlined text-on-surface-variant text-2xl" style="font-variation-settings: 'FILL' 1;">group</span>
            </div>
        </div>

    </section>

    <!-- Operations Panel Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
        
        <!-- Left Side: Recent Transactions & Active Stage Listings -->
        <div class="lg:col-span-2 space-y-stack-lg">
            
            <!-- Recent Transactions Table -->
            <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
                <div class="p-stack-md border-b-2 border-on-surface flex justify-between items-center bg-surface-container-low">
                    <h2 class="font-headline-md text-lg uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">receipt_long</span> 
                        RECENT TRANSACTIONS
                    </h2>
                    <span class="bg-primary text-on-primary font-mono text-[10px] px-2.5 py-0.5 border-2 border-on-surface shadow-sm">
                        LATEST 5
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-on-surface font-label-md text-xs text-on-surface-variant bg-surface-container-lowest">
                                <th class="p-4 uppercase">Customer</th>
                                <th class="p-4 uppercase">Event</th>
                                <th class="p-4 uppercase">Amount</th>
                                <th class="p-4 uppercase text-center">Status</th>
                                <th class="p-4 uppercase text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="font-body-md text-sm divide-y-2 divide-on-surface/10">
                            @forelse($recentTransactions as $tx)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="p-4 font-bold text-on-surface">
                                        {{ $tx->ticket->user->name ?? 'System Guest' }}
                                    </td>
                                    <td class="p-4 truncate max-w-[150px] text-on-surface-variant font-medium">
                                        {{ $tx->ticket->event->title ?? 'Deleted Event' }}
                                    </td>
                                    <td class="p-4 font-mono font-bold text-on-surface">
                                        @if(($tx->ticket->event->price ?? 0) > 0)
                                            Rp {{ number_format($tx->ticket->event->price, 0, ',', '.') }}
                                        @else
                                            FREE
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($tx->payment_status === 'paid')
                                            <span class="bg-primary-container text-on-primary-container px-2.5 py-0.5 text-[10px] font-mono font-bold status-badge">
                                                PAID
                                            </span>
                                        @else
                                            <span class="bg-tertiary-container text-on-tertiary-container px-2.5 py-0.5 text-[10px] font-mono font-bold status-badge">
                                                PENDING
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right font-mono text-xs text-on-surface-variant">
                                        {{ $tx->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-on-surface-variant italic font-body-lg">
                                        No recent transactions found in the database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Stage Listings -->
            <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
                <div class="p-stack-md border-b-2 border-on-surface flex justify-between items-center bg-surface-container-low">
                    <h2 class="font-headline-md text-lg uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">campaign</span> 
                        ACTIVE STAGE LISTINGS
                    </h2>
                    <a href="{{ route('home') }}" class="font-label-md text-xs text-primary underline font-bold uppercase tracking-wider">
                        Browse Stage →
                    </a>
                </div>
                
                <div class="divide-y-2 divide-on-surface">
                    @forelse($recentEvents as $e)
                        <div class="p-stack-md flex flex-col md:flex-row gap-stack-md items-start md:items-center hover:bg-surface-container-low transition-colors">
                            <img class="w-16 h-16 border-2 border-on-surface object-cover shadow-sm grayscale-0 shrink-0" 
                                 alt="{{ $e->title }}" 
                                 src="{{ $e->image ? asset('storage/' . $e->image) : 'https://placehold.co/150x150/56642b/ffffff?text=' . urlencode($e->title) }}"/>
                            
                            <div class="flex-grow min-w-0">
                                <h3 class="font-headline-md text-base uppercase truncate text-on-surface leading-tight mb-0.5">
                                    {{ $e->title }}
                                </h3>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-on-surface-variant font-mono">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                        {{ $e->date->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                                        {{ $e->location }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-stack-md shrink-0 w-full md:w-auto justify-between md:justify-end mt-2 md:mt-0">
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-on-surface-variant uppercase font-bold">RESERVATIONS</p>
                                    <p class="font-headline-md text-sm text-primary">{{ $e->tickets_count }} / {{ $e->quota }} SOLD</p>
                                </div>
                                <a href="{{ route('events.show.public', $e) }}" 
                                   class="border-2 border-on-surface bg-surface-container-lowest px-4 py-2 font-label-md text-xs neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase text-decoration-none text-inherit block">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-on-surface-variant italic font-body-lg">
                            No active events listed on the platform.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Side: Analytics Telemetry & Quick Action Bento Controls -->
        <div class="space-y-stack-lg">
            
            <!-- System Telemetry & Statistics Breakdown -->
            <div class="border-2 border-on-surface bg-surface-container-high neubrutal-shadow p-stack-md space-y-5">
                <h2 class="font-headline-md text-base uppercase tracking-wider flex items-center gap-2 border-b-2 border-on-surface pb-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">insights</span> 
                    SYSTEM TELEMETRY
                </h2>
                
                <!-- Stat Item 1: Paid vs Pending Transactions -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-mono font-bold text-on-surface-variant uppercase">
                        <span>TRANSACTIONS</span>
                        <span>{{ $paidTransactions }} PAID / {{ $pendingTransactions }} PND</span>
                    </div>
                    @php
                        $txTotal = max(1, $paidTransactions + $pendingTransactions);
                        $txPct = ($paidTransactions / $txTotal) * 100;
                    @endphp
                    <div class="w-full bg-surface border-2 border-on-surface h-4 neubrutal-shadow-sm overflow-hidden flex">
                        <div class="bg-primary-container h-full border-r-2 border-on-surface" style="width: {{ $txPct }}%"></div>
                    </div>
                </div>

                <!-- Stat Item 2: Active vs Used Tickets -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-mono font-bold text-on-surface-variant uppercase">
                        <span>TICKETS TELEMETRY</span>
                        <span>{{ $activeTickets }} ACTIVE / {{ $usedTickets }} USED</span>
                    </div>
                    @php
                        $tixTotal = max(1, $activeTickets + $usedTickets);
                        $tixPct = ($activeTickets / $tixTotal) * 100;
                    @endphp
                    <div class="w-full bg-surface border-2 border-on-surface h-4 neubrutal-shadow-sm overflow-hidden flex">
                        <div class="bg-secondary-container h-full border-r-2 border-on-surface" style="width: {{ $tixPct }}%"></div>
                    </div>
                </div>

                <!-- Stat Item 3: User Role Distribution -->
                <div class="space-y-1.5 pt-2 border-t border-on-surface/10">
                    <p class="text-[10px] font-mono font-bold text-on-surface-variant uppercase tracking-wider">ROLE CLASSIFICATION</p>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs font-mono">
                        <div class="border border-on-surface p-1.5 bg-white shadow-sm">
                            <p class="text-on-surface-variant font-bold">USERS</p>
                            <p class="font-headline-md text-sm text-on-surface">{{ max(0, $totalUsers - $organizerCount - $adminCount) }}</p>
                        </div>
                        <div class="border border-on-surface p-1.5 bg-white shadow-sm">
                            <p class="text-on-surface-variant font-bold">ORGS</p>
                            <p class="font-headline-md text-sm text-primary">{{ $organizerCount }}</p>
                        </div>
                        <div class="border border-on-surface p-1.5 bg-white shadow-sm">
                            <p class="text-on-surface-variant font-bold">ADMINS</p>
                            <p class="font-headline-md text-sm text-secondary">{{ $adminCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Bento Controls -->
            <div class="border-2 border-on-surface bg-white neubrutal-shadow p-stack-md space-y-stack-md">
                <h2 class="font-headline-md text-base uppercase tracking-wider flex items-center gap-2 border-b-2 border-on-surface pb-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">offline_bolt</span> 
                    QUICK CONTROLS
                </h2>
                
                <div class="grid grid-cols-2 gap-stack-md">
                    <!-- Control 1: Manage Users -->
                    <a href="{{ url('/admin/users') }}" 
                       class="flex flex-col items-center justify-center text-center gap-2 p-stack-md border-2 border-on-surface bg-tertiary-fixed-dim neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all text-decoration-none text-inherit">
                        <span class="material-symbols-outlined text-3xl text-on-surface">manage_accounts</span>
                        <span class="font-label-md text-xs uppercase leading-tight font-bold text-on-surface">MANAGE USERS</span>
                    </a>

                    <!-- Control 2: Validate Tickets -->
                    <a href="{{ url('/admin/tickets/validate') }}" 
                       class="flex flex-col items-center justify-center text-center gap-2 p-stack-md border-2 border-on-surface bg-secondary-container neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all text-decoration-none text-inherit">
                        <span class="material-symbols-outlined text-3xl text-on-surface">qr_code_scanner</span>
                        <span class="font-label-md text-xs uppercase leading-tight font-bold text-on-surface">VALIDATE REG</span>
                    </a>

                    <!-- Control 3: Browse Events -->
                    <a href="{{ route('home') }}" 
                       class="flex flex-col items-center justify-center text-center gap-2 p-stack-md border-2 border-on-surface bg-primary-fixed-dim neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all text-decoration-none text-inherit">
                        <span class="material-symbols-outlined text-3xl text-on-surface">explore</span>
                        <span class="font-label-md text-xs uppercase leading-tight font-bold text-on-surface">BROWSE EVENTS</span>
                    </a>

                    <!-- Control 4: Create Event -->
                    <a href="{{ route('events.create') }}" 
                       class="flex flex-col items-center justify-center text-center gap-2 p-stack-md border-2 border-on-surface bg-surface-container-high border-dashed neubrutal-shadow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all text-decoration-none text-inherit">
                        <span class="material-symbols-outlined text-3xl text-on-surface">add_box</span>
                        <span class="font-label-md text-xs uppercase leading-tight font-bold text-on-surface">CREATE EVENT</span>
                    </a>
                </div>
            </div>

        </div>

    </section>

</main>
@endsection
