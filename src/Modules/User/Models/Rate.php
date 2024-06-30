<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'user_rates';
    protected $fillable = ['rate', 'text', 'order_id', 'user_id', 'rated_type', 'rated_id'];

    public function rated()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
