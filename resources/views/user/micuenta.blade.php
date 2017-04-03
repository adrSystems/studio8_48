@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')

<style>
.cuenta{
  margin-top: 70px;

}
.item-nav{
  font-weight: 100;
  font-family: 'Lobster Two';
  color: #ed5;
  font-size: 16px;
  text-align: center;
  background-color: #111;
  border: 2px solid #ed5;
  margin-top: 6px;
  -webkit-transition: color 1.8s;
  text-decoration: none;
}
.item-nav:hover{
  color: black;
}
.item-nav:link{
  text-decoration: none;
  color: #111;
}
.item-nav:focus{
  color: black;
  border: 2px solid #ed5;
  border-left: 8px solid #111;
}
.info{
  margin-top: 8px;
  border-radius: 10px 10px;
}
a{
  text-decoration: none;
}
.material-icons{
  font-size: 15px;
  font-weight: 100;
}
.send{
  font-size: 32px;
  color: #ed5;
  margin-top: 4px;
}
.btnsend{
  background-color: #1f1f1f;
  border-radius: 100%;
  text-align: center;
  border: 0px 0px 0px 0px;
  margin-top: 12px;
}
.list-group{
  height: 150px;
}
.mnsjAdmin{
  text-align: justify;
  background: #111;
  width: 300px;
  border-radius: 4px;
  margin-left: auto;
}
.mnsjCliente{
  text-align: justify;
  background: #ed5;
  width: 300px;
  border-radius: 4px;
  margin-right: auto;
}
.photo{
  border-radius: 100%;
}
.photo:hover{
  opacity: 0.5;
}
.modal{
  background: #111;
  opacity: 0.6;
  filter: alpha(opacity=60);
}
.modal-title{
  font-family: 'Lobster Two';
}
.modal-dialog{
  margin-left: 30%;
}
.modal-content{
    border: 3px solid #ed5;
}
.info{
  color: #F8F8FF;
}
.nav{
  background-color: white;
  width: auto;
  margin-left: -25px;
  height: 300px;
  font-family: 'Lobster Two';
  text-align: center;
}
.titlenav{
  font-size: 32px;
}
.panel-heading{
  font-family: 'Lobster Two';
  font-size: 20px;
  text-align: center;
}
.panel-body{
  height: 200px;
  overflow: scroll;
}
.panel-body::-webkit-scrollbar {
    width: 0.5em;
}
.panel-body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

.panel-body::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
.fade{
  background: rgba(0, 0, 0, 0.5);
}
hr{
  margin-bottom: 2px;
  margin-top: 3px;
}
.third-effect .mask {
   opacity: 0;
   overflow:visible;
   border:100px solid rgba(0,0,0,0.7);
   box-sizing:border-box;
   transition: all 0.4s ease-in-out;
   margin-top: -200px;
   height: 100px;
   width: 100px;
}

.third-effect button.info {
   position:relative;
   top:-10px; /* Center the link */
   opacity: 0;
   transition: opacity 0.5s 0s ease-in-out;
   color: black;
}

.third-effect:hover .mask {
   opacity: 1;
   border:100px solid rgba(0,0,0,0.7);
   border-radius: 50%;
}

.third-effect:hover button.info {
   opacity:1;
   transition-delay: 0.3s;
}
a{
  text-decoration: none;
}
</style>
@endsection
@section('body')
<div class="col-md-8 cuenta">
  <div class="col-xs-3 fontnav">
    <ul class="nav nav-pills nav-stacked">
    <span class="titlenav">Mi cuenta</span>
    <hr>
    <li role="presentation"><a class="item-nav b1" href="#">Perfil</a></li>
    <li role="presentation"><a class="item-nav b2" href="#mensajes">Mensajes</a></li>
    <li role="presentation"><a class="item-nav b3" href="#">Historial de citas</a></li>
    </ul>
  </div>
<div class="cuentainfo">
<div class="col-xs-3">
  <div class="view third-effect">
  <img class="photo" data-toggle="modal" data-target="#{{Auth::user()->id}}" src="{{asset('img/profile_photos/'.Auth::user()->photo)}}">
  <div class="mask">

      <i class="material-icons" class="info" title="Subir foto de perfil">add_a_photo</i>

  </div>
</div>
</div>
  <div id="perfil" class="col-xs-6 info">
    <table class="table table-bordered">

      <th>Información personal <div class="pull-right">
         <a data-toggle="modal" data-target="#id{{Auth::user()->id}}" class="btn btn-warning" style="background-color: #ed5;">Modificar <i class="material-icons edit">edit</i></a>
      </div> </th>
      <tr>
        <td>
          {{Auth::user()->cuentable->nombre}}
        </td>
      </tr>
      <tr>
        <td>
          {{Auth::user()->cuentable->apellido}}
        </td>
      </tr>
      <tr>
        <td>
          {{Auth::user()->email}}
        </td>
      </tr>
      <tr>
        <td>
          {{Auth::user()->cuentable->fecha_nacimiento}}
        </td>
      </tr>
    </table>

