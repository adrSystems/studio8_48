@extends('layouts.master')

@section('title')
Studio8 48 - Personal
@endsection

@section('css')
<style>
  body{
      background: #111;
  }
  .main-container{
    margin-top: 70px;
    width: 100%;
    float: left;
    margin-bottom: 25px;
  }
  h3{
    border-left: 5px solid #fff;
    padding-left: 10px;
    font-family: 'Lobster Two';
    color: #fff;
  }
  #empleados-container{
    box-shadow: 0 2px 5px #000;
    border: 1px solid #555;
    padding: 0px;
    border-radius: 3px;
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
    background-color: #111;
    padding: 0;
    overflow:hidden;
    color: #ccc;
    box-shadow: 0 1px 3px #000;
    border-radius: 5px;
    border: 1px solid #222;
    margin-bottom: 15px;
  }
  #add-container>.header>h4{
    color: white;
    margin: 0;
  }
  #add-container>.header{
    background-color: dodgerblue;
    margin:0;
    padding: 15px;
    margin-bottom: 15px;
    width: 100%;
  }
  #add-btn{
    background: dodgerblue;
    border: 1px solid skyblue;
    color: white;
    padding: 3px 15px 5px 15px;
    font-size: 16px;
    border-radius: 3px;
    margin-top: 20px;
  }
  .black-textbox{
    background-color: rgba(255,255,255,.05);
    border: 1px solid #999;
    color: #ccc;
    border-radius: 3px;
    padding: 4px 8px 4px 8px;
    margin-bottom: 10px;
    -webkit-transition: color .4s, background-color .3s;
  }
  .black-textbox-xs{
    height: 35px;
    padding-bottom: 7px;
  }
  .black-textbox:hover{
    background-color: rgba(255,255,255,.1);
    color: #fff;
  }
  .form-group>label{
    font-weight: 200;
  }
  .date-input{
    padding-left: 0;
  }
  select>option{
    background-color: #111;
  }
  .roles-container{
    border-radius: 2px;
    border: 1px solid #333;
  }
  .roles-container>.item{
    padding: 2px 5px 2px 5px;
    cursor: pointer;
    -webkit-transition: background-color .2s;
  }
  .roles-container>.item:hover{
    background-color: rgba(255,255,255,.1);
  }
  .roles-container>.item>.select-icon{
    border-radius: 100%;
    border: 1px solid #fff;
    float: right;
    height: 13px;
    margin-top: 4px;
    width: 13px;
  }
  .roles-container>.item>label{
    margin: 0;
    font-weight: 200;
  }
  .second-container{
    -webkit-transition: margin .6s, opacity .4s;
  }
  .rol-selected{
    background-color: dodgerblue;
  }
  .rol-unselected{
    background-color: transparent;
  }
  textarea{
    resize: none;
    width: 100%;
    height: 150px;
  }
  #opciones-estilista{
    display: none;
  }
  .img-file-selector{
    padding-top: 10px;
    position: relative;
    border: 1px dashed #ccc;
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
  .msg-container{
    position: fixed;
    z-index: 5;
    top: 0;
    left: 0;
    display: none;
    padding: 10px;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
  }
  .msg-container>.msg-card{
    background-color: #fff;
    border: 1px solid #aaa;
    box-shadow: 0 0 100px #000;
    margin-top: 40px;
    border-radius: 3px;
    padding: 0px;
    opacity: 0;
    overflow: hidden;
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .5s, opacity .4s, margin-top .4s;
  }
  .msg-container>.msg-card>.header>h3{
    font-family: 'Lobster Two';
    color: goldenrod;
    padding: 0;
    margin: 0;
    margin-left: 0px;
    border-width: 0px;
  }
  .msg-container>.msg-card>.header{
    background: #eee;
    box-shadow: inset 0 0 2px #999;
    padding: 8px 10px 10px 10px;
  }
  .msg-container>.msg-card>.body{
    padding: 30px 10px 30px 10px;
    text-align: center;
  }
  .msg-container>.msg-card>.msg-footer{
    padding: 10px;
    box-shadow: 0 0 2px #999;
    background: #eee;
  }
  .msg-container>.msg-card>.msg-footer>button{
    border: 1px solid goldenrod;
    border-radius: 2px;
    padding: 3px 10px 3px 10px;
    margin: auto;
    display: block;
    -webkit-transition: box-shadow .3s;
  }
  .msg-container>.msg-card>.msg-footer>button:hover{
    box-shadow: 0 1px 2px #aaa;
  }
</style>
@endsection

@section('body')
<div class="msg-container">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3>Title</h3>
    </div>
    <div class="body">
      Message
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="main-container">
  <div class="col-xs-12 col-md-10 col-md-offset-1">
    <h3 class="">Personal</h3>
  </div>
  <div class="col-xs-12 col-md-offset-1 col-md-5 second-container">
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
  <div class="col-xs-12 col-md-offset-1 col-md-4 second-container">
    <div id="add-container" class="col-xs-12">
      <div class="header">
        <h4>Nuevo personal</h4>
      </div>
      <div class="col-xs-12">
        <form class="" action="/add-personal" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="{{old('name')}}" class="black-textbox black-textbox-xs col-xs-12">
          </div>
          <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="lastName" value="{{old('lastName')}}" class="black-textbox black-textbox-xs col-xs-12">
          </div>
          <div class="form-group">
            <label for="" class="">Fecha de nacimiento</label>
            <div class="" style="width:100%;">
              <div class="col-xs-4 date-input">
                <input type="number" name="day" value="{{old('day')}}" min="1" max="31" class="black-textbox black-textbox-xs day col-xs-12" placeholder="dd">
              </div>
              <div class="col-xs-4 date-input">
                <select class="col-xs-12 black-textbox black-textbox-xs" name="month" style="padding-bottom: 5px;">
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
                class="black-textbox black-textbox-xs year col-xs-12" placeholder="YYYY">
              </div>
            </div>
          </div>
          <hr style="width:100%;margin-top:60px;">
          <h5>Roles</h5>
          <div class="roles-container">
            @foreach(App\Rol::get() as $rol)
            <div class="item" id="{{$rol->id}}">
              <label>{{ucfirst($rol->nombre)}}</label>
              <div class="select-icon rol-unselected">

              </div>
            </div>
            @endforeach
          </div>
          <div class="" id="opciones-estilista" style="width:100%;">
            <hr style="width:100%;margin-top:25px;">
            <h5>Sobre el estilista</h5>
            <textarea name="about" class="black-textbox" ></textarea>
            <h5>Fotografía</h5>
            <div class="img-file-selector col-xs-12">
              <p>Haz click o arrastra un archivo...</p>
              <input type="file" name="foto" value="" accept="image/jpeg,.png,.gif">
            </div>
          </div>
          <div class="form-group" style="float:left;width:100%;">
            <button type="submit" name="button" id="add-btn">Agregar</button>
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

    $('.roles-container').children('.item').click(function () {
      if($(this).children('.select-icon').hasClass('rol-unselected')){
        $(this).children('.select-icon').removeClass('rol-unselected');
        $(this).children('.select-icon').addClass('rol-selected');
        $('form').append($('<input type="hidden" name="roles[]" value="'+$(this).attr('id')+'">'));
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista').show(400);
        }
      }
      else{
        $(this).children('.select-icon').removeClass('rol-selected');
        $(this).children('.select-icon').addClass('rol-unselected');
        $('input[type=hidden][value='+$(this).attr('id')+']').remove();
        if($(this).children('label').text().toLowerCase() == 'estilista'){
          $('#opciones-estilista').hide(400);
        }
      }

      $('.img-file-selector').children('input[type=file]').change(function () {
        if($(this)[0].files.length > 0){
          console.log($(this)[0].files[0].name);
          $(this).parent().children('p').text($(this)[0].files[0].name);
        }
        else{
          $(this).parent().children('p').text('Haz click o arrastra un archivo...');
        }
      });
    });

    $('.msg-footer>button').click(function () {
      $('.msg-card').css('-webkit-transform','scale(.7)');
      $('.msg-card').parent().fadeOut(400, function () {
        $(this).hide();
      });
    });

    function showMsg(title, body) {
      $('.msg-container').show(0);
      $('.msg-card').css('opacity',1);
      $('.msg-card').css('margin-top','100px');
      $('.msg-card').css('-webkit-transform','scale(1)');
      $('.msg-card>.header>h3').text(title);
      $('.msg-card>.body').text(body);
    }

    if('{{old("month")}}' != ''){
      $('select[name="month"]').children('option[value='+'{{old("month")}}'+']').attr('selected','true');
    }

    @if(old("roles"))
    var roles = [];
    @foreach(old('roles') as $i => $rol)
    roles[{{$i}}] = {{$rol}};
    @endforeach
    $.each(roles, function (i,rol) {
      $('.roles-container>.item[id='+rol+']').children('.select-icon').removeClass('rol-unselected');
      $('.roles-container>.item[id='+rol+']').children('.select-icon').addClass('rol-selected');
      $('form').append($('<input type="hidden" name="roles[]" value="'+rol+'">'));
      if(rol == {{\App\Rol::where('nombre','estilista')->first()->id}}){
        $('#opciones-estilista').show(400);
      }
    });
    @endif

    @if(session('msg'))
    showMsg("{{session('msg')['title']}}","{{session('msg')['body']}}");
    @endif

  });
</script>
@endsection
