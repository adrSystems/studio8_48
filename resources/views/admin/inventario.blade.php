@extends('layouts.master')

@section('title')
Inventario
@endsection

@section('css')
<style>
  body{
    background-image: url('{{asset("img/walls/5.jpg")}}');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: #555;
  }
  .footer{
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: none;
  }
  .main-title{
    color: #eee;
  }
  .side-menu{
    width: 100%;
    display: table;
    border: 1px solid rgba(0, 0, 0, 0.5);
    background-color: #fff;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    overflow: hidden;
    overflow: hidden;
    text-align: center;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
    margin-bottom: 10px;
  }
  .side-menu>.header{
    background: linear-gradient(to bottom, #ddd, #ccc);
    border-top: 1px solid #fff;
    color: #777;
    font-weight: 600;
    box-shadow: inset 0 -1px 3px rgba(0, 0, 0, 0.2);
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .side-menu>.body>.item{
    width: 100%;
    float: left;
    padding: 3px;
    color: #f76;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, .11);
    -webkit-transition: background-color .4s, color .4s, text-shadow .6s;
  }
  .side-menu>.body>.item-active{
    background-color: rgba(255, 0, 0, 0.5);
    color: #fff;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
  }
  .side-menu>.body>.last-item{
    border-bottom: none;
  }
  .list-container{
    border-radius: 3px;
    background-color: rgba(0, 0, 0, 0.03);
    margin-bottom: 5px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    float: left;
    position: relative;
  }
  .list-container>p{
    color: goldenrod;
    margin-top: 5px;
  }
  .list-container>h5{
    color: goldenrod;
  }
  .list-container>.list-item{

  }
  .sub-card{
    border-radius: 3px;
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.25);
    float: left;
    position: relative;
    width: 100%;
  }
  label{
    font-weight: 400;
    color: #eee;
  }
  .textbox2{
    background-color: rgba(255, 255, 255, .8);
    border-radius: 3px;
    width: 100%;
    padding: 5px 10px 5px 10px;
    border: 1px solid transparent;
    color: #444;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  }
  .btn1{
    background: linear-gradient(to bottom, #eee, #ddd);
    border: 1px solid skyblue;
    color: #555;
    padding: 3px 15px 5px 15px;
    font-size: 16px;
    border-radius: 3px;
    -webkit-transition: box-shadow .3s;
  }
  .btn1:hover{
    box-shadow: 0 1px 3px #aaa;
  }
  .btn-center{
    display: block;
    margin: auto;
  }
  .img-file-selector{
    padding-top: 10px;
    position: relative;
    border: 1px dashed #bbb;
    border-radius: 2px;
    overflow: hidden;
    text-align: center;
    text-overflow: ellipsis;
  }
  .img-file-selector>p{
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
    display: block;
    overflow: hidden;
  }
  .img-file-selector>input[type=file]{
    background-color: red;
    position: absolute;
    top: -80%;
    left: 0;
    width: 100%;
    height: 180%;
    cursor: pointer;
    opacity: 0;
  }
  .list-item>.img-container{
    position: relative;
    background-color: #fff;
    overflow: hidden;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
    padding: 0;
  }
  .list-item>.img-container:hover{
    box-shadow: 0 0 3px rgba(0, 0, 0, 0);
  }
  .list-item>.img-container:hover .shadow{
    opacity: 1;
    box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
  }
  .list-item>.img-container>.shadow{
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    background-color: rgba(255, 0, 0, .2);
    -webkit-transition: background-color .4s, box-shadow .8s, opacity .4s;
  }
  .list-item>.img-container>img{
    width: 100%;
  }
  .list-item>.img-container>.info{
    position: absolute;
    z-index: 1;
    top: 0;
    padding: 3px;
    padding-left: 10px;
    padding-right: 10px;
    max-width: 100%;
    color: #fff;
    text-align: center;
    background-color: rgba(255, 0, 0, 0.5);
  }
  .list-item>.img-container>.options{
    position: absolute;
    bottom: -40px;
    width: 50%;
    left: 25%;
    text-align: center;
    background-color: rgba(255, 0, 0, 0.5);
    -webkit-transition: bottom .4s;
  }
  .list-item>.img-container>.options>i{
    position: relative;
    margin: auto;
    margin-top: 4px;
    font-size: 20px;
    cursor: pointer;
    display: inline-block;
    float: none;
    color: rgba(255, 255, 255, 0.7);
    opacity: .2;
    -webkit-transition: margin .5s, opacity .7s;
  }
  .list-item>.img-container>.options>i:hover{
    color: #fff;
  }
  .list-item>.img-container>.options>i.edit{
    margin-right: 10px;
  }
  .list-item>.img-container>.options>i.delete{
    margin-left: 10px;
  }
  .modal-back{
    background-color: rgba(0, 0, 0, 0.4);
    width: 100%;
    height: 100%;
    position: fixed;
    display: none;
    z-index: 2;
    padding:  65px 15px 65px 15px;

  }
  .modal-back>.modal-black-card{
    position: relative;
    background-color: #fff;
    border: 1px solid #555;
    border-radius: 3px;
    padding: 0;
    display: none;
    max-height: 100%;
    overflow: auto;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5),0 0 10px rgba(0, 0, 0, 0.7);
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .4s;
  }
  .modal-back>.modal-black-card::-webkit-scrollbar{
    display: none;
  }
  .modal-black-card>.header,.modal-black-card>.modal-footer{
    background-color: rgba(0, 0, 0, .05);
    margin: 0;
    padding: 10px;
  }
  .modal-black-card>.header>.close-btn{
    float: right;
    cursor: pointer;
    font-size: 18px;
    color:#444;
    border-radius: 3px;
  }
  .modal-black-card>.header>.close-btn:hover{
    color: #fff;
    background-color: rgba(0, 0, 0, .2);
  }
  .modal-black-card>.modal-footer{
    width: 100%;
  }
  .modal-black-card>.modal-footer>button{
    border: 1px solid rgba(0, 0, 0, 0.1);
    color: #eee;
    background-color: rgba(255, 0, 0, 0.5);
    text-shadow: 0 0 1px rgba(0, 0, 0, .8);
    border-radius: 3px;
    -webkit-transition: background-color .4s, border .5s;
    padding: 3px 12px 3px 8px;
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
  }
  .modal-black-card>.modal-footer>button>i{
    font-size: 14px;
    float: left;
    margin-top: 3.5px;
    margin-right: 3px;
  }
  .modal-black-card>.modal-footer>button:hover{
    background-color: rgba(255, 0, 0, 0.60);
    border: 1px solid rgba(0, 0, 0, 0.3);
  }
  .modal-black-card>.header>h4{
    margin: 0;
    color: goldenrod;
    font-family: 'Lobster Two';
  }
  .modal-black-card>.header{
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
  }
  .modal-black-card>.body{
    position: relative;
    padding: 10px;
    overflow: auto;
    color: #777;
  }
  .modal-black-card>.body::-webkit-scrollbar{
    width:  15px;
    border-radius: 12px;
  }
  .modal-black-card>.body::-webkit-scrollbar-thumb{
    background: #222;
    border: 4px solid #111;
    border-radius: 12px;
  }
  label.dark{
    color: #999;
  }
  .subcontainer{
    border: 1px solid rgba(255, 255, 255, .03);
  }
  .square-btn{
    background-color: #f75;
    border: 1px solid #f53;
    width: 25px;
    cursor: pointer;
    height: 25px;
    border-radius: 2px;
    -webkit-transition: border-radius .4s;
  }
  .square-btn:hover{
    color: #fff;
    border-radius: 100%;
  }
  .square-btn>i{
    font-size: 23px;
    color: #eee;
  }
  .circle-btn{
    border-radius: 100%;
    height: 20px;
    width: 20px;
    cursor: pointer;
    border: 1.5px solid skyblue;
    -webkit-transition: background-color .4s;
  }
  .circle-btn:hover i{
    color: #fff;
  }
  .circle-btn>i{
    color: skyblue;
    font-size: 18px;
  }
  #add-subcategoria-toggle{
    background-color: transparent;
    float: right;
  }
  #add-subcategoria-toggle:hover{
    background-color: dodgerblue;
  }
  #agregar-subcategoria-modal-back{
    z-index: 3;
  }
  .textbox3{
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-color: rgba(0, 0, 0, 0.05);
    padding-left: 5px;
  }
  .textbox3-with-btn{
    padding-right: 25px;
    width: 100%;
  }
  .textbox3-btn{
    position: absolute;
    right: 5px;
    top: 3px;
  }
  .categorias-subcontainer{
    border: 1px solid rgba(0, 0, 0, .13);
    padding: 0;
    overflow: auto;
    max-height: 600px;
  }
  .categorias-subcontainer::-webkit-scrollbar{
    display: none;
  }
  .categorias-subcontainer>div>.item{
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 0;
    border-radius: 2px;
  }
  .categorias-subcontainer>div>.item>.header{
    background-color: rgba(255, 255, 255, 0.2);
    padding: 5px;
    padding-bottom: 7px;
    text-align: center;
    position: relative;
    cursor: pointer;
  }
  .categorias-subcontainer>div>.item>.header>h5{
    margin: 0;
  }
  .categorias-subcontainer>div>.item>.header>.select-btn, .categorias-subcontainer>div>.item>.header>.remove-btn{
    position: absolute;
    top: 4px;
    border-radius: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    right: 3px;
    height: 20px;
    width: 20px;
  }
  .categorias-subcontainer>div>.item>.header>.select-btn>i{
    padding-top: 1px;
    padding-right: 1px;
    font-size: 18px;
  }
  .categorias-subcontainer>div>.item>.header>.remove-btn>i{
    padding-top: 1px;
    padding-right: 1px;
    font-size: 18px;
    color: rgb(255, 102, 85);
  }
  .categorias-subcontainer>div>.item>.header>.selected{
    color: rgba(255, 0, 0, 0.6);
  }
  .categorias-subcontainer>div>.item>.header>.unselected{
    color: #777;
  }
  .categorias-subcontainer>div>.item>.body{

  }
  .categorias-subcontainer>div>.item>.body>.item{
    text-align: center;
    color: #ddd;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .item2{
    text-align: center;
    width: 100%;
    padding-top: 5px;
    color:#bbb;
    background: #111;
    padding-bottom: 5px;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .item2:hover{
    color: #ddd;
  }
  .item2-selected{
    text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
    color: #fff;
  }
  #manage-cat-panel{
    display: none;
  }
  #subcategorias-cont-to-manage, #subcategorias-des-cont-to-manage{
    padding: 4px;
    padding-top: 0;
    margin-bottom: 5px;
  }
  .action-item-btn{
    border-radius: 5px;
    border: 1px solid red;
    background: #f76;
  }
  .action-item-btn:hover{
    background: #f65;
  }
  .action-item-btn-xs{
    width: 30px;
    height: 18px;
    cursor: pointer;
  }
  .prodcutos-sub-item-btn{
    position: absolute;
    top: 6px;
    right: 22px;
    text-align: center;
    color: #eee;
    line-height: 15px;
  }
  #categorias-subcontainer{
    background-color: #fff;
    border-radius: 3px;
  }
  .btn2{
    background: linear-gradient(to bottom, #f75, #d53);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    color: #ddd;
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, .5);
    -webkit-transition: padding .4s;
  }
  .btn2:hover{
    padding-left: 10px;
    padding-right: 10px;
  }
  .add-sub-tb-container{
    background: rgba(255, 0, 0, 0.5);
    border-radius: 3px;
    margin-top: 3px;
    position: relative;
    padding: 3px;
  }
  .add-sub-tb-container>.add-sub-btn{
    position: absolute;
    top: 10px;
    cursor: pointer;
    right: 6px;
    font-size: 18px;
    color: #f76;
  }
  .add-sub-tb-container>.add-sub-tb{
    width: 100%;
    padding: 5px 22px 5px 10px;
    border: 1px solid rgba(255, 0, 0, 0.5);
    border-radius: 3px;
  }
  textarea{
    width: 100%;
    resize: none;
  }
  .switch-center{
    float: none;
    display: table;
    margin: auto;
    width: auto;
  }
  .textbox2-auto{
    background-color: rgba(255, 255, 255, .8);
    border-radius: 3px;
    padding: 5px 10px 5px 10px;
    border: 1px solid transparent;
    color: #444;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
  }
  .categorias-marca-container{
    background-color: rgba(255, 255, 255, 0.1);
  }
  .marca-item{
    padding: 0;
    width: 100%;
    float: left;
    color: #ddd;
    text-align: center;
  }
  .marca-item>.info{
    position: relative;
    padding: 0;
    overflow: hidden;
  }
  .marca-item>.info>.add-cat-toggle{
    position: absolute;
    z-index: 1;
    top: 3px;
    right: 3px;
    cursor: pointer;
    color: #eee;
    padding: 0;
    overflow: hidden;
  }
  .marca-item>.info>span{
    color: #555;
    z-index: 5;
  }
  .marca-item>.info>.img-container-container{
    -webkit-filter: blur(7px) brightness(30%);
    width: 120%;
    height: 120%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    top: -10%;
    left: -10%;
    position: absolute;
  }
  .marca-item>.info>.img-container{
    position: relative;
    padding: 15px;
    padding-bottom: 0;
    width: 40%;
    margin: auto;
    margin-bottom: 5px;
  }
  .marca-item>.info>.img-container>img{
    width: 100%;
    box-shadow: 0 0 55px rgba(0, 0, 0, 0.8);
  }
  #marcas-container{
    overflow: auto;
    max-height: 500px;
  }
  #marcas-container::-webkit-scrollbar{
    display: none;
  }
  .textbox2-group-container{
    position: relative;
    display: table;
    width: 100%;
  }
  .textbox2-group-container>.icon{
    display: table-cell;
    width: 40px;
    background-color: rgba(0, 0, 0, 0.5);
    border: 1px solid #fff;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    height: 30px;
  }
  .textbox2-group-container>.icon-red{
    display: table-cell;
    width: 40px;
    background-color: #f75;
    border: 1px solid #f86;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    height: 100%;
  }
  .textbox2-group-container>.icon>i, .textbox2-group-container>.icon-red>i{
    color: #fff;
    position: absolute;
    top: 5px;
    font-weight: 100;
    left: 8px;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.2);
  }
  .textbox2-group-container>.textbox2{
    display: table-cell;
    width: 100%;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
  }
  #precio-venta-container{
    display: none;
  }
  .producto-item{
    background-color: rgba(0, 0, 0, 0.5);
    width: 100%;
    position: relative;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    float: left;
  }
  .producto-item>.img-container{
    width: 100%;
    position: relative;
  }
  .producto-item>.img-container>.shadow{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
    -webkit-transition: background-color .3s, box-shadow .6s;
  }
  .producto-item:hover .img-container .shadow{
    background-color: rgba(255, 0, 0, 0.3);
    box-shadow: inset 0 0 30px rgba(0, 0, 0, 0.5);
  }
  .producto-item>.img-container>i{
    position: absolute;
    background-color: rgba(255, 0, 0, 0.5);
    cursor: pointer;
    color: #fff;
    padding: 4px;
    z-index: 1;
  }
  .producto-item>.img-container>.descontinuar-producto-toggle{
    top: 0px;
    left: 0px;
  }
  .producto-item>.img-container>.editar-producto-toggle{
    top: 0px;
    right: 0px;
  }
  .producto-item>.img-container>.surtir-producto-toggle{
    bottom: 0px;
    right: 0px;
  }
  .producto-item>.img-container>i:hover{
    color: #fda;
  }
  .producto-item>.img-container>img{
    width: 100%;
  }
  .producto-item>.info{
    width: 100%;
  }
  .producto-item>.info>div>span{
    display: block;
    text-align: center;
    color: #fff;
    margin: auto;
    padding: 15px 0 15px 0;
  }
  .producto-item>.info>div>button{
    border: 1px solid #fff;
    color: #eee;
    border-radius: 3px;
    margin: auto;
    background-color: transparent;
    display: block;
    margin-bottom: 15px;
  }
  .producto-item>.info>div>button:hover{
    background-color: rgba(255, 255, 255, 0.1);
  }
  .list-container>.header{
    background-color: rgba(0, 0, 0, 0.1);
    width: 100%;
    position: relative;
    float: left;
    color: #fff;
    font-weight: 600;
    padding-bottom: 15px;
  }
  #producto-summary{
    float: left;
    position: relative;
  }
  #producto-summary>.img-container{
    position: relative;
    width: 100px;
    margin: auto;
    display: block;
    overflow: hidden;
    border-radius: 3px;
    border: 1px solid skyblue;
    margin-bottom: 15px;
  }
  #producto-summary>.img-container>img{
    width: 100%;
  }
  #producto-summary>div>span{
    float: right;
    padding-left: 5px;
    text-align: right;
    font-weight: 600;
  }
  #producto-summary>div>p{
    float: left;
  }
  #producto-details-subcontainer{
    float: left;
    position: relative;
  }
  #producto-details-subcontainer>.img-container{
    position: relative;
    width: 100px;
    margin: auto;
    display: block;
    overflow: hidden;
    border-radius: 3px;
    border: 1px solid skyblue;
    margin-bottom: 15px;
  }
  #producto-details-subcontainer>.img-container>img{
    width: 100%;
  }
  #producto-details-subcontainer>div>p{
    margin-top: 10px;
    margin-bottom: 5px;
  }
  #producto-details-subcontainer>div>span{
    padding: 3px;
    background-color: rgba(0, 0, 0, .08);
  }
  #producto-statistics-subcontainer>div>p{
    margin-bottom: 5px;
  }
  #producto-statistics-subcontainer>div>span{
    padding: 3px;
    border-radius: 2px;
    background-color: rgba(0, 0, 0, 0.1);
  }
  #producto-statistics-subcontainer>div.info-group{
    padding: 3px;
    border-radius: 2px;
    border: 1px dashed rgba(0, 0, 0, .1);
    margin-bottom: 10px;
  }
  .restore-producto-toggle{
    top: 0;
    left: 0;
  }
  .card1>.body{
    color: #888;
  }
  .grey{
    color: #888;
  }
  label{
    color: #888;
  }
  .existencia-msg{
    width: 100%;
    margin: 10px 0 10px 0;
  }
  .existencia-msg>span{
    padding: 3px;
    font-size: 18px;
    text-align: center;
    border-radius: 3px;
    font-weight: 600;
    background-color: rgba(0, 0, 0, 0.1);
    display: block;
    margin: auto;
  }
  .center{
    display: block;
    margin: auto;
  }
  .searcher1{
    border-radius: 3px;
    border: 1px solid rgba(0, 0, 0, 0.35);
    color: #555;
    padding: 2px 5px 2px 5px;
  }
  .searcher1:hover{
    box-shadow: 0 1px 3px rgba(0, 0, 0, .15);
  }
