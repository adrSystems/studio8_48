@extends('layouts.master')

@section('title')
Profesionales
@endsection

@section('css')
<style type="text/css">
  html, body{
    height: 100%;
  }
  body{
    color:#c5b358;
    background-color: #fff;
    font-family: 'Lato';
    background-repeat: no-repeat;
  }
  h4{
    color:#c5b358;
    font-family: 'Lato';
  }
  .img-container{
    overflow: hidden;
    width: 100%;
  }
  .img-container-circle{
    border-radius: 100%;
  }
  .img-container:hover img{
    -webkit-transform: scale(1.1);
  }
  .img-container>img{
    width: 100%;
    -webkit-transition: -webkit-transform .5s;
  }
  .btn1{
    cursor: pointer;
    border: 1px solid dodgerblue;
    border-radius: 4px;
    padding: 5px;
    color: dodgerblue;
    text-decoration: none;
    -webkit-transition: background-color .5s, color .5s, padding .2s;
  }
  .btn1:hover{
    background-color: dodgerblue;
    color: #fff;
    padding-left: 10px;
    padding-right: 10px;
  }
  .card2{
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    float: left;
  }
  .card2>.info{
    padding: 15px;
    float: left;
    width: 100%;
  }
  .card2>.info>.title{
    margin: 0;
    text-align: center;
    margin-bottom: 10px;
    color: #111;
  }
  #information-container{
    color: #333;
  }
  .black-container{
    background-color: #222;
    padding: 20px;
    padding-bottom: 30px;
  }
  .main-container{
    background-color: #fff;
    z-index: 1;
    margin-top: 100px;
  }
</style>
@endsection

@section('body')
<div class="main-cover-fixed-container">
  <img class="main-cover-fixed" src="{{asset("img/covers/team.jpg")}}">
</div>

<div class="main-container">
  <div class="container">
    <div class="col-xs-12">
      <h2 class="col-xs-12" style="color:#333">Sobre nosotros</h2>
        <div class="col-xs-12">
          <p class="dark-text3">En Studio 8 48, te brindamos el mejor servicio con gente experta en la belleza y el cuidado personal de tu cabello, productos inovadores, marcando una tendencia, un nuevo concepto.</p>
        </div>
    		<div class="col-xs-12 col-md-6">
          <div class="card2" style="padding:15px;margin-bottom:15px">
            <h3 style="margin-top:5px" class="dark-text1">Mision</h3>
      			<p class="dark-text3">Satisfacer las necesidades de belleza de nuestros clientes mediante servicios de excelencia en calidad, brindado por personal altamente profesional que inspira confianza y seriedad, permitiéndonos superar las expectativas de nuestros clientes.</p>
          </div>
    		</div>
    		<div class="col-xs-12 col-md-6">
          <div class="card2" style="padding:15px;margin-bottom:15px">
            <h3 style="margin-top:5px" class="dark-text1">Vision</h3>
      			<p class="dark-text3">Ser la corporación líder en la satisfacción de necesidades de belleza a nivel local. Incursionar en el mercado nacional.</p>
          </div>
    		</div>
    </div>
    <h2 style="font-weight:100;color:#222;margin-bottom:22px;padding-left:30px;padding-right:30px;margin-top:40px;float:left" id="profesionales">Profesionales</h2>
    <div class="col-xs-12">
    @foreach(App\Empleado::with('roles')->get() as $empleado)
    @if($empleado->roles()->where('nombre','estilista')->first())
    <div class="col-xs-12 col-md-3">
      <div class="card2 col-xs-12" style="padding:0">
        <div class="img-container">
          <img src="{{asset('storage/'.$empleado->fotografia)}}">
        </div>
        <div class="info">
          <h4 class="title">{{$empleado->nombre}}</h4>
          @foreach($empleado->roles as $rol)
          <p align="center" style="color:#555">{{ucfirst($rol->nombre)}}</p>
          @endforeach
          <span data-toggle="modal" data-target="#id_modal{{$empleado->id}}" class="btn1 center est-info-toggle">Ver mas información</span>
          <div class="modal fade" id="id_modal{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="exampleModalLongTitle">{{$empleado->nombre}} {{$empleado->apellido}}</h4>
                </div>
                <div class="modal-body col-xs-12">
                  <div class="col-xs-12 col-md-6">
                  <div class="img-container img-container-circle">
                    <img src="{{asset('storage/'.$empleado->fotografia)}}">
                  </div>
                  </div>
                  <div class="col-xs-12 col-md-6" id="information-container">
                    <h4>Informacion</h4>
                    <p>{{$empleado->info}}</p>
                    <h5>Fecha de nacimiento: {{$empleado->fecha_nacimiento}}</h5>
                    <h5>Puesto:</h5>
                    @foreach($empleado->roles as $rol)
                    <h5>{{ucfirst($rol->nombre)}}</h5>
                    @endforeach
                  </div>
                </div>
                <div class="modal-footer">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    @endforeach
    </div>
    <h2 style="font-weight:100;color:#222;margin-bottom:22px;padding-left:30px;padding-right:30px;margin-top:40px;float:left" id="contacto">Contacto</h2>
    <div class="col-xs-12" style="padding-left:30px;padding-right:30px">
      <div class="col-xs-12 black-container">
        <h4 class="col-xs-12 white-text" style="margin-bottom:15px;">Horarios de atencion y ubicación</h4>
        <div class="col-xs-12 col-md-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3600.7093263745246!2d-103.3973299853978!3d25.51473898374938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdc82eca2a825%3A0x6556f4bfe829fdf9!2zTWlzacOzbiwgMjcyNzIgVG9ycmXDs24sIENvYWgu!5e0!3m2!1ses-419!2smx!4v1490672746278" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-xs-12 col-md-4">
            <h3 class="white-text">Studio 8 48</h3>
            <p class="gold-text" style="font-weight:lighter;">Av. Misión Sta. Ma las misiones (a un costado de Intermall) Torreón Coahuila</p>
            <p class="gold-text" style="font-weight:lighter;">Telefono:<br><span class="white-text">01 871 730 1803</span></p>
            <p class="gold-text" style="font-weight:lighter;">Horario de atencion:<br> <span class="white-text">Lunes a Sabado de 10:00 am - 8:00 pm</span></p>
        </div>
        <div class="col-xs-12 col-md-4">
            <h3 class="white-text">Siguenos:</h3><br>
            <div class="col-xs-12 col-md-12">
            <a href="https://twitter.com/Studio848" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="large">Seguir a @Studio848</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="fb-like" data-href="https://www.facebook.com/Studio-8-48-358835230878580/" data-layout="box_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </div>
            <div id="fb-root"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

  $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

  $.each($('.img-container') ,function (i, e) {
    $(e).height($(e).width());
  })

  $(document).ready(function () {

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    $('.est-info-toggle').click(function () {
      setTimeout(function () {
        $.each($('.img-container') ,function (i, e) {
          $(e).height($(e).width());
        })
      }, 200)
    })

    $(window).resize(function () {
      $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))
      $.each($('.img-container') ,function (i, e) {
        if($(e).hasClass('img-container-circle')){
          $(e).height($(e).width());
        }
      })
    })

  })
</script>
@endsection
