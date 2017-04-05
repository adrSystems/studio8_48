<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mensaje;
use Carbon\Carbon;
use App\Cliente;
use Validator;

class ForumController extends Controller
{
    public function getAll(){
      $mensaje=[];
      return view ('admin.forum',['mensaje'=>$mensaje]);
    }
    public function getMensajes($id = null)
    {
      $mensaje = Mensaje::where('cliente_id','=',$id)->get();
      return view ('admin.forum',['mensaje'=>$mensaje]);
    }
    public function enviarMensaje(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view('admin.forum');
      }
      $rules=['contenido'=>'required'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back ()->with('error',
        ['titulo'=>'Debe de enviar un mensaje.','cuerpo'=>'No puede enviar un mensaje en blanco.']);
      }
      $mensaje= new Mensaje;
      $mensaje->contenido=  $request->contenido;
      $mensaje->cliente_id = $request->id;
      $mensaje->by_cliente=0;
      $mensaje->fecha_hora= Carbon::now();
      $mensaje->visto=0;
      $mensaje->save();
      return redirect ('/forum/'.$request->id);
    }
}
