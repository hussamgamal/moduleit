<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';
    protected $fillable = ['title', 'content', 'user_id'];
    protected $with = ['user'];
    protected $casts =
        [
            'title' => 'array',
            'content' => 'array',

        ];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
