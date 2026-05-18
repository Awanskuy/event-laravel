@extends('layouts.app')

@section('content')
<!-- Main Content Canvas -->
<main class="flex-grow flex items-center justify-center p-margin-mobile md:p-margin-desktop relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute top-10 left-10 w-32 h-32 border-2 border-on-surface-variant opacity-10 rotate-12 -z-10"></div>
    <div class="absolute bottom-20 right-10 w-64 h-64 border-2 border-on-surface-variant opacity-10 -rotate-6 -z-10"></div>
    
    <!-- Centralized Login Card -->
    <div class="w-full max-w-[480px] bg-background border-2 border-on-surface shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col">
        <!-- Card Header -->
        <div class="p-stack-lg border-b-2 border-on-surface bg-primary-container">
            <h1 class="font-headline-md text-headline-md text-on-primary-container">Welcome Back</h1>
            <p class="font-body-md text-body-md text-on-primary-container opacity-80 mt-1">Access your tickets and events.</p>
        </div>
        
        <!-- Login Form -->
        <form class="p-stack-lg flex flex-col gap-stack-md" action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Email Field -->
            <div class="flex flex-col gap-unit">
                <label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="email">Email Address</label>
                <div class="relative group">
                    <input name="email" class="w-full px-4 py-3 bg-surface-container-lowest border-2 border-on-surface font-body-md focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all duration-100 placeholder:text-outline" id="email" placeholder="name@example.com" type="email" required autofocus/>
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" data-icon="mail">mail</span>
                </div>
            </div>
            
            <!-- Password Field -->
            <div class="flex flex-col gap-unit">
                <div class="flex justify-between items-end">
                    <label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="password">Password</label>
                    <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary underline mb-1" href="#">Forgot Password?</a>
                </div>
                <div class="relative group">
                    <input name="password" class="w-full px-4 py-3 bg-surface-container-lowest border-2 border-on-surface font-body-md focus:outline-none focus:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all duration-100 placeholder:text-outline" id="password" placeholder="••••••••" type="password" required/>
                    <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant cursor-pointer" data-icon="visibility">visibility</span>
                </div>
            </div>
            
            <!-- Remember Me Checkbox -->
            <div class="flex items-center gap-2 mt-2">
                <input name="remember" class="w-5 h-5 border-2 border-on-surface bg-surface-container-lowest rounded-none text-primary focus:ring-0 focus:ring-offset-0 checked:bg-primary" id="remember" type="checkbox"/>
                <label class="font-body-md text-body-md cursor-pointer select-none" for="remember">Stay signed in for 30 days</label>
            </div>
            
            <!-- Sign In Button -->
            <button class="w-full mt-stack-md bg-primary text-on-primary py-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-headline-md text-headline-md hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none active:translate-x-[4px] active:translate-y-[4px] active:shadow-none transition-all duration-100 flex justify-center items-center gap-2" type="submit">
                <span>Sign In</span>
                <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
            </button>
            
            <!-- Social Sign In Divider -->
            <div class="flex items-center gap-stack-sm my-stack-sm">
                <div class="h-[2px] flex-grow bg-on-surface opacity-10"></div>
                <span class="font-label-sm text-label-sm text-on-surface-variant">OR CONTINUE WITH</span>
                <div class="h-[2px] flex-grow bg-on-surface opacity-10"></div>
            </div>
            
            <!-- Social Buttons -->
            <div class="grid grid-cols-2 gap-stack-sm">
                <button type="button" class="flex items-center justify-center gap-2 py-3 bg-surface-container-lowest border-2 border-on-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all">
                    <span class="material-symbols-outlined" data-icon="google">google</span>
                    <span class="font-label-md text-label-md">Google</span>
                </button>
                <button type="button" class="flex items-center justify-center gap-2 py-3 bg-surface-container-lowest border-2 border-on-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-none transition-all">
                    <span class="material-symbols-outlined" data-icon="apple">ios</span>
                    <span class="font-label-md text-label-md">Apple</span>
                </button>
            </div>
        </form>
        
        <!-- Card Footer -->
        <div class="p-stack-md border-t-2 border-on-surface bg-surface-container-low text-center">
            <p class="font-body-md text-body-md">
                New to the club? 
                <a class="font-label-md text-label-md text-secondary underline hover:text-on-secondary-container transition-colors" href="{{ route('register') }}">Create an Account</a>
            </p>
        </div>
    </div>
    
    <!-- Asymmetric Decorative Card (Floating) -->
    <div class="hidden lg:block absolute left-[15%] top-[20%] -rotate-6 w-[200px] bg-secondary-container border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-stack-sm -z-10">
        <img class="w-full h-24 object-cover border-b-2 border-on-surface mb-2" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDOvqNyIs75dQIS12TLPXueKHjJG2ijSH4akHq2gtZVJ-nwYG3UNNqlhM_NSE6Ki0zS5kpy7Xx1ZUkgfRoF-GpiXOppr5KPp1z5h3CXp6g-33mTlHF-4bq5xVxlHXoPMg0Uoz7hiSYkg3-n5CdGnoiLZVJKo1DLyzLjUW143jan_jDdWbFZVAyIDyADIzQ53kRFc6eI1UxCr6A1IAF2g6-DHuxill13H3akdKEvinvvaJ4iFMfJNEhNCkIBbFyLjzGSkB7I4TXH20"/>
        <span class="font-label-sm text-label-sm text-on-secondary-container font-bold uppercase">Next Up: Techno Night</span>
    </div>
    <div class="hidden lg:block absolute right-[12%] bottom-[15%] rotate-12 w-[180px] bg-tertiary-fixed border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-stack-sm -z-10">
        <div class="h-24 bg-tertiary-container border-b-2 border-on-surface flex items-center justify-center">
            <span class="material-symbols-outlined text-4xl text-on-tertiary-container" data-icon="confirmation_number">confirmation_number</span>
        </div>
        <span class="font-label-sm text-label-sm text-on-tertiary-fixed-variant font-bold uppercase block mt-2 text-center">Member ID: #BXB-2024</span>
    </div>
</main>
@endsection
