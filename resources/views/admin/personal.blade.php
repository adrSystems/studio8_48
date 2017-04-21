@extends('layouts.master')

@section('title')
Studio8 48 - Personal
@endsection

@section('css')
<style>
  body{
      background: #eee;
      background-image: url('{{asset("img/walls/1.jpg")}}');
      background-repeat: no-repeat;
      background-attachment: fixed;
  }
  .main-container{
    margin-top: 70px;
    width: 100%;
    float: left;
    margin-bottom: 25px;
  }
  h3.main-title{
    border-left: 5px solid #ed5;
    padding-left: 10px;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.7),0 0 10px rgba(0, 0, 0, 0.5);
    font-family: 'Lobster Two';
    color: #ed5;
  }
  #empleados-container{
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    border: 1px solid #999;
    padding: 0px;
    border-radius: 3px;
    background: rgba(255, 255, 255, 0.8);
    overflow: auto;
    max-height: 500px;
    color: #555;
    margin-bottom: 15px;
  }
  #empleados-container::-webkit-scrollbar{
    width: 7px;
  }
  #empleados-container::-webkit-scrollbar-thumb{
    border-radius: 10px;
    background-color: #888;
    border: 1px solid #666;
  }
  .roles{
    color: #777;
  }
  .empleado-item{
    position: relative;
    float: left;
    padding: 10px;
    width: 100%;
    height: 100%;
    -webkit-transition: box-shadow .4s, border .2s, background-color .2s;
  }
  .empleado-item:hover{
    background-color: rgba(255, 255, 255, 0.6);
  }
  .empleado-item>i{
    position: absolute;
    float: right;
    right: 6px;
    font-size: 19px;
    color: #555;
    cursor: pointer;
  }
  .empleado-item>i:hover{
    color:#777;
  }
  .card1{
    padding: 0;
    overflow:hidden;
    color: #578;
    background-color: #fff;
    border-radius: 5px;
    border: 1px solid #bbb;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    margin-bottom: 15px;
  }
  .card1>.header>h4{
    color: #777;
    font-family: 'Lobster Two';
    padding: 15px;
    margin: 0;
  }
  .card1>.header{
    background-color: #ddd;
    margin:0;
    box-shadow: inset 0 -1px 2px #aaa;
    padding: 15px;
    padding-left: 5%;
    padding-right: 5%;
    margin-bottom: 15px;
    width: 110%;
    margin-left: -5%;
  }
  #add-btn{
    display: block;
    margin: auto;
    margin-top: 20px;
  }
  .btn1{
    background: linear-gradient(to bottom, #eee, #ddd);
    border: 1px solid skyblue;
    color: #555;
    padding: 3px 15px 5px 15px;
    font-size: 16px;
    border-radius: 3px;
    -webkit-transition: box-shadow .3s;
  }
  .btn1:hover{
    box-shadow: 0 1px 3px #aaa;
  }
  .white-textbox{
    background-color: rgba(255,255,255,.05);
    box-shadow:inset 0 0 3px #bbb;
    border: 1px solid #bbb;
    color: #555;
    border-radius: 3px;
    padding: 4px 8px 4px 8px;
    margin-bottom: 10px;
    -webkit-transition: color .4s, background-color .3s, box-shadow .4s;
  }
  .white-textbox-xs{
    height: 35px;
    padding-bottom: 7px;
  }
  .white-textbox:hover{
    background-color: rgba(255,255,255,.1);
    color: #777;
  }
  .white-textbox:focus{
    background-color: rgba(255,255,255,.1);
    box-shadow:inset 0 0 10px #888;
    color: goldenrod;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
  }
  .form-group>label{
    font-weight: 200;
  }
  .date-input{
    padding-left: 0;
  }
  .white-container{
    border-radius: 2px;
    border: 1px solid #ccc;
    overflow: hidden;
  }
  .white-container>.item{
    padding: 2px 5px 2px 5px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    -webkit-transition: background-color .2s;
  }
  .white-container>.item:hover{
    background-color: rgba(0,0,0,.1);
  }
  .white-container>.item>.select-icon{
    border-radius: 100%;
    float: right;
    box-shadow: inset 0 0 3px #bbb;
    height: 13px;
    margin-top: 4px;
    width: 13px;
  }
  .white-container>.item>label{
    margin: 0;
    font-weight: 200;
  }
  .second-container{
    -webkit-transition: margin .6s, opacity .4s;
  }
  .rol-selected{
    background-color: dodgerblue;
    border: 1px solid #1e70dd;
  }
  .rol-unselected{
    background-color: transparent;
    border: 1px solid #bbb;
  }
  textarea{
    resize: none;
    width: 100%;
    height: 150px;
  }
  #opciones-estilista, #opciones-estilista-to-edit{
    display: none;
  }
  .img-file-selector{
    padding-top: 10px;
    position: relative;
    border: 1px dashed #bbb;
    border-radius: 2px;
    overflow: hidden;
    text-align: center;
    text-overflow: ellipsis;
  }
  .img-file-selector>p{
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
    display: block;
    overflow: hidden;
  }
  .img-file-selector>input[type=file]{
    background-color: red;
    position: absolute;
    top: -80%;
    left: 0;
    width: 100%;
    height: 180%;
    cursor: pointer;
    opacity: 0;
  }
  .footer{
    background-color: rgba(0,0,0,.5);
    box-shadow: none;
    height: 100%;
    margin: 0;
    border: none;
    text-shadow: 0 0 5px rgba(0,0,0,.8), 0 0 1px rgba(0,0,0,1);
  }
  #help-btn{
    border: 2px solid #ed5;
    background-color: rgba(0,0,0,.5);
    display: block;
    margin: auto;
    box-shadow: 0 0 5px rgba(0,0,0,.6);
  }
  #help-btn:hover{
    background: rgba(0,0,0,.3);
  }
  #help-btn > p{
    margin-top: -5px;
    margin-bottom: -5px;
    font-size: 22px;
    font-weight: 800;
    color: #ed5;
  }
  .footer-link{
    color: #ed5;
    -webkit-transition: color .5s;
    font-family: 'Lato';
    font-weight: 100;
    font-size: 15px;
  }
  .footer-link:link{
    color: #ed5;
    text-decoration: none;
  }
  .footer-link:visited{
    color: #cb4;
    text-decoration: none;
  }
  .footer-link:hover{
    color: #cb4;
  }
  .link1{
    text-decoration: none;
    -webkit-transition: color .3s;
    cursor: pointer;
  }
  .link1:link{
    text-decoration: none;
  }
  .link1:hover{
    text-decoration: none;
  }
  .options-menu>.menu-triangle{
    border-color: transparent;
    border-bottom-color: #fff;
    border-style: dashed dashed solid;
    border-width: 0 8.5px 8.5px;
    position: absolute;
    right: 7px;
    top: -7px;
    z-index: 1;
    height: 0;
    width: 0;
    -webkit-animation: gb__a .2s;
    animation: gb__a .2s;
  }
  .menu-triangle-shadow{
    width: 11px;
    position: absolute;
    height: 1px;
    background-color: #999;
    z-index: 3;
    box-shadow: 0 -1px 3px rgba(0, 0, 0, .3);
    top: -3.5px;
  }
  .menu-triangle-shadow-left{
    right: 14px;
    -webkit-transform: rotate(-41deg);
  }
  .menu-triangle-shadow-right{
    right: 6px;
    -webkit-transform: rotate(41deg);
  }
  .options-menu{
    position: absolute;
    display: none;
    top: 0px;
    width: 100px;
    z-index: 1;
    right: 5px;
  }
  .options-menu>.box{
    position: relative;
    display: table;
    border-radius: 3px;
    width: 100%;
    box-shadow: 0 0 3px rgba(0, 0, 0, .3);
    border: 1px solid #999;
    background-color: white;
  }
  .options-menu>.box>.item{
    position: relative;
    text-decoration: none;
    float: left;
    cursor: pointer;
    color: #777;
    padding: 3px 7px 3px 7px;
    width: 100%;
  }
  .options-menu>.box>.item:hover{
    background-color: rgba(0, 0, 0, 0.05);
    color: goldenrod;
  }
  .empleado-options{
    top: 40px;
    right: 1px;
  }
  #servicios-container{
    max-height: 300px;
    overflow: auto;
  }
  #servicios-container::-webkit-scrollbar{
    background-color: transparent;
    width: 6px;
  }
  #servicios-container::-webkit-scrollbar-thumb{
    border-radius: 50px;
    background-color: dodgerblue;
    border: 1px solid royalblue;
  }
  #empleados-container>strong{
    padding: 10px;
  }
  .empleado-item>div>p{
    margin: 0;
  }
  #servicios-container>.item{
    float: left;
    width: 100%;
  }
  #servicios-container>.item>label{
    margin-top: 13px;
  }
  #servicios-container>.item>.img-container{
    float: left;
    width: 50px;
    height: 50px;
    padding: 1px;
    margin-left: -2px;
    margin-right: 5px;
    overflow: hidden;
    border-radius: 2px;
  }
  #servicios-container>.item>.img-container>img{
    width: 100%;
  }
  #servicios-container>.item>.select-icon{
    margin-top: 18px;
  }
  #servicios-container>.item>.select-icon{
    margin-top: 18px;
  }
  .empleado-item>.img-container{
    background-color: #333;
    padding: 0;
    overflow: hidden;
    width: 10vw;
    height: 10vw;
  }
  .empleado-item>.img-container>img{
    width: 100%;
  }
  .personal>div>.img-container{
    background-color: #333;
    padding: 0;
    border-radius: 3px;
    overflow: hidden;
    display: block;
    margin: auto;
    width: 10vw;
    height: 10vw;
  }
  .personal, .profesional{
    -webkit-transition: opacity 0;
  }
  .personal>div>.img-container>img{
    width: 100%;
  }
  .modal-container{
    background-color: rgba(0, 0, 0, .8);
    width: 100%;
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 15px;
    height: 100%;
    overflow: auto;
    z-index: 2;
    position: fixed;
    display: none;
  }
  .modal-container::-webkit-scrollbar{
    background: transparent;
  }
  .modal-container>.modal-card{
    margin-top: 5%;
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 3px;
    -webkit-transform: scale(.3);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5), 0 0 50px rgba(0, 0, 0, 0.5);
    opacity: 0;
    -webkit-transition: opacity .6s, -webkit-transform .6s;
  }
  .modal-card>.header{
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
  }
  .modal-footer{
    border-top: 1px solid #ddd;
    margin-top: 15px;
  }
  .personal>p{
    color:skyblue;
  }
  .personal>p>span{
    color:#888;
  }
  .info-summary{
    background-color: #eee;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: auto;
    display: table;
    padding: 10px;
    margin: auto;
    text-align: center;
  }
  .info-summary>div>.img-container{
    background-color: #555;
    border-radius: 100%;
    width: 10vw;
    height: 10vw;
    padding: 0;
    overflow: hidden;
    margin: auto;
    display: block;
  }
  .info-summary>div>.img-container>.foto{
    width: 100%;
  }
  #empleados-trashed-container{
    background-color: rgba(255, 255, 255, .8);
    padding: 0;
    border-radius: 3px;
    border: 1px solid #999;
    box-shadow: 0 0 5px rgba(0, 0, 0, .5);
    max-height: 500px;
    margin-bottom: 15px;
  }
  #empleados-trashed-container::-webkit-scrollbar{
    width: 7px;
  }
  #empleados-trashed-container::-webkit-scrollbar-thumb{
    border-radius: 10px;
    background-color: #888;
    border: 1px solid #666;
  }
  .subcontainer{
    background-color: rgba(0, 0, 255, .05);
    border-radius: 5px;
    border: 1px solid rgba(0, 0, 255, .1);
    padding: 15px;
  }
  #servicios-to-edit-container>.item{
    float: left;
    width: 100%;
  }
  #servicios-to-edit-container>.item>label{
    margin-top: 4px;
  }
  #servicios-to-edit-container>.item>.img-container{
    overflow: hidden;
    width: 30px;
    margin-right: 5px;
    height: 30px;
    float: left;
  }
  #img-container-est-foto{
    width: 70%;
    margin-left: 15%;
    overflow: hidden;
    border-radius: 100%;
    -webkit-transition: height .4s, opacity .5s;
  }
  #img-container-est-foto>img{
    width: 100%;
  }
