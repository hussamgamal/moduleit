<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as MessagingNotification;
use Modules\User\Models\Device;
use MshMsh\Notifications\Notification;

class FCM extends Notification
{
    public array $via = [
        'fcm'
    ];

    public array $registerationIds;
    public string $message;
    public string $title;
    public array $data;
    public string $type = 'global';


    public function __construct(public Messaging $messaging)
    {
    }
    public function send($notifiable)
    {
        $this->to($notifiable);
        if (count($this->registerationIds)) {
            $body = $this->toArray($notifiable);
            $notification = MessagingNotification::create($body['title'], $body['message']);

            $message = CloudMessage::new()->withNotification($notification)
                ->withData($this->body($notifiable));

            $res = $this->messaging->sendMulticast($message, $this->registerationIds);

            return [
                'Successful sends' => $res->successes()->count() . PHP_EOL,
                'Failed sends' => $res->failures()->count() . PHP_EOL
            ];
        }
        return [];
    }

    public function to($notifiable)
    {
        $this->registerationIds = $notifiable->device()->pluck('device_token')->toArray();
        return $this;
    }

    public function body($notifiable)
    {
        $data = $this->toArray($notifiable);
        $notification = array(
            ...$data,
            'model_type' => $data['data']['model_type'] ?? null,
            'model' => $data['data']['model_id'] ?? null,
            'sound' => 'default',
            'badge' => '1',
        );
        return $notification;
    }
}
