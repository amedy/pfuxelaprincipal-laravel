<?php

namespace App\Listeners;

use App\Events\CarFilled;
use App\Models\User;
use App\Notifications\NewBombasWarningNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewBombasWarningNotification
{

    /**
     * Handle the event.
     */
    public function handle(CarFilled $event): void
    {
        $users = User::join('user_role', 'user_id', '=', 'user.id')->join('role', 'role_id', '=', 'role.id')->where('nome', 'Administradores')->select(['user.*'])->get();

        Notification::send($users, new NewBombasWarningNotification($event->bombas));
    }
}
