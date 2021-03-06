@extends('layouts.master')

@section('title')
Nueva cita
@endsection

@section('css')
<style media="screen">
  body{
    background-color: #334;
  }
  .footer{
    background-color: #223;
    box-shadow: none;
  }
  .nav-bar{
    background-color: #223;
    box-shadow: none;
    border-bottom-color: transparent;
  }
  .card{
    padding-bottom: 30px;
    margin-bottom: 15px;
  }
  .main-title{
    margin-right: 0;
    float: left;
    color: #fff;
  }
  .main-container{
    padding: 0;
  }
  label{
    font-weight: lighter;
  }
  .container{
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    margin-bottom: 5px;
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
  .servicio-item{
    display: table;
    cursor: pointer;
    margin-bottom: 15px;
    border: 1px dashed rgba(255, 255, 255, .1);
    border-radius: 3px;
    -webkit-transition: border .4s, background-color .4s;
  }
  .servicio-item:hover{
    border: 1px dashed rgba(255, 255, 255, .2);
    background-color: rgba(255, 255, 255, .05);
  }
  .servicio-item>.info{
    float: left;
    margin-left: 10px;
    width: auto;
    font-size: 13px;
  }
  .servicio-item>.img-container{
    position: relative;
    float: left;
    height: 8.5vh;
    width: 8.5vh;
    overflow: hidden;
    border-radius: 2px;
  }
  .servicio-item>.img-container>img{
    width: 100%;
  }
  .servicio-item>.img-container>.shadow{
    position: absolute;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    height: 100%;
    width: 100%;
    display: none;
  }
  .servicio-item>.img-container>.shadow>i{
    position: relative;
    background-color: rgba(0, 0, 0, 0.5);
    margin-top: 30%;
    height: 40%;
    margin-left: 30%;
    width: 40%;
    text-align: center;
    border-radius: 100%;
  }
  .estilista-item{
    border: 1px dashed  rgba(255, 255, 255, 0.2);
    border-radius: 3px;
    cursor: pointer;
    margin-bottom: 15px;
  }
  .estilista-item:hover{
    border-color: rgba(255, 255, 255, 0.3);
  }
  .estilista-item>.img-container{
    position: relative;
    width: 100%;
    overflow: hidden;
  }
  .estilista-item>.img-container>.shadow{
    position: absolute;
    background-color: rgba(0, 40, 20, 0.4);
    z-index: 1;
    height: 100%;
    width: 100%;
    display: none;
  }
  .estilista-item>.img-container>.inactive{
    background-color: rgba(30, 30, 30, 0.6);
    position: absolute;
    z-index: 1;
    height: 100%;
    width: 100%;
    display: none;
  }
  .estilista-item>.img-container>.shadow>i{
    position: relative;
    background-color: rgba(0, 0, 0, 0.5);
    margin-top: 30%;
    height: 40%;
    margin-left: 30%;
    width: 40%;
    text-align: center;
    border-radius: 100%;
  }
  .estilista-item>.img-container>img{
    width: 100%;
  }
  .estilista-item>.name{
    padding: 5px;
    background-color: rgba(255, 255, 255, .1);
  }
  .help-toggle{
    cursor: pointer;
    width: auto;
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 2px;
    float: right;
    padding-left: 5px;
    padding-right: 5px;
    -webkit-transition: color .4s;
  }
  .help-toggle:hover{
    color:#ddd;
  }
  .options-container{
    background-color: rgba(0, 0, 0, 0.08);
    border-radius: 2px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    display: table;
    margin-bottom: 10px;
  }
  .options-container>.option-item{
    float: left;
    padding: 4px 8px 4px 8px;
    cursor: pointer;
  }
  .options-container>.option-item:hover{
    background-color: rgba(255, 255, 255, 0.04);
  }
  .options-container>.option-item-middle{
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
  }
  .options-container>.active{
    background-color: #334;
    color: #ddd;
  }
  th{
    font-weight: 100;
    color: white;
  }
  td{
    padding-top: 6px;
    padding-bottom: 6px;
  }
  table{
    width: 100%;
  }
  .icon-btn1{
    cursor: pointer;
    background: rgba(255, 255, 255, 0.1);
    display: block;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    margin: auto;
    color: rgba(255, 255, 255, 0.6);
  }
  .icon-btn1:hover{
    color: rgba(255, 255, 255, 0.95);
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12" style="">
    <h3 class="main-title" style="">Nueva cita para {{$cliente->nombre}}</h3>
  </div>
  <div class="col-xs-12">
    <a href="/admin/clientes" class="icon-btn">
      <i class="material-icons">arrow_back</i>
      <span>Volver a todos los clientes</span>
    </a>
    <a href="/admin/clientes/info/{{$cliente->id}}" class="icon-btn">
      <i class="material-icons">arrow_back</i>
      <span>Detalles de {{$cliente->nombre}}</span>
    </a>
  </div>
  <div class="col-xs-12 col-md-5">
    <div class="card">
      <div class="header">
        <h4>Citas de hoy</h4>
      </div>
      <div class="body">
        @if(\App\Cita::whereDate('fecha_hora',date('Y-m-d'))->count() < 1)
        <p style="text-align:center;padding-top:10px;margin-bottom:0;">No se encontraron citas programadas.</p>
        @else
        <table id="table-citas">
          <thead>
            <th style="padding-left:10px">Cliente</th>
            <th>Estilista</th>
            <th>Hora</th>
            <th>Estado</th>
            <th></th>
          </thead>
          <tbody>
            @foreach(\App\Cita::whereDate('fecha_hora',date('Y-m-d'))->get() as $cita)
            <tr class="" style="width:100%">
              <td style="padding-left:10px">{{$cita->cliente->nombre." ".$cita->cliente->apellido}}</td>
              <td>{{$cita->empleado->nombre." ".$cita->empleado->apellido}}</td>
              <td>{{date('H:i',strtotime($cita->fecha_hora))}}</td>
              <td>{{$estados[$cita->estado]}}</td>
              <td>
                <i class="material-icons icon-btn1">info</i>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-7">
    <div class="card">
      <div class="header">
        <h4>Datos de la cita</h4>
      </div>
      <div class="body">
        <form class="form-vertical" action="/admin/citas/agregar" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="cliente" value="{{$cliente->id}}">
          <input type="hidden" name="estilista" value="{{old('estilista')}}">
          <input type="hidden" name="today" value="@if(old('today')){{old('today')}}@else{{'1'}}@endif">
          <input type="hidden" name="tomorrow" value="{{old('tomorrow')}}">
          <input type="hidden" name="now" value="@if(old('now')){{old('now')}}@else{{'1'}}@endif">
          <div class="form-group" style="padding:15px;">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Selecciona la Fecha</label>
            <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
              <div class="options-container">
                <div class="option-item active" id="today">Hoy</div>
                <div class="option-item option-item-middle" id="tomorrow">Mañana</div>
                <div class="option-item" id="other">Otra</div>
              </div>
            </div>
            <input type="date" name="date" value="{{old('date')}}" class="textbox1 col-xs-12 col-md-10 col-md-offset-1" style="display:none">
          </div>
          <div class="form-group" style="padding:15px;">
            <label for="" class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">Selecciona la hora</label>
            <div class="col-xs-12 col-md-10 col-md-offset-1" style="padding:0">
              <div class="options-container">
                <div class="option-item active" id="now">Ahora mismo</div>
                <div class="option-item" id="otherTime">Otra</div>
              </div>
            </div>
            <input type="time" name="time" value="{{old('time')}}" class="textbox1 col-xs-12 col-md-10 col-md-offset-1" style="display:none">
          </div>
          <h5 class="col-xs-12 col-md-10 col-md-offset-1">Servicios a aplicar</h5>
          <div class="col-xs-12">
            <div class="container col-xs-12 col-md-offset-1 col-md-10" style="padding-top:15px">
              @if(\App\Servicio::count() < 1)
              <p style="">No se encontraron servicios. Agrega servicios para poder agregar una cita.</p>
              @else
              @foreach(\App\Servicio::get() as $servicio)
              <div class="servicio-item col-xs-12 col-sm-6" style="padding:0">
                <div class="img-container">
                  <div class="shadow" id="{{$servicio->id}}">
                    <i class="material-icons">check</i>
                  </div>
                  <img src="{{asset($servicio->icono)}}" alt="">
                </div>
                <div class="info">
                  <span style="color:#ddd;font-size:14px;">{{$servicio->nombre}}</span><br>
                  ${{$servicio->precio}} pesos<br>
                    Tiempo aprox: {{date('G:i',strtotime($servicio->tiempo))}}
                </div>
              </div>
              @endforeach
              @endif
            </div>
            <p style="text-align:right;padding:0" id="servicios-info" class="col-xs-12 col-md-10 col-md-offset-1"></p>
          </div>
          <div class="col-xs-12" style="padding:0" id="estilistas-container">
            <h5 class="col-xs-12 col-md-10 col-md-offset-1">Estilista de preferencia</h5>
            <div class="col-xs-12">
              <div class="container col-xs-12 col-md-offset-1 col-md-10" style="padding: 0;padding-top: 15px;">
                @if(count($rol = \App\Rol::with(['empleados.cuenta' => function($query){
                  $query->where('active','1');
                }])->where('nombre','estilista')->first()) < 1)
                <p style="margin: 0px;padding:15px;padding-top:0">No se encontraron estilistas. Agrega estilistas para poder agregar una cita.</p>
                @else
                @foreach($rol->empleados as $estilista)
                <div class="col-xs-12 col-md-4 col-sm-4 col-lg-3">
                  <div class="estilista-item">
                    <div class="img-container">
                      <div class="shadow" id="{{$estilista->id}}">
                        <i class="material-icons">check</i>
                      </div>
                      <div class="inactive" id="{{$estilista->id}}"></div>
                      <img src="{{asset($estilista->fotografia)}}" alt="">
                    </div>
                    <div class="name">
                      {{$estilista->nombre." ".$estilista->apellido}}
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
            <div class="col-xs-12 col-md-10 col-md-offset-1">
              <p style="text-align:right" class="help-toggle" id="select-est-help">¿Porque no puedo seleccionar a un estilista?</p>
            </div>
          </div>
          <div class="form-group col-xs-12">
            <button type="submit" name="button" class="btn3" style="display:block; margin:auto;margin-top:30px; ">
              Agendar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')
<script type="text/javascript">

$('.estilista-item>.img-container').css('height',$('.estilista-item>.img-container').width());
$('.estilista-item>.img-container>.shadow>i').css('font-size',($('.estilista-item>.img-container>.shadow').width()*.40)+'px');

$('#estilistas-container').hide();
$(document).ready(function () {

  function showSchedule(date) {
    $.ajax({
      url:'/getAppointmentsByDate',
      type:'post',
      dataType:'json',
      data:{
        _token:'{{csrf_token()}}',
        date:date
      }
    }).done(function (appointments) {
      $('#table-citas>tbody').children().remove();
      if(appointments.length < 1)
        $('#table-citas').hidde();
      else{
        $.each(appointments, function (i, appointment) {
          $tr = $('tr');
          $tr.append($('<td>'+appointment.cliente.nombre+" "+appointment.cliente.apellido+'</td>'));
          $tr.append($('<td>'+appointment.estilista.nombre+" "+appointment.estilista.apellido+'</td>'));
          $tr.append($('<td>'+appointment.estilista.nombre+" "+appointment.estilista.apellido+'</td>'));
          $tr.append($('<td>'+appointment.fecha+'</td>'));
          $tr.append($('<td>'+appointment.hora+'</td>'));
          $tr.append($('<td>'+appointment.estado+'</td>'));
          $('#table-citas>tbody').append($tr);
        });
        $('#table-citas').show();
      }
    })
  }

  $('.options-container>.option-item').click(function () {
    $(this).parent().children('.option-item').removeClass('active');
    $(this).addClass('active');
  })

  $('#today').click(function () {
    $('input[type=hidden][name=today]').val('1');
    $('input[type=hidden][name=tomorrow]').val('');
    $('input[type=date][name=date]').val('');
    $('input[type=date][name=date]').hide(200);
  })

  $('#tomorrow').click(function () {
    $('input[type=hidden][name=today]').val('');
    $('input[type=hidden][name=tomorrow]').val('1');
    $('input[type=date][name=date]').val('');
    $('input[type=date][name=date]').hide(200);
  })

  $('#other').click(function () {
    $('input[type=hidden][name=today]').val('');
    $('input[type=hidden][name=tomorrow]').val('');
    $('input[type=date][name=date]').show(200);
  })

  $('#now').click(function () {
    $('input[type=hidden][name=now]').val('1');
    $('input[type=time][name=time]').val('');
    $('input[type=time][name=time]').hide(200);
  })

  $('#otherTime').click(function () {
    $('input[type=hidden][name=now]').val('');
    $('input[type=time][name=time]').show(200);
  })

  $('#select-est-help').click(function () {
    showMsg('Ayuda',['Los estilistas podrán ser seleccionados de acuerdo a los servicios seleccionados.',
    'Si un estilista no puede realizar un solo servicio, no podrá ser seleccionado para la cita.',
    'Si desea cambiar los servicios que lleva a cabo un estilista, vaya a la sección personal']);
  })

  $('.estilista-item').click(function () {
    var $shadow = $(this).children('.img-container').children('.shadow');
    var $inactive = $(this).children('.img-container').children('.inactive');
    $.each($('.estilista-item>.img-container>.shadow') ,function (i, e) {
      if($(e).attr('id') != $shadow.attr('id'))
          $(e).hide();
    });
    if(!$inactive.is(':visible')){
      $shadow.fadeToggle(200, function () {
        if($shadow.is(':visible')){
          $('input[name=estilista]').val($shadow.attr('id'));
        }
        else{
          $('input[name=estilista]').val('');
        }
      });
    }
  });

  $('.servicio-item').click(function () {
    var $shadow = $(this).children('.img-container').children('.shadow');
    $shadow.fadeToggle(200, function () {
      if($shadow.is(':visible')){
        $('form').append($('<input type="hidden" id="servicio'+$shadow.attr('id')+'" name="servicios[]" value="'+$shadow.attr('id')+'">'));
      }
      else{
        $('input[type=hidden][id=servicio'+$shadow.attr('id')+']').remove();
      }
      var servicios = [];
      $.each($('input[name="servicios[]"]'), function (i, e) {
        servicios[i] = $(e).val()
      })
      if(servicios.length > 0){
        $.ajax({
          url:'/getDateServicesInfo',
          type:'post',
          dataType:'json',
          data:{
            _token: '{{csrf_token()}}',
            servicios: servicios
          }
        }).done(function (response) {
          $('#servicios-info').children().remove();
          $('#servicios-info').append($('<span>Monto total: <span style="color:#eee">$'+response.monto+"</span></span>"));
          $('#servicios-info').append($('<br>'));
          $('#servicios-info').append($('<span>Tiempo aproximado: <span style="color:#eee">'+response.tiempo+"</span></span>"));
          $('#estilistas-container').slideDown();
          $('.estilista-item>.img-container').css('height',$('.estilista-item>.img-container').width());
          $('.estilista-item>.img-container>.shadow>i').css('font-size',($('.estilista-item>.img-container>.shadow').width()*.40)+'px');
          //mostrar solo estilistas que apliquen todos los servicios especificados
          $('.estilista-item>.img-container>.shadow').hide();
          $('input[name=estilista]').val('');
          $('.estilista-item>.img-container>.inactive').show();
          $.each(response.estilistas, function (i, estilista) {
            $.each($('.estilista-item>.img-container>.shadow'), function (i, shadowItem) {
              if($(shadowItem).is(':visible')){
                $.each(response.estilistas, function (i,est) {
                  $('.estilista-item>.img-container>.shadow[id='+est.id+']').show();
                  $('input[name=estilista]').val(est.id);
                })
              }
            })
            $('.estilista-item>.img-container>.inactive[id='+estilista.id+']').hide();
          })
        })
      }
      else{
        $('#servicios-info').children().remove();
        $('#servicios-info').append($('<span>Monto total: $0</span>'));
        $('#servicios-info').append($('<br>'));
        $('#servicios-info').append($('<span>Tiempo aproximado: N/A</span>'));
        //ocultar los estilistas y poner el valor del input estilista vacio
        $('#estilistas-container').slideUp();
        $('input[name=estilista]').val('');
        $('.shadow').hide();
      }
    });
  });

  $(window).resize(function () {
    $('.estilista-item>.img-container').css('height',$('.estilista-item>.img-container').width());
    $('.estilista-item>.img-container>.shadow>i').css('font-size',($('.estilista-item>.img-container>.shadow').width()*.40)+'px');
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
