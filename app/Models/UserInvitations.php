<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvitations extends Model
{
    protected $table = 'invitations';
    protected $fillable = [
        'company_id',
        'email',
        'role_id',
        'invited_by',
        'token',
        'accepted_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
