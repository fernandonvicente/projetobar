<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }

        // return $next($request);
        switch ($guard) {
            case 'area-cliente':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('area-cliente.cardapio');
              }
             
            default:
              if (Auth::guard($guard)->check()) {
                  return redirect('/login');
              }
              break;
          }
          return $next($request);
    }
}