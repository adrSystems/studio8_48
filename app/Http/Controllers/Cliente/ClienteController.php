<?php

namespace App\Http\Controllers\Cliente;
use App\Mensaje;
use Carbon\Carbon;
use App\Cliente;
use App\User;
use App\Empleado;
use App\Cita;
use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function enviarMensaje(Request $request){
      if($request->isMethod('GET'))
      {
        return view('user.micuenta');
      }
      if(!$request->contenido){
          return back()->with('msg',['title'=>'Error','body'=>'Debe enviar un mensaje.']);
      }
      $rules=['contenido'=>'required|min:3'];
      $messages=[
        'contenido.required'=>'El campo de mensaje no puede estar vacio.'
      ];
      $validacion = Validator::make($request->all(),$rules,$messages);
      if($validacion->fails()){
        return back ()->with('msg', ['title' => 'Error', 'body' => 'Debe ']);
      }
      $datetim= Carbon::now();
      $mensaje = new Mensaje;
      $mensaje->contenido = $request->contenido;
      $mensaje->fecha_hora=$datetim;
      $mensaje->visto=0;
      $mensaje->by_cliente=1;
      $mensaje->cliente_id=\Auth::user()->id;
      $mensaje->save();
      return redirect ('/micuenta/'.\Auth::user()->id);
    }
    public function modificarNombre(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= ['nombre'=>'required'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',[
          'titulo'=>'Error!',
          'cuerpo'=>'El campo nombre es requerido, no puede dejarlo vacio. Ya que para nosotros es necesarios saberlo'
        ]);
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->nombre = $request->nombre;
        $usuario->update();
        return redirect('/micuentaE/'.\Auth::user()->id);
      }
      else {
        $cliente = Cliente::find(\Auth::user()->id);
        $cliente->nombre = $request->nombre;
        $cliente->update();
        return redirect ('/micuenta/'.\Auth::user()->id);
      }
    }
    public function modificarApellido(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= ['apellido'=>'required'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',[
          'titulo'=>'Error!',
          'cuerpo'=>'El campo apellido es requerido, no puede dejarlo vacio. Ya que para nosotros es necesarios saberlo.'
        ]);
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->apellido = $request->apellido;
        $usuario->update();
        return redirect('/micuentaE/'.\Auth::user()->id);
      }
      else
       {
        $cliente = Cliente::find(\Auth::user()->id);
        $cliente->apellido = $request->apellido;
        $cliente->update();
        return redirect ('/micuenta/'.\Auth::user()->id);
      }
    }
    public function modificarTelefono(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= ['telefono'=>'required'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',[
          'titulo'=>'Error!',
          'cuerpo'=>'El campo telefono es requerido, no puede dejarlo vacio. Ya que para nosotros es necesarios saberlo.'
        ]);
      }
      $cliente = Cliente::find(\Auth::user()->id);
      $cliente->telefono=$request->telefono;
      $cliente->update();
      return redirect ('/micuenta/'.\Auth::user()->id);
    }
    public function modificarFechanacimiento(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= ['fecha_nacimiento'=>'required'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',[
          'titulo'=>'Error!',
          'cuerpo'=>'El campo fecha de nacimiento es requerido, no puede dejarlo vacio. Ya que para nosotros es necesarios saberlo.'
        ]);
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->id);
        $usuario->fecha_nacimiento=$request->fecha_nacimiento;
        $usuario->update();
        return redirect ('/micuentaE/'.\Auth::user()->id);
      }
      else {
        $cliente = Cliente::find(\Auth::user()->id);
        $cliente->fecha_nacimiento=$request->fecha_nacimiento;
        $cliente->update();
        return redirect ('/micuenta/'.\Auth::user()->id);
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
        return redirect ('/micuentaE/'.\Auth::user()->id);
      }
      else if(\Auth::user()->cuentable_type=='App\Cliente')
      {
        $cliente = Cliente::find(\Auth::user()->id);
        $file= $request->file('foto');
        $temp= $file->store('ProfilePhotos','public');
        $cliente->cuenta->photo = $temp;
        $cliente->cuenta->update();
        return redirect ('/micuenta/'.\Auth::user()->id);
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
    public function getDetailsCliente($id =null)
    {

      if(!$cliente = Cliente::find($id))
      {
        return redirect ('/');
      }

      //$pila = array("naranja", "plátano");
      //array_push($pila, "manzana", "arándano");
      //return $pila;
      $citas =[];
      $compras=[];
      $mensajes = [];
      //return $cliente->citas[1];
      foreach($cliente->citas as $cita)
      {
        array_push($citas,$cita);
      }
      foreach($cliente->compras as $compra)
      {
        array_push($compras,$compra);
      }
      foreach ($cliente->mensajes as $mensaje) {
        array_push($mensajes,$mensaje);
      }
      return view ('user.micuenta',['citas'=>$citas,'compras'=>$compras,'mensajes'=>$mensajes]);
    }
    public function getDetailsEmpleado($id = null)
    {
      if(!$empleado = Empleado::find($id))
      {
        return redirect ('/');
      }
      $citas = [];
      foreach ($empleado->citas as $cita) {
        array_push($citas,$cita);
      }
      return view ('user.micuenta',['citas'=>$citas]);
    }
    public function cancelarCita(Request $request)
    {
      $cita= Cita::find($request->id);
      $cita->estado=4;
      $cita->update();
    }

}
