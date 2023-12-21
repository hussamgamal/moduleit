<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Support\Facades\Http;
use Modules\User\Models\Device;
use MshMsh\Notifications\Notification;

class FCM extends Notification
{
    public array $via = [
        'fcm',
        'database'
    ];

    public string $url = "https://fcm.googleapis.com/fcm/send";
    public string $serverKey = "";
    public array $users = [];
    public array $registerationIds;
    public string $message;
    public string $title;
    public array $data;
    public string $type = 'global';


    public function send($notifiable)
    {
        $this->to($notifiable);

        $res = Http::withHeaders($this->headers())->post($this->url, $this->body($notifiable));
        return $res->body();
    }

    public function headers()
    {
        $this->serverKey = env('FCM_TOKEN');
        return [
            'Authorization' => 'key=' . $this->serverKey,
            'Content-Type' => 'application/json'
        ];
    }



    public function topicSend($topic = '')
    {
        $res = Http::withHeaders($this->headers())->post($this->url, $this->body($topic));
        return $res->body();
    }

    public function to($notifiable)
    {
        $this->registerationIds = $notifiable->device()->pluck('device_token')->toArray();
        return $this;
    }

    public function toUsers($users)
    {
        $this->users = $users;
    }


    public function body($notifiable, $topic = null)
    {
        $data = $this->toArray($notifiable);
        $notification = array(
            ...$data,
            'model_type' => $data['data']['model_type'] ?? null,
            'model' => $data['data']['model_id'] ?? null,
            'sound' => 'default',
            'badge' => '1',
        );
        $data = [
            'notification' => $notification,
            'data' => $notification,
            'priority' => 'high',
        ];
        if ($topic) {
            $data['to'] = "/topics/{$topic}";
        } else {
            $data['registration_ids'] = $this->registerationIds;
        }
        return $data;
    }
}
