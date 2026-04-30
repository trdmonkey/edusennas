<?php

namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{
    use HasRoles;

    // pal rol del admin al guardar
    protected $guard_name = 'admin';

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