</style>
@endsection

@section('body')

<div class="msg-container" id="kick-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3>Confirmar acción</h3>
    </div>
    <div class="body">
      <p>El empleado ya no podrá tener acceso al sistema y no se le podrá agendar citas. Sin embargo, su información e historial seguirán intactos.</p>
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="close-btn">Cancelar</button>
      <a id="kick-personal-btn">Continuar</a>
    </div>
  </div>
</div>

<div class="modal-container" id="empleado-info">
  <div class="modal-card col-xs-12 col-md-6 col-md-offset-3">
    <div class="header col-xs-12">
      <h4 style="text-align: center;">Detalles del empleado</h4>
    </div>
    <div class="body col-xs-12" style="padding:0;">
      <div class="col-xs-12 col-sm-6 personal" style="padding:0; text-align:center">
        <h5 style="text-align: center;">Personal</h5>
        <div class="col-xs-12">
          <div class="subcontainer">
            <div class="col-xs-12" style="padding: 0; margin: 15px 0 15px 0;">
              <span class="no-foto">Sin fotografía.</span>
              <div class="img-container" id="img-container-est-foto">
                <img src="" alt="" class="foto">
              </div>
            </div>
            <p>Nombre: <br><span class="nombre"></span></p>
            <p>Edad: <br><span class="fecha-nac"></span></p>
            <p>Email: <br><span class="email"></span></p>
            <p class="about-title">Acerca de mi</p>
            <p>
              <span class="about">
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 profesional" style="padding:0;">
        <h5 style="text-align: center;">Profesional</h5>
        <p>Roles</p>
        <div class="white-container roles-container">
        </div>
        <p style="margin-top:15px;">Servicios que aplica</p>
        <div class="white-container servicios-container">
        </div>
      </div>
    </div>
    <div class="modal-footer col-xs-12">
      <button type="button" name="button" class="btn1 close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-container" id="empleado-edit">
  <div class="modal-card col-xs-12 col-md-6 col-md-offset-3">
    <div class="header col-xs-12">
      <h4 style="text-align: center;">Actualizar información del empleado</h4>
    </div>
    <div class="body col-xs-12" style="padding:0;">
      <div class="col-xs-12 col-sm-6" style="padding:0;">
        <div class="info-summary">
          <div class="col-xs-12" style="padding: 0; margin: 15px 0 15px 0;">
            <div class="img-container">
              <img src="{{asset('img/profile_photos/default.gif')}}" alt="" class="foto">
            </div>
          </div>
          <p class="nombre"></p>
          <p class="email"></p>
          <p class="edad"></p>
          <p class="about-title" style="color:skyblue;">Acerca de mi...</p>
          <p class="about"></p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <i class="material-icons">info</i>
        <p>Solo se cambiarán los campos que completes...</p>
        <form class="" action="/edit-personal" method="post" enctype="multipart/form-data" id="edit-emp">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="empId" value="">
          <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="" class="white-textbox white-textbox-xs col-xs-12">
          </div>
          <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="lastName" value="" class="white-textbox white-textbox-xs col-xs-12">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" value="" class="white-textbox white-textbox-xs col-xs-12">
          </div>
          <div class="form-group">
            <label for="" class="">Fecha de nacimiento</label>
            <div class="" style="width:100%;">
              <div class="col-xs-4 date-input">
                <input type="number" name="day" value="" min="1" max="31" class="white-textbox white-textbox-xs day col-xs-12" placeholder="dd" required>
              </div>
              <div class="col-xs-4 date-input">
                <select class="col-xs-12 white-textbox white-textbox-xs" name="month" style="padding-bottom: 5px;">
                  <option value="1">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
              <div class="col-xs-4 date-input" style="padding-right: 0;">
                <input type="number" name="year" value="" min="1900" max="{{date('Y')}}"
                class="white-textbox white-textbox-xs year col-xs-12" placeholder="YYYY">
              </div>
            </div>
          </div>
          <hr style="width:100%;margin-top:60px;">
          <h5>Roles</h5>
          <div class="white-container" id="roles-to-edit-container">
            @foreach(App\Rol::get() as $i => $rol)
            <div class="item" id="{{$rol->id}}"
              @if($i == App\Rol::count()-1) style="border-bottom: none;"@endif>
              <label>{{ucfirst($rol->nombre)}}</label>
              <div class="select-icon rol-unselected">
              </div>
            </div>
            @endforeach
          </div>
          <div class="" id="opciones-estilista-to-edit" style="width:100%;">
            <hr style="width:100%;margin-top:25px;">
            <h5>Servicios que realiza</h5>
            @if(\App\Servicio::count() > 0)
            <div class="white-container" id="servicios-to-edit-container">
              @foreach(\App\Servicio::get() as $i => $servicio)
              <div class="item" id="{{$servicio->id}}"
                @if($i == App\Servicio::count()-1) style="border-bottom: none;"@endif>
                <div class="img-container">
                  <img src="{{asset('storage/'.$servicio->icono)}}" alt="" style="width:100%">
                </div>
                <label>{{ucfirst($servicio->nombre)}}</label>
                <div class="select-icon rol-unselected" style="margin-top:8px">
                </div>
              </div>
              @endforeach
            </div>
            @else
            <p>No se encontraron servicios. Para continuar debes añadirlos.</p>
            @endif
            <hr style="width:100%;margin-top:25px;">
            <h5>Sobre el estilista</h5>
            <textarea name="about" class="white-textbox"></textarea>
            <h5>Fotografía</h5>
            <div class="img-file-selector col-xs-12">
              <p>Haz click o arrastra un archivo...</p>
              <input type="file" name="foto" value="" accept="image/jpeg,.png,.gif">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer col-xs-12">
      <button type="button" name="button" class="btn1 close-btn" style="margin-right:10px;">Cancelar</button>
      <button type="button" name="button" class="btn1" id="edit-btn">Aceptar</button>
    </div>
  </div>
