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
      $rules=['contenido'=>'required|min:3'];
      $messages=[
        'contenido.required'=>'El campo de mensaje no puede estar vacio.',
        'contenido.min'=>'El mensaje al menos debe contener 3 digitos'
      ];
      $validacion = Validator::make($request->all(),$rules,$messages);
      if($validacion->fails()){
        return back ()->with('msg',$validacion->messages()->all())->withInput();
      }
      $datetim= Carbon::now();
      $mensaje = new Mensaje;
      $mensaje->contenido = $request->contenido;
      $mensaje->fecha_hora=$datetim;
      $mensaje->visto=0;
      $mensaje->by_cliente=1;
      $mensaje->cliente_id=\Auth::user()->cuentable->id;
      $mensaje->save();
      return redirect ('/micuenta/'.\Auth::user()->cuentable->id);
    }
    public function modificarNombre(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= [
        'nombre'=>'required'
      ];
      $messages=[
        'nombre.required'=>'No puede dejar el campo de nombre vacio.'];
      $validacion= Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->cuentable->id);
        $usuario->nombre = $request->nombre;
        $usuario->update();
        return redirect('/micuentaE/'.\Auth::user()->id);
      }
      else {
        $cliente = Cliente::find(\Auth::user()->cuentable->id);
        $cliente->nombre = $request->nombre;
        $cliente->update();
        return redirect ('/micuenta/'.\Auth::user()->cuentable->id);
      }
    }
    public function modificarApellido(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= [
        'apellido'=>'required'
      ];
      $messages=[
        'apellido.required'=>'No puede dejar el campo de apellido vacio.'];
      $validacion= Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->cuentable->id);
        $usuario->apellido = $request->apellido;
        $usuario->update();
        return redirect('/micuentaE/'.\Auth::user()->cuentable->id);
      }
      else
       {
        $cliente = Cliente::find(\Auth::user()->cuentable->id);
        $cliente->apellido = $request->apellido;
        $cliente->update();
        return redirect ('/micuenta/'.\Auth::user()->cuentable->id);
      }
    }
    public function modificarTelefono(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules= [
        'telefono'=>'required|numeric|digits_between:7,10'
      ];
      $messages=[
        'telefono.required'=>'No puede dejar el campo de teléfono vacio',
        'telefono.numeric'=>'No puede agregar un numero de telefono con letras o caracteres especiales.',
        'telefono.digits_between'=>'El numero de telefono debe tener al menos 7 digitos o maximo 10.'
      ];
      $validacion= Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('error',$validacion->messages()->all())->withInput();
      }
      $cliente = Cliente::find(\Auth::user()->cuentable->id);
      $cliente->telefono=$request->telefono;
      $cliente->update();
      return redirect ('/micuenta/'.\Auth::user()->cuentable->id);
    }
    public function subirFoto(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules=[
        'foto'=>'required|mimes:jpeg,bmp,png'
      ];
      $messages=[
        'foto.required'=>'Debe seleccionar una imagen',
        'foto.mimes'=>'Debe subir una imagen con los siguientes formatos: jpeg,bmp,png,jpg'
      ];
      $validacion= Validator::make($request->all(),$rules,$messages);
      if($validacion->fails())
      {
        return back()->with('errorfoto',$validacion->messages()->all())->withInput();
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->cuentable->id);
        $file= $request->file('foto');
        $temp= $file->store('ProfilePhotos','public');
        $usuario->cuenta->photo = $temp;
        $usuario->cuenta->update();
        return redirect ('/micuentaE/'.\Auth::user()->cuentable->id);
      }
      else if(\Auth::user()->cuentable_type=='App\Cliente')
      {
        $cliente = Cliente::find(\Auth::user()->cuentable->id);
        $file= $request->file('foto');
        $temp= $file->store('ProfilePhotos','public');
        $cliente->cuenta->photo = $temp;
        $cliente->cuenta->update();
        return redirect ('/micuenta/'.\Auth::user()->cuentable->id);
      }
    }
    public function modificarContrasena(Request $request)
    {
      if($request->isMethod('GET'))
      {
        return view ('user.micuenta');
      }
      $rules=[
        "newpassword"=>"required|min:5",
        "newpassword2"=>"required|same:newpassword",
      ];
      $messages=[
        "newpassword.required"=>"La nueva contraseña es requerida",
        "newpassword.min"=>"La contraseña debe ser mayor a 5 digitos",
        "newpassword2.required"=>"Debe confirmar la nueva contraseña",
        "newpassword2.same"=>"Los campos no coinciden"
      ];
      $validacion=Validator::make($request->all(),$rules,$messages);
      if($validacion->fails()){
        return back()->with('passError',$validacion->messages()->all())->withInput();
      }
      if(\Auth::user()->cuentable_type=='App\Empleado')
      {
        $usuario = Empleado::find(\Auth::user()->cuentable->id);
        $usuario->cuenta->password=\Hash::make($request->newpassword);
        $usuario->cuenta->save();
        return redirect ('/micuentaE/'.\Auth::user()->cuentable->id)->with('exito','exito')->withInput();
      }
      else if(\Auth::user()->cuentable_type=='App\Cliente')
      {
        $usuario = Cliente::find(\Auth::user()->cuentable->id);
        $usuario->cuenta->password=\Hash::make($request->newpassword);
        $usuario->cuenta->save();
        return redirect ('/micuenta/'.\Auth::user()->cuentable->id)->with('exito','exito')->withInput();
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
      return view ('user.micuenta',['citas'=>$citas,'compras'=>$compras,'mensajes'=>$mensajes,'cliente'=>$cliente]);
    }
    public function getDetailsEmpleado($id = null)
    {
      if(!$empleado = Empleado::find($id))
      {
        return redirect ('/');
      }
      $citas = [];
      $roles = [];
      foreach ($empleado->citas as $cita) {
        array_push($citas,$cita);
      }
      foreach ($empleado->roles as $rol){
        array_push($roles,$rol->nombre);
      }
      return view ('user.micuenta',['citas'=>$citas,'roles'=>$roles]);
    }
    public function cancelarCita(Request $request)
    {
      $cita= Cita::find($request->id);
      $cita->estado=5;
      $cita->update();
    }

}
