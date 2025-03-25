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
        $locale = null;

        if (session()->has('locale')) {
            $locale = session('locale');
        } elseif (Auth::check() && Auth::user()->language) {
            $locale = Auth::user()->language;
            session()->put('locale', $locale); // sincroniza la sesión si no está
        } else {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
