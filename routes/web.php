<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TicketValidationController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show.public');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User / Ticket Bookings routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/events/{event}/book', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Simulate Payment
    Route::post('/transactions/{transaction}/pay', [TransactionController::class, 'pay'])->name('transactions.pay');

    // Organizer routes
    Route::middleware('role:organizer')->group(function () {
        Route::resource('events', EventController::class)->except(['show']);
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/tickets/validate', [TicketValidationController::class, 'index'])->name('tickets.validate');
        Route::post('/tickets/validate', [TicketValidationController::class, 'validateTicket'])->name('tickets.validate.post');
    });
});
