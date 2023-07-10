<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrdemAnsweredNotification extends Notification
{
    use Queueable;
    private $order;
    private $answer;
    private $code;
    /**
     * Create a new notification instance.
     */
    public function __construct($order, $answer, $code)
    {
        $this->order = $order;
        $this->answer = $answer;
        $this->code = $code;
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
            'name' => 'Ordem ' . $this->answer,
            'msg' => 'A ordem #' . $this->code . ' de abastecimento foi ' . $this->answer . '!',
            'params' => $this->order,
        ];
    }
}
