@extends('layouts.master')
@section('title')
Nosotros
@endsection
@section('css')
<style type="text/css">
	body{
		color: white;
		background-image: url('{{asset("img/walls/st.jpg")}}');
		background-size: 100% 100%;
    	background-repeat: no-repeat;
    	font-size: 16px;
    	background-color: #efe;
	}
	#con{
    float: left;
    margin-top: 50px;
    margin-bottom:130px;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    padding-top: 30px;
    padding-bottom: 30px;
  }
  h2{
  	margin: 0;
    padding: 0;
    font-family: 'Lobster Two';
    text-shadow: 0 0 2px black;
    border-left-width: 15px;
    color:#c5b358;
  }
  h3{
  	margin: 0;
    padding: 0;
    font-family: 'Lobster Two';
    text-shadow: 0 0 2px black;
    border-left-width: 15px;
    color:#c5b358;
  }

</style>
@endsection
@section('body')
<br><br><br>
<div class="container" id="con">
	<h2>Sobre nosotros</h2>
	<p>En Studio 8 48, te brindamos el mejor servicio con gente experta en la belleza y el cuidado personal de tu cabello, productos inovadores, marcando una tendencia, un nuevo concepto.</p><br>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<h3>Mision</h3>
			<p>Satisfacer las necesidades de belleza de nuestros clientes mediante servicios de excelencia en calidad, brindado por personal altamente profesional que inspira confianza y seriedad, permitiéndonos superar las expectativas de nuestros clientes.</p>
		</div>
		<div class="col-xs-12 col-md-6">
			<h3>Vision</h3>
			<p>Ser la corporación líder en la satisfacción de necesidades de belleza a nivel local.
Incursionar en el mercado nacional.</p>
		</div>
	</div>
</div>
<br><br><br><br><br><br><br>
@endsection
@section('js')
@endsection
