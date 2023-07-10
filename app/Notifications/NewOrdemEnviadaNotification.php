<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrdemEnviadaNotification extends Notification
{
    use Queueable;
    private $order;
    private $info;
    private $name;
    private $message;
    /**
     * Create a new notification instance.
     */
    public function __construct($order, $info)
    {
        $this->order = $order;
        $this->info = $info;

        if ($info->tipo == 'Normal') {
            $this->name = 'Nova Ordem';
            $this->message = 'Uma nova ordem de abastecimento foi recebida!';
        } else {
            $this->name = 'Ordem Extraordinária';
            $this->message = 'Uma nova ordem extraordinária de abastecimento foi recebida!';
        }

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
            'route' => 'abastecimento.show',
            'name' => $this->name,
            'msg' => $this->message,
            'params' => $this->order,
        ];
    }
}
