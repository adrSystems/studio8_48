@extends('layouts.master')
@section('title')
Subir Contenido
@endsection
@section('css')
<style media="screen">
body {
	background: url('{{asset("img/covers/4.jpg")}}');
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
<div class="main-container">
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
								<h4 style="align:center;">Subir Foto</h4>
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
							</div>
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


</script>
@endsection
