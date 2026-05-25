@extends('layouts.app')

@section('content')
<!-- Main Registration Content -->
<main class="flex-grow flex items-center justify-center px-margin-mobile py-stack-lg md:py-20 relative">
    <div class="w-full max-w-[480px] bg-surface-container-low border-2 border-on-surface shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-stack-lg md:p-12 relative overflow-hidden">
        <!-- Graphic Accents -->
        <div class="absolute -top-4 -right-4 w-12 h-12 bg-secondary-container border-2 border-on-surface rotate-12"></div>
        
        <div class="space-y-stack-lg">
            <header class="text-center space-y-unit">
                <h1 class="font-headline-lg text-headline-lg uppercase tracking-tight">Gabung Sekarang</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Buat akun untuk membuka akses eksklusif.</p>
            </header>
            
            <!-- Social Login -->
            <button type="button" class="w-full flex items-center justify-center gap-stack-sm bg-surface-container-lowest border-2 border-on-surface py-stack-md font-label-md text-label-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all active:translate-x-[4px] active:translate-y-[4px] active:shadow-none">
                <span class="material-symbols-outlined">account_circle</span>
                DAFTAR DENGAN GOOGLE
            </button>
            
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t-2 border-outline-variant"></div>
                <span class="flex-shrink mx-4 font-label-sm text-label-sm text-on-surface-variant">ATAU EMAIL</span>
                <div class="flex-grow border-t-2 border-outline-variant"></div>
            </div>
            
            <!-- Registration Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-stack-md">
                @csrf
                <div class="space-y-unit">
                    <label class="font-label-md text-label-md block">NAMA LENGKAP</label>
                    <input name="name" class="w-full border-2 border-on-surface bg-surface-bright px-stack-md py-stack-md font-body-md text-body-md focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all placeholder:text-outline-variant" placeholder="John Doe" type="text" required autofocus/>
                </div>
                <div class="space-y-unit">
                    <label class="font-label-md text-label-md block">ALAMAT EMAIL</label>
                    <input name="email" class="w-full border-2 border-on-surface bg-surface-bright px-stack-md py-stack-md font-body-md text-body-md focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all placeholder:text-outline-variant" placeholder="john@example.com" type="email" required/>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-md">
                    <div class="space-y-unit">
                        <label class="font-label-md text-label-md block">KATA SANDI</label>
                        <input name="password" class="w-full border-2 border-on-surface bg-surface-bright px-stack-md py-stack-md font-body-md text-body-md focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all placeholder:text-outline-variant" placeholder="••••••••" type="password" required/>
                    </div>
                    <div class="space-y-unit">
                        <label class="font-label-md text-label-md block">KONFIRMASI</label>
                        <input name="password_confirmation" class="w-full border-2 border-on-surface bg-surface-bright px-stack-md py-stack-md font-body-md text-body-md focus:outline-none focus:ring-0 focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all placeholder:text-outline-variant" placeholder="••••••••" type="password" required/>
                    </div>
                </div>
                <div class="pt-stack-md">
                    <button class="w-full bg-primary-container text-on-primary-container border-2 border-on-surface py-stack-lg font-headline-md text-headline-md shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all active:translate-x-[4px] active:translate-y-[4px] active:shadow-none uppercase" type="submit">
                        Daftar
                    </button>
                </div>
            </form>
            
            <footer class="text-center">
                <p class="font-body-md text-body-md">Sudah punya akun? <a class="font-label-md text-label-md text-primary underline" href="{{ route('login') }}">MASUK</a></p>
            </footer>
        </div>
    </div>
</main>
@endsection
