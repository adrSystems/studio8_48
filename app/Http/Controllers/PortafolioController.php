<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imagen;
use Redirect;
use Validator;

class PortafolioController extends Controller
{
  public function Subir_contenido(Request $request)
  {
    if($request->method()=='GET'){
      return view('admin.portafolio.subir_contenido');
    }
    $imagen = new Imagen;
    if($request->hasfile('imagen'))
    {
      $archivo = $request->imagen;
      $temp = $archivo->store('portafolio','public');
      $imagen->src = $temp;
    }
    else{
      $imagen->src = null;
    }
    $imagen->link=$request['url'];
    $imagen->descripcion_video=$request['des'];
    $imagen->save();
    return back()->with('msg','Archivo agregado al portafolio');

  }
  Public function Eliminar_imagen($id=null)
  {
    $imagen = Imagen::find($id);
    $imagen->delete();
    return back()->with('msg','Archivo Eliminado');
  }

  public function Eliminar_video($id=null)
  {
    $imagen = Imagen::find($id);
    $imagen->delete();
    return back()->with('msg','Archivo Eliminado');
  }

}
