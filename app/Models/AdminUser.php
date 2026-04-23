<?php

namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'activated',
        'forbidden',
        'language',
    ];
}

