@extends('layouts.master')
@section('title')
Profesionales
@endsection
@section('css')
<style type="text/css">
body{
  color:#c5b358;
  background-color: #efe;
  font-family: 'Lato';
  background: url('{{asset("img/walls/wa.jpg")}}') center / cover;

}
#img{
    border-radius: 2px;

}
#img:hover { -moz-box-shadow: 0 0 10px #ccc; -webkit-box-shadow: 0 0 10px #ccc; box-shadow: 0 0 10px #ccc; }
.thumbnail{
  background-color: rgba(0, 0, 0, 0.6);
}
h3{
  color:#c5b358;
  font-family: 'Lato';
}
h4{
  color:#c5b358;
  font-family: 'Lato';
}
.modal-backdrop.in {
    opacity: 0.9;
}
</style>
@endsection
@section('body')
<br><br><br>
<div class="container">
  <h2>Profesionales</h2>
<div class="row">
  @foreach(App\Empleado::get() as $empleado)

  <div class="col-md-3">
    <div class="thumbnail" style="height:410px">

        <a href="#" data-toggle="modal" data-target="#id_modal{{$empleado->id}}"> <img id="img" src="storage/{{$empleado->fotografia}}" alt="Lights" style="width:250px;height:250px"></a>
        <div class="caption">
        <h3 align="center">{{$empleado->nombre}}</h3>
        @foreach(App\Rol::get() as $rol)
        @foreach(App\Empleado_Rol::get() as $empleados_roles)
        @if($empleado->id==$empleados_roles->empleado_id)
        @if($rol->id == $empleados_roles->rol_id)
        <h4 align="center">{{$rol->nombre}}</h4>
        @endif
        @endif
        @endforeach
        @endforeach
<div class="modal fade" id="id_modal{{$empleado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="exampleModalLongTitle">{{$empleado->nombre}} {{$empleado->apellido}}</h2>
      </div>
      <div class="modal-body col-xs-12">
        <div class="col-xs-12 col-md-6">
        <img src="storage/{{$empleado->fotografia}}" alt="" width="250px" height="300px">
        </div>
        <div class="col-xs-12 col-md-6">
          <h2>Informacion</h2>
          <p>{{$empleado->info}}</p>
          <h5>Fecha de nacimiento: {{$empleado->fecha_nacimiento}}</h5>
          <h5>Puesto:</h5>
          @foreach(App\Rol::get() as $rol)
          @foreach(App\Empleado_Rol::get() as $empleados_roles)
          @if($empleado->id==$empleados_roles->empleado_id)
          @if($rol->id == $empleados_roles->rol_id)
          <h5>{{$rol->nombre}}</h5>
          @endif
          @endif
          @endforeach
          @endforeach
        </div>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
        </div>

    </div>
  </div>
  @endforeach
</div>
</div>
@endsection
