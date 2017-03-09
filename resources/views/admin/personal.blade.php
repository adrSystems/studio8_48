@extends('layouts.master')

@section('title')
Studio8 48 - Personal
@endsection

@section('css')
<style>
  .main-container{
    margin-top: 50px;
    width: 100%;
    float: left;
    margin-bottom: 25px;
  }
  h3{
    border-left: 5px solid #fff;
    padding-left: 10px;
    font-family: 'Lobster Two';
    color: #aaa;
  }
  #empleados-container{
    box-shadow: 0 2px 5px #000;
    padding: 0px;
    background: #222;
    color: #fff;
    margin-bottom: 15px;
  }
  .roles{
    color: #EEE8AA;
  }
  .empleado-item{
    position: relative;
    float: left;
    padding: 10px;
    width: 100%;
    height: 100%;
    -webkit-transition: box-shadow .4s, border .2s;
  }
  .empleado-item:hover{
    background-color: #333;
  }
  .empleado-item>i{
    position: relative;
    float: right;
    font-size: 19px;
    margin-left: 10px;
    color: #ccc;
    cursor: pointer;
  }
  .empleado-item>i:hover{
    color:white;
  }
  #add-container{
    background-color: #000;
    color: #fff;
    border-radius: 5px;
    border: 1px solid #222;
  }
  #add-btn{
    background: linear-gradient(to bottom, dodgerblue, royalblue);
    border: 1px solid skyblue;
    border-radius: 3px;
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <div class="col-xs-12 col-md-10 col-md-offset-1">
    <h3 class="">Personal</h3>
  </div>
  <div class="col-xs-12 col-md-offset-1 col-md-4">
    <div class="col-xs-12" id="empleados-container">
      @if(App\Empleado::count() < 1)
      <strong>No se encontraron empleados en el sistema</strong>
      @else
      @foreach(App\Empleado::get() as $empleado)
      <div class="empleado-item">
        <img src="{{$empleado->fotografia}}" alt="" class="col-xs-4">
        <div class="col-xs-8">
          <p>{{$empleado->nombre." ".$empleado->apellido}}</p>
          <p class="roles">
            @foreach($empleado->roles as $i => $rol)
            @if($i == 0 and $i == $empleado->roles->count()-1)
            {{"(".ucfirst($rol->nombre).")"}}
            @elseif($i == 0)
            {{"(".ucfirst($rol->nombre).", "}}
            @elseif($i == $empleado->roles->count()-1)
            {{ucfirst($rol->nombre).")"}}
            @else
            {{ucfirst($rol->nombre).", "}}
            @endif
            @endforeach
          </p>
        </div>
        <i class="material-icons" id="delete-btn">delete</i>
        <i class="material-icons" id="edit-btn">edit</i>
        <i class="material-icons" id="info-btn">info</i>
      </div>
      @endforeach
      @endif
    </div>
  </div>
  <div class="col-xs-12 col-md-offset-1 col-md-4">
    <div id="add-container" class="col-xs-12">
      <h4>Nuevo personal</h4>
      <form class="" action="index.html" method="post">
        <div class="form-group">
          <label for="">Nombre</label>
          <input type="text" name="" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Apellido</label>
          <input type="text" name="" value="" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" name="button" id="add-btn">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function () {
  });
</script>
@endsection
