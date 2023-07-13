<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogsApiModel extends Model
{
    protected $table = "logs_api";

    protected $fillable = ['id', 'send_to', 'id_apps', 'url', 'method', 'payload', 'response'];

    public function categories(): BelongsTo 
    { 
        return $this->belongsTo(UserAuthApiModel::class); 
    } 

}
