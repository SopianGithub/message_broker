<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthApiModel extends Model
{
    protected $table = "users_auth_api";

    protected $fillable = ['id', 'apps_name', 'type_auth', 'credentials'];
}
