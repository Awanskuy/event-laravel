<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Panel - {{ config('app.name', 'KARCIS') }}</title>

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

        .neubrutal-shadow {
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
        }
        .neubrutal-shadow-sm {
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        }
        .neubrutal-shadow-lg {
            box-shadow: 8px 8px 0px 0px rgba(0,0,0,1);
        }

        /* Sidebar active link indicator */
        .sidebar-link {
            transition: all 0.15s ease;
        }
        .sidebar-link:hover {
            transform: translateX(4px);
        }
        .sidebar-link.active {
            transform: translateX(4px);
        }

        /* Mobile sidebar overlay */
        .sidebar-overlay {
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(2px);
        }

        /* Scrollbar styling */
        .admin-content::-webkit-scrollbar {
            width: 6px;
        }
        .admin-content::-webkit-scrollbar-track {
            background: transparent;
        }
        .admin-content::-webkit-scrollbar-thumb {
            background: #c6c8b8;
            border-radius: 3px;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-background text-on-background font-body-md min-h-screen">

    <div class="flex min-h-screen">

        {{-- ═══════════════════════════════════════ --}}
        {{--  SIDEBAR - Desktop (fixed) + Mobile    --}}
        {{-- ═══════════════════════════════════════ --}}

        {{-- Mobile overlay --}}
        <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

        <aside id="admin-sidebar"
               class="fixed md:sticky top-0 left-0 z-50 h-screen w-[260px] bg-inverse-surface text-inverse-on-surface border-r-3 border-on-surface flex flex-col
                      transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-out">

            {{-- Sidebar Header --}}
            <div class="p-stack-md border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" style="text-decoration:none;">
                    <div class="w-10 h-10 bg-primary flex items-center justify-center border-2 border-white/20">
                        <span class="material-symbols-outlined text-on-primary text-xl" style="font-variation-settings: 'FILL' 1;">
                            shield_person
                        </span>
                    </div>
                    <div>
                        <p class="font-headline-md text-base text-white uppercase tracking-tight leading-none">KARCIS</p>
                        <p class="font-label-sm text-[10px] text-white/50 uppercase tracking-widest mt-0.5">Panel Admin</p>
                    </div>
                </a>
            </div>

            {{-- Admin Profile --}}
            <div class="px-stack-md py-3 border-b border-white/10 flex items-center gap-3">
                <div class="w-8 h-8 bg-primary-container border-2 border-white/20 flex items-center justify-center text-sm font-bold text-on-primary-container uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-mono text-white/40 uppercase tracking-wider">Administrator</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto py-stack-md px-3 space-y-1">

                <p class="px-3 mb-2 font-label-sm text-[10px] text-white/30 uppercase tracking-widest font-bold">Ringkasan</p>

                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded
                          {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-on-primary active' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' {{ request()->routeIs('admin.dashboard') ? '1' : '0' }};">
                        dashboard
                    </span>
                    <span class="font-label-md text-xs uppercase">Dashboard</span>
                </a>

                <p class="px-3 mb-2 mt-5 font-label-sm text-[10px] text-white/30 uppercase tracking-widest font-bold">Manajemen</p>

                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded
                          {{ request()->routeIs('admin.users.*') ? 'bg-primary text-on-primary active' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' {{ request()->routeIs('admin.users.*') ? '1' : '0' }};">
                        group
                    </span>
                    <span class="font-label-md text-xs uppercase">Pengguna</span>
                    <span class="ml-auto bg-white/10 text-white/60 font-mono text-[10px] px-1.5 py-0.5 rounded">
                        {{ \App\Models\User::count() }}
                    </span>
                </a>

                <a href="{{ route('admin.tickets.validate') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded
                          {{ request()->routeIs('admin.tickets.*') ? 'bg-primary text-on-primary active' : 'text-white/70 hover:text-white hover:bg-white/5' }}"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' {{ request()->routeIs('admin.tickets.*') ? '1' : '0' }};">
                        qr_code_scanner
                    </span>
                    <span class="font-label-md text-xs uppercase">Validasi Tiket</span>
                </a>

                <p class="px-3 mb-2 mt-5 font-label-sm text-[10px] text-white/30 uppercase tracking-widest font-bold">Akses Cepat</p>

                <a href="{{ route('home') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded text-white/70 hover:text-white hover:bg-white/5"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-xl">explore</span>
                    <span class="font-label-md text-xs uppercase">Jelajah Event</span>
                </a>

                <a href="{{ route('events.create') }}"
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded text-white/70 hover:text-white hover:bg-white/5"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-xl">add_box</span>
                    <span class="font-label-md text-xs uppercase">Buat Event</span>
                </a>

            </nav>

            {{-- Sidebar Footer --}}
            <div class="p-3 border-t border-white/10 space-y-2">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded text-white/50 hover:text-white hover:bg-white/5 transition-colors"
                   style="text-decoration:none;">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    <span class="font-label-sm text-[11px] uppercase">Kembali ke Situs</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-2 px-3 py-2 rounded text-red-400/70 hover:text-red-400 hover:bg-red-500/10 transition-colors border-0 bg-transparent cursor-pointer">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span class="font-label-sm text-[11px] uppercase">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ═══════════════════════════════════════ --}}
        {{--  MAIN CONTENT AREA                     --}}
        {{-- ═══════════════════════════════════════ --}}

        <div class="flex-1 flex flex-col min-h-screen admin-content">

            {{-- Top Bar (Mobile hamburger + breadcrumb) --}}
            <header class="sticky top-0 z-30 flex items-center gap-4 px-margin-mobile md:px-stack-lg py-3 bg-background/80 backdrop-blur-md border-b-2 border-on-surface">

                {{-- Mobile hamburger --}}
                <button onclick="toggleSidebar()"
                        class="md:hidden p-1.5 border-2 border-on-surface bg-surface-container-low neubrutal-shadow-sm hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all">
                    <span class="material-symbols-outlined text-xl block">menu</span>
                </button>

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-xs font-mono uppercase tracking-wider">
                    <span class="text-on-surface-variant">Admin</span>
                    <span class="text-on-surface-variant">/</span>
                    <span class="text-on-surface font-bold">@yield('page-title', 'Dashboard')</span>
                </div>

                {{-- Right side: timestamp --}}
                <div class="ml-auto flex items-center gap-2">
                    <span class="hidden sm:inline-block w-2.5 h-2.5 bg-primary rounded-full border-2 border-on-surface animate-pulse"></span>
                    <span class="hidden sm:block font-mono text-[10px] text-on-surface-variant uppercase tracking-wider">
                        {{ now()->format('d M Y • H:i') }}
                    </span>
                </div>
            </header>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="px-margin-mobile md:px-stack-lg pt-4">
                    <div class="bg-primary-container text-on-primary-container p-stack-md border-2 border-on-surface neubrutal-shadow font-label-md flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-margin-mobile md:px-stack-lg pt-4">
                    <div class="bg-error-container text-on-error-container p-stack-md border-2 border-on-surface neubrutal-shadow font-label-md flex items-center gap-3">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">error</span>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 p-margin-mobile md:p-stack-lg">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="px-margin-mobile md:px-stack-lg py-3 border-t border-on-surface/10">
                <p class="font-label-sm text-[10px] text-on-surface-variant/50 text-center uppercase tracking-wider">
                    &copy; {{ date('Y') }} {{ config('app.name', 'KARCIS') }} — Admin Operations Console
                </p>
            </footer>
        </div>

    </div>

    {{-- Sidebar Toggle Script --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>
