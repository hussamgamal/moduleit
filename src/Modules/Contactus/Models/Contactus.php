<?php

namespace Modules\Contactus\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $table = 'contactus';
    protected $fillable = [
        'type',
        'name',
        'mobile',
        'message',
        'seen'
    ];

    public function scopeUnseen($query)
    {
        return $query->where('seen', null);
    }
    public function getCreatedAtAttribute($created_at)
    {
        return date('Y-m-d', strtotime($created_at));
    }
}
