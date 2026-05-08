<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLoanNotification extends Notification
{
    use Queueable;

    public $peminjaman;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;
        $this->message = "Peminjaman baru: " . $peminjaman->peminjam_nama . " meminjam buku " . ($peminjaman->buku->judul_buku ?? 'Tidak Diketahui');
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
            'id' => $this->peminjaman->id,
            'title' => 'Buku Dipinjam',
            'message' => $this->message,
            'url' => route('peminjamans.show', $this->peminjaman->id),
            'icon' => 'fas fa-hand-holding-heart',
            'color' => 'var(--primary)'
        ];
    }
}
