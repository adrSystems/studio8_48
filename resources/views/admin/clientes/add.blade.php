@extends('layouts.master')

@section('title')
Registro de cliente
@endsection

@section('css')
<style media="screen">
#add-container{
  padding: 0;
  overflow:hidden;
  color: #578;
  background-color: #222;
  border-radius: 3px;
  border: 1px solid #333;
  box-shadow: 0 0 10px rgba(0, 0, 0, 1);
  margin-bottom: 15px;
}
#add-container>.header>h4{
  color: #fff;
  font-family: 'Lobster Two';
  padding: 15px;
  margin: 0;
}
#add-container>.header{
  background-color: #111;
  margin:0;
  box-shadow: inset 0 -1px 5px #000;
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
  background: linear-gradient(to bottom, #444, #222);
  border: 1px solid goldenrod;
  color: gold;
  text-shadow: 0 0 3px rgba(0, 0, 0, .8);
  padding: 3px 15px 5px 15px;
  font-size: 16px;
  border-radius: 3px;
  -webkit-transition: box-shadow .3s;
}
.btn1:hover{
  box-shadow: 0 1px 3px #000;
}
.white-textbox{
  background-color: rgba(0,0,0,.05);
  box-shadow:inset 0 0 5px #000;
  border: 1px solid #333;
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
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0 5px 0 5px; margin-top: 15px; margin-bottom: 15px;">
    <a href="/admin/clientes" class="btn btn-xs btn2">< Volver a todos los clientes</a>
  </div>
  <div class="col-xs-12" style="padding: 0 5px 0 5px">
    <div class="col-xs-12 col-md-6 col-md-offset-3" id="add-container">
      <div class="header">
        <h4>Datos del nuevo cliente</h4>
      </div>
      <div class="col-xs-12">
        <form class="form-vertical" action="/clientes/agregar" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0">Nombre</label>
            <input type="text" name="name" value="{{old('name')}}" class="white-textbox col-xs-12 col-md-6 col-md-offset-3">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0">Apellido</label>
            <input type="text" name="lastName" value="{{old('lastName')}}" class="white-textbox col-xs-12 col-md-6 col-md-offset-3">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0">Fecha de nacimiento</label>
            <input type="date" name="birthday" value="{{old('birthday')}}" class="white-textbox col-xs-12 col-md-6 col-md-offset-3">
          </div>
          <div class="form-group">
            <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="padding:0">Celular o Telefono</label>
            <input type="tel" name="tel" value="{{old('tel')}}" class="white-textbox col-xs-12 col-md-6 col-md-offset-3">
          </div>
          <div class="form-group col-xs-12 col-md-6 col-md-offset-3 checkbox-container" style="padding:0; margin-bottom:0">
            @if(old('credito'))
            <input type="checkbox" name="credito" class="" checked="true"><span>Activar credito</span>
            @else
            <input type="checkbox" name="credito" class=""><span>Activar credito</span>
            @endif
          </div>
          <div class="form-group">
            <p class="help-toggle col-xs-12 col-md-6 col-md-offset-3" id="credito-help">¿Que es esto?</p>
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
      'Activando esta opción, se le permitirá al cliente realizar los pagos de sus servicios en multiples pagos.',
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
