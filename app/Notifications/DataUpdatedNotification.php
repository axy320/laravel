<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DataUpdatedNotification extends Notification
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
            'title' => $this->data['title'] ?? 'Data Diperbarui',
            'message' => $this->data['message'] ?? 'Perubahan data telah disimpan.',
            'url' => $this->data['url'] ?? '#',
            'icon' => $this->data['icon'] ?? 'fas fa-edit',
            'color' => $this->data['color'] ?? 'var(--secondary)'
        ];
    }
}
