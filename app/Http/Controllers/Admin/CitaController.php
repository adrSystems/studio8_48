<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\Cita;
use App\Empleado;
use App\Cliente;
use Carbon\Carbon;

class CitaController extends Controller
{

    public function add(Request $request ,$id = null){
      if($request->isMethod('GET')){
        if(!$id) return redirect('/admin/clientes');
        if(!$cliente = \App\Cliente::find($id)) return redirect('/admin/clientes');
        return view('admin.clientes.cita', ['cliente' => $cliente, 'estados' => ['En espera','Confirmada','En curso','Inconclusa','Finalizada','Cancelada']]);
      }

      //validar y agregar
      if(!$request->servicios){
        return back()->with('msg', ['title' => 'Error', 'body' => 'Debe seleccionar al menos un servicio'])->withInput();
      }
      if(!$request->estilista){
        return back()->with('msg', ['title' => 'Error', 'body' => 'Debe seleccionar un estilista'])->withInput();
      }
      if(!$request->cliente or !Cliente::find($request->cliente))
        return back()->with('msg', ['title' => 'Error', 'body' => 'No se encontró el cliente en el sistema'])->withInput();
      $emp = Empleado::find($request->estilista);
      if(!$emp or $emp->roles()->where('nombre','estilista')->count() < 1)
          return back()->with('msg', ['title' => 'Error', 'body' => 'No se encontró el estilista en el sistema'])->withInput();

      $cita = new Cita;
      $cita->cliente_id = $request->cliente;
      $cita->empleado_id = $request->estilista;
      $cita->vista = 1;
      if($request->today){
        $cita->estado = 2;
        if($request->now) $cita->fecha_hora = date('Y-m-d H:i');
        else $cita->fecha_hora = date('Y-m-d H:i:s',strtotime(date('Y-m-d').$request->time.":00"));
      }
      else if($request->tomorrow){
        $cita->estado = 1;
        if($request->now){$date = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i'));
          $date->addDay();
          $cita->fecha_hora = $date->toDateTimeString();
        }
        else{
          $cita->fecha_hora = date('Y-m-d H:i:s',strtotime(date('Y-m-d').$request->time.":00"));
          if(!$request->time){
            return back()->with('msg', ['title' => 'Error', 'body' => 'Debe proporcionar la hora']);
          }
        }
      }
      else{
        if(!$request->date){
          return back()->with('msg', ['title' => 'Error', 'body' => 'Debe proporcionar la fecha']);
        }
        if($request->now){
          $cita->fecha_hora = date('Y-m-d H:i:s',strtotime($request->date." ".date('H:i').":00"));
        }
        else{
           $cita->fecha_hora = date('Y-m-d H:i:s',strtotime($request->date." ".$request->time.":00"));
           if(!$request->time){
             return back()->with('msg', ['title' => 'Error', 'body' => 'Debe proporcionar la hora']);
           }
        }

        if(date('Y-m-d H:i',strtotime($cita->fecha_hora)) < date('Y-m-d H:i')){
          return back()->with('msg', ['title' => 'Error', 'body' => 'La fecha y hora de la cita deben ser iguales o mayores que la fecha actual.']);
        }
        else if(date('Y-m-d H:i',strtotime($cita->fecha_hora)) == date('Y-m-d H:i')) $cita->estado = 2;
        else $cita->estado = 1;
      }

      $cita->save();
      foreach (Servicio::find($request->servicios) as $servicio) {
        if($promocion= $servicio->promociones()->whereDate('fecha_inicio','<=',date('Y-m-d'))
        ->whereDate('fecha_termino','>=',date('Y-m-d'))->first()){
          $cita->servicios()->attach($servicio->id, ['descuento' => $promocion->descuento]);
        }
        else{
          $cita->servicios()->attach($servicio->id, ['descuento' => 0]);
        }
      }
      return back()->with('msg', ['title' => 'Ok', 'body' => 'Cita programada con exito.']);
    }

    public function getDateServicesInfo(Request $request)
    {
      $servicios = Servicio::find($request->servicios);
      $monto = $servicios->sum('precio');
      $tiempo = Carbon::createFromFormat('H:i','00:00');
      $estilistasPorServicio = [];
      foreach ($servicios as $i => $servicio) {
        $tiempo->addHours(date('G',strtotime($servicio->tiempo)));
        $tiempo->addMinutes(date('i',strtotime($servicio->tiempo)));
        //acumular por servicio los estilistas que pueden aplicarlo
        $estilistasPorServicio[] = $servicio->empleados;
      }

      //buscar si un estilista no aplica algun servicio, si es asi, sacarlo
      foreach ($estilistasPorServicio as $i => $grupoDeEstilistas) {
        foreach ($grupoDeEstilistas as $x => $estilista) {
          for ($v=0; $v < count($estilistasPorServicio); $v++) {
            if($estilistasPorServicio[$v]->where('id',$estilista->id)->count() < 1)
              unset($estilistasPorServicio[$i][$v]);
          }
        }
      }

      $estilistas = [];
      foreach ($estilistasPorServicio as $i => $grupoDeEstilistas) {
        foreach ($grupoDeEstilistas as $x => $estilista) {
          $estilistas[] = $estilista;
        }
      }

      return [
        'monto' => $monto,
        'tiempo' => $tiempo->format('H:i'),
        'estilistas' => $estilistas
     ];
    }

    public function getAppointmentDetails(Request $request)
    {
      $cita = Cita::find($request->id);
      $cita->estilista = $cita->empleado;
      $cita->estilista->fotografia = asset("storage/".$cita->estilista->fotografia);
      $fecha = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $cita->fecha = $fecha->toDateString();
      $cita->hora = $fecha->format('g:i a');
      $estados = ['En espera','Confirmada','En curso','Inconclusa','Finalizada','Cancelada'];
      $cita->estado = $estados[$cita->estado];
      $cita->pagos = $cita->pagos;
      $cita->servicios = $cita->servicios;
      $tiempo = Carbon::createFromFormat('H:i','00:00');
      $monto = 0;
      foreach ($cita->servicios as $servicio) {
        //concatenar storage, imagenes se guardaran en otro lado despues
        $servicio->icono = asset($servicio->icono);
        $tiempo->addHours(date('H',strtotime($servicio->tiempo)));
        $tiempo->addMinutes(date('i',strtotime($servicio->tiempo)));
        $monto += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
      }
      //tiempo total, horario aproximado
      $cita->tiempo = $tiempo->format('G')." horas, ".$tiempo->format('i')." minutos";
      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->monto = $monto;
      $fechaCita = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $cita->diff = $fechaCita->diffForHumans(Carbon::now());
      $horaTermino = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $horaTermino->addHours($tiempo->format('H'));
      $horaTermino->addMinutes($tiempo->format('i'));
      $cita->horarioAprox = $fechaCita->format('H:i')." - ".$horaTermino->format('H:i');

      return $cita;
    }
}
