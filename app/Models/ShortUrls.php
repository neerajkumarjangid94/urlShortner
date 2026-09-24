<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrls extends Model
{
    protected $table = 'short_urls';
    protected $fillable = [
        'company_id',
        'user_id',
        'original_url',
        'short_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
