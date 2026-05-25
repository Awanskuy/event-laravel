<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Owner (organizer) or an admin may update the event.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->isAdmin();
    }

    /**
     * Owner (organizer) or an admin may delete the event.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->isAdmin();
    }
}
