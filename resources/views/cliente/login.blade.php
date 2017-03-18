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
    margin-bottom:130px;
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
    position: fixed;
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
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
  }
  .facebook-btn{
    border: 1px solid #fff;
    border-radius: 2px;
    display: table;
    font-size: 18px;
    color: white;
    padding: 6px 10px 8px 10px;
    text-decoration: none;
    -webkit-transition: background-color .3s;
  }
  .facebook-btn:link{
    color: #ddd;
    text-decoration: none;
  }
  .facebook-btn:hover{
    color: #fff;
    background-color: rgba(255, 255, 255, 0.2);
    text-decoration: none;
  }
  .facebook-btn:visited{
    color: #fff;
    text-decoration: none;
  }
  .facebook-btn>img{
    margin-right: 5px;
    width: 22px;
    margin-top: -2px;
  }
</style>
@endsection
@section('body')
<div class="container" id="contenedor">

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
        </div>
      </div>
    </form>
  </div>
  <div class="col-xs-12 registro-container col-md-6">
    <h4>¿No tienes una cuenta?</h4>
    <a href="/registro" id="registro-btn">Registrate!</a>
    <p class="" style="margin: 15px 0 15px 0;">o</p>
    <a href="/social/facebook" class="facebook-btn" style="margin:auto;">
      <img src="{{asset('img/facebook_logos/FB-f-Logo__white_29.png')}}" alt="">
      Iniciar Sesión
    </a>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    if($(this).width() < 768){
      $('.login-container').css('border-right','none');
      $('.login-container').css('border-bottom','1px solid #eee');
    }
    else{
      $('.login-container').css('border-right','1px solid #eee');
      $('.login-container').css('border-bottom','none');
    }
    $(document).ready(function () {
      $(window).resize(function () {
        if($(this).width() < 768){
          $('.login-container').css('border-right','none');
          $('.login-container').css('border-bottom','1px solid #eee');
        }
        else{
          $('.login-container').css('border-right','1px solid #eee');
          $('.login-container').css('border-bottom','none');
        }
      });
      function showMsg(title, body) {
        $('#general-msg').show(0);
        $('#general-msg>.msg-card').css('opacity',1);
        $('#general-msg>.msg-card').css('margin-top','100px');
        $('#general-msg>.msg-card').css('-webkit-transform','scale(1)');
        $('#general-msg>.msg-card>.header>h3').text(title);
        $('#general-msg>.msg-card>.body').children().remove();
        $.each(body, function (i, paragraph) {
          $('#general-msg>.msg-card>.body').append('<p>'+paragraph);
        });
      }
      $('.msg-footer>button').click(function () {
        $('.msg-card').css('-webkit-transform','scale(.7)');
        $('.msg-card').parent().fadeOut(400, function () {
          $(this).hide();
        });
      });

      @if(session('msg'))
      showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
      @endif

      var $formulario= $('Form');
      var $evento= $('#subir');
      $('#subir').click(function(event){
        $formulario.submit();
      });
    });
</script>
@endsection
