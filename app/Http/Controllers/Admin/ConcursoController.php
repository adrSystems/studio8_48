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
        'imagen'=>'mimes:jpeg,bmp,png,jpg',
        'fecha_inicio'=>'required',
        'fecha_fin'=>'required'];
      $validacion=Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',['titulo'=>'Error','cuerpo'=>'Datos incorrectos'])->withInput();
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
      $concurso = new Concurso;
      if($request->file('iamgen'))
      {
        $file = $request->file('imagen');
        $temp = $file->store('ImagenConcurso','public');
        $concurso->imagen=$temp;
      }
      $concurso->fecha_inicio = $request->fecha_inicio;
      $concurso->fecha_termino = $request->fecha_fin;
      $concurso->save();
      return redirect ('/admin/concursos');
    }
}
