@extends('layouts.master')

@section('title')
Gestión de clientes
@endsection

@section('css')
<style media="screen">
  body{
    background-image: url('{{asset("img/walls/3.jpg")}}');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
  .nav-bar{
      box-shadow: none;
      border-bottom: none;
      background-color: rgba(0, 0, 0, 0.5);
  }
  .footer{
    box-shadow: none;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .main-title{
    color: goldenrod;
    font-family: 'Lobster Two';
  }
  #list{
    box-shadow:  0 0 3px rgba(0, 0, 0, 0.7);
    background-color: rgba(0, 0, 0, 0.6);
    padding: 0;
    border-radius: 1px;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
  #list>.header{
    background-color: rgba(0, 0, 0, 0.8);
    padding: 15px;
  }
  #searcher{
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    min-width: 200px;
    color: #aaa;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 3px 26px 3px 13px;
  }
  #searcher:focus{
    border: 1px solid #444;
    outline: none;
  }
  .buscador-container{
    display: table;
    margin: auto;
  }
  .buscador-container>div{
    display: block;
    width: 100%;
    position: relative;
  }
  .buscador-container>div>i{
    color: #eee;
    position: absolute;
    right: 6px;
    top: 6px;
    font-size: 18px;
  }
  .cliente-item{
    background-color: #222;
  }
  tbody, thead{
    text-align: center;
  }
  tbody{
    text-shadow: 0 0 1px rgba(0, 0, 0, 0.5),0 0 3px rgba(0, 0, 0, 0.5);
    color: #fff;
  }
  thead{
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    color:#ccc;
  }
  th{
    text-shadow: 0 0 1px rgba(0, 0, 0, 0.5), 0 0 3px rgba(0, 0, 0, 0.5);
    font-weight: 100;
    color: #fff;
    padding-top: 20px;
    padding-bottom: 20px;
  }
  td{
    padding-top: 7px;
    padding-bottom: 7px;
  }
  tr.cliente:hover{
    background-color: rgba(255, 255, 255, .02);
  }
  .icon-btn{
    color: #ccc;
    display: block;
    padding: 3px;
    padding-top: 5px;
    padding-bottom: 0;
    margin: 0;
    cursor: pointer;
  }
  .icon-btn:link{
    color: #fff;
  }
  .icon-btn:visited{
    color: #fff;
  }
  .icon-btn:hover{
    color: #fff;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.7);
    border-radius: 3px;
  }
  .icon-btn>i{
    margin: 0;
    padding: 0;
  }
  .icon-square{
    width: 3.6vh;
    height: 3.6vh;
  }
  .icon-square>i{
    font-size: 18px;
  }
  .filter-container{
    position: absolute;
    right: 5px;
    border: 1px solid #333;
    z-index: 1;
    top: 40px;
    display: none;
    background-color: #111;
    border-radius: 3px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.9);
  }
  .filter-container>.item{
    padding: 2px 5px 2px 5px;
    cursor: pointer;
    color: #ccc;
  }
  .filter-container>.item-active{
    color: goldenrod;
  }
  .filter-container>.item:hover{
    background-color: rgba(255, 255, 255, .08);
    color: #fff;
  }
  #filter-selected{
    margin-top:  60px;
    line-height: 26px;
  }
  .option-icon{
    margin-top: -3px;
  }
</style>
@endsection

