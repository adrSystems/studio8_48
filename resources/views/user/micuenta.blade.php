@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')

<style>
.cuenta{
  margin-top: 100px;

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
  margin-left: -26px;
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
  border-bottom: 4px solid #111;
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
  margin-left: auto;
}
.mnsjCliente{
  text-align: justify;
  background: #ed5;
  width: 300px;
  margin-right: auto;
}
.photo{
  border-radius: 100%;
}
.modal{
  background: white;
}
</style>
@endsection
@section('body')
<div class="col-md-8 cuenta">
  <div class="col-xs-3 fontnav">
    <ul class="nav nav-pills nav-stacked">
    <li role="presentation"><a class="item-nav b1" href="#">Perfil</a></li>
    <li role="presentation"><a class="item-nav b2" href="#">Mensajes</a></li>
    </ul>
  </div>
<div class="cuentainfo">
<div class="col-xs-3">
    <img class="photo" src="{{asset('img/profile_photos/'.Auth::user()->photo)}}" alt="">
</div>
  <div id="perfil" class="col-xs-6 info">
    <p>{{Auth::user()->cuentable->nombre}}</p>
    <p>{{Auth::user()->cuentable->apellido}}</p>
    <p>{{Auth::user()->email}}</p>
    <p>{{Auth::user()->cuentable->fecha_nacimiento}}</p>

    <div class="pull-left">
       <a data-toggle="modal" data-target="#id{{Auth::user()->id}}" class="btn btn-warning" style="background-color: #ed5;">Modificar <i class="material-icons edit">edit</i></a>
    </div>

</div>
<div class="modal fade" id="id{{Auth::user()->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header col-xs-12">
        <button type="button" class="close" data-dismiss="modal" aria-label="cerrar" name="button">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Modificar tu cuenta</h4>
      </div>
      <div class="modal-body col-xs-12">
        <form class="horizontal" action="/modificarcuenta" method="post">
          <div class="form-group">
            <span>Nombre:</span>
            <input type="text" name="nombre" value="{{Auth::user()->cuentable->nombre}}" class="form-control">
          </div>
        </form>
      </div>

    </div>

  </div>
</div>
</div>
<div class="col-xs-6 mensajes">
  <div class="panel panel-default">
  <div class="panel-heading">Mensaje</div>
  <div class="panel-body">

    @foreach(App\Mensaje::get() as $mensaje)
      @if(Auth::user()->id==$mensaje->cliente_id)
        @if($mensaje->by_cliente==1)
        <p class="mnsjCliente">{{$mensaje->contenido}}</p>

        <hr>
        @endif


      @endif
      @if($mensaje->by_cliente==0)
          <p class="mnsjAdmin">{{$mensaje->contenido}}</p>
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
          <button type="submit" class="btnsend" name="button"><i class="material-icons send">send</i></button>
        </div>
      </div>
    </form>
  </li>
  </ul>
</div>


</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $(".b1").focus();
    $(".mensajes").hide();
    $(".b1").click(function(){
      $(".cuentainfo").show(700);
      $(".cuentainfo").show("slow");
      $(".mensajes").hide();
    });
    $(".b2").click(function(){
      $(".cuentainfo").hide(700);
      $(".cuentainfo").hide("slow");
      $(".mensajes").show(300);
      $(".mensajes").show("slow");
    });
    $(".cuentainfo").click(function(){

    });
  });
</script>
@endsection
