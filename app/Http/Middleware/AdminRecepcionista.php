<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRecepcionista
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
      if(Auth::user()->cuentable_type != \App\Empleado::class or Auth::user()->cuentable->roles()->where('nombre','administrador')->orWhere('nombre','recepcionista')->count() < 1)
        return redirect('/');

      return $next($request);
    }
}
