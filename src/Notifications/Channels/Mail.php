<?php

namespace MshMsh\Notifications\Channels;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use MshMsh\Notifications\Notification;

class Mail extends Notification implements ShouldQueue
{
    use Queueable;

    public array $via = [
        'mail'
    ];

    public function send(object $notifiable)
    {
        return $this->toMail($notifiable);
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $data = $this->toArray($notifiable);
        return (new MailMessage)
            ->greeting(__('Hello') . ' , ' . $notifiable->name)
            ->subject($data['title'])
            ->line($data['message']);
    }
}
