<?php

namespace App\Http\Middleware;

use App\Http\Services\MenusService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class MenuAcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Arr::has(MenusService::access(), Request()->route()->getName()) && Request()->route()->getName() != 'dashboard') {
            return to_route('dashboard');
        }
        return $next($request);
    }
}
