@extends('layouts.master')
@section('title')
Studio8 48 - Servicios
@endsection
@section('css')
<style>
  body{
    background-image: url('{{asset("img/walls/admin.jpg")}}');
  }
  .gestion-servicios{
    margin-top: 100px;
  }
  .footer{
    margin-top: 50%;
  }
  .precio{
    float: left;
    margin-top: 5px;
    margin-left: -13px;
  }
  .panel{
    border: 0px;
    margin-top: 30px;
  }
  .panel-heading{
    font-family: 'Lobster Two';
    background-color: gray;
    color: #3F3F3F;
  }
  .price{
    font-size: 19px;
  }
  .input-precio{
    width: 400px;
    margin-left: -50px;
  }
  .icon{
    font-size: 16px;
    float: left;
  }
  .servicios{
    background-color: white;
    height: 320px;
    border-radius: 4px;
    padding: 15px;
    overflow-y: scroll;
  }
  .servicios::-webkit-scrollbar {
    width: 0.5em;
  }
  .servicios::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .servicios::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .servicio{
    border: 1px solid gray;
    height: 100px;
    width: 450px;
    border-radius: 2px;
    padding: 10px 20px;
  }
  h3.title-servicios{
    border-left: 6px solid #ed5;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    color: white;
    font-family: 'Lobster Two';
  }
  .time-size{
    font-size: 14px;
  }
  .dropdown{
    margin-left: -42px;
  }
  .btn-default{
    border: 0px;
    background-color: transparent;
  }
  img{
    width: 100%;
    border-radius: 100%;
  }
  .dropdown-menu li a{
    display: inline-block;
    clear: none;
    font-weight: 200;
  }
  .open .dropdown-menu{
    width: 100px;
  }
</style>
@endsection
@section('body')
<div class="col-md-12">
  <div class="gestion-servicios">
    <div class=" col-xs-offset-1 col-xs-5">
      <h3 class="title-servicios"><p> Servicios disponibles</p></h3>
      <div class="servicios">
        @foreach(App\Servicio::get() as $servicio)
        <div class="servicio">
          <div class="col-xs-3">
            <img src="{{asset('storage/'.$servicio->icono)}}" alt="">
          </div>
          <div class="col-xs-8">
            <p>Nombre: {{$servicio->nombre}}</p>
            <p>Precio: $ {{$servicio->precio}}</p>
            <p>Tiempo: <i class="material-icons time-size">query_builder</i> {{$servicio->tiempo}}</p>
          </div>
          <div class="col-xs-1">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="material-icons">more_vert</i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="/servicio/editar/{{$servicio->id}}"><i class="material-icons">edit</i>Editar</a></li>
                <li><a href="/servicio/eliminar/{{$servicio->id}}"><i class="material-icons">delete_sweep</i>Eliminar</a></li>
              </ul>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-xs-offset-1 col-xs-5">
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Subir servicios</h3>
        </div>
        <div class="panel-body">
          <form class="horizontal" action="/servicio/agregar" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <span>Nombre del servicios:</span>
              <input type="text" name="nombre" value="" class="form-control">
            </div>
            <div class="form-group">
              <span>Icono del servicio:</span>
              <input type="file" name="icono" value="" class="form-control">
            </div>
            <div class="form-group">
              <div class="col-xs-3">
                <span class="precio">Precio: <i class="material-icons price">$</i></span>
              </div>
              <div class="col-xs-9">
                <input type="text" name="precio" value="" class="form-control input-precio">
              </div>
            </div>
            <br>
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
            <div class="form-group">
              <div class="pull-right">
                <button type="submit" class="btn" name="button"><i class="material-icons icon">save</i>Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
@endsection
