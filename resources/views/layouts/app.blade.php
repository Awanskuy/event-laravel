<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ config('app.name', 'KARCIS') }}</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>

    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@700;800&family=Hanken+Grotesk:wght@400;500&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "inverse-on-surface": "#f3f0e9",
                "secondary": "#8e4c3c",
                "error-container": "#ffdad6",
                "surface-bright": "#fcf9f2",
                "secondary-fixed-dim": "#ffb4a3",
                "tertiary": "#745b00",
                "on-secondary-container": "#793b2c",
                "on-primary-container": "#253000",
                "outline": "#76786b",
                "tertiary-container": "#caa844",
                "error": "#ba1a1a",
                "on-secondary-fixed": "#390b03",
                "on-primary-fixed": "#161f00",
                "surface-container-lowest": "#ffffff",
                "secondary-container": "#fea995",
                "surface-container-low": "#f6f3ec",
                "on-tertiary-container": "#4f3e00",
                "on-primary-fixed-variant": "#3e4c16",
                "on-tertiary": "#ffffff",
                "primary-container": "#8a9a5b",
                "outline-variant": "#c6c8b8",
                "tertiary-fixed-dim": "#e7c35b",
                "on-surface": "#1c1c18",
                "on-secondary": "#ffffff",
                "on-secondary-fixed-variant": "#713527",
                "tertiary-fixed": "#ffe08c",
                "surface-tint": "#56642b",
                "surface-container-highest": "#e5e2db",
                "surface-dim": "#dcdad3",
                "secondary-fixed": "#ffdad2",
                "on-tertiary-fixed": "#241a00",
                "primary": "#56642b",
                "on-primary": "#ffffff",
                "inverse-surface": "#31312c",
                "surface-variant": "#e5e2db",
                "background": "#fcf9f2",
                "primary-fixed-dim": "#bdce89",
                "on-surface-variant": "#46483c",
                "surface": "#fcf9f2",
                "surface-container": "#f1eee7",
                "on-error-container": "#93000a",
                "on-background": "#1c1c18",
                "on-error": "#ffffff",
                "inverse-primary": "#bdce89",
                "primary-fixed": "#d9eaa3",
                "on-tertiary-fixed-variant": "#584400",
                "surface-container-high": "#ebe8e1"
              },

              borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
              },

              spacing: {
                "margin-mobile": "16px",
                "stack-sm": "8px",
                "gutter": "24px",
                "stack-lg": "32px",
                "unit": "4px",
                "margin-desktop": "48px",
                "stack-md": "16px"
              },

              fontFamily: {
                "headline-lg": ["Anybody"],
                "display-lg-mobile": ["Anybody"],
                "label-md": ["Space Mono"],
                "headline-md": ["Anybody"],
                "body-md": ["Hanken Grotesk"],
                "display-lg": ["Anybody"],
                "body-lg": ["Hanken Grotesk"],
                "label-sm": ["Space Mono"]
              },

              fontSize: {
                "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "800"}],
                "display-lg-mobile": ["40px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "700"}],
                "headline-md": ["24px", {"lineHeight": "1.2", "fontWeight": "700"}],
                "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "500"}],
                "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "400"}]
              }
            },
          },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .hard-shadow {
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
        }

        .hover-shadow:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
        }

        .active-shadow:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px rgba(0,0,0,1);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-background text-on-background font-body-md min-h-screen">

    {{-- Navbar --}}
    <header class="sticky top-0 z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-stack-sm bg-background w-full border-b-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">

        <a href="{{ url('/') }}"
           class="font-headline-lg text-headline-lg text-primary uppercase tracking-tighter"
           style="text-decoration:none;">
            {{ config('app.name', 'KARCIS') }}
        </a>

        <div class="hidden md:flex flex-1 max-w-md mx-gutter">
            <div class="relative w-full">
                <input
                    class="w-full bg-surface-container-low border-2 border-on-surface py-2 px-4 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all font-label-md"
                    placeholder="Search events..."
                    type="text"
                />

                <span class="material-symbols-outlined absolute right-3 top-2.5 text-on-surface-variant">
                    search
                </span>
            </div>
        </div>

        <nav class="flex items-center gap-stack-md">

            @guest
                <a class="hidden md:block font-label-md text-on-surface-variant hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                   style="text-decoration:none;"
                   href="{{ route('login') }}">
                    Login
                </a>

                <a class="hidden md:block font-label-md text-on-surface-variant hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                   style="text-decoration:none;"
                   href="{{ route('register') }}">
                    Register
                </a>
            @else

                @if(Auth::user()->isAdmin())
                    <a class="hidden md:block font-label-md text-on-surface-variant hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                       style="text-decoration:none;"
                       href="{{ route('admin.dashboard') }}">
                        Admin
                    </a>
                @endif

                @if(Auth::user()->isOrganizer() && Route::has('events.index'))
                    <a class="hidden md:block font-label-md text-on-surface-variant hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                       style="text-decoration:none;"
                       href="{{ route('events.index') }}">
                        My Events
                    </a>
                @endif

                <a class="hidden md:block font-label-md text-on-surface-variant hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                   style="text-decoration:none;"
                   href="{{ route('tickets.index') }}">
                    Tickets
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="p-2 border-2 border-on-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all active:scale-95 bg-primary-container">

                        <span class="material-symbols-outlined block">
                            logout
                        </span>
                    </button>
                </form>

            @endguest
        </nav>
    </header>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="md:px-margin-desktop px-margin-mobile pt-4">
            <div class="bg-primary-container text-on-primary-container p-stack-md border-2 border-on-surface hard-shadow font-label-md">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="md:px-margin-desktop px-margin-mobile pt-4">
            <div class="bg-error-container text-on-error-container p-stack-md border-2 border-on-surface hard-shadow font-label-md">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Content --}}
    @yield('content')

    {{-- Mobile Navbar --}}
    <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-margin-mobile py-2 bg-background border-t-2 border-on-surface shadow-[0px_-4px_0px_0px_rgba(0,0,0,1)]">

        <a class="flex flex-col items-center justify-center bg-secondary-container text-on-secondary-container border-2 border-on-surface px-4 py-1 rounded-lg"
           style="text-decoration:none;"
           href="{{ url('/') }}">
            <span class="material-symbols-outlined">search</span>
            <span class="font-label-sm">Explore</span>
        </a>

        <a class="flex flex-col items-center justify-center text-on-surface-variant"
           style="text-decoration:none;"
           href="{{ route('tickets.index') }}">
            <span class="material-symbols-outlined">local_activity</span>
            <span class="font-label-sm">Tickets</span>
        </a>

        @auth

            @if(auth()->user()->isOrganizer() && Route::has('events.index'))
                <a class="flex flex-col items-center justify-center text-on-surface-variant"
                   style="text-decoration:none;"
                   href="{{ route('events.index') }}">

                    <span class="material-symbols-outlined">event</span>
                    <span class="font-label-sm">Events</span>
                </a>
            @endif

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="flex flex-col items-center justify-center border-0 bg-transparent text-on-surface-variant">

                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label-sm">Logout</span>
                </button>
            </form>

        @else

            <a class="flex flex-col items-center justify-center text-on-surface-variant"
               style="text-decoration:none;"
               href="{{ route('login') }}">

                <span class="material-symbols-outlined">login</span>
                <span class="font-label-sm">Login</span>
            </a>

        @endauth
    </nav>

    {{-- Footer --}}
    <footer class="hidden md:block mt-stack-lg border-t-2 border-on-surface bg-surface-container p-margin-desktop">

        <div class="grid grid-cols-4 gap-gutter mb-stack-lg">

            <div class="col-span-2">
                <div class="font-headline-lg text-primary uppercase mb-stack-md">
                    {{ config('app.name', 'KARCIS') }}
                </div>

                <p class="font-body-md text-on-surface-variant max-w-sm">
                    The world's first neubrutalist ticketing platform built for discovery.
                </p>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-label-md text-primary uppercase">Platform</span>
                <a class="text-on-surface" href="#">Browse Music</a>
                <a class="text-on-surface" href="#">Tech Events</a>
                <a class="text-on-surface" href="#">Listings</a>
            </div>

            <div class="flex flex-col gap-2">
                <span class="font-label-md text-primary uppercase">Social</span>
                <a class="text-on-surface" href="#">Instagram</a>
                <a class="text-on-surface" href="#">Twitter / X</a>
                <a class="text-on-surface" href="#">Discord</a>
            </div>

        </div>

        <div class="flex justify-between items-center pt-stack-md border-t-2 border-on-surface border-opacity-10">

            <p class="font-label-sm opacity-60">
                &copy; {{ date('Y') }} {{ config('app.name', 'KARCIS') }}
            </p>

            <div class="flex gap-stack-md">
                <a class="font-label-sm opacity-60 text-on-surface" href="#">Privacy</a>
                <a class="font-label-sm opacity-60 text-on-surface" href="#">Terms</a>
            </div>

        </div>
    </footer>

    <div class="h-20 md:hidden"></div>

    @stack('scripts')

</body>
</html>