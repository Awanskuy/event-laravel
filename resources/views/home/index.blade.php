@extends('layouts.app')

@section('content')
<main class="md:px-margin-desktop px-margin-mobile py-stack-lg flex flex-col gap-stack-lg">
    <!-- Hero Section -->
    <section class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-center min-h-[614px]">
        <div class="md:col-span-7 flex flex-col gap-stack-md">
            <div class="inline-block bg-tertiary-fixed text-on-tertiary-fixed px-3 py-1 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-fit font-label-md uppercase">
                Baru Rilis
            </div>
            <h1 class="font-display-lg text-display-lg-mobile md:text-display-lg leading-none">DENYUT NADI <span class="text-primary underline decoration-4 underline-offset-8">SETIAP KOTA</span></h1>
            <p class="font-body-lg text-body-lg max-w-xl text-on-surface-variant">
                Temukan festival musik, summit teknologi, dan acara pilihan terbaik. Gerbangmu menuju pengalaman penuh energi untuk generasi baru.
            </p>
            <div class="flex flex-wrap gap-stack-md mt-stack-sm">
                <a href="#events" class="bg-primary-container text-on-primary-container px-stack-lg py-stack-md border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-headline-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all active:translate-x-[4px] active:translate-y-[4px] inline-block" style="text-decoration:none;">
                    Cari Event Favoritmu
                </a>
                <a href="{{ route('events.create') }}" class="bg-secondary-container text-on-secondary-container px-stack-lg py-stack-md border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-headline-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all active:translate-x-[4px] active:translate-y-[4px] inline-block" style="text-decoration:none;">
                    Pasang Event
                </a>
            </div>
        </div>
        <div class="md:col-span-5 relative group">
            <div class="absolute inset-0 bg-on-surface translate-x-4 translate-y-4"></div>
            <div class="relative border-2 border-on-surface aspect-square overflow-hidden bg-surface-container-high">
                <img class="w-full h-full object-cover grayscale-0 group-hover:scale-105 transition-transform duration-500" alt="Vibrant hero event stage" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyabBvzteWRKN7VfCDsunkmLfOa0FJKj2iwvAZpSEJWZZj4j6qItO4PtBWtF3qbHJW82RK1UuI5NyJJ3zoTaagSMomcCLcFszAicLDtts8G8KbgenlQ8QmuquDYSZQFjOO9yHIeVjK_FvX-e6FpUFDju3SEFCKw4PNLQPo2lWwlyT25SFNqkS-Ib2R4izHadbReFcNnNKDqNZwc4zSUNJ4SIWKek752MwnpqGLAZhK7uaqnuZxOF-s0jFocfI1f_79A8IUeuBJhnw"/>
            </div>
            <div class="absolute -bottom-6 -left-6 bg-tertiary-container text-on-tertiary-container p-stack-md border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hidden md:block">
                <p class="font-label-md">EVENT AKTIF SEKARANG</p>
                <p class="font-headline-md">{{ $events->total() ?? '1,240+' }}</p>
            </div>
        </div>
    </section>

    <!-- Bento Filter / Category Row -->
    @php $activeCategory = request('category'); @endphp
    <section class="flex flex-wrap gap-stack-md" id="events">
        <a href="{{ route('home') }}#events"
           class="flex items-center gap-2 px-4 py-2 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-label-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all {{ $activeCategory ? 'bg-surface-container' : 'bg-primary text-on-primary' }}">
            <span class="material-symbols-outlined" data-icon="apps">apps</span> Semua
        </a>
        <a href="{{ route('home', ['category' => 'music']) }}#events"
           class="flex items-center gap-2 px-4 py-2 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-label-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all {{ $activeCategory === 'music' ? 'bg-primary text-on-primary' : 'bg-surface-container' }}">
            <span class="material-symbols-outlined" data-icon="music_note">music_note</span> Musik
        </a>
        <a href="{{ route('home', ['category' => 'tech']) }}#events"
           class="flex items-center gap-2 px-4 py-2 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-label-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all {{ $activeCategory === 'tech' ? 'bg-primary text-on-primary' : 'bg-surface-container' }}">
            <span class="material-symbols-outlined" data-icon="terminal">terminal</span> Teknologi
        </a>
        <a href="{{ route('home', ['category' => 'art']) }}#events"
           class="flex items-center gap-2 px-4 py-2 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-label-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all {{ $activeCategory === 'art' ? 'bg-primary text-on-primary' : 'bg-surface-container' }}">
            <span class="material-symbols-outlined" data-icon="palette">palette</span> Seni
        </a>
        <a href="{{ route('home', ['category' => 'food']) }}#events"
           class="flex items-center gap-2 px-4 py-2 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-label-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all {{ $activeCategory === 'food' ? 'bg-primary text-on-primary' : 'bg-surface-container' }}">
            <span class="material-symbols-outlined" data-icon="restaurant">restaurant</span> Kuliner
        </a>
    </section>

    <!-- Featured Events Grid -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-gutter mt-stack-md">
        @forelse($events ?? [] as $event)
        <div class="bg-surface border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all group">
            <div class="h-48 overflow-hidden border-b-2 border-on-surface relative">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $event->image_url }}" alt="{{ $event->title }}"/>
                <div class="absolute top-4 left-4 bg-primary-container text-on-primary-container px-2 py-1 border-2 border-on-surface font-label-sm uppercase">{{ $event->category_label }}</div>
            </div>
            <div class="p-stack-md flex flex-col gap-stack-sm bg-background flex-1">
                <div class="flex justify-between items-start">
                    <h3 class="font-headline-md leading-tight uppercase">{{ $event->title }}</h3>
                    <div class="text-right">
                        @if($event->price > 0)
                            <span class="font-label-md text-secondary">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        @else
                            <span class="font-label-md text-secondary">GRATIS</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant font-label-sm mt-auto pt-4">
                    <span class="material-symbols-outlined text-[18px]" data-icon="calendar_today">calendar_today</span>
                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('M d, Y') : 'TBA' }}
                </div>
                <div class="flex items-center gap-2 text-on-surface-variant font-label-sm mb-stack-sm">
                    <span class="material-symbols-outlined text-[18px]" data-icon="location_on">location_on</span>
                    {{ $event->location }}
                </div>
                <a href="{{ route('events.show.public', $event) }}" class="mt-stack-sm w-full py-stack-sm bg-primary text-on-primary border-2 border-on-surface font-label-md uppercase active:translate-y-1 transition-all text-center block" style="text-decoration:none;">Lihat Detail</a>
            </div>
        </div>
        @empty
            <div class="col-span-full py-12 text-center border-2 border-dashed border-on-surface bg-surface-container">
                <p class="font-headline-md text-on-surface-variant">Belum ada event yang terdaftar.</p>
            </div>
        @endforelse
    </section>

    @if(isset($events) && method_exists($events, 'links'))
        <div class="mt-stack-md">
            {{ $events->links() }}
        </div>
    @endif

    <!-- Newsletter / CTA -->
    <section class="mt-stack-lg bg-primary-fixed border-2 border-on-surface shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-stack-lg flex flex-col md:flex-row items-center justify-between gap-stack-lg">
        <div class="max-w-xl">
            <h2 class="font-display-lg text-headline-lg md:text-headline-lg uppercase mb-2">JANGAN LEWATKAN <br class="hidden md:block"/>EVENT BERIKUTNYA</h2>
            <p class="font-body-lg text-on-primary-fixed-variant">Berlangganan untuk akses pre-sale eksklusif, info venue rahasia, dan kurasi event mingguan.</p>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row gap-stack-sm">
            <input class="bg-background border-2 border-on-surface p-stack-md font-label-md w-full md:w-72 outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all" placeholder="EMAIL@KAMU.COM" type="email"/>
            <button class="bg-on-surface text-background px-stack-lg py-stack-md font-label-md border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all uppercase">Gabung</button>
        </div>
    </section>
</main>
@endsection
