@extends('layouts.master')
@section('title')
Studio8 48 - Servicios
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-concursos{
    margin-top: 70px;
  }
  .servicios{
    background: rgba(255, 255, 255, 0.8);
    border-radius: 4px;
    color: #1F1F1F;
    height: 460px;
    overflow-y: scroll;
  }
  .servicios::-webkit-scrollbar {
    width: 0.5em;
  }
  .servicios::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .servicos::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .servicio{
    height: 150px;
    display: inline-block;
    border-radius: 2px;
    padding: 10px;
    width: 100%;
  }
  .servicio:hover{
    background-color: rgba(255, 255, 255, 0.6);
  }
  .panel{
    border: 0px;
  }
  .panel-heading{
    background-color: darkgray;
    color: #3F3F3F;
    font-weight: bold;
    height: 100px;
    font-family: 'Lobster Two';
  }
  .panel-title{
    margin-top: 25px;
    font-size: 20px;
  }
  .icono{
    float: left;
  }
  .promo{
    width: 100%;
  }
  .modal-body{
    padding: 10px 20px;
    margin-bottom: 20px;
  }
  .dropdown{
    margin-top: -5px;
    margin-left: -25px;
  }
  .btn-default{
    border: 0px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 100%;
  }
  .btn-default.active.focus,
  .btn-default.active:focus,
  .btn-default.active:hover,
  .btn-default:active.focus,
  .btn-default:active:focus,
  .btn-default:active:hover,
  .open>.btn-default.dropdown-toggle.focus,
  .open>.btn-default.dropdown-toggle:focus,
  .open>.btn-default.dropdown-toggle:hover{
      background-color: rgba(255, 255, 255, 0.1);
      border-color: inherit;
  }
  .open{
    background-color: rgba(255, 255, 255, 0);
  }
  .dropdown-menu{
    margin-left: -108px;
  }
  .footer{
    margin-top: 100px;
  }
  .title-servicio{
    border-left: 5px solid #ed5;
    border-radius: 4px;
    font-family: 'Lobster Two';
    color: white;
    letter-spacing: 1px;
  }
  .detalle{

  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-concursos">
      @if(Session::has('error'))
        @foreach(Session::get('error') as $error)
          <div class="alert alert-danger" role="alert" style="text-align: center; margin-top: -15px;">
            {{$error}}
          </div>
        @endforeach
      @endif
      <div class="col-xs-6">
        <h3 class="title-servicio"> Servicios existente</h3>
        <div class="servicios">
          @foreach(\App\Servicio::get() as $servicio)
          <div class="servicio">
            <div class="col-xs-3" style="padding: 2px 5px;">
              <img class="promo" src="{{asset('storage/'.$servicio->icono)}}" alt="">
            </div>
            <div class="col-xs-8 detalle">
              <p>Nombre: {{$servicio->nombre}}</p>
              <p>Precio: ${{$servicio->precio}}</p>
              <p>Duración: <i class="material-icons icono">timer</i>{{$servicio->tiempo}}</p>
            </div>
            <div class="col-xs-1">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="/servicio/editar/{{$servicio->id}}"><i class="material-icons icono">edit</i>Editar</a></li>
                  <li><a href="/servicio/eliminar/{{$servicio->id}}"><i class="material-icons icono">delete_sweep</i>Eliminar</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xs-offset-1 col-xs-5">
        <div class="panel" style="margin-top: 60px;">
          <div class="panel-heading">
            <h3 class="panel-title">Agregar un servicio</h3>
          </div>
          <div class="panel-body">
            <form class="horizontal" action="/servicio/agregar" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <span>Nombre del servicio:</span>
                <input type="text" class="form-control" name="nombre" value="" placeholder="Ingrese el nombre del servicio">
              </div>
              <div class="form-group">
                <span>Image de promocion</span>
                <input type="file" name="icono" value="" class="form-control">
              </div>
              <div class="form-group">
                <span>Precio</span>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">$</span>
                  <input type="text" class="form-control" name="precio" placeholder="Ingrese el precio" aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="form-group">
                <span>Tiempo del servico</span>
                <select class="form-control" name="duracion">
                  <option value="">Seleccione la duracion del servico</option>
                  <option value="00:30:00">30 min</option>
                  <option value="01:00:00">1:00 hr</option>
                  <option value="01:30:00">1:30 hrs</option>
                  <option value="02:00:00">2:00 hrs</option>
                  <option value="02:30:00">2:30 hrs</option>
                  <option value="03:00:00">3:00 hrs</option>
                  <option value="03:30:00">3:30 hrs</option>
                  <option value="04:00:00">4:00 hrs</option>
                  <option value="04:30:00">4:30 hrs</option>
                  <option value="05:00:00">5:00 hrs</option>
                </select>
              </div>
              <div class="pull-right">
                <button type="submit" name="button" class="form-control"><i class="material-icons icono">save</i>Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
</script>
@endsection
