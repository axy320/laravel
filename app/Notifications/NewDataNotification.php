<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDataNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->data['id'] ?? null,
            'title' => $this->data['title'] ?? 'Data Baru',
            'message' => $this->data['message'] ?? 'Ada data baru yang ditambahkan.',
            'url' => $this->data['url'] ?? '#',
            'icon' => $this->data['icon'] ?? 'fas fa-plus-circle',
            'color' => $this->data['color'] ?? 'var(--primary)'
        ];
    }
}

