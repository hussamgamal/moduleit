<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationAction extends Model
{
    protected $fillable = [
        'user_id',
        'notification_id',
        'type',
    ];
}
