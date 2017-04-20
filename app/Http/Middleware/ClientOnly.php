<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ClientOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->cuentable_type != \App\Cliente::class)
          return redirect('/');

        return $next($request);
    }
}
