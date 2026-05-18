<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizer = User::where('role', 'organizer')->first();

        if (!$organizer) {
            return;
        }

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Laravel Developer Meetup 2026',
            'description' => 'A great meetup for Laravel developers to share knowledge and network. Join us for talks on the latest features in Laravel 12.',
            'date' => Carbon::now()->addDays(10)->setHour(14)->setMinute(0),
            'location' => 'Tech Hub Jakarta',
            'price' => 150000,
            'quota' => 100,
            'image' => null,
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Open Source Contribution Workshop',
            'description' => 'Learn how to contribute to open source projects. Free for everyone!',
            'date' => Carbon::now()->addDays(15)->setHour(10)->setMinute(0),
            'location' => 'Online (Zoom)',
            'price' => 0,
            'quota' => 500,
            'image' => null,
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Music Festival: Summer Vibes',
            'description' => 'Enjoy the best summer vibes with top local bands.',
            'date' => Carbon::now()->addDays(30)->setHour(18)->setMinute(0),
            'location' => 'Gelora Bung Karno Stadium',
            'price' => 350000,
            'quota' => 5000,
            'image' => null,
        ]);
    }
}
