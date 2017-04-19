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
    margin-top: 50px;
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
  .nav li.item a:hover::after,
  .nav li.item a:focus::after{
    width: 100%;
  }
  .clase-menu{
    display: block;
    width: 0px;
    height: 2px;
    background: white;
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
    height: 50px;
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
    overflow-y: scroll;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
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
    margin-top: -22px;
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
  .td-realizada{
    background-color: #00BF00;
    color: #1F1F1F;
  }
  .td-pendiente{
    background-color: #BFBF00;
    color: #1F1F1F;
  }
  .panel-title{
    font-size: 20px;
  }
  .panel-body-dark{
    background-color: #3F3F3F;
  }
  .mensaje-cliente{
    padding: 10px 20px;
    border-bottom: 2px solid #1F1F1F;
    color: white;
    font-family: 'Lobster Two';
    font-size: 18px;
    text-align: left;
    letter-spacing: 2px;
  }
  .mensaje-admin{
    padding: 10px 20px;
    border-bottom: 2px solid #1F1F1F;
    color: #ed5;
    font-size: 18px;
    font-family: 'Lobster Two';
    text-align: right;
    letter-spacing: 2px;
  }
  .ancla-mensajes{
    padding: 50px 50px;
    text-align: center;
    background-color: white;
    border-radius: 4px;

  }
  .ancla{
    color: #1F1F1F;
  }
  .body-gris{
    background-color: #3F3F3F;
  }
  .td-pausada{
    background-color: blue;
    color: #1F1F1F;
  }
  .td-finalizada{
    background-color: green;
    color: #1F1F1F;
  }
  .td-cancelada{
    background-color: red;
    color: #1F1F1F;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="cuenta col-md-12">
    @if(Session::has('error'))
        <div class="alert alert-warning" role="alert" style="text-align: center;">
            <h5>{{session('error')['titulo']}}</h5>
            <p><b>{{session('error')['cuerpo']}}</b></p>
        </div>
    @endif
    <div class="col-xs-3">
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active title-nav"><a href="#">Mi cuenta</a></li>
        <li role="presentation" class="item item-perfil"><a href="#" class="item-nav"><i class="material-icons icon-nav">person</i><p>  Profile</p></a></li>
        @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
          <li role="presentation" class="item item-mensajes"><a href="#" class="item-nav"><i class="material-icons icon-nav">forum</i><p> Mensajes</p></a></li>
          <li role="presentation" class="item item-historial-compras"><a href="#" class="item-nav"><i class="material-icons icon-nav">shopping_cart</i><p>  Historial de compras</p></a></li>
        @endif
        @if(Auth::user()->cuentable_type == strval(App\Empleado::class))
          <li role="presentation" class="item item-mensajes-foro"><a href="#" class="item-nav"><i class="material-icons icon-nav">forum</i><p> Mensajes (Foro)</p></a></li>
        @endif
        <li role="presentation" class="item item-historial"><a href="#" class="item-nav"><i class="material-icons icon-nav">history</i><p>  Historial de citas</p></a></li>
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
                  <div class="panel-body panel-body-dark">
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
                    <div class="panel-body panel-body-dark">
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
                      <div class="panel-body panel-body-dark">
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
                        <div class="panel-body panel-body-dark">
                          <form class="horizontal" action="/modificartelefono" method="post">
                            {{csrf_field()}}
                            <div class="col-xs-4 collapse-ref">
                              Telefono actual:
                            </div>
                            <div class="col-xs-offset-2 col-xs-6">
                              <input type="text" class="form-control box-control" name="telefono" value="{{Auth::user()->cuentable->telefono}}">
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
                          <span>Fecha de nacimiento:</span> {{Auth::user()->cuentable->fecha_nacimiento}} ({{\Carbon\Carbon::createFromFormat('Y-m-d',Auth::user()->cuentable->fecha_nacimiento)->diffInYears(\Carbon\Carbon::now())}}años)<a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#fecha_nacimiento"><i class="material-icons edit-icono">edit</i>Editar</a>
                        </h4>
                      </div>
                      <div id="fecha_nacimiento" class="panel-collapse collapse">
                        <div class="panel-body panel-body-dark">
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
      @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
      <div class="mensajes">
        <div class="panel panel-dark">
          <div class="panel-heading heading-dark">
            <h3 class="panel-title">Mensajes</h3>
          </div>
          <div class="panel-body scroll body-gris">
            @foreach($mensajes as $mensaje)
              @if($mensaje->by_cliente==1)
                <div class="mensaje-cliente">
                  <p>{{$mensaje->contenido}}</p>
                </div>
                @else
                <div class="mensaje-admin">
                  <p>{{$mensaje->contenido}}</p>
                </div>
              @endif

            @endforeach
          </div>
        </div>
        <div class="panel-footer">
          <form class="horizontal" action="/enviarMensaje" method="post">
            {{csrf_field()}}
            <div class="col-xs-10">
              <textarea name="contenido" rows="3" cols="75" class="form-control"></textarea>
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn button-send" name="button"><i class="material-icons text-send">send</i></button>
            </div>
          </form>
        </div>
        </div>
        @endif
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
              @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
              <h1 class="panel-title">Historial de citas</h1>
              @else
              <h1 class="panel-title">Historial de citas empleado</h1>
              @endif
            </div>
              <div class="panel-body">
                <table class="table table-hover">
                  <thead>
                    <th>Servicio</th>
                    <th>Fecha y hora</th>
                    <th>Estado</th>
                    <th>Cancelar</th>
                  </thead>
                  <tbody>

                    @foreach($citas as $cit)
                    <tr>
                      @foreach($cit->servicios as $servicios)
                      <td>{{$servicios->nombre}}</td>
                      <td>{{$cit->fecha_hora}}</td>
                      @if($cit->estado==0)
                        <td class="td-pendiente">En espera</td>
                        @elseif($cit->estado==1)
                        <td class="td-realizada">En curso</td>
                        @elseif($cit->estado==2)
                        <td class="td-pausada">En pausa</td>
                        @elseif($cit->estado==3)
                        <td class="td-finalizada">Realizada</td>
                        @elseif($cit->estado==4)
                        <td class="td-cancelada">Cancelada</td>
                      @endif
                      <td><a class="btn btn-danger" href="/cancelarcita/{{$cit->id}}" style="height: 25px;">
                        <i class="material-icons" style="margin-top: -5px;">remove</i></a></td>
                      @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
        <div class="historial-compras">
          <div class="panel panel-dark">
            <div class="panel-heading heading-dark">
              <h1 class="panel-title">Historial de compras</h1>
            </div>
              <div class="panel-body">
                <table class="table table-hover">
                  <thead>
                    <th>Producto</th>
                    <th>Fecha y hora</th>
                    <th>Costo</th>
                  </thead>
                  <tbody>
                    @foreach($compras as $compra)
                    <tr>
                      @foreach($compra->productos as $producto)
                      <td>{{$producto->nombre}}</td>
                      <td>{{$compra->fecha_hora}}</td>
                      <td>{{$producto->precio_venta}}</td>
                      @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        @endif
        @if(Auth::user()->cuentable_type == strval(App\Empleado::class))
        <div class="ancla-mensajes">
          <a href="/admin/forum" class="ancla"><i class="material-icons foro" style="font-size: 50px;">forum</i></a>
          <p>Dar clic en el icono para ir al foro.</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){

    $(".item-perfil").focus();
    $(".historial").hide();
    $(".ancla-mensajes").hide();
    $(".historial-compras").hide();
    $(".mensajes").hide();
    $(".item-historial").click(function(){
      $(".historial").show(500);
      $(".historial").show("slow");
      $(".perfil").hide(400);
      $(".perfil").hide("slow");
      $(".historial-compras").hide(500);
      $(".historial-compras").hide("slow");
      $(".mensajes").hide(500);
      $(".mensajes").hide("slow");
      $(".ancla-mensajes").hide(500);
      $(".ancla-mensajes").hide("slow");
    });
    $(".item-perfil").click(function(){
      $(".historial").hide(500);
      $(".historial").hide("slow");
      $(".perfil").show(400);
      $(".perfil").show("slow");
      $(".historial-compras").hide(500);
      $(".historial-compras").hide("slow");
      $(".mensajes").hide(500);
      $(".mensajes").hide("slow");
      $(".ancla-mensajes").hide(500);
      $(".ancla-mensajes").hide("slow");
    });
    $(".item-historial-compras").click(function(){
      $(".perfil").hide(400);
      $(".perfil").hide("slow");
      $(".historial").hide(500);
      $(".historial").hide("slow");
      $(".historial-compras").show(500);
      $(".historial-compras").show("slow");
      $(".mensajes").hide(500);
      $(".mensajes").hide("slow");
    });
    $(".item-mensajes").click(function(){
      $(".historial").hide(500);
      $(".historial").hide("slow");
      $(".historial-compras").hide(500);
      $(".historial-compras").hide("slow");
      $(".perfil").hide(400);
      $(".perfil").hide("slow");
      $(".mensajes").show(500);
      $(".mensajes").show("slow");
    });
    $(".item-mensajes-foro").click(function(){
      $(".historial").hide(500);
      $(".historial").hide("slow");
      $(".perfil").hide(400);
      $(".perfil").hide("slow");
      $(".ancla-mensajes").show(500);
      $(".ancla-mensajes").show("slow");
    });

  });
</script>
@endsection
