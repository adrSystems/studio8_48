<?php

namespace App\Http\Controllers\Cliente;
use App\Mensaje;
use Carbon\Carbon;
use App\Cliente;
use App\User;
use App\Empleado;
use Storage;
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
    public function modificarNombre(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->nombre = $request->nombre;
        $usuario->update();
        return redirect('/micuenta');
      }
      else {
        $usuario = Cliente::find(\Auth::user()->id);
        $usuario->nombre = $request->nombre;
        $usuario->update();
        return redirect ('/micuenta');
      }
    }
    public function modificarApellido(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->apellido = $request->apellido;
        $usuario->update();
        return redirect ('/micuenta');
      }
      else {
        $usuario = Cliente::find(\Auth::user()->id);
        $usuario->apellido = $request->apellido;
        $usuario->update();
        return redirect ('/micuenta');
      }
    }
    public function modificarCorreo(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->cuenta->email=$request->correo;
        $usuario->cuenta->update();
        return redirect ('/micuenta');
      }
      else
      {
        $usuario = Cliente::find(\Auth::user()->id);
        $usuario->cuenta->email=$request->correo;
        $usuario->cuenta->update();
        return redirect ('/micuenta');
      }
    }
    public function modificarTelefono(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $usuario = Cliente::find(\Auth::user()->id);
      $usuario->telefono=$request->telefono;
      $usuario->update();
      return redirect ('/micuenta');
    }
    public function modificarFechanacimiento(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->fecha_nacimiento=$request->fecha_nacimiento;
        $usuario->update();
        return redirect ('/micuenta');
      }
      else {
        $usuario = Cliente::find(\Auth::user()->id);
        $usuario->fecha_nacimiento=$request->fecha_nacimiento;
        $usuario->update();
        return redirect ('/micuenta');
      }
    }
    public function subirFoto(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }

      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $file= $request->file('foto');
        $temp= $file->store('ProfilePhotos','public');
        $usuario->cuenta->photo = $temp;
        $usuario->cuenta->update();
        return redirect ('/micuenta');
      }
      else if(\Auth::user()->cuentable_type=='App\Cliente'){
        $usuario = Cliente::find(\Auth::user()->id);
        $file= $request->file('foto');
        return $file;
        $temp= $file->store('ProfilePhotos','public');
        $usuario->cuenta->photo = $temp;
        $usuario->cuenta->update();
        return redirect ('/micuenta');
      }
    }
    public function modificarContrasena(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        return $usuario->cuenta->password;
        if($usuario->cuenta->password==$request->actualpassword)
        {
          $usuario->cuenta->password=Hash::make($request->nuevacontrasena);
          return $usuario->cuenta->password;
          $usuario->update();
          return redirect ('/micuenta');
        }
        return redirect ('/');
      }
    }
}
