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
            body>.footer{
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
              position: absolute;
              right: 0;
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
                float: left;
                height: 30px;
                border-radius: 100%;
                margin-top: 5px;
                width: 30px;
                display: none;
                overflow: hidden;
                margin-right: 5px;
            }
            .user-photo>img{
              width: 100%;
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
              position: absolute;
              top: 0;
              right: 0;
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
                text-align: center;
                width: 100%;
              font-size: 14px;
              top:36px;
              left: 0;
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
            .switch-container-red{
              background-color: #333;
              float: right;
              cursor: pointer;
              text-align: center;
              padding: 5px;
              border-radius: 3px;
            }
            .switch-container-red>hover{
              color:#fff;
            }
            .switch-container-red>span{
              float: left;
            }
            .switch-container-red>.switch-bar{
              background: #666;
              margin-top: 3px;
              margin-left: 6px;
              float: left;
              border: 1px solid rgba(255, 0, 0, 0.5);
              border-radius: 10px;
              position: relative;
              width: 30px;
              height: 15px;
            }
            .switch-container-red>.switch-bar>.switch-btn{
              border-radius: 100%;
              border: 1px solid rgba(0, 0, 0, 0.3);
              position: absolute;
              top: -1px;
              height: 15px;
              width: 15px;
              -webkit-transition: left .4s, background-color .5s;
            }
            .switch-container-red>.switch-bar>.inactive{
              left: 0;
              background-color: transparent;
            }
            .switch-container-red>.switch-bar>.active{
              left: 50%;
              background-color: #f53;
            }
            .main-container{
              float: left;
              color: #bbb;
              width: 100%;
              margin-top: 100px;
              margin-bottom: 40px;
            }
            .main-title{
              font-family: 'Lobster Two';
              color: #aaa;
            }
            .card{
              box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
              border-radius: 3px;
              border: 1px solid rgba(0, 0, 0, .09);
              background-color: rgba(0, 0, 0, 0.5);
              padding: 0;
              padding-bottom: 15px;
              overflow: hidden;
            }
            .card>.header>h4{
              color: #fff;
              font-family: 'Lobster Two';
              padding: 15px;
              margin: 0;
            }
            .card>.header{
              background: linear-gradient(to bottom,rgba(255, 255, 255, 0.08),rgba(255, 255, 255, 0.04));
              margin:0;
              border-bottom: 1px solid rgba(0, 0, 0, 0.35);
              box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
              padding: 15px;
              padding-left: 5%;
              padding-right: 5%;
              margin-bottom: 15px;
              width: 110%;
              margin-left: -5%;
            }
            .btn3{
              background: linear-gradient(to bottom, rgba(255, 255, 255, .09), rgba(255, 255, 255, .04));
              border: 1px solid #111;
              color: #ddd;
              text-shadow: 0 0 3px rgba(0, 0, 0, .8);
              padding: 3px 15px 5px 15px;
              font-size: 16px;
              border-radius: 3px;
              -webkit-transition: box-shadow .3s, color .4s, border .4s;
            }
            .btn3:hover{
              box-shadow: 0 1px 3px #000;
              color: gold;
              border-color: goldenrod;
            }
            .textbox1{
              background-color: rgba(0,0,0,.05);
              box-shadow:inset 0 0 5px #000;
              border: 1px solid rgba(255, 255, 255, 0.4);
              color: #aaa;
              border-radius: 5px;
              padding: 4px 8px 4px 8px;
              margin-bottom: 10px;
              -webkit-transition: color .4s, background-color .3s, box-shadow .4s;
            }
            .textbox1-xs{
              height: 35px;
              padding-bottom: 7px;
            }
            .textbox1:hover{
              background-color: rgba(255,255,255,.03);
              border-color: rgba(255, 255, 255, 0.5);
              color: #ccc;
            }
            .textbox1:focus{
              background-color: rgba(0,0,0,.1);
              box-shadow:inset 0 0 10px #000;
              color: #fff;
              text-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
              outline: none;
            }
            ::-webkit-clear-button {
              font-size: 14px;
              height: 28px;
              position: relative;
              right: 5px;
              margin-right: 4px;
            }
            ::-webkit-inner-spin-button {
              height: 10px;
              opacity: 0;
              background-color: transparent;
            }
            ::-webkit-calendar-picker-indicator {
              font-size: 12px;
              background-color: transparent;
            }
            ::-webkit-calendar-picker-indicator:hover{
              color:#fff;
            }
            ::-webkit-datetime-edit-month-field:focus {
              background-color: transparent;
              color: goldenrod;
            }
            ::-webkit-datetime-edit-day-field:focus {
              background-color: transparent;
              color: goldenrod;
            }
            ::-webkit-datetime-edit-year-field:focus {
              background-color: transparent;
              color: goldenrod;
            }
            .nav-item>img{
              float: left;
              margin-top: 8px;
              width: 100px;
            }
            #brand{
              padding: 0;
            }
            .card1{
              padding: 0;
              overflow:hidden;
              color: #578;
              background-color: #fff;
              border-radius: 5px;
              border: 1px solid #bbb;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
              margin-bottom: 15px;
            }
            .card1>.header>h4{
              color: #777;
              font-family: 'Lobster Two';
              padding: 15px;
              margin: 0;
            }
            .card1>.header{
              background-color: #ddd;
              margin:0;
              box-shadow: inset 0 -1px 2px #aaa;
              padding: 15px;
              padding-left: 5%;
              padding-right: 5%;
              margin-bottom: 15px;
              width: 110%;
              margin-left: -5%;
            }
            .cart-toggle{
              position: fixed;
              top: 60px;
              right: 0;
              z-index: 1;
              cursor: pointer;
              background-color: #eee;
              border-left: 1px solid rgba(0, 0, 0, 0.2);
              border-bottom: 1px solid rgba(0, 0, 0, 0.2);
              border-bottom-left-radius: 20px;
              box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
              padding: 5px;
              padding-left: 15px;
            }
            .cart-toggle>i{
              float: left;
              font-size: 21px;
            }
            .cart-toggle>span{
              float: left;
              border-radius: 3px;
              background-color: dodgerblue;
              color: white;
              padding-left: 4px;
              padding-right: 4px;
            }
            .cart-items{
              position: fixed;
              background-color: #eee;
              border: 1px solid rgba(0, 0, 0, 0.2);
              box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
              z-index: 1;
              top: 100px;
              right: 0;
              width: 200px;
              border-bottom-left-radius: 4px;
              border-top-left-radius: 4px;
              overflow: hidden;
              -webkit-transition: right .6s;
              right: -400px;
            }
            .cart-items>.items-body>.item{
              float: left;
              position: relative;
              width: 100%;
              margin-bottom: 5px;
              padding: 5px;
            }
            .cart-items>.items-body>.item>.img-container{
              width: 50px;
              overflow: hidden;
              border-radius: 3px;
              float: left;
            }
            .cart-items>.items-body>.item>.img-container>img{

            }
            .cart-items>.items-body>.item>.info{
              float: left;
              padding: 0;
              padding-left: 5px;
            }
            .cart-items>.header{
              padding: 5px;
              border-bottom: 1px solid rgba(0, 0, 0, .2);
              box-shadow: 0 1px 1px rgba(0, 0, 0, .1);
              margin-bottom: 10px;
              background-color: rgba(0, 0, 0, .05);
            }
            .cart-items>.footer-cart{
              padding: 10px;
              border-top: 1px solid rgba(0, 0, 0, .2);
              box-shadow: 0 -1px 1px rgba(0, 0, 0, .1);
              margin-top: 10px;
              background-color: rgba(0, 0, 0, .05);
            }
            #btn-cart-comprar{
              background-color: dodgerblue;
              color: #fff;
            }
            .remove-p{
              font-size: 18px;
              float: right;
              margin-top: 3px;
              cursor: pointer;
            }
            .center{
              display: table;
              text-align: center;
              margin: auto;
              width: auto;
            }
            #btn-cart-comprar{
              cursor: pointer;
              display: table;
              border-radius: 5px;
              padding-left: 8px;
              padding-right: 8px;
              -webkit-transition: box-shadow .5s;
            }
            #btn-cart-comprar:hover{
              box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
            }
            .modal-back{
              display: none;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <form class="" action="/productos/confirmarCompra" method="post" id="confirmar-compra">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>

        <div class="modal-back" id="confirmar-compra-modal-back">
          <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
            <div class="header">
              <i class="close-btn material-icons">close</i>
              <h4>Confirmar acción</h4>
            </div>
            <div class="body">
              <p>Monto total: <b><span id="monto-cart-confirm"></span></b></p>
              <p>¿Confirmar compra?</p>
            </div>
            <div class="modal-footer">
              <button type="button" name="button" id="comprar-btn"><i class="material-icons">attach_money</i>Confirmar</button>
              <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
            </div>
          </div>
        </div>

        <nav class="nav-bar">
            <div class="menu-btn">
              <i class="material-icons">apps</i>
            </div>
            <a href="/nosotros" class="nav-item nav-dropdown" id="2">
              <p>Nosotros</p>
              <i class="material-icons down nav-item-menu-btn">keyboard_arrow_down</i>
            </a>
            <a href="/productos" class="nav-item"><p>Productos</p></a>
            <a href="/servicios" class="nav-item"><p>Servicios</p></a>
            <a href="/" class="nav-item" id="brand">
              <img src="{{asset('img/logos/logo_studio-01.png')}}" alt="">
            </a>
            <a href="/promociones_concursos" class="nav-item"><p>Promociones y concursos</p></a>
            <a href="/tips" class="nav-item"><p>Tips</p></a>
            <a href="/portafolio" class="nav-item"><p>Portafolio</p>
            </a>
            @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado'
            and Auth::user()->cuentable->roles()->whereRaw("empleado_rol.empleado_id = ".Auth::user()->cuentable->id." and (nombre = 'administrador' or nombre = 'recepcionista')")->first())
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
              <div class="user-photo">
                <img src="{{asset('storage/'.Auth::user()->photo)}}" alt="">
              </div>
              @else
              <div class="user-photo">
                <img src="{{asset('img/profile_photos/default.gif')}}" alt="">
              </div>
              @endif
              <i class="material-icons down" id="user-options">keyboard_arrow_down</i>
            </div>
            @endif
        </nav>

        @if($cart = session('cart'))
        <div class="cart-toggle">
          <i class="material-icons">shopping_cart</i>
          <span>{{count($cart['productos'])}}</span>
        </div>
        <div class="cart-items">
          <div class="col-xs-12 header">
            <span class="btn-xs btn pull-right btn-danger descartar-cart">Descartar todo</span>
          </div>
          <div class="items-body">
            @foreach($cart['productos'] as $i => $p)
            <div class="item" style="@if($i%2 == 0){{'background-color:#fff'}}@endif">
              <div class="img-container">
                <img src="{{$p['foto']}}" alt="" width="100%">
              </div>
              <div class="info">
                <p style="">
                  {{$p['nombre']}}<br><span class="cant">({{$p['cantidad']}})</span>
                  <span>
                    <i class="material-icons remove-p" id="{{$p['id']}}">remove_circle</i>
                  </span>
                </p>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-xs-12 footer-cart">
            <div class="col-xs-12">
              <p id="monto-cart" style="text-align:center">${{$cart['monto']}}</p>
            </div>
            <div class="center" id="btn-cart-comprar">Comprar</div>
          </div>
        </div>
        @endif
        @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado'
        and Auth::user()->cuentable->roles()->where('nombre','administrador')->first())
        <div class="nav-dropdown-child" id="1">
          <a href="/admin/inventario">Inventario</a>
          <a href="/admin/servicios">Gestion de servicios</a>
          <a href="/admin/clientes">Clientes</a>
          <a href="/personal">Personal</a>
          <a href="/admin/promociones">Promociones</a>
          <a href="/admin/concursos">Concursos</a>
          <a href="/portafolio">Portafolio</a>
          <a href="/subir_contenido">Subir contenido</a>
          <a href="/subirtip">Subir Tip</a>
          <a href="/gestionartips">Gestión de Tips</a>
          <a href="/gestion_portafolio">Portafolio</a>
        </div>
        @elseif(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado'
        and Auth::user()->cuentable->roles()->where('nombre','recepcionista')->first())
        <div class="nav-dropdown-child" id="1">
          <a href="/admin/inventario">Inventario</a>
          <a href="/admin/servicios">Gestion de servicios</a>
          <a href="/admin/clientes">Clientes</a>
        </div>
        @endif
        <div class="nav-dropdown-child" id="2">
          <a href="/contacto">Contacto</a>
          <a href="/profesionales">Profesionales</a>
        </div>


        <div class="menu">
          <h4 id="menu-title">Menú</h4>
          <i class="material-icons" id="hide-menu-btn">keyboard_arrow_left</i>
          <div class="">
            <a href="/nosotros" class="menu-item"><p>Nosotros</p></a>
            <a href="/contacto" class="menu-item"><p>Contacto</p></a>
            <a href="/productos" class="menu-item"><p>Productos</p></a>
            <a href="/servicios" class="menu-item"><p>Servicios</p></a>
            <a href="/promociones_concursos" class="menu-item"><p>Promociones y concursos</p></a>
            <a href="/tips" class="menu-item"><p>Tips</p></a>
            <a href="/portafolio" class="menu-item"><p>Portafolio</p></a>
            @if(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado'
            and Auth::user()->cuentable->roles()->where('nombre','administrador')->first())
            <a class="menu-item menu-item-parent" id="1"><p>Administración</p><i class="material-icons down">keyboard_arrow_down</i></a>
            <a href="/admin/inventario" class="menu-item-children" id="1">Inventario</a>
            <a href="/admin/servicios" class="menu-item-children" id="1">Gestion de servicios</a>
            <a href="/admin/clientes" class="menu-item-children" id="1">Clientes</a>
            <a href="/personal" class="menu-item-children" id="1">Personal</a>
            <a href="/gestionartips" class="menu-item-children" id="1">Gestión de Tips</a>
            <a href="/admin/promociones" class="menu-item-children" id="1">Promociones</a>
            <a href="/admin/concursos" class="menu-item-children" id="1">Concursos</a>
            <a href="/gestion_portafolio" class="menu-item-children" id="1">Portafolio</a>
            @elseif(Auth::check() and Auth::user()->cuentable_type == 'App\Empleado'
            and Auth::user()->cuentable->roles()->where('nombre','recepcionista')->first())
            <a class="menu-item menu-item-parent" id="1"><p>Administración</p><i class="material-icons down">keyboard_arrow_down</i></a>
            <a href="/admin/inventario" class="menu-item-children" id="1">Inventario</a>
            <a href="/admin/servicios" class="menu-item-children" id="1">Gestion de servicios</a>
            <a href="/admin/clientes" class="menu-item-children" id="1">Clientes</a>
            @endif
          </div>
        </div>

        @if(Auth::check())
        <div class="" id="user-menu">
          <p>{{Auth::user()->cuentable->nombre}}<br>{{Auth::user()->email}}</p>
          @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
          <a href="/micuenta/{{Auth::user()->cuentable->id}}">Mi cuenta</a>
          @else

          <a href="/micuentaE/{{Auth::user()->cuentable->id}}">Mi cuenta</a>
          @endif

          @if(Auth::user()->cuentable_type == strval(App\Cliente::class))
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
        <script src="{{elixir('js/app.js')}}"></script>
        <script src="{{elixir('js/jquery-3.1.1.min.js')}}"></script>
        <script type="text/javascript" src="{{elixir ('js/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{elixir('js/bootstrap.js')}}"></script>


        </script>
        <script>


            $(document).ready(function(){

              if($('.main-container').outerHeight(true) + $('body').children('.footer').outerHeight(true) <= $(window).height()){
                $('body').children('.footer').css({
                  position:'absolute',
                  bottom:'0'
                });
              }
              else{
                $('body').children('.footer').css({
                  position:'relative'
                });
              }

              function showModal(id) {
                $modal = $(id)
                $modal.fadeIn();
                $children = $modal.children('.modal-black-card');
                $children.fadeIn(400);
                $children.css('-webkit-transform','scale(1)');
              }

              function closeModal(modalId){
                $parent = $(modalId).children('.modal-black-card')
                $parent.css('-webkit-transform','scale(.7)');
                $parent.fadeOut(400, function () {
                  $parent.parent().fadeOut();
                });
              }

              $('#comprar-btn').click(function () {
                $('form#confirmar-compra').submit()
              })

              $('#btn-cart-comprar').click(function () {
                $('#monto-cart-confirm').text($('#monto-cart').text())
                showModal('#confirmar-compra-modal-back')
              })

              $('.descartar-cart').click(function () {
                $.ajax({
                  url:"/productos/descartar-cart",
                  type:"post",
                  data:{
                    _token:"{{csrf_token()}}"
                  }
                }).done(function(){
                  $('.cart-toggle').remove()
                  $('.cart-items').remove()
                })
              })

              $('.cart-toggle').click(function () {
                if($('.cart-items').css('right') == '0px')
                  $('.cart-items').css('right','-400px')
                else $('.cart-items').css('right','0px')
              })

              $('.remove-p').click(function () {
                var $this = $(this)
                $.ajax({
                  url:"/productos/remove-from-cart",
                  type:"post",
                  dataType:"json",
                  data:{
                    _token:"{{csrf_token()}}",
                    id: $this.attr('id')
                  }
                }).done(function (response){
                  if(response.totalCount < 1)
                  {
                    $('.cart-toggle').hide()
                    $('.cart-items').hide()
                    $('.cart-items').children('.item').remove()
                  }
                  else {
                    if(response.count < 1)
                      $this.parent().parent().parent().parent().remove()
                    else $this.parent().parent().children('.cant').text('('+response.count+')')
                    $('#monto-cart').text('$'+response.monto)
                  }
                })
              })

                $('input.phone').keypress(function (e) {
                   if(!$.isNumeric(e.key) || $(this).val().length > 20){
                     e.preventDefault();
                   }
                })

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

                $('.switch-container-red').click(function () {
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

                if($(this).width() < 1196){
                  $('.menu-btn').css('display','initial');
                  $('.nav-item').hide();
                  $('#brand').show();
                }
                else{
                  $('.menu-btn').css('display','none');
                  $('.nav-item').show();
                }

                $('.nav-item').css('opacity',1);

                $('.user-photo').slideDown("slow");

                $(window).resize(function () {
                  if($(this).width() < 1196){
                    $('.menu-btn').css('display','initial');
                    $('.nav-item').hide();
                    $('#brand').show();
                  }
                  else{
                    $('.menu').css('left','-200px');
                    $('.menu-btn').css('display','none');
                    $('.nav-item').show();
                  }
                  if($('.main-container').outerHeight(true) + $('body').children('.footer').outerHeight(true) <= $(window).height()){
                    $('body').children('.footer').css({
                      position:'absolute',
                      bottom:'0'
                    });
                  }
                  else{
                    $('body').children('.footer').css({
                      position:'relative'
                    });
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
        <script src="{{elixir('js\app.js')}}"></script>
        @yield('js')
    </body>
</html>
