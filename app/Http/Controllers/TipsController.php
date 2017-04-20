<?php

namespace App\Http\Controllers;
Use App\Tip;
Use Redirect;

use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function Subir_tip(Request $request)
    {
      if($request->method()=='GET'){
    		return view('admin.tips');
    	}
        $tip = new Tip;
        $tip ->titulo=$request['titulo'];
        $tip->contenido=$request['contenido'];
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
        $tip->save();
        return redirect('/tips');

    }
    public function Ver_tip($id = null)
    {
      $tip = Tip::find($id);
      return view ('cliente.tip',['tips'=>$tip]);
    }
    public function Eliminar($id=null)
    {
      $tip = Tip::find($id);
      $tip->delete();
      return redirect('/gestionartips')->with('msg','Tip Eliminado');
    }
    public function Modificar($id=null)
    {
      $tip = Tip::find($id);
      return view ('admin.modificar_tip',['tip'=>$tip]);

    }
    public function Modificar_tip(Request $request)
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
