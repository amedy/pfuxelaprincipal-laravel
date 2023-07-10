<?php

namespace App\Http\Controllers;

use App\Http\Services\MenusService;
use App\Http\Services\UtilizadorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            View::share('categorias', MenusService::sidebar()['categorias']);
            View::share('menus', MenusService::sidebar()['menus']);
            View::share('submenus', MenusService::sidebar()['submenus']);
            View::share('permissions', MenusService::permissions(request()->route()->getPrefix()));
            View::share('user', UtilizadorService::getCurrent());
            View::share('notifications', Auth::user()->unreadNotifications->take(5));
            View::share('nr_notifications', Auth::user()->unreadNotifications->count());

            return $next($request);
        });


    }
}
