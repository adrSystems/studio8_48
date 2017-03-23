<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Primer uso</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|EB+Garamond|Alegreya|Cookie|Lobster|Lobster+Two|Lato|Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{elixir('css/bootstrap.css')}}">
    <link href="{{elixir('css/app.css')}}" type="text/css" rel="stylesheet">
    <style media="screen">
      body{
        font-family: 'Lato';
        text-align: center;
      }
      .card{
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 2px;
        padding: 15px;
        box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05);
        margin-top: 15px;
        margin-bottom: 15px;
      }
      .input1{
        border: 1px solid #ddd;
        border-radius: 2px;
        padding: 3px 5px 3px 5px;
        -webkit-transition: box-shadow .4s;
      }
      .input1:focus{
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
      }
      .btn1{
        background: linear-gradient(to bottom,#5fb4ff,dodgerblue);
        border: 1px solid #0c80ee;
        color: #fff;
        border-radius: 3px;
        min-width: 100px;
        margin-bottom: 5px;
        -webkit-transition: box-shadow .4s;
      }
      .btn1:hover{
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.5);
      }
      #step2{
        display: none;
      }
      #error{
        display: none;
        color: #e54;
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
      #opciones-estilista, #opciones-estilista-to-edit{
        display: none;
        margin-top: 15px;
        margin-bottom: 15px;
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
      textarea{
        resize: none;
        width: 100%;
        height: 150px;
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
    </style>
  </head>
  <body>
    <h3 style="margin-top:80px;">Bienvenido al asistente de configuración</h3>
    <div class="col-xs-12" style="margin-bottom:30px">
      <form class="" action="/signup-admin" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="card col-xs-12 col-md-6 col-md-offset-3" id="step1">
          <p class="col-xs-10 col-xs-offset-1">No hemos detectado ningún administrador.
            A continuación crearás tu cuenta con la cual podrás administrar a tu personal, los servicios y productos, entre otras cosas.</p>
          <h5 class="col-xs-12" style="margin-top:30px;">Información personal</h5>
          <div class="form-group col-xs-12">
            <input type="text" name="name" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="nombre...">
          </div>
          <div class="form-group col-xs-12">
            <input type="text" name="lastName" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="apellido...">
          </div>
          <div class="form-group col-xs-12">
            <input type="date" name="birthday" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="fecha de nacimiento...">
          </div>
          <div class="col-xs-12">
            <p>Cuenta</p>
          </div>
          <div class="form-group col-xs-12">
            <input type="email" name="email" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="email...">
          </div>
          <div class="form-group col-xs-12">
            <input type="password" name="password" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="password...">
          </div>
          <div class="form-group col-xs-12" style="margin-bottom:30px;">
            <input type="password" name="password-confirmation" value="" class="input1 col-xs-12 col-md-8 col-md-offset-2" placeholder="repite el password...">
          </div>
          <div class="col-xs-12">
            <button type="button" name="button" class="btn1" id="next">Siguiente</button>
          </div>
        </div>
        <div class="card col-xs-12 col-md-6 col-md-offset-3" id="step2">
          <p class="col-xs-10 col-xs-offset-1">Otorga los privilegios y roles de usuario.</p>
          <div class="white-container" id="roles-container" style="width:100%;">
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
            <h5>Sobre el estilista</h5>
            <textarea name="about" class="white-textbox"></textarea>
            <h5>Fotografía</h5>
            <div class="img-file-selector col-xs-12">
              <p>Haz click o arrastra un archivo...</p>
              <input type="file" name="foto" value="" accept="image/jpeg,.png,.gif">
            </div>
            <div class="alert alert-warning col-xs-12" role="alert" style="margin-top:15px">
              <strong>Importante!</strong> Por favor, no olvides determinar los servicios que apliques una vez que añadas servicios al sistema.
              Esto lo podrás hacer en la sección "personal".
            </div>
          </div>
          <div class="col-xs-12" style="margin-top:30px;">
            <button type="button" name="button" class="btn1" id="back">Atras</button>
            <button type="button" name="button" class="btn1" id="finish">Terminar</button>
          </div>
        </div>
      </form>
      <div class="col-xs-12">
        <p id="error" class="col-xs-12"></p>
      </div>
    </div>
    <script src="{{elixir('js/jquery-3.1.1.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function () {

        $('input').keypress(function (e) {
          if(e.which == '13'){
            e.preventDefault();
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

        $('#next').click(function () {
          if($('#step1').find('input[name=name]').val() == ''
          || $('#step1').find('input[name=lastName]').val() == ''
          || $('#step1').find('input[name=email]').val() == ''
          || $('#step1').find('input[name=password]').val() == ''){
            $('#error').fadeIn(300);
            $('#error').text('Completa todos los campos.');
          }
          else if($('#step1').find('input[name=birthday]').val() == ''){
            $('#error').fadeIn(300);
            $('#error').text('Ingresa una fecha de nacimiento valida.');
          }
          else if(!isValidEmail($('#step1').find('input[name=email]').val())){
            $('#error').fadeIn(300);
            $('#error').text('Ingresa un email valido.');
          }
          else if($('#step1').find('input[name=password]').val().length < 6){
            $('#error').fadeIn(300);
            $('#error').text('La contraseña debe tener al menos 6 caracteres.');
          }
          else if($('input[name=password]').val() != $('input[name=password-confirmation]').val()){
            $('#error').fadeIn(300);
            $('#error').text('La contraseñas contraseñas no coinciden.');
          }
          else{
            $('#error').fadeOut(300);
            $('#step1').slideUp(500,function () {
              $('#step2').slideDown(500);
            });
          }
        });

        $('#roles-container').children('.item').click(function () {
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
            $('form').children('input[type=hidden][value='+$(this).attr('id')+']').remove();
            if($(this).children('label').text().toLowerCase() == 'estilista'){
              $('#opciones-estilista').hide(400);
            }
          }
        });

        $('#back').click(function () {
          $('#step2').slideUp(500,function () {
            $('#step1').slideDown(500);
          });
        });

        $('#finish').click(function () {
          if($('input[type=hidden][name="roles[]"]').length < 1){
            $('#error').fadeIn(300);
            $('#error').text('Selecciona al menos un servicio.');
          }
          else if($('input[type=hidden][name="roles[]"][value={{\App\Rol::where("nombre","administrador")->first()->id}}]').length < 1){
            $('#error').fadeIn(300);
            $('#error').text('Debes ser administrador.');
          }
          else if($('input[type=hidden][name="roles[]"][value={{\App\Rol::where("nombre","estilista")->first()->id}}]').length > 0
          && ($('input[name=foto]').val() == '' || $('textarea[name=about]').val() == '')){
            $('#error').fadeIn(300);
            $('#error').text('Al ser estilista debes proporcionar una fotografía y dar una descripción personal sobre ti.');
          }
          else{
            $('#step2').slideUp(500,function () {
              $('form').submit();
            });
          }
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
      });
    </script>
  </body>
</html>
