<?php

namespace App\Listeners;

use App\Events\OrdemEnviada;
use App\Models\User;
use App\Notifications\NewOrdemEnviadaNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SendNewOrdemEnviadaNotification
{

    /**
     * Handle the event.
     */
    public function handle(OrdemEnviada $event): void
    {
        $users = User::join('user_role', 'user_id', '=', 'user.id')->join('role', 'role_id', '=', 'role.id')->where('nome', 'HST')->select(['user.*'])->get();

        $info = DB::table('ordem')->where('id', Crypt::decrypt($event->order))->first();
        Notification::send($users, new NewOrdemEnviadaNotification($event->order, $info));
    }
}
