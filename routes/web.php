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

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Landing Page (Neubrutalist UI)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Event Detail
// Constrain {event} to digits so it doesn't shadow /events/create
// (the resource route) which is registered later in the auth group.
Route::get('/events/{event}', [EventController::class, 'show'])
    ->whereNumber('event')
    ->name('events.show.public');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | USER TICKETS
    |--------------------------------------------------------------------------
    */

    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');

    Route::post('/events/{event}/book', [TicketController::class, 'store'])
        ->name('tickets.store');

    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
        ->name('tickets.show');


    /*
    |--------------------------------------------------------------------------
    | PAYMENT SIMULATION
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout/{transaction}', [TransactionController::class, 'checkout'])
        ->name('checkout');

    Route::post('/transactions/{transaction}/pay',
        [TransactionController::class, 'pay']
    )->name('transactions.pay');


    /*
    |--------------------------------------------------------------------------
    | ORGANIZER ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:organizer')->group(function () {

        // Organizer Dashboard (My Events)
        Route::get('/organizer/events',
            [EventController::class, 'manage']
        )->name('events.manage');

        // CRUD Event Organizer
        Route::resource('events', EventController::class)
            ->except(['index', 'show']);
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard',
                [DashboardController::class, 'index']
            )->name('dashboard');

            Route::get('/users',
                [UserController::class, 'index']
            )->name('users.index');

            Route::get('/tickets/validate',
                [TicketValidationController::class, 'index']
            )->name('tickets.validate');

            Route::post('/tickets/validate',
                [TicketValidationController::class, 'validateTicket']
            )->name('tickets.validate.post');
        });
});