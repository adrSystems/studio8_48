@extends('layouts.master')

@section('title')
Studio8 48 -Login
@endsection

@section('css')
<style type="text/css">
  #form{
    color: #C5B358;
  }
  body{
    color:#c5b358;
    background-color: #efe;
    font-family: 'Lato';
    background-image: url('{{asset("img/walls/2.jpg")}}');
    background-size: cover;
    background-repeat: no-repeat;
  }
  .input-login:focus{
  }
  input{
    background-color: rgba(255, 255, 255, 0.3);
    color:#444;
    border-radius: 3px;
    border: 1px solid #ddd;
    padding: 5px 15px 5px 15px;
    width: 100%;
    -webkit-transition: background-color .3s;
  }
  input::-webkit-input-placeholder{
    color: #ccc;
  }
  input:focus{
    background-color: rgba(255, 255, 255, 0.4);
    color:#fff;
  }
  .white-btn1{
    background-color: rgba(0,0,0,0);
    border: 1px solid #fff;
    border-radius: 3px;
    padding: 4px 10px 4px 10px;
    color: #eee;
    text-decoration: none;
    -webkit-transition: background-color .4s;
  }
  .white-btn1:hover{
    color: white;
    background-color: rgba(255,255,255,.3);
    text-decoration: none;
  }
  .white-btn1:visited{
    color: white;
    text-decoration: none;
  }
  .white-btn1:active{
    color: white;
    text-decoration: none;
  }
  .white-btn1:link{
    color: white;
    text-decoration: none;
  }
  #contenedor{
    float: left;
    margin-top: 100px;
    margin-bottom:60px;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    padding-top: 30px;
    padding-bottom: 30px;
  }
  h2{
    margin: 0;
    padding: 0;
    font-family: 'Lobster Two';
    text-shadow: 0 0 2px black;
    border-left-width: 15px;
  }
  label{
    text-align: left;
    padding: 0;
    color: #fff;
    font-weight: 200;
    text-shadow: 0 0 2px rgba(0, 0, 0, 1);
  }
  .footer{
    box-shadow: 0 -3px 5px rgba(0, 0, 0, 0.5);
    position: absolute;
    bottom: 0;
  }
  .input-container{
    margin-bottom: 15px;
    padding: 0;
  }
  .login-container{
    border-right: 1px solid #eee;
    padding-bottom: 30px;
  }
  .registro-container{
    text-align: center;
  }
  h4{
    margin-top: 30px;
    margin-bottom: 30px;
  }
  #registro-btn{
    background-color: rgba(0, 0, 0, 0.2);
    font-size: 20px;
    margin-top: 30px;
    border-radius: 3px;
    border: 1px solid #c5b358;
    padding: 10px 20px 12px 20px;
    text-decoration: none;
    color: white;
    font-weight: lighter;
    -webkit-transition: box-shadow .3s;
  }
  #registro-btn:hover{
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
  }
</style>
@endsection
@section('body')
<div class="container" id="contenedor">
    @if(Session::has('error'))
      <br>
      @foreach(Session::get('error') as $mensaje)
      <div class="alert alert-warning" role="alert">
      {{$mensaje}}
      </div>
      @endforeach
    @endif

    @if(Session::has('activar'))
      <br>
      @foreach(Session::get('activar') as $activar)
      <div class="alert alert-warning" role="alert">
       {{$activar}}
      </div>
      @endforeach
    @endif

    @if(Session::has('c_activada'))
      <br>
      @foreach(Session::get('c_activada') as $c_activada)
      <div class="alert alert-warning" role="alert">
          {{$c_activada}}
      </div>
      @endforeach
    @endif

    @if(Session::has('error_email'))
      <br>
      @foreach(Session::get('error_email') as $error)
      <div class="alert alert-warning" role="alert">
          {{$error}}
      </div>
      @endforeach
    @endif

    @if(Session::has('datos_invalidos'))
      <br>
      @foreach(Session::get('datos_invalidos') as $error)
      <div class="alert alert-warning" role="alert">
          {{$error}}
      </div>
      @endforeach
    @endif

  <div class="col-xs-12 col-md-6 login-container">
    <h2 class="col-xs-12 col-xs-offset-1 col-md-10 col-md-offset-1" style="padding:0">Iniciar Sesion</h2>
    <form class="form-horizontal" id="form" method="post">
      <input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
      <div class="input-container col-xs-11 col-xs-offset-1">
         <label for="inputName" class="col-xs-12" style="padding:0">Email:</label>
         <div class="col-xs-12" style="padding:0;">
             <input type="email" class="input-login" placeholder="Escribe tu email" name="email">
         </div>
      </div>
      <div class="input-container col-xs-11 col-xs-offset-1">
         <label for="inputName" class="col-xs-12" style="padding:0">Contraseña:</label>
         <div class="col-xs-12" style="padding:0;">
             <input type="password" class="input-login" placeholder="Escribe tu contraseña" name="password">
         </div>
      </div>
      <div class="input-container">
        <div class="col-xs-offset-1 col-xs-11" style="padding:0">
           <button type="submit" class="white-btn1" id="subir" style="margin:auto;">Iniciar Sesion</button>
           <a href="/social/facebook" class="white-btn1" style="margin:auto;">Inicar Sesion con Facebook</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-xs-12 registro-container col-md-6">
    <h4>¿No tienes una cuenta?</h4>
    <a href="/registro" id="registro-btn">Registrate!</a>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    if($(this).width() < 576){
      $('.login-container').css('border-right','none');
      $('.login-container').css('border-bottom','1px solid #eee');
    }
    else{
      $('.login-container').css('border-right','1px solid #eee');
      $('.login-container').css('border-bottom','none');
    }
    $(window).resize(function () {
      if($(this).width() < 576){
        $('.login-container').css('border-right','none');
        $('.login-container').css('border-bottom','1px solid #eee');
      }
      else{
        $('.login-container').css('border-right','1px solid #eee');
        $('.login-container').css('border-bottom','none');
      }
    });
    var $formulario= $('Form');
    var $evento= $('#subir');
    var result=$formulario.validate({
        rules:
        {
            email:
            {
                required:true,
                email:true
            },
            password:
            {
                required:true
            }
        },
        messages:
        {
            email:
            {
                required:"Este campo es requerido",
                email:"Escribe una direccion de correo valida"
            },
            password:
            {
                required:'Ingresa tu contraseña'
            }
        }
    });
    $('#subir').click(function(event){
        event.stopPropagation();
        event.preventDefault();
        if($formulario.valid())
        {
          $formulario.submit();
        }
    });
</script>
@endsection
