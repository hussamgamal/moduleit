<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'special_marque',
        'location'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['location' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
