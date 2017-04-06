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
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 2px;
    text-align: center;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
    margin-bottom: 10px;
  }
  .side-menu>.header{
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .side-menu>.body>.item{
    width: 100%;
    float: left;
    padding: 3px;
    color: #ddd;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, .11);
    -webkit-transition: background-color .4s, color .4s, text-shadow .6s;
  }
  .side-menu>.body>.item-active{
    border-left: 2px solid #fff;
    color: #fff;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
  }
  .side-menu>.body>.item:hover{
    background-color: rgba(255, 255, 255, .05);
  }
  .side-menu>.body>.last-item{
    border-bottom: none;
  }
  .main-card{
    width: 100%;
    position: relative;
    float: left;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }
  .main-card>.header{
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    font-family: 'Lobster Two';
    text-align: center;
    text-shadow: 0 0 15px rgba(0, 0, 0, 0.9), 0 0 1px rgba(0, 0, 0, 0.9);
    padding: 10px;
  }
  .main-card>.body{
    background-color: rgba(0, 0, 0, 0.5);
    color: #777;
  }
  .list-container{
    border-radius: 3px;
    background-color: rgba(255, 255, 255, 0.1);
    margin-bottom: 5px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    float: left;
    position: relative;
  }
  .list-container>p{
    color:#fff;
    margin-top: 5px;
  }
  .list-container>h5{
    color:#fff;
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
    background-color: transparent;
    border: 1px solid #fff;
    border-radius: 3px;
    color: #ddd;
    font-size: 18px;
    padding: 4px 18px 7px 18px;
    -webkit-transition: background-color .4s, color .4s, text-shadow .6s;
  }
  .btn-center{
    display: block;
    margin: auto;
  }
  .btn1:hover{
    background-color: rgba(0, 0, 0, .2);
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
    padding: 0;
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
    border: 1px solid rgba(255, 255, 255, .1);
  }
  .square-btn{
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid #fff;
    width: 25px;
    cursor: pointer;
    height: 25px;
  }
  .square-btn:hover{
    background-color: rgba(255, 255, 255, 0.1);
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
    background: #f43;
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
    background: linear-gradient(to bottom, #e42, #d31);
    border: 1px solid rgba(0, 0, 0, 0.5);
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
    color: #e43;
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
    background-color: rgba(0, 0, 0, 0.8);
    float: left;
    color: #ddd;
    text-align: center;
  }
  .marca-item>.info{
    margin-bottom: 10px;
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
    background-color: #f53;
    border: 1px solid #f31;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
    height: 30px;
  }
  .textbox2-group-container>.icon>i, .textbox2-group-container>.icon-red>i{
    color: #fff;
    position: absolute;
    top: 5px;
    left: 9px;
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
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
    cursor: pointer;
    color: #fff;
    top: 4px;
    right: 4px;
    z-index: 1;
  }
  .producto-item>.img-container>i:hover{
    color: #e43;
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
    background-color: rgba(0, 0, 0, 0.7);
    width: 100%;
    position: relative;
    float: left;
    color: #fff;
    font-weight: 600;
    padding-bottom: 15px;
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

<div class="modal-back" id="editar-producto-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Editar producto</h4>
    </div>
    <div class="body">
      <form action="/admin/inventario/producto/editar" method="post" enctype="multipart/form-data" id="form-editar-producto">
        <input type="hidden" name="productoToEdit" value="">
        <input type="hidden" name="nuevoSeVendeAlPublico" value="0">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-xs-12">
          <div class="col-xs-12 alert alert-warning">
            <p>Complete solamente lo que quiere cambiar</p>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="alert alert-info">
            <p>Producto a modificar: <span id="producto-a-modificar"></span></p>
            <p>De la marca: <span id="marca-producto-a-modificar"></span></p>
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
        <div class="col-xs-12" id="precio-venta-container">
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
          <input type="text" name="contenido" value="" class="number col-xs-12 col-sm-8 col-md-6 col-lg-8 textbox2-auto">
          <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4" style="padding-left:10px;padding-right:0">
            <select class="textbox2-auto" name="nuevaUnidadMedida" style="width:100%;height:34px">
              <option value="gr">gramos</option>
              <option value="ml">mililitros</option>
            </select>
          </div>
        </div>
      </form>
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
    <div class="header">
      <h4>Gestión de marcas</h4>
    </div>
    <div class="body col-xs-12" style="padding:0">
      <div class="col-xs-12 col-md-4" style="padding:15px">
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
      <div class="col-xs-12 col-md-8" style="padding: 15px;">
        <div class="sub-card">
          <h4 style="text-align:center;color:#fff">Agregar nueva marca</h4>
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

  <div class="main-card" for="categorias-card" style="display:none">
    <div class="header">
      <h4>Gestión de categorias</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-4" style="padding:15px">
        <div class="list-container" style="padding:5px" id="marcas-container">
          <h5 style="text-align:center;padding-bottom:5px;text-shadow:0 0 3px rgba(0,0,0,.8),0 0 15px rgba(0,0,0,1)">Seleccione una categoria para modificar</h5>
          @if(\App\Marca::count() == 0)
          <p style="padding:0 10px 0 10px">No se marcas ni categorias registradas en el sistema.</p>
          @else
          @foreach(\App\Marca::get() as $marca)
          <div class="marca-item" id="{{$marca->id}}">
            <div class="info">
              <div class="img-container">
                <img src="{{asset('storage/'.$marca->logo)}}" alt="">
              </div>
              <span>{{$marca->nombre}}</span>
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
      <div class="col-xs-12 col-md-8" style="padding:15px">
        <div class="list-container col-xs-12" style="padding-bottom:15px" id="manage-cat-panel">
          <div class="col-xs-12">
            <h4 style="text-align:center;color:#fff">Modificar categoria</h4>
          </div>
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

  <div class="main-card" for="productos-card" style="display:none">
    <div class="header">
      <h4>Gestión de productos</h4>
    </div>
    <div class="body">
      <div class="col-xs-12 col-md-7" style="padding:15px">
        <div class="list-container">
          <div class="header">
            <div class="col-xs-12">
              <h5>Lista de productos</h5>
            </div>
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
          <div class="body col-xs-12" style="padding:0" id="productos-container">

          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-5" style="padding:15px">
        <div class="sub-card">
          <h4 style="color:#fff; text-align:center">Nuevo producto</h4>
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
              <div class="switch-container switch-center" id="venta-publico" active="0" style="background-color:rgba(0,0,0,.6)">
                <span style="color:#eee;padding-left:2px">Venta al público</span>
                <div class="switch-bar switch-center">
                  <div class="switch-btn inactive"></div>
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
            <button id="agregar-producto-btn" class="btn2" style="margin:auto;display:block">Agregar</button>
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

if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
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

$(window).resize(function () {
    if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
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
})

$(document).ready(function () {

  $('#agregar-producto-btn').click(function () {
    if ($('select[name=catForProduct]').val() == '' || $('select[name=marcaForProduct]').val() == ''
    || $('select[name=subForProduct]').val() == '' || $('input[name=productoCover]').val() == ''
    || $('input[name=nombreProducto]').val() == '' || $('input[name=precioCompra]').val() == ''
    || ($('input[name=seVendeAlPublico]').val() == '1' && $('input[name=precioVenta]').val() == '')
    || $('textarea[name=descripcion]').val() == '' || $('select[name=uMedida]').val() == ''
    || $('input[name=contenido]').val() == '') {
        showMsg('Ups!',['Complete toda la información que se requiere.'])
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
      $('#precio-venta-container').slideUp(300)
    }
    else {
      $('input[name=nuevoSeVendeAlPublico]').val('1')
      $('#precio-venta-container').slideDown(300)
    }
  })

  $('input.money').keypress(function (e) {
    if((!$.isNumeric(e.key) && e.key != '.')
    || ($(this).val().indexOf('.') > -1 && e.key == '.')
    || ($(this).val().indexOf('.') > -1 && $(this).val().indexOf('.') + 2 == $(this).val().length -1))
      e.preventDefault();
    if(e.key == '.' && $(this).val().length == 0)
      $(this).val('0')
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
            $('input[type=hidden][name=productoToEdit]').val(producto.id)
            $('#producto-a-modificar').text(producto.nombre)
            $('#marca-producto-a-modificar').text(producto.subcategoria.categoria.marca.nombre)
            showModal('#editar-producto-modal-back')
          })
        })
        $('.detalles-producto-toggle').click(function () {
          ////////////////////// mostrar modal y estadisticas
        })
      })
    }
    else {
      $('#productos-container').children().remove()
    }
  })

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
            'background-color':'rgba(255,255,255,.5)',
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
            color:'red',
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
        if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
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
          'background-color':'rgba(255,255,255,.5)',
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
          color:'red',
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
          if($('.main-container').height() + $('.footer').outerHeight() + 150 <= $(window).height()){
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

})
</script>
@endsection