</style>
@endsection

@section('body')
<form class=""  action="/admin/inventario/marcas/delete" method="post" id="delete-marca">
  <input type="hidden" name="marcaId" value="">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<form class=""  action="/admin/inventario/marcas/restore" method="post" id="restore-marca">
  <input type="hidden" name="marcaToRestore" value="">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>

<div class="modal-back" id="surtir-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Entrada de productos</h4>
    </div>
    <div class="body">
      <div class="col-xs-12" id="venta-publico-desactivada-msg">
        <div class="alert alert-warning">
          <p>No está activada la venta al público de este producto... Para activarla, vaya a editar producto</p>
        </div>
      </div>
      <div class="col-xs-12">
        <label for="" class="dark">Cantidad de productos destinados a aplicación de servicios</label>
      </div>
      <div class="col-xs-12">
        <input type="number" name="cantidadProductosApServicios" value="0" class="textbox2" style="width:100%" min="0" max="500">
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <label for="" class="dark" id="cant-pro-venta-label">Cantidad de productos destinados a venta</label>
      </div>
      <div class="col-xs-12">
        <input type="number" name="cantidadProductosVenta" value="0" class="textbox2" style="width:100%" min="0" max="500">
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <label for="" class="dark">Precio de compra actual:</label>
        <span id="precio-compra-actual" style="font-weight:600"></span>
      </div>
      <div class="switch-container switch-center" id="switch-cambiar-precio-compra" active="0" style="background-color:rgba(0,0,0,.1)">
        <span style="color:#f53;padding-left:2px">Cambiar precio compra</span>
        <div class="switch-bar switch-center" style="background-color:rgba(0,0,0,.08);border-color:rgba(0,0,0,.2)">
          <div class="switch-btn inactive" style=""></div>
        </div>
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <input type="text" name="nuevoPrecioCompraSurticion" value="" class="textbox2 money" placeholder="nuevo precio de compra...">
      </div>
      <div class="col-xs-12" style="margin-top:10px" id="precio-venta-label">
        <label for="" class="dark">Precio de venta actual:</label>
        <span id="precio-venta-actual" style="font-weight:600"></span>
      </div>
      <div class="switch-container switch-center" id="switch-cambiar-precio-venta" active="0" style="background-color:rgba(0,0,0,.1)">
        <span style="color:#f53;padding-left:2px">Cambiar precio venta</span>
        <div class="switch-bar switch-center" style="background-color:rgba(0,0,0,.08);border-color:rgba(0,0,0,.2)">
          <div class="switch-btn inactive" style=""></div>
        </div>
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <input type="text" name="nuevoPrecioVentaSurticion" value="" class="textbox2 money" placeholder="nuevo precio de venta...">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="surtir-btn" producto=""><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="producto-details-modal-back">
  <div class="modal-black-card col-xs-12 col-md-8 col-md-offset-2">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Detalles del producto</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-6">
          <div class="alert alert-info" id="producto-details-subcontainer">
            <div class="col-xs-12">
              <h5 style="text-align:center">Sobre el producto</h5>
            </div>
            <div class="img-container">
              <img src="" alt="" id="producto-details-img">
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Código:</p><span id="codigo-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Nombre:</p><span id="producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>De la marca:</p><span id="marca-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Categoria:</p><span id="categoria-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Subcategoria:</p><span id="subcategoria-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Precio Compra:</p><span id="precio-compra-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Venta al público:</p><span id="venta-publico-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Precio venta:</p><span id="precio-venta-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Contenido:</p><span id="contenido-producto-details"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Descripción:</p><span id="descripcion-producto-details"></span>
            </div>
          </div>
      </div>
      <div class="col-xs-12 col-md-6">
          <div class="alert alert-warning col-xs-12" id="producto-statistics-subcontainer">
            <div class="col-xs-12">
              <h5 style="text-align:center">Estadísticas mensuales (<span style="font-weight:600" id="mes-cuestion"></span>)</h5>
            </div>
            <div class="existencia-msg" style="float:left">
              <span id="existencia-msg"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Unidades agregadas este mes:</p>
              <span id="u-added-mes"></span>
              <p><span id="u-added-venta-mes"></span> para venta</p>
              <p><span id="u-added-serv-mes"></span> para la aplicación de servicios</p>
            </div>
            <div class="col-xs-12 info-group">
              <p>Sé invirtió en total en este producto:</p>
              <span id="inversion-mensual"></span>
              <p>Sé invirtió solo para venta en este producto:</p>
              <span id="inversion-mensual-venta"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Número de ventas:</p>
              <span id="ventas-mensuales-count"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Ganancias esperadas: </p>
              <span id="ventas-esperadas"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Ganancias totales:</p>
              <span id="ventas-mensuales"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Faltante para alcanzar ganancias esperadas:</p>
              <span id="diferencia"></span>
            </div>
            <div class="col-xs-12 info-group">
              <p>Utilidad:</p>
              <span id="utilidad-mensual"></span>
              <p>* Tomando en cuenta solamente los productos destinados para venta al público.</p>
            </div>
            <div class="col-xs-12 info-group">
              <p>Cantidad de productos utilizados este mes para aplicación de servicios:</p>
              <span id="aplicacion-servicios-mensuales"></span>
            </div>
          </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="editar-producto-modal-back">
  <div class="modal-black-card col-xs-12 col-md-8 col-md-offset-2">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Editar producto</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-6">
        <div class="col-xs-12">
          <h5 style="text-align:center">Producto a modificar</h5>
          <div class="alert alert-info" id="producto-summary">
            <div class="img-container">
              <img src="" alt="" id="producto-summary-img">
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Nombre:</p><span id="producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>De la marca:</p><span id="marca-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Código:</p><span id="codigo-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Precio Compra:</p><span id="precio-compra-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Venta al público:</p><span id="venta-publico-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Precio venta:</p><span id="precio-venta-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Contenido:</p><span id="contenido-producto-a-modificar"></span>
            </div>
            <div class="col-xs-12" style="padding:'0">
              <p>Descripción:</p><span id="descripcion-producto-a-modificar"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <form action="/admin/inventario/producto/editar" method="post" enctype="multipart/form-data" id="form-editar-producto">
          <input type="hidden" name="productoToEdit" value="">
          <input type="hidden" name="nuevoSeVendeAlPublico" value="0">
          <input type="hidden" name="subcategoriaProductoAEditar" value="">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="col-xs-12">
            <div class="col-xs-12 alert alert-warning">
              <p>Complete solamente lo que quiere cambiar</p>
            </div>
          </div>
          <div class="col-xs-12">
            <label for="" class="dark">Ingrese el nuevo nombre</label>
          </div>
          <div class="col-xs-12">
            <input type="text" name="newProductoName" value="" class="textbox2" style="width:100%">
          </div>
          <div class="col-xs-12" style="margin-top:10px">
            <label for="" class="dark">Seleccione la nueva foto</label>
          </div>
          <div class="col-xs-12">
            <div class="img-file-selector col-xs-12">
              <p>Haz click o arrastra un archivo...</p>
              <input type="file" name="nuevaFoto" value="" accept="image/jpeg,.png,.gif">
            </div>
          </div>
          <div class="col-xs-12">
            <hr>
          </div>
          <div class="col-xs-12" style="margin-top:15px">
            <label for="" style="color:#555">Descripción</label>
            <textarea name="nuevaDescripcion" class="textbox2"></textarea>
          </div>
          <div class="col-xs-12" style="margin-top:15px">
            <label for="" style="color:#555">Precio compra</label>
            <div class="textbox2-group-container">
              <div class="icon-red">
                <i class="material-icons">attach_money</i>
              </div>
              <input type="text" name="nuevoPrecioCompra" value="" class="textbox2 money">
            </div>
          </div>
          <div class="col-xs-12" style="margin-top:15px">
            <div class="switch-container-red switch-center" id="venta-publico-to-edit" active="0" style="background-color:rgba(0,0,0,.1)">
              <span style="color:#f53;padding-left:2px">Venta al público</span>
              <div class="switch-bar switch-center" style="background-color:rgba(0,0,0,.08);border-color:rgba(0,0,0,.15)">
                <div class="switch-btn inactive" style=""></div>
              </div>
            </div>
          </div>
          <div class="col-xs-12" id="precio-venta-container-edit">
            <label for="" style="color:#555">Precio venta</label>
            <div class="textbox2-group-container">
              <div class="icon-red">
                <i class="material-icons" style="">attach_money</i>
              </div>
              <input type="text" name="nuevoPrecioVenta" value="" class="textbox2 money">
            </div>
          </div>
          <div class="col-xs-12" style="margin-top:15px">
            <label for="" style="color:#555">Contenido</label>
          </div>
          <div class="col-xs-12">
            <input type="text" name="nuevoContenido" value="" class="number col-xs-12 col-sm-8 col-md-6 col-lg-8 textbox2-auto">
            <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4" style="padding-left:10px;padding-right:0">
              <select class="textbox2-auto" name="nuevaUnidadMedida" style="width:100%;height:34px">
                <option value="">Unidad de medida...</option>
                <option value="gr">gramos</option>
                <option value="ml">mililitros</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="editar-producto-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="agregar-categoria-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Nueva categoria</h4>
    </div>
    <div class="body">
      <div class="col-xs-12">
        <label for="" class="dark">Ingrese el nombre</label>
      </div>
      <div class="col-xs-12">
        <input type="text" name="categoriaNombre" value="" class="textbox2" style="width:100%">
      </div>
      <div class="col-xs-12" style="margin-top:10px">
        <label for="" class="dark">Agregue subcategorias</label>
      </div>
      <div class="col-xs-12">
        <div class="subcontainer" id="subcategorias-to-add-container">
          <div class="col-xs-12" style="padding:0">
            <input type="text" name="subcategoria-to-add" value="" class="textbox3 textbox3-with-btn" placeholder="escribe el nombre de la subcategoria...">
            <div class="circle-btn textbox3-btn" id="add-subcategoria-btn">
              <i class="material-icons">add</i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="agregar-categoria-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="editar-marca-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Editar marca</h4>
    </div>
    <div class="body">
      <form action="/admin/inventario/marcas/editar" method="post" enctype="multipart/form-data" id="form-editar-marca">
        <input type="hidden" name="marcaToEdit" value="">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-xs-12">
          <div class="col-xs-12 alert alert-warning">
            <p>Complete solamente lo que quiere cambiar</p>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="alert alert-info">
            <p>Marca a modificar: <span id="marca-a-modificar"></span></p>
          </div>
        </div>
        <div class="col-xs-12">
          <label for="" class="dark">Ingrese el nuevo nombre</label>
        </div>
        <div class="col-xs-12">
          <input type="text" name="newMarcaName" value="" class="textbox2" style="width:100%">
        </div>
        <div class="col-xs-12" style="margin-top:10px">
          <label for="" class="dark">Seleccione el nuevo logo</label>
        </div>
        <div class="col-xs-12">
          <div class="img-file-selector col-xs-12">
            <p>Haz click o arrastra un archivo...</p>
            <input type="file" name="nuevoLogo" value="" accept="image/jpeg,.png,.gif">
          </div>
        </div>
        <div class="col-xs-12">
          <hr>
        </div>
        <div class="col-xs-12">
          <div class=" col-xs-12 subcontainer categorias-subcontainer" id="categorias-subcontainer1">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" id="editar-marca"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="msg-container" id="eliminar-sub-msg-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3></h3>
    </div>
    <div class="body">
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="delete-sub-btn" sub="">Eliminar</button>
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="msg-container" id="eliminar-producto-msg-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3></h3>
    </div>
    <div class="body">
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="delete-producto-btn" sub="">Eliminar</button>
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="msg-container" id="msg-dialog">
  <div class="msg-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <h3></h3>
    </div>
    <div class="body">
    </div>
    <div class="msg-footer">
      <button type="button" name="button" id="delete-marca-btn">Eliminar</button>
      <button type="button" name="button" id="close-btn">Cerrar</button>
    </div>
  </div>
