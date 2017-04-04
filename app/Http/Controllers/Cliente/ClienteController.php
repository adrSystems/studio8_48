<?php

namespace App\Http\Controllers\Cliente;
use App\Mensaje;
use Carbon\Carbon;
use App\Cliente;
use App\User;
use App\Empleado;
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
        return redirect ('/micuenta');
      }
      else {
        $usuario = Cliente::find(\Auth::user()->id);
        $usuario->apellido = $request->apellido;
        $usuario->update();
        return redirect ('/micuenta');
      }
    }
    public function modificarTelefono(Request $request)
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
          'cuerpo'=>'El campo telefono es requerido, no puede dejarlo vacio. Ya que para nosotros es necesarios saberlo.'
        ]);
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
      $rules= ['foto'=>'required|mimes:jpeg,bmp,png,jpg'];
      $validacion= Validator::make($request->all(),$rules);
      if($validacion->fails())
      {
        return back()->with('error',[
          'titulo'=>'Error!',
          'cuerpo'=>'No se encontro ninguna imagen, intentelo de nuevo.'
        ]);
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
      else if(\Auth::user()->cuentable_type=='App\Cliente')
      {
        $usuario = Cliente::find(\Auth::user()->id);
        $file= $request->file('foto');
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
      //return $cliente->citas[1];
      foreach($cliente->citas as $cita)
      {
        array_push($citas,$cita);
      }
      foreach($cliente->compras as $compra)
      {
        array_push($compras,$compra);
      }
      return view ('user.micuenta',['citas'=>$citas,'compras'=>$compras]);
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
}
