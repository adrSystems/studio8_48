@extends('layouts.master')
@section('css')
<style>
#form{
	font-family: Cookie;
	color: #C5B358;
	font-size: 20px;

}
.input-registro:focus{
    border: 2px solid #ed5;
}
input[type=text]{
	background-color: #111;
	font-size: 20px;
	color: #C5B358;

}
input[type=text]:focus{
    border: 2px 2px 2px 2px solid red;
}
input[type=email]{
	background-color: #111;
	font-size: 20px;
	
}
input[type=password]{
	background-color: #111;
	font-size: 20px;
}
input[type=date]{
	background-color: #111;
	font-size: 20px;
}
</style>
@endsection
@section('title')
Registro
@endsection
@section('body')
<br><br><br>
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
<h1 style="font-family: Cookie;color:#C5B358;margin-left: 20px;">Registro</h1>
<form class="form-horizontal" id="form" enctype="multipart/form-data" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
     <div class="form-group">
         <label for="inputName" class="control-label col-xs-2">Nombre:</label>
         <div class="col-xs-4">
             <input type="text" class="form-control input-registro" placeholder="Escribe tu nombre" name="nombre">
         </div>
     </div>
     <div class="form-group">
         <label for="inputName" class="control-label col-xs-2">Apellidos:</label>
         <div class="col-xs-4">
             <input type="text" class="form-control input-registro" placeholder="Escribe tus apellidos" name="apellidos">
         </div>
     </div>
     <div class="form-group">
         <label for="inputEmail" class="control-label col-xs-2">Email:</label>
         <div class="col-xs-4">
             <input type="email" class="form-control input-registro" placeholder="Escribe tu email" name="email">
         </div>
     </div>
     <div class="form-group">
         <label for="inputEmail" class="control-label col-xs-2">Contraseña:</label>
         <div class="col-xs-4">
             <input type="password" class="form-control input-registro" placeholder="Escribe tu contraseña" name="pass" id="pass">
         </div>
     </div>
     <div class="form-group">
         <label for="inputEmail" class="control-label col-xs-2">Repite tu contraseña:</label>
         <div class="col-xs-4">
             <input type="password" class="form-control input-registro" placeholder="Vuelve a escribir tu contraseña" name="validar_pass">
         </div>
     </div>
    <div class="form-group">
	<label class="control-label col-xs-2">Fecha de nacimiento</label>
	<div class="col-xs-4">
		<input type="date" name="fecha" class="form-control input-registro">
	</div>		
	</div>
	<div class="form-group">
	<label class="control-label col-xs-2">Subir imagen de perfil</label>
	<div class="col-xs-4">
		<input type="file" name="imagen" id="file"  accept="image/*">
	</div>		
	</div>
     <div class="form-group">
         <div class="col-xs-offset-2 col-xs-10">
             <button type="submit" class="btn btn-primary" id="subir">Registrar</button>
         </div>
     </div>
</form>
</div>
<br><br>
@endsection
@section('js')
<script type="text/javascript">
var $formulario= $('Form');
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
</script>
@endsection
