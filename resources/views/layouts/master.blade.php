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
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script|EB+Garamond|Alegreya|Cookie|Lobster|Lobster+Two|Cinzel" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{elixir('css/app.css')}}" type="text/css" rel="stylesheet">

        <!-- Styles -->
        <style>
            body{
                padding: 0;
                margin: 0;
                background-color: #111;
            }
            .nav-bar{
                background-color: rgba(0,0,0,.6);
                width: 100%;
                height: 60px;
                margin: 0;
                z-index: 2;
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
                font-family: 'Lobster Two';
                color: #ed5;
                font-size: 16px;
                padding: 0 20px 0 20px;
                height: 98%;
                -webkit-transition: color .4s, opacity .7s;
                line-height: 56px;
            }
            a.nav-item>p{
              float: left;
            }
            .nav-item:hover{
                color: #fff;
            }
            a.nav-item:link{
                text-decoration: none;
            }
            .footer{
              background-color: #111;
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
              background-color: transparent;
              -webkit-transition: background .3s;
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
              font-family: 'Cinzel';
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
              color: #aaa;
            }
            .menu{
              background-color: #000;
              box-shadow: 0 0 10px 1px #000;
              border-right: 1px solid #222;
              position: fixed;
              width: 200px;
              height: 100%;
              left: -200px;
              z-index: 4;
              -webkit-transition: left .7s, margin-left .7s;
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
              height: 90%;
              border-radius: 100%;
              width: auto;
              margin-top: -17px;
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
              border-left: 1px solid #333;
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
              text-shadow: 0 0 5px #fff;
              background-color: #222;
            }
            #logout-btn{
              box-shadow: inset 0 2px 2px #000;
            }
            .up{
              -webkit-transform: rotate(180deg);
            }
            .down{
              -webkit-transform: rotate(0deg);
            }
            .nav-dropdown{
              background: rgba(0,0,0,.2);
            }
            .nav-item-menu-btn{
              position: absolute;
              top:33px;
              left: 54px;
            }
            .nav-dropdown-child{
              background-color: rgba(0,0,0,.8);
              position: fixed;
              border-radius: 3px;
              border: 1px solid #888;
              width: 200px;
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

        <div class="nav-dropdown-child" id="1">
          <a href="#">Inventario</a>
          <a href="#">Citas</a>
          <a href="#">Gestion de productos</a>
        </div>

        <div class="menu">
          <h4 id="menu-title">Menú</h4>
          <i class="material-icons" id="hide-menu-btn">keyboard_arrow_left</i>
        </div>

        @if(Auth::check())
        <div class="" id="user-menu">
          <p>{{Auth::user()->cuentable->nombre}}<br>{{Auth::user()->email}}</p>
          <a href="#">Mi cuenta</a>
          <a href="#">Mi historial</a>
          <a href="/logout" id="logout-btn">Salir</a>
        </div>
        @endif

        @yield('body')

        <div class="footer">
          <div class="col-xs-12 col-md-10">
            <a href="#" class="footer-link">Terminos y condiciones</a>
          </div>
          <p id="right-msg" class="col-xs-12 col-md-10">2017. Todos los derechos reservados.</p>
          <a href="#" id="help-btn">
            <p>?</p>
          </a>
        </div>

        <script src="{{elixir('js/jquery-3.1.1.min.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('.main-cover').width('100%');

                if($(this).width() < 576){
                  $('.menu-btn').css('display','initial');
                  $('.menu').append($('.nav-item'));
                  $('.nav-item').css({
                    'width':'100%',
                    'display':'initial',
                    'margin':'0',
                    float:'left',
                    'height':'50px'
                  });
                }
                else{
                  $('.menu-btn').css('display','none');
                  $('.nav-bar').append($('.nav-item'));
                  $('.nav-item').css({
                    'width':'auto',
                    'display':'inline-block',
                    'margin':'auto',
                    float:'none',
                    'height':'98%'
                  });
                }

                $('.nav-item').css('opacity',1);

                $('.user-photo').slideDown("slow");

                $(window).resize(function () {
                  if($(this).width() < 576){
                    $('.menu-btn').css('display','initial');
                    $('.menu').append($('.nav-item'));
                    $('.nav-item').css({
                      'width':'100%',
                      'display':'initial',
                      'margin':'0',
                      float:'left',
                      'height':'50px'
                    });
                  }
                  else{
                    $('.menu').css('left','-200px');
                    $('.menu-btn').css('display','none');
                    $('.nav-bar').append($('.nav-item'));
                    $('.nav-item').css({
                      'width':'auto',
                      'display':'inline-block',
                      'margin':'auto',
                      float:'none',
                      'height':'98%'
                    });
                  }
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
                        if(!$child.is(':hover')){
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
