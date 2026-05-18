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
    
    .tab-active {
        background-color: var(--color-primary, #56642b);
        color: var(--color-on-primary, #ffffff);
        border: 2px solid #1c1c18;
        box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
    }
    
    .tab-inactive {
        color: var(--color-on-surface, #1c1c18);
    }
</style>
@endpush

@section('content')

@php
    $upcomingTickets = $tickets->filter(function($t) {
        return $t->event->date >= now();
    });
    $pastTickets = $tickets->filter(function($t) {
        return $t->event->date < now();
    });
@endphp

<main class="max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
    
    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-stack-lg mb-stack-lg">
        <div>
            <h1 class="font-display-lg text-3xl md:text-5xl font-black uppercase mb-2">My Tickets</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                Manage your upcoming experiences and revisit your favorite past events in one place.
            </p>
        </div>
        
        <!-- Tab Switcher -->
        @if($tickets->isNotEmpty())
            <div class="flex border-2 border-on-surface bg-surface-container-low p-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] self-start md:self-auto shrink-0">
                <button id="tab-upcoming" onclick="switchTab('upcoming')" 
                        class="px-6 py-2 font-label-md transition-all uppercase tab-active">
                    Upcoming
                </button>
                <button id="tab-past" onclick="switchTab('past')" 
                        class="px-6 py-2 font-label-md transition-all uppercase tab-inactive hover:bg-surface-variant">
                    Past Events
                </button>
            </div>
        @endif
    </div>

    @if($tickets->isEmpty())
        <!-- Empty State Container -->
        <section class="border-2 border-on-surface neubrutal-shadow bg-white p-stack-lg text-center my-12 max-w-2xl mx-auto transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div class="w-20 h-20 bg-tertiary-fixed text-on-tertiary-fixed border-2 border-on-surface neubrutal-shadow rounded-full flex items-center justify-center mx-auto mb-stack-md">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">sentiment_dissatisfied</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg uppercase mb-stack-sm tracking-tight">NO TICKETS FOUND!</h2>
            <p class="font-body-lg text-on-surface-variant max-w-md mx-auto mb-stack-lg">
                You haven't booked any experiences yet. Your next amazing adventure is just a click away!
            </p>
            <a href="{{ route('home') }}" 
               class="inline-block bg-primary text-on-primary font-headline-md px-8 py-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all uppercase italic text-decoration-none">
                BROWSE EVENTS NOW
            </a>
        </section>
    @else
        
        <!-- Section: Upcoming Events -->
        <section id="section-upcoming" class="mb-16">
            <div class="flex items-center gap-stack-md mb-stack-md">
                <div class="h-[2px] flex-grow bg-on-surface"></div>
                <h2 class="font-headline-md text-headline-md uppercase px-4 border-2 border-on-surface bg-tertiary-fixed shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Upcoming Events
                </h2>
                <div class="h-[2px] flex-grow bg-on-surface"></div>
            </div>

            @if($upcomingTickets->isEmpty())
                <div class="border-2 border-dashed border-on-surface bg-surface-container p-stack-lg text-center">
                    <p class="font-headline-md text-on-surface-variant uppercase">No upcoming events booked.</p>
                    <a href="{{ route('home') }}" class="text-primary font-label-md underline mt-2 block">Find events to join</a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
                    @foreach($upcomingTickets as $ticket)
                        @php
                            // Parse Event Category Tag
                            $titleUpper = strtoupper($ticket->event->title);
                            $category = 'LIVE EVENT';
                            if (str_contains($titleUpper, 'FESTIVAL')) $category = 'MUSIC FEST';
                            elseif (str_contains($titleUpper, 'CONCERT')) $category = 'CONCERT';
                            elseif (str_contains($titleUpper, 'PARTY')) $category = 'PARTY';
                            elseif (str_contains($titleUpper, 'CONFERENCE')) $category = 'TECH CONF';
                            
                            // Map Status Badges
                            $badgeClass = 'bg-primary-fixed text-on-primary-fixed';
                            $statusLabel = 'ACTIVE';
                            if ($ticket->status === 'pending') {
                                $badgeClass = 'bg-tertiary-fixed text-on-tertiary-fixed';
                                $statusLabel = 'PENDING';
                            } elseif ($ticket->status === 'used') {
                                $badgeClass = 'bg-surface-variant text-on-surface-variant';
                                $statusLabel = 'USED';
                            }
                        @endphp
                        
                        <!-- Ticket Card -->
                        <div class="flex flex-col md:flex-row border-2 border-on-surface bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden group transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                            <!-- Banner Column -->
                            <div class="w-full md:w-48 h-48 md:h-full shrink-0 relative border-b-2 md:border-b-0 md:border-r-2 border-on-surface overflow-hidden">
                                <img alt="{{ $ticket->event->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     src="{{ $ticket->event->image ? asset('storage/' . $ticket->event->image) : 'https://placehold.co/600x400/56642b/ffffff?text=' . urlencode($ticket->event->title) }}"/>
                                <div class="absolute top-2 left-2 bg-secondary-container text-on-secondary-container font-label-sm px-2 py-0.5 border-2 border-on-surface shadow-sm">
                                    {{ $category }}
                                </div>
                            </div>
                            
                            <!-- Info Column -->
                            <div class="flex-grow p-stack-md flex flex-col justify-between bg-surface">
                                <div>
                                    <div class="flex justify-between items-start gap-2 mb-stack-sm">
                                        <h3 class="font-headline-md text-lg leading-tight uppercase truncate max-w-[220px]">
                                            {{ $ticket->event->title }}
                                        </h3>
                                        <div class="shrink-0 px-2 py-0.5 border-2 border-on-surface font-label-md text-xs uppercase shadow-sm {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </div>
                                    </div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
                                            <span class="material-symbols-outlined text-[16px] shrink-0 text-primary">calendar_today</span>
                                            <span>{{ $ticket->event->date->format('M d, Y • g:i A') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 font-label-md text-xs text-on-surface-variant">
                                            <span class="material-symbols-outlined text-[16px] shrink-0 text-primary">location_on</span>
                                            <span class="truncate max-w-[200px]">{{ $ticket->event->location }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card Action Footer -->
                                <div class="flex gap-stack-md mt-stack-lg items-center">
                                    <a href="{{ route('tickets.show', $ticket) }}" 
                                       class="flex-grow text-center bg-primary-container text-on-primary-container font-label-md py-3 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase decoration-none block">
                                        View Ticket
                                    </a>
                                    
                                    @if($ticket->status === 'pending' && $ticket->transaction)
                                        <a href="{{ route('checkout', $ticket->transaction) }}" 
                                           class="bg-tertiary-container text-on-tertiary-container font-label-md py-3 px-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all uppercase decoration-none block">
                                            Pay Now
                                        </a>
                                    @else
                                        <button onclick="window.print()" 
                                                class="p-3 border-2 border-on-surface bg-white hover:bg-surface-variant transition-colors flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                                            <span class="material-symbols-outlined text-sm">print</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Section: Past Events -->
        <section id="section-past" class="mb-16 hidden">
            <div class="flex items-center gap-stack-md mb-stack-md">
                <div class="h-[2px] flex-grow bg-on-surface/20"></div>
                <h2 class="font-headline-md text-headline-md uppercase px-4 border-2 border-on-surface bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    Past Events
                </h2>
                <div class="h-[2px] flex-grow bg-on-surface/20"></div>
            </div>

            @if($pastTickets->isEmpty())
                <div class="border-2 border-dashed border-on-surface bg-surface-container p-stack-lg text-center opacity-75">
                    <p class="font-headline-md text-on-surface-variant uppercase">No past event history found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter opacity-90 transition-all duration-300">
                    @foreach($pastTickets as $ticket)
                        <!-- Past Ticket Card -->
                        <div class="border-2 border-on-surface bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col group hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all">
                            <div class="h-32 w-full border-b-2 border-on-surface relative overflow-hidden">
                                <img alt="{{ $ticket->event->title }}" 
                                     class="w-full h-full object-cover grayscale opacity-75 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500" 
                                     src="{{ $ticket->event->image ? asset('storage/' . $ticket->event->image) : 'https://placehold.co/600x400/56642b/ffffff?text=' . urlencode($ticket->event->title) }}"/>
                                <div class="absolute top-2 right-2 bg-on-surface text-white px-2 py-0.5 text-[9px] font-mono uppercase tracking-wider">
                                    PAST
                                </div>
                            </div>
                            <div class="p-stack-md flex-grow flex flex-col justify-between">
                                <div>
                                    <h4 class="font-headline-md text-sm uppercase leading-tight mb-1 truncate text-on-surface">
                                        {{ $ticket->event->title }}
                                    </h4>
                                    <p class="font-label-sm text-[10px] text-on-surface-variant uppercase mb-4">
                                        {{ $ticket->event->date->format('M d, Y') }} • {{ $ticket->event->location }}
                                    </p>
                                </div>
                                <a href="{{ route('tickets.show', $ticket) }}" 
                                   class="w-full text-center font-label-md py-2 border-2 border-on-surface bg-surface-variant hover:bg-surface-container-highest transition-colors decoration-none text-inherit block">
                                    Order Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Dynamic Tailwind Pagination -->
        @if(method_exists($tickets, 'links'))
            <div class="mt-8 border-t-2 border-on-surface pt-6">
                {{ $tickets->links() }}
            </div>
        @endif

    @endif

</main>
@endsection

@push('scripts')
<script>
    // SNAZZY CLIENT-SIDE TAB SWITCHER
    function switchTab(activeTab) {
        const tabUpcoming = document.getElementById('tab-upcoming');
        const tabPast = document.getElementById('tab-past');
        const sectionUpcoming = document.getElementById('section-upcoming');
        const sectionPast = document.getElementById('section-past');
        
        if (!tabUpcoming || !tabPast || !sectionUpcoming || !sectionPast) return;

        if (activeTab === 'upcoming') {
            // Show upcoming, hide past
            sectionUpcoming.classList.remove('hidden');
            sectionPast.classList.add('hidden');
            
            // Adjust buttons active styling
            tabUpcoming.className = "px-6 py-2 font-label-md transition-all uppercase tab-active";
            tabPast.className = "px-6 py-2 font-label-md transition-all uppercase tab-inactive hover:bg-surface-variant";
        } else {
            // Show past, hide upcoming
            sectionPast.classList.remove('hidden');
            sectionUpcoming.classList.add('hidden');
            
            // Adjust buttons active styling
            tabPast.className = "px-6 py-2 font-label-md transition-all uppercase tab-active";
            tabUpcoming.className = "px-6 py-2 font-label-md transition-all uppercase tab-inactive hover:bg-surface-variant";
        }
    }
</script>
@endpush
