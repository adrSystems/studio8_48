@extends('layouts.master')
@section('css')
<style type="text/css">
body{
	background-image: url('{{asset("img/walls/5.jpg")}}');
	background-size: 100% 100%;
	background-repeat: no-repeat;
}
	h2{
	margin: 0;
    padding: 0;
    font-family: 'Lobster Two';
    text-shadow: 0 0 2px black;
    border-left-width: 15px;
    color:#c5b358;
	}
	h4{
		color:white;
	}
	h3{
		color: white;
	}
	.container{
		background-color: rgba(0, 0, 0, 0.5);
		width: 100%;
	}

</style>
@endsection
@section('title')
Contacto
@endsection
@section('body')
<br><br><br><br>
<div class="container" id="con">
	<h2>Horarios de atencion y ubicación</h2>
	<div class="row">
	<div class="col-xs-12 col-md-4">
		<br>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3600.7093263745246!2d-103.3973299853978!3d25.51473898374938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdc82eca2a825%3A0x6556f4bfe829fdf9!2zTWlzacOzbiwgMjcyNzIgVG9ycmXDs24sIENvYWgu!5e0!3m2!1ses-419!2smx!4v1490672746278" width="350" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div class="col-xs-12 col-md-4">
		<h3>Studio 8 48</h3>
		<h4>Av. Misión Sta. Ma las misiones (a un costado de Intermall)
Torreón Coahuila </h4>
		<h4>Telefono: 01 871 730 1803</h4>
		<h4>Horario de atencion: Lunes a Sabado de 10:00 am - 8:00 pm  </h4>
	</div>
	<div class="row">
	<div class="col-xs-12 col-md-4">
		<h2>Siguenos:</h2><br>
		<div class="col-xs-12 col-md-12">
		<a href="https://twitter.com/Studio848" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="large">Seguir a @Studio848</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		<div class="col-xs-12 col-md-12">
		<div class="fb-like" data-href="https://www.facebook.com/Studio-8-48-358835230878580/" data-layout="box_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
		</div>
	</div>
	</div>
	</div>
</div>
<br><br><br><br>
@endsection
@section('js')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@endsection
