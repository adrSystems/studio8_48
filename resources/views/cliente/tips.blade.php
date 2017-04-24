@extends('layouts.master')

@section('title')
Tips
@endsection

@section('css')
<style media="screen">
body{
  background-color: #fff;
}
.card2{
  background-color: #fff;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.14);
  border: 1px solid rgba(0, 0, 0, .2);
  border-radius: 5px;
  padding: 50px;
  color: #333;
  text-align: center;
}
.main-cover-fixed-container{
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
  text-shadow: 0 0 20px rgba(0, 0, 0, 0.62), 0 0 2px rgba(0, 0, 0, .8);
}
.main-cover-fixed-container>.info>.caption{
  font-size: 21px;
  text-shadow: 0 0 20px rgba(0, 0, 0, 0.62), 0 0 2px rgba(0, 0, 0, .8);
}
.main-container{
  background-color: #fff;
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
.imagen-item>.img-container>.info-toggle{
  border: 1px solid #eee;
  padding: 3px 10px 3px 10px;
  border-radius: 3px;
  position: absolute;
  bottom: 8px;
  margin-left: 15%;
  width: 70%;
  z-index: 1;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.2);
}
.imagen-item>.img-container>.info-toggle:hover{
  background-color: rgba(0, 0, 0, 0.5);
}
.dark-modal-back{
  position: fixed;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9);
  z-index: 4;
  box-shadow: inset 0 0 100px rgba(0, 0, 0, .9);
  display: none;
  padding: 50px;
  overflow: auto;
}
.dark-modal-back::-webkit-scrollbar{
  display: none;
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
  padding: 0;
  background-repeat: no-repeat;
  background-size: contain;
  background-position: center;
}
.dark-modal-back>.img-container>img{
  width: 100%;
}
.info>textarea{
  width: 100%;
  resize: none;
  height: auto;
  border: none;
  background-color: transparent;
  outline: none;
  display: table;
  margin-bottom: 45px;
}
</style>
@endsection

@section('body')
@foreach(\App\Tip::get() as $tip)
<div class="dark-modal-back" id="{{$tip->id}}">
    <i class="material-icons">close</i>
    <div class="img-container col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-2 col-lg-offset-5">
      <img src="{{asset('storage/'.$tip->src)}}" alt="">
    </div>
    <div class="info col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
      <h3 class="text-center clear-text1">{{$tip->titulo}}</h3>
      <textarea class="text-center clear-text3" disabled="true">{{$tip->contenido}}</textarea>
    </div>
</div>
@endforeach

<div class="main-cover-fixed-container">
  <img class="main-cover-fixed" src="{{asset("img/covers/3.jpg")}}">
  <div class="info">
    <div class="title">
      Tips de belleza
    </div>
    <div class="caption">
      Luce increible en cualquier momento...<br>
      No solo una noche
    </div>
  </div>
</div>

<div class="main-container">
  <div class="container">
    <div class="col-xs-12">
      <div class="col-xs-12">
        <h3 class="dark-text1">Tips</h3>
        <h4 class="dark-text3">Los mejores consejos... de los mejores...</h4>
      </div>
    </div>
    <div class="col-xs-12" style="margin-top:45px">
      @if(count($tips = App\Tip::get()) < 1)
      <div class="col-xs-12">
        <div class="card2 col-xs-12 col-md-6 col-md-offset-3">
          <h3 style="margin:0">Por el momento no se encontró contenido...</h3>
          <h4>Pronto estará disponible. Estate atento...</h4>
        </div>
      </div>
      @endif
      @foreach($tips as $tip)
      <div class="col-xs-12 col-sm-6 col-md-4" style="padding:15px">
        <div class="imagen-item">
          <div class="img-container">
            <img src="{{asset('storage/'.$tip->src)}}" alt="">
            <span class="servicio">{{$tip->titulo}}</span>
            <div class="shadow" id="{{$tip->id}}"></div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

  $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))

  $('.imagen-item>.img-container').height($('.imagen-item>.img-container').width())

  $(document).ready(function () {

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

    $('.imagen-item').css('opacity','1')

    $('.imagen-item>.img-container>.shadow').click(function () {
      $('.dark-modal-back[id='+$(this).attr('id')+"]").fadeIn(200)
    })

    $('.dark-modal-back>i').click(function () {
      $(this).parent().fadeOut(200);
    })

    $(window).scroll(function () {
      if($(this).scrollTop() > 200)
        $('.main-cover-fixed-container>.info').fadeOut(300)
      else $('.main-cover-fixed-container>.info').fadeIn(300)
    })

    $(window).resize(function () {
      $('.main-container').css('margin-top', $('.main-cover-fixed-container').outerHeight(true))
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

  })
</script>
@endsection
