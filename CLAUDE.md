# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

**KARCIS** is a Laravel 12 event-ticketing platform with a neubrutalist UI. Users browse events, book tickets (which generate a QR code), and pay through a simulated checkout. Organizers create/manage their own events; admins validate tickets at the gate by scanning QR codes.

## Commands

```bash
composer dev      # Run everything at once: php serve + queue listener + pail logs + vite (concurrently)
composer test     # Clears config, then runs `php artisan test` (PHPUnit)
composer setup    # First-time setup: install, .env, key:generate, migrate, npm install, npm build
npm run dev       # Vite dev server only
npm run build     # Production asset build

php artisan migrate:fresh --seed   # Reset DB and seed users + events
php artisan test --filter=SomeTest # Run a single test
./vendor/bin/pint                  # Lint/format (Laravel Pint)
```

Database defaults to **SQLite** (`database/database.sqlite`). Tests run against an in-memory SQLite DB (see `phpunit.xml`).

### Seeded login credentials (all password: `password`)
- `admin@admin.com` — admin
- `organizer@organizer.com` — organizer
- `user@user.com` / `jane@user.com` — regular users

## Architecture

### Roles & authorization
Three roles live in a single `users.role` column (`admin` | `organizer` | `user`), with helper methods `isAdmin()` / `isOrganizer()` / `isUser()` on the `User` model. Route protection uses the custom `role` middleware (`App\Http\Middleware\RoleMiddleware`, aliased in `bootstrap/app.php`), applied as `role:organizer` / `role:admin`. It enforces an **exact role match** — admins do **not** automatically pass `role:organizer` checks. Per-resource ownership is enforced by **policies** (`EventPolicy`, `TicketPolicy`, auto-discovered) via `$this->authorize(...)` in controllers (the base `Controller` uses the `AuthorizesRequests` trait). Event create/update validation lives in `StoreEventRequest` / `UpdateEventRequest`.

Login redirects by role: admin → `/admin/dashboard`, organizer → `/events`, user → `/`.

### Domain model & the booking flow
The core chain is **Event → Ticket → Transaction** (Ticket `hasOne` Transaction). The booking lifecycle lives in `TicketController::store` and is the most important logic to understand:

1. Rejects if event is sold out (`tickets count >= quota`) or the user already booked this event.
2. Creates a `Ticket` with `qr_code` = a random UUID and `status = 'pending'`.
3. Creates the linked `Transaction`. **Free events** (`price == 0`) are marked `paid` immediately and the ticket flips to `active`; **paid events** stay `pending` and redirect to `/checkout/{transaction}`.
4. `TransactionController::pay` is a **simulated payment** — it just marks the transaction `paid` and the ticket `active`. There is no real payment gateway.

**Ticket statuses:** `pending` → `active` → `used`. Admins move `active` → `used` via `TicketValidationController` by matching the scanned `qr_code` (rejecting `used` and `pending` tickets).

### Routing layers (`routes/web.php`)
Public (home, event detail) → `auth` group (booking, tickets, checkout) → nested `role:organizer` (event CRUD via `Route::resource` minus index/show) → `role:admin` group prefixed `admin.` (dashboard, user list, ticket validation).

### Views & styling — important gotcha
Blade views under `resources/views/`, split across two layouts: `layouts/app.blade.php` (public/user) and `layouts/admin.blade.php` (admin panel).

Both layouts load **two** styling systems simultaneously: `@vite(['resources/css/app.css'])` (Tailwind v4) **and** the Tailwind **CDN** (`cdn.tailwindcss.com`) with an inline `tailwind.config`. The custom neubrutalist color tokens (`primary`, `secondary`, `tertiary`, `surface-*`, etc.) are defined in that **inline CDN config**, not in `app.css` — so most utility classes in templates resolve against the CDN config. When adding theme colors, update the inline config in the relevant layout.

QR codes are rendered in Blade with `simplesoftwareio/simple-qrcode`:
`{!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(140)->generate($ticket->qr_code) !!}`.

### Event images
Uploaded to the `public` disk under `events/`. Requires `php artisan storage:link`. `EventController` deletes the old file on update/destroy.

## Notes
- Feature tests run on in-memory SQLite (`phpunit.xml`), so `php artisan test` works even when the MySQL dev DB is down. `TicketBookingTest` covers the booking flow, sold-out/duplicate guards, and ticket-view authorization.
- A pending migration `add_category_to_events_table` adds the `category` column used by the homepage/event filtering.
