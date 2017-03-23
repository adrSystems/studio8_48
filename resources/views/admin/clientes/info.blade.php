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
    background-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
    height: 100%;
    padding: 0;
    position: relative;
    float: left;
  }
  .white-text{
    color: #eee;
  }
  .title{
    color: #bbb;
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
    background-color: #111;
    margin-right: -10px;
  }
  .title-card{
    background-color: #333;
    border-radius: 3px;
    padding: 4px;
  }
  #citas-container{

  }
  .subcontainer{
    border: 1px solid rgba(255, 255, 255, .1);
    border-radius: 3px;
  }
  #options-container{
    padding-top: 11px;
  }
</style>
@endsection

@section('body')
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
      <div class="icon-btn icon-square">
        <i class="material-icons">credit_card</i>
        <span>Activar credito</span>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <h3 class="title">Citas</h3>
    <div class="subcontainer" id="citas-container">
      @if($cliente->citas()->count() < 1)
      <p style="margin: 0; padding:5px;">El cliente no ha programado ninguna cita</p>
      @else
      <table>
        <thead>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Estado</th>
          <th>Monto</th>
          <th>Pagada</th>
          <th></th>
        </thead>
        <tbody>
          @foreach($cliente->citas()->orderBy('fecha_hora','desc') as $cita)
          <td>{{date('g:i a',strtotime($cita->fecha_hora))}}</td>
          <td>{{date('d/m/Y',strtotime($cita->fecha_hora))}}</td>
          <td>{{$cita->estado}}</td>
          <td>{{$cita->monto}}</td>
          @if($cita->pagada)
          <td>Si</td>
          @else
          <td>No</td>
          @endif
          <td><div class="btn btn-xs btn-warning">Mas información</div></td>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <h3 class="title">Compras</h3>
    <div class="subcontainer" id="citas-container">
      @if($cliente->compras()->count() < 1)
      <p style="margin: 0; padding:5px;">El cliente no ha realizado ninguna compra</p>
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
          <td>{{$compra->productos()->sum('precio_venta')}}</td>
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
  if($('.main-container').height() + 220 < $(window).height()){
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

    $('#back-btn').css({
      'margin-right':'0px',
      'background-color':'#222'
    });

    $(window).resize(function () {
      if($('.main-container').height() + 220 < $(window).height()){
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
  })
</script>
@endsection