@section('body')
<div class="col-xs-12 main-container" style="margin-top:100px;margin-bottom:50px">
  <h3 class="main-title col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">Clientes</h3>
  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" id="list">
    <div class="header">
      <div class="pull-right" style="position:relative;">
        <span class="hidden-xs" style="margin-right:12px;color:#bbb;" id="filter-selected">Todos</span>
        <abbr title="Filtrar">
          <div class="icon-btn option-icon pull-right" id="filter-btn">
            <i class="material-icons">filter_list</i>
          </div>
        </abbr>
      </div>
      <div class="filter-container">
        <div class="item item-active" id="todos">Todos</div>
        <div class="item" id="con-cuenta">Con cuenta web</div>
        <div class="item" id="sin-cuenta">Sin cuenta web</div>
        <div class="item" id="adeudados">Adeudados</div>
        <div class="item" id="al-corriente">Al corriente</div>
        <div class="item" id="con-credito">Crédito activado</div>
        <div class="item" id="sin-credito">Crédito desactivado</div>
      </div>
      <abbr title="Nuevo cliente">
        <a href="/clientes/agregar" class="pull-left icon-btn option-icon" id="add-btn">
          <i class="material-icons">add</i>
        </a>
      </abbr>
      <div class="buscador-container">
        <div class="">
          <input type="text" name="buscador" value="" class="" id="searcher" placeholder="buscar por nombre o tel...">
          <i class="material-icons">search</i>
        </div>
      </div>
    </div>
    <div class="body">
    @if(count($clientes) < 1)
      <p style="padding:5px;border-radius:3px;margin:2%;">No se encontraron clientes en el sistema.<br>Una vez que los clientes compren productos o requieran algún sevicio aparencerán en esta sección.</p>
    @else
    <table style="width:100%;">
      <thead>
        <th style="text-align:center">Nombre</th>
        <th style="text-align:center" class="hidden-xs"># citas</th>
        <th style="text-align:center" class="hidden-xs"># compras</th>
        <th style="text-align:center">Telefono</th>
        <th style="text-align:center">Cuenta web</th>
        <th></th>
      </thead>
      <tbody id="clientes">
        @foreach($clientes as $cliente)
        <tr class="cliente">
          <td class="nombre">{{$cliente->nombre." ".$cliente->apellido}}</td>
          <td class="hidden-xs citas">{{$cliente->citas()->count()}}</td>
          <td class="hidden-xs compras">{{$cliente->compras()->count()}}</td>
          <td class="tel">{{$cliente->telefono}}</td>
          @if($cliente->esDeudor)
          <td class="deudor" style="display:none">Si</td>
          @else
          <td class="deudor" style="display:none">No</td>
          @endif
          @if($cliente->cuenta)
          <td class="cuenta">Si</td>
          @else
          <td class="cuenta">No</td>
          @endif
          <td>
            <a href="/admin/clientes/info/{{$cliente->id}}" class="icon-btn icon-square">
              <i class="material-icons">info</i>
            </a>
          </td>
          <td>
            <a href="/admin/citas/agregar/{{$cliente->id}}" class="icon-btn icon-square">
              <i class="material-icons">date_range</i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
    </div>
  </div>
  <p class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" style="padding:0;margin-top:10px;margin-bottom:10px;color:#fff;text-shadow: 0 0 3px rgba(0,0,0,1), 0 0 10px rgba(0,0,0,1)">
    {{count($clientes)}} encontrado(s).
  </p>
</div>
@endsection

@section('js')
<script type="text/javascript">
  if($('.main-container').height() + 150 < $(window).height()){
    $('.footer').css({
      position:'absolute',
      bottom:'0'
    });
  }
  else{
    $('.footer').css({
      position:'relative'
    });
  }
  $(document).ready(function () {

    $(window).resize(function () {
      if($('.main-container').height() + 150 < $(window).height()){
        $('.footer').css({
          position:'absolute',
          bottom:'0'
        });
      }
      else{
        $('.footer').css({
          position:'relative'
        });
      }
    });

    $('#filter-btn').click(function () {
      $('.filter-container').toggle(200);
    });

    $('.filter-container>.item').click(function () {
      $('.filter-container>.item-active').removeClass('item-active');
      $(this).addClass('item-active');
      $('#filter-selected').text($(this).text());
      $('.filter-container').hide(200);
      filter();
    });

    $('#searcher').keyup(function () {
      filter();
    });

    function filter() {
      $.ajax({
        url:'/admin/clientes/filter',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          searchText: $('#searcher').val(),
          filterId: $('.filter-container>.item-active').attr('id')
        }
      }).done(function (clientes) {
        $('tbody#clientes').children().remove();
        $.each(clientes, function (i, cliente) {
          var $tr = $('<tr class="cliente">');
          $tr.append($('<td class="nombre">'+cliente.nombre+" "+cliente.apellido+'</td>'));
          $tr.append($('<td class="hidden-xs citas">'+cliente.citas.length+'</td>'));
          $tr.append($('<td class="hidden-xs compras">'+cliente.compras.length+'</td>'));
          $tr.append($('<td class="tel">'+cliente.telefono+'</td>'));
          if(cliente.esDeudor){
            $tr.append($('<td class="deudor" style="display:none">Si</td>'));
          }
          else{
            $tr.append($('<td class="deudor" style="display:none">No</td>'));
          }
          if(cliente.cuenta){
            $tr.append($('<td class="cuenta">Si</td>'));
          }
          else{
            $tr.append($('<td class="cuenta">No</td>'));
          }
          $a = $('<a>');
          $a.attr('href',"/admin/clientes/info/"+cliente.id);
          $a.addClass('icon-btn icon-square');
          $a.append($('<i class="material-icons">info</i>'));
          $td = $('<td>');
          $td.append($a);
          $tr.append($td);
          $a1 = $('<a>');
          $a1.attr('href',"/admin/citas/agregar/"+cliente.id);
          $a1.addClass('icon-btn icon-square');
          $a1.append($('<i class="material-icons">date_range</i>'));
          $td1 = $('<td>');
          $td1.append($a1);
          $tr.append($td1);
          $('tbody#clientes').append($tr);
        });
      });
    }

  });
</script>
@endsection
