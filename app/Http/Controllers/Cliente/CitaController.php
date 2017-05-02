<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\Rol;

class CitaController extends Controller
{
    public function getServices(Request $request)
    {
      $services = Servicio::get();
      foreach ($services as $key => $s) {
        $s->icono = asset($s->icono);
        if($promocion = $s->promociones()->whereDate('fecha_inicio','<=', date('Y-m-d'))
        ->whereDate('fecha_termino','>=', date('Y-m-d'))
        ->first())
        {
          $s->descuento = doubleval(".".$promocion->descuento);
        }
        else $s->descuento = 0;
      }

      return ['services' => $services];
    }

    public function getStylists(Request $request)
    {
      $stylists = Rol::where('nombre','estilista')->first()->empleados;
      foreach ($stylists as $key => $s) {
        $s->fotografia = asset($s->fotografia);
      }

      return ['stylists' => $stylists];
    }
}
