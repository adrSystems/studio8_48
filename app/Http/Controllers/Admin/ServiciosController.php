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
      $rules=[
        'icono'=>'required|mimes:jpeg,bmp,png,jpg',
        'nombre'=>'required',
        'precio'=>'required|numeric|between:0,100000000000000',
        'duracion'=>'required'
      ];
      $messages=[
        'icono.required'=>'El icono del servicio es requerido',
        'icono.mimes'=>'El icono del servicio debe tener estos formatos: jpeg,bmp,png,jpg',
        'nombre.required'=>'El nombre del servicio es requerido.',
        'precio.required'=>'El precio del servicio es requerido.',
        'precio.numeric'=>'El campo precio no acepta letras.',
        'precio.between'=>'El campo precio no acepta numeros negativos.',
        'duracion.required'=>'La duracion de un servicio es requerido.'
      ];
      $validacion = Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
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
      $rules=[
        'icono'=>'mimes:jpeg,bmp,png,jpg',
        'nombre'=>'required',
        'precio'=>'required|numeric|between:0,100000000000000',
        'duracion'=>'required'
      ];
      $messages=[
        'icono.mimes'=>'El icono del servicio debe tener estos formatos: jpeg,bmp,png,jpg',
        'nombre.required'=>'El nombre del servicio es requerido.',
        'precio.required'=>'El precio del servicio es requerido.',
        'precio.numeric'=>'El campo precio no acepta letras.',
        'precio.between'=>'El campo precio no acepta numeros negativos.',
        'duracion.required'=>'La duracion de un servicio es requerido.'
      ];
      $validacion = Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
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
