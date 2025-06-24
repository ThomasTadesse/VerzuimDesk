<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check session first
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        // Then check cookie
        elseif ($request->cookie('language')) {
            $locale = $request->cookie('language');
            session(['locale' => $locale]);
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}
