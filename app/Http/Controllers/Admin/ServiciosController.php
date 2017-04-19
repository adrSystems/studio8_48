<?php

namespace App\Http\Controllers\Admin;
use App\Servicio;
use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiciosController extends Controller
{
    public function agregar(Request $request)
    {
      if ($request->isMethod('GET')) {
        return view ('admin.servicios');
      }
      $rules=['icono'=>'required|mimes:jpeg,bmp,png,jpg','nombre'=>'required','precion'=>'required|numeric','duracion'=>'required|numeric'];
      $validacion = Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',['titulo'=>'Error','cuerpo'=>'Error'])->withInput();
      }
      $file = $request->file('icono');
      $temp = $file->store('IconosServicios','public');
      $servicio = new Servicio;
      $servicio->nombre= $request->nombre;
      $servicio->icono= $temp;
      $servicio->precio = $request->precio;
      $servicio->tiempo = $request->duracion;
      $servicio->save();
      return redirect ('/admin/servicios');
    }
    public function editar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.servicios');
      }
      $servicio = Servicio::find($request->id);
      if($request->file('icono'))
      {
        $file = $request->file('icono');
        $temp = $file->store('IconosServicios','public');
        $servicio->icono= $temp;
      }
      $servicio->nombre= $request->nombre;
      $servicio->precio = $request->precio;
      $servicio->tiempo = $request->duracion;
      $servicio->update();
      return redirect ('/admin/servicios');

    }
}
