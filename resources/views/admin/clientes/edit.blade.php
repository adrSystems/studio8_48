@extends('layouts.master')

@section('title')
Modificar cliente
@endsection

@section('css')
<style media="screen">
  body{
    background: #334;
  }
  .nav-bar{
    border-bottom: none;
    box-shadow: none;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .main-container{
    float: left;
    color: #bbb;
    width: 100%;
    margin-top: 100px;
    margin-bottom: 40px;
  }
  .footer{
    box-shadow: none;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .main-title{
    font-family: 'Lobster Two';
    color: #aaa;
  }
  .btn1{
    background: linear-gradient(to bottom, rgba(255, 255, 255, .09), rgba(255, 255, 255, .04));
    border: 1px solid #111;
    color: #ddd;
    text-shadow: 0 0 3px rgba(0, 0, 0, .8);
    padding: 3px 15px 5px 15px;
    font-size: 16px;
    border-radius: 3px;
    -webkit-transition: box-shadow .3s, color .4s, border .4s;
  }
  .btn1:hover{
    box-shadow: 0 1px 3px #000;
    color: gold;
    border-color: goldenrod;
  }
  .white-textbox{
    background-color: rgba(0,0,0,.05);
    box-shadow:inset 0 0 5px #000;
    border: 1px solid rgba(255, 255, 255, 0.4);
    color: #aaa;
    border-radius: 5px;
    padding: 4px 8px 4px 8px;
    margin-bottom: 10px;
    -webkit-transition: color .4s, background-color .3s, box-shadow .4s;
  }
  .white-textbox-xs{
    height: 35px;
    padding-bottom: 7px;
  }
  .white-textbox:hover{
    background-color: rgba(255,255,255,.03);
    border-color: rgba(255, 255, 255, 0.5);
    color: #ccc;
  }
  .white-textbox:focus{
    background-color: rgba(0,0,0,.1);
    box-shadow:inset 0 0 10px #000;
    color: #fff;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    outline: none;
  }
  .form-group>label{
    font-weight: 200;
    color: #aaa;
  }
  ::-webkit-clear-button {
    font-size: 14px;
    height: 28px;
    position: relative;
    right: 5px;
    margin-right: 4px;
  }
  ::-webkit-inner-spin-button {
    height: 30px;
    opacity: 0;
    background-color: transparent;
  }
  ::-webkit-calendar-picker-indicator {
    font-size: 12px;
    background-color: transparent;
  }
  ::-webkit-calendar-picker-indicator:hover{
    color:#fff;
  }
  ::-webkit-datetime-edit-month-field:focus {
    background-color: transparent;
    color: goldenrod;
  }
  ::-webkit-datetime-edit-day-field:focus {
    background-color: transparent;
    color: goldenrod;
  }
  ::-webkit-datetime-edit-year-field:focus {
    background-color: transparent;
    color: goldenrod;
  }
  .btn2{
    border: 0px solid rgba(255, 255, 255, 0.5);
    border-radius: 3px;
    background-color: rgba(255, 255, 255, 0.07);
    color: #ccc;
  }
  .btn1-xs{
    padding: 1px 5px 1px 5px;
    font-size: 13px;
  }
  .btn2:hover{
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
  }
  .btn2:visited{
    color: #eee;
  }
  .card{
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, .09);
    background-color: rgba(0, 0, 0, 0.5);
    padding: 0;
    padding-bottom: 15px;
    overflow: hidden;
  }
  .card>.header>h4{
    color: #fff;
    font-family: 'Lobster Two';
    padding: 15px;
    margin: 0;
  }
  .card>.header{
    background: linear-gradient(to bottom,rgba(255, 255, 255, 0.08),rgba(255, 255, 255, 0.04));
    margin:0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.35);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    padding: 15px;
    padding-left: 5%;
    padding-right: 5%;
    margin-bottom: 15px;
    width: 110%;
    margin-left: -5%;
  }
  #modificar-credito{
    float: left;
    background-color: rgba(255, 255, 255, 0.07);
  }
  .help-toggle{
    color: goldenrod;
    cursor: pointer;
    padding: 0;
  }
  .help-toggle:hover{
    color:gold;
  }
  .icon-btn{
    text-decoration: none;
    color: #def;
    cursor: pointer;
    display: table;
    padding: 4px 5px 0 5px;
    border-radius: 2px;
    margin-bottom: 10px;
    margin-left: 10px;
    float: right;
    -webkit-transition: color .4s, box-shadow .4s, text-shadow .6s, margin-right .6s, background-color .7s;
  }
  .icon-btn:active{
    color: #ddd;
  }
  .icon-btn:visited{
    color: #ddd;
  }
  .icon-btn:hover{
    color: #fff;
    text-decoration: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
  }
  .icon-square{
    background-color: dodgerblue;
  }
  .icon-btn>span{
    padding: 1px 5px 5px 5px;
    float: right;
  }
  .hr{
    height: 1px;
    float: left;
    margin-top: 15px;
    margin-bottom: 15px;
  }
  .white-hr{
    background-color: rgba(255, 255, 255, 0.2);
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12">
      <div class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0">
        <a href="/admin/clientes" class="icon-btn">
          <i class="material-icons">arrow_back</i>
          <span>Explorar todos los clientes</span>
        </a>
        <a href="/admin/clientes/info/{{$cliente->id}}" class="icon-btn">
          <i class="material-icons">arrow_back</i>
          <span>Información de {{$cliente->nombre}}</span>
        </a>
      </div>
      <div class="col-xs-12 col-md-6 col-md-offset-3 card">
        <div class="header">
          <h4>Modificar cliente</h4>
        </div>
        <div class="col-xs-12" style="padding:10px">
          <form class="form-vertical" action="/clientes/editar" method="post">
            <input type="hidden" name="id" value="{{$cliente->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" class="name" id="originalName" value="{{$cliente->nombre}}">
            <input type="hidden" class="lastName" id="originalLastName" value="{{$cliente->apellido}}">
            <input type="hidden" class="birthday" id="originalBirthday" value="{{$cliente->fecha_nacimiento}}">
            <input type="hidden" class="tel" id="originalPhone" value="{{$cliente->telefono}}">
            <input type="hidden" class="credito" id="originalCredito" value="{{$cliente->credito}}">
            @if(old('credito'))
            <input type="hidden" name="credito" value="{{boolval(old('credito'))}}">
            @else
            <input type="hidden" name="credito" value="{{$cliente->credito}}">
            @endif
            <div class="form-group">
              <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Nombre</label>
              <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
                <input type="text" name="name" value="@if(old('name')){{old('name')}}@else{{$cliente->nombre}}@endif" class="white-textbox col-xs-12" style="margin-right:5px;">
                <button type="button" name="name" class="btn2 btn1-xs descartar" style="float:right;">Descartar</button>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Apellido</label>
              <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
                <input type="text" name="lastName" value="@if(old('lastName')){{old('lastName')}}@else{{$cliente->apellido}}@endif" class="white-textbox col-xs-12" style="margin-right:5px;">
                <button type="button" name="lastName" class="btn2 btn1-xs descartar" style="float:right;">Descartar</button>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Fecha de nacimiento</label>
              <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
                <input type="date" name="birthday" value="@if(old('birthday')){{old('birthday')}}@else{{$cliente->fecha_nacimiento}}@endif" class="white-textbox col-xs-12" style="margin-right:5px;">
                <button type="button" name="birthday" class="btn2 btn1-xs descartar" style="float:right;">Descartar</button>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Celular/Telefono</label>
              <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
                <input type="tel" name="tel" value="@if(old('tel')){{old('tel')}}@else{{$cliente->telefono}}@endif" class="phone white-textbox col-xs-12" style="margin-right:5px;">
                <button type="button" name="tel" class="btn2 btn1-xs descartar" style="float:right;">Descartar</button>
              </div>
            </div>
            <div class="hr white-hr col-xs-12 col-md-10 col-md-offset-1"></div>
            <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
              <div class="form-group checkbox-container" style="padding:0; margin-bottom:5px">
                @if((old('credito') and old('credito') == 'true') or $cliente->credito)
                <div class="switch-container" id="modificar-credito" active="true">
                  <span>Activar credito</span>
                  <div class="switch-bar">
                    <div class="switch-btn active"></div>
                  </div>
                </div>
                @elseif((old('credito') and old('credito') == 'false') or (!$cliente->credito))
                <div class="switch-container" id="modificar-credito" active="false">
                  <span>Activar credito</span>
                  <div class="switch-bar">
                    <div class="switch-btn inactive"></div>
                  </div>
                </div>
                @endif
              </div>
              <button type="button" name="credito" class="btn2 btn1-xs" style="float:right;" id="descartar">Descartar</button>
            </div>
            <div class="form-group">
              <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
                <p class="help-toggle" id="credito-help" style="float:left;margin-top:5px">¿Que es esto?</p>
              </div>
            </div>
            <div class="form-group" style="width: 100%; float:left;margin-top:15px">
              <button type="submit" name="button" class="btn1 col-xs-12 col-md-6 col-md-offset-3">Aceptar</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
  $('.footer').css({
    position:'absolute',
    bottom:'0'
  });
}
else{
  $('.footer').css({
    position:'relative'
  });
}

