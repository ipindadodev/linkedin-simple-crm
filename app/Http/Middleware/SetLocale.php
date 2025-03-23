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
        // Si el idioma está en sesión, se prioriza
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        // Si el usuario está autenticado y no hay idioma en sesión, se usa el de BD
        elseif (Auth::check() && Auth::user()->language) {
            App::setLocale(Auth::user()->language);
            session()->put('locale', Auth::user()->language); // sincroniza la sesión
        }

        // Si no hay nada, usa el idioma por defecto del sistema
        else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}