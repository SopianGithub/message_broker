<?php

namespace App\Listeners;

use App\Models\InvoiceModel;
use App\Events\InvoiceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceEvent  $event
     * @return void
     */
    public function handle(InvoiceEvent $event)
    {
        return $event;
    }
}
