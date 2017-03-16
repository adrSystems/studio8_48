<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|EB+Garamond|Alegreya|Cookie|Lobster|Lobster+Two|Lato|Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
      body{
        font-family: 'Lato';
      }
      .header{
        font-family: 'Segoe ui';
        font-family: 'Lobster Two';
        background-color: #111;
        width: 100%;
        color: goldenrod;
        margin: 0;
        text-align: center;
        padding: 15px;
      }
      .header>h3{
        font-family: 'Lobster Two';
      }
      .body{
        color: #777;
        width: 100%;
        padding: 15px;
      }
      .footer{
        background-color: #eee;
        padding: 15px;
      }
      .footer>a{
        border-radius: 3px;
        border: 1px solid goldenrod;
        color: goldenrod;
        padding: 5px 15px 5px 15px;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h3>Bienvenido a Studio8 48 {{$user->nombre}}!</h3>
    </div>
    <div class="body">
      <p>Haz sido autorizado como empleado. A continuación la información de tu cuenta:</p>
      <p>
        Email: {{$cuenta->email}}<br>
        Contraseña: {{$cuenta->password}}
      </p>
      <p>Podrás cambiar tu foto de perfil, tu contraseña y otra información dentro de la sección "Mi cuenta" una vez iniciada sesión.</p>
    </div>
    <div class="footer">
      <a href="{{url('/')}}/login">Iniciar sesión ahora!</a>
    </div>
  </body>
</html>
