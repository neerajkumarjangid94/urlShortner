<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER_ADMIN = 'super_admin';
    const SUPER_ADMIN_ID = 1; // Replace with the actual ID of the super admin role

    protected $fillable = [
        'name',
    ];
}
