<?php

namespace App\Events;

use App\Models\InvoiceModel;

class InvoiceEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $invoice;

    public function __construct(InvoiceModel $invoice)
    {
        $this->invoice = $invoice;
    }
}
