<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concurso;
use Validator;
use Storage;

class ConcursoController extends Controller
{
    public function agregar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.concursos');
      }
      $rules = [
        'imagen'=>'required|mimes:jpeg,bmp,png,jpg',
        'fecha_inicio'=>'required|date|after:yesterday',
        'fecha_fin'=>'required|date|after:fecha_inicio',
      ];
      $messages= [
        'imagen.required'=>'La imagen es requerida para el concurso.',
        'imagen.mimes'=>'Debe de ingresar una imagen con los siguientes formatos: jpeg,bmp,png,jpg',
        'fecha_inicio.after'=>'La fecha inicio debe ser hoy o despues de este día.',
        'fecha_fin.after'=>'La fecha fin deber ser despues de la fecha de inicio.',
      ];
      $validacion=Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
      }
      $concurso = new Concurso;
      $file = $request->file('imagen');

      $temp = $file->store('ImagenConcurso','public');
      $concurso->imagen=$temp;
      $concurso->fecha_inicio = $request->fecha_inicio;
      $concurso->fecha_termino = $request->fecha_fin;
      $concurso->save();
      return redirect ('/admin/concursos');
    }
    public function editar(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('admin.concursos');
      }
      $rules = [
        'imagen'=>'mimes:jpeg,bmp,png,jpg',
        'fecha_inicio'=>'required|date|after:yesterday',
        'fecha_fin'=>'required|date|after:fecha_inicio',
      ];
      $messages= [
        'imagen.mimes'=>'Debe de ingresar una imagen con los siguientes formatos: jpeg,bmp,png,jpg',
        'fecha_inicio.after'=>'La fecha inicio debe ser hoy o despues del día actual.',
        'fecha_fin.after'=>'La fecha fin deber ser despues de la fecha de inicio.',
      ];
      $validacion=Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
      }
      $concurso = Concurso::find($request->id);
      if($request->file('iamgen'))
      {
        $file = $request->file('imagen');
        $temp = $file->store('ImagenConcurso','public');
        $concurso->imagen=$temp;
      }
      $concurso->fecha_inicio = $request->fecha_inicio;
      $concurso->fecha_termino = $request->fecha_fin;
      $concurso->update();
      return redirect ('/admin/concursos');
    }
}
