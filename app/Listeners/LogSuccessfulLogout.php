<?php

namespace App\Listeners;

use App\Models\Activity;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    public function __construct()
    {
        //
    }

    public function handle(Logout $event)
    {
        if ($event->user) {
            Activity::create([
                'type' => 'activity',
                'message' => 'User logged out: ' . $event->user->username,
            ]);
        }
    }
}

