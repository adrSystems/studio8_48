@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')
<style media="screen">
 body{
   background-image: url("{{asset('img/walls/4.jpg')}}");
   background-repeat: repeat;
   background-attachment: fixed;
 }
  .cuenta{
    margin-top: 100px;
  }
  .footer{
    margin-top: 30px;
  }
  .a-image{
    border-radius: 100%;
    width: 90%;
  }
  .foto{
    text-align: center;
    height: 500px;
  }
  @media screen and (max-width:800px) {
    .foto{display:none;}
  }
  .foro{
    background-color: white;
    border-radius: 4px;
    text-align: center;
    padding: 50px;
  }
  .inputfile {
	  width: 0.1px;
	  height: 0.1px;
	  opacity: 0;
    text-align: center;
	  overflow: hidden;
	  position: absolute;
	  z-index: -1;
  }
  .inputfile + label{
    width: 100%;
    text-align: center;
    margin-top: 10px;
    border-bottom: 1px solid #3F3F3F;
    border-top: 1px solid #3F3F3F;
    font-size: 12px;
    font-weight: 100;
    font-family: Tahoma;
    color: white;
    background: rgba(255, 255, 255, 0.1);
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
  }
  .inputfile:focus + label,
  .inputfile + label:hover {
    opacity: 0.7;
  }
  .nav{
    border-bottom: 1px solid white;
    font-family: 'Lobster Two';
    text-align: center;
  }
  .nav li.item a{
    background-color: transparent;
    border: 0px;
    border-radius: 0px;
    text-decoration: none;
    color: #808B96;
    font-size: 18px;
    width: 120px;
    cursor: pointer;
  }
  .nav li.item a:hover{
    color: #FBFCFC;
  }
  .nav li.active a{
    border-bottom: 4px solid #FBFCFC;
    color: #FBFCFC;
  }
  .nav li.active a:hover,
  .nav li.active a:focus{
    background-color: transparent;
    color: #FBFCFC;
  }
  .detalles-cuenta{
    margin-top: 30px;
  }
  .icons{
    float: left;
    font-size: 18px;
  }
  .panel{
    border: 0px;
  }
  .body-dark{
    background-color: #1F1F1F;
  }
  .descripcion{
    color: white;
  }
  .btn{
    margin-top: 10px;
  }
  .panel-footer{
    height: 105px;
  }
  .texta{
    width: 90%;
    float: left;
  }
  .btn-send{
    height: 40px;
    width: 40px;
    border-radius: 50%;
    margin-left: 20px;
    margin-top: 20px;
    text-align: center;
    font-size: 20px;
    color: #ed5;
    border: 2px solid #ed5;
    background-color: #1F1F1F;
  }
  .heading-dark{
    background-color: #1F1F1F;
    color: white;
    font-family: 'Lobster Two';
    font-size: 20px;
    height: 40px;
  }
  .bandeja{
    background-color: white;
    overflow-y: scroll;
    height: 300px;
  }
  .bandeja::-webkit-scrollbar{
    width: 0.5em;
  }
  .bandeja::-webkit-scrollbar-track{
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
  }
  .bandeja::-webkit-scrollbar-thumb{
    background: #3F3F3F;
    outline: 1px solid black;
  }
  .bandeja::-webkit-scrollbar-thumb:window-inactive {
    background: #bbb;
    box-shadow: 0 0 8px rgba(0,0,0,0.3) inset;
  }
  .mensaje-cliente{
    font-family: 'Lobster Two';
    margin-top: 10px;
    font-size: 16px;
    padding: 5px 15px;
    background-color: black;
    text-align: right;
    border-radius: 4px;
    border-top: 0px solid transparent;
    border-bottom: 15px solid transparent;
    border-right: 15px solid white;
    color: #ed5;
  }
  .mensaje-admin{
    font-family: 'Lobster Two';
    color: white;
    font-size: 16px;
    padding: 5px 15px;
    background-color: #3F3F3F;
    box-shadow: 10px 10px 5px #888888;
    border-radius: 4px;
    text-align: left;
    border-top: 0px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid white;
    margin-top: 10px;
  }
  .remitente{
    margin-top: -12px;
    background-color: #1F1F1F;
    padding: 4px;
    border-radius: 4px;
  }
  th{
    text-align: center;
  }
  .td-pendiente{
    background-color: #DAA520;
    border-radius: 4px;
    height: 5px;
  }
  .td-realizada{

  }
  .td-pausada{
    background-color: #191970;
    border-radius: 4px;
  }
  .td-finalizada{
    background-color: #32CD32;
    border-radius: 4px;
  }
  .td-cancelada{
    background-color: #D5210F;
    border-radius: 4px;
  }
  .error{
    margin-top: -15px;
    text-align: center;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="cuenta">

    <div class="col-xs-3 col-md3 foto">
      @if(Auth::user()->photo)
      <a href="#"><img class="a-image" src="{{asset('storage/'.Auth::user()->photo)}}" alt=""></a>
      <form class="horizontal" action="/subirfoto" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" id="file" class="inputfile form-control" name="foto" value="">
          <label for="file">Cambiar foto de perfil</label>
          <button type="submit" name="button" class="btn"><i class="material-icons icons">camera</i>Subir foto de perfil</button>
        </div>
      </form>
      @else
      <a href="#"><img class="a-image" src="{{asset('img/profile_photos/default.gif')}}" alt=""></a>
      <form class="horizontal" action="/subirfoto" method="post" enctype="multipart/form-data">
        <div class="form-group">
          {{csrf_field()}}
          <input type="file" id="file" class="inputfile form-control" name="foto" value="">
          <label for="file">Cambiar foto de perfil</label>
          <button type="submit" name="button" class="btn"><i class="material-icons icons">camera</i>Subir foto de perfil</button>
        </div>
      </form>
      @endif
    </div>

    <div class="col-xs-offset-1 col-xs-8 col-md-offset-1 col-md-8 detalles">
      <ul class="nav nav-pills" style="">
        <li role="presentation" class="item active item-perfil"><a>Perfil</a></li>
        @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
        <li role="presentation" class="item item-mensajes"><a>Mensajes</a></li>
        @else
        <li role="presentation" class="item item-mensajes"><a>Foro</a></li>
        @endif
        <li role="presentation" class="item item-citas"><a>Citas</a></li>
        @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
        <li role="presentation" class="item item-compras"><a>Compras</a></li>
        @endif
      </ul>

      <div class="detalles-cuenta">
      <div class="perfil">
        <div class="panel-group" id="accordion">

          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Nombre: {{Auth::user()->cuentable->nombre}}<a href="#nombre" class="pull-right" data-toggle="collapse" data-parent="#accordion"><i class="material-icons icons">edit</i></a></h3>
            </div>
            <div class="collapse" id="nombre">
              <div class="panel-body body-dark">
                <div class="alert alert-warning" role="alert">
                  <b><i class="material-icons icons">info_outline</i> Cambiar nombre!</b> En esta sección podra cambiar su nombre de perfil será visible para todos los usuarios.
                </div>
                <form class="horizontal" action="/modificarnombre" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                    <div class="col-xs-4 col-md-4 descripcion">
                      Nombre:
                    </div>
                    <div class="col-xs-offset-1 col-md-offset-1 col-xs-7 col-md-7">
                      <input type="text" name="nombre" value="{{Auth::user()->cuentable->nombre}}" class="form-control">
                      <div class="pull-right">
                        <button type="submit" name="button" class="btn">Guardar cambios</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Apellido: {{Auth::user()->cuentable->apellido}}<a href="#apellido" class="pull-right" data-toggle="collapse" data-parent="#accordion"><i class="material-icons icons">edit</i></a></h3>
            </div>
            <div class="collapse" id="apellido">
              <div class="panel-body body-dark">
                <div class="alert alert-warning" role="alert">
                  <b><i class="material-icons icons">info_outline</i>Cambiar apellido(s)!</b> En esta sección podra modificar su(s) apellido(s) será visible para todos los usuarios.
                </div>
                <form class="horizontal" action="/modificarapellido" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                    <div class="col-xs-4 col-md-4 descripcion">
                      Apellido(s):
                    </div>
                    <div class="col-xs-offset-1 col-md-offset-1 col-xs-7 col-md-7">
                      <input type="text" name="apellido" value="{{Auth::user()->cuentable->apellido}}" class="form-control">
                      <div class="pull-right">
                        <button type="submit" name="button" class="btn">Guardar cambios</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Teléfono: {{Auth::user()->cuentable->telefono}} <a href="#telefono" class="pull-right" data-toggle="collapse" data-parent="#accordion"><i class="material-icons icons">edit</i></a></h3>
            </div>
            <div class="collapse" id="telefono">
              <div class="panel-body body-dark">
                <div class="alert alert-warning" role="alert">
                  <b><i class="material-icons icons">info_outline</i>Cambiar número de teléfono! </b>En está sección podra modificar su número de teléfono será visible para todos los usuarios.
                </div>
                <form class="horizontal" action="/modificartelefono" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                    <div class="col-xs-4 col-md-4 descripcion">
                      Teléfono:
                    </div>
                    <div class="col-xs-offset-1 col-md-offset-1 col-xs-7 col-md-7">
                      <input type="text" name="telefono" value="{{Auth::user()->cuentable->telefono}}" class="form-control">
                      <div class="pull-right">
                        <button type="submit" name="button" class="btn">Guardar cambios</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Fecha de nacimiento: {{Auth::user()->cuentable->fecha_nacimiento}} <b>({{\Carbon\Carbon::createFromFormat('Y-m-d',Auth::user()->cuentable->fecha_nacimiento)->diffInYears(\Carbon\Carbon::now())}}años)</b></h3>
            </div>
          </div>

        </div>
      </div>

      @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
      <div class="mensajes">
        @if(Session::has('msg'))
          <div class="alert alert-danger" role="alert">
            <div class="error">
              <h3>{{Session('msg')['title']}}</h3>
              <p><b>{{Session('msg')['body']}}</b></p>
            </div>
          </div>
        @endif
        <div class="panel">
          <div class="panel-heading heading-dark">
            <h3 class="panel-title" style=" font-size: 20px;"><i class="material-icons icons">message</i> Mensajes</h3>
          </div>
          <div class="panel-body bandeja">
            @if($mensajes)
               @foreach($mensajes as $mensaje)
                @if($mensaje->by_cliente == 1)
                  <div class="mensaje-cliente">
                    <p class="remitente">Tú</p>
                    <p class="contenido-cliente">{{$mensaje->contenido}}</p>
                  </div>
                @else
                  <div class="mensaje-admin">
                    <p class="remitente">Admin</p>
                    <p class="contenido-admin">{{$mensaje->contenido}}</p>
                  </div>
                @endif
               @endforeach
            @endif
          </div>
          <div class="panel-footer">
            <form class="horizontal" action="/enviarMensaje" method="post">
              {{csrf_field()}}
              <div class="form-group">
                  <textarea name="contenido" rows="3" cols="50" class="form-control texta"></textarea><button type="submit" class="btn btn-send" name="button"><i class="material-icons icons" style="margin-left: -2px;">send</i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @else
      <div class="mensajes foro">
        <a href="/admin/forum"><i class="material-icons" style="font-size: 24px;">forum</i></a>
        <p>Dar clic en el icono para ir al foro</p>
      </div>
      @endif

      <div class="citas">
        <div class="panel">
          <div class="panel-heading" style="background-color: #1F1F1F; color: white; font-family: 'Lobster Two'; height: 40px;">
            <h2 class="panel-title" style=" font-size: 20px;"><i class="material-icons icons">history</i> Historial de citas</h2>
          </div>
          <div class="panel-body bandeja" style="background-color: white;">
            <div class="col-xs-12">
            <table class="table" style="text-align: center; color: black;">
              <tr>
                  <th>Servicio</th>
                  <th>Fecha y hora</th>
                  <th>Estado</th>
                  @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
                  <th>Acción</th>
                  @endif
              </tr>
              @if($citas)
              <tbody style="color: black; ">
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
                    @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
                    <td>
                      @if(!$cit->estado==4)
                      <a class="btn btn-danger form-control" data-toggle="modal" data-target="#cancelar" style="margin-top: -3px;">
                        Cancelar
                      </a>
                      @else
                      <a href="#" class="btn btn-success form-control" style="margin-top: -3px;">Nueva cita</a>
                      @endif
                    </td>
                    <div class="modal fade" id="cancelar" role="dialog" tabindex="-1">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" name="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Cancelar</h4>
                          </div>
                          <div class="modal-body" style="text-align: center;">
                            ¿Desea cancelar su cita?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="reset" class="btn btn-primary aceptar" id="{{$cit->id}}">Aceptar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    @endforeach
                  </tr>
                @endforeach
              </tbody>
              @endif
            </table>
          </div>
          </div>
        </div>
      </div>

      @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
      <div class="compras">
        <div class="panel">
          <div class="panel-heading heading-dark">
            <h4 class="panel-title" style="font-size: 20px;"><i class="material-icons icons">shopping_cart</i>Compras</h4>
          </div>
          <div class="panel-body bandeja" style="height: 300px;">
            <div class="col-xs-12">
            <table class="table table-hover">
              <thead>
                <th>Producto</th>
                <th>Fecha y hora</th>
                <th>Costo</th>
              </thead>
              <tbody>
              @if($compras)
              @foreach($compras as $compra)
                <tr>
                @foreach($compra->productos as $producto)
                <td>{{$producto->nombre}}</td>
                <td>{{$compra->fecha_hora}}</td>
                <td>{{$producto->precio_venta}}</td>
                @endforeach
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
      @endif

    </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
  $(".mensajes").hide()
  $(".citas").hide()
  $(".compras").hide()
  $(".item-perfil").click(function(){
    $(".item-mensajes").removeClass("active")
    $(".item-citas").removeClass("active")
    $(".item-compras").removeClass("active")
    $(this).addClass("active")
    $(".perfil").show(500)
    $(".perfil").show("slow")
    $(".mensajes").hide(500)
    $(".mensajes").hide("slow")
    $(".citas").hide(500)
    $(".citas").hide("slow")
    $(".compras").hide(500)
    $(".compras").hide("slow")
  })
  $(".item-mensajes").click(function(){
    $(".item-perfil").removeClass("active")
    $(".item-citas").removeClass("active")
    $(".item-compras").removeClass("active")
    $(this).addClass("active")
    $(".perfil").hide(500)
    $(".perfil").hide("slow")
    $(".mensajes").show(500)
    $(".mensajes").show("slow")
    $(".citas").hide(500)
    $(".citas").hide("slow")
    $(".compras").hide(500)
    $(".compras").hide("slow")
  })
  $(".item-citas").click(function(){
    $(".item-mensajes").removeClass("active")
    $(".item-perfil").removeClass("active")
    $(".item-compras").removeClass("active")
    $(this).addClass("active")
    $(".perfil").hide(500)
    $(".perfil").hide("slow")
    $(".mensajes").hide(500)
    $(".mensajes").hide("slow")
    $(".citas").show(500)
    $(".citas").show("slow")
    $(".compras").hide(500)
    $(".compras").hide("slow")
  })
  $(".item-compras").click(function(){
    $(".item-mensajes").removeClass("active")
    $(".item-citas").removeClass("active")
    $(".item-perfil").removeClass("active")
    $(this).addClass("active")
    $(".perfil").hide(500)
    $(".perfil").hide("slow")
    $(".mensajes").hide(500)
    $(".mensajes").hide("slow")
    $(".citas").hide(500)
    $(".citas").hide("slow")
    $(".compras").show(500)
    $(".compras").show("slow")
  })
  $(".aceptar").click(function(){
    var $btn = $(this);
    $.ajax({
      url: '/cancelarCita',
      data:{
        id: $(this).attr('id'),
        _token: '{{csrf_token()}}'
      },
      type: 'POST'
    }).done(function(response){
      window.location.reload()
    })
  })
</script>
<script type="text/javascript">
  function reloadPage(){
    location.reload(true)
  }
  setInterval('reloadPage()','60000')
</script>
@endsection
