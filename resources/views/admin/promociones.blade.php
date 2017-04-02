@extends('layouts.master')
@section('title')
Promociones
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-promociones{
    margin-top: 100px;
  }
  .promociones{
    background-color: white;
    border-radius: 4px;
    color: #1F1F1F;
    height: 460px;
    padding: 10px 20px;
    overflow-y: scroll;
  }
  .promociones::-webkit-scrollbar {
    width: 0.5em;
  }
  .promociones::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .promociones::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .promocion{
    border: 1px solid darkgray;
    border-radius: 2px;
    height: 100px;
  }
  .panel{
    border: 0px;
  }
  .panel-heading{
    background-color: darkgray;
    color: gray;
    font-family: 'Lobster Two';
  }
  i{
    float: left;
  }
  .promocion{
    border: 1px solid gray;
    border-radius: 2px;
    padding: 5px 10px;
  }
  img{
    width: 100%;
  }
  .modal-body{
    padding: 10px 20px;
    margin-bottom: 20px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-promociones">
      <div class="col-xs-5">
        <div class="promociones">
          @foreach(\App\Promocion::get() as $promocion)
          <div class="promocion">
            <div class="col-xs-3" style="padding: 5px 10px;">
              <a href="#" data-toggle="modal" data-target="#{{$promocion->id}}"><img class=".imag" src="{{asset('storage/'.$promocion->cover)}}" alt=""></a>
            </div>
            <div class="col-xs-8">
              <p>Fecha inicio: <i class="material-icons">date_range</i>{{$promocion->fecha_inicio}}</p>
              <p>Fecha termino: <i class="material-icons">date_range</i>{{$promocion->fecha_termino}}</p>
              <p>{{$promocion->servicio->nombre}}</p>
            </div>
            <div class="col-xs-1">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="/promocion/editar/{{$promocion->id}}"><i class="material-icons">edit</i>Editar</a></li>
                  <li><a href="/promocion/eliminar/{{$promocion->id}}"><i class="material-icons">delete_sweep</i>Eliminar</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="{{$promocion->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content" style="display: inline-block">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar promocion</h4>
                </div>
                <div class="modal-body">
                  <div class="col-xs-6">
                    <img src="{{asset('storage/'.$promocion->cover)}}" alt="">
                  </div>
                  <div class="col-xs-6">
                    <form class="horizontal" action="/promocion/editar" method="post">
                      {{csrf_field()}}
                      <input type="hidden" name="id" value="{{$promocion->id}}">
                      <div class="form-group">
                        <span>Cambiar imagen de la promocion</span>
                        <input type="file" value="" class="form-control">
                      </div>
                      <div class="form-group">
                        <span>Cambiar fecha de inicio</span>
                        <input type="date" name="fecha_inicio" value="{{$promocion->fecha_inicio}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <span>Cambiar fecha de fin</span>
                        <input type="date" name="fecha_termino" value="{{$promocion->fecha_termino}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <input type="text" name="descuento" value="{{$promocion->descuento}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <span>Servicio</span>
                        <select class="form-control" name="servicio">
                          <option value="{{$promocion->servicio_id}}">Seleccione a que servicio aplica promoción</option>
                          @foreach(\App\Servicio::get() as $servicio)
                            <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="pull-right">
                        <button type="submit" name="button" class="btn btn-info">Editar</button>
                      </div>
                    </form>
                  </div>
                </div>
                <br>
                <div class="modal-footer col-xs-12">
                  <button type="button" class="btn btn-danger" name="button" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xs-offset-1 col-xs-6">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Agregar una promoción</h3>
          </div>
          <div class="panel-body">
            <form class="horizontal" action="/promocion/agregar" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <span>Image de promocion</span>
                <input type="file" name="cover" value="" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha inicio</span>
                <input type="date" name="fecha_inicio" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha fin</span>
                <input type="date" name="fecha_fin" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Servicio</span>
                <select class="form-control" name="servicio">
                  <option value="null">Seleccione a que servicio aplica promoción</option>
                  @foreach(\App\Servicio::get() as $servicio)
                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <span>Descuento:</span>
                <input type="text" name="descuento" value="." class="form-control">
              </div>
              <div class="pull-right">
                <button type="submit" name="button" class="form-control"><i class="material-icons">save</i>Guardar</button>
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
@endsection
