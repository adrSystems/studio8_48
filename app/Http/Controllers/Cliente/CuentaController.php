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
            "body" =>["El email ya esta asociado con una cuenta de Facebook... Inicia sesión por facebook en su lugar."]
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
        return back()->with("msg",['title' => 'Error.',"body" => $resultado->messages()->all()])->withInput($request->except('password'));
      }
      else{
        if($user = User::where('email','=', $request['email'])->first()){
            if($user->fb){
                return back()->with("msg",
                  [
                    'title' => 'Error.',
                    "body" =>["El email ya esta asociado con una cuenta de Facebook... Inicia sesión por facebook en su lugar."]
                  ]
                )->withInput($request->except('password'));
            }
            if(!$user->active)
            {
              return back()->with("msg",
                [
                  'title' => 'Error.',
                  "body" =>["El email ingresdo no esta activado."]
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
    		return back()->with("msg",['title' => 'Error.',"body" =>["Las credenciales proporcionadas no coinciden con ninguna cuenta."]])->withInput($request->except('password'));
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
        $rules = [
          "email" => "required|email",
          "nombre" => "required",
          "password" => "required|string|min:6|max:21|same:confirmacion",
          "confirmacion" => "required|string|min:6|max:21",
          "apellidos" => "required",
          "fecha" => "required|date|before:today",
          'imagen' => 'mimes:jpeg,bmp,png,jpg',
          'telefono' => 'required|numeric|min:999|max:9999999999999999999999|unique:clientes',
      ];

        $validacion=Validator::make($request->all(), $rules);

        if($validacion->fails())
          return back()->with("msg",['title' => 'Errors',"body" => $validacion->messages()->all()])->withInput($request->except('pass','validar_pass'));


        if($user=User::where('email',$request->email)->first())
        {
            return back()->with("msg",['title' => 'Errors',"body" => ["El email ya ha sido tomado para otra cuenta."]])->withInput($request->except('pass','validar_pass'));
        }

      	$cliente = new Cliente;
        $cliente->nombre = $request['nombre'];
        $cliente->apellido = $request['apellidos'];
        $cliente->fecha_nacimiento = $request['fecha'];
        $cliente->telefono = $request['telefono'];
        $cliente->fecha_registro = carbon::now();
        $cliente->credito = 0;
        $cliente->save();

        $cuenta = new User;
      	$cuenta->email = $request['email'];
      	$cuenta->password = hash::make($request['password']);
      	$cuenta->remember_token = null;
      	$cuenta->active = 0;
        $cuenta->fb = 0;

        if($request->hasfile('imagen'))
        {
            $cuenta->photo = $request->imagen->store('img/profile_photos','public-path');
        }
      	else
        {
            $cuenta->photo=null;
        }
        $codigo = str_random(30);
        $cuenta->codigo_registro=$codigo;
        $cuenta->cuentable()->associate($cliente);
    	  $cuenta->save();
        Mail::to($request->email)->send(new CodigoVerificacion($codigo));

        return redirect("/login")->with("msg",['title' => 'Ok!',"body" =>["Enhorabuena! Revisa tu correo (".$request->email.") para activar tu cuenta."]]);

    }

    public function confirmar($codigo)
    {
        if(!$codigo)
        {
            return redirect('/login')->with("msg",['title' => 'Ups!',"body" =>["Ha ocurrido un error."]]);
        }

        $user = User::where('codigo_registro', $codigo)->first();

        if (!$user)
        {
            return redirect('/login')->with("msg",['title' => 'Ups!',"body" =>["Ha ocurrido un error."]]);
        }

        $user->active = 1;
        $user->codigo_registro = null;
        $user->save();

        return redirect('/login')->with("msg",['title' => 'Listo!',"body" =>["La cuenta ha sido activada!"]]);
    }

    public function androidLoginAttempt(Request $request)
    {
      if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->pass,
        'active' => '1',
        'cuentable_type' => Cliente::class
      ]))
      {
        $cuenta = Auth::user();
        $cuenta->cliente = $cuenta->cuentable;
        if($cuenta->photo)
            $cuenta->photo = asset($cuenta->photo);
        return ['result' => true, 'cuenta' => $cuenta];
      }
      else
      {
        return ['result' => false];
      }
    }
    
    public function getAccountById(Request $request)
    {
      if($cuenta = User::find($request->id) and $cuenta->cuentable_type == Cliente::class)
      {
        $cuenta->cliente = $cuenta->cuentable;
        if($cuenta->photo)
            $cuenta->photo = asset($cuenta->photo);
        return ['result' => true, 'cuenta' => $cuenta];
      }
      else
      {
        return ['result' => false];
      }
    }

}
