<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const MEMBER = 'member';

    const SUPER_ADMIN_ID = 1;
  

    protected $fillable = [
        'name',
    ];
}
