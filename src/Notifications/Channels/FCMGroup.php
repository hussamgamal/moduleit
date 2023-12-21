<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Support\Facades\Http;
use Modules\User\Models\Device;
use MshMsh\Notifications\Notification;

class FCMGroup extends FCM
{

    public array $users;

    public function users($users)
    {
        $this->users = $users;
        return $this;
    }

    public function send($notifiable)
    {
        $this->to($notifiable);
        
        $res = Http::withHeaders($this->headers())->post($this->url, $this->body($notifiable));
        return $res->body();
    }

    public function to($notifiable)
    {
        $this->registerationIds = Device::whereIn('user_id', $this->users)->pluck('device_token')->toArray();
        return $this;
    }
}
