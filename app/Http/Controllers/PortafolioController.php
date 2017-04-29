<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imagen;
use Redirect;
use Storage;
use Validator;
use Carbon\Carbon;
use File;

class PortafolioController extends Controller
{

  public function subirContenido(Request $request)
  {
    if($request->method()=='GET'){
      return view('admin.portafolio.subir-contenido');
    }

    if(!$request->hasfile('imagen'))
    {
      return back()->with('msg', ['title' => 'Ups!', 'type' => 'danger', 'body' => 'Debe seleccionar una imagen!']);
    }
    if(!$request->servicio)
    {
      return back()->with('msg', ['title' => 'Ups!', 'type' => 'danger', 'body' => 'Debe seleccionar un servicio!']);
    }

    $imagen = new Imagen;
    $imagen->src = $request->imagen->store('img/portafolio','public-path');
    $imagen->created_at = carbon::now()->format('Y-m-d H:i:s');
    $imagen->servicio_id = $request->servicio;
    $imagen->save();

    return back()->with('msg', ['title' => 'Ok!', 'type' => 'success', 'body' => 'Archivo agregado al portafolio!']);
  }

  public function eliminarImagen(Request $request)
  {
    $imagen = Imagen::find($request->id);
    $imagen->delete();
    //Storage::delete("/public/".$imagen->src);
    File::delete($imagen->src);
    return back();
  }

}
