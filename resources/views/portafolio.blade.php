@extends('layouts.master')

@section('title')
Portafolio
@endsection

@section('css')
<style media="screen">
  body{
    background-color: #fff;
  }
  .card2{
    border-radius: 3px;
    float: left;
    width: 100%;
    border: 1px solid rgba(0, 0, 0, .17);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 15px;
  }
  .card2>.header{
    padding: 15px;
    margin: 0;
    float: left;
    width: 100%;
    text-align: center;
    color: #fff;
    background-color: #333;
  }
  .card2>.header>h4{
    margin: 0;
    font-family: 'Lobster Two';
  }
  .menu-item1{
    width: 100%;
    padding: 5px 10px 5px 10px;
    float: left;
    text-align: center;
  }
  .menu-item1-active{
    font-weight: 900;
  }
  .menu-item1:hover{
    background-color: rgba(0, 0, 0, .05);
  }
  .card2>.body{

  }
  p.empty-msg{
    margin: 0;
    padding: 20px;
    text-align: center;
    color: #888;
  }
  .imagen-item{
    width: 100%;
    float: left;
    cursor: pointer;
    opacity: 0;
    -webkit-transition: opacity .7s;
  }
  .imagen-item>.img-container{
    width: 100%;
    position: relative;
    float: left;
    overflow: hidden;
  }
  .imagen-item>.img-container>.shadow{
    width: 100%;
    position: absolute;
    height: 100%;
    background-color: transparent;
    top: 0;
    left: 0;
    -webkit-transition: box-shadow .4s, background-color .4s;
  }
  .imagen-item>.img-container:hover .shadow{
    background-color: rgba(0, 0, 100, 0.1);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.8);
  }
  .imagen-item>.img-container:hover img{
    -webkit-transform: scale(1.1);
  }
  .imagen-item>.img-container>img{
    width: 100%;
    -webkit-transition: -webkit-transform .4s;
  }
  .imagen-item>.img-container>.servicio{
    position: absolute;
    top: 3px;
    left: 3px;
    background-color: dodgerblue;
    border-radius: 3px;
    color: #fff;
    padding: 0 3px 0 3px;
  }
  .dark-modal-back{
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 4;
    box-shadow: inset 0 0 100px rgba(0, 0, 0, .9);
    display: none;
    padding-left: 39px;
    padding-right: 39px;
  }
  .dark-modal-back>i{
    font-size: 32px;
    color: #eee;
    position: absolute;
    top: 13px;
    right: 7px;
    cursor: pointer;
  }
  .dark-modal-back>.img-container{
    height: 100%;
    padding: 0;
    background-image: url("{{asset('img/covers/1.jpg')}}");
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
  }
  .dark-modal-back>.img-container>img{
    width: 100%;
  }
</style>
@endsection
@section('body')
<div class="dark-modal-back">
    <i class="material-icons">close</i>
    <div class="img-container col-xs-12 col-md-6 col-md-offset-3">
    </div>
</div>

<div class="main-container">
    <div class="container">
      <div class="col-xs-12" style="margin-bottom:15px">
        <h3 class="dark-text1">Portafolio</h3>
        <h4 class="dark-text3">Mira nuestros mejores trabajos!</h4>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="card2">
          <div class="header">
            <h4>Filtros</h4>
          </div>
          <div class="body">
            <a href="/portafolio">
              <div class="menu-item1 @if(!isset($servicio)){{'menu-item1-active'}}@endif">Todos</div>
            </a>
            @foreach(\App\Servicio::with('portafolio')->get() as $serv)
              @if($serv->portafolio()->count() > 0)
              <a href="/portafolio/{{$serv->id}}">
                <div class="menu-item1 @if(isset($servicio) and $servicio->id == $serv->id){{'menu-item1-active'}}@endif">
                  <p style="margin:0">{{$serv->nombre}} <span>({{$serv->portafolio()->count()}})</span></p>
                </div>
              </a>
              @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-9">
        <div class="card2">
          @if(isset($servicio))
            @if($servicio->portafolio()->count() < 1)
            <p class="empty-msg">No se encontraron imagenes... El contenido pronto estará disponible!</p>
            @else
              @foreach($servicio->portafolio as $imagen)
              <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
                <div class="imagen-item">
                  <div class="img-container">
                    <img src="{{asset('storage/'.$imagen->src)}}" alt="">
                    <div class="shadow"></div>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          @else
            @if(count($imagenes = \App\Imagen::get()) < 1)
            <p class="empty-msg">No se encontraron imagenes... El contenido pronto estará disponible!</p>
            @else
              @foreach($imagenes as $imagen)
              <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
                <div class="imagen-item">
                  <div class="img-container">
                    <img src="{{asset('storage/'.$imagen->src)}}" alt="">
                    <span class="servicio">{{$imagen->servicio->nombre}}</span>
                    <div class="shadow"></div>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          @endif
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

  $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())

  $(document).ready(function () {

    $('.imagen-item').css('opacity','1')

    $(window).resize(function () {
      $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())
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

    $('.imagen-item').click(function () {
      var src = $(this).children('.img-container').children('img').attr('src');
      $('.dark-modal-back>.img-container').css('background-image','url('+src+')')
      $('.dark-modal-back').fadeIn(200)
    })

    $('.dark-modal-back>i').click(function () {
      $(this).parent().fadeOut(200);
    })

  })
</script>
@endsection
