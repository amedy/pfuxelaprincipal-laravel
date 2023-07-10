<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NotificationController extends HomeController
{
    public function index()
    {
        return view('notification.index', [
            'notificacoes' => Auth()->user()->unreadNotifications,
        ]);
    }
    
    public function markRead($id)
    {
        $notification = Auth()->user()->notifications->find(Crypt::decrypt($id));
        $notification->markAsRead();

        session()->flash('title', 'Notificação');
        return back()->with('success-message', 'Marcada como lida!');
    }
    
    public function markAllRead()
    {
        Auth()->user()->unreadNotifications->markAsRead();

        return back();
    }

}
