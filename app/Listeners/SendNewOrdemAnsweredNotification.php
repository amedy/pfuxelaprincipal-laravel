<?php

namespace App\Listeners;

use App\Events\OrdemAnswered;
use App\Models\User;
use App\Notifications\NewOrdemAnsweredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SendNewOrdemAnsweredNotification
{

    /**
     * Handle the event.
     */
    public function handle(OrdemAnswered $event): void
    {
        $users = User::join('user_role', 'user_id', '=', 'user.id')->join('role', 'role_id', '=', 'role.id')->where('nome', 'HST')->select(['user.*'])->get();
        $code = DB::table('ordem')->whereNull('deleted_at')->where('id', Crypt::decrypt($event->order))->first()->codigo;

        Notification::send($users, new NewOrdemAnsweredNotification($event->order, $event->answer, $code));
    }
}
