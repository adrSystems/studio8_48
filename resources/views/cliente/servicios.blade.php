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
  .card2{
    background: #fff;
    border-radius: 3px;
    box-shadow: inset 0 0 3px rgba(0, 0, 0, .1);
    border: 1px solid rgba(0, 0, 0, .1);
    padding: 15px;
  }
</style>
@endsection
@section('body')
<div class="main-cover-fixed-container">
  <img class="main-cover-fixed" src="{{asset("img/covers/6.jpg")}}">
  <div class="info">
    <div class="title" id="main-title1">
      Catálogo de servicios
    </div>
    <div class="caption" id="main-sub1">
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
      @if(App\Servicio::count() < 1 )
      <div class="col-xs-12" style="padding-bottom:22px">
        <div class="card2">
          <h3 class="dark-text2">Por el momento no hay ningun servicio disponible.</h3>
          <h4 class="dark-text3">¡Gracias por visitarnos!</h4>
          <i class="material-icons">mood</i>
        </div>
      </div>
      @else
      @foreach(App\Servicio::get() as $servicio)
        <div class="col-sm-6 col-md-3">
          <div class="servicio">
            <div class="img-container">
              <span>${{$servicio->precio}}</span>
              <img src="{{asset($servicio->icono)}}" alt="...">
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

$(window).on('load',function () {
  $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

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
})

  $('.img-container').height($('.img-container').width())

  if($(window).width() < 768){
    $('.main-cover-fixed-container').css('padding-top','60px')
    $('#main-title1').css({
      'font-size':'16px',
      'margin-top':'30px',
      'text-shadow':'0 0 3px rgba(0,0,0,.8)'
    })
    $('#main-sub1').css({
      'font-size':'14px',
      'text-shadow':'0 0 3px rgba(0,0,0,.8)'
    })
  }
  else {
    $('.main-cover-fixed-container').css('padding-top','0px')
    $('#main-title1').css({
      'font-size':'28px',
      'margin-top':'0px'
    })
    $('#main-sub1').css({
      'font-size':'21px'
    })
  }



  $(document).ready(function () {

    $('.img-container').height($('.img-container').width())

    $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

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

    $(window).scroll(function () {
      if($(this).scrollTop() > 200)
        $('.main-cover-fixed-container>.info').fadeOut(300)
      else $('.main-cover-fixed-container>.info').fadeIn(300)
    })

    $(window).resize(function () {
      $('.img-container').height($('.img-container').width())
      if($(window).width() < 768){
        $('.main-cover-fixed-container').css('padding-top','60px')
        $('#main-title1').css({
          'font-size':'16px',
          'margin-top':'30px',
          'text-shadow':'0 0 3px rgba(0,0,0,.8)'
        })
        $('#main-sub1').css({
          'font-size':'14px',
          'text-shadow':'0 0 3px rgba(0,0,0,.8)'
        })
      }
      else {
        $('.main-cover-fixed-container').css('padding-top','0px')
        $('#main-title1').css({
          'font-size':'28px',
          'margin-top':'0px'
        })
        $('#main-sub1').css({
          'font-size':'21px'
        })
      }
      $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))
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
    })

  })
</script>
@endsection
