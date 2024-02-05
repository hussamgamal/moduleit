<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserStop extends Model
{
    protected $table = 'user_stop_archive';
    protected $fillable = ['user_id', 'stopped_at', 'activated_at', 'admin_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}