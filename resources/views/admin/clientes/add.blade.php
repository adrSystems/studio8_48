@extends('layouts.master')

@section('title')
Registro de cliente
@endsection

@section('css')
<style media="screen">
body{
  background-color: #445;
}
.footer{
  background-color: rgba(0, 0, 0, 0.5);
  box-shadow: none;
}
.nav-bar{
  background-color: rgba(0, 0, 0, 0.5);
  border-bottom: none;
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
#add-btn{
  display: block;
  margin: auto;
  margin-top: 20px;
}
.main-container{
  margin-top: 100px;
  width: 100%;
  float: left;
  margin-bottom: 50px;
}
.btn1{
  background: linear-gradient(to bottom, rgba(255, 255, 255, .09), rgba(255, 255, 255, .04));
  border: 1px solid rgba(0, 0, 0, 0.7);
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
.checkbox-container>input{
  margin-top: 10px;
}
.checkbox-container>span{
  color: #ccc;
  position: absolute;
  font-size: 14px;
  left: 20px;
  top: 5px;
}
.help-toggle{
  color: goldenrod;
  cursor: pointer;
  padding: 0;
}
.help-toggle:hover{
  color:gold;
}
.btn2{
  border: 1px solid rgba(255, 255, 255, 0.5);
  color: #ccc;
}
.btn2:hover{
  border: 1px solid rgba(255, 255, 255, 0.8);
  background-color: rgba(255, 255, 255, 0.1);
  color: #fff;
}
.btn2:visited{
  color: #eee;
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
.icon-btn>span{
  padding: 1px 5px 5px 5px;
  float: right;
}
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0 5px 0 5px;">
    <a href="/admin/clientes" class="icon-btn">
      <i class="material-icons">arrow_back</i>
      <span>Volver a todos los clientes</span>
    </a>
  </div>
  <div class="col-xs-12" style="padding: 0 5px 0 5px">
    <div class="col-xs-12 col-md-6 col-md-offset-3 card">
      <div class="header">
        <h4>Datos del nuevo cliente</h4>
      </div>
      <div class="col-xs-12">
        <form class="form-vertical" action="/clientes/agregar" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Nombre</label>
            <input type="text" name="name" value="{{old('name')}}" class="white-textbox col-xs-12 col-xs-12 col-md-10 col-md-offset-1">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Apellido</label>
            <input type="text" name="lastName" value="{{old('lastName')}}" class="white-textbox col-xs-12 col-md-10 col-md-offset-1">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Fecha de nacimiento</label>
            <input type="date" name="birthday" value="{{old('birthday')}}" class="white-textbox col-xs-12 col-md-10 col-md-offset-1">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Celular o Telefono</label>
            <input type="tel" name="tel" value="{{old('tel')}}" class="white-textbox col-xs-12 col-md-10 col-md-offset-1 phone">
          </div>
          <div class="form-group col-xs-12 col-md-10 col-md-offset-1 checkbox-container" style="padding:0; margin-bottom:0">
            @if(old('credito'))
            <input type="checkbox" name="credito" class="" checked="true"><span>Activar credito</span>
            @else
            <input type="checkbox" name="credito" class=""><span>Activar credito</span>
            @endif
          </div>
          <div class="form-group">
            <p class="help-toggle col-xs-12 col-md-10 col-md-offset-1" id="credito-help">¿Que es esto?</p>
          </div>
          <div class="form-group" style="width: 100%; float:left;margin-top:15px">
            <button type="submit" name="button" class="btn1 col-xs-12 col-md-6 col-md-offset-3">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
if($('.main-container').height() + 260 < $(window).height()){
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

  $('#credito-help').click(function () {
    showMsg('Sobre el credito a clientes',[
      'Activando esta opción, se le permitirá al cliente pagar sus servicios en multiples pagos.',
      'Podrá cambiar esta opción en cualquier momento en las opciones del cliente.'
    ]);
  });

  $(window).resize(function () {
    if($('.main-container').height() + 260 < $(window).height()){
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
});
</script>
@endsection
