<?php

namespace App\Listeners;

use App\Events\PiqueteStado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class estado  
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PiqueteStado $event): void
    {
        //
    }
}
