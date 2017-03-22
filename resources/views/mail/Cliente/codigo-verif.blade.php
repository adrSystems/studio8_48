<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
</head>
<body>
<h2>Gracias por registrarte</h2><br>
<p>Haz click en el siguiente enlace, para activar tu cuenta</p>
{{ URL::to('registro/verificar/' . $codigo) }}
</body>
</html>
