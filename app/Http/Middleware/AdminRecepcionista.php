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
      if(Auth::user()->cuentable_type != \App\Empleado::class
      or !Auth::user()->cuentable->roles()
      ->whereRaw("empleado_rol.empleado_id = ".Auth::user()->cuentable->id." and (nombre = 'administrador' or nombre = 'recepcionista')")
      ->first())
        return redirect('/');

      return $next($request);
    }
}
