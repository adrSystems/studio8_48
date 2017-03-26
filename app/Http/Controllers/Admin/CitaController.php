<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
use Carbon\Carbon;

class CitaController extends Controller
{

    public function add(Request $request ,$id = null){
      if($request->isMethod('GET')){
        if(!$id) return redirect('/admin/clientes');
        if(!$cliente = \App\Cliente::find($id)) return redirect('/admin/clientes');
        return view('admin.clientes.cita', ['cliente' => $cliente]);
      }

      //validar y agregar
      return $request->all();
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
}
