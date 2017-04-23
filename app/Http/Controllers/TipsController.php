<?php

namespace App\Http\Controllers;
Use App\Tip;
Use Redirect;

use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function subir(Request $request)
    {
      if($request->method()=='GET'){
    		return view('admin.tips.nuevo');
    	}
        $tip = new Tip;
        $tip ->titulo = $request['titulo'];
        $tip->contenido = $request['contenido'];
        if($request->hasfile('imagen'))
        {
          $archivo=$request->imagen;
          $temp = $archivo->store('tips','public');
          $tip->src=$temp;
        }
        else {
          $tip->src=null;
        }
        $tip->tipo = $request['categoria'];
        $tip->save();
        return redirect('/tips');

    }

    public function eliminar($id = null)
    {
      $tip = Tip::find($id);
      $tip->delete();
      return redirect('/gestionartips')->with('msg','Tip Eliminado');
    }

    public function modificar(Request $request)
    {
      if($request->method()=='GET'){
    		return view('admin.gestion_tip');
    	}
      $tip= Tip::find($request->id);
      $tip->titulo=$request->titulo;
      $tip->contenido=$request->contenido;
      if($request->hasfile('imagen'))
      {
        $archivo=$request->imagen;
        $temp = $archivo->store('tips','public');
        $tip->src=$temp;
      }
      else {
        $tip->src=null;
      }
      $tip->tipo=$request['categoria'];
      $tip->update();
      return redirect('/gestionartips')->with('msg2','Tip Modificado');
    }

}
