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

        // 2 Music events
        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Music Festival: Summer Vibes',
            'description' => 'Enjoy the best summer vibes with top local bands, food stalls, and an interactive light show.',
            'date' => Carbon::now()->addDays(30)->setHour(18)->setMinute(0),
            'location' => 'Gelora Bung Karno Stadium',
            'price' => 350000,
            'quota' => 5000,
            'image' => null,
            'category' => 'music',
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Jazz Under The Stars',
            'description' => 'An intimate evening of live jazz performance by renowned national and international jazz acts.',
            'date' => Carbon::now()->addDays(40)->setHour(19)->setMinute(30),
            'location' => 'Jakarta Jazz Lounge',
            'price' => 150000,
            'quota' => 150,
            'image' => null,
            'category' => 'music',
        ]);

        // 2 Tech events
        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Laravel Developer Meetup 2026',
            'description' => 'A great meetup for Laravel developers to share knowledge and network. Join us for talks on the latest features in Laravel 12.',
            'date' => Carbon::now()->addDays(10)->setHour(14)->setMinute(0),
            'location' => 'Tech Hub Jakarta',
            'price' => 150000,
            'quota' => 100,
            'image' => null,
            'category' => 'tech',
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Open Source Contribution Workshop',
            'description' => 'Learn how to contribute to open source projects, set up your first pull request, and work with git successfully. Free for everyone!',
            'date' => Carbon::now()->addDays(15)->setHour(10)->setMinute(0),
            'location' => 'Online (Zoom)',
            'price' => 0,
            'quota' => 500,
            'image' => null,
            'category' => 'tech',
        ]);

        // 2 Art events
        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Modern Art Exhibition: Reimagined',
            'description' => 'An annual contemporary art exhibition displaying paintings, digital art installations, and sculptures from rising artists.',
            'date' => Carbon::now()->addDays(20)->setHour(10)->setMinute(0),
            'location' => 'National Gallery of Indonesia',
            'price' => 50000,
            'quota' => 200,
            'image' => null,
            'category' => 'art',
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Clay Sculpting Workshop',
            'description' => 'Hands-on clay sculpting class for beginners. Get guided instruction and take home your own clay creation!',
            'date' => Carbon::now()->addDays(25)->setHour(13)->setMinute(0),
            'location' => 'Creative Studio Bandung',
            'price' => 120000,
            'quota' => 30,
            'image' => null,
            'category' => 'art',
        ]);

        // 2 Food events
        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Taste of Nusantara Culinary Festival',
            'description' => 'Explore the rich culinary heritage of Indonesia. Features over 50 local food booths, cooking demos, and eating contests.',
            'date' => Carbon::now()->addDays(8)->setHour(11)->setMinute(0),
            'location' => 'Monas Park',
            'price' => 25000,
            'quota' => 2000,
            'image' => null,
            'category' => 'food',
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'title' => 'Fine Dining Masterclass',
            'description' => 'An exclusive cooking masterclass taught by Michelin-starred chefs. Learn to plate and prepare 3 signature dishes.',
            'date' => Carbon::now()->addDays(45)->setHour(17)->setMinute(0),
            'location' => 'Five-Star Culinary Academy',
            'price' => 750000,
            'quota' => 15,
            'image' => null,
            'category' => 'food',
        ]);
    }
}
