<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'otp',
        'status',
        'expired_at',
    ];
    protected $casts = [
        'status' => 'boolean',
        'expired_at' => 'datetime:Y-m-d h:i a',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCheckOtp($value)
    {
        return $value->where('expired_at','>',Carbon::now())->where('status',false);
    }
}
