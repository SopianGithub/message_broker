<?php

namespace App\Events;

use App\Models\InvoiceModel;
use Illuminate\Broadcasting\InteractsWithSockets;

class PusherLogsEvent extends Event
{

    use InteractsWithSockets;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public InvoiceModel $message;

    public function __construct(InvoiceModel $payloads)
    {
        $this->message = $payloads;
    }

}
