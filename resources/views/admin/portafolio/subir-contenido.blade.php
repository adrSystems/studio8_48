@extends('layouts.master')

@section('title')
Gestion Imagenes
@endsection

@section('css')
<style media="screen">
  body{
    background-color: #333;
  }
  th{
    font-size: 20px;
  }
  .menu-container{
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, .2);
    box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    overflow: hidden;
		margin-bottom: 15px;
  }
  .menu-container>.header{
    background-color: #111;
    padding: 20px;
  }
  .menu-container>.header>h4{
    color: #fff;
    margin: 0;
    text-align: center;
  }
  .menu-container>.body>a>.menu-item1{
    padding: 5px;
    text-align: center;
    float: left;
    width: 100%;
    color: #ddd;
  }
  .menu-container>.body>a>.menu-item1-active{
    font-weight: 900;
		color: #fff;
  }
  .menu-container>.body>a>.menu-item1:hover{
    background-color: rgba(255, 255, 255, .02);
    color: #fff;
  }
	.white-card1{
		border: 1px solid rgba(0, 0, 0, 0.2);
		box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
		border-radius: 3px;
		background-color: #fff;
		float: left;
		width: 100%;
		position: relative;
		padding-bottom: 15px;
	}
	.mybtn1{
		border-radius: 5px;
		border: 1px solid dodgerblue;
		background-color: transparent;
		padding: 5px 15px 5px 15px;
		color: dodgerblue;
		-webkit-transition: color .4s, background-color .4s;
		outline: none;
	}
	.mybtn1:hover{
		background-color: dodgerblue;
		color: white;
	}
</style>
@endsection

@section('body')
<div class="main-container">
    <div class="container">
      <div class="col-xs-12" style="margin-bottom:15px">
        <h3 class="clear-text1">Portafolio</h3>
        <h4 class="clear-text3">Añade y gestiona el contenido que se mostrará a los clientes.</h4>
      </div>
      <div class="col-xs-12 col-md-3">
        <div class="menu-container">
          <div class="header">
            <h4>Opciones</h4>
          </div>
          <div class="body">
            <a href="/admin/portafolio/nuevo">
              <div class="menu-item1 menu-item1-active">Nuevo elemento</div>
            </a>
            <a href="/admin/portafolio/gestion">
              <div class="menu-item1">Gestionar contenido</div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-9">
				<div class="white-card1">
					<form class="" action="/admin/portafolio/nuevo" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<p style="margin:0;padding:20px" class="dark-text1 text-center">Seleccione la fotografia del servicio aplicado</p>
						<div class="col-xs-12">
							<div class="img-file-selector col-xs-12 col-md-6 col-md-offset-3">
								<p>Haz click o arrastra un archivo...</p>
								<input type="file" name="imagen" value="" accept="image/jpeg,.png,.gif">
							</div>
						</div>
						<div class="col-xs-12 col-md-6 col-md-offset-3">
							<p class="subtitle4 dark-text3">Sobre que servicio es...</p>
						</div>
						<div class="col-xs-12">
							<select class="textbox4 col-xs-12 col-md-6 col-md-offset-3" name="servicio">
								<option value="">Seleccione una opción</option>
								@foreach(\App\Servicio::get() as $s)
								<option value="{{$s->id}}">{{$s->nombre}}</option>
								@endforeach
							</select>
						</div>
						@if($msg = Session::get('msg'))
			      <div class="col-xs-12">
 							 <div class="alert alert-{{$msg['type']}} col-xs-12 col-md-6 col-md-offset-3" role="alert">
   			         <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
   			         <span class="sr-only">{{$msg['title']}}</span>
   			         <span>{{$msg['body']}}</span>
   			       </div>
			      </div>
			      @endif
						<div class="col-xs-12" style="margin-top:30px">
							<button type="submit" name="button" class="center mybtn1">Subir</button>
						</div>
					</form>
				</div>
      </div>
    </div>
</div>
@endsection

@section('js')
@endsection
