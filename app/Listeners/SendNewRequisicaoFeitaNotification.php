<?php

namespace App\Listeners;

use App\Events\RequisicaoFeita;
use App\Models\User;
use App\Notifications\NewRequisicaoFeitaNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewRequisicaoFeitaNotification
{

    /**
     * Handle the event.
     */
    public function handle(RequisicaoFeita $event): void
    {
        $users = User::join('user_role', 'user_id', '=', 'user.id')->join('role', 'role_id', '=', 'role.id')->where('nome', 'Clientes')->select(['user.*'])->get();

        Notification::send($users, new NewRequisicaoFeitaNotification($event->params));
    }
}
