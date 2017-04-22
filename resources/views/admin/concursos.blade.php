@extends('layouts.master')
@section('title')
Concursos
@endsection
@section('css')
<style media="screen">
  body{
    background-image: url("{{asset('/img/walls/admin.jpg')}}");
  }
  .gestion-concursos{
    margin-top: 100px;
  }
  .concursos{
    background: rgba(255, 255, 255, 0.8);
    border-radius: 4px;
    color: #1F1F1F;
    height: 460px;
    overflow-y: scroll;
  }
  .concursos::-webkit-scrollbar {
    width: 0.5em;
  }
  .concursos::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }

  .concursos::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
  }
  .concurso{
    height: 150px;
    display: inline-block;
    border-radius: 2px;
    padding: 10px;
  }
  .concurso:hover{
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
  .title-concurso{
    border-left: 5px solid #ed5;
    border-radius: 4px;
    font-family: 'Lobster Two';
    color: white;
    letter-spacing: 1px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="col-md-12">
    <div class="gestion-concursos">
      @if(Session::has('error'))
        @foreach(Session::get('error') as $error)
          <div class="alert alert-danger" role="alert" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" name="button">&times;</button>
            {{$error}}
          </div>
        @endforeach
      @endif
      <div class="col-xs-6">
        @if(Session::has('exitoso'))
        @foreach(Session::get('exitoso') as $exito)
        <div class="alert alert-success" role="alert" style="text-align: center;">
          <button type="button" class="close" data-dismiss="alert" name="button">&times;</button>
          {{$exito}}
        </div>
        @endforeach
        @endif
        <h3 class="title-concurso"> Concursos existente</h3>
        <div class="concursos">
          @foreach(\App\Concurso::get() as $concurso)
          <div class="concurso">
            <div class="col-xs-3" style="padding: 2px 5px;">
              <img class="promo" src="{{asset('storage/'.$concurso->imagen)}}" alt="">
            </div>
            <div class="col-xs-8" style="margin-top: 25px;">
              <p>Fecha inicio: <i class="material-icons icono">date_range</i>{{$concurso->fecha_inicio}}</p>
              <p>Fecha termino: <i class="material-icons icono">date_range</i>{{$concurso->fecha_termino}}</p>
              @if($concurso->fecha_termino < Carbon\Carbon::now())
              <p style=""><i class="material-icons icono">delete</i> Terminado</p>
              @elseif($concurso->fecha_termino >= Carbon\Carbon::now())
              <p style=""><i class="material-icons icono">done</i> Disponible</p>
              @endif
            </div>
            <div class="col-xs-1">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li><a href="/concurso/editar/{{$concurso->id}}"><i class="material-icons icono">edit</i>Editar</a></li>
                  <li><a href="/concurso/eliminar/{{$concurso->id}}"><i class="material-icons icono">delete_sweep</i>Eliminar</a></li>
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
            <h3 class="panel-title">Agregar un concurso</h3>
          </div>
          <div class="panel-body">
            <form class="horizontal" action="/concurso/agregar" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <span>Image de promocion</span>
                <input type="file" name="imagen" value="" class="form-control" required accept="image/*">
              </div>
              <div class="form-group">
                <span>Fecha inicio</span>
                <input type="date" required name="fecha_inicio" value="{{Carbon\Carbon::now()->toDateString()}}" class="form-control">
              </div>
              <div class="form-group">
                <span>Fecha fin</span>
                <input type="date" required name="fecha_fin" value="{{Carbon\Carbon::now()->addDay()->toDateString()}}" class="form-control">
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
@endsection
