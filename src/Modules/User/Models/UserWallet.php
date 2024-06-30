<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;

    protected $table = 'user_wallet';
    protected $fillable = [
        'user_id',
        'balance',
        'action',
        'orderable_type',
        'orderable_id',
        'type',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getActionAttribute($action)
    {
        return __($action, [
            'amount' => $this->balance,
            'order' => $this->orderable_id,
        ]);
    }

}
