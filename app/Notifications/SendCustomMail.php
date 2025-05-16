<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendCustomMail extends Notification
{
    use Queueable;

    public $details;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $details)
    {
        $this->details = $details; // subject, greeting, content gibi alanları burada alıyoruz
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->details['subject'])
            ->view('emails.mailTemplate', [
                'subject' => $this->details['subject'],
                'greeting' => $this->details['greeting'],
                'content' => $this->details['content'],
                'logo' => $this->details['logo'] ?? null,
                'buttonText' => $this->details['buttonText'] ?? null,
                'buttonUrl' => $this->details['buttonUrl'] ?? null,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
