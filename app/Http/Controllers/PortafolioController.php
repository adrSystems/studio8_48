<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portafolio;
use Redirect;
use Validator;
use Carbon\Carbon;

class PortafolioController extends Controller
{
  public function Subir_contenido(Request $request)
  {
    if($request->method()=='GET'){
      return view('admin.portafolio.subir_contenido');
    }
    $imagen = new Portafolio;
    if($request->hasfile('imagen'))
    {
      $archivo = $request->imagen;
      $temp = $archivo->store('portafolio','public');
      $imagen->imagen = $temp;
    }
    else{
      $imagen->imagen = null;
    }
    $imagen->created_at=carbon::now();
    $imagen->save();
    return back()->with('msg','Archivo agregado al portafolio');

  }
  public function Eliminar_imagen($id=null)
  {
    $imagen = Portafolio::find($id);
    $imagen->delete();
    return back()->with('msg','Archivo Eliminado');
  }


}