$(document).ready(function () {

  $('#modificar-credito').click(function () {
    $('input[name=credito]').val($(this).attr('active'));
  })

  $('button.descartar').click(function () {
    $('input[name='+$(this).attr('name')+']').val($('input[type=hidden][class='+$(this).attr('name')+']').val());
  })

  $('button#descartar').click(function () {
    $('input[type=hidden][name=credito]').val('{{boolval($cliente->credito)}}');
    if($('input[type=hidden][name=credito]').val() == '1'){
      $('#modificar-credito>.switch-bar>.switch-btn').removeClass('inactive');
      $('#modificar-credito>.switch-bar>.switch-btn').addClass('active');
    }
    else{
      $('#modificar-credito>.switch-bar>.switch-btn').removeClass('active');
      $('#modificar-credito>.switch-bar>.switch-btn').addClass('inactive');
    }
  })

  $('#credito-help').click(function () {
    showMsg('Sobre el credito a clientes',[
      'Activando esta opción, se le permitirá al cliente pagar sus servicios en multiples pagos.',
      'Podrá cambiar esta opción en cualquier momento en las opciones del cliente.'
    ]);
  });

  $(window).resize(function () {
    if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
      $('.footer').css({
        position:'absolute',
        bottom:'0'
      });
    }
    else{
      $('.footer').css({
        position:'relative'
      });
    }
  })

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

})
</script>
@endsection
