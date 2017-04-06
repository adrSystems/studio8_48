@extends('layouts.master')
@section('title')
Registro
@endsection
@section('css')
<style type="text/css">
#form{
	color: #C5B358;
}
body{
	color:#c5b358;
	background-color: #efe;
	font-family: 'Lato';
	background-image: url('{{asset("img/walls/2.jpg")}}');
	background-size: 100% 100%;
	background-repeat: no-repeat;
}
input{
	background-color: rgba(255, 255, 255, 0.3);
	color:#444;
	border-radius: 3px;
	border: 1px solid #ddd;
	padding: 5px 15px 5px 15px;
	width: 100%;
	-webkit-transition: background-color .3s;
}
input::-webkit-input-placeholder{
	color: #ccc;
}
input:focus{
	background-color: rgba(255, 255, 255, 0.4);
	color:#fff;
}
.white-btn1{
	background-color: rgba(0,0,0,0);
	border: 1px solid #fff;
	border-radius: 3px;
	padding: 4px 10px 4px 10px;
	color: #eee;
	text-decoration: none;
	-webkit-transition: background-color .4s;
}
.white-btn1:hover{
	color: white;
	background-color: rgba(255,255,255,.3);
	text-decoration: none;
}
.white-btn1:visited{
	color: white;
	text-decoration: none;
}
.white-btn1:active{
	color: white;
	text-decoration: none;
}
.white-btn1:link{
	color: white;
	text-decoration: none;
}
#contenedor{
	float: left;
	margin-top: 80px;
	margin-bottom:150px;
	width: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	padding-top: 30px;
	padding-bottom: 30px;
}
h1{
	margin: 0;
	padding: 0;
	font-family: 'Lobster Two';
	text-shadow: 0 0 2px black;
	border-left-width: 15px;
}
label{
	text-align: left;
	padding: 0;
	color: #fff;
	font-weight: 200;
	text-shadow: 0 0 2px rgba(0, 0, 0, 1);
}

.input-container{
	margin-bottom: 15px;
	padding: 0;
}
.footer{
	box-shadow: 0 -3px 5px rgba(0, 0, 0, 0.5);
}
</style>
@endsection
@section('body')
<div class="container">
@if(Session::has('error'))
<br>
    @foreach(Session::get('error') as $mensajes)
    <div class="alert alert-warning" role="alert">

        {{$mensajes}}

    </div>
    @endforeach
@endif
@if(Session::has('cuenta_repetida'))
<br>
    @foreach(Session::get('cuenta_repetida') as $mensaje)
    <div class="alert alert-warning" role="alert">

        {{$mensaje}}

    </div>
    @endforeach
@endif
</div>
<div class="container" id="contenedor">
	<div class="col-xs-12 col-md-6 registro-container">
		  <h1 class="col-xs-12 col-xs-offset-1 col-md-10 col-md-offset-1" style="padding:0">Registro</h1><br><br>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form">
				<input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
	      <div class="input-container col-xs-11 col-xs-offset-1">
	         <label for="inputName" class="col-xs-12" style="padding:0">Nombre:</label>
	         <div class="col-xs-12" style="padding:0;">
	             <input type="text" class="input-login" placeholder="Escribe tu nombre" name="nombre">
	         </div>
				 </div>
					 <div class="input-container col-xs-11 col-xs-offset-1">
	 	         <label for="inputName" class="col-xs-12" style="padding:0">Apellidos:</label>
	 	         <div class="col-xs-12" style="padding:0;">
	 	             <input type="text" class="input-login" placeholder="Escribe tus apellidos" name="apellidos">
	 	         </div>
					 </div>
					 <div class="input-container col-xs-11 col-xs-offset-1">
						<label for="inputName" class="col-xs-12" style="padding:0">Telefono:</label>
						<div class="col-xs-12" style="padding:0;">
								<input type="text" class="input-login" placeholder="Escribe tu numero telefonico" name="telefono">
						</div>
					</div>
					 <div class="input-container col-xs-11 col-xs-offset-1">
						<label for="inputName" class="col-xs-12" style="padding:0">Email:</label>
						<div class="col-xs-12" style="padding:0;">
								<input type="email" class="input-login" placeholder="Escribe tu email" name="email">
						</div>
					</div>
					<div class="input-container col-xs-11 col-xs-offset-1">
					 <label for="inputName" class="col-xs-12" style="padding:0">Contraseña:</label>
					 <div class="col-xs-12" style="padding:0;">
							 <input type="password" class="input-login" placeholder="Escribe tu contraseña" name="pass" id="pass">
					 </div>
				 </div>
				 <div class="input-container col-xs-11 col-xs-offset-1">
					<label for="inputName" class="col-xs-12" style="padding:0">Repite tu contraseña:</label>
					<div class="col-xs-12" style="padding:0;">
							<input type="password" class="input-login" placeholder="Vuelve a escribir tu contraseña" name="validar_pass">
					</div>
				</div>
				<div class="input-container col-xs-11 col-xs-offset-1">
				 <label for="inputName" class="col-xs-12" style="padding:0">Fecha de nacimiento:</label>
				 <div class="col-xs-12" style="padding:0;">
						 <input type="date" class="input-login"  name="fecha">
				 </div>
			 </div>
			 <div class="input-container col-xs-11 col-xs-offset-1">
				<label for="inputName" class="col-xs-12" style="padding:0">Subir Imagen de perfil:</label>
				<div class="col-xs-12" style="padding:0;">
						<input type="file" class="input-login" name="imagen" accept="image/jpeg">
				</div>
			</div>
			<div class="input-container">
        <div class="col-xs-offset-1 col-xs-11" style="padding:0">
           <button type="submit" class="white-btn1" id="subir" style="margin:auto;">Registrarse</button>
        </div>
      </div>
			</form>
</div>
</div>
<div id="wrapper">
		<div id="header"></div>
		<div id="content"></div>
		<div id="footer"></div>
	</div>
@endsection
@section('js')
<script type="text/javascript">
var $formulario= $('form');
    var $evento= $('#subir');
    var result=$formulario.validate({
        rules:
        {
            nombre:
            {
                required:true
            },
            apellidos:
            {
                required:true
            },
						telefono:
						{
							required:true
						},
            email:
            {
                required:true,
                email:true
            },
            pass:
            {
                required:true
            },
            validar_pass:
            {
                required:true,
                equalTo:"#pass"
            },
            fecha:
            {
                required:true
            }

        },
        messages:
        {
            nombre:
            {
                required:"Este campo es requerido"
            },
            apellidos:
            {
                required:"Este campo es requerido"
            },
						telefono:
						{
							required:"Este campo es requerido"
						},
            email:
            {
                required:"Este campo es requerido",
                email:"Escribe una direccion de correo valida"
            },
            pass:
            {
                required:'Ingresa tu contraseña'
            },
            validar_pass:
            {
                required:"Confirma tu contraseña",
                equalTo:"Las contraseñas deben ser iguales"
            },
            fecha:
            {
                required:"Este campo es requerido"
            }
        }

    });
    $('#subir').click(function(event){
        event.stopPropagation();
        event.preventDefault();
        if($formulario.valid())
            {
                $formulario.submit();
            }
    });
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
		$('.msg-footer>button').click(function () {
			$('.msg-card').css('-webkit-transform','scale(.7)');
			$('.msg-card').parent().fadeOut(400, function () {
				$(this).hide();
			});
		});

		@if(session('msg'))
		showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
		@endif
</script>
@endsection
