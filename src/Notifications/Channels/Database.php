<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use MshMsh\Notifications\Notification;

class Database extends Notification implements ShouldQueue
{
    use Queueable;

    public array $via = [
        'database',
    ];

    public function send(object $notifiable)
    {
        return $this->toDatabase($notifiable);
    }
    /**
     * Get the Sms representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return $notifiable->notifications()->create([
            'title' => $notifiable->title ?? app_setting('title'),
            'text' => $notifiable->message ?? '',
            'model_type' => $notifiable->data['model_type'] ?? '',
            'model_id' => $notifiable->data['model_id'] ?? '',
            'info' => $notifiable->data
        ]);
    }
}
