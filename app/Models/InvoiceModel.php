<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Model\Model;

class InvoiceModel extends Model
{
    
    public function save()
    {
        return $this->attributes;
    }
}
