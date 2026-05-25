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
    
    .ticket-perforation {
        background-image: radial-gradient(circle, transparent 50%, #fcf9f2 50%);
        background-size: 12px 12px;
        background-position: -6px center;
        background-repeat: repeat-y;
    }
</style>
@endpush

@section('content')

@php
    $ticketsCount = $event->tickets()->count();
    $remaining = max(0, $event->quota - $ticketsCount);
    $percentage = $event->quota > 0 ? ($remaining / $event->quota) * 100 : 0;
    
    // Dynamic category tag based on title
    $titleUpper = strtoupper($event->title);
    $categoryTag = 'EVENT';
    if (str_contains($titleUpper, 'FESTIVAL')) $categoryTag = 'FESTIVAL';
    elseif (str_contains($titleUpper, 'CONCERT')) $categoryTag = 'KONSER';
    elseif (str_contains($titleUpper, 'PARTY')) $categoryTag = 'PESTA';
    elseif (str_contains($titleUpper, 'CONFERENCE')) $categoryTag = 'KONFERENSI';
    elseif (str_contains($titleUpper, 'MEETUP')) $categoryTag = 'MEETUP';
    elseif (str_contains($titleUpper, 'WORKSHOP')) $categoryTag = 'WORKSHOP';
    elseif (str_contains($titleUpper, 'EXPO')) $categoryTag = 'PAMERAN';
@endphp

<main class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg flex flex-col md:flex-row gap-gutter relative">
    
    <!-- Left Content Column -->
    <div class="flex-1 space-y-stack-lg">
        
        <!-- Hero Event Details Section -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-white overflow-hidden">
            <div class="aspect-[16/9] md:aspect-[21/9] w-full overflow-hidden border-b-2 border-on-surface relative group">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                     alt="{{ $event->title }}"
                     src="{{ $event->image_url }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent pointer-events-none"></div>
            </div>
            
            <div class="p-stack-md md:p-stack-lg bg-surface">
                <!-- Badges Row -->
                <div class="flex flex-wrap gap-2 mb-stack-sm">
                    <span class="bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-sm px-3 py-1 border-2 border-on-surface">
                        {{ $categoryTag }}
                    </span>
                    @if($remaining <= 0)
                        <span class="bg-error-container text-on-error-container font-label-md text-label-sm px-3 py-1 border-2 border-on-surface">
                            HABIS
                        </span>
                    @elseif($percentage <= 15)
                        <span class="bg-secondary-container text-on-secondary-container font-label-md text-label-sm px-3 py-1 border-2 border-on-surface animate-pulse">
                            SISA SEDIKIT
                        </span>
                    @else
                        <span class="bg-primary-fixed text-on-primary-fixed font-label-md text-label-sm px-3 py-1 border-2 border-on-surface">
                            CEPAT HABIS
                        </span>
                    @endif
                </div>

                <h1 class="font-headline-lg text-2xl md:text-4xl text-on-surface mb-4 uppercase italic leading-none">
                    {{ $event->title }}
                </h1>
                
                <!-- Quick Meta Stats Grid -->
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 text-on-surface-variant font-label-md border-t-2 border-on-surface pt-4 mt-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">calendar_today</span>
                        <span class="font-bold">{{ $event->date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 border-on-surface-variant border-opacity-20 sm:border-l sm:pl-4">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        <span class="font-bold">{{ $event->date->format('g:i A') }} WIB</span>
                    </div>
                    <div class="flex items-center gap-2 border-on-surface-variant border-opacity-20 sm:border-l sm:pl-4">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <span class="font-bold truncate max-w-[200px]">{{ $event->location }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- About The Event Section -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-surface-container p-stack-md md:p-stack-lg">
            <h2 class="font-headline-md text-headline-md mb-stack-md flex items-center gap-2 uppercase tracking-wide">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">info</span> 
                TENTANG EVENT
            </h2>
            <div class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                {{ $event->description }}
            </div>
        </section>

        <!-- Dynamic Timeline & Schedule -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-white p-stack-md md:p-stack-lg">
            <h2 class="font-headline-md text-headline-md mb-stack-lg flex items-center gap-2 uppercase tracking-wide">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">timeline</span> 
                JADWAL ACARA
            </h2>
            <div class="space-y-6 relative border-l-2 border-on-surface ml-4 pl-6">
                <!-- Timeline Dot 1 -->
                <div class="relative">
                    <div class="absolute -left-[35px] top-1.5 w-6 h-6 rounded-full border-2 border-on-surface bg-primary-fixed flex items-center justify-center neubrutal-shadow-sm">
                        <span class="w-2.5 h-2.5 bg-on-surface rounded-full"></span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                        <span class="bg-primary text-on-primary font-mono text-xs px-2 py-0.5 border-2 border-on-surface shadow-sm w-fit shrink-0">
                            {{ $event->date->copy()->subHour()->format('H:i') }} WIB
                        </span>
                        <h4 class="font-headline-md text-[16px] uppercase leading-tight text-on-surface">PINTU DIBUKA &amp; CHECK-IN</h4>
                    </div>
                    <p class="text-sm text-on-surface-variant">Datang lebih awal untuk memindai tiket KARCIS digitalmu dan dapatkan tempat terbaik.</p>
                </div>

                <!-- Timeline Dot 2 -->
                <div class="relative">
                    <div class="absolute -left-[35px] top-1.5 w-6 h-6 rounded-full border-2 border-on-surface bg-secondary-container flex items-center justify-center neubrutal-shadow-sm">
                        <span class="w-2.5 h-2.5 bg-on-surface rounded-full"></span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                        <span class="bg-secondary text-on-secondary font-mono text-xs px-2 py-0.5 border-2 border-on-surface shadow-sm w-fit shrink-0">
                            {{ $event->date->format('H:i') }} WIB
                        </span>
                        <h4 class="font-headline-md text-[16px] uppercase leading-tight text-on-surface">PEMBUKAAN &amp; SAMBUTAN HOST</h4>
                    </div>
                    <p class="text-sm text-on-surface-variant">Pembukaan resmi acara, sambutan dari host, dan penampilan pembuka.</p>
                </div>

                <!-- Timeline Dot 3 -->
                <div class="relative">
                    <div class="absolute -left-[35px] top-1.5 w-6 h-6 rounded-full border-2 border-on-surface bg-tertiary-fixed flex items-center justify-center neubrutal-shadow-sm">
                        <span class="w-2.5 h-2.5 bg-on-surface rounded-full"></span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                        <span class="bg-tertiary text-on-tertiary font-mono text-xs px-2 py-0.5 border-2 border-on-surface shadow-sm w-fit shrink-0">
                            {{ $event->date->copy()->addHours(2)->format('H:i') }} WIB
                        </span>
                        <h4 class="font-headline-md text-[16px] uppercase leading-tight text-on-surface">SESI ACARA UTAMA</h4>
                    </div>
                    <p class="text-sm text-on-surface-variant">Segmen utama interaktif, penampilan bintang utama, sesi tanya jawab, atau live set.</p>
                </div>
            </div>
        </section>

        <!-- Lineup Section -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-white p-stack-md md:p-stack-lg">
            <h2 class="font-headline-md text-headline-md mb-stack-md flex items-center gap-2 uppercase tracking-wide">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">graphic_eq</span> 
                BINTANG TAMU &amp; HOST
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-stack-md">
                <!-- Guest 1 -->
                <div class="border-2 border-on-surface p-stack-sm flex items-center gap-4 bg-primary-fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">
                    <img class="w-14 h-14 border-2 border-on-surface object-cover grayscale" 
                         alt="DJ NEON" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgARBiu-_-fSmu2EC6a-WGOq14JZnDfL8SiuBMc9IMkgCD835I9KsZlGyddgHf_iZjKvCd1UFUojR6ytF0OzTc_XkQU1Da7NEV5o0fQ1d9QES_LpC8i7WSwyEHz6t7XZ5yB8BZy6ZGfKdiXLNcROFIzA14moQbJTPH6TvXi7-SV0kT7-KJPucotNviXn0r7uAxkbl50O7U5VADQsBY6dSLt-c9TmJn22HPXgLOX0gFvNNNeCvs1GiGtgVducWQelPVmTjZeRLK_AE"/>
                    <div>
                        <h3 class="font-bold text-sm text-on-surface uppercase">DJ NEON</h3>
                        <p class="text-[10px] font-mono uppercase text-on-surface-variant">Host Spesial</p>
                    </div>
                </div>

                <!-- Guest 2 -->
                <div class="border-2 border-on-surface p-stack-sm flex items-center gap-4 bg-secondary-fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">
                    <img class="w-14 h-14 border-2 border-on-surface object-cover grayscale" 
                         alt="BASS HUNTER" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6uQ6qPWUyotUFU-cujP3UFp7tSNl_MUSrOMHOET0dCqqeVvuYnXz0SitQYZ14e8ujOq_xmr7dAquDlcz0zBIxM6OiyKaetseWjmzjuaNDsel-GGBoNb5cpwvkwV_00NZ4-tzEP-Z5evD12VqK-IS5dnGLYLeJxrcPdYyih8CeTogfTDMWQh6VmBs-vBXjkdL56QAZC5tQ1d7vQKaQlqolW23MDZKxj-TI2ycbiQf3XKkTQybp3bPNGVAnrd3FlTcXnCy6o6zQEdI"/>
                    <div>
                        <h3 class="font-bold text-sm text-on-surface uppercase">BASS HUNTER</h3>
                        <p class="text-[10px] font-mono uppercase text-on-surface-variant">Pembicara Utama</p>
                    </div>
                </div>

                <!-- Guest 3 -->
                <div class="border-2 border-on-surface p-stack-sm flex items-center gap-4 bg-tertiary-fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all">
                    <img class="w-14 h-14 border-2 border-on-surface object-cover grayscale" 
                         alt="JUNGLE QUEEN" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuD15NSNXq0jpt_zisKjLU59EuIS-q0-3fS11E6uYCoD8JqH-pETkRD0v0URamTbFyLdZSVw8RFYKG5STBoW9xVPURYKA2qIoFQgAeEUZrvvQOUU81ckdzHv4Uxb3ATKn-ytXemJbhi_bt-72751wUQLRQFzLxqvl1_Yr0wMZErCZZAkKztWHIlfyWL7BC427TgNrbACChWWuyjuMNcdk56uGLIma_nMpXv_VwK9BswuX3WCkZWlV4NSSyucHdEp9g3YcuEiQbErOO4"/>
                    <div>
                        <h3 class="font-bold text-sm text-on-surface uppercase">JUNGLE QUEEN</h3>
                        <p class="text-[10px] font-mono uppercase text-on-surface-variant">Bintang Tamu</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Venue & Location Section -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-surface overflow-hidden">
            <div class="p-stack-md md:p-stack-lg">
                <h2 class="font-headline-md text-headline-md mb-stack-md flex items-center gap-2 uppercase tracking-wide">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">map</span> 
                    LOKASI &amp; PETUNJUK ARAH
                </h2>
                <div class="flex flex-col lg:flex-row gap-stack-md">
                    <div class="flex-1 space-y-4">
                        <h3 class="font-headline-md text-[20px] uppercase text-on-surface">{{ $event->location }}</h3>
                        <p class="font-body-md text-on-surface-variant">Berlokasi di kawasan event premium. Fasilitas nyaman dengan suasana neubrutalist yang rapi.</p>
                        <p class="font-body-md text-on-surface-variant italic">Tunjukkan tiket aktifmu di pintu masuk.</p>
                        
                        <button onclick="window.open('https://www.google.com/maps/search/?api=1&amp;query=' + encodeURIComponent('{{ $event->location }}'), '_blank')" 
                                class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all flex items-center gap-2 w-fit">
                            <span class="material-symbols-outlined">directions</span> LIHAT PETA
                        </button>
                    </div>
                    
                    <!-- Stylized Neubrutalist Map -->
                    <div class="w-full lg:w-[350px] aspect-square border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] bg-surface-container-highest relative group overflow-hidden">
                        <img class="w-full h-full object-cover grayscale opacity-80 transition-all duration-700 group-hover:scale-105" 
                             alt="Map showing {{ $event->location }}" 
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuB71Mp642bUD_FZqjPbu3c2XvZbs3Nembr3qA-yGOJeZ_e7ZgwGqT47WAAiy-7LZCyTyaFGM9rqlducQWs1AqGRe8zf1183Ra7-X7MaisZs9olr7aiCk1u7W4Jcg7vKC9ZfC9PiXeSC3j66LVVam59ghJtgrIbiGG7fTilcHlAZ1xy7WRMvO-k73vNbgrColA82-3zqkzIc5RMKpSj50HNtLAvJ7iYVRsNNAupkOakiu8VShuOpgtrZq58fw5SOCssPeZxOZaLUAjc"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white border-2 border-on-surface px-4 py-2 font-label-md text-label-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] uppercase">
                                PINTU UTAMA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Events Section -->
        @if($relatedEvents->isNotEmpty())
            <section class="border-2 border-on-surface neubrutal-shadow bg-white p-stack-md md:p-stack-lg">
                <h2 class="font-headline-md text-headline-md mb-stack-md flex items-center gap-2 uppercase tracking-wide">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">explore</span> 
                    JELAJAHI EVENT LAINNYA
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-stack-md">
                    @foreach($relatedEvents as $relEvent)
                        <a href="{{ route('events.show.public', $relEvent) }}" 
                           class="group border-2 border-on-surface bg-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all flex flex-col overflow-hidden text-decoration-none text-inherit">
                            <div class="aspect-[16/9] w-full overflow-hidden border-b-2 border-on-surface relative">
                                <img src="{{ $relEvent->image_url }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     alt="{{ $relEvent->title }}">
                                <div class="absolute top-2 right-2 bg-primary-container text-on-primary-container font-mono text-[10px] px-2 py-1 border border-on-surface shadow-sm">
                                    @if($relEvent->price > 0)
                                        Rp {{ number_format($relEvent->price, 0, ',', '.') }}
                                    @else
                                        FREE
                                    @endif
                                </div>
                            </div>
                            <div class="p-stack-sm flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="font-headline-md text-sm uppercase leading-tight mb-1 truncate text-on-surface">
                                        {{ $relEvent->title }}
                                    </h3>
                                    <div class="flex items-center gap-1 text-[10px] text-on-surface-variant font-mono">
                                        <span class="material-symbols-outlined text-[12px]">calendar_today</span>
                                        <span>{{ $relEvent->date->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3 pt-2 border-t border-on-surface-variant border-opacity-10 text-[10px] font-mono">
                                    <span class="truncate max-w-[120px] text-on-surface-variant">{{ $relEvent->location }}</span>
                                    <span class="text-primary font-bold">LIHAT INFO →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

    </div>

    <!-- Right Sidebar (Sticky Ticket Section) -->
    <aside class="w-full md:w-[380px] space-y-stack-md shrink-0">
        
        <!-- Sticky Stub Ticket Stub -->
        <div class="sticky top-[100px] border-2 border-on-surface neubrutal-shadow-lg bg-white overflow-hidden transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
            
            <div class="bg-primary-container p-4 border-b-2 border-on-surface flex justify-between items-center">
                <h3 class="font-headline-md text-[18px] text-on-primary-container uppercase tracking-wider">
                    TIKET
                </h3>
                <span class="material-symbols-outlined text-on-primary-container text-xl animate-bounce">local_activity</span>
            </div>

            <!-- Stub Content -->
            <div class="p-stack-md bg-surface relative">
                
                <!-- Price & Visual Badge -->
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase mb-0.5">Harga Tiket Standar</p>
                        <h4 class="font-headline-md text-2xl text-on-surface">
                            @if($event->price > 0)
                                Rp {{ number_format($event->price, 0, ',', '.') }}
                            @else
                                GRATIS
                            @endif
                        </h4>
                    </div>
                    
                    @if($remaining <= 0)
                        <span class="bg-error text-on-error font-label-md text-label-sm px-2.5 py-1 border-2 border-on-surface">
                            HABIS
                        </span>
                    @elseif($percentage <= 15)
                        <span class="bg-secondary-container text-on-secondary-container font-label-md text-label-sm px-2.5 py-1 border-2 border-on-surface">
                            SISA SEDIKIT
                        </span>
                    @else
                        <span class="bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-label-sm px-2.5 py-1 border-2 border-on-surface">
                            CEPAT HABIS
                        </span>
                    @endif
                </div>

                <!-- Ticket Availability Indicator -->
                <div class="mb-5 pb-4 border-b border-on-surface-variant border-opacity-15">
                    <div class="flex justify-between text-[11px] font-mono text-on-surface-variant mb-1.5 uppercase font-bold">
                        <span>KETERSEDIAAN</span>
                        <span>{{ $remaining }} / {{ $event->quota }} KURSI TERSISA</span>
                    </div>
                    <div class="w-full bg-surface-container-high border-2 border-on-surface h-3.5 neubrutal-shadow-sm overflow-hidden flex">
                        <div class="bg-primary-container h-full border-r-2 border-on-surface transition-all duration-500" 
                             style="width: {{ min(100, (1 - ($remaining / $event->quota)) * 100) }}%"></div>
                    </div>
                </div>

                <!-- Features Bullets -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <span class="font-bold text-sm text-on-surface-variant">Akses ke panggung utama &amp; semua zona</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <span class="font-bold text-sm text-on-surface-variant">Slot registrasi terjamin</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <span class="font-bold text-sm text-on-surface-variant">E-Tiket QR yang bisa dipindai</span>
                    </div>
                </div>

                <!-- Perforation Line -->
                <div class="h-4 w-full flex items-center mb-6 overflow-hidden">
                    <div class="flex-1 border-t-2 border-dashed border-on-surface"></div>
                </div>

                <!-- Ticket Action CTA Form -->
                @guest
                    <a href="{{ route('login') }}" 
                       class="w-full text-center bg-primary text-on-primary font-headline-md text-[18px] py-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase italic block decoration-none">
                        MASUK UNTUK PESAN
                    </a>
                @else
                    @if(Auth::user()->role === 'organizer' && Auth::id() === $event->user_id)
                        <a href="{{ route('events.edit', $event) }}" 
                           class="w-full text-center bg-secondary-container text-on-secondary-container font-headline-md text-[18px] py-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase italic block decoration-none">
                            UBAH EVENT
                        </a>
                    @elseif($remaining <= 0)
                        <button disabled 
                                class="w-full bg-surface-container-highest text-on-surface-variant font-headline-md text-[18px] py-4 border-2 border-on-surface shadow-none opacity-60 cursor-not-allowed uppercase italic">
                            HABIS
                        </button>
                    @else
                        <form action="{{ route('tickets.store', $event) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-primary text-on-primary font-headline-md text-[18px] py-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase italic">
                                PESAN TIKET SEKARANG
                            </button>
                        </form>
                    @endif
                @endguest

                <p class="text-center font-label-sm text-[10px] text-on-surface-variant mt-4 uppercase tracking-wide">
                    TANPA REFUND • WAJIB VALIDASI DIGITAL
                </p>
            </div>
        </div>

        <!-- Organizer Profile Card -->
        <div class="border-2 border-on-surface p-stack-md bg-surface-container-high shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)]">
            <p class="font-label-sm text-label-sm text-on-surface-variant uppercase mb-2">Penyelenggara Event</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-on-surface text-surface flex items-center justify-center font-black rounded-lg text-sm shrink-0">
                    {{ strtoupper(substr($event->user->name, 0, 2)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="font-headline-md text-sm truncate uppercase text-on-surface leading-tight mb-0.5">
                        {{ $event->user->name }}
                    </p>
                    <a class="text-primary font-label-md text-xs underline block truncate hover:text-on-primary-container" 
                       href="mailto:{{ $event->user->email }}">
                        Hubungi Penyelenggara
                    </a>
                </div>
            </div>
        </div>

    </aside>

</main>
@endsection
