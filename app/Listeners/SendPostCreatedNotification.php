<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Support\Facades\Mail;

class SendPostCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::fake()->to($event->post->owner->email)->send(
            new \App\Mail\PostCreated($event->post)
        );
    }
}
