@extends('layouts.admin')

@section('page-title', 'Dashboard')

@push('styles')
<style>
    .status-badge {
        border: 2px solid #1c1c18;
        box-shadow: 1px 1px 0px 0px rgba(0,0,0,1);
    }

    /* Counter animation */
    @keyframes countUp {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .metric-value {
        animation: countUp 0.4s ease-out both;
    }
    .metric-card:nth-child(2) .metric-value { animation-delay: 0.05s; }
    .metric-card:nth-child(3) .metric-value { animation-delay: 0.1s; }
    .metric-card:nth-child(4) .metric-value { animation-delay: 0.15s; }

    /* Progress bar animation */
    @keyframes barGrow {
        from { width: 0%; }
    }
    .progress-fill {
        animation: barGrow 0.8s ease-out both;
        animation-delay: 0.3s;
    }
</style>
@endpush

@section('content')
<div class="space-y-stack-lg">

    {{-- ═══════════════════════════════════════ --}}
    {{--  PAGE HEADER                           --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="border-2 border-on-surface p-stack-md bg-surface-container-low neubrutal-shadow flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-headline-lg text-xl md:text-2xl font-black uppercase mb-1">
                <span class="material-symbols-outlined text-primary align-middle mr-1" style="font-variation-settings: 'FILL' 1;">monitoring</span>
                Dashboard Operasional
            </h1>
            <p class="font-body-md text-sm text-on-surface-variant max-w-xl">
                Pantau pendapatan, penjualan tiket, aktivitas pengguna, dan event platform secara real-time.
            </p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <span class="w-3 h-3 bg-primary rounded-full border-2 border-on-surface animate-pulse"></span>
            <span class="font-mono text-[10px] font-bold uppercase tracking-wider text-on-surface-variant">Data Langsung</span>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{--  METRIC CARDS (4 columns)              --}}
    {{-- ═══════════════════════════════════════ --}}
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-gutter">

        {{-- Revenue --}}
        <div class="metric-card border-2 border-on-surface p-4 bg-primary-fixed neubrutal-shadow flex flex-col justify-between min-h-[140px] md:h-40 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-primary-fixed-variant uppercase tracking-wider font-bold mb-1.5">
                    Total Pendapatan
                </p>
                <h3 class="metric-value font-headline-lg text-lg md:text-2xl text-on-primary-fixed leading-none">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto pt-2">
                <span class="text-on-primary-fixed-variant font-mono text-[9px] md:text-[10px] uppercase font-bold">Hanya Lunas</span>
                <span class="material-symbols-outlined text-on-primary-fixed-variant text-xl" style="font-variation-settings: 'FILL' 1;">payments</span>
            </div>
        </div>

        {{-- Tickets Sold --}}
        <div class="metric-card border-2 border-on-surface p-4 bg-secondary-fixed neubrutal-shadow flex flex-col justify-between min-h-[140px] md:h-40 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-secondary-fixed-variant uppercase tracking-wider font-bold mb-1.5">
                    Tiket Terjual
                </p>
                <h3 class="metric-value font-headline-lg text-lg md:text-2xl text-on-secondary-fixed leading-none">
                    {{ number_format($totalTickets) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto pt-2">
                <span class="text-on-secondary-fixed-variant font-mono text-[9px] md:text-[10px] uppercase font-bold">Aktif + Terpakai</span>
                <span class="material-symbols-outlined text-on-secondary-fixed-variant text-xl" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
            </div>
        </div>

        {{-- Events --}}
        <div class="metric-card border-2 border-on-surface p-4 bg-tertiary-fixed neubrutal-shadow flex flex-col justify-between min-h-[140px] md:h-40 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-tertiary-fixed-variant uppercase tracking-wider font-bold mb-1.5">
                    Total Event
                </p>
                <h3 class="metric-value font-headline-lg text-lg md:text-2xl text-on-tertiary-fixed leading-none">
                    {{ number_format($totalEvents) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto pt-2">
                <span class="text-on-tertiary-fixed-variant font-mono text-[9px] md:text-[10px] uppercase font-bold">Terdaftar</span>
                <span class="material-symbols-outlined text-on-tertiary-fixed-variant text-xl" style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
        </div>

        {{-- Users --}}
        <div class="metric-card border-2 border-on-surface p-4 bg-surface-bright border-dashed neubrutal-shadow flex flex-col justify-between min-h-[140px] md:h-40 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div>
                <p class="font-label-sm text-[10px] text-on-surface-variant uppercase tracking-wider font-bold mb-1.5">
                    Pengguna
                </p>
                <h3 class="metric-value font-headline-lg text-lg md:text-2xl text-on-surface leading-none">
                    {{ number_format($totalUsers) }}
                </h3>
            </div>
            <div class="flex items-end justify-between mt-auto pt-2">
                <span class="text-on-surface-variant font-mono text-[9px] md:text-[10px] uppercase font-bold">
                    {{ $organizerCount }} Org • {{ $adminCount }} Adm
                </span>
                <span class="material-symbols-outlined text-on-surface-variant text-xl" style="font-variation-settings: 'FILL' 1;">group</span>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════ --}}
    {{--  MAIN CONTENT GRID                     --}}
    {{-- ═══════════════════════════════════════ --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-3 md:gap-gutter">

        {{-- ════════════════════════════════════ --}}
        {{--  LEFT COLUMN (2/3)                  --}}
        {{-- ════════════════════════════════════ --}}
        <div class="lg:col-span-2 space-y-stack-lg">

            {{-- Recent Transactions Table --}}
            <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
                <div class="p-4 border-b-2 border-on-surface flex justify-between items-center bg-surface-container-low">
                    <h2 class="font-headline-md text-base uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">receipt_long</span>
                        Transaksi Terbaru
                    </h2>
                    <span class="bg-primary text-on-primary font-mono text-[10px] px-2 py-0.5 border-2 border-on-surface shadow-sm">
                        5 TERAKHIR
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-on-surface font-label-md text-[10px] md:text-xs text-on-surface-variant bg-surface-container-lowest">
                                <th class="p-3 md:p-4 uppercase">Pelanggan</th>
                                <th class="p-3 md:p-4 uppercase">Event</th>
                                <th class="p-3 md:p-4 uppercase hidden sm:table-cell">Jumlah</th>
                                <th class="p-3 md:p-4 uppercase text-center">Status</th>
                                <th class="p-3 md:p-4 uppercase text-right hidden md:table-cell">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="font-body-md text-sm divide-y-2 divide-on-surface/10">
                            @forelse($recentTransactions as $tx)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="p-3 md:p-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 bg-secondary-container border border-on-surface flex items-center justify-center text-[10px] font-bold uppercase shrink-0">
                                                {{ substr($tx->ticket->user->name ?? 'G', 0, 1) }}
                                            </div>
                                            <span class="font-bold text-on-surface text-xs md:text-sm truncate max-w-[100px] md:max-w-none">
                                                {{ $tx->ticket->user->name ?? 'Tamu' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-3 md:p-4 truncate max-w-[120px] text-on-surface-variant font-medium text-xs md:text-sm">
                                        {{ $tx->ticket->event->title ?? 'Event Dihapus' }}
                                    </td>
                                    <td class="p-3 md:p-4 font-mono font-bold text-on-surface text-xs md:text-sm hidden sm:table-cell">
                                        @if(($tx->ticket->event->price ?? 0) > 0)
                                            Rp {{ number_format($tx->ticket->event->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-primary">GRATIS</span>
                                        @endif
                                    </td>
                                    <td class="p-3 md:p-4 text-center">
                                        @if($tx->payment_status === 'paid')
                                            <span class="bg-primary-container text-on-primary-container px-2 py-0.5 text-[10px] font-mono font-bold status-badge inline-block">
                                                LUNAS
                                            </span>
                                        @else
                                            <span class="bg-tertiary-container text-on-tertiary-container px-2 py-0.5 text-[10px] font-mono font-bold status-badge inline-block">
                                                MENUNGGU
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-3 md:p-4 text-right font-mono text-[10px] md:text-xs text-on-surface-variant hidden md:table-cell">
                                        {{ $tx->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-10 text-center">
                                        <span class="material-symbols-outlined text-4xl text-on-surface-variant/30 mb-2 block">receipt_long</span>
                                        <p class="text-on-surface-variant italic font-body-md text-sm">Belum ada transaksi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Active Events Listing --}}
            <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
                <div class="p-4 border-b-2 border-on-surface flex justify-between items-center bg-surface-container-low">
                    <h2 class="font-headline-md text-base uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">campaign</span>
                        Event Aktif
                    </h2>
                    <a href="{{ route('home') }}" class="font-label-md text-[10px] md:text-xs text-primary underline font-bold uppercase tracking-wider" style="text-decoration:none;">
                        Lihat Semua →
                    </a>
                </div>

                <div class="divide-y-2 divide-on-surface/10">
                    @forelse($recentEvents as $e)
                        <div class="p-4 flex flex-col sm:flex-row gap-3 items-start sm:items-center hover:bg-surface-container-low transition-colors">
                            {{-- Event Thumbnail --}}
                            <img class="w-12 h-12 border-2 border-on-surface object-cover shadow-sm shrink-0"
                                 alt="{{ $e->title }}"
                                 src="{{ $e->image_url }}"/>

                            {{-- Event Info --}}
                            <div class="flex-grow min-w-0">
                                <h3 class="font-headline-md text-sm uppercase truncate text-on-surface leading-tight mb-0.5">
                                    {{ $e->title }}
                                </h3>
                                <div class="flex flex-wrap gap-x-3 gap-y-0.5 text-[10px] md:text-xs text-on-surface-variant font-mono">
                                    <span class="flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[12px]">calendar_today</span>
                                        {{ $e->date->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center gap-0.5">
                                        <span class="material-symbols-outlined text-[12px]">location_on</span>
                                        {{ Str::limit($e->location, 20) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Sales Progress --}}
                            <div class="flex items-center gap-3 shrink-0 w-full sm:w-auto justify-between sm:justify-end">
                                <div class="text-right">
                                    <p class="text-[9px] font-mono text-on-surface-variant uppercase font-bold">Terjual</p>
                                    <p class="font-headline-md text-xs text-primary">{{ $e->tickets_count }}/{{ $e->quota }}</p>
                                </div>
                                <a href="{{ route('events.show.public', $e) }}"
                                   class="border-2 border-on-surface bg-surface-container-lowest px-3 py-1.5 font-label-md text-[10px] neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase text-on-surface"
                                   style="text-decoration:none;">
                                    Lihat
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant/30 mb-2 block">event_busy</span>
                            <p class="text-on-surface-variant italic font-body-md text-sm">Belum ada event.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- ════════════════════════════════════ --}}
        {{--  RIGHT COLUMN (1/3) - Telemetry     --}}
        {{-- ════════════════════════════════════ --}}
        <div class="space-y-stack-lg">

            {{-- System Telemetry --}}
            <div class="border-2 border-on-surface bg-surface-container-high neubrutal-shadow p-4 space-y-5">
                <h2 class="font-headline-md text-sm uppercase tracking-wider flex items-center gap-2 border-b-2 border-on-surface pb-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">insights</span>
                    Analitik
                </h2>

                {{-- Transactions Progress --}}
                <div class="space-y-1.5">
                    <div class="flex justify-between text-[10px] font-mono font-bold text-on-surface-variant uppercase">
                        <span>Transaksi</span>
                        <span>{{ $paidTransactions }} lunas / {{ $pendingTransactions }} menunggu</span>
                    </div>
                    @php
                        $txTotal = max(1, $paidTransactions + $pendingTransactions);
                        $txPct = ($paidTransactions / $txTotal) * 100;
                    @endphp
                    <div class="w-full bg-surface border-2 border-on-surface h-3.5 neubrutal-shadow-sm overflow-hidden flex">
                        <div class="progress-fill bg-primary-container h-full border-r-2 border-on-surface" style="width: {{ $txPct }}%"></div>
                    </div>
                </div>

                {{-- Tickets Progress --}}
                <div class="space-y-1.5">
                    <div class="flex justify-between text-[10px] font-mono font-bold text-on-surface-variant uppercase">
                        <span>Tiket</span>
                        <span>{{ $activeTickets }} aktif / {{ $usedTickets }} terpakai</span>
                    </div>
                    @php
                        $tixTotal = max(1, $activeTickets + $usedTickets);
                        $tixPct = ($activeTickets / $tixTotal) * 100;
                    @endphp
                    <div class="w-full bg-surface border-2 border-on-surface h-3.5 neubrutal-shadow-sm overflow-hidden flex">
                        <div class="progress-fill bg-secondary-container h-full border-r-2 border-on-surface" style="width: {{ $tixPct }}%"></div>
                    </div>
                </div>

                {{-- Role Distribution --}}
                <div class="space-y-2 pt-3 border-t border-on-surface/10">
                    <p class="text-[10px] font-mono font-bold text-on-surface-variant uppercase tracking-wider">Distribusi Peran</p>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs font-mono">
                        <div class="border-2 border-on-surface p-2 bg-white neubrutal-shadow-sm">
                            <p class="text-on-surface-variant font-bold text-[9px]">PENGGUNA</p>
                            <p class="font-headline-md text-sm text-on-surface">{{ max(0, $totalUsers - $organizerCount - $adminCount) }}</p>
                        </div>
                        <div class="border-2 border-on-surface p-2 bg-white neubrutal-shadow-sm">
                            <p class="text-on-surface-variant font-bold text-[9px]">ORGS</p>
                            <p class="font-headline-md text-sm text-primary">{{ $organizerCount }}</p>
                        </div>
                        <div class="border-2 border-on-surface p-2 bg-white neubrutal-shadow-sm">
                            <p class="text-on-surface-variant font-bold text-[9px]">ADMIN</p>
                            <p class="font-headline-md text-sm text-secondary">{{ $adminCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Latest Registered Users --}}
            <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
                <div class="p-4 border-b-2 border-on-surface flex justify-between items-center bg-surface-container-low">
                    <h2 class="font-headline-md text-sm uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">group_add</span>
                        Pengguna Terbaru
                    </h2>
                    <span class="bg-primary text-on-primary font-mono text-[10px] px-2 py-0.5 border-2 border-on-surface shadow-sm">
                        5 TERBARU
                    </span>
                </div>

                <div class="divide-y-2 divide-on-surface/10">
                    @forelse($latestUsers as $u)
                        <div class="p-3 flex items-center gap-3 hover:bg-surface-container-low transition-colors">
                            <div class="w-8 h-8 border-2 border-on-surface flex items-center justify-center text-[10px] font-bold uppercase shrink-0
                                @if($u->role == 'admin') bg-error-container text-on-error-container
                                @elseif($u->role == 'organizer') bg-primary-container text-on-primary-container
                                @else bg-secondary-container text-on-secondary-container
                                @endif">
                                {{ substr($u->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-grow">
                                <p class="font-bold text-on-surface text-xs truncate">{{ $u->name }}</p>
                                <p class="text-[9px] text-on-surface-variant font-mono truncate">{{ $u->email }}</p>
                            </div>
                            <div class="shrink-0 text-right flex flex-col items-end gap-1">
                                @if($u->role == 'admin')
                                    <span class="inline-block bg-error-container text-on-error-container px-1.5 py-0.5 text-[8px] font-mono font-bold border border-on-surface shadow-sm uppercase">
                                        ADM
                                    </span>
                                @elseif($u->role == 'organizer')
                                    <span class="inline-block bg-primary-container text-on-primary-container px-1.5 py-0.5 text-[8px] font-mono font-bold border border-on-surface shadow-sm uppercase">
                                        ORG
                                    </span>
                                @else
                                    <span class="inline-block bg-surface-container-high text-on-surface-variant px-1.5 py-0.5 text-[8px] font-mono font-bold border border-on-surface shadow-sm uppercase">
                                        USR
                                    </span>
                                @endif
                                <span class="text-[8px] text-on-surface-variant font-mono">
                                    {{ $u->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <span class="material-symbols-outlined text-3xl text-on-surface-variant/30 mb-2 block">person_off</span>
                            <p class="text-on-surface-variant italic font-body-md text-xs">Belum ada pengguna terdaftar.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="border-2 border-on-surface bg-white neubrutal-shadow p-4 space-y-4">
                <h2 class="font-headline-md text-sm uppercase tracking-wider flex items-center gap-2 border-b-2 border-on-surface pb-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">offline_bolt</span>
                    Aksi Cepat
                </h2>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="flex flex-col items-center justify-center text-center gap-1.5 p-4 border-2 border-on-surface bg-tertiary-fixed-dim neubrutal-shadow-sm hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-on-surface"
                       style="text-decoration:none;">
                        <span class="material-symbols-outlined text-2xl">manage_accounts</span>
                        <span class="font-label-md text-[10px] uppercase leading-tight font-bold">Kelola Pengguna</span>
                    </a>

                    <a href="{{ route('admin.tickets.validate') }}"
                       class="flex flex-col items-center justify-center text-center gap-1.5 p-4 border-2 border-on-surface bg-secondary-container neubrutal-shadow-sm hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-on-surface"
                       style="text-decoration:none;">
                        <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                        <span class="font-label-md text-[10px] uppercase leading-tight font-bold">Validasi</span>
                    </a>

                    <a href="{{ route('home') }}"
                       class="flex flex-col items-center justify-center text-center gap-1.5 p-4 border-2 border-on-surface bg-primary-fixed-dim neubrutal-shadow-sm hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-on-surface"
                       style="text-decoration:none;">
                        <span class="material-symbols-outlined text-2xl">explore</span>
                        <span class="font-label-md text-[10px] uppercase leading-tight font-bold">Jelajah</span>
                    </a>

                    <a href="{{ route('events.create') }}"
                       class="flex flex-col items-center justify-center text-center gap-1.5 p-4 border-2 border-on-surface bg-surface-container-high border-dashed neubrutal-shadow-sm hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all text-on-surface"
                       style="text-decoration:none;">
                        <span class="material-symbols-outlined text-2xl">add_box</span>
                        <span class="font-label-md text-[10px] uppercase leading-tight font-bold">Event Baru</span>
                    </a>
                </div>
            </div>

        </div>

    </section>

</div>
@endsection
