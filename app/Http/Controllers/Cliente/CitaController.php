<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\Rol;
use App\Cliente;
use App\Empleado;
use App\Cita;

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

    public function program(Request $request)
    {
      $app = json_decode($request->appointment);

      if(!$cliente = Cliente::find($app->clientId))
        return ['result' => false, 'msg' => 'Ha ocurrido un error.'];
      if(!$stylist = Empleado::find($app->stylistId))
        return ['result' => false, 'msg' => 'Ha ocurrido un error.'];
      $dateIsToday = strtotime($app->date) == strtotime(date('Y-m-d'));
      if(strtotime($app->date) < strtotime(date('Y-m-d')))
        return ['result' => false, 'msg' => 'La fecha es anterior a la actualidad... Elija otra fecha.'];
      if($dateIsToday && date('H',strtotime($app->time)) < date('H'))
        return ['result' => false, 'msg' => 'La hora es anterior a la actualidad... Elija otra.'];
      if($dateIsToday && date('H',strtotime($app->time)) == date('H') && date('i',strtotime($app->time)) < date('i'))
        return ['result' => false, 'msg' => 'La hora es anterior a la actualidad por unos minutos... Elija otra.'];
      if(count($app->services) < 1)
        return ['result' => false, 'msg' => 'Seleccione al menos un servicio.'];
      if(Cita::whereDate('fecha_hora','=',$app->date." ".$app->time.":00")->where('empleado_id',$app->stylistId)->first())
        return ['result' => false, 'msg' => 'Ya existe una cita con el mismo estilista a la misma hora.'];
      if($cliente->citas()->whereDate('fecha_hora','=',$app->date." ".$app->time.":00")->where('estado','!=',5)->first())
        return ['result' => false, 'msg' => 'Ya realizaste cita a esa hora. Averigua si fue confirmada en la sección Mis citas.'];
      $appointment = new Cita;
      $appointment->cliente_id = $app->clientId;
      $appointment->empleado_id = $app->stylistId;
      $appointment->fecha_hora = $app->date." ".$app->time;
      $appointment->vista = 0;
      $appointment->estado = 0;

      $appointment->save();
      foreach ($app->services as $s) {
        $ser = Servicio::find($s);
        if($prom = $ser->promociones()->whereDate('fecha_inicio','<=', date('Y-m-d'))
        ->whereDate('fecha_termino','>=', date('Y-m-d'))
        ->first())
        {
          $appointment->servicios()->attach($ser->id, ['precio' => $ser->precio, 'descuento' => $prom->descuento]);
        }
        else {
          $appointment->servicios()->attach($ser->id, ['precio' => $ser->precio, 'descuento' => 0]);
        }
      }

      return ['result' => true, 'msg' => 'Cita programada con exito!'];
    }
}