</div>

<div class="main-container">

  <div class="col-xs-12">
    <h3 class="main-title">Inventario</h3>
  </div>

  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
    <div class="side-menu">
      <div class="header">Menú</div>
      <div class="body">
        <div class="item item-active" for="marcas-card">Marcas</div>
        <div class="item" for="categorias-card">Categorias</div>
        <div class="item" for="productos-card">Productos</div>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">

          <div class="main-card" for="marcas-card">
            <div class="col-xs-12" style="padding:0">
              <div class="col-xs-12 col-md-4">
                <div class="card1">
                  <div class="header">
                    <h4>Lista marcas</h4>
                  </div>
                  <div class="body col-xs-12">
                    <div class="list-container col-xs-12" style="padding:0">
                      @if(\App\Marca::count() == 0)
                      <p style="padding:0 10px 0 10px">No se encontraron marcas registradas en el sistema.</p>
                      @else
                      <h5 style="text-align:center">Activas</h5>
                      @foreach(\App\Marca::get() as $marca)
                      <div class="list-item col-xs-12 col-sm-12 col-md-12 col-lg-6" style="padding:15px">
                        <div class="img-container col-xs-12">
                          <div class="shadow"></div>
                          <div class="options">
                            <i class="edit material-icons edit-marca" id="{{$marca->id}}" marca="{{$marca->nombre}}">edit</i>
                            <i class="delete material-icons delete-marca" id="{{$marca->id}}">delete</i>
                          </div>
                          <img src="{{asset('storage/'.$marca->logo)}}" alt="">
                          <div class="info">
                            <span class="">{{$marca->nombre}}</span>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                    <div class="list-container col-xs-12" style="padding:0">
                      @if(\App\Marca::onlyTrashed()->count() == 0)
                      <p style="padding:0 10px 0 10px">No se encontraron marcas descontinuadas en el sistema.</p>
                      @else
                      <h5 style="text-align:center">Descontinuadas</h5>
                      @foreach(\App\Marca::onlyTrashed()->get() as $marca)
                      <div class="list-item col-xs-12 col-sm-6" style="padding:15px">
                        <div class="img-container col-xs-12">
                          <div class="shadow"></div>
                          <div class="options">
                            <i class="restore material-icons restore-marca" id="{{$marca->id}}">restore</i>
                          </div>
                          <img src="{{asset('storage/'.$marca->logo)}}" alt="">
                          <div class="info">
                            <span class="">{{$marca->nombre}}</span>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-8">
                <div class="card1">
                  <div class="header">
                    <h4 style="text-align:center">Agregar nueva marca</h4>
                  </div>
                  <div class="body">
                    <form class="" action="/admin/inventario/marcas/agregar" method="post" enctype="multipart/form-data" id="add-marca">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="col-xs-12">
                        <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                          <label for="">Nombre</label>
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                          <input type="text" name="nombreMarca" value="{{old('nombreMarca')}}" class="textbox2">
                        </div>
                      </div>
                      <div class="col-xs-12" style="margin-top:15px;">
                        <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding:0">
                          <label for="">Logo</label>
                        </div>
                        <div class="img-file-selector col-xs-12 col-md-8 col-md-offset-2" style="background-color:rgba(255,255,255,.8)">
                          <p>Haz click o arrastra un archivo...</p>
                          <input type="file" name="logo" value="" accept="image/jpeg,.png,.gif">
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                          <hr>
                        </div>
                        <div class=" col-xs-12 col-md-8 col-md-offset-2" style="padding:0;margin-top:15px;">
                          <label for="" class="pull-left">Agregue las categorias que maneja</label>
                          <div class="square-btn pull-right" style="margin-bottom:5px" id="add-categoria-btn">
                            <i class="material-icons">add</i>
                          </div>
                        </div>
                        <div class=" col-xs-12 col-md-8 col-md-offset-2 subcontainer categorias-subcontainer" id="categorias-subcontainer">
                        <p style="margin-top:10px;padding:0 10px 0 10px" id="no-cat-advice">No se encontraron categorias, añada una nueva para continuar.</p>
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                          <hr>
                        </div>
                      </div>
                      <div class="col-xs-12" style="margin-top:35px;margin-bottom:15px;">
                        <button type="button" id="agregar-marca-btn" class="btn1 btn-center">Agregar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="main-card" for="categorias-card" style="display:none">
            <div class="col-xs-12" style="padding:0">
              <div class="col-xs-12 col-md-4">
                <div class="card1" style="max-height:600px">
                  <div class="header" style="margin:0">
                    <h4>Lista de categorias por marca</h4>
                  </div>
                  <div class="body col-xs-12" style="padding:0px">
                    @if(\App\Marca::count() == 0)
                    <p style="padding:0 10px 0 10px">No se marcas ni categorias registradas en el sistema.</p>
                    @else
                    @foreach(\App\Marca::get() as $marca)
                    <div class="marca-item" id="{{$marca->id}}">
                      <div class="info">
                        <!--<i class="material-icons add-cat-toggle" id="{{$marca->id}}">add_circle</i>-->
                        <div class="img-container-container" style="background-image:url({{asset('storage/'.$marca->logo)}})"></div>
                        <div class="img-container">
                          <img src="{{asset('storage/'.$marca->logo)}}" alt="">
                        </div>
                        <p style="color:#fff;text-shadow:0 0 20px #000;z-index:1;position:relative">{{$marca->nombre}}</p>
                      </div>
                      <div class="categorias-marca-container">
                        @if($marca->categorias()->count() == 0)
                        <p style="padding:10px;margin:0">No se encontraron categorias de esta marca.</p>
                        @else
                        @foreach($marca->categorias()->get() as $categoria)
                        <div class="item2 cat-item" id="{{$categoria->id}}">
                          <div class="info">
                            <span>{{$categoria->nombre}}</span>
                          </div>
                        </div>
                        @endforeach
                        @endif
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-8">
                <div class="card1 col-xs-12" style="padding-bottom:15px" id="manage-cat-panel">
                  <div class="header">
                    <h4 style="text-align:center">Modificar categoria</h4>
                  </div>
                  <div class="body">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <div class="alert alert-warning" style="display:none">
                        <p style="text-align:center;font-size:18px" id="nombre-categoria-a-editar">Categoria</p>
                      </div>
                    </div>
                    <input type="hidden" name="idCatAEditar" value="">
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <label for="">Nombre</label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <input type="text" name="nuevoNombreCategoria" value="" class="textbox2">
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3" style="margin-top:10px;margin-bottom:10px">
                      <button type="button" class="btn2 pull-right" id="cambiar-nombre-cat-btn">Cambiar</button>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <hr>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <label for="">Subcategorias</label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <div class="subcontainer" id="subcategorias-cont-to-manage">
                        <div class="add-sub-tb-container">
                          <input type="text" value="" class="add-sub-tb" placeholder="nombre de la subcategoria a agregar...">
                          <i class="material-icons add-sub-btn" id="">add_circle</i>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <label for="">Subcategorias descontinuadas (<span id="sub-des-count"></span>)</label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                      <div class="subcontainer" id="subcategorias-des-cont-to-manage">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="main-card" for="productos-card" style="display:none">
              <div class="col-xs-12 col-md-7">
                <div class="card1">
                  <div class="header" style="margin-bottom:0">
                    <h4>Explora los productos</h4>
                  </div>
                  <div class="body">
                    <div class="list-container">
                      <div class="header">
                        <div class="col-xs-12">
                          <h5 style="color:#f76">Lista de productos</h5>
                        </div>
                        <div class="col-xs-12" style="padding:0">
                          <div class="col-xs-12 col-sm-4">
                            <div class="col-xs-12" style="padding:0">
                              <label for="" style="text-align:center">Marca</label>
                            </div>
                            <select name="marcasFilter" class="textbox2">
                              <option value="">Seleccione una marca...</option>
                              @foreach(\App\Marca::get() as $marca)
                              <option value="{{$marca->id}}" class="marca">{{$marca->nombre}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <div class="col-xs-12" style="padding:0">
                              <label for="" style="text-align:center">Categoria</label>
                            </div>
                            <select name="catFilter" class="textbox2">
                              <option value="">Seleccione una categoria...</option>
                            </select>
                          </div>
                          <div class="col-xs-12 col-sm-4">
                            <div class="col-xs-12" style="padding:0">
                              <label for="" style="text-align:center">Subcategoria</label>
                            </div>
                            <select name="subFilter" class="textbox2">
                              <option value="">Seleccione una subcategoria...</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <hr>
                          <h5 style="color:#888;text-align:center">O busca por nombre o código o subcategoria...</h5>
                        </div>
                        <div class="col-xs-12">
                          <input type="text" name="searcher" value="" class="searcher1 col-xs-12 col-md-6 col-md-offset-3" placeholder="escribe aquí el termino de busqueda...">
                        </div>
                        <div class="col-xs-12">
                          <button type="button" name="search-btn" class="btn2 center" style="font-weight:200;margin-top:15px">Buscar</button>
                        </div>
                      </div>
                      <div class="body col-xs-12" style="padding:0" id="productos-container">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-5">
                <div class="card1">
                  <div class="header">
                    <h4 style="text-align:center">Nuevo producto</h4>
                  </div>
                  <div class="body">
                    <form class="" action="/admin/inventario/productos/agregar" method="post" enctype="multipart/form-data" id="add-product">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="seVendeAlPublico" value="0">
                      <div class="col-xs-12 col-md-8 col-md-offset-2" style="margin-top:15px;margin-bottom:15px">
                        <select class="textbox2" name="marcaForProduct">
                          <option value="">Seleccione una marca...</option>
                          @foreach(\App\Marca::get() as $marca)
                          <option value="{{$marca->id}}" class="marca">{{$marca->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px;margin-bottom:15px">
                        <select class="textbox2" name="catForProduct">
                          <option value="">Seleccione una categoria...</option>
                        </select>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px;margin-bottom:15px">
                        <select class="textbox2" name="subForProduct">
                          <option value="">Seleccione una subcategoria...</option>
                        </select>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreProducto" value="" class="textbox2">
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <label for="">Código identificador (Opcional)</label>
                        <input type="text" name="codigoProducto" value="" class="textbox2">
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <label for="">Descripción</label>
                        <textarea name="descripcion" class="textbox2"></textarea>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <label for="">Precio compra</label>
                        <div class="textbox2-group-container">
                          <div class="icon">
                            <i class="material-icons">attach_money</i>
                          </div>
                          <input type="text" name="precioCompra" value="" class="textbox2 money">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <div class="switch-container switch-center" id="venta-publico" active="0" style="background-color:rgba(0,0,0,.1)">
                          <span style="color:#555;padding-left:2px">Venta al público</span>
                          <div class="switch-bar switch-center" style="background-color:rgba(0,0,0,.15); box-shadow: inset 0 0 3px rgba(0,0,0,.2)">
                            <div class="switch-btn inactive" style="border-color:#999"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" id="precio-venta-container">
                        <label for="">Precio venta</label>
                        <div class="textbox2-group-container">
                          <div class="icon">
                            <i class="material-icons">attach_money</i>
                          </div>
                          <input type="text" name="precioVenta" value="" class="textbox2 money">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <label for="">Fotografía</label>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="img-file-selector" style="background-color:rgba(255,255,255,.8)">
                          <p>Haz click o arrastra un archivo...</p>
                          <input type="file" name="productoCover" value="" accept="image/jpeg,.png,.gif">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:15px">
                        <label for="">Contenido</label>
                      </div>
                      <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <input type="text" name="contenido" value="" class="number col-xs-12 col-sm-8 col-md-6 col-lg-8 textbox2-auto">
                        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4" style="padding-left:10px;padding-right:0">
                          <select class="textbox2-auto" name="uMedida" style="width:100%;height:34px">
                            <option value="gr">gramos</option>
                            <option value="ml">mililitros</option>
                          </select>
                        </div>
                      </div>
                    </form>
                    <div class="col-xs-12 col-md-10 col-md-offset-1" style="margin-top:30px; margin-bottom:30px">
                      <button id="agregar-producto-btn" class="btn1" style="margin:auto;display:block">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

  </div>

</div>
@endsection

@section('js')
<script type="text/javascript">



$(document).ready(function () {

  $('button[name=search-btn]').click(function () {
    if($('input[name=searcher]').val() == '') showMsg('Atención!',['Debe proporcionar termino para efectuar la busqueda.'])
    else {
      $('select[name=subFilter]').children('option[value=""]').attr('selected',true)
      $.ajax({
        url:"/admin/inventario/productos/search",
        type:"post",
        dataType:"html",
        data:{
          _token:"{{csrf_token()}}",
          word: $('input[name=searcher]').val()
        }
      }).done(function(html){
        $('#productos-container').children().remove()
        $('#productos-container').append(html)
        $('.editar-producto-toggle').click(function () {
          ////////////////////// modal editar
          var productoId = $(this).attr('id')
          $.ajax({
            url:"/admin/inventario/productos/get-by-id",
            type:"post",
            dataType:"json",
            data:{
              _token:"{{csrf_token()}}",
              id: productoId
            }
          }).done(function(producto){
            $('select[name=nuevaUnidadMedida]').children('').attr('selected',false)
            $('select[name=nuevaUnidadMedida]').children('option[value=""]').attr('selected',true)
            $('#producto-summary-img').attr('src', producto.fotografia)
            if(producto.venta_publico)
            {
              $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').removeClass('inactive');
              $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').addClass('active');
              $('#venta-publico-to-edit').attr('active', '1')
              $('input[name=nuevoSeVendeAlPublico]').val('1')
              $('#precio-venta-container-edit').slideDown(300)

            }
            else {
              $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').removeClass('active');
              $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').addClass('inactive');
              $('#venta-publico-to-edit').attr('active', '0')
              $('input[name=nuevoSeVendeAlPublico]').val('0')
              $('#precio-venta-container-edit').slideUp(300)
            }
            $('input[type=hidden][name=productoToEdit]').val(producto.id)
            $('#producto-a-modificar').text(producto.nombre)
            $('input[type=hidden][name=subcategoriaProductoAEditar]').val(producto.subcategoria.id)
            $('#marca-producto-a-modificar').text(producto.subcategoria.categoria.marca.nombre)
            $('#codigo-producto-a-modificar').text(producto.codigo)
            $('#descripcion-producto-a-modificar').text(producto.descripcion)
            $('#precio-compra-producto-a-modificar').text("$"+producto.precio_compra)
            if(producto.venta_publico)
            {
              $('#venta-publico-producto-a-modificar').text('Si')
              $('#precio-venta-producto-a-modificar').text("$"+producto.precio_venta)
            }
            else{
              $('#venta-publico-producto-a-modificar').text('No')
              $('#precio-venta-producto-a-modificar').text('-')
            }

            $('#contenido-producto-a-modificar').text(producto.contenido+" "+producto.u_medida)
            showModal('#editar-producto-modal-back')
          })
        })
        $('.detalles-producto-toggle').click(function () {
          var productoId = $(this).attr('id')
          $.ajax({
            url:"/admin/inventario/productos/get-by-id",
            type:"post",
            dataType:"json",
            data:{
              _token:"{{csrf_token()}}",
              id: productoId
            }
          }).done(function(producto){
            //info basica
            $('#producto-details-img').attr('src', producto.fotografia)
            $('#producto-details').text(producto.nombre)
            $('#marca-producto-details').text(producto.subcategoria.categoria.marca.nombre)
            $('#categoria-producto-details').text(producto.subcategoria.categoria.nombre)
            $('#subcategoria-producto-details').text(producto.subcategoria.nombre)
            $('#codigo-producto-details').text(producto.codigo)
            $('#descripcion-producto-details').text(producto.descripcion)
            $('#precio-compra-producto-details').text("$"+producto.precio_compra)
            if(producto.venta_publico)
            {
              $('#venta-publico-producto-details').text('Si')
              $('#precio-venta-producto-details').text("$"+producto.precio_venta)
            }
            else{
              $('#venta-publico-producto-details').text('No')
              $('#precio-venta-producto-details').text('-')
            }
            $('#contenido-producto-details').text(producto.contenido+" "+producto.u_medida)
            //estadisticas
            $('#mes-cuestion').text(producto.mesEnCuestion)
            $('#u-added-mes').text(producto.agregadosEsteMes)
            if(producto.agregadosEsteMes < 1) $('#existencia-msg').text('AGOTADO')
            else $('#existencia-msg').text('EN EXISTENCIA')
            $('#u-added-venta-mes').text(producto.paraVenta)
            $('#u-added-serv-mes').text(producto.paraAplicacion)
            $('#inversion-mensual').text("$"+producto.inversionMensual)
            $('#inversion-mensual-venta').text("$"+producto.inversionParaVenta)
            $('#ventas-mensuales-count').text(producto.repeticionEnVentas)
            $('#ventas-esperadas').text("$"+producto.expectativaGanancias)
            $('#ventas-mensuales').text("$"+producto.gananciaMensual)
            $('#diferencia').text("$"+producto.diferencia)
            $('#aplicacion-servicios-mensuales').text(producto.utilizacion)
            if(producto.utilidad < 0)
              $('#utilidad-mensual').text("- $"+Math.abs(producto.utilidad)+" (perdida)")
            else if(producto.utilidad == 0)
              $('#utilidad-mensual').text("$"+producto.utilidad+" (sin perdida)")
            else
              $('#utilidad-mensual').text("$"+producto.utilidad+" (ganancia)")
            showModal('#producto-details-modal-back')
          })
        })
        $('.descontinuar-producto-toggle').click(function () {
          $('#delete-producto-btn').attr('id', $(this).attr('id'))
          showMsgDialog('Confirmar acción',
          ['¿Descontinuar producto?','Ya no podrán realizarse ventas con este producto hasta que lo restaure'],
          '#eliminar-producto-msg-dialog')
        })
        $('.restore-producto-toggle').click(function () {
          var pid = $(this).attr('id')
          $.ajax({
            url:"/admin/inventario/productos/restaurarById",
            type:"post",
            dataType:"json",
            data:{
              _token:"{{csrf_token()}}",
              id: pid
            }
          }).done(function(response){
            if(response.result)
            {
              showProductsTable(response.producto.subcategoria.id)
            }
            else {
              showMsg('Ups!',['Ha ocurrido un error. Intentelo de nuevo.'])
            }
          })
        })
        $('.surtir-producto-toggle').click(function () {
          var pid = $(this).attr('id')
          $.ajax({
            url:"/admin/inventario/productos/get-by-id",
            type:"post",
            dataType:"json",
            data:{
              _token:"{{csrf_token()}}",
              id: pid
            }
          }).done(function(producto){
            $('#surtir-btn').attr('producto',producto.id)
            $('#precio-compra-actual').text("$"+producto.precio_compra)
            $('#precio-venta-actual').text("$"+producto.precio_venta)
            $('input[name=cantidadProductosVenta]').val('0')
            $('input[name=cantidadProductosApServicios]').val('0')
            $('input[name=nuevoPrecioCompraSurticion]').val('')
            $('input[name=nuevoPrecioVentaSurticion]').val('')
            $('input[name=nuevoPrecioCompraSurticion]').hide()
            $('input[name=nuevoPrecioVentaSurticion]').hide()
            $('#switch-cambiar-precio-venta').children('.switch-bar').children('.switch-btn').removeClass('active');
            $('#switch-cambiar-precio-venta').children('.switch-bar').children('.switch-btn').addClass('inactive');
            $('#switch-cambiar-precio-venta').attr('active','0');
            $('#switch-cambiar-precio-compra').children('.switch-bar').children('.switch-btn').removeClass('active');
            $('#switch-cambiar-precio-compra').children('.switch-bar').children('.switch-btn').addClass('inactive');
            $('#switch-cambiar-precio-compra').attr('active','0');
            if(producto.venta_publico)
            {
              $('#switch-cambiar-precio-venta').show()
              $('#venta-publico-desactivada-msg').hide()
              $('#precio-venta-label').show()
              $('input[name=cantidadProductosVenta]').show()
              $('#cant-pro-venta-label').show()
            }
            else {
              $('#switch-cambiar-precio-venta').hide()
              $('#venta-publico-desactivada-msg').show()
              $('#precio-venta-label').hide()
              $('input[name=cantidadProductosVenta]').hide()
              $('#cant-pro-venta-label').hide()
            }
            showModal('#surtir-modal-back')
          })
        })
      })
    }
  })

  $('#switch-cambiar-precio-compra').click(function () {
    if($(this).attr('active') == '0'){
      $('input[name=nuevoPrecioCompraSurticion]').hide()
      $('input[name=nuevoPrecioCompraSurticion]').val('')
    }
    else {
      $('input[name=nuevoPrecioCompraSurticion]').show()
      $('input[name=nuevoPrecioCompraSurticion]').val('')
    }
  })

  $('#switch-cambiar-precio-venta').click(function () {
    if($(this).attr('active') == '0'){
      $('input[name=nuevoPrecioVentaSurticion]').hide()
      $('input[name=nuevoPrecioVentaSurticion]').val('')
    }
    else {
      $('input[name=nuevoPrecioVentaSurticion]').show()
      $('input[name=nuevoPrecioVentaSurticion]').val('')
    }
  })

  $('#surtir-btn').click(function () {
    if($('input[name=cantidadProductosApServicios]').val() < 1 && $('input[name=cantidadProductosVenta]').val() < 1){
      showMsg('Ups!',['La cantidad a ingresar debe ser en algún caso mayor a cero.'])
    }
    else if($('input[name=nuevoPrecioVentaSurticion]').val().length > 7 || $('input[name=nuevoPrecioCompraSurticion]').val().length > 7){
      showMsg('Ups!',['Una de las cantidades es demasiado grande. Ingrese un valor accesible'])
    }
    else if ($('#switch-cambiar-precio-venta').attr('active') == '1' && $('input[name=nuevoPrecioVentaSurticion]').val() == '') {
      showMsg('Ups!',['Ha seleccionado cambiar el precio de venta y debe proporcionar un valor.'])
    }
    else if ($('#switch-cambiar-precio-compra').attr('active') == '1' && $('input[name=nuevoPrecioCompraSurticion]').val() == '') {
      showMsg('Ups!',['Ha seleccionado cambiar el precio de compra y debe proporcionar un valor.'])
    }
    else {
      var id = $(this).attr('producto')
      $.ajax({
        url:"/admin/inventario/productos/surtir",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id,
          cantidadVenta: $('input[name=cantidadProductosVenta]').val(),
          cantidadAplicacion: $('input[name=cantidadProductosApServicios]').val(),
          precioVenta: $('input[name=nuevoPrecioVentaSurticion]').val(),
          precioCompra: $('input[name=nuevoPrecioCompraSurticion]').val()
        }
      }).done(function(response){
        if(!response.result)
        {
          showMsg('Ups!',['Ha ocurrido un error, Intentelo de nuevo.'])
        }
        else
        {
          closeModal('#surtir-modal-back')
          showMsg('Ok!',['Operación exitosa!'])
        }
      })
    }
  })

  $('#editar-producto-btn').click(function () {
    $.ajax({
      url:"/admin/inventario/productos/check-changes",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}",
        nombre: $('input[name=newProductoName]').val(),
        contenido: $('input[name=nuevoContenido]').val(),
        uMedida: $('select[name=nuevaUnidadMedida]').find('option:selected').val(),
        subcategoria: $('input[type=hidden][name=subcategoriaProductoAEditar]').val(),
        productoId: $('input[type=hidden][name=productoToEdit]').val()
      }
    }).done(function(response){
      if($('input[name=nuevoPrecioVenta]').val().length > 8 || $('input[name=nuevoPrecioCompra]').val().length > 8)
      {
        showMsg('Ups!',
        ['La cantidad monetaria es demasiado grande.'])
      }
      else if(response.result)
        showMsg('Ups!',
        ['Ya existe un producto con el mismo nombre y contenido (cantidad y unidad de medida) en esta subcategoria.'])
      else
      {
        if($('input[name=nuevoSeVendeAlPublico]').val() == '1'
        && response.producto.precio_venta == null && $('input[name=nuevoPrecioVenta]').val() == ''){
          showMsg('Ups!',
          ['Para activar la venta al público debe proporcionar un precio de venta.'])
        }
        else {
          $('form#form-editar-producto').submit()
        }
      }
    })

  })

  $('#delete-producto-btn').click(function () {
    var id = $(this).attr('id')
    $.ajax({
      url:"/admin/inventario/productos/descontinuarById",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}",
        id: id
      }
    }).done(function(response){
      if(response.result)
      {
        showProductsTable(response.producto.subcategoria.id)
      }
      else {
        showMsg('Ups!',['Ha ocurrido un error. Intentelo de nuevo.'])
      }
    })
  })

  $('#agregar-producto-btn').click(function () {
    if ($('select[name=catForProduct]').val() == '' || $('select[name=marcaForProduct]').val() == ''
    || $('select[name=subForProduct]').val() == '' || $('input[name=productoCover]').val() == ''
    || $('input[name=nombreProducto]').val() == '' || $('input[name=precioCompra]').val() == ''
    || ($('input[name=seVendeAlPublico]').val() == '1' && $('input[name=precioVenta]').val() == '')
    || $('textarea[name=descripcion]').val() == '' || $('select[name=uMedida]').val() == ''
    || $('input[name=contenido]').val() == '') {
        showMsg('Ups!',['Complete toda la información que se requiere.'])
    }
    else if($('input[name=precioVenta]').val().length > 8 || $('input[name=precioCompra]').val().length > 8)
    {
      showMsg('Ups!',
      ['La cantidad monetaria es demasiado grande.'])
    }
    else {
      $.ajax({
        url:"/admin/inventario/productos/is-repeated",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          marcaId: $('select[name=marcaForProduct]').val(),
          categoriaId: $('select[name=catForProduct]').val(),
          subcategoriaId: $('select[name=subForProduct]').val(),
          nombre: $('input[name=nombreProducto]').val(),
          contenido: {
            cantidad: $('input[name=contenido]').val(),
            unidad: $('select[name=uMedida]').val()
          }
        }
      }).done(function(response){
        if(response.result)
        {
          showMsg('Ups!', ['Ya existe un producto con el nombre y el contenido especificado en la subcategoria indicada.'])
        }
        else {
          $('form#add-product').submit()
        }
      })
    }
  })

  $('div#venta-publico').click(function () {
    if($(this).attr('active') == '0'){
      $('input[name=seVendeAlPublico]').val('0')
      $('#precio-venta-container').slideUp(300)
    }
    else {
      $('input[name=seVendeAlPublico]').val('1')
      $('#precio-venta-container').slideDown(300)
    }
  })

  $('#venta-publico-to-edit').click(function () {
    if($(this).attr('active') == '0'){
      $('input[name=nuevoSeVendeAlPublico]').val('0')
      $('#precio-venta-container-edit').slideUp(300)
    }
    else {
      $('input[name=nuevoSeVendeAlPublico]').val('1')
      $('#precio-venta-container-edit').slideDown(300)
    }
  })

  $('input.money').keypress(function (e) {
    if((!$.isNumeric(e.key) && e.key != '.')
    || ($(this).val().indexOf('.') > -1 && e.key == '.')
    || ($(this).val().indexOf('.') > -1 && $(this).val().indexOf('.') + 2 == $(this).val().length -1))
      e.preventDefault();
    else if(e.key == '.' && $(this).val().length == 0)
      $(this).val('0')
    else if($(this).val().length > 1 && $(this).val().charAt($(this).val().length-1) == '.')
    {
      e.preventDefault();
      $(this).val($(this).val()+e.key+"0")
    }
    else if($(this).val().length > 2 && $(this).val().charAt($(this).val().length-2) == '.')
    {
      e.preventDefault();
      $(this).val($(this).val()+"0")
    }
  })

  $('input.number').keypress(function (e) {
    if((!$.isNumeric(e.key) && e.key != '.')
    || ($(this).val().indexOf('.') > -1 && e.key == '.')
    || ($(this).val().indexOf('.') > -1 && $(this).val().indexOf('.') + 2 == $(this).val().length -1))
      e.preventDefault();
    if(e.key == '.' && $(this).val().length == 0)
      $(this).val('0')
  })

  $('select[name=subFilter]').change(function () {
    if($(this).val() != '')
    {
      var id = $(this).val()
      showProductsTable(id)
    }
    else {
      $('#productos-container').children().remove()
    }
  })

  function showProductsTable(id) {
    $.ajax({
      url:"/admin/inventario/marcas/get-productos-table",
      type:"post",
      dataType:"html",
      data:{
        _token:"{{csrf_token()}}",
        id: id
      }
    }).done(function(html){
      $('#productos-container').children().remove()
      $('#productos-container').append(html)
      $('.editar-producto-toggle').click(function () {
        ////////////////////// modal editar
        var productoId = $(this).attr('id')
        $.ajax({
          url:"/admin/inventario/productos/get-by-id",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: productoId
          }
        }).done(function(producto){
          $('select[name=nuevaUnidadMedida]').children('').attr('selected',false)
          $('select[name=nuevaUnidadMedida]').children('option[value=""]').attr('selected',true)
          $('#producto-summary-img').attr('src', producto.fotografia)
          if(producto.venta_publico)
          {
            $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').removeClass('inactive');
            $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').addClass('active');
            $('#venta-publico-to-edit').attr('active', '1')
            $('input[name=nuevoSeVendeAlPublico]').val('1')
            $('#precio-venta-container-edit').slideDown(300)

          }
          else {
            $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').removeClass('active');
            $('#venta-publico-to-edit').children('.switch-bar').children('.switch-btn').addClass('inactive');
            $('#venta-publico-to-edit').attr('active', '0')
            $('input[name=nuevoSeVendeAlPublico]').val('0')
            $('#precio-venta-container-edit').slideUp(300)
          }
          $('input[type=hidden][name=productoToEdit]').val(producto.id)
          $('#producto-a-modificar').text(producto.nombre)
          $('input[type=hidden][name=subcategoriaProductoAEditar]').val(producto.subcategoria.id)
          $('#marca-producto-a-modificar').text(producto.subcategoria.categoria.marca.nombre)
          $('#codigo-producto-a-modificar').text(producto.codigo)
          $('#descripcion-producto-a-modificar').text(producto.descripcion)
          $('#precio-compra-producto-a-modificar').text("$"+producto.precio_compra)
          if(producto.venta_publico)
          {
            $('#venta-publico-producto-a-modificar').text('Si')
            $('#precio-venta-producto-a-modificar').text("$"+producto.precio_venta)
          }
          else{
            $('#venta-publico-producto-a-modificar').text('No')
            $('#precio-venta-producto-a-modificar').text('-')
          }

          $('#contenido-producto-a-modificar').text(producto.contenido+" "+producto.u_medida)
          showModal('#editar-producto-modal-back')
        })
      })
      $('.detalles-producto-toggle').click(function () {
        var productoId = $(this).attr('id')
        $.ajax({
          url:"/admin/inventario/productos/get-by-id",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: productoId
          }
        }).done(function(producto){
          //info basica
          $('#producto-details-img').attr('src', producto.fotografia)
          $('#producto-details').text(producto.nombre)
          $('#marca-producto-details').text(producto.subcategoria.categoria.marca.nombre)
          $('#categoria-producto-details').text(producto.subcategoria.categoria.nombre)
          $('#subcategoria-producto-details').text(producto.subcategoria.nombre)
          $('#codigo-producto-details').text(producto.codigo)
          $('#descripcion-producto-details').text(producto.descripcion)
          $('#precio-compra-producto-details').text("$"+producto.precio_compra)
          if(producto.venta_publico)
          {
            $('#venta-publico-producto-details').text('Si')
            $('#precio-venta-producto-details').text("$"+producto.precio_venta)
          }
          else{
            $('#venta-publico-producto-details').text('No')
            $('#precio-venta-producto-details').text('-')
          }
          $('#contenido-producto-details').text(producto.contenido+" "+producto.u_medida)
          //estadisticas
          $('#mes-cuestion').text(producto.mesEnCuestion)
          $('#u-added-mes').text(producto.agregadosEsteMes)
          if(producto.agregadosEsteMes < 1) $('#existencia-msg').text('AGOTADO')
          else $('#existencia-msg').text('EN EXISTENCIA')
          $('#u-added-venta-mes').text(producto.paraVenta)
          $('#u-added-serv-mes').text(producto.paraAplicacion)
          $('#inversion-mensual').text("$"+producto.inversionMensual)
          $('#inversion-mensual-venta').text("$"+producto.inversionParaVenta)
          $('#ventas-mensuales-count').text(producto.comprasMensuales.length)
          $('#ventas-esperadas').text("$"+producto.expectativaGanancias)
          $('#ventas-mensuales').text("$"+producto.gananciaMensual)
          $('#diferencia').text("$"+producto.diferencia)
          $('#aplicacion-servicios-mensuales').text(producto.utilizacion)
          if(producto.utilidad < 0)
            $('#utilidad-mensual').text("- $"+Math.abs(producto.utilidad)+" (perdida)")
          else if(producto.utilidad == 0)
            $('#utilidad-mensual').text("$"+producto.utilidad+" (sin perdida)")
          else
            $('#utilidad-mensual').text("$"+producto.utilidad+" (ganancia)")
          showModal('#producto-details-modal-back')
        })
      })
      $('.descontinuar-producto-toggle').click(function () {
        $('#delete-producto-btn').attr('id', $(this).attr('id'))
        showMsgDialog('Confirmar acción',
        ['¿Descontinuar producto?','Ya no podrán realizarse ventas con este producto hasta que lo restaure'],
        '#eliminar-producto-msg-dialog')
      })
      $('.restore-producto-toggle').click(function () {
        var pid = $(this).attr('id')
        $.ajax({
          url:"/admin/inventario/productos/restaurarById",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: pid
          }
        }).done(function(response){
          if(response.result)
          {
            showProductsTable(response.producto.subcategoria.id)
          }
          else {
            showMsg('Ups!',['Ha ocurrido un error. Intentelo de nuevo.'])
          }
        })
      })
      $('.surtir-producto-toggle').click(function () {
        var pid = $(this).attr('id')
        $.ajax({
          url:"/admin/inventario/productos/get-by-id",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: pid
          }
        }).done(function(producto){
          $('#surtir-btn').attr('producto',producto.id)
          $('#precio-compra-actual').text("$"+producto.precio_compra)
          $('#precio-venta-actual').text("$"+producto.precio_venta)
          $('input[name=cantidadProductosVenta]').val('0')
          $('input[name=cantidadProductosApServicios]').val('0')
          $('input[name=nuevoPrecioCompraSurticion]').val('')
          $('input[name=nuevoPrecioVentaSurticion]').val('')
          $('input[name=nuevoPrecioCompraSurticion]').hide()
          $('input[name=nuevoPrecioVentaSurticion]').hide()
          $('#switch-cambiar-precio-venta').children('.switch-bar').children('.switch-btn').removeClass('active');
          $('#switch-cambiar-precio-venta').children('.switch-bar').children('.switch-btn').addClass('inactive');
          $('#switch-cambiar-precio-venta').attr('active','0');
          $('#switch-cambiar-precio-compra').children('.switch-bar').children('.switch-btn').removeClass('active');
          $('#switch-cambiar-precio-compra').children('.switch-bar').children('.switch-btn').addClass('inactive');
          $('#switch-cambiar-precio-compra').attr('active','0');
          if(producto.venta_publico)
          {
            $('#switch-cambiar-precio-venta').show()
            $('#venta-publico-desactivada-msg').hide()
            $('#precio-venta-label').show()
            $('input[name=cantidadProductosVenta]').show()
            $('#cant-pro-venta-label').show()
          }
          else {
            $('#switch-cambiar-precio-venta').hide()
            $('#venta-publico-desactivada-msg').show()
            $('#precio-venta-label').hide()
            $('input[name=cantidadProductosVenta]').hide()
            $('#cant-pro-venta-label').hide()
          }
          showModal('#surtir-modal-back')
        })
      })
    })
  }

  $('select[name=catFilter]').change(function () {
    $('select[name=subFilter]').children('.sub').remove()
    $('#productos-container').children().remove()
    if($(this).val() != '')
    {
      var id = $(this).val()
      $.ajax({
        url:"/admin/inventario/marcas/get-subcategories",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(subcategorias){
        $.each(subcategorias, function (i, sub) {
          $('select[name=subFilter]').append($('<option class="sub" value="'+sub.id+'">'+sub.nombre+'</option>'))
        })
      })
    }
  })

  $('select[name=marcasFilter]').change(function () {
    $('select[name=catFilter]').children('.cat').remove()
    $('select[name=subFilter]').children('.sub').remove()
    $('#productos-container').children().remove()
    if($(this).val() != '')
    {
      var id = $(this).val()
      $.ajax({
        url:"/admin/inventario/marcas/get-categories",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(categorias){
        $.each(categorias, function (i, cat) {
          $('select[name=catFilter]').append($('<option class="cat" value="'+cat.id+'">'+cat.nombre+'</option>'))
        })
      })
    }
  })

  $('select[name=catForProduct]').change(function () {
    $('select[name=subForProduct]').children('.sub').remove()
    if($(this).val() != '')
    {
      var id = $(this).val()
      $.ajax({
        url:"/admin/inventario/marcas/get-subcategories",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(subcategorias){
        $.each(subcategorias, function (i, sub) {
          $('select[name=subForProduct]').append($('<option class="sub" value="'+sub.id+'">'+sub.nombre+'</option>'))
        })
      })
    }
  })

  $('select[name=marcaForProduct]').change(function () {
    $('select[name=catForProduct]').children('.cat').remove()
    $('select[name=subForProduct]').children('.sub').remove()
    if($(this).val() != '')
    {
      var id = $(this).val()
      $.ajax({
        url:"/admin/inventario/marcas/get-categories",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(categorias){
        $.each(categorias, function (i, cat) {
          $('select[name=catForProduct]').append($('<option class="cat" value="'+cat.id+'">'+cat.nombre+'</option>'))
        })
      })
    }
  })

  $('#agregar-marca-btn').click(function () {
    if(categoriasToAdd.length == 0 || $('input[name=nombreMarca]').val() == '' || $('input[type=file][name=logo]').val() == ''){
      showMsg('Ups!',['Ha omitido datos importantes.','Debe propocionar el nombre, el logo y las categorias de la marca.'])
    }
    else {
      $('form#add-marca').submit()
    }
  })

  $('#cambiar-nombre-cat-btn').click(function () {
    if($('input[name=nuevoNombreCategoria]').val() == '')
      showMsg('Ups!',['El nombre no puede estar vacio'])
    else{
      $.ajax({
        url:"/admin/inventario/categorias/is-repeated",
        type:"post",
        dataType:"json",
        data:{
          _token: "{{csrf_token()}}",
          nombre: $('input[name=nuevoNombreCategoria]').val()
        }
      }).done(function(response){
        if(response.result == true)
        {
          showMsg('Ups!', ['Ya existe una categoria con ese nombre en el sistema.'])
        }
        else
        {
        $.ajax({
          url:"/admin/inventario/categorias/cambiar-nombre",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: $('input[type=hidden][name=idCatAEditar]').val(),
            nombre: $('input[name=nuevoNombreCategoria]').val()
          }
        }).done(function(response){
          if(response.result)
          {
            $('.item2-selected>.info>span').text($('input[name=nuevoNombreCategoria]').val())
            $('#nombre-categoria-a-editar').text($('input[name=nuevoNombreCategoria]').val())
            showMsg('Ok!',['Nombre de la categoria cambiado con exito'])
            $('input[name=nuevoNombreCategoria]').val('')
          }
          else showMsg('Ups!',['Ha ocurrido un error'])
        })
        }
      })
    }
  })

  $('.add-sub-btn').click(function () {
    if($('input.add-sub-tb').val() != '')
    {
      var id = $(this).attr('id')
      $.ajax({
        url:"/admin/inventario/subcategorias/agregar",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          nombre: $('input.add-sub-tb').val(),
          id: id,
        }
      }).done(function(res){
        if(!res.result) showMsg(res.msg.title,[res.msg.body])
        else
        {
          $('input.add-sub-tb').val('')
          sub = res.sub;
          $item = $('<div class="subcategoria-item">')
          $item.css({
            'width':'100%',
            padding:'3px',
            'background-color':'rgba(0,0,0,.1)',
            'border-radius':'3px',
            'margin-top':'5px',
            position:'relative'
          })
          $tb = $('<input type="text" class="tb-sub-name" id="'+sub.id+'">')
          $tb.val(sub.nombre)
          $tb.css({
            border:'none',
            'padding-left':'5px',
            'padding-right':'5px',
            width:'100%',
            'padding-right':'40px',
            'color':'#555'
          })
          $tb.attr('readOnly',true)
          var $productosBtn = $('<div class="action-item-btn prodcutos-sub-item-btn action-item-btn-xs">')
          var $productosAbbr = $('<abbr title="0 productos"></abbr>')
          var $optionsBtn = $('<i class="material-icons">more_vert</i>')
          var $options =$('<div class="sub-options">')
          $options.attr('id',sub.id)
          $options.css({
            background:'#fff',
            border:'1px solid #888',
            padding:'0',
            position:'absolute',
            top:'0px',
            right:'-33px',
            'border-radius':'2px',
            'z-index':1,
            display:'none'
          })
          $optionsBtn.css({
            'position':'absolute',
            right:'2px',
            top:'6px',
            color:'#f76',
            'font-size':'18px',
            cursor:'pointer'
          })
          $optionsBtn.click(function () {
            $.each($('.sub-options'), function (i, e) {
              if($options.attr('id') != $(e).attr('id')) $(e).hide()
            })
            $options.toggle()
          })
          $productosBtn.text(0)
          $productosAbbr.append($productosBtn)
          $item.append($options)
          $item.append($productosAbbr)
          $item.append($optionsBtn)
          var $cancelBtn = $('<i class="material-icons cancel-sub-changes">cancel</i>')
          var $savebtn = $('<i class="material-icons save-sub-changes">save</i>')
          $savebtn.css({
            'position':'absolute',
            top:'6px',
            'font-size':'18px',
            right:'55px',
            color:'#f76',
            cursor:'pointer',
            display:'none'
          })
          $cancelBtn.css({
            'position':'absolute',
            top:'6px',
            'font-size':'18px',
            right:'75px',
            color:'#f76',
            cursor:'pointer',
            display:'none'
          })
          $cancelBtn.click(function () {
            $('.tb-sub-name[id='+sub.id+']').attr('readOnly',true)
            $(this).hide()
            $savebtn.hide()
            $('.tb-sub-name[id='+sub.id+']').val(sub.nombre)
          })
          $savebtn.click(function () {
            $.ajax({
              url:"/admin/inventario/subcategorias/is-repeated",
              type:"post",
              dataType:"json",
              data:{
                _token: "{{csrf_token()}}",
                nombre: $tb.val(),
                id:id
              }
            }).done(function(res2){
              if(res2.result == true)
              {
                showMsg('Ups!', ['Ya existe una subcategoria con ese nombre en el sistema.'])
              }
              else
              {
                $.ajax({
                  url:"/admin/inventario/subcategorias/cambiar-nombre",
                  type:"post",
                  dataType:"json",
                  data:{
                    _token:"{{csrf_token()}}",
                    id: sub.id,
                    nombre: $tb.val()
                  }
                }).done(function(res3){
                  if(!res3.result) showMsg('Ups!',['Ha ocurrido un error.'])
                  $tb.attr('readonly',true)
                  $savebtn.hide()
                  $cancelBtn.hide()
                })
              }
            })
          })
          $item.append($cancelBtn)
          $item.append($savebtn)
          $item.append($tb)
          var $editBtn = $('<i class="material-icons">edit</i>')
          var $removeBtn = $('<i class="material-icons">remove_circle</i>')
          $editBtn.css({
            'color':'#f65',
            position:'relative',
            float:'none',
            display:'block',
            margin:'auto',
            'font-size':'18px',
            padding:'0 2px 0 2px',
            cursor:'pointer'
          })
          $removeBtn.css({
            'color':'#f65',
            position:'relative',
            float:'none',
            display:'block',
            margin:'auto',
            'font-size':'18px',
            padding:'0 2px 0 2px',
            cursor:'pointer'
          })
          $editBtn.attr('id',sub.id)
          $removeBtn.attr('id',sub.id)
          $removeBtn.click(function () {
            $.ajax({
              url:"/admin/inventario/subcategorias/eliminar",
              type:"post",
              dataType:"json",
              data:{
                _token:"{{csrf_token()}}",
                id: sub.id
              }
            }).done(function(res2){
              if(!res2.result) showMsg('Ups!',['Ha ocurrido un error, intentelo de nuevo.'])
              else
              {
                $options.hide()
                $item.remove()
              }
            })
          })
          $editBtn.click(function () {
            $(this).parent().hide()
            $('.tb-sub-name').attr('readOnly',true)
            $('.tb-sub-name[id='+sub.id+']').attr('readOnly',false)
            $('.tb-sub-name[id='+sub.id+']').focus()
            $('.cancel-sub-changes').hide()
            $('.save-sub-changes').hide()
            $cancelBtn.show()
            $savebtn.show()
          })
          $options.append($editBtn)
          $options.append($removeBtn)
          $('#subcategorias-cont-to-manage').append($item)
        }
      })
    }
  })

  $('#delete-sub-btn').click(function () {
    var id = $(this).attr('sub')
    var $btn = $(this)
    $.ajax({
      url:"/admin/inventario/subcategorias/eliminar",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}",
        id: id
      }
    }).done(function(response){
      if(!response.result) showMsg('Ups!',['Ha ocurrido un error, intentelo de nuevo.'])
      else
      {
        fillCategoriesManagmentCard($('input[type=hidden][name=idCatAEditar]').val(), null)
      }
      var $msgCard = $btn.parent().parent()
      $msgCard.parent().delay().hide(200)
      $msgCard.css('opacity',0);
      $msgCard.css('margin-top','0px');
      $msgCard.css('-webkit-transform','scale(.7)');
    })
  })

  $('.cat-item').click(function () {
    fillCategoriesManagmentCard($(this).attr('id'), $(this))
  })

  function fillCategoriesManagmentCard (id1, $catItem1) {
    var id = id1
    var $catItem  = $catItem1
    $.ajax({
      url:"/admin/inventario/marcas/get-subcategories",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}",
        id: id
      }
    }).done(function(subcategorias){
      if($catItem != null)
      {
        $('.add-sub-btn').attr('id',id)
        $('.cat-item').removeClass('item2-selected')
        $catItem.addClass('item2-selected')
        $('input[type=hidden][name=idCatAEditar]').val(id)
        $('#nombre-categoria-a-editar').text($catItem.text())
        $('#manage-cat-panel').slideDown(400)
        $('#nombre-categoria-a-editar').parent().delay(400).slideDown(400, function () {
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
      })
      }
      $('#subcategorias-des-cont-to-manage').children('.subcategoria-item').remove()
      $('#subcategorias-cont-to-manage').children('.subcategoria-item').remove()
      var subcategoriasDescount = 0;
      $.each(subcategorias, function (i, sub) {
        $item = $('<div class="subcategoria-item">')
        $item.css({
          'width':'100%',
          padding:'3px',
          'background-color':'rgba(0,0,0,.1)',
          'border-radius':'3px',
          'margin-top':'5px',
          position:'relative'
        })
        $tb = $('<input type="text" class="tb-sub-name" id="'+sub.id+'">')
        $tb.val(sub.nombre)
        $tb.css({
          border:'none',
          'padding-left':'5px',
          'padding-right':'5px',
          width:'100%',
          'padding-right':'40px',
          'color':'#555'
        })
        $tb.attr('readOnly',true)
        var $productosBtn = $('<div class="action-item-btn prodcutos-sub-item-btn action-item-btn-xs">')
        var $productosAbbr = $('<abbr title="'+sub.productos.length+' productos"></abbr>')
        var $optionsBtn = $('<i class="material-icons">more_vert</i>')
        var $options =$('<div class="sub-options">')
        $options.attr('id',sub.id)
        $options.css({
          background:'#fff',
          border:'1px solid #CCC',
          padding:'0',
          position:'absolute',
          top:'0px',
          right:'-33px',
          'border-radius':'2px',
          'z-index':1,
          display:'none'
        })
        $optionsBtn.css({
          'position':'absolute',
          right:'2px',
          top:'6px',
          color:'#f76',
          'font-size':'18px',
          cursor:'pointer'
        })
        $optionsBtn.click(function () {
          $.each($('.sub-options'), function (i, e) {
            if($options.attr('id') != $(e).attr('id')) $(e).hide()
          })
          $options.toggle()
        })
        $productosBtn.text(sub.productos.length)
        $productosAbbr.append($productosBtn)
        $item.append($options)
        $item.append($productosAbbr)
        $item.append($optionsBtn)
        $item.append($tb)
        if(!sub.trashed)
        {
          var $cancelBtn = $('<i class="material-icons cancel-sub-changes">cancel</i>')
          var $savebtn = $('<i class="material-icons save-sub-changes">save</i>')
          $savebtn.css({
            'position':'absolute',
            top:'6px',
            'font-size':'18px',
            right:'55px',
            color:'#f65',
            cursor:'pointer',
            display:'none'
          })
          $cancelBtn.css({
            'position':'absolute',
            top:'6px',
            'font-size':'18px',
            right:'75px',
            color:'#f65',
            cursor:'pointer',
            display:'none'
          })
          $cancelBtn.click(function () {
            $('.tb-sub-name[id='+sub.id+']').attr('readOnly',true)
            $(this).hide()
            $savebtn.hide()
            $('.tb-sub-name[id='+sub.id+']').val(sub.nombre)
          })
          $savebtn.click(function () {
            $.ajax({
              url:"/admin/inventario/subcategorias/is-repeated",
              type:"post",
              dataType:"json",
              data:{
                _token: "{{csrf_token()}}",
                nombre: $tb.val(),
                id:id
              }
            }).done(function(response){
              if(response.result == true)
              {
                showMsg('Ups!', ['Ya existe una subcategoria con ese nombre en el sistema.'])
              }
              else
              {
                $.ajax({
                  url:"/admin/inventario/subcategorias/cambiar-nombre",
                  type:"post",
                  dataType:"json",
                  data:{
                    _token:"{{csrf_token()}}",
                    id: sub.id,
                    nombre: $tb.val()
                  }
                }).done(function(response){
                  if(!response.result) showMsg('Ups!',['Ha ocurrido un error.'])
                  $tb.attr('readonly',true)
                  $savebtn.hide()
                  $cancelBtn.hide()
                })
              }
            })
          })
          $item.append($cancelBtn)
          $item.append($savebtn)
          var $editBtn = $('<i class="material-icons">edit</i>')
          var $removeBtn = $('<i class="material-icons">remove_circle</i>')
          $editBtn.css({
            'color':'#f65',
            position:'relative',
            float:'none',
            display:'block',
            margin:'auto',
            'font-size':'18px',
            padding:'0 2px 0 2px',
            cursor:'pointer'
          })
          $removeBtn.css({
            'color':'#f65',
            position:'relative',
            float:'none',
            display:'block',
            margin:'auto',
            'font-size':'18px',
            padding:'0 2px 0 2px',
            cursor:'pointer'
          })
          $editBtn.attr('id',sub.id)
          $removeBtn.attr('id',sub.id)
          $removeBtn.click(function () {
            if(sub.productos.length > 0)
            {
              $('#delete-sub-btn').attr('sub',sub.id)
              showMsgDialog('Confirmar acción',[
                '¿Está seguro de que desea descontinuar la subcategoria junto con sus '+sub.productos.length+' productos?'
              ], '#eliminar-sub-msg-dialog')
            }
            else {
              $.ajax({
                url:"/admin/inventario/subcategorias/eliminar",
                type:"post",
                dataType:"json",
                data:{
                  _token:"{{csrf_token()}}",
                  id: sub.id
                }
              }).done(function(response){
                if(!response.result) showMsg('Ups!',['Ha ocurrido un error, intentelo de nuevo.'])
                else
                {
                  $options.hide()
                  $item.remove()
                }
              })
            }
          })
          $editBtn.click(function () {
            $(this).parent().hide()
            $('.tb-sub-name').attr('readOnly',true)
            $('.tb-sub-name[id='+sub.id+']').attr('readOnly',false)
            $('.tb-sub-name[id='+sub.id+']').focus()
            $('.cancel-sub-changes').hide()
            $('.save-sub-changes').hide()
            $cancelBtn.show()
            $savebtn.show()
          })
          $options.append($editBtn)
          $options.append($removeBtn)
          $('#subcategorias-cont-to-manage').append($item)
        }
        else
        {
          var $restoreBtn = $('<i class="material-icons restore-sub">restore</i>')
          $restoreBtn.css({
            'color':'#f65',
            position:'relative',
            float:'none',
            display:'block',
            margin:'auto',
            'font-size':'18px',
            padding:'0 2px 0 2px',
            cursor:'pointer'
          })
          $restoreBtn.attr('id',sub.id)
          $restoreBtn.click(function () {
            var subId = $(this).attr('id')
            $.ajax({
              url:"/admin/inventario/subcategorias/restaurar",
              type:"post",
              dataType:"json",
              data:{
                _token:"{{csrf_token()}}",
                id: subId
              }
            }).done(function(response){
              if(!response.result) showMsg('Ups!',['Ha ocurrido un error, intentelo de nuevo.'])
              else {
                fillCategoriesManagmentCard($('input[type=hidden][name=idCatAEditar]').val(), null)
              }
            })
          })
          $options.append($restoreBtn)
          $('#subcategorias-des-cont-to-manage').append($item)
          subcategoriasDescount++;
        }
      })
      $('#sub-des-count').text(subcategoriasDescount)
    })
  }

  var subcategorias = [];
  $('div#add-categoria-btn').click(function () {
    showModal('#agregar-categoria-modal-back')
  })

  $('.categorias-subcontainer>div>.item>.for-add-marca-header').click(function () {
    toggleCategories('add-marca', $(this))
  })

  $('.categorias-subcontainer>div>.item>.for-edit-marca-header').click(function () {
    toggleCategories('form-editar-marca', $(this))
  })

  function toggleCategories(formId, $header) {
    var $selectBtn = $header.children('.select-btn')
    if($selectBtn.hasClass('selected'))
    {
      $selectBtn.removeClass('selected')
      $selectBtn.addClass('unselected')
      $('form[id='+formId+']').children('input[type=hidden][id=categorias-input][value='+$header.attr('id')+']').remove()
    }
    else {
      $selectBtn.removeClass('unselected')
      $selectBtn.addClass('selected')
      $('form#'+formId).append($('<input type="hidden" name="categorias[]" id="categorias-input" value="'+$header.attr('id')+'">'))
    }
  }

  $('#agregar-categoria-modal-back').find('.close-btn').click(function () {
    $('#subcategorias-to-add-container').children('div.item').remove()
    $('input[name=categoriaNombre]').val('')
    subcategorias = []
  })

  $('#agregar-categoria-modal-back').find('#close-btn').click(function () {
    $('#subcategorias-to-add-container').children('div.item').remove()
    $('input[name=categoriaNombre]').val('')
    subcategorias = []
  })

  var  categoriasToAdd = []
  $('#agregar-categoria-btn').click(function () {
    if($('input[name=categoriaNombre]').val() == '' || subcategorias.length == 0)
      showMsg('Ups!', ['Debe proporcionar el nombre de la categoria así como las subcategorias de ella.'])
    else
    {
      var categoriasRepetidas = $.grep(categoriasToAdd, function (cat, i) {
        return cat.nombre.toLowerCase() == $('input[name=categoriaNombre]').val().toLowerCase()
      })
      if(categoriasRepetidas.length > 0) showMsg('Ups!', ['Ya agregó una categoria con ese nombre.'])
      else
      {
        ////////////////////////////////push to categories//////////////////////////////
        var cat = {
          index: categoriasToAdd.length,
          nombre: $('input[name=categoriaNombre]').val(),
          subcategorias: subcategorias
        }
        categoriasToAdd.push(cat)
        $('form[id=add-marca]').append($("<input type='hidden' name='categorias[]' cat='"+cat.index+"' id='categorias-to-add' value='"+JSON.stringify(cat)+"'>"))
        $('#subcategorias-to-add-container').children('div.item').remove()
        if(categoriasToAdd.length < 1) $('#no-cat-advice').show()
        else $('#no-cat-advice').hide()
        $.ajax({
          url:"/admin/inventario/categorias/get-tabla-categorias",
          type:"post",
          dataType:"html",
          data:{
            _token:"{{csrf_token()}}",
            categorias: categoriasToAdd
          }
        }).done(function(html){
          $('#categorias-subcontainer').children().remove('div')
          $('#categorias-subcontainer').append(html)
          $('.categorias-subcontainer>div>.item>.header>.remove-cat-to-add-btn').click(function () {
            var index = $(this).attr('id')
            var categoria = $.grep(categoriasToAdd, function (cat, i) {
              return cat.index == index
            })[0]
            categoriasToAdd.splice(categoria.index ,1)
            $(this).parent().parent().parent().remove()
            $('form[id=add-marca]').children('input[type=hidden][cat='+categoria.index+']').remove()
            if(categoriasToAdd.length == 0) $('#no-cat-advice').show()
          })
        })
        $('input[name=categoriaNombre]').val('')
        subcategorias = []
        closeModal('#agregar-categoria-modal-back')
        ////////////////////////////////////////////////////////////////////////////////////////////
      }
    }
  })

  $('#add-subcategoria-btn').click(function () {
    addSubcategoria()
  })

  $('input[name=subcategoria-to-add]').keypress(function (e) {
    if(e.charCode == 13)
    {
      addSubcategoria()
    }
  })

  function addSubcategoria() {
    if($('input[name=subcategoria-to-add]').val() == '')
      showMsg('Ups!', ['Ingrese un nombre para la subcategoria.'])
    else if(subcategorias.indexOf($('input[name=subcategoria-to-add]').val()) > -1)
    {
      showMsg('Ups!', ['Dos subcategorias no pueden tener el mismo nombre.'])
    }
    else
    {
      $subName = $('input[name=subcategoria-to-add]').val()
      subcategorias.push($subName)
      $item = $('<div class="item">')
      $item.css({
        'border':'1px solid rgba(0,0,0,.06)',
        padding:'3px',
        'border-radius':'3px'
      })
      $span = $('<span>'+$subName+'</span>')
      $removeBtn = $('<div class="circle-btn"><i class="material-icons">remove</i></div>')
      $removeBtn.css({
        'float':'right'
      })
      $item.append($span)
      $item.append($removeBtn)
      $removeBtn.attr('value',$subName)
      $removeBtn.click(function () {
        $(this).parent().remove()
        subcategorias.splice(subcategorias.indexOf($(this).attr('value')), 1)
      })
      $('#subcategorias-to-add-container').prepend($item)
      $('input[name=subcategoria-to-add]').val('')
      $('input[name=subcategoria-to-add]').focus()
    }
  }

  $('#editar-marca').click(function () {
    if($('form[id=form-editar-marca]').children('#categorias-input').length < 1)
    {
      showMsg('Ups!', ['Debes proporcionar al menos una categoria de productos'])
    }
    else
    {
      $('form[id=form-editar-marca]').submit()
    }
  })

  $('#delete-marca-btn').click(function () {
    $('form[id=delete-marca]').submit()
  })

  $('.edit-marca').click(function () {
    var id = $(this).attr('id')
    var marca = $(this).attr('marca')
    $.ajax({
      url:"/admin/inventario/marcas/get-categories",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}",
        id:id
      }
    }).done(function(categorias){
      $('input[name=marcaToEdit]').val(id)
      $('span#marca-a-modificar').text(marca)
      $('form[id=form-editar-marca]').children('#categorias-input').remove()
      $('#categorias-subcontainer1').find('.select-btn').removeClass('selected')
      $('#categorias-subcontainer1').find('.select-btn').addClass('unselected')
      $.each(categorias, function (i, cat) {
        $('#categorias-subcontainer1').find('.header#'+cat.id).find('.select-btn').removeClass('unselected')
        $('#categorias-subcontainer1').find('.header#'+cat.id).find('.select-btn').addClass('selected')
        $('form#form-editar-marca').append($('<input type="hidden" name="categorias[]" id="categorias-input" value="'+cat.id+'">'))
      })
      showModal('#editar-marca-modal-back')
    })

  })

  $('.restore-marca').click(function () {
    $('input[type=hidden][name=marcaToRestore]').val($(this).attr('id'))
    $('form[id=restore-marca]').submit()
  })

  $('.delete-marca').click(function () {
    showMsgDialog('Confirmar Acción', [
      '¿Desea descontinuar la marca?',
      'Todos los productos de la marca no podrán ser vendidos ni administrados en inventario hasta que los restaure.'
    ], '#msg-dialog')
    $('input[type=hidden][name=marcaId]').val($(this).attr('id'))
  })

  $('.list-item>.img-container>.shadow').hover(
    function () {
      var $options = $(this).parent().children('.options')
      $options.css('bottom','0')
      $options.children('i').css('opacity','1')
      $options.children('i.edit').css('margin-right','0px')
      $options.children('i.delete').css('margin-left','0px')
    },
    function () {
      if($('.list-item>.img-container>.options:hover').length < 1){
        var $options = $(this).parent().children('.options')
        $options.css('bottom','-40px')
        $options.children('i').css('opacity','.2')
        $options.children('i.edit').css('margin-right','10px')
        $options.children('i.delete').css('margin-left','10px')
      }
    }
  )

  $('.list-item>.img-container>.options').mouseleave(function () {
    if($('.list-item>.img-container>.shadow:hover').length < 1){
      var $options = $(this)
      $options.css('bottom','-40px')
      $options.children('i').css('opacity','.2')
      $options.children('i.edit').css('margin-right','10px')
      $options.children('i.delete').css('margin-left','10px')
    }
  })

  $('.side-menu>.body>.item').click(function () {
    $.ajax({
      url:"/admin/inventario/marcas/get",
      type:"post",
      dataType:"json",
      data:{
        _token:"{{csrf_token()}}"
      }
    }).done(function(marcas){
      $('#productos-container').children().remove()
      $('select[name=marcaForProduct]').children('.marca').remove()
      $('select[name=marcasFilter]').children('.marca').remove()
      $('select[name=catForProduct]').children('.cat').remove()
      $('select[name=subForProduct]').children('.sub').remove()
      $('select[name=catFilter]').children('.cat').remove()
      $('select[name=subFilter]').children('.sub').remove()
      $.each(marcas, function (i, marca) {
        $('select[name=marcaForProduct]').append($('<option class="marca" value="'+marca.id+'">'+marca.nombre+'</option>'))
        $('select[name=marcasFilter]').append($('<option class="marca" value="'+marca.id+'">'+marca.nombre+'</option>'))
      })
    })
    var $toggle = $(this)
    $('.side-menu>.body>.item').removeClass('item-active')
    $(this).addClass('item-active')
    $.each($('div.main-card'), function (i,e) {
      if($(e).attr('for') == $toggle.attr('for'))
      {
        $(e).delay(400).slideDown(400,function () {
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
        })
      }
      else $(e).slideUp(300)
    })
  })

  $('.img-file-selector').children('input[type=file]').change(function () {
    if($(this)[0].files.length > 0){
      $(this).parent().children('p').text($(this)[0].files[0].name);
    }
    else{
      $(this).parent().children('p').text('Haz click o arrastra un archivo...');
    }
  });

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

  $('.modal-black-card').find('#close-btn').click(function () {
    $parent = $(this).parent().parent();
    $parent.css('-webkit-transform','scale(.7)');
    $parent.fadeOut(400, function () {
      $parent.parent().fadeOut();
    });
  });

  $('.close-btn').click(function () {
    var $parent = $(this).parent().parent();
    $parent.css('-webkit-transform','scale(.7)');
    $parent.fadeOut(200, function () {
      $parent.parent().fadeOut();
    });
  })

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

  function showMsgDialog(title, body, id) {
    $(id).show(0);
    $(id+'>.msg-card').css('opacity',1);
    $(id+'>.msg-card').css('margin-top','100px');
    $(id+'>.msg-card').css('-webkit-transform','scale(1)');
    $(id+'>.msg-card>.header>h3').text(title);
    $(id+'>.msg-card>.body').children().remove();
    $.each(body, function (i, paragraph) {
      $(id+'>.msg-card>.body').append('<p>'+paragraph);
    });
  }

  $('.msg-footer>button').click(function () {
    $('.msg-card').css('-webkit-transform','scale(.7)');
    $('.msg-card').parent().fadeOut(400, function () {
      $(this).hide();
    });
  });

  @if(session('options'))
  showMsg("{{session('options')['msg']['title']}}",["{{session('options')['msg']['body']}}"]);
  @endif

  @if(session('options') and isset(session('options')['activeItem']))
    $('.side-menu>.body>.item').removeClass('item-active')
    $('.side-menu>.body').children('.item[for='+'{{session("options")["activeItem"]}}'+']').addClass('item-active')
    $('div.main-card').hide();
    $('div.main-card[for='+'{{session("options")["activeItem"]}}'+']').show();
  @endif

  @if(session('options') and isset(session('options')['subcategoria']) and $subcategoria = session('options')['subcategoria'])
  $('select[name=marcasFilter]').children().attr('selected',false)
  $('select[name=marcasFilter]').children('option[value='+'{{$subcategoria->categoria->marca->id}}'+']').attr('selected',true)
  @foreach($subcategoria->categoria->marca->categorias as $cat)
  $('select[name=catFilter]').append($('<option class="cat" value="'+'{{$cat->id}}'+'">'+'{{$cat->nombre}}'+'</option>'))
  @endforeach
  $('select[name=catFilter]').children().attr('selected',false)
  $('select[name=catFilter]').children('option[value='+'{{$subcategoria->categoria->id}}'+']').attr('selected',true)
  @foreach($subcategoria->categoria->subcategorias as $sub)
  $('select[name=subFilter]').append($('<option class="sub" value="'+'{{$sub->id}}'+'">'+'{{$sub->nombre}}'+'</option>'))
  @endforeach
  $('select[name=subFilter]').children().attr('selected',false)
  $('select[name=subFilter]').children('option[value='+'{{$subcategoria->id}}'+']').attr('selected',true)
  showProductsTable('{{$subcategoria->id}}')
  @endif

})
</script>
@endsection
