<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class NewBombasWarningNotification extends Notification
{
    use Queueable;
    private $bombas;
    /**
     * Create a new notification instance.
     */
    public function __construct($bombas)
    {
        $this->bombas = $bombas;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'route' => 'bombas.list',
            'name' => 'Combustível baixo',
            'msg' => 'As bombas ' . $this->bombas->nome . ' estão com o estoque de combustível baixo!',
            'params' => Crypt::encrypt($this->bombas->id),
        ];
    }
}