</div>
</div>
<div class="modal fade" id="{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog col-xs-4">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="cerrar" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Subir foto de perfil</h4>
      </div>
      <div class="modal-body">
        <div class="" style="text-align: center;">
          <img src="{{asset('img/profile_photos/'.Auth::user()->photo)}}" alt="">
        </div>
        <br>
        <form class="horizontal" action="/subirfoto" method="post">
          <input type="hidden" name="id" value="{{Auth::user()->id}}">
          {{csrf_field()}}
          <div class="form-group">
            <input type="file" name="nombre" class="form-control">
          </div>
        </form>
      </div>

    </div>

  </div>
</div>

<div class="modal fade" id="id{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog col-xs-4">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="cerrar" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Modificar tu cuenta</h4>
      </div>
      <div class="modal-body">
        <form class="horizontal" action="/modificarcuenta" method="post">
          <input type="hidden" name="id" value="{{Auth::user()->id}}">
          {{csrf_field()}}
          <div class="form-group">
            <span>Nombre:</span>
            <input type="text" name="nombre" value="{{Auth::user()->cuentable->nombre}}" class="form-control">
          </div>
          <div class="form-group">
            <span>Apellido:</span>
            <input type="text" name="apellido" value="{{Auth::user()->cuentable->apellido}}" class="form-control">
          </div>
          <div class="form-group">
            <span>Fecha de nacimiento:</span>
            <input type="date" name="fecha_nacimiento" value="{{Auth::user()->cuentable->fecha_nacimiento}}" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default form-control" style="background: #111; font-family: 'Lobster Two'; color: #ed5;" name="button">
              <i class="material-icons save">save</i> Guardar
            </button>
            <button type="button" class="btn btn-danger form-control" style="margin-top: 6px; font-family: 'Lobster Two';" data-dismiss="modal" aria-label="cerrar" name="button">
              <span aria-hidden="true"><i class="material-icons">close</i> Cerrar</span>
            </button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>
<div class="col-xs-6 mensajes">
  <div class="panel panel-default">
  <div class="panel-heading">Mensajes <p style="color: #FF69B4;">¡Puedes comunicarte con alguno de nuestros admnistradores!</p></div>
  <div class="panel-body">

    @foreach(App\Mensaje::get() as $mensaje)
      @if(Auth::user()->id==$mensaje->cliente_id)
        @if($mensaje->by_cliente==1)
        <p>Tú</p>
        <p class="mnsjCliente" style="margin-top: -10px;">{{$mensaje->contenido}}</p>
        <hr>
        @endif


      @endif
      @if($mensaje->by_cliente==0)
          <p style="margin-left: 122px;">Admin</p>
          <p style="color: #ed5; margin-top: -10px;" class="mnsjAdmin">{{$mensaje->contenido}}</p>
          <hr>
      @endif
    @endforeach

  </div>
  <ul class="list-group">
    <li class="list-group-item">
    <form class="horizonal" action="/enviarmensajeC" method="post">
    {{csrf_field()}}
      <div class="form-group">
        <div class="col-xs-10">
          <textarea name="msnj" class="form-control" rows="3" cols="80"></textarea>
        </div>
        <div class="col-xs-2">
          <button type="submit" class="btnsend" id="{{Auth::user()->id}}" name="button"><i class="material-icons send">send</i></button>
        </div>
      </div>
    </form>
  </li>
  </ul>
</div>
</div>
<div class="col-xs-8 historial">
  <table class="table table-bordered">
    <tr>
      <th>Fecha</th>
      <th>Estilista</th>
      <th>Servicio</th>
      <th>Estatus</th>
    </tr>
    @foreach(App\Cita::get() as $cita)
      <tr>
        <td>{{$cita->fecha_hora}}</td>
        <td>{{$cita->join('empleados','empleados.id','=','citas.empleado_id')->select('nombre')->get()}}</td>
        <td>{{$cita->join('cita_servicio','citas.cliente_id','=','cita_servicio.cita_id')->join('servicios','servicios.id','=','cita_servicio.servicio_id')->select('nombre')->get()}}</td>

          @if($cita->estatus==1)
          <td>
            Realizada
          </td>
          @endif
          @if($cita->estatus==0)
          <td>
            En espera
          </td>
          @endif
      </tr>
    @endforeach
  </table>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $(".b1").focus();
    $(".mensajes").hide();
    $(".historial").hide();
    $(".b1").click(function(){
      $(".cuentainfo").show(700);
      $(".cuentainfo").show("slow");
      $(".mensajes").hide();
      $(".historial").hide();
    });
    $(".b2").click(function(){
      $(".cuentainfo").hide(700);
      $(".cuentainfo").hide("slow");
      $(".mensajes").show(300);
      $(".mensajes").show("slow");
      $(".historial").hide();
    });
    $(".b3").click(function(){
      $(".cuentainfo").hide(700);
      $(".cuentainfo").hide("slow");
      $(".mensajes").hide();
      $(".historial").show(700);
      $(".historial").show("slow");
    });
    $(".cuentainfo").click(function(){
      $(".b1").focus();
    });
    $(".mensajes").click(function(){
      $(".b2").hover();
    });
    $(".btnsend").click(function(){
      var $btn = $(this);
      ajax({
        url: '/enviarmensajeC',
        data: {
          _token: '{{csrf_token()}}',
          data: $(this).attr('id'),
        },
        type: 'post'
      }).done(function(reponse){
        var $a = setInterval(actualizar,2000);
      });
    });
    function actualizar(){
      $('.mensajes').load();
    }
  });
</script>
@endsection
