@extends('layouts.master')

@section('title')
Información cliente
@endsection

@section('css')
<style>
  html,body{
    height: 100%;
    margin: 0;
    padding: 0;
    background-image: url('{{asset("img/walls/4.jpg")}}');
    background-attachment: fixed;
  }
  .nav-bar{
    border-bottom-color: rgba(255, 255, 255, 0.2);
  }
  .footer{
    background: rgba(0, 0, 0, 0.5);
    box-shadow: none;
  }
  .main-container{
    float: left;
    color: #bbb;
    height: auto;
    width: 100%;
    margin-top: 100px;
    margin-bottom: 50px;
  }
  h3.main-title{
    font-family: 'Lobster Two';
    color: #ccc;
    float: left;
  }
  #summary-container{
    background-color: rgba(0, 0, 0, 0.7);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
    height: 100%;
    padding: 0;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    float: left;
  }
  .white-text{
    color: #eee;
  }
  .title{
    color: #eee;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);
    font-family: 'Lobster Two';
    width: 100%;
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
    float: left;
  }
  #back-btn{
    float: right;
    background-color: rgba(255, 255, 255, 0.5);
    border: 1px solid transparent;
    margin-right: -10px;
  }
  .title-card{
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    padding: 4px;
  }
  .subcontainer{
    border: 1px solid rgba(255, 255, 255, .3);
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
    border-radius: 3px;
  }
  #options-container{
    padding-top: 11px;
  }

  #modificar-credito{
    margin-bottom: 10px;
  }
  .switch-container{
    background-color: rgba(255, 255, 255, 0.1);
  }
  #citas-container{
  }
  #citas-container::-webkit-scrollbar{
    background-color: rgba(255, 255, 255, 0.02);
    height: 9px;
  }
  #citas-container::-webkit-scrollbar-thumb{
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, .6);
  }
  table{
    width: 100%;
  }
  th{
    background-color: rgba(255, 255, 255, 0.05);
    font-weight: 100;
    text-align: center;
    padding-top: 8px;
    padding-bottom: 8px;
    color: #fff;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);
  }
  td{
    padding-top: 5px;
    padding-bottom: 5px;
    color: #ddd;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);
  }
  .modal-back{
    background-color: rgba(0, 0, 0, 0.4);
    width: 100%;
    height: 100%;
    position: fixed;
    display: none;
    z-index: 2;
    padding:  65px 15px 65px 15px;

  }
  .modal-back>.modal-black-card{
    position: relative;
    background-color: #111;
    border: 1px solid #555;
    border-radius: 2px;
    padding: 0;
    display: none;
    height: 100%;
    overflow: hidden;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5),0 0 10px rgba(0, 0, 0, 0.7);
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .4s;
  }
  .modal-black-card>.header,.modal-black-card>.modal-footer{
    background-color: rgba(255, 255, 255, .05);
    margin: 0;
    padding: 10px;
  }
  .modal-black-card>.header>.close-btn{
    float: right;
    cursor: pointer;
    font-size: 18px;
    color:#aaa;
    border-radius: 3px;
  }
  .modal-black-card>.header>.close-btn:hover{
    color: #fff;
    background-color: rgba(255, 255, 255, .08);
  }
  .modal-black-card>.modal-footer{
    border-top: none;
    margin-bottom: 0;
    position: absolute;
    width: 100%;
    bottom: 0;
  }
  .modal-black-card>.modal-footer>button{
    border: 1px solid #111;
    color: #eee;
    border-radius: 3px;
    -webkit-transition: background-color .4s, border .5s;
    padding: 3px 8px 3px 8px;
  }
  .modal-black-card>.modal-footer>button>i{
    font-size: 14px;
    float: left;
    margin-top: 3.5px;
    margin-right: 3px;
  }
  .modal-black-card>.modal-footer>button:hover{
    background-color: rgba(255, 255, 255, .09);
    border: 1px solid #ccc;
  }
  .modal-black-card>.header>h4{
    margin: 0;
    color: goldenrod;
    font-family: 'Lobster Two';
  }
  .modal-black-card>.body{
    position: relative;
    padding: 10px;
    overflow: auto;
    color:#ddd;
  }
  .modal-black-card>.body::-webkit-scrollbar{
    width:  15px;
    border-radius: 12px;
  }
  .modal-black-card>.body::-webkit-scrollbar-thumb{
    background: #222;
    border: 4px solid #111;
    border-radius: 12px;
  }
  .success-btn{
    background: linear-gradient(to bottom, #3ba, #198);
  }
  .warning-btn{
    background: linear-gradient(to bottom, #cb1, #a80);
  }
  .cancel-btn{
    background: linear-gradient(to bottom, #934, #623);
  }
  .img-container{
    overflow: hidden;
    width: 10vh;
    height: 10vh;
    border-radius: 100%;
    margin: auto;
    display: block;
    margin-bottom: 10px;
  }
  .img-container>img{
    width: 100%;
  }
  .estilista-info{
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    background: rgba(255, 255, 255, 0.05);
    text-align: center;
  }
  .result{
    background: rgba(255, 255, 255, .05);
    border-radius: 3px;
    padding: 0px 3px 3px 3px;
    border: 1px solid rgba(255, 255, 255, .05);
    border-bottom: 1px solid rgba(255, 255, 255, .01);
    color: goldenrod;
  }
  p.topic{
    margin-top: 10px;
    margin-bottom: 0;
  }
</style>
@endsection

@section('body')
<div class="modal-back" id="appointment-details-modal">
  <div class="modal-black-card col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Detalles de la cita</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-6">
        <p>Cita para <span class="result" id="nombre-cliente">{{$cliente->nombre}}</span></p>
        <p>Atiende</p>
        <div class="estilista-info">
          <div class="img-container">
            <img src="" alt="" id="foto-estilista">
          </div>
          <span id="nombre-estilista">xxxx</span>
        </div>
        <p style="margin-top:10px;margin-bottom:0">Fecha</p>
        <span class="result" id="fecha">xxxx</span>
        <p style="margin-top:10px;margin-bottom:0">Hora</p>
        <span class="result" id="hora">xxxx</span>
        <div class="col-xs-12" style="padding: 0;margin-top:15px;margin-bottom:10px">
          <span class="result" id="tiempo-restante">xxxx</span>
        </div>
        <p style="margin-top:10px;margin-bottom:0">Estado</p>
        <span class="result" id="estado">xxxx</span>
      </div>
      <div class="col-xs-12 col-md-6">
        <h5>Servicios o paquetes</h5>
        <div class="subcontainer" id="servicios-container">

        </div>
        <p style="margin-top:10px;margin-bottom:0">Tiempo aproximado de duración total: <span class="result" id="tiempo-total">10 horas</span></p>
        <p style="margin-top:10px;margin-bottom:0">Horario aproximado: <span class="result" id="horario-aprox">10:00 a 13:00</span></p>
        <h5>Pagos</h5>
        <p style="margin-top:10px;margin-bottom:0">
          Se ha pagado <span class="result" id="pagado">xxxx</span> pesos de un total de
          <span class="result" id="total">xxxx</span> pesos.
        </p>
        <p style="margin-top:10px;margin-bottom:0">Por pagar</p>
        <span class="result" id="por-pagar">xxxx</span>
        <div class="subcontainer" id="pagos-container" style="margin-top:10px">

        </div>
        <p id="no-pagos-msg" style="margin-top:10px;margin-bottom:0">No se han realizado pagos.</p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn"><i class="material-icons">attach_money</i>Abonar</button>
      <button type="button" name="button" class="warning-btn"><i class="material-icons">update</i>Cambiar fecha</button>
      <button type="button" name="button" class="cancel-btn"><i class="material-icons">block</i>Cancelar</button>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="col-xs-12">
    <h3 class="main-title">Detalles del cliente</h3>
    <a href="../" class="icon-btn" id="back-btn">
      <i class="material-icons">arrow_back</i>
      <span>Explorar todos los clientes</span>
    </a>
  </div>
  <div class="col-xs-12" id="summary-container">
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Personal</h5>
      <h4 class="white-text">{{$cliente->nombre." ".$cliente->apellido}}</h4>
      <p>Telefono:<br> <span class="white-text">{{$cliente->telefono}}</span></p>
      <p>Edad:<br> <span class="white-text">{{$cliente->edad." años (".date('d/m/Y',strtotime($cliente->fecha_nacimiento)).")"}}</span></p>
    </div>
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Historial</h5>
      <p>Fecha de registro:<br> <span class="white-text">{{date('d/m/Y', strtotime($cliente->fecha_registro))}}</span></p>
      <p>Antiguedad:<br> <span class="white-text">{{$cliente->antiguedad['tiempo']." ".$cliente->antiguedad['medida']}}</span></p>
      <p>Frecuencia este mes
        <br><span class="white-text">Compras: {{$cliente->compras()->whereMonth('fecha_hora',date('m'))->whereYear('fecha_hora',date('Y'))->count()}}</span>
        <br><span class="white-text">Citas: {{$cliente->citas()->whereMonth('fecha_hora',date('m'))->whereYear('fecha_hora',date('Y'))->count()}}</span>
      </p>
      @if($cliente->esDeudor)
      <p>Tiene deudas:<br><span style="color:#f36">Si</span></p>
      @else
      <p>Tiene deudas:<br><span style="color:#5f6">No</span></p>
      @endif
    </div>
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Cuenta</h5>
      @if($cliente->cuenta)
      <p>Cuenta web: <br><span>Si</span></p>
      <p>Email: <br><span class="white-text">{{$cliente->cuenta->email}}</span></p>
      @else
      <p>Cuenta web: <br><span class="white-text">No</span></p>
      @endif
    </div>
    <div class="col-xs-12 col-md-3" id="options-container">
      <a href="/admin/clientes/edit/{{$cliente->id}}" class="icon-btn icon-square">
        <i class="material-icons">edit</i>
        <span>Modificar</span>
      </a>
      <a href="/admin/citas/agregar/{{$cliente->id}}" class="icon-btn icon-square">
        <i class="material-icons">date_range</i>
        <span>Agendar cita</span>
      </a>
      @if($cliente->credito)
      <div class="switch-container" id="modificar-credito" active="1">
        <span>Activar credito</span>
        <div class="switch-bar">
          <div class="switch-btn active"></div>
        </div>
      </div>
      @else
      <div class="switch-container" id="modificar-credito" active="0">
        <span>Activar credito</span>
        <div class="switch-bar">
          <div class="switch-btn inactive"></div>
        </div>
      </div>
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <h3 class="title">Citas</h3>
    <div class="subcontainer" id="citas-container">
      @if($cliente->citas()->count() < 1)
      <p style="margin: 0; padding:5px;text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);color:#eee;">El cliente no ha programado ninguna cita</p>
      @else
      <table>
        <thead>
          <th style="padding-left:5px">Fecha</th>
          <th>Hora</th>
          <th>Estado</th>
          <th class="hidden-xs">Monto</th>
          <th class="hidden-xs">Pagada</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($cliente->citas as $cita)
          <td style="padding-left:5px">{{date('d/m/Y',strtotime($cita->fecha_hora))}}</td>
          <td>{{date('g:i a',strtotime($cita->fecha_hora))}}</td>
          <td>{{$estados[$cita->estado]}}</td>
          <td class="hidden-xs">${{$cita->monto}}</td>
          @if($cita->pagada)
          <td class="hidden-xs">Si</td>
          @else
          <td class="hidden-xs">No</td>
          @endif
          <td style="padding-right:5px"><div class="btn btn-xs btn-success details-toggle" style="width:100%" id="{{$cita->id}}">Detalles</div></td>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <h3 class="title">Compras</h3>
    <div class="subcontainer">
      @if($cliente->compras()->count() < 1)
      <p style="margin: 0; padding:5px;text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);color:#eee;">El cliente no ha realizado ninguna compra</p>
      @else
      <table>
        <thead>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Monto</th>
          <th>Pagada</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($cliente->compras()->orderBy('fecha_hora','desc') as $compra)
          <td>{{date('g:i a',strtotime($compra->fecha_hora))}}</td>
          <td>{{date('d/m/Y',strtotime($compra->fecha_hora))}}</td>
          <td>${{$compra->productos()->sum('precio_venta')}}</td>
          @if($compra->pagos()->sum('cantidad') < $compra->productos()->sum('precio_venta'))
          <td>No</td>
          @else
          <td>Si</td>
          @endif
          <td>
            <div class="btn btn-xs btn-warning">Detalles</div>
          </td>
          @endforeach
        </tbody>
      </table>
      @endif
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

    $('.details-toggle').click(function () {
      openAppointmentDetails($(this).attr('id'));
    })

    $('.close-btn').click(function () {
      var $parent = $(this).parent().parent();
      $parent.css('-webkit-transform','scale(.7)');
      $parent.fadeOut(200, function () {
        $parent.parent().fadeOut();
      });
    })

    $('.modal-back').click(function (e) {
      if(e.target === this){
        $(this).children('.modal-black-card').css('-webkit-transform','scale(.7)');
        $(this).children('.modal-black-card').fadeOut(200, function () {
          $(this).parent().fadeOut();
        });
      }
    });

    function openAppointmentDetails(id) {
      $.ajax({
        url:'/getAppointmentDetails',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          id:id
        }
      }).done(function (cita) {
        $('.modal-black-card').find('#foto-estilista').attr('src',cita.estilista.fotografia);
        $('.modal-black-card').find('#nombre-estilista').text(cita.estilista.nombre+" "+cita.estilista.apellido);
        $('.modal-black-card').find('#fecha').text(cita.fecha);
        $('.modal-black-card').find('#hora').text(cita.hora);
        $('.modal-black-card').find('#tiempo-restante').text(cita.diff);
        $('.modal-black-card').find('#estado').text(cita.estado);
        $('.modal-black-card').find('#tiempo-total').text(cita.tiempo);
        $('.modal-black-card').find('#horario-aprox').text(cita.horarioAprox);
        $('.modal-black-card').find('#pagado').text("$"+cita.pagado);
        $('.modal-black-card').find('#total').text("$"+cita.monto);
        $('.modal-black-card').find('#por-pagar').text("$"+(cita.monto-cita.pagado));
        $.each(cita.servicios, function (i, servicio) {
          //servicio item
        })
        if(cita.pagos.length < 1){
          $('.modal-black-card').find('#no-pagos-msg').show();
        }
        else{
          $('.modal-black-card').find('#no-pagos-msg').hide();
          $.each(cita.pagos, function (i, pago) {
            //pago item
          })
        }
        $('.modal-back').fadeIn();
        $('.modal-back>.modal-black-card').fadeIn(400, function () {
          $('.modal-back>.modal-black-card>.body').height(($('.modal-back>.modal-black-card').height()-($('.modal-back>.modal-black-card>.header').outerHeight()+$('.modal-back>.modal-black-card>.modal-footer').outerHeight())-20)+'px');
        });
        $('.modal-back>.modal-black-card').css('-webkit-transform','scale(1)');
      })
    }

    $('#modificar-credito').click(function () {
      $.ajax({
        url:'/admin/clientes/update-credit',
        type:'post',
        data:{
          _token:'{{csrf_token()}}',
          id:'{{$cliente->id}}'
        }
      });
    });

    $('#back-btn').css({
      'margin-right':'0px',
      'background-color':'rgba(0,0,0,.5)',
      'border-color':'rgba(255,255,255,.5)'
    });

    $(window).resize(function () {
      $('.modal-back>.modal-black-card>.body').height(($('.modal-back>.modal-black-card').height()-($('.modal-back>.modal-black-card>.header').outerHeight()+$('.modal-back>.modal-black-card>.modal-footer').outerHeight())-20)+'px');
      if($('.main-container').height() + $('.footer').outerHeight() + 150 < $(window).height()){
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
