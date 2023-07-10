<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequisicaoFeitaNotification extends Notification
{
    use Queueable;
    private $params;
    /**
     * Create a new notification instance.
     */
    public function __construct($params)
    {
        $this->params = $params;
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
            'route' => 'requisicao.show',
            'name' => 'Nova Requisição',
            'msg' => 'Uma nova requisição foi recebida!',
            'params' => $this->params,
        ];
    }
}
