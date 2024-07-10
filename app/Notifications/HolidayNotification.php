<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HolidayNotification extends Notification
{
    use Queueable;

    public $holiday;

    public function __construct($holiday)
    {
        // dd($holiday);
        $this->holiday = $holiday;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail']; // You can use any other channel like database, SMS, etc.
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Holiday Notification')
            ->line('A new holiday has been added:')
            ->line('Date: ' . $this->holiday->date)
            ->line('Title: ' . $this->holiday->title)
            ->line('Description: ' . $this->holiday->description);
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
