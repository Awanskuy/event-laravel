<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketBookingTest extends TestCase
{
    use RefreshDatabase;

    private function createEvent(array $overrides = []): Event
    {
        $organizer = User::factory()->create(['role' => 'organizer']);

        return Event::create(array_merge([
            'user_id' => $organizer->id,
            'title' => 'Test Event',
            'description' => 'A test event description.',
            'date' => now()->addDays(10),
            'location' => 'Test Venue',
            'price' => 100000,
            'quota' => 100,
            'category' => 'music',
        ], $overrides));
    }

    public function test_guest_cannot_book_and_is_redirected_to_login(): void
    {
        $event = $this->createEvent();

        $this->post(route('tickets.store', $event))
            ->assertRedirect(route('login'));

        $this->assertDatabaseCount('tickets', 0);
    }

    public function test_booking_a_paid_event_creates_pending_ticket_and_redirects_to_checkout(): void
    {
        $user = User::factory()->create();
        $event = $this->createEvent(['price' => 150000]);

        $response = $this->actingAs($user)->post(route('tickets.store', $event));

        $ticket = Ticket::first();
        $this->assertNotNull($ticket);
        $this->assertSame('pending', $ticket->status);
        $this->assertSame('pending', $ticket->transaction->payment_status);
        $response->assertRedirect(route('checkout', $ticket->transaction));
    }

    public function test_booking_a_free_event_activates_ticket_immediately(): void
    {
        $user = User::factory()->create();
        $event = $this->createEvent(['price' => 0]);

        $response = $this->actingAs($user)->post(route('tickets.store', $event));

        $ticket = Ticket::first();
        $this->assertSame('active', $ticket->status);
        $this->assertSame('paid', $ticket->transaction->payment_status);
        $response->assertRedirect(route('tickets.show', $ticket));
    }

    public function test_user_cannot_book_the_same_event_twice(): void
    {
        $user = User::factory()->create();
        $event = $this->createEvent();

        $this->actingAs($user)->post(route('tickets.store', $event));
        $this->actingAs($user)->post(route('tickets.store', $event))
            ->assertSessionHas('error');

        $this->assertSame(1, Ticket::where('user_id', $user->id)->count());
    }

    public function test_a_sold_out_event_cannot_be_booked(): void
    {
        $first = User::factory()->create();
        $second = User::factory()->create();
        $event = $this->createEvent(['quota' => 1, 'price' => 0]);

        $this->actingAs($first)->post(route('tickets.store', $event));
        $this->actingAs($second)->post(route('tickets.store', $event))
            ->assertSessionHas('error');

        $this->assertSame(1, Ticket::count());
    }

    public function test_only_the_ticket_owner_or_admin_can_view_a_ticket(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $admin = User::factory()->create(['role' => 'admin']);
        $event = $this->createEvent(['price' => 0]);

        $this->actingAs($owner)->post(route('tickets.store', $event));
        $ticket = Ticket::first();

        $this->actingAs($owner)->get(route('tickets.show', $ticket))->assertOk();
        $this->actingAs($admin)->get(route('tickets.show', $ticket))->assertOk();
        $this->actingAs($other)->get(route('tickets.show', $ticket))->assertForbidden();
    }
}
