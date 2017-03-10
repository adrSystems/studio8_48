@extends('layouts.master')

@section('title')
Studio8 48 - Inicio
@endsection

@section('css')
<style>
    .card{
      font-family: 'Cookie';
      box-shadow: 0 0 10px 0 #000;
      overflow: hidden;
      -webkit-transition: box-shadow .4s;
    }
    .card:hover{
      box-shadow: 0 0 10px 0 #333;
    }
    .card > h3{
      position: absolute;
      top: 0;
      left: 30px;
      color: #ddd;
      text-shadow: 0px 0px 5px #000, 0px 0px 13px #000;
    }
    .card > p{
      position: absolute;
      top:60px;
      font-size: 20px;
      left: 30px;
      color: #ddd;
      text-shadow: 0px 0px 5px #000, 0px 0px 13px #000;
    }
    .shadow-cover{
      position: absolute;
      top: 0;
      left:0;
      background-color: transparent;
      height: 100%;
      width: 100%;
      -webkit-transition: box-shadow .3s;
    }
    .shadow-cover:hover{
      box-shadow: inset 0 0 40px 10px #000;
    }
    .login-advice{
      background: rgba(0,0,0,.8);
      border: 1px solid #EEE8AA;
      border-radius: 3px;
      padding: 0px 15px 15px 15px;
      box-shadow: 0 1px 10px 3px #000;
      top: 100px;
      opacity: 0;
      color: white;
      -webkit-transform: scale(.7);
      -webkit-transition: -webkit-transform .5s, opacity .4s;
    }
    .close-btn{
      background: #111;
      border: 2px solid #fff;
      padding: 5px 5px 0px 5px;
      border-radius: 100%;
      color: #C5B358;
      position: absolute;
      font-weight: 300;
      right: -7px;
      top: -10px;
      cursor: pointer;
      -webkit-transition: color .4s;
    }
    .close-btn:hover{
      color: #E7D57A;
    }
    .close-btn > i{
      font-size: 16px;
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
    #advice-container{
      position:fixed;
      z-index:1;
    }
</style>
@endsection

@section('body')

@if(!Auth::check())
<div class="col-xs-12" id="advice-container">
  <div class="col-xs-12 col-sm-4 col-md-3 login-advice">
    <div class="close-btn">
      <i class="material-icons">close</i>
    </div>
    <h3 style="font-family: Cookie;color:#C5B358;">No haz iniciado sesión.</h3>
    <p>
      Inicia sesión o crea una cuenta para poder
      <i>acceder a promociones especiales</i>,
      <i>programar citas y regalar cambios de imagen</i>
      a tus amigos.
    </p>
    <hr>
    <a href="#" class="white-btn1" style="display:block; margin:auto;text-align:center;">Iniciar sesion</a>
    <p style="margin-top:10px;text-align:center;">¿No tienes una cuenta?</p>
    <a href="#" class="white-btn1" style="display:block; margin:auto;text-align:center;">Registrate</a>
  </div>
</div>
@endif

<div class="hidden-sm hidden-md hidden-lg" style="height: 60px;">

</div>

<img class="main-cover" src="{{asset("img/covers/15724731_1154770124618416_1360025351635700623_o.jpg")}}">

<div class="col-md-10 col-md-offset-1" style="margin-top: 50px; margin-bottom: 35px; padding:0;">
    <a class="col-md-4" href="#">
      <div class="col-xs-12" style="margin-bottom:15px;">
        <div class="card col-xs-12" style="padding:0;">
          <img src="{{asset('img/covers/15780874_1154790474616381_7086443775051567218_n.jpg')}}" alt="" width="100%">
          <h3>¿Quienes somos?</h3>
          <p>Descubre todo sobre nosotros.</p>
          <div class="shadow-cover">

          </div>
        </div>
      </div>
    </a>
    <a class="col-md-4" href="#">
      <div class="col-xs-12" style="margin-bottom:15px;">
        <div class="card col-xs-12" style="padding:0;">
          <img src="{{asset('img/covers/15202607_1129609833801112_6648032831072527106_n.jpg')}}" alt="" width="100%">
          <h3>Agenda tu cita</h3>
          <p>Que no te ganen el lugar, ¡Haz click aqui!</p>
          <div class="shadow-cover">

          </div>
        </div>
      </div>
    </a>
    <a class="col-md-4" href="#">
      <div class="col-xs-12" style="margin-bottom:15px;">
        <div class="card col-xs-12" style="padding:0;">
          <img src="{{asset('img/covers/10426294_728232000605566_5877951014255242326_n.jpg')}}" alt="" width="100%">
          <h3>Title</h3>
          <p>Message</p>
          <div class="shadow-cover">

          </div>
        </div>
      </div>
    </a>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('.login-advice').css('opacity',1);
    $('.login-advice').css('-webkit-transform','scale(1)');

    $('.close-btn').click(function () {
      $(this).parent().css('-webkit-transform','scale(.7)');
      $(this).parent().parent().fadeOut(400,function () {
        this.remove();
      });
    });
  });
</script>
@endsection
