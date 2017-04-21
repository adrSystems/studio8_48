<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
use App\Cita;
use App\Pago;
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
        if($request->now){
          $date = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i'));
          $date->addDay();
          $cita->fecha_hora = $date->toDateTimeString();
        }
        else
        {
          if(!$request->time){
            return back()->with('msg', ['title' => 'Error', 'body' => 'Debe proporcionar la hora']);
          }
          $cita->fecha_hora = Carbon::tomorrow()->setTime(date('H',strtotime($request->time)), date('i',strtotime($request->time)), 0)->format('Y-m-d H:i:s');
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
      Carbon::setLocale('es');
      $cita = Cita::find($request->id);
      $cita->cliente = $cita->cliente;
      $cita->estilista = $cita->empleado;
      $cita->estilista->fotografia = asset("storage/".$cita->estilista->fotografia);
      $fecha = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado'];
      $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
      $cita->fecha = $dias[$fecha->format('w')].", ".$fecha->format('d \d\e')." ".$meses[$fecha->format('m')-1]." ".$fecha->format('\d\e\l Y');
      $cita->hora = $fecha->format('g:i a');
      $estados = ['En espera','Confirmada','En curso','Inconclusa','Finalizada','Cancelada'];
      $cita->estado = $estados[$cita->estado];
      $cita->pagos = $cita->pagos;
      $cita->servicios = $cita->servicios;
      $tiempo = Carbon::createFromFormat('H:i','00:00');
      $monto = 0;
      foreach ($cita->servicios as $servicio) {
        //concatenar storage, imagenes se guardaran en otro lado despues
        $servicio->icono = asset('storage/'.$servicio->icono);
        $tiempo->addHours(date('H',strtotime($servicio->tiempo)));
        $tiempo->addMinutes(date('i',strtotime($servicio->tiempo)));
        $monto += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
      }
      //tiempo total, horario aproximado
      $cita->tiempo = $tiempo->format('G')." horas, ".$tiempo->format('i')." minutos";
      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->monto = $monto;
      $fechaCita = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $diff = Carbon::now()->diffInMinutes($fechaCita,false);
      if($diff < 0)
      {
        if($diff > -60)
        {
          $cita->diff = abs($diff)." minutos de retraso";
        }
        else if($diff > -3600)
        {
          $cita->diff = Carbon::now()->diffInHours($fechaCita)." horas de retraso.";
          if($cita->estado == 'Confirmada')
            $cita->diff .= " (Se recomienda cancelar o posponer la cita)";
        }
        else
        {
          $cita->diff = Carbon::now()->diffInDays($fechaCita)." dias de retraso.";
          if($cita->estado == 'Confirmada')
            $cita->diff .= " (Se recomienda cancelar o posponer la cita)";
        }
      }
      else if($diff == 0) "Ahora mismo es el tiempo de la cita";
      else {
        if($diff < 60)
        {
          $cita->diff = "Faltan ".$diff." minutos";
        }
        else if($diff < 3600)
        {
          $cita->diff = "Faltan ".Carbon::now()->diffInHours($fechaCita)." horas";
        }
        else
        {
          $cita->diff = "Faltan ".Carbon::now()->diffInDays($fechaCita)." días";
        }
      }
      $horaTermino = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
      $horaTermino->addHours($tiempo->format('H'));
      $horaTermino->addMinutes($tiempo->format('i'));
      $cita->horarioAprox = $fechaCita->format('g:i a')." - ".$horaTermino->format('g:i a');
      foreach ($cita->pagos as $pago) {
        $fechaCompleta = Carbon::createFromFormat('Y-m-d H:i:s',$pago->fecha_hora);
        $pago->fecha = $fechaCompleta->format('d/m/Y');
        $pago->hora = $fechaCompleta->format('g:i a');
      }
      return $cita;
    }

    public function changeStylistFromAppointment(Request $request)
    {
      $cita = Cita::find($request->appointmentId);
      $estilista = Empleado::find($request->stylistId);

      if($cita->estado != 5)
      {
        $cita->empleado_id = $estilista->id;
        $estilista->foto = asset("storage/".$estilista->fotografia);
        $cita->save();
      }

      return $estilista;
    }

    public function payByAdmin(Request $request)
    {
      if($request->cantidad == 0)
      return [
        'result' => false,
        'msg' => ['title' => 'Ups!', 'body' => 'El pago debe ser mayor a cero pesos.']
      ];

      $cita = Cita::find($request->citaId);
      $monto = 0;
      foreach ($cita->servicios as $servicio) {
        $monto += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
      }
      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->monto = $monto;
      $cita->restante = $cita->monto - $cita->pagado;
      if($request->cantidad > $cita->restante)
      return [
        'result' => false,
        'msg' => ['title' => 'Ups!', 'body' => 'El pago recibido sobrepasa el restante a pagar.']
      ];
      if(!$cita->cliente->credito and $request->cantidad < $cita->restante)
        return [
          'result' => false,
          'msg' => ['title' => 'Ups!', 'body' => 'El cliente no tiene el credito activado, debe pagar todo el restante de un solo pago.']
        ];

      $pago = new Pago;
      $pago->fecha_hora = date('Y-m-d H:i:s');
      $pago->pagable_id = $cita->id;
      $pago->cantidad = $request->cantidad;
      $pago->pagable_type = Cita::class;
      $pago->save();

      $pago->fecha = date('d/m/Y');
      $pago->hora = date('g:i a');

      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->restante = $cita->monto - $cita->pagado;

      return [
        'result' => true,
        'msg' => ['title' => 'Ok!', 'body' => 'Pago registrado con exito'],
        'pago' => $pago,
        'cita' => $cita
      ];

    }

    public function liquidar(Request $request)
    {
      $cita = Cita::find($request->citaId);
      $monto = 0;
      foreach ($cita->servicios as $servicio) {
        $monto += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
      }
      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->monto = $monto;
      $cita->restante = $cita->monto - $cita->pagado;

      if($cita->restante == 0)
        return [
          'result' => false
        ];

      $pago = new Pago;
      $pago->fecha_hora = date('Y-m-d H:i:s');
      $pago->pagable_id = $cita->id;
      $pago->cantidad = $cita->restante;
      $pago->pagable_type = Cita::class;
      $pago->save();

      $pago->fecha = date('d/m/Y',strtotime($pago->fecha_hora));
      $pago->hora = date('g:i a',strtotime($pago->fecha_hora));

      $cita->pagado = $cita->pagos()->sum('cantidad');
      $cita->restante = $cita->monto - $cita->pagado;

      return [
        'result' => true,
        'pago' => $pago,
        'cita' => $cita
      ];
    }

    public function iniciar(Request $request)
    {
      $cita = Cita::find($request->citaId);

      if($cita->estado == 1)
      {
        $cita->estado = 2;
        $cita->fecha_hora = Carbon::now()->format('Y-m-d H:i:s');
        $cita->save();
        return ['result' => true];
      }

      return ['result' => false];
    }

    public function cancel(Request $request)
    {
      $cita = Cita::find($request->citaId);

      if($cita->estado == 1)
      {
        $cita->estado = 5;
        $cita->save();
        return ['result' => true];
      }

      return ['result' => false];
    }

    public function end(Request $request)
    {
      $cita = Cita::find($request->citaId);

      if($cita->estado == 2)
      {
        $cita->estado = 4;
        $cita->save();
        return ['result' => true];
      }

      return ['result' => false];
    }

    public function updateDatetime(Request $request)
    {
      $cita = Cita::find($request->citaId);

      $date = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);

      if($cita->estado == 1)
      {
        if($request->date)
        {
          $uncomingDate = Carbon::createFromFormat('Y-m-d',$request->date);
          $date->setDate($uncomingDate->format('Y'), $uncomingDate->format('m'), $uncomingDate->format('d'));
        }
        if($request->time)
        {
          $uncomingTime = Carbon::createFromFormat('H:i',$request->time);
          $date->setTime($uncomingTime->format('H'), $uncomingTime->format('i'), 0);
        }
        $cita->fecha_hora = $date->format('Y-m-d H:i:s');
        $cita->save();

        $fecha = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
        $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sabado'];
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
        $cita->fecha = $dias[$fecha->format('w')].", ".$fecha->format('d \d\e')." ".$meses[$fecha->format('w')]." ".$fecha->format('\d\e\l Y');
        $cita->hora = $date->format('g:i a');

        $estados = ['En espera','Confirmada','En curso','Inconclusa','Finalizada','Cancelada'];
        $cita->estado = $estados[$cita->estado];

        $diff = Carbon::now()->diffInMinutes($date,false);
        if($diff < 0)
        {
          if($diff > -60)
          {
            $cita->diff = abs($diff)." minutos de retraso";
          }
          else if($diff > -3600)
          {
            $cita->diff = Carbon::now()->diffInHours($date)." horas de retraso.";
            if($cita->estado == 'Confirmada')
              $cita->diff .= " (Se recomienda cancelar o posponer la cita)";
          }
          else
          {
            $cita->diff = Carbon::now()->diffInDays($date)." dias de retraso.";
            if($cita->estado == 'Confirmada')
              $cita->diff .= " (Se recomienda cancelar o posponer la cita)";
          }
        }
        else if($diff == 0) "Ahora mismo es el tiempo de la cita";
        else {
          if($diff < 60)
          {
            $cita->diff = "Faltan ".$diff." minutos";
          }
          else if($diff < 3600)
          {
            $cita->diff = "Faltan ".Carbon::now()->diffInHours($date)." horas";
          }
          else
          {
            $cita->diff = "Faltan ".Carbon::now()->diffInDays($date)." días";
          }
        }

        $tiempo = Carbon::createFromFormat('H:i','00:00');
        foreach ($cita->servicios as $servicio) {
          $tiempo->addHours(date('H',strtotime($servicio->tiempo)));
          $tiempo->addMinutes(date('i',strtotime($servicio->tiempo)));
        }
        $horaTermino = Carbon::createFromFormat('Y-m-d H:i:s',$cita->fecha_hora);
        $horaTermino->addHours($tiempo->format('H'));
        $horaTermino->addMinutes($tiempo->format('i'));
        $cita->horarioAprox = $date->format('g:i a')." - ".$horaTermino->format('g:i a');
        $cita->cliente = $cita->cliente;

        return [
          'result' => true,
          'cita' => $cita
        ];
      }

      return ['result' => false];
    }

    public function getAppointmentsTableByClient(Request $request)
    {
      $cliente = Cliente::find($request->id);

      $cliente->citas = $cliente->citas()->orderBy('fecha_hora','desc')->get();
      foreach ($cliente->citas as $cita) {
        $aPagar=0;
        foreach ($cita->servicios as $servicio) {
          $aPagar  += $servicio->precio - ($servicio->precio * (".".$servicio->pivot->descuento));
        }
        $cita->monto = $aPagar;
        if($cita->estado == 5){
          $cita->pagada = false;
        }
        elseif($cita->pagos()->sum('cantidad') < $aPagar)
        {
          $cita->pagada = false;
        }
        else $cita->pagada = true;
      }

      return view('admin.clientes.tabla-citas-de-cliente', [
        'cliente' => $cliente,
        'estados' => ['En espera','Confirmada','En curso','Inconclusa','Finalizada','Cancelada']
      ]);
    }
}
