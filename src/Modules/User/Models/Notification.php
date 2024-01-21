<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "user_notifications";
    protected $fillable = ['user_id', 'title', 'text', 'info'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