</div>

<div class="main-container">

  <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-bottom:10px;">
    <h3 class="main-title">Administración de personal</h3>
  </div>

  <div class="col-xs-12 col-md-offset-1 col-md-5 second-container">
    <div class="col-xs-12" id="empleados-container">
      @if(App\Empleado::count() < 1)
      <strong style="color:#555;padding:5px">No se encontraron empleados en el sistema</strong>
      @else
      @foreach(App\Empleado::get() as $empleado)
      <div class="empleado-item">
        <div class="options-menu empleado-options" id="{{$empleado->id}}">
          <div class="menu-triangle-shadow menu-triangle-shadow-left">
          </div>
          <div class="menu-triangle-shadow menu-triangle-shadow-right">
          </div>
          <div class="menu-triangle">
          </div>
          <div class="box">
            <a class="item info">Información</a>
            <a class="item edit">Editar</a>
            <a class="item kick">Desactivar</a>
          </div>
        </div>
        <div class="img-container col-xs-4">
          @if($empleado->fotografia)
          <img src="{{asset('storage/'.$empleado->fotografia)}}" alt="">
          @else
          <img src="{{asset('img/profile_photos/default.gif')}}" alt="">
          @endif
        </div>
        <div class="col-xs-8">
          <span style="color: 000;">{{$empleado->nombre." ".$empleado->apellido}}</span>
            @if($empleado->id == \Auth::user()->cuentable->id)
            <span class="glyphicon glyphicon-user" aria-hidden="true" style="color:#aaa;font-size:12px;margin-left:10px;"></span>
            @endif
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
        <i class="material-icons more-btn" id="{{$empleado->id}}">more_vert</i>
      </div>
      @endforeach
      @endif
    </div>
    @if(\App\Empleado::count() == 1)
    <p style="color: white; text-shadow: 0 0 3px rgba(0,0,0,1),0 0 10px rgba(0,0,0,.5); text-align:right;">{{\App\Empleado::count()." empleado encontrado."}}</p>
    @else
    <p style="color: white; text-shadow: 0 0 3px rgba(0,0,0,1),0 0 10px rgba(0,0,0,.5); text-align:right;">{{\App\Empleado::count()." empleados encontrados."}}</p>
    @endif
    <h4 style="text-shadow: 0 0 2px rgba(0,0,0,1),0 0 10px rgba(0,0,0,.5);color:#fff;">Inactivos ({{\App\Empleado::onlyTrashed()->count()}})</h4>
    <div class="col-xs-12" id="empleados-trashed-container">
      @if(App\Empleado::onlyTrashed()->count() < 1)
      <strong style="color:#555;padding:5px">No se encontraron empleados inactivos en el sistema</strong>
      @else
      @foreach(App\Empleado::onlyTrashed()->get() as $empleado)
      <div class="empleado-item">
        <div class="options-menu empleado-options" id="{{$empleado->id}}">
          <div class="menu-triangle-shadow menu-triangle-shadow-left">
          </div>
          <div class="menu-triangle-shadow menu-triangle-shadow-right">
          </div>
          <div class="menu-triangle">
          </div>
          <div class="box">
            <a class="item info">Información</a>
            <a class="item restore" href="/restore-personal/{{$empleado->id}}">Restaurar</a>
          </div>
        </div>
        <div class="img-container col-xs-4">
          @if($empleado->fotografia)
          <img src="{{asset('storage/'.$empleado->fotografia)}}" alt="">
          @else
          <img src="{{asset('img/profile_photos/default.gif')}}" alt="">
          @endif
        </div>
        <div class="col-xs-8">
          <span style="color: 000;">{{$empleado->nombre." ".$empleado->apellido}}</span>
            @if($empleado->id == \Auth::user()->cuentable->id)
            <span class="glyphicon glyphicon-user" aria-hidden="true" style="color:#aaa;font-size:12px;margin-left:10px;"></span>
            @endif
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
        <i class="material-icons more-btn" id="{{$empleado->id}}">more_vert</i>
      </div>
      @endforeach
      @endif
    </div>
  </div>

  <div class="col-xs-12 col-md-offset-1 col-md-4 second-container">
    <div id="add-container" class="col-xs-12 card1">
      <div class="header">
        <h4>Añadir nuevo personal</h4>
      </div>
      <div class="col-xs-12">
        <form class="" action="/add-personal" method="post" enctype="multipart/form-data" id="add-emp">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="{{old('name')}}" class="white-textbox white-textbox-xs col-xs-12" required>
          </div>
          <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="lastName" value="{{old('lastName')}}" class="white-textbox white-textbox-xs col-xs-12" required>
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" value="{{old('email')}}" class="white-textbox white-textbox-xs col-xs-12" required>
            <a class="link1" style="float:left;text-align:right; width: 100%;" id="email-help">¿Porque necesito proporcionar esto?</a>
          </div>
          <div class="form-group">
            <label for="" class="">Fecha de nacimiento</label>
            <div class="" style="width:100%;">
              <div class="col-xs-4 date-input">
                <input type="number" name="day" value="{{old('day')}}" min="1" max="31" class="white-textbox white-textbox-xs day col-xs-12" placeholder="dd" required>
              </div>
              <div class="col-xs-4 date-input">
                <select class="col-xs-12 white-textbox white-textbox-xs" name="month" style="padding-bottom: 5px;" required="true">
                  <option value="1" selected="true">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
              <div class="col-xs-4 date-input" style="padding-right: 0;">
                <input type="number" name="year" value="{{old('year')}}" min="1900" max="{{date('Y')}}"
                class="white-textbox white-textbox-xs year col-xs-12" placeholder="YYYY" required>
              </div>
            </div>
          </div>
          <hr style="width:100%;margin-top:60px;">
          <h5>Roles</h5>
          <div class="white-container" id="roles-container">
            @foreach(App\Rol::get() as $i => $rol)
            <div class="item" id="{{$rol->id}}"
              @if($i == App\Rol::count()-1) style="border-bottom: none;"@endif>
              <label>{{ucfirst($rol->nombre)}}</label>
              <div class="select-icon rol-unselected">
              </div>
            </div>
            @endforeach
          </div>
          <div class="" id="opciones-estilista" style="width:100%;">
            <hr style="width:100%;margin-top:25px;">
            <h5>Servicios que realiza</h5>
            @if(\App\Servicio::count() > 0)
            <div class="white-container" id="servicios-container">
              @foreach(\App\Servicio::get() as $i => $servicio)
              <div class="item" id="{{$servicio->id}}"
                @if($i == App\Servicio::count()-1) style="border-bottom: none;"@endif>
                <div class="img-container">
                  <img src="{{asset('storage/'.$servicio->icono)}}" alt="">
                </div>
                <label>{{ucfirst($servicio->nombre)}}</label>
                <div class="select-icon rol-unselected">
                </div>
              </div>
              @endforeach
            </div>
            @else
            <p>No se encontraron servicios. Para continuar debes añadirlos.</p>
            @endif
            <hr style="width:100%;margin-top:25px;">
            <h5>Sobre el estilista</h5>
            <textarea name="about" class="white-textbox"></textarea>
            <h5>Fotografía</h5>
            <div class="img-file-selector col-xs-12">
              <p>Haz click o arrastra un archivo...</p>
              <input type="file" name="foto" value="" accept="image/jpeg,.png,.gif">
            </div>
          </div>
          <div class="form-group" style="float:left;width:100%;">
            <button type="submit" name="button" id="add-btn" class="btn1">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function () {

    $('.more-btn').click(function () {
      var $btn = $(this);
      $.each($('.empleado-options'), function (i, e) {
        if($(e).attr('id') != $btn.attr('id')){
          $(e).fadeOut();
        }
        else{
          if($(e).css('display') != 'block'){
            $(e).fadeIn();
          }
          else{
            $(e).fadeOut();
          }
        }
      });
    });

    function showModal(id) {
      $('.modal-container[id='+id+']').fadeIn(200);
      setTimeout(function () {
        $('.modal-container>.modal-card').css({
          'opacity':'1',
          'webkit-transform':'scale(1)'
        });
      }, 200);
    };

    function mostrarInfoEmp(empleadoId) {
      $.ajax({
        url: '/getEmpleadoById',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          id:empleadoId
        }
      }).done(function (empleado) {
        var $body = $('#empleado-info>.modal-card>.body');
        $body.find('.nombre').text(empleado.nombre+' '+empleado.apellido);
        $body.find('.fecha-nac').text(empleado.edad+" años ("+empleado.fecha_nacimiento+")");
        $body.find('.email').text(empleado.email);
        if(empleado.fotografia != null){
          $body.find('.no-foto').css('display', 'none');
          $body.find('.img-container').css('display', 'block');
          $body.find('.foto').attr('src', empleado.fotografia);
        }
        else{
          $body.find('.no-foto').css('display', 'block');
          $body.find('.img-container').css('display', 'none');
        }
        if(empleado.info){
          $body.find('.about').text(empleado.info);
          $body.find('.about').css('display','block');
          $body.find('.about-title').css('display','block');
        }
        else{
          $body.find('.about-title').css('display','none');
          $body.find('.about').css('display','none');
        }
        $('.profesional>.roles-container').children().remove();
        $.each(empleado.roles, function (i, rol) {
          var $item = $('<div class="item">');
          $item.append($('<label>'+rol.nombre.charAt(0).toUpperCase()+rol.nombre.slice(1)+'</label>'));
          $('.profesional>.roles-container').append($item);
        });
        $('.profesional>.servicios-container').children().remove();
        $.each(empleado.servicios, function (i, servicio) {
          var $item = $('<div class="item">');
          $item.append($('<label>'+servicio.nombre+'</label>'));
          $('.profesional>.servicios-container').append($item);
        });
      });

    }

    function closeModal(id) {
      $('.modal-container>.modal-card').css({
        'opacity':'0',
        'webkit-transform':'scale(.6)'
      });
      $('.modal-container[id='+id+']').delay(300).fadeOut(600);
    };

    $('.empleado-options>.box>.info').click(function () {
      mostrarInfoEmp($(this).parent().parent().attr('id'));
      $(this).parent().parent().hide();
      $('#img-container-est-foto').css({
        opacity:'0',
        height: '20px'
      });
      setTimeout(function () {
        showModal('empleado-info');
        setTimeout(function () {
            $('#img-container-est-foto').css({
              'height': $('#img-container-est-foto').width(),
              opacity: 1
            })
        }, 700)
      } ,200);
    });

    $('.empleado-options>.box>.kick').click(function () {
      showMsgDialog();
      $('#kick-personal-btn').attr('href','/kick-personal/'+$(this).parent().parent().attr('id'));
    });

    function mostrarInfoEmpToEdit(empId) {
      $.ajax({
        url: '/getEmpleadoById',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          id:empId
        }
      }).done(function (emp) {
        $('form[id=edit-emp]').children('input[type=hidden][name=empId]').val(emp.id);
        if(emp.fotografia == null){
          $('#empleado-edit>.modal-card').find('.foto').attr('src','{{asset("img/profile_photos/default.gif")}}');
        }
        else{
          $('#empleado-edit>.modal-card').find('.foto').attr('src',emp.fotografia);
        }
        $('#empleado-edit>.modal-card').find('p.nombre').text(emp.nombre+" "+emp.apellido);
        $('#empleado-edit>.modal-card').find('p.email').text(emp.email);
        $('#empleado-edit>.modal-card').find('p.edad').text(emp.fecha_nacimiento+" ("+emp.edad+" años)");
        if(emp.info != null){
          $('#empleado-edit>.modal-card').find('p.about').text(emp.info);
          $('#empleado-edit>.modal-card').find('p.about').css('display','block');
          $('#empleado-edit>.modal-card').find('p.about-title').css('display','block');
        }
        else{
          $('#empleado-edit>.modal-card').find('p.about').css('display','none');
          $('#empleado-edit>.modal-card').find('p.about-title').css('display','none');
        }
        $('form#edit-emp').find('input[name=name]').val('');
        $('form#edit-emp').find('input[name=lastName]').val('');
        $('form#edit-emp').find('input[name=email]').val('');
        $('form#edit-emp').find('input[name=day]').val('');
        $('form#edit-emp').find('input[name=year]').val('');
        $('form#edit-emp').find('textarea[name=about]').val('');
        $('form#edit-emp').find('input[name=foto]').val('');
        $('form#edit-emp').find('.img-file-selector>p').text('Haz click o arrastra un archivo...');
        $('form#edit-emp').children('input[type=hidden][name="roles[]"]').remove();
        $('form#edit-emp').children('input[type=hidden][name="servicios[]"]').remove();
        $('#roles-to-edit-container>.item>.select-icon').removeClass('rol-selected');
        $('#roles-to-edit-container>.item>.select-icon').addClass('rol-unselected');
        $('#servicios-to-edit-container>.item>.select-icon').removeClass('rol-selected');
        $('#servicios-to-edit-container>.item>.select-icon').addClass('rol-unselected');
        $.each(emp.roles, function (i, rol) {
          $('#roles-to-edit-container>.item[id='+rol.id+']').children('.select-icon').removeClass('rol-unselected');
          $('#roles-to-edit-container>.item[id='+rol.id+']').children('.select-icon').addClass('rol-selected');
          $('form[id=edit-emp]').append($('<input type="hidden" name="roles[]" value="'+rol.id+'">'));
          if(rol.id == {{\App\Rol::where('nombre','estilista')->first()->id}}){
            $('#opciones-estilista-to-edit').show(400);
          }
        });

        $.each(emp.servicios, function (i,servicio) {
          $('#servicios-to-edit-container>.item[id='+servicio.id+']').children('.select-icon').removeClass('rol-unselected');
          $('#servicios-to-edit-container>.item[id='+servicio.id+']').children('.select-icon').addClass('rol-selected');
          $('form[id=edit-emp]').append($('<input type="hidden" name="servicios[]" class="servicio" value="'+servicio.id+'">'));
        });
      });
    }

    $('.empleado-options>.box>.edit').click(function () {
      mostrarInfoEmpToEdit($(this).parent().parent().attr('id'));
      $(this).parent().parent().hide();
      setTimeout(function () {
        showModal('empleado-edit');
      } ,200);
    });

    $('#edit-btn').click(function () {
      var serviciosCount = $('form[id=edit-emp]').children('input[type=hidden][name="servicios[]"]').length;
      var roles = [];
      $.each($('form[id=edit-emp]').children('input[type=hidden][name="roles[]"]'), function (i, rolInput) {
        roles[i] = $(rolInput).val();
      });
      $.ajax({
        url:'/getEmpleadoById',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          id:$('form[id=edit-emp]').children('input[type=hidden][name=empId]').val()
        }
      }).done(function (emp) {
        $.ajax({
          url:'/getAdminCount',
          type:'post',
          dataType:'json'
        }).done(function (count) {
          var email = $('form[id=edit-emp]').find('input[name=email]').val();
          $.ajax({
            url:'/emailIsRepeted',
            type: 'post',
            dataType:'json',
            data:{
              _token: '{{csrf_token()}}',
              id: emp.id,
              email: email
            }
          }).done(function (response) {
            var eraEstilista = false;
            var eraAdmin = false;
            $.each(emp.roles, function (i, rol) {
              if(rol.id == '{{\App\Rol::where("nombre","estilista")->first()->id}}'){
                eraEstilista=true;
              }
              else if(rol.id == '{{\App\Rol::where("nombre","administrador")->first()->id}}'){
                eraAdmin = true;
              }
            });
            var estilistaIndex = roles.indexOf('{{\App\Rol::where("nombre","estilista")->first()->id}}');
            var adminIndex = roles.indexOf('{{\App\Rol::where("nombre","administrador")->first()->id}}');
            var year = $('form[id=edit-emp]').find('input[name=year]').val();
            var dia = $('form[id=edit-emp]').find('input[name=day]').val();
            if(roles.length < 1){
              showMsg('Error!',["El empleado debe tener por lo menos un rol."]);
            }
            else if(estilistaIndex > -1 && serviciosCount < 1){
              showMsg('Error!',["Los estilistas deben aplicar por lo menos un servicio."]);
            }
            else if(!eraEstilista && $('form[id=edit-emp]').find('textarea[name=about]').val() == '' && estilistaIndex > -1){
              showMsg('Error!',['Intentas otorgar el privilegio de estilista a este empleado, por lo que debe especificarse la información "Acerca del estilista".']);
            }
            else if(!eraEstilista && $('form[id=edit-emp]').find('input[name=foto]').val() == '' && estilistaIndex > -1){
              showMsg('Error!',['Intentas otorgar el privilegio de estilista a este empleado, por lo que debe tener una fotografía.']);
            }
            else if(roles.indexOf('{{\App\Rol::where("nombre","estilista")->first()->id}}') > -1 && serviciosCount < 1){
              showMsg('Error!',["Los estilistas deben aplicar por lo menos un servicio."]);
            }
            else if(eraAdmin && adminIndex < 0 && count < 2){
              showMsg('Error!',["No es posible revocar el rol de administrador. El sistema debe contar con minimo un administrador"]);
            }
            else if(dia != '' && year == ''){
              showMsg('Error!',["Especifica el año.","Si no deseas modificar la fecha, deja en blanco los campos dia y año."]);
            }
            else if(year != '' && dia == ''){
              showMsg('Error!',["Especifica el dia.","Si no deseas modificar la fecha, deja en blanco los campos dia y año."]);
            }
            else if(dia != '' && (dia < 1 || dia > 31)){
              showMsg('Error!',["Escriba un dia valido. (1-31)"]);
            }
            else if(year != '' && (year < 1900 || year > '{{date("Y")}}')){
              showMsg('Error!',["Escriba un año valido. (1900-{{date('Y')}})"]);
            }
            else if(email != '' && response.result){
              showMsg('Error!',["El correo electronico ya está asociado a otra cuenta."]);
            }
            else if(email != '' && !isValidEmail(email)){
              showMsg('Error!',["El formato de email es incorrecto."]);
            }
            else{
              $('form[id=edit-emp]').submit();
            }
          });
        });
      });
    });

    function isValidEmail(email) {
      var arrobaIndex= email.indexOf('@');
      var domain = email.slice(arrobaIndex+1, email.length);
      if(arrobaIndex < 0){
        return false;
      }
      else if(arrobaIndex == email.length - 1){
        return false;
      }
      else if(email.charAt(email.length - 1) == '.'){
        return false;
      }
      else if(domain.indexOf('.') < 0){
        return false;
      }
      return true;
    }

    $('.modal-footer>.close-btn').click(function () {
      closeModal($(this).parent().parent().parent().attr('id'));
    });

    $('#email-help').click(function () {
        showMsg('Ayuda', [
          'Debes proporcionar el email del personal puesto que este se le requerirá para el inicio de sesión en el sistema.',
          'Se le enviarán al empleado sus datos de inicio de sesión en el email proporcionado.'
        ]);
      });

    $('#roles-container').children('.item').click(function () {
      if($(this).children('.select-icon').hasClass('rol-unselected')){
        $(this).children('.select-icon').removeClass('rol-unselected');
        $(this).children('.select-icon').addClass('rol-selected');
        $('form[id=add-emp]').append($('<input type="hidden" name="roles[]" value="'+$(this).attr('id')+'">'));
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista').show(400);
        }
      }
      else{
        $(this).children('.select-icon').removeClass('rol-selected');
        $(this).children('.select-icon').addClass('rol-unselected');
        $('form[id=add-emp]').children('input[type=hidden][value='+$(this).attr('id')+']').remove();
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista').hide(400);
          $('form[id=add-emp]').children('input[type=hidden][class=servicio]').remove();
          $('#servicios-container>.item>.select-icon').removeClass('rol-selected');
          $('#servicios-container>.item>.select-icon').addClass('rol-unselected');
        }
      }
    });

    $('#roles-to-edit-container').children('.item').click(function () {
      if($(this).children('.select-icon').hasClass('rol-unselected')){
        $(this).children('.select-icon').removeClass('rol-unselected');
        $(this).children('.select-icon').addClass('rol-selected');
        $('form[id=edit-emp]').append($('<input type="hidden" name="roles[]" value="'+$(this).attr('id')+'">'));
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista-to-edit').show(400);
        }
      }
      else{
        $(this).children('.select-icon').removeClass('rol-selected');
        $(this).children('.select-icon').addClass('rol-unselected');
        $('form[id=edit-emp]').children('input[type=hidden][value='+$(this).attr('id')+']').remove();
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista-to-edit').hide(400);
          $('form[id=edit-emp]').children('input[type=hidden][class=servicio]').remove();
          $('#servicios-to-edit-container>.item>.select-icon').removeClass('rol-selected');
          $('#servicios-to-edit-container>.item>.select-icon').addClass('rol-unselected');
        }
      }
    });

    $('#servicios-container').children('.item').click(function () {
      if($(this).children('.select-icon').hasClass('rol-unselected')){
        $(this).children('.select-icon').removeClass('rol-unselected');
        $(this).children('.select-icon').addClass('rol-selected');
        $('form[id=add-emp]').append($('<input type="hidden" name="servicios[]" class="servicio" value="'+$(this).attr('id')+'">'));
      }
      else{
        $(this).children('.select-icon').removeClass('rol-selected');
        $(this).children('.select-icon').addClass('rol-unselected');
        $('form[id=add-emp]').children('input[type=hidden][class=servicio][value='+$(this).attr('id')+']').remove();
      }
    });

    $('#servicios-to-edit-container').children('.item').click(function () {
      if($(this).children('.select-icon').hasClass('rol-unselected')){
        $(this).children('.select-icon').removeClass('rol-unselected');
        $(this).children('.select-icon').addClass('rol-selected');
        $('form[id=edit-emp]').append($('<input type="hidden" name="servicios[]" class="servicio" value="'+$(this).attr('id')+'">'));
      }
      else{
        $(this).children('.select-icon').removeClass('rol-selected');
        $(this).children('.select-icon').addClass('rol-unselected');
        $('form[id=edit-emp]').children('input[type=hidden][class=servicio][value='+$(this).attr('id')+']').remove();
      }
    });

    $('.img-file-selector').children('input[type=file]').change(function () {
      if($(this)[0].files.length > 0){
        $(this).parent().children('p').text($(this)[0].files[0].name);
      }
      else{
        $(this).parent().children('p').text('Haz click o arrastra un archivo...');
      }
    });

    $('.msg-footer>button').click(function () {
      $('.msg-card').css('-webkit-transform','scale(.7)');
      $('.msg-card').parent().fadeOut(400, function () {
        $(this).hide();
      });
    });

    function showMsgDialog() {
      $('#kick-dialog').show(0);
      $('#kick-dialog>.msg-card').css('opacity',1);
      $('#kick-dialog>.msg-card').css('margin-top','100px');
      $('#kick-dialog>.msg-card').css('-webkit-transform','scale(1)');
    }

    function showMsg(title, body) {
      $('#general-msg').show(0);
      $('#general-msg>.msg-card').css('opacity',1);
      $('#general-msg>.msg-card').css('margin-top','100px');
      $('#general-msg>.msg-card').css('-webkit-transform','scale(1)');
      $('#general-msg>.msg-card>.header>h3').text(title);
      $('#general-msg>.msg-card>.body').children().remove();
      $.each(body, function (i, paragraph) {
        $('#general-msg>.msg-card>.body').append('<p>'+paragraph);
      });
    }

    if('{{old("month")}}' != ''){
      $('select[name="month"]').children('option[value='+'{{old("month")}}'+']').attr('selected','true');
    }

    @if(old('about'))
    $('textarea').val('{{old("about")}}');
    @endif

    @if(old("roles"))
    var roles = [];
    @foreach(old('roles') as $i => $rol)
    roles[{{$i}}] = {{$rol}};
    @endforeach
    $.each(roles, function (i,rol) {
      $('#roles-container>.item[id='+rol+']').children('.select-icon').removeClass('rol-unselected');
      $('#roles-container>.item[id='+rol+']').children('.select-icon').addClass('rol-selected');
      $('form[id=add-emp]').append($('<input type="hidden" name="roles[]" value="'+rol+'">'));
      if(rol == {{\App\Rol::where('nombre','estilista')->first()->id}}){
        $('#opciones-estilista').show(400);
      }
    });
    @endif

    @if(old("servicios"))
    var servicios = [];
    @foreach(old('servicios') as $i => $servicio)
    servicios[{{$i}}] = {{$servicio}};
    @endforeach
    $.each(servicios, function (i,servicio) {
      $('#servicios-container>.item[id='+servicio+']').children('.select-icon').removeClass('rol-unselected');
      $('#servicios-container>.item[id='+servicio+']').children('.select-icon').addClass('rol-selected');
      $('form[id=add-emp]').append($('<input type="hidden" name="servicios[]" class="servicio" value="'+servicio+'">'));
    });
    @endif

    @if(session('msg'))
    showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
    @endif

  });
</script>
@endsection
