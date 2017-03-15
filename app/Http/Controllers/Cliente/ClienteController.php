<?php

namespace App\Http\Controllers\Cliente;
use App\Mensaje;
use Carbon\Carbon;
use App\Cliente;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function enviarMensaje(Request $request){
      if($request->isMethod('GET'))
      {
        return view('user.micuenta');
      }
      $datetim= Carbon::now();
      $mensaje = new Mensaje;
      $mensaje->contenido = $request['msnj'];
      $mensaje->fecha_hora=$datetim;
      $mensaje->visto=0;
      $mensaje->by_cliente=1;
      $mensaje->cliente_id=\Auth::user()->id;
      $mensaje->save();
      return redirect ('/micuenta#mensajes');
    }
    public function modificarCuenta(Request $request){
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $cuenta = Cliente::find($request->id);
      $cuenta->nombre=$request->nombre;
      $cuenta->apellido=$request->apellido;
      $cuenta->fecha_nacimiento=$request->fecha_nacimiento;
      $cuenta->update();
      return redirect ('/micuenta');
    }
    public function subirfoto(Request $request){
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $cuenta = Cliente::find($request);
    }
}
