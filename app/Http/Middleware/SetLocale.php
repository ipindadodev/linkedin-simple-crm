<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario está autenticado, establecer el idioma desde la base de datos
        if (Auth::check()) {
            App::setLocale(Auth::user()->language);
        } 
        // Si el idioma está almacenado en sesión, usarlo
        elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}