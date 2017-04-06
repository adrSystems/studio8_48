@extends('layouts.master')
@section('title')
Subir nuevo tip
@endsection
@section('css')
<style media="screen">
* {
margin: 0;
padding: 0;
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-webkit-font-smoothing: antialiased;
-moz-font-smoothing: antialiased;
-o-font-smoothing: antialiased;
font-smoothing: antialiased;
text-rendering: optimizeLegibility;
}

body {
font-family: "Roboto", Helvetica, Arial, sans-serif;
font-weight: 100;
font-size: 12px;
line-height: 30px;
background: url('{{asset("img/covers/1.jpg")}}');
background-color: rgba(0, 0, 0, 0.5);


}

.container {
max-width: 400px;
width: 100%;
margin: 0 auto;
position: relative;

}
.footer{
  box-shadow: 0 -3px 5px rgba(0, 0, 0, 0.5);
  position: relative;
  bottom: 0;
  margin-top: 20px
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea,
#contact button[type="submit"],
#lab {
font: 400 14px/18px "Roboto", Helvetica, Arial, sans-serif;
}

#contact {
background: #F9F9F9;
padding: 25px;
margin: 150px 0;
box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

#contact h3 {
display: block;
font-size: 30px;
font-weight: 300;
margin-bottom: 10px;
}

#contact h4 {
margin: 5px 0 15px;
display: block;
font-size: 13px;
font-weight: 400;
}

fieldset {
border: medium none !important;
margin: 0 0 10px;
min-width: 100%;
padding: 0;
width: 100%;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea {
width: 100%;
border: 1px solid #ccc;
background: #FFF;
margin: 0 0 5px;
padding: 10px;
}

#contact input[type="text"]:hover,
#contact input[type="email"]:hover,
#contact input[type="tel"]:hover,
#contact input[type="url"]:hover,
#contact textarea:hover {
-webkit-transition: border-color 0.3s ease-in-out;
-moz-transition: border-color 0.3s ease-in-out;
transition: border-color 0.3s ease-in-out;
border: 1px solid #aaa;
}

#contact textarea {
height: 100px;
max-width: 100%;
resize: none;
}

#contact button[type="submit"] {
cursor: pointer;
width: 100%;
border: none;
background: #111;
color: #FFF;
margin: 0 0 5px;
padding: 10px;
font-size: 15px;
}

#contact button[type="submit"]:hover {
background: #111;
-webkit-transition: background 0.3s ease-in-out;
-moz-transition: background 0.3s ease-in-out;
transition: background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active {
box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
text-align: center;
}

#contact input:focus,
#contact textarea:focus {
outline: 0;
border: 1px solid #aaa;
}

::-webkit-input-placeholder {
color: #888;
}

:-moz-placeholder {
color: #888;
}

::-moz-placeholder {
color: #888;
}

:-ms-input-placeholder {
color: #888;
}
h3{
  margin-top: 5px;
}
.footer{
  margin-top: -40px;
}
</style>
@endsection
@section('body')
<div class="container">
  <form id="contact" action="/subirtip" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}" class="form login">
    <h3>Subir nuevo tip</h3>
    <h4>Por favor completa los siguientes campos</h4>
    <fieldset>
      <input placeholder="Escribe el titulo de la nota" type="text" tabindex="1" required autofocus name="titulo">
    </fieldset>
    <fieldset>
      <label  for="" id="lab">Selecciona una imagen</label>
      <input placeholder="" type="file" tabindex="3" required accept="image/jpeg" name="imagen">
    </fieldset>
    <fieldset>
      <textarea placeholder="Escribe el contenido del tip" tabindex="5" required name="contenido"></textarea>
    </fieldset>
    <fieldset>
      <button type="submit" id="contact-submit" data-submit="...Sending">Subir Tip</button>
    </fieldset>
  </form>
</div>
@endsection
@section('js')
<script type="text/javascript">
  var $formulario = $('#contact');
  var $evento = $('#contact-submit');
  var result = $formulario.validate({
    rules:
    {
      titulo:
      {
        required:true
      },
      contenido:
      {
        required:true
      },
      imagen:
      {
        required:true
      }
    },
    messages:
    {
      titulo:
      {
        required:"Debes completar este campo"
      },
      contenido:
      {
        required:"Debes completar este campo"
      },
      imagen:
      {
        required:"Debes subir una imagen"
      }
    }
  });
  $('#contact-submit').click(function(event){
    event.stopPropagation();
    event.preventDefault();
    if($formulario.valid())
    {
      $formulario.submit();
    }

  });
</script>
@endsection
