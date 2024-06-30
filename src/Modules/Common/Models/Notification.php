<?php

namespace Modules\Common\Models;

use Illuminate\Notifications\DatabaseNotification;

class  Notification extends DatabaseNotification
{
    public function notificationActions()
    {
        return $this->hasMany(NotificationAction::class,'notification_id');
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            if($this->notifiable_id > 0){
                $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
            }else{
                $exist = NotificationAction::where('user_id',auth()->id())->exists();
                if(!$exist){
                    NotificationAction::create([
                        'user_id' => auth()->id(),
                        'notification_id' => $this->id,
                    ]);
                }
            }
        }
    }
}
