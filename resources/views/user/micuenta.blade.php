@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')
<style>
  body{
    background-image: url('{{asset("img/walls/clientes.jpg")}}');
    background-attachment: local;
    background-position: left;
  }
  .cuenta{
    margin-top: 100px;
  }
  .footer{
    margin-top: 40%;
  }
  .nav{
    background-color: #1F1F1F;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    height: 500px;
  }
  .nav li.item a{
    border-radius: 0px;
    color: white;
    background-color: #3F3F3F;
    font-family: 'Lobster Two';
    margin-top: -2px;
    font-size: 16px;
    -webkit-transition: 0.3s ease;
  }
  .nav li.title-nav a{
    font-family: 'Lobster Two';
  }
  .nav li.title-nav a:hover{

  }
  .nav li.item a:hover{
    color: white;
    background-color: black;
  }
  .nav li.item a::after{
    content: '';
    display: block;
    width: 0px;
    height: 2px;
    background: white;
    transition: width .3s;
  }
  .nav li.item a:hover::after{
    width: 100%;
  }
  .title-nav{
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    text-align: center;
    font-size: 18px;
  }
  .nav-pills li.active a,
  .nav-pills li.active a:hover,
  .nav-pills li.active a:focus{
    background-color: #1F1F1F;
  }
  .icon-nav{
    float: left;
  }
  .panel-dark{
    border: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 6px;
  }
  .heading-dark{
    background-color: #1F1F1F;
    color: white;
  }
  .panel-heading{
    font-family: 'Lobster Two';
  }
  .panel-body{

  }
  .panel-body-white{
    background-color: white;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    padding: 10px;
    height: 225px;
  }
  .collapse{
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    background-color: #3F3F3F;
    height: 120px;
    padding: 15px;
  }
  .edit-icono{
    font-size: 15px;
  }
  .collapse-ref{
    color: white;
  }
  .box-control{
    height: 25px;
  }
  .button-guardar{
    margin-top: 10px;
  }
  .container-photo{
    position: relative;
    width: 60%;
    text-align: center;
  }
  .photo{
    opacity: 1;
    display: block;
    width: 100%;
    height: auto;
    transition: .5s ease;
    backface-visibility: hidden;
    border-radius: 50%;
  }
  .medio{
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
  }
  .container-photo:hover .photo{
    opacity: 0.3;
  }
  .container-photo:hover .medio{
    opacity: 1;
  }
  .text{
    padding: 16px 32px;
  }
  .ancla{
    text-decoration: none;
    color: #1F1F1F;
  }
  .form-photo{
    margin-left: -80px;
    margin-top: 40px;
  }
  span{
    font-family: fantasy;
  }
  .scroll{
    height: 200px;
    overflow: scroll;
  }
  .scroll::-webkit-scrollbar {
    width: 0.5em;
  }
  .scroll::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  }
  .scroll::-webkit-scrollbar-thumb {
     outline: 1px solid slategrey;
  }
  .panel-footer{
    height: 110px;
  }
  .button-send{
    border-radius: 50%;
    text-align: center;
    color: #ed5;
    border: 2px solid #ed5;
    background-color: #1F1F1F;
    font-size: 20px;
    margin-top: 9px;
  }
  .text-send{
    margin-top: 6px;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="cuenta col-md-12">
    <div class="col-xs-3">
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active title-nav"><a href="#">Home</a></li>
        <li role="presentation" class="item item-perfil"><a href="#" class="item-nav"><i class="material-icons icon-nav">person</i><p> Profile</p></a></li>
        <li role="presentation" class="item item-historial"><a href="#" class="item-nav"><i class="material-icons icon-nav">history</i><p> Historial</p></a></li>
      </ul>
    </div>
    <div class="col-xs-offset-1 col-xs-8">
      <div class="perfil">
        <div class="panel panel-dark">
          <div class="panel-heading heading-dark">
            <h3 class="panel-title">Información del perfil</h3>
          </div>
          <div class="panel-body">
            <div class="col-xs-4">
              <div class="container-photo" id="parent">
                <img src="{{asset('storage/'.Auth::user()->photo)}}" alt="" class="photo">
                <div class="medio">
                  <a class="ancla" href="#"><i class="material-icons">add_a_photo</i></a>
                </div>
            </div>
            </div>
            <div class="col-xs-3 form-photo">
              <form class="horizontal" action="/subirfoto" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <input type="file" name="foto" accept="image/*" value="">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn" name="button">Subir foto</button>
                </div>
              </form>
            </div>
            <br><br><br><br><br><br><br>
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <span>Nombre:</span> {{Auth::user()->cuentable->nombre}}<a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#nombre"><i class="material-icons edit-icono">edit</i>Editar</a>
                  </h4>
                </div>
                <div id="nombre" class="collapse">
                  <div class="panel-body">
                    <form class="horizontal" action="/modificarnombre" method="post">
                      {{csrf_field()}}
                      <div class="col-xs-4 collapse-ref">
                        Nombre actual:
                      </div>
                      <div class="col-xs-offset-2 col-xs-6">
                        <input type="text" class="form-control box-control" name="nombre" value="{{Auth::user()->cuentable->nombre}}">
                      </div>
                      <div class="col-xs-offset-6 col-xs-3">
                        <button type="submit" class="btn button-guardar" name="button">Guardar cambios</button>
                      </div>
                      <div class="col-xs-3">
                        <button type="button" class="btn button-guardar" name="button" id="nombre" class="collapse out">Cancelar</button>
                      </div>
                    </form>
                  </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <span>Apellido:</span> {{Auth::user()->cuentable->apellido}}<a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#apellido"><i class="material-icons edit-icono">edit</i>Editar</a>
                    </h4>
                  </div>
                  <div id="apellido" class="collapse">
                    <div class="panel-body">
                      <form class="horizontal" action="/modificarapellido" method="post">
                        {{csrf_field()}}
                        <div class="col-xs-4 collapse-ref">
                          Apellido actual:
                        </div>
                        <div class="col-xs-offset-2 col-xs-6">
                          <input type="text" class="form-control box-control" name="apellido" value="{{Auth::user()->cuentable->apellido}}">
                        </div>
                        <div class="col-xs-offset-6 col-xs-3">
                          <button type="submit" class="btn button-guardar" name="button">Guardar cambios</button>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" class="btn button-guardar" name="button" data-toggle="collapse" id="#apellido">Cancelar</button>
                        </div>
                      </form>
                    </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <span>Correo:</span> {{Auth::user()->email}}
                      </h4>
                    </div>
                    <div id="correo" class="panel-collapse collapse">
                      <div class="panel-body">
                        <form class="horizontal" action="/modificarcorreo" method="post">
                          {{csrf_field()}}
                          <div class="col-xs-4 collapse-ref">
                            Correo actual:
                          </div>
                          <div class="col-xs-offset-2 col-xs-6">
                            <input type="text" class="form-control box-control" name="correo" value="{{Auth::user()->email}}">
                          </div>
                          <div class="col-xs-offset-6 col-xs-3">
                            <button type="submit" class="btn button-guardar" name="button">Guardar cambios</button>
                          </div>
                          <div class="col-xs-3">
                            <button type="button" class="btn button-guardar" name="button" id="nombre" class="collapse out">Cancelar</button>
                          </div>
                        </form>
                      </div>
                      </div>
                    </div>
                    @if(Auth::user()->cuentable->cuentable_type=='App\Empleado')
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <span>Telefono:</span> {{Auth::user()->cuentable->telefono}}<a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#telefono"><i class="material-icons edit-icono">edit</i>Editar</a>
                        </h4>
                      </div>
                      <div id="telefono" class="panel-collapse collapse">
                        <div class="panel-body">
                          <form class="horizontal" action="/modificartelefono" method="post">
                            {{csrf_field()}}
                            <div class="col-xs-4 collapse-ref">
                              Telefono actual:
                            </div>
                            <div class="col-xs-offset-2 col-xs-6">
                              <input type="date" class="form-control box-control" name="fecha_nacimiento" value="{{Auth::user()->cuentable->telefono}}">
                            </div>
                            <div class="col-xs-offset-6 col-xs-3">
                              <button type="submit" class="btn button-guardar" name="button">Guardar cambios</button>
                            </div>
                            <div class="col-xs-3">
                              <button type="button" class="btn button-guardar" name="button" id="nombre" class="collapse out">Cancelar</button>
                            </div>
                          </form>
                        </div>
                        </div>
                      </div>
                      @endif
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <span>Fecha de nacimiento:</span> {{Auth::user()->cuentable->fecha_nacimiento}}<a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#fecha_nacimiento"><i class="material-icons edit-icono">edit</i>Editar</a>
                        </h4>
                      </div>
                      <div id="fecha_nacimiento" class="panel-collapse collapse">
                        <div class="panel-body">
                          <form class="horizontal" action="/modificarfechanacimiento" method="post">
                            {{csrf_field()}}
                            <div class="col-xs-4 collapse-ref">
                              Fecha de nacimiento actual:
                            </div>
                            <div class="col-xs-offset-2 col-xs-6">
                              <input type="date" class="form-control box-control" name="fecha_nacimiento" value="{{Auth::user()->cuentable->fecha_nacimiento}}">
                            </div>
                            <div class="col-xs-offset-6 col-xs-3">
                              <button type="submit" class="btn button-guardar" name="button">Guardar cambios</button>
                            </div>
                            <div class="col-xs-3">
                              <button type="button" class="btn button-guardar" name="button" id="nombre" class="collapse out">Cancelar</button>
                            </div>
                          </form>
                        </div>
                        </div>
                      </div>
                </div>

          </div>
        </div>
      </div>
    <!--  <div class="mensajes">
        <div class="panel panel-dark">
          <div class="panel-heading heading-dark">
            <h3 class="panel-title">Mensajes</h3>
          </div>
          <div class="panel-body scroll">
            @foreach(Auth::user()->get() as $mensaje)
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
        </div>
        <div class="panel-footer">
          <form class="horizontal" action="/enviarMensaje" method="post">
            <div class="col-xs-10">
              <textarea name="mensaje" rows="3" cols="75" class="form-control"></textarea>
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn button-send" name="button"><i class="material-icons text-send">send</i></button>
            </div>
          </form>
        </div>
      </div> -->
        <br>
      <!--  <div class="seguridad">
          <div class="panel-dark">
            <div class="panel-heading heading-dark">
              <h3 class="panel-title">Seguridad</h3>
            </div>
            <div class="panel-body-white">
              <form class="horizontal" action="/cambiarcontrasena" method="post">
                {{csrf_field()}}
                <div class="form-group">
                  <span style="font-family: 'Lobster Two'; font-size: 16px;">Escribe la contraseña actual:</span>
                  <input type="password" name="actualpassword" class="form-control" value="">
                  <br>
                  <span style="font-family: 'Lobster Two'; font-size: 16px;">Escribe tu nueva contraseña</span>
                  <input type="password" name="nuevacontrasena" class="form-control" value="">
                </div>
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary" name="button"><i class="material-icons" style="float: left;">save</i> Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div> -->
        <div class="historial">
          <div class="panel panel-dark">
            <div class="panel-heading heading-dark">
              <h3 class="panel-title">Historial de servicios hechos</h3>
            </div>
              <div class="panel-body">
                <table class="table table-hover">
                  <thead>
                    <th>Servicio</th>
                    <th>Fecha</th>
                  </thead>
                  <tbody>
                    <td>{{App\Cliente::find(3)->citas}}</td>
                  </tbody>
                </table>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
//  $(document).ready(function(){
//    $(".mensajes").hide();
//    $(".seguridad").hide();
//    $(".item-mensaje").click(function(){
//      $(".mensajes").show(500);
//      $(".mensajes").show("slow");
//      $(".perfil").hide(400);
//      $(".perfil").hide("slow");
//      $(".seguridad").hide(500);
//      $(".seguridad").hide("slow");
//    });
//    $(".item-perfil").click(function(){
//      $(".mensajes").hide("slow");
//      $(".perfil").show(400);
//      $(".perfil").show("slow");
//      $(".seguridad").hide(500);
//      $(".seguridad").hide("slow");
//    });
//    $(".item-seguridad").click(function (){
//      $(".perfil").hide(400);
//      $(".perfil").hide("slow");
//      $(".mensajes").hide(500);
//      $(".mensajes").hide("slow");
//      $(".seguridad").show(500);
//      $(".seguridad").show("slow");
//    });
//  });
</script>
@endsection
