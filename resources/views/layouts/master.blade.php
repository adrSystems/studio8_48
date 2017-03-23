<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
        @yield('title')
        </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script|EB+Garamond|Alegreya|Cookie|Lobster|Lobster+Two|Lato|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{elixir('css/bootstrap.css')}}">
        <link href="{{elixir('css/app.css')}}" type="text/css" rel="stylesheet">

        <!-- Styles -->
        <style>
            body{
                padding: 0;
                margin: 0;
                background-color: #111;
                font-family: 'Lato';
            }
            .nav-bar{
                background-color: rgba(0,0,0,.8);
                width: 100%;
                height: 60px;
                margin: 0;
                z-index: 2;
                float: left;
                position: fixed;
                border-bottom: 1px solid #222;
                box-shadow: 0 0 5px #000;
                text-align: center;
            }
            .main-cover{
                width: 10%;
                box-shadow: 0 0 10px 0 #000;
                -webkit-transition: width .5s;
            }
            a.nav-item{
                position: relative;
                opacity: 0;
                margin: auto;
                display: inline-block;
                font-weight: 100;
                height: 100%;
                font-family: 'Lobster Two';
                color: #ed5;
                font-size: 16px;
                padding: 0 20px 0 20px;
                border-bottom: 1px solid transparent;
                -webkit-transition: color .4s, opacity .7s, border-bottom 1s;
                line-height: 56px;
            }
            a.nav-item>p{
              float: left;
            }
            .nav-item:hover{
                color: #fff;
                border-bottom: 1px solid #fff;
            }
            a.nav-item:link{
                text-decoration: none;
            }
            .footer{
              background-color: #111;
              text-align: center;
              box-shadow: 0 0 10px 0 #000;
              width: 100%;
              position: relative;
              float: left;
              padding: 25px;
            }
            #help-btn{
              float: right;
              text-decoration: none;
              text-align: center;
              padding: 0px 7px 0px 7px;
              border-radius: 100%;
              border: 2px solid #ffa;
              font-family: 'Raleway';
              background-color: transparent;
              -webkit-transition: background-color, background .3s;
            }
            #help-btn:hover{
              background: rgba(255,255,255,.1);
            }
            #help-btn > p{
              margin-top: -5px;
              margin-bottom: -5px;
              font-size: 22px;
              font-weight: 800;
              color: #fff;
            }
            .footer-link{
              color: #ed5;
              -webkit-transition: color .5s;
              font-family: 'Lato';
              font-weight: 100;
              font-size: 15px;
            }
            .footer-link:link{
              color: #eee;
              text-decoration: none;
            }
            .footer-link:visited{
              color: #cb4;
              text-decoration: none;
            }
            .footer-link:hover{
              color: #fff;
            }
            #right-msg{
              font-family: 'Lato';
              color: #fff;
            }
            .menu{
              background-color: rgba(0,0,0,.9);
              box-shadow: 0 0 10px 1px #000;
              border-right: 1px solid #222;
              position: fixed;
              width: 200px;
              height: 100%;
              left: -200px;
              z-index: 4;
              -webkit-transition: left .7s, margin-left .7s;
            }
            .menu>div{
              height: 100%;
              width: 100%;
              padding-bottom: 100px;
              overflow: auto;
            }
            .menu>div::-webkit-scrollbar{
              display: none;
            }
            #menu-title{
              font-family: Cookie;
              color: white;
              text-align: center;
              font-size: 26px;
            }
            #hide-menu-btn{
              font-size: 32px;
              position: absolute;
              right: 10px;
              top: 10px;
              color: white;
              -webkit-transform: rotate(180deg);
              cursor: pointer;
              -webkit-transition: color .5s, -webkit-transform .7s;
            }
            #hide-menu-btn:hover{
              color: #ed5;
            }
            .menu-btn{
                display: none;
                position: absolute;
                left: 0;
                padding: 0 20px 0 20px;
                height: 98%;
                line-height: 80px;
            }
            .menu-btn:link{
                text-decoration: none;
            }
            .menu-btn > i{
              cursor: pointer;
              font-size: 32px;
              color: #ed5;
              -webkit-transition: color .4s;
            }
            .menu-btn > i:hover{
              color: white;
            }
            #nav-login{
              float: right;
              position: relative;
              color: #ddd;
              padding: 0 20px 0 20px;
              border-left: 1px solid #333;
              height: 100%;
              line-height: 61px;
              font-family: Cookie;
              font-size: 18px;
              border-bottom: 1px solid transparent;
              -webkit-transition: color .5s, text-shadow .4s, border-bottom 1s;
            }
            #nav-login:link{
              color: white;
              text-decoration: none;
            }
            #nav-login:hover{
              color: white;
              text-shadow: 0 0 5px #fff;
              border-bottom: 1px solid #fff;
            }
            #nav-login:visited{
              color: white;
              text-decoration: none;
            }
            .user-photo{
              height: 75%;
              border-radius: 100%;
              width: auto;
              margin-top: -19px;
              display: none;
            }
            #user-options{
              cursor: pointer;
              color: #ddd;
              margin-top: 10px;
              -webkit-transition: color .5s, text-shadow .4s, -webkit-transform .4s;
            }
            #user-options:hover{
              color: #fff;
              text-shadow: 0px 0px 5px #fff;
            }
            #nav-user-info{
              float: right;
              height: 100%;
              padding: 10px 10px 10px 15px;
              border-left: 1px solid rgba(255,255,255,.1);
            }
            #user-menu{
              position: fixed;
              right: 8px;
              background: #111;
              top: 68px;
              padding: 0px;
              border-radius: 3px;
              box-shadow: 0px 1px 3px #000;
              display: none;
              overflow: hidden;
              z-index: 2;
              border: 1px solid #222;
            }
            #user-menu>p{
              color: #ccc;
              padding: 3px 10px 5px 10px;
            }
            #user-menu>a{
              color: white;
              width: 100%;
              padding: 3px 10px 5px 10px;
              float: left;
              text-decoration: none;
              -webkit-transition: color .4s, background .3s;
            }
            #user-menu>a:hover{
              background-color: #222;
            }
            .up{
              -webkit-transform: rotate(180deg);
            }
            .down{
              -webkit-transform: rotate(0deg);
            }
            .nav-dropdown:hover{
              border-bottom: 0px solid transparent;
            }
            .nav-dropdown>p{
              float: left;
            }
            .nav-item-menu-btn{
              position: absolute;
              font-size: 14px;
              top:36px;
              left: 58px;
            }
            .nav-dropdown-child{
              background-color: rgba(0,0,0,.8);
              position: fixed;
              border-radius: 3px;
              border: 1px solid #888;
              width: 200px;
              z-index: 2;
              box-shadow: 0 1px 3px #000;
              display: none;
            }
            .nav-dropdown-child>a{
              width: 100%;
              text-decoration: none;
              color: #ccc;
              float: left;
              padding: 3px 10px 3px 10px;
              font-size: 16px;
              font-family: 'Lobster Two';
              -webkit-transition: padding-left .4s;
            }
            .nav-dropdown-child>a:hover{
              background-color: rgba(255,255,255,.1);
              padding-left: 20px;
            }
            .menu-item{
              font-weight: 100;
              font-family: 'Lobster Two';
              padding: 0px 20px 0px 20px;
              font-size: 16px;
              color: #ed5;
              -webkit-transition: color .4s, opacity .7s, text-shadow .5s;
              width:100%;
              display:initial;
              text-decoration: none;
              margin:0;
              float:left;
              height: 50px;
              cursor: pointer;
            }
            .menu-item:hover{
              color: white;
              text-shadow: 0 0 5px #ccc;
              text-decoration: none;
            }
            .menu-item>p{
              float: left;
              margin-top: 12px;
            }
            .menu-item>i{
              margin-top: 14px;
            }
            .menu-item-parent > i{
              font-size: 14px;
              margin-left: 10px;
              line-height: 25px;
              -webkit-transition: -webkit-transform .4s;
            }
            a.menu-item-children{
              float: left;
              width: 100%;
              font-family: 'Lobster Two';
              padding: 3px 20px 3px 30px;
              color: #ccc;
              display: none;
              text-decoration: none;
            }
            a.menu-item-children:hover{
              color: #fff;
              text-decoration: none;
            }
            a.menu-item-children:link{
              color: #ccc;
              text-decoration: none;
            }
            a.menu-item-children:visited{
              color: #ccc;
              text-decoration: none;
            }
            .msg-container{
              position: fixed;
              z-index: 5;
              top: 0;
              left: 0;
              display: none;
              padding: 10px;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 0, 0, 0.7);
            }
            .msg-container>.msg-card{
              background-color: #fff;
              border: 1px solid #aaa;
              box-shadow: 0 0 50px rgba(0,0,0,.5);
              margin-top: 40px;
              border-radius: 3px;
              padding: 0px;
              opacity: 0;
              overflow: hidden;
              -webkit-transform: scale(.7);
              -webkit-transition: -webkit-transform .5s, opacity .4s, margin-top .4s;
            }
            .msg-container>.msg-card>.header>h3{
              font-family: 'Lobster Two';
              color: goldenrod;
              padding: 0;
              margin: 0;
              margin-left: 0px;
              border-width: 0px;
            }
            .msg-container>.msg-card>.header{
              background: #eee;
              box-shadow: inset 0 0 2px #999;
              text-align: center;
              padding: 8px 10px 10px 10px;
            }
            .msg-container>.msg-card>.body{
              padding: 30px 10px 30px 10px;
              text-align: center;
              color: #777;
            }
            .msg-container>.msg-card>.msg-footer{
              padding: 10px;
              box-shadow: 0 0 2px #999;
              background: #eee;
            }
            .msg-container>.msg-card>.msg-footer>button{
              border: 1px solid goldenrod;
              border-radius: 2px;
              padding: 3px 10px 3px 10px;
              margin: auto;
              color: #777;
              display: inline-block;
              -webkit-transition: box-shadow .3s;
            }
            .msg-container>.msg-card>.msg-footer>a{
              border: 1px solid goldenrod;
              width: auto;
              border-radius: 2px;
              padding: 3px 10px 3px 10px;
              margin: auto;
              display: inline-block;
              -webkit-transition: box-shadow .3s;
              text-decoration: none;
              color: #555;
              background-color: rgba(0, 0, 0, 0.1);
            }
            .msg-container>.msg-card>.msg-footer>a:hover{
              box-shadow: 0 1px 2px #aaa;
            }
            .msg-container>.msg-card>.msg-footer>button:hover{
              box-shadow: 0 1px 2px #aaa;
            }
            .switch-container{
              background-color: #333;
              float: right;
              cursor: pointer;
              text-align: center;
              padding: 5px;
              border-radius: 3px;
            }
            .switch-container>hover{
              color:#fff;
            }
            .switch-container>span{
              float: left;
            }
            .switch-container>.switch-bar{
              background: #666;
              margin-top: 3px;
              margin-left: 6px;
              float: left;
              border-radius: 10px;
              position: relative;
              width: 30px;
              height: 15px;
            }
            .switch-container>.switch-bar>.switch-btn{
              border-radius: 100%;
              border: 1px solid #fff;
              position: absolute;
              height: 15px;
              width: 15px;
              -webkit-transition: left .4s, background-color .5s;
            }
            .switch-container>.switch-bar>.inactive{
              left: 0;
              background-color: transparent;
            }
            .switch-container>.switch-bar>.active{
              left: 50%;
              background-color: dodgerblue;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <nav class="nav-bar">
            <div class="menu-btn">
              <i class="material-icons">apps</i>
            </div>
            <a href="" class="nav-item"><p>Nosotros</p></a>
            <a href="" class="nav-item"><p>Contacto</p></a>
            <a href="" class="nav-item"><p>Productos</p></a>
            <a href="" class="nav-item"><p>Servicios</p></a>
            <a href="" class="nav-item"><p>Promociones y concursos</p></a>
            <a href="" class="nav-item"><p>Tips</p></a>
            <a href="" class="nav-item"><p>Portafolio</p></a>
            @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado' and Auth::user()->cuentable->roles->where('nombre','administrador'))
            <a href="#" class="nav-item nav-dropdown" id="1">
              <p>Administración</p>
              <i class="material-icons down nav-item-menu-btn">keyboard_arrow_down</i>
            </a>
            @endif
            @if(!Auth::check())
            <a href="/login" id="nav-login">Login</a>
            @else
            <div href="#" id="nav-user-info">
              @if(Auth::user()->photo)
              <img class="user-photo" src="{{asset('img/profile_photos/'.Auth::user()->photo)}}" alt="">
              @else
              <img class="user-photo" src="{{asset('img/profile_photos/default.gif')}}" alt="">
              @endif
              <i class="material-icons down" id="user-options">keyboard_arrow_down</i>
            </div>
            @endif
        </nav>

        @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado' and Auth::user()->cuentable->roles->where('nombre','administrador'))
        <div class="nav-dropdown-child" id="1">
          <a href="#">Inventario</a>
          <a href="#">Citas</a>
          <a href="#">Gestion de productos</a>
          <a href="#">Gestion de servicios</a>
          <a href="/admin/clientes">Clientes</a>
          <a href="/personal">Personal</a>
          <a href="#">Gestión de Tips</a>
          <a href="#">Promociones y concursos</a>
          <a href="#">Portafolio</a>
        </div>
        @endif

        <div class="menu">
          <h4 id="menu-title">Menú</h4>
          <i class="material-icons" id="hide-menu-btn">keyboard_arrow_left</i>
          <div class="">
            <a href="" class="menu-item"><p>Nosotros</p></a>
            <a href="" class="menu-item"><p>Contacto</p></a>
            <a href="" class="menu-item"><p>Productos</p></a>
            <a href="" class="menu-item"><p>Servicios</p></a>
            <a href="" class="menu-item"><p>Promociones y concursos</p></a>
            <a href="" class="menu-item"><p>Tips</p></a>
            <a href="" class="menu-item"><p>Portafolio</p></a>
            @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado' and Auth::user()->cuentable->roles->where('nombre','administrador'))
            <a class="menu-item menu-item-parent" id="1"><p>Administración</p><i class="material-icons down">keyboard_arrow_down</i></a>
            <a href="#" class="menu-item-children" id="1">Inventario</a>
            <a href="#" class="menu-item-children" id="1">Citas</a>
            <a href="#" class="menu-item-children" id="1">Gestión de productos</a>
            <a href="#" class="menu-item-children" id="1">Gestion de servicios</a>
            <a href="/admin/clientes" class="menu-item-children" id="1">Clientes</a>
            <a href="/personal" class="menu-item-children" id="1">Personal</a>
            <a href="#" class="menu-item-children" id="1">Gestión de Tips</a>
            <a href="#" class="menu-item-children" id="1">Promociones y concursos</a>
            <a href="#" class="menu-item-children" id="1">Portafolio</a>
            @endif
          </div>
        </div>

        @if(Auth::check())
        <div class="" id="user-menu">
          <p>{{Auth::user()->cuentable->nombre}}<br>{{Auth::user()->email}}</p>
          <a href="#">Mi cuenta</a>
          @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
          <a href="#">Mi historial</a>
          @endif
          <a href="/logout" id="logout-btn">Salir</a>
        </div>
        @endif

        <div class="msg-container" id="general-msg">
          <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
            <div class="header">
              <h3></h3>
            </div>
            <div class="body">
            </div>
            <div class="msg-footer">
              <button type="button" name="button" id="close-btn">Cerrar</button>
            </div>
          </div>
        </div>

        @yield('body')

        <div class="footer col-xs-12">
          <div class="col-xs-12">
            <a href="#" class="footer-link">Terminos y condiciones</a>
          </div>
          <p id="right-msg" class="col-xs-12">2017. Todos los derechos reservados.</p>
          <a href="#" id="help-btn">
            <p>?</p>
          </a>
        </div>

        <script src="{{elixir('js/jquery-3.1.1.min.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('.main-cover').width('100%');

                $('.switch-container').click(function () {
                  if($(this).children('.switch-bar').children('.switch-btn').css('left') != '0px'){
                    $(this).children('.switch-bar').children('.switch-btn').removeClass('active');
                    $(this).children('.switch-bar').children('.switch-btn').addClass('inactive');
                    $(this).attr('active','0');
                  }
                  else{
                    $(this).children('.switch-bar').children('.switch-btn').removeClass('inactive');
                    $(this).children('.switch-bar').children('.switch-btn').addClass('active');
                    $(this).attr('active','1');
                  }
                });

                function showMsg(title, body) {
                  $('#general-msg').show(0);
                  $('#general-msg>.msg-card').css('opacity',1);
                  $('#general-msg>.msg-card').css('margin-top','100px');
                  $('#general-msg>.msg-card').css('-webkit-transform','scale(1)');
                  $('#general-msg>.msg-card>.header>h3').text(title);
                  $('#general-msg>.msg-card>.body').children().remove();
                  $.each(body, function (i, paragraph) {
                    $('#general-msg>.msg-card>.body').append('<p>'+paragraph);
                  });
                }

                if($(this).width() < 576){
                  $('.menu-btn').css('display','initial');
                  $('.nav-item').hide();
                }
                else{
                  $('.menu-btn').css('display','none');
                  $('.nav-item').show();
                }

                $('.nav-item').css('opacity',1);

                $('.user-photo').slideDown("slow");

                $(window).resize(function () {
                  if($(this).width() < 576){
                    $('.menu-btn').css('display','initial');
                    $('.nav-item').hide();
                  }
                  else{
                    $('.menu').css('left','-200px');
                    $('.menu-btn').css('display','none');
                    $('.nav-item').show();
                  }
                });

                $('.menu-item-parent').click(function () {
                  if($(this).children('i').hasClass('up')){
                    $(this).children('i').removeClass('up');
                    $(this).children('i').addClass('down');
                  }
                  else{
                    $(this).children('i').removeClass('down');
                    $(this).children('i').addClass('up');
                  }
                  $('.menu-item-children[id='+$(this).prop('id')+']').slideToggle(400);
                });

                $('.nav-dropdown-child').hover(function () {},function () {
                    $(this).hide(200);
                });

                $.each($('.nav-dropdown') ,function (i, e) {
                  var $child = $('.nav-dropdown-child[id='+$(e).prop('id')+']');
                  $(e).hover(function () {
                      $child.css('left' , ($(e).offset().left - ($(e).width() / 2) + 10));
                      $child.css('top','64px');
                      $child.show(200);
                    }, function () {
                      setTimeout(function () {
                        if(!$child.is(':hover') && !$(e).is(':hover')){
                          $child.hide(200);
                        }
                      }, 500);
                    }
                  );

                });

                $('#user-options').click(function () {
                  if($(this).hasClass('up')){
                    $(this).removeClass('up');
                    $(this).addClass('down');
                  }
                  else{
                    $(this).removeClass('down');
                    $(this).addClass('up');
                  }
                  $('#user-menu').toggle(300);
                });

                $('.menu-btn').click(function () {
                  $('#hide-menu-btn').css('-webkit-transform','rotate(0deg)');
                  $('.menu').css('left','0px');
                });

                $('#hide-menu-btn').click(function () {
                    $(this).css('-webkit-transform','rotate(180deg)');
                    $('.menu').css('left','-200px');
                });
            });
        </script>
        @yield('js')
    </body>
</html>
