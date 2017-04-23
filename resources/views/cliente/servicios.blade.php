@extends('layouts.master')
@section('title')
Catalogo de servicios
@endsection
@section('css')
<style media="screen">
  body{
    background-color: #fff;
  }
  .servicio{
    margin-top: 10px;
    background-color: white;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  }
  .servicio>.img-container{
    position: relative;
    width: 100%;
    height: 60%;
    overflow: hidden;
    border-radius: 2px;
  }
  .img-container>img{
    width: 100%;
  }
  .descripcion{
    text-align: center;
    padding: 10px;
    width: 100%;
  }
  .modal-body{
    display: inline-block;
    width: 100%;
  }
  .vacia{
    width: 100%;
    padding: 50px;
    color: #1F1F1F;
    font-size: 26px;
    background-color: rgba(255, 255, 255, 0.6);
    text-align: center;
    border-radius: 4px;
  }
  .main-container{
    background-color: #fff;
    z-index: 1;
    margin-top: 100px;
  }
  .main-cover-fixed-container{
    padding-top: 60px;
    background-color: #222;
  }
  .main-cover-fixed-container>.info{
    color: #fff;
    position: absolute;
    z-index: 1;
    top: 25%;
    left: 10%;
  }
  .main-cover-fixed-container>.info>.title{
    font-size: 28px;
    font-weight: 900;
  }
  .main-cover-fixed-container>.info>.caption{
    font-size: 21px;
  }
  .servicio>.img-container>span{
    position: absolute;
    top: 5px;
    left: 5px;
    background-color: dodgerblue;
    color: #fff;
    border-radius: 3px;
    padding: 0 3px 1px 3px;
  }
</style>
@endsection
@section('body')
<div class="main-cover-fixed-container">
  <img class="main-cover-fixed" src="{{asset("img/covers/6.jpg")}}">
  <div class="info">
    <div class="title">
      Catálogo de servicios
    </div>
    <div class="caption">
      Explora los servicios de la mas alta calidad <br> que tenemos para ti.
    </div>
  </div>
</div>

<div class="main-container">
  <div class="container">
    <div class="col-xs-12">
      <h3 class="col-xs-12" style="color:#333;margin-bottom:0">Servicios</h3>
      <h4 class="col-xs-12" style="color:#888">Explora los servicios de la mas alta calidad que tenemos para ti.</h4>
    </div>
    <div class="catalogo col-xs-12">
      @if(App\servicio::count() < 1 )
      <div class="vacia">
        <p>Por el momento no hay ningun servicio disponible.</p>
        <p>¡Gracias por visitarnos!</p>
        <i class="material-icons">mood</i>
      </div>
      @else
      @foreach(App\Servicio::get() as $servicio)
        <div class="col-sm-6 col-md-3">
          <div class="servicio">
            <div class="img-container">
              <span>${{$servicio->precio}}</span>
              <img src="{{asset('storage/'.$servicio->icono)}}" alt="...">
            </div>
            <div class="descripcion">
              <h5 style="color:#333">{{$servicio->nombre}}</h5>
              @if($promocion = $servicio->promociones()
              ->whereDate('fecha_inicio','<=',\Carbon\Carbon::now()->format('Y-m-d'))
              ->whereDate('fecha_termino','>=',\Carbon\Carbon::now()->format('Y-m-d'))->first())
              <p>
                <span style="color: #f87">Aprovecha la promocion del -{{$promocion->descuento}}%</span>
                <br>
                <span style="color:#aaa">
                  Vigencia al {{date('d \d\e ',strtotime($promocion->fecha_termino)).
                  ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"][date('n',strtotime($promocion->fecha_termino))-1]
                  .date(' \d\e\l Y',strtotime($promocion->fecha_termino))}}
                </span>
              </p>
              @endif
            </div>
          </div>
        </div>
      @endforeach
      @endif
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

  $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

  $(document).ready(function () {

    if($('.main-container').outerHeight(true) + $('body').children('.footer').outerHeight(true) <= $(window).height()){
      $('body').children('.footer').css({
        position:'absolute',
        bottom:'0'
      });
    }
    else{
      $('body').children('.footer').css({
        position:'relative'
      });
    }

    $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

    $(window).scroll(function () {
      if($(this).scrollTop() > 200)
        $('.main-cover-fixed-container>.info').fadeOut(300)
      else $('.main-cover-fixed-container>.info').fadeIn(300)
    })

    $(window).resize(function () {
      $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))
    })

  })
</script>
@endsection
