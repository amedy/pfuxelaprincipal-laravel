<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function create()
    {
        return view('authentication.login');
    }


    public function authenticate(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->senha,
            'active' => 1,
        ];

        $remember = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            session()->flash('title', 'Sessão Iniciada');
            return to_route('dashboard')->with('normal-message', 'Bem Vindo de volta ' . Auth()->user()->name . '!');
        }

        return back()->withErrors(['email' => 'Credenciais Inválidas!'])->onlyInput('email');
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flush();

        return redirect('/');
    }
}
