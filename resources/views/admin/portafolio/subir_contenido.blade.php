@extends('layouts.master')
@section('title')
Subir Contenido
@endsection
@section('css')
<style media="screen">
body {
	background: url('{{asset("img/covers/1.jpg")}}');
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #111;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #111;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #111;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #111;
	border-color: #111;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #111;
}

.btn-register {
	background-color: #111;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #111;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #111;
	border-color: #111;
}
.modal-content{
	width: 900px;
}
</style>
@endsection
@section('body')
<br><br><br><br>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
        @if(Session::has('msg'))
        <div class="alert alert-success" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
            {{Session::get('msg')}}
           </div>
           @endif
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Subir Foto</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Subir Video</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="/subir_contenido" method="post" role="form" style="display: block;" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
									<div class="form-group">
                    <label>Elige una foto</label>
										<input type="file" name="imagen" tabindex="1" class="form-control" value="" accept="image/jpeg">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Subir Foto">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="/subir_contenido" method="post" role="form" style="display: none;">
                  <input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
									<div class="form-group">
                    <label for="">Introduce la URL del video de Youtube</label>  <button type="button" data-toggle="modal" data-target="#id_modal" name="button"><span class="glyphicon glyphicon-exclamation-sign"></span></button>
										<input type="text" name="url" id="username" tabindex="1" class="form-control" placeholder="URL" value="">
									</div>
									<div class="form-group">
                    <label for="">Agrega una descripcion del video</label>
										<input type="text" name="des" tabindex="1" class="form-control" placeholder="Descripcion del video" value="">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Subir video">
											</div>
										</div>
									</div>
								</form>
								<div class="modal fade" id="id_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					        <div class="modal-dialog" role="document">
					          <div class="modal-content">
					              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                <span aria-hidden="true">&times;</span>
					              </button>
					            <div class="modal-body">
					              <img id="mod_img" src="{{asset('img/covers/ayuda.png')}}" alt="">
					            </div>
					          </div>
					        </div>
					      </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <br><br><br><br><br><br><br><br><br>
@endsection
@section('js')
<script type="text/javascript">
$(function() {

  $('#login-form-link').click(function(e) {
  $("#login-form").delay(100).fadeIn(100);
  $("#register-form").fadeOut(100);
  $('#register-form-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});
$('#register-form-link').click(function(e) {
  $("#register-form").delay(100).fadeIn(100);
  $("#login-form").fadeOut(100);
  $('#login-form-link').removeClass('active');
  $(this).addClass('active');
  e.preventDefault();
});

});
var $formulario = $('#login-form');
var $evento = $('#login-submit');
var result = $formulario.validate({
	rules:
	{
		imagen:
		{
			required:true
		}
	},
	messages:
	{
		imagen:
		{
			required:"Debes subir una imagen"
		}
	}
});
$('#login-submit').click(function(event){
	event.stopPropagation();
	event.preventDefault();
	if($formulario.valid())
	{
		$formulario.submit();
	}
});

var $formulario2 = $('#register-form');
var $evento2 = $('#register-submit');
var result = $formulario2.validate({
	rules:
	{
		url:
		{
			required:true
		},
		des:
		{
			required:true
		}
	},
	messages:
	{
		url:
		{
			required:"Este campo es requerido"
		},
		des:
		{
			required:"Este campo es requerido"
		}

	}
});
$('#register-submit').click(function(event){
	event.stopPropagation();
	event.preventDefault();
	if($formulario2.valid())
	{
		$formulario2.submit();
	}

});
</script>
@endsection
