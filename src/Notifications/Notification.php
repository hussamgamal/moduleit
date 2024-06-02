<?php

namespace MshMsh\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as NotificationClass;
use MshMsh\Notifications\Channels\Database;
use MshMsh\Notifications\Channels\FCM;
use MshMsh\Notifications\Channels\Mail;
use MshMsh\Notifications\Channels\SMS;

class Notification extends NotificationClass
{
    use Queueable;

    public array $via = [
        'mail',
        'sms',
        'fcm',
        'database'
    ];

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $message = '',
        public array $data = [],
        public string $title = "",
        $via = null,
        public bool $saveToDB = false
    ) {
        //
        $this->title = $title ?? app_setting('title');
        $this->via = $via ?? $this->via;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $notifiable->title = $this->title;
        $notifiable->message = $this->message;
        $notifiable->data = $this->data;

        $channels = [
            'mail' => Mail::class,
            'fcm' => FCM::class,
            'sms' => SMS::class,
            'database' => Database::class
        ];
        $through = [];
        foreach ($this->via as $via) {
            $through[] = $channels[$via];
        }
        // dd($through);
        return $through;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => __($notifiable->title),
            'message' => __($notifiable->message, $this->data ?? []),
        ];
    }
}
