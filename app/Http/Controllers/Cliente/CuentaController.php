<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Cliente;
use Hash;
use Redirect;
use Session;
use Socialite;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoVerificacion;

class CuentaController extends Controller
{
  public function getSocialAuth($provider=null)
  {
    if(!config("services.$provider")) abort('404');
    return Socialite::with($provider)->stateless()->scopes(['email','user_birthday','public_profile'])->redirect();
  }

  public function getSocialAuthCallback($provider=null)
  {
    $usuario = Socialite::with($provider)->stateless()->user();
    $user = User::whereEmail($usuario->getEmail())->first();

    if(!$user){
      $codigo = str_random(30);
      $cuenta=new User;
      $cliente=new Cliente;
      $cliente->nombre=$usuario['name'];
      $cliente->apellido=$usuario['name'];
      $cliente->telefono=0;
      $cliente->fecha_registro=carbon::now();
      $cliente->credito=0;
      $cliente->save();
      $cuenta->email=$usuario['email'];
      $cuenta->password= Hash::make($usuario['id']);
      $cuenta->remember_token=$codigo;
      $cuenta->active=1;
      $cuenta->fb=1;
      $cuenta->codigo_registro=null;
      $cuenta->cuentable()->associate($cliente);
      $cuenta->save();
      Auth::login($cuenta);
      return redirect ('/');
    }
    else{
      if(!$user->fb){
        return redirect('/login')->with(
          "msg",
          [
            'title' => 'Error.',
            "body" =>"El email ya esta asociado con una cuenta de Facebook... Inicia sesión por facebook en su lugar."
          ]
        );
      }
      else{
        Auth::login($user);
        return redirect('/');
      }
    }
  }

  public function login(Request $request)
    {
    	if($request->method()=='GET'){
    		return view('cliente.login');
    	}
    	$rules = [
        "email" => "required|email",
        "password" => "required"
      ];

      $resultado = Validator::make($request->all(),$rules);

      if($resultado->fails()){
        return back()->with("msg",['title' => 'Error.',"body" =>"Proporciona todos los datos."]);
      }
      else{
        if($user = User::where('email','=', $request['email'])->first()){
            if($user->fb){
                return back()->with("msg",
                  [
                    'title' => 'Error.',
                    "body" =>"El email ya esta asociado con una cuenta de Facebook... Inicia sesión por facebook en su lugar."
                  ]
                );
            }
            if(!$user->active)
            {
              return back()->with("msg",
                [
                  'title' => 'Error.',
                  "body" =>"El email ingresdo no esta activado."
                ]
              );
            }
        }
      }
    	$datos = array('email' =>$request['email'],'password'=>$request['password'],'active'=>1);
    	if(Auth::attempt($datos)){
        return redirect('/');
    	}
    	else{
    		return back()->with("msg",['title' => 'Error.',"body" =>"Los datos ingresados no son correctos"]);
    	}
    }

    public function logout(Request $request)
    {
      Auth::logout();
      @session_start();
      session_destroy();
      if(session('cart')) $request->session()->forget('cart');
      return redirect('/');
    }

    public function registrar(Request $request)
    {
    	if($request->method()=='GET')
    	{
    		return view ('cliente.registro');
    	}
        $rules = ["email"=>"required|email","nombre"=>"required","pass"=>"required","validar_pass"=>"required|same:pass",
        "apellidos"=>"required","fecha"=>"required",'imagen'=>'mimes:jpeg,bmp,png,jpg'];

        $validacion=Validator::make($request->all(),$rules);
        if($validacion->fails())
        {
            return back()->with("msg",['title' => 'Error.',"body" =>"Proporciona todos los datos."]);
        }
        else
        {
          if($user=User::where('email',$request->email)->first())
          {
              return back()->with("msg",['title' => 'Error.',"body" =>"El email ya ha sido tomado para otra cuenta."]);
          }
        	$registro = new User;
        	$registro_cliente = new Cliente;
          $registro_cliente->nombre=$request['nombre'];
          $registro_cliente->apellido=$request['apellidos'];
          $registro_cliente->fecha_nacimiento=$request['fecha'];
          $registro_cliente->telefono=$request['telefono'];
          $registro_cliente->fecha_registro=carbon::now();
          $registro_cliente->credito=0;
          $registro_cliente->save();
        	$registro->email=$request['email'];
        	$registro->password= hash::make($request['pass']);
        	$registro->remember_token = $request['_token'];
        	$registro->active=0;
          $registro->fb=0;
          if($request->hasfile('imagen'))
          {
              $archivo=$request->imagen;
              $temp = $archivo->store('perfil','public');
              $registro->photo=$temp;
          }
        	else
          {
              $registro->photo=null;
          }
          $codigo = str_random(30);
          $registro->codigo_registro=$codigo;
          $registro->cuentable()->associate($registro_cliente);
      	  $registro->save();
          Mail::to($request->email)->send(new CodigoVerificacion($codigo));
            return redirect("/login")->with("msg",['title' => 'Aviso.',"body" =>"Revisa tu correo para activar tu cuenta."]);
        }
    }

    public function confirmar($codigo)
    {
        if(!$codigo)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::where('codigo_registro',($codigo))->first();

        if (!$user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->active = 1;
        $user->codigo_registro = null;
        $user->save();

        return redirect('/login')->with("msg",['title' => 'Listo!',"body" =>"La cuenta ha sido activada!"]);
    }

}
