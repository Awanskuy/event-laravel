@extends('layouts.admin')

@section('page-title', 'Pengguna')

@section('content')
<div class="space-y-stack-lg animate-[countUp_0.4s_ease-out]">

    {{-- Page Header --}}
    <div class="border-2 border-on-surface p-stack-md bg-surface-container-low neubrutal-shadow flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <div>
            <h1 class="font-headline-lg text-xl font-black uppercase mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">group</span>
                Manajemen Pengguna
            </h1>
            <p class="font-body-md text-sm text-on-surface-variant">
                Pantau pengguna platform, cari berdasarkan nama atau email, filter per peran, dan lihat ringkasan akun.
            </p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{--  STATISTICS SECTION                     --}}
    {{-- ═══════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-gutter">
        {{-- Total Users --}}
        <div class="border-2 border-on-surface p-4 bg-primary-fixed neubrutal-shadow flex items-center gap-4 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-white border-2 border-on-surface flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">group</span>
            </div>
            <div>
                <p class="font-label-sm text-[10px] text-on-primary-fixed-variant uppercase tracking-wider font-bold">Total Pengguna</p>
                <h3 class="font-headline-lg text-2xl text-on-primary-fixed leading-none mt-1">{{ number_format($totalUsers) }}</h3>
            </div>
        </div>

        {{-- Total Organizers --}}
        <div class="border-2 border-on-surface p-4 bg-tertiary-fixed neubrutal-shadow flex items-center gap-4 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-white border-2 border-on-surface flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <span class="material-symbols-outlined text-tertiary text-2xl" style="font-variation-settings: 'FILL' 1;">co_present</span>
            </div>
            <div>
                <p class="font-label-sm text-[10px] text-on-tertiary-fixed-variant uppercase tracking-wider font-bold">Total Penyelenggara</p>
                <h3 class="font-headline-lg text-2xl text-on-tertiary-fixed leading-none mt-1">{{ number_format($totalOrganizers) }}</h3>
            </div>
        </div>

        {{-- Total Participants --}}
        <div class="border-2 border-on-surface p-4 bg-secondary-fixed neubrutal-shadow flex items-center gap-4 transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-12 h-12 bg-white border-2 border-on-surface flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">badge</span>
            </div>
            <div>
                <p class="font-label-sm text-[10px] text-on-secondary-fixed-variant uppercase tracking-wider font-bold">Peserta</p>
                <h3 class="font-headline-lg text-2xl text-on-secondary-fixed leading-none mt-1">{{ number_format($totalParticipants) }}</h3>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════ --}}
    {{--  SEARCH & FILTERS                       --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="border-2 border-on-surface p-4 bg-white neubrutal-shadow space-y-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
            {{-- Keep existing filters --}}
            @if(request('role'))
                <input type="hidden" name="role" value="{{ request('role') }}">
            @endif

            {{-- Search Bar --}}
            <div class="relative flex-grow max-w-xl">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="w-full bg-surface-container-low border-2 border-on-surface py-2.5 pl-4 pr-12 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all font-label-md text-xs md:text-sm"
                       placeholder="Cari nama atau email..." />
                @if(request('search'))
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-10 top-2.5 text-on-surface-variant hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </a>
                @endif
                <button type="submit" class="absolute right-3 top-2.5 text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-xl">search</span>
                </button>
            </div>

            {{-- Filter Buttons --}}
            <div class="flex flex-wrap gap-2 shrink-0">
                <a href="{{ request()->fullUrlWithQuery(['role' => null, 'page' => null]) }}"
                   class="px-3 py-2 border-2 border-on-surface font-label-md text-[10px] md:text-xs uppercase transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none
                          {{ !request('role') ? 'bg-primary text-on-primary' : 'bg-white text-on-surface' }}"
                   style="text-decoration:none;">
                    Semua
                </a>
                <a href="{{ request()->fullUrlWithQuery(['role' => 'admin', 'page' => null]) }}"
                   class="px-3 py-2 border-2 border-on-surface font-label-md text-[10px] md:text-xs uppercase transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none
                          {{ request('role') === 'admin' ? 'bg-primary text-on-primary' : 'bg-white text-on-surface' }}"
                   style="text-decoration:none;">
                    Admin
                </a>
                <a href="{{ request()->fullUrlWithQuery(['role' => 'organizer', 'page' => null]) }}"
                   class="px-3 py-2 border-2 border-on-surface font-label-md text-[10px] md:text-xs uppercase transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none
                          {{ request('role') === 'organizer' ? 'bg-primary text-on-primary' : 'bg-white text-on-surface' }}"
                   style="text-decoration:none;">
                    Penyelenggara
                </a>
                <a href="{{ request()->fullUrlWithQuery(['role' => 'user', 'page' => null]) }}"
                   class="px-3 py-2 border-2 border-on-surface font-label-md text-[10px] md:text-xs uppercase transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none
                          {{ request('role') === 'user' ? 'bg-primary text-on-primary' : 'bg-white text-on-surface' }}"
                   style="text-decoration:none;">
                    Peserta
                </a>
            </div>
        </form>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{--  USERS TABLE / LIST                     --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="border-2 border-on-surface bg-white neubrutal-shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-on-surface font-label-md text-[10px] md:text-xs text-on-surface-variant bg-surface-container-lowest">
                        <th class="p-3 md:p-4 uppercase w-16">ID</th>
                        <th class="p-3 md:p-4 uppercase">Pengguna</th>
                        <th class="p-3 md:p-4 uppercase hidden sm:table-cell">Email</th>
                        <th class="p-3 md:p-4 uppercase text-center w-32">Peran</th>
                        <th class="p-3 md:p-4 uppercase text-right hidden md:table-cell">Bergabung</th>
                        <th class="p-3 md:p-4 uppercase text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="font-body-md text-sm divide-y-2 divide-on-surface/10">
                    @forelse($users as $user)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="p-3 md:p-4 font-mono text-xs text-on-surface-variant">
                                #{{ $user->id }}
                            </td>
                            <td class="p-3 md:p-4">
                                <div class="flex items-center gap-2.5">
                                    {{-- Role Color Coding on Avatars --}}
                                    <div class="w-8 h-8 border-2 border-on-surface flex items-center justify-center text-[10px] font-bold uppercase shrink-0 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]
                                        @if($user->role == 'admin') bg-error-container text-on-error-container
                                        @elseif($user->role == 'organizer') bg-tertiary-fixed text-on-tertiary-fixed-variant
                                        @else bg-primary-fixed text-on-primary-fixed-variant
                                        @endif">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-on-surface text-xs md:text-sm truncate">{{ $user->name }}</p>
                                        <p class="text-[9px] text-on-surface-variant font-mono sm:hidden">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 md:p-4 text-on-surface-variant font-mono text-xs hidden sm:table-cell">
                                {{ $user->email }}
                            </td>
                            <td class="p-3 md:p-4 text-center">
                                @if($user->role == 'admin')
                                    <span class="inline-block bg-error-container text-on-error-container px-2 py-0.5 text-[10px] font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                                        Admin
                                    </span>
                                @elseif($user->role == 'organizer')
                                    <span class="inline-block bg-tertiary-fixed text-on-tertiary-fixed-variant px-2 py-0.5 text-[10px] font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                                        Penyelenggara
                                    </span>
                                @else
                                    <span class="inline-block bg-primary-fixed text-on-primary-fixed-variant px-2 py-0.5 text-[10px] font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                                        Peserta
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 md:p-4 text-right font-mono text-xs text-on-surface-variant hidden md:table-cell">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="p-3 md:p-4 text-center">
                                <a href="{{ request()->fullUrlWithQuery(['view' => $user->id]) }}"
                                   class="inline-flex items-center justify-center gap-1 border-2 border-on-surface bg-surface-container-lowest px-2.5 py-1 font-label-md text-[10px] neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all uppercase text-on-surface"
                                   style="text-decoration:none;">
                                    <span class="material-symbols-outlined text-xs">visibility</span>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant/30 mb-2 block">person_off</span>
                                @if(request('search'))
                                    <h3 class="font-headline-md text-sm uppercase text-on-surface-variant mb-1">Tidak ada hasil</h3>
                                    <p class="text-on-surface-variant italic font-body-md text-xs">Tidak ada pengguna yang cocok dengan "{{ request('search') }}".</p>
                                @else
                                    <h3 class="font-headline-md text-sm uppercase text-on-surface-variant mb-1">Belum ada pengguna</h3>
                                    <p class="text-on-surface-variant italic font-body-md text-xs">Belum ada akun terdaftar di platform.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
        <div class="flex justify-center gap-2">
            @if($users->onFirstPage())
                <span class="px-3 py-2 border-2 border-on-surface/30 bg-surface-container text-on-surface-variant/40 font-label-md text-xs uppercase cursor-not-allowed">
                    ← Sebelumnya
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}"
                   class="px-3 py-2 border-2 border-on-surface bg-white neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all font-label-md text-xs uppercase text-on-surface"
                   style="text-decoration:none;">
                    ← Sebelumnya
                </a>
            @endif

            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if($page == $users->currentPage())
                    <span class="px-3 py-2 border-2 border-on-surface bg-primary text-on-primary font-label-md text-xs neubrutal-shadow-sm">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-2 border-2 border-on-surface bg-white hover:bg-surface-container-low font-label-md text-xs transition-colors text-on-surface"
                       style="text-decoration:none;">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                   class="px-3 py-2 border-2 border-on-surface bg-white neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all font-label-md text-xs uppercase text-on-surface"
                   style="text-decoration:none;">
                    Berikutnya →
                </a>
            @else
                <span class="px-3 py-2 border-2 border-on-surface/30 bg-surface-container text-on-surface-variant/40 font-label-md text-xs uppercase cursor-not-allowed">
                    Berikutnya →
                </span>
            @endif
        </div>
    @endif

</div>

{{-- ═══════════════════════════════════════ --}}
{{--  USER DETAIL MODAL                      --}}
{{-- ═══════════════════════════════════════ --}}
@if($userDetail)
<div class="fixed inset-0 z-[100] flex items-center justify-center px-4">
    {{-- Blur overlay --}}
    <a href="{{ request()->fullUrlWithQuery(['view' => null]) }}" class="absolute inset-0 bg-on-surface/40 backdrop-blur-[2px] transition-opacity"></a>

    {{-- Detail Card --}}
    <div class="relative bg-white border-3 border-on-surface p-6 md:p-8 max-w-md w-full neubrutal-shadow-lg z-10 animate-[countUp_0.3s_ease-out]">
        {{-- Close button --}}
        <a href="{{ request()->fullUrlWithQuery(['view' => null]) }}"
           class="absolute top-4 right-4 w-8 h-8 border-2 border-on-surface bg-surface-container-lowest flex items-center justify-center hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all neubrutal-shadow-sm text-on-surface"
           style="text-decoration:none;">
            <span class="material-symbols-outlined text-base font-bold">close</span>
        </a>

        <div class="text-center space-y-4">
            {{-- Big Avatar --}}
            <div class="inline-flex items-center justify-center w-20 h-20 border-3 border-on-surface neubrutal-shadow-sm text-3xl font-black uppercase
                @if($userDetail->role == 'admin') bg-error-container text-on-error-container
                @elseif($userDetail->role == 'organizer') bg-tertiary-fixed text-on-tertiary-fixed-variant
                @else bg-primary-fixed text-on-primary-fixed-variant
                @endif">
                {{ substr($userDetail->name, 0, 1) }}
            </div>

            <div>
                <h3 class="font-headline-lg text-lg uppercase">{{ $userDetail->name }}</h3>
                <p class="font-mono text-xs text-on-surface-variant mt-1">{{ $userDetail->email }}</p>
            </div>

            {{-- Role Badge --}}
            <div>
                @if($userDetail->role == 'admin')
                    <span class="inline-block bg-error-container text-on-error-container px-3 py-1 text-xs font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                        Administrator Sistem
                    </span>
                @elseif($userDetail->role == 'organizer')
                    <span class="inline-block bg-tertiary-fixed text-on-tertiary-fixed-variant px-3 py-1 text-xs font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                        Penyelenggara Event
                    </span>
                @else
                    <span class="inline-block bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 text-xs font-mono font-bold border-2 border-on-surface shadow-sm uppercase">
                        Peserta Event
                    </span>
                @endif
            </div>

            <div class="border-t-2 border-on-surface/10 my-4 pt-4 text-left space-y-3 font-body-md text-sm">
                <div class="flex justify-between border-b border-on-surface/5 pb-2">
                    <span class="text-on-surface-variant font-bold">Tanggal Daftar</span>
                    <span class="font-mono text-xs">{{ $userDetail->created_at->format('d M Y, H:i') }}</span>
                </div>

                <div class="flex justify-between border-b border-on-surface/5 pb-2">
                    <span class="text-on-surface-variant font-bold">Tiket Dibeli</span>
                    <span class="font-mono font-bold text-primary">{{ $userDetail->tickets_count }} Tiket</span>
                </div>

                @if($userDetail->isOrganizer())
                    <div class="flex justify-between border-b border-on-surface/5 pb-2">
                        <span class="text-on-surface-variant font-bold">Event Dibuat</span>
                        <span class="font-mono font-bold text-tertiary">{{ $userDetail->events_count }} Event</span>
                    </div>
                @endif
            </div>

            <a href="{{ request()->fullUrlWithQuery(['view' => null]) }}"
               class="w-full mt-4 bg-inverse-surface text-inverse-on-surface py-2 border-2 border-on-surface neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all font-label-md text-xs uppercase block text-center"
               style="text-decoration:none;">
                Tutup
            </a>
        </div>
    </div>
</div>
@endif

@endsection
