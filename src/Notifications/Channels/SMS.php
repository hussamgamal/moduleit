<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use MshMsh\Notifications\Notification;

class SMS extends Notification implements ShouldQueue
{
    use Queueable;

    public array $via = [
        'sms'
    ];

    public function send(object $notifiable)
    {
        return $this->toSms($notifiable);
    }
    /**
     * Get the Sms representation of the notification.
     */
    public function toSms(object $notifiable)
    {
        return send_sms($notifiable->mobile, $notifiable->message);
    }
}
