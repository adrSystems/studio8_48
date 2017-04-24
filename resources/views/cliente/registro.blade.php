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
		background-color: #fff;
		font-family: 'Lato';
		background-size: contain;
		background-attachment: fixed;
		background-repeat: no-repeat;
	}
	.white-card1{
		background-color: #fff;
		border-radius: 3px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
		border: 1px solid rgba(0, 0, 0, .2);
	}
	.textbox4{
		width: 100%;
	}
</style>
@endsection
@section('body')
<div class="main-container">
	<div class="container">
		<div class="col-xs-12 col-md-6 white-card1">
			  <div class="col-xs-12">
			  	<h3 class="dark-text1 col-xs-12 col-xs-offset-1 col-md-10 col-md-offset-1" style="padding:0">Registro</h3>
					<h4 class="dark-text3 col-xs-12 col-xs-offset-1 col-md-10 col-md-offset-1" style="padding:0">Para brindarte un mejor servicio, necesitamos que llenes la siguiente información</h4>
			  </div>
				<form class="form-horizontal" method="post" enctype="multipart/form-data" id="form">
					<input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
		      <div class="input-container col-xs-10 col-xs-offset-1">
		         <label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Nombre:</label>
		         <div class="col-xs-12" style="padding:0;">
		             <input type="text" class="textbox4" placeholder="Escribe tu nombre" name="nombre" value="{{old('nombre')}}">
		         </div>
					 </div>
						 <div class="input-container col-xs-10 col-xs-offset-1">
		 	         <label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Apellidos:</label>
		 	         <div class="col-xs-12" style="padding:0;">
		 	             <input type="text" class="textbox4" placeholder="Escribe tus apellidos" name="apellidos" value="{{old('apellidos')}}">
		 	         </div>
						 </div>
						 <div class="input-container col-xs-10 col-xs-offset-1">
							<label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Telefono:</label>
							<div class="col-xs-12" style="padding:0;">
									<input type="text" class="textbox4 phone" placeholder="Escribe tu numero telefonico" name="telefono" value="{{old('telefono')}}">
							</div>
						</div>
						 <div class="input-container col-xs-10 col-xs-offset-1">
							<label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Email:</label>
							<div class="col-xs-12" style="padding:0;">
									<input type="email" class="textbox4" placeholder="Escribe tu email" name="email" value="{{old('email')}}">
							</div>
						</div>
						<div class="input-container col-xs-10 col-xs-offset-1">
						 <label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Contraseña:</label>
						 <div class="col-xs-12" style="padding:0;">
								 <input type="password" class="textbox4" placeholder="Escribe tu contraseña" name="password" id="password" value="">
						 </div>
					 </div>
					 <div class="input-container col-xs-10 col-xs-offset-1">
						<label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Repite tu contraseña:</label>
						<div class="col-xs-12" style="padding:0;">
								<input type="password" class="textbox4" placeholder="Vuelve a escribir tu contraseña" name="confirmacion" value="">
						</div>
					</div>
					<div class="input-container col-xs-10 col-xs-offset-1">
					 <label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Fecha de nacimiento:</label>
					 <div class="col-xs-12" style="padding:0;">
							 <input type="date" class="textbox4"  name="fecha" value="{{old('fecha')}}">
					 </div>
				 </div>
				 <div class="input-container col-xs-10 col-xs-offset-1">
					<label for="inputName" class="col-xs-12 dark-text2 subtitle4" style="padding:0">Subir Imagen de perfil:</label>
					<div class="img-file-selector col-xs-12">
						<p>Haz click o arrastra un archivo...</p>
						<input type="file" name="imagen" value="" accept="image/jpeg,.png,.gif" value="">
					</div>
				</div>
				<div class="input-container">
	        <div class="col-xs-offset-1 col-xs-10" style="margin-top:30px;padding:0;margin-bottom:15px">
	           <button type="submit" class="mybtn1 center" style="margin:auto;">Registrarse</button>
	        </div>
	      </div>
				</form>
		</div>
		<div class="col-xs-12 col-md-6" style="height:100%;">
			<img src="{{asset('img/covers/4.jpg')}}" alt="" height="auto" width="100%">
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">

		$(document).ready(function () {

			function showMsg(title, body) {
				$('#general-msg').show(0);
				$('#general-msg>.msg-card').css('opacity',1);
				$('#general-msg>.msg-card').css('margin-top','100px');
				$('#general-msg>.msg-card').css('-webkit-transform','scale(1)');
				$('#general-msg>.msg-card>.header>h3').text(title);
				$('#general-msg>.msg-card>.body').children().remove();
				$.each(body, function (i, paragraph) {
					$('#general-msg>.msg-card>.body').append('<p>'+paragraph+'</p>');
				});
			}

			$('.msg-footer>button').click(function () {
				$('.msg-card').css('-webkit-transform','scale(.7)');
				$('.msg-card').parent().fadeOut(400, function () {
					$(this).hide();
				});
			});

			@if(session('msg'))
			showMsg("{{session('msg')['title']}}",[@foreach($msgs = session('msg')['body'] as $i => $msg)@if($i == count($msgs) - 1)"{{$msg}}"@else"{{$msg}}",@endif @endforeach]);
			@endif

		})
</script>
@endsection
