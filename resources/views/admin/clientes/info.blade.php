@extends('layouts.master')

@section('title')
Información cliente
@endsection

@section('css')
<style>
  html,body{
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #333;
  }
  .nav-bar{
    border-bottom-color: rgba(255, 255, 255, 0.2);
  }
  .footer{
    background: rgba(0, 0, 0, 0.5);
    box-shadow: none;
  }
  .main-container{
    float: left;
    color: #bbb;
    height: auto;
    width: 100%;
    margin-top: 100px;
    margin-bottom: 50px;
  }
  h3.main-title{
    font-family: 'Lobster Two';
    color: #ccc;
    float: left;
  }
  #summary-container{
    background-color: rgba(0, 0, 0, 0.7);
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
    height: 100%;
    padding: 0;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    float: left;
  }
  .white-text{
    color: #eee;
  }
  .title{
    color: #eee;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);
    font-family: 'Lobster Two';
    width: 100%;
  }
  .icon-btn{
    text-decoration: none;
    color: #def;
    cursor: pointer;
    display: table;
    padding: 4px 5px 0 5px;
    border-radius: 2px;
    margin-bottom: 10px;
    margin-left: 10px;
    float: right;
    -webkit-transition: color .4s, box-shadow .4s, text-shadow .6s, margin-right .6s, background-color .7s;
  }
  .icon-btn>i{
    font-size: 18px;
    padding-top: 2px;
  }
  .icon-btn:active{
    color: #ddd;
  }
  .icon-btn:visited{
    color: #ddd;
  }
  .icon-btn:hover{
    color: #fff;
    text-decoration: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 1);
    text-shadow: 0 0 3px rgba(255, 255, 255, 0.5);
  }
  .icon-square{
    background-color: dodgerblue;
  }
  .icon-btn>span{
    padding: 1px 5px 5px 5px;
    float: left;
  }
  #back-btn{
    float: right;
    background-color: rgba(255, 255, 255, 0.5);
    border: 1px solid transparent;
    margin-right: -10px;
  }
  .title-card{
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    padding: 4px;
  }
  .subcontainer{
    background-color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, .3);
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
    border-radius: 3px;
    display: table;
    width: 100%;
    overflow: auto;
    max-height: 700px;
  }
  #options-container{
    padding-top: 11px;
  }

  #modificar-credito{
    margin-bottom: 10px;
  }
  .switch-container{
    background-color: rgba(255, 255, 255, 0.1);
  }
  #citas-container{
  }
  .subcontainer::-webkit-scrollbar{
    background-color: rgba(255, 255, 255, 0.02);
    height: 9px;
  }
  .subcontainer::-webkit-scrollbar-thumb{
    background-color: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, .6);
  }
  table{
    width: 100%;
  }
  .white-back>tr>th{
    background-color: rgba(255, 255, 255, 0.05);
    font-weight: 100;
    text-align: center;
    padding-top: 8px;
    padding-bottom: 8px;
    color: #445;
  }
  .white-back>tr>td{
    padding-top: 5px;
    padding-bottom: 5px;
    color: #ddd;
    color: #335;
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
    background-color: #111;
    border: 1px solid #555;
    border-radius: 3px;
    padding: 0;
    display: none;
    height: 100%;
    overflow: hidden;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5),0 0 10px rgba(0, 0, 0, 0.7);
    -webkit-transform: scale(.7);
    -webkit-transition: -webkit-transform .4s;
  }
  .modal-black-card>.header,.modal-black-card>.modal-footer{
    background-color: rgba(255, 255, 255, .05);
    margin: 0;
    padding: 10px;
  }
  .modal-black-card>.header>.close-btn{
    float: right;
    cursor: pointer;
    font-size: 18px;
    color:#aaa;
    border-radius: 3px;
  }
  .modal-black-card>.header>.close-btn:hover{
    color: #fff;
    background-color: rgba(255, 255, 255, .08);
  }
  .modal-black-card>.modal-footer{
    border-top: none;
    margin-bottom: 0;
    position: absolute;
    width: 100%;
    bottom: 0;
  }
  .modal-black-card>.modal-footer>button{
    border: 1px solid #111;
    color: #eee;
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
    background-color: rgba(255, 255, 255, .09);
    border: 1px solid #ccc;
  }
  .modal-black-card>.header>h4{
    margin: 0;
    color: goldenrod;
    font-family: 'Lobster Two';
  }
  .modal-black-card>.body{
    position: relative;
    padding: 10px;
    overflow: auto;
    color:#ddd;
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
  .success-btn{
    background: linear-gradient(to bottom, #3ba, #198);
  }
  .warning-btn{
    background: linear-gradient(to bottom, #cb1, #a80);
  }
  .cancel-btn{
    background: linear-gradient(to bottom, #934, #623);
  }
  .info-btn{
    background: linear-gradient(to bottom, #1ad, #09b);
  }
  .blue-btn{
    background: linear-gradient(to bottom, #19e, #07c);
  }
  .black-btn{
    background: linear-gradient(to bottom, rgba(255, 255, 255, .2), rgba(255, 255, 255, .05));
  }
  .mybtn{
    cursor: pointer;
    text-align: center;
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #eee;
    border-radius: 3px;
    -webkit-transition: background-color .4s, border .5s;
    padding: 1px 5px 1px 5px;
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
  }
  .img-container{
    overflow: hidden;
    width: 10vh;
    height: 10vh;
    border-radius: 100%;
    margin: auto;
    display: block;
    margin-bottom: 10px;
    -webkit-transition: -webkit-transform .5s;
  }
  .img-container>img{
    width: 100%;
  }
  .img-container2{
    overflow: hidden;
    width: 43px;
    height: 43px;
    float: left;
    border-radius: 5px;
  }
  .img-container2>img{
    width: 100%;
  }
  .estilista-info{
    position: relative;
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    background: rgba(255, 255, 255, 0.05);
    text-align: center;
  }
  .result{
    background: rgba(255, 255, 255, .05);
    border-radius: 3px;
    padding: 1.5px 3px 3px 3px;
    border: 1px solid rgba(255, 255, 255, .05);
    border-bottom: 1px solid rgba(255, 255, 255, .01);
    color: goldenrod;
  }
  p.topic{
    margin-top: 10px;
    margin-bottom: 0;
  }
  .servicio-item{
    border-radius: 3px;
    border: 1px dashed rgba(255, 255, 255, 0.1);
    display: table;
    width: 100%;
  }
  .servicio-item:hover{
    border-color: rgba(255, 255, 255, 0.2);
  }
  .servicio-item>.info{
    float: left;
    margin-left: 10px;
  }
  .servicio-item>.info>span{
    float: left;
    width: 100%;
    font-size: 13px;
  }
  .citas-container{
    width: 100%;
    padding: 3px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    background-color: rgba(255, 255, 255, 0.03);
    display: table;
    max-height: 250px;
    overflow: auto;
  }
  .citas-container::-webkit-scrollbar{
    width:  15px;
    border-radius: 12px;
  }
  .citas-container::-webkit-scrollbar-thumb{
    background: #222;
    border: 4px solid #111;
    border-radius: 12px;
  }
  table.table-center{
    text-align: center;
  }
  .btn2{
    font-size: 12px;
    cursor: pointer;
    border-radius: 2px;
    background: linear-gradient(to bottom, #19e, #07c);
    padding:0 5px 0 5px;
    position: absolute;
    top: 0;
    right: 0;
    width: auto;
    display: table;
  }
  .btn2:hover{
    background: linear-gradient(to bottom, #2af, #19f);
  }
  #cambiar-estilista-modal, #abonar-modal-back,#pagar-modal-back,#cancelar-cita-modal-back, #update-date-modal-back{
    z-index: 3;
  }
  .estilista-item>.estilista-card>.img-container{
    position: relative;
  }
  .estilista-item>.estilista-card>.img-container>.shadow{
    position: absolute;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
    height: 100%;
    width: 100%;
    display: none;
  }
  .estilista-item>.estilista-card>.img-container>.shadow>i{
    position: relative;
    background-color: rgba(0, 0, 0, 0.5);
    margin-top: 30%;
    height: 40%;
    margin-left: 30%;
    width: 40%;
    text-align: center;
    border-radius: 100%;
  }
  .estilista-item>.estilista-card:hover .img-container {
    -webkit-transform: scale(1.2);
  }
  .estilista-item>.estilista-card>.img-container>img {
    overflow: hidden;
  }
  .estilista-item>.estilista-card{
    cursor: pointer;
  }
  .text-box1{
    float: left;
    border: 1px solid rgba(255, 255, 255, .8);
    border-radius: 2px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
    background-color: transparent;
    padding: 4px 8px 4px 8px;
  }
  .text-box1:hover{
    background-color: rgba(255, 255, 255, 0.1);
  }
  .text-box1:focus{
    background-color: rgba(255, 255, 255, 0.2);
  }
  .group-input-container{
    width: 100%;
    display: table;
  }
  .group-input-container>input{
    display: table-cell;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    width: 100%;
  }
  .group-input{
    background-color: rgba(255,255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, .8);
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 0px 3px 3px 3px;
    width:32px;
    position: relative;
    display: table-cell;
  }
  .group-input>i{
    position: absolute;
    top: 6px;
    left: 6px;
    font-size: 18px;
    font-weight: 100;
  }
  #liquidada-advice{
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 3px;
    color: #d24;
    font-weight: 600;
    float: left;
    margin-top: 10px;
  }
  .confirmada{
    background-color: rgba(10, 80, 0, 0.2);
  }
  .en-curso{
    background-color: rgba(10, 0, 80, 0.2);
  }
  .cancelada{
    background-color: rgba(80, 0, 0, 0.2);
  }
  .finalizada{
    background-color: rgba(160, 160, 80, 0.2);
  }
  .color-box{
    margin-top: 3px;
    margin-right: 5px;
    float: left;
    width: 15px;
    height: 15px;
    border: 1px solid rgba(255, 255, 255, .6);
  }
  .acotacion-container{
    margin-bottom: 10px;
    padding: 0;
  }
  table{
    width: 100%
  }
  .switch-center{
    float: none;
    display: table;
    margin: auto;
    width: auto;
  }
  #productos-compra-tbody>tr>td{
    padding: 4px;
  }
  #compra-liquidada-msg{
    border-radius: 3px;
    font-weight: 700;
    background-color: #eee;
    padding: 4px;
    color: #e76;
  }
  .textbox3{
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(255, 255, 255, 0.05);
    padding-left: 5px;
    color: #ccc;
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
  #abonar-compra-modal-back, #liquidar-compra-modal-back{
    z-index: 3;
  }
  .btn-blue{
    background-color: dodgerblue;
    color: #eee;
  }
  .btn-blue:hover{
    background-color: #19f;
    color: #fff;
  }
</style>
@endsection

@section('body')
<div class="modal-back" id="liquidar-compra-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Liquidar compra</h4>
    </div>
    <div class="body">
      <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="text-align:center">Liquidar deuda de: </label>
      <div class="col-xs-12">
        <p class="col-xs-12 col-md-6 col-md-offset-3" style="text-align:center">$<span id="por-liquidar-compra"></span></p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="liquidar-compra-btn" compra=""><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn close-abonar-compra-btn" id="close-btn"><i class="material-icons">block</i>Cancelar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="abonar-compra-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Abonar a compra</h4>
    </div>
    <div class="body">
      <label for="" class="col-xs-12 col-md-6 col-md-offset-3" style="text-align:center">Cantidad a abonar: </label>
      <div class="col-xs-12">
        <input type="text" name="cantidadAbonarCompra" value="" class="textbox3 money col-xs-12 col-md-6 col-md-offset-3">
      </div>
      <div class="col-xs-12">
        <p class="col-xs-12 col-md-6 col-md-offset-3" style="text-align:center">Restante por pagar: <span id="por-pagar-compra"></span></p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="abonar-compra-btn" compra=""><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn close-abonar-compra-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="detalles-compra-modal-back">
  <div class="modal-black-card col-xs-12 col-md-6 col-md-offset-3">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Detalles de compra</h4>
    </div>
    <div class="body">
      <div class="col-xs-12">
        <p>Fecha: <span id="fecha-compra"></span></p>
        <p>Hora: <span id="hora-compra"></span></p>
        <p>Pagado: <span id="pagado-compra"></span></p>
        <p>Monto: <span id="monto-compra"></span></p>
        <p>Restante: <span id="restante-compra"></span></p>
        <hr>
        <h5>Productos</h5>
        <div class="subcontainer">
          <table>
            <thead class="white-back">
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Código</th>
              <th>Precio</th>
              <th>Cantidad</th>
            </thead>
            <tbody id="productos-compra-tbody" style="text-align:center" class="white-back">

            </tbody>
          </table>
        </div>
        <hr>
        <h5>Pagos</h5>
        <div class="subcontainer">
          <table>
            <thead class="white-back">
              <th>Fecha</th>
              <th>Hora</th>
              <th>Cantidad</th>
            </thead>
            <tbody id="pagos-compra-tbody" style="text-align:center" class="white-back">

            </tbody>
          </table>
          <p id="compra-no-pagos-msg" style="padding:5px;text-align:center;margin:0;color:#333">No se han realizado pagos.</p>
        </div>
        <div class="" style="margin-top:15px">
          <span id="compra-liquidada-msg"></span>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="liquidar-compra-toggle" compra=""><i class="material-icons">attach_money</i>Liquidar</button>
      <button type="button" name="button" class="success-btn" id="abonar-compra-toggle" compra=""><i class="material-icons">attach_money</i>Abonar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="cancelar-cita-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Cancelar cita</h4>
    </div>
    <div class="body">
      <input type="hidden" name="cita-a-pagar" id="cita-a-pagar" value="">
      <div class="col-xs-12">
        <p style="text-align:center;margin-top:15px">¿Confirmar cancelación de cita?</p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="cancelar-cita-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="update-date-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Modificar fecha y hora de cita</h4>
    </div>
    <div class="body">
      <input type="hidden" name="cita-a-pagar" id="cita-a-pagar" value="">
      <div class="col-xs-12">
        <div class="col-xs-12" style="margin-top:10px;margin-bottom:5px">
          <div class="switch-container switch-center" id="modificar-fecha-switcher" active="0">
            <span>Modificar fecha</span>
            <div class="switch-bar">
              <div class="switch-btn inactive"></div>
            </div>
          </div>
        </div>
        <input type="date" name="date-to-change" value="" class="text-box1" style="width:100%;margin-top:10px;margin-bottom:10px;display:none">
        <div class="col-xs-12" style="margin-top:10px;margin-bottom:5px">
          <div class="switch-container switch-center" id="modificar-hora-switcher" active="0">
            <span>Modificar hora</span>
            <div class="switch-bar">
              <div class="switch-btn inactive"></div>
            </div>
          </div>
        </div>
        <input type="time" name="time-to-change" value="" class="text-box1" style="width:100%;margin-top:10px;margin-bottom:10px;display:none">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="update-date-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="pagar-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Liquidar cita</h4>
    </div>
    <div class="body">
      <input type="hidden" name="cita-a-pagar" id="cita-a-pagar" value="">
      <div class="col-xs-12">
        <p>¿Confirmar liquidacion de servicio? $<span id="costo-liquidacion"></span></p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="pagar-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="abonar-modal-back">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Registrar nuevo pago</h4>
    </div>
    <div class="body">
      <input type="hidden" name="cita-a-pagar" id="cita-a-pagar" value="">
      <div class="col-xs-12">
        <p>Ingrese la cantidad:</p>
        <div class="group-input-container">
          <div class="group-input">
            <i class="material-icons">attach_money</i>
          </div>
          <input type="text" name="cantidad-a-pagar" value="" class="text-box1" id="cantidad-a-abonar">
        </div>
        <p style="margin-top:5px">de $<span id="total-modal-pago"></span> por pagar</p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="abonar-btn"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="cambiar-estilista-modal">
  <div class="modal-black-card col-xs-12 col-md-4 col-md-offset-4">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Seleccione un estilista</h4>
    </div>
    <div class="body">
      <input type="hidden" name="estilista" value="">
      @foreach(\App\Rol::where('nombre','estilista')->first()->empleados as $estilista)
      <div class="col-xs-6 col-md-4 estilista-item" style="padding:15px">
        <div class="estilista-card">
          <div class="img-container">
            <div class="shadow" id="{{$estilista->id}}">
              <i class="material-icons">check</i>
            </div>
            <img src="{{asset('storage/'.$estilista->fotografia)}}" alt="">
          </div>
          <div class="info" style="text-align:center">
            {{$estilista->nombre." ".$estilista->apellido}}
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="success-btn" id="cambiar-estilista-selected"><i class="material-icons">check</i>Aceptar</button>
      <button type="button" name="button" class="cancel-btn" id="close-btn"><i class="material-icons">block</i>Cerrar</button>
    </div>
  </div>
</div>

<div class="modal-back" id="appointment-details-modal">
  <div class="modal-black-card col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
    <div class="header">
      <i class="close-btn material-icons">close</i>
      <h4>Detalles de la cita</h4>
    </div>
    <div class="body">
      <input type="hidden" name="cita-en-cuestion" value="">
      <div class="col-xs-12 col-md-6">
        <p>Cita para <span class="result" id="nombre-cliente">{{$cliente->nombre}}</span></p>
        <p>Atiende</p>
        <div class="estilista-info">
          <div class="btn2 cambiar-estilista-btn">Cambiar</div>
          <div class="img-container">
            <img src="" alt="" id="foto-estilista">
          </div>
          <span id="nombre-estilista">xxxx</span>
        </div>
        <p style="margin-top:10px;margin-bottom:0">Fecha</p>
        <span class="result" id="fecha">xxxx</span>
        <p style="margin-top:10px;margin-bottom:0">Hora</p>
        <span class="result" id="hora">xxxx</span>
        <div class="col-xs-12" style="padding: 0;margin-top:15px;margin-bottom:10px">
          <span class="result" id="tiempo-restante">xxxx</span>
        </div>
        <p style="margin-top:10px;margin-bottom:0">Estado</p>
        <span class="result" id="estado">xxxx</span>
      </div>
      <div class="col-xs-12 col-md-6">
        <h5>Servicios o paquetes (<span id="servicios-count"></span>)</h5>
        <div class="citas-container" id="servicios-container">
        </div>
        <p style="margin-top:10px;margin-bottom:0">Tiempo aproximado de duración total: <span class="result" id="tiempo-total">10 horas</span></p>
        <p style="margin-top:10px;margin-bottom:0">Horario aproximado: <span class="result" id="horario-aprox">10:00 a 13:00</span></p>
        <h5>Pagos</h5>
        <p style="margin-top:10px;margin-bottom:0">
          Se ha pagado <span class="result" id="pagado">xxxx</span> pesos de un total de
          <span class="result" id="total">xxxx</span> pesos.
        </p>
        <p style="margin-top:10px;margin-bottom:0">Por pagar</p>
        <span class="result" id="por-pagar">xxxx</span>
        <div class="col-xs-12" style="padding:0">
          <span id="liquidada-advice">LIQUIDADA</span>
        </div>
        <hr>
        <div class="citas-container" id="pagos-container" style="margin-top:10px">
          <table class="table-center">
            <thead>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Cantidad</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <p id="no-pagos-msg" style="margin-top:10px;margin-bottom:0">No se han realizado pagos.</p>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" name="button" class="blue-btn" id="abonar-toggle"><i class="material-icons">attach_money</i><span>Abonar</span></button>
      <button type="button" name="button" class="blue-btn" id="pagar-toggle"><i class="material-icons">attach_money</i><span>Pagar</span></button>
      <button type="button" name="button" class="blue-btn" id="start-toggle"><i class="material-icons">play_arrow</i>Comenzar</button>
      <button type="button" name="button" class="blue-btn" id="finish-toggle"><i class="material-icons">assignment_turned_in</i>Finalizar</button>
      <button type="button" name="button" class="blue-btn" id="update-date-toggle"><i class="material-icons">update</i>Cambiar fecha</button>
      <button type="button" name="button" class="cancel-btn" id="cancel-cita-toggle"><i class="material-icons">block</i>Cancelar</button>
    </div>
  </div>
</div>

<div class="main-container">

  <div class="col-xs-12">
    <h3 class="main-title">Detalles del cliente</h3>
    <a href="../" class="icon-btn" id="back-btn">
      <i class="material-icons">arrow_back</i>
      <span>Explorar todos los clientes</span>
    </a>
  </div>

  <div class="col-xs-12" id="summary-container">
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Personal</h5>
      <h4 class="white-text">{{$cliente->nombre." ".$cliente->apellido}}</h4>
      <p>Telefono:<br> <span class="white-text">{{$cliente->telefono}}</span></p>
      <p>Edad:<br> <span class="white-text">{{$cliente->edad." años (".date('d/m/Y',strtotime($cliente->fecha_nacimiento)).")"}}</span></p>
    </div>
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Historial</h5>
      <p>Fecha de registro:<br> <span class="white-text">{{date('d/m/Y', strtotime($cliente->fecha_registro))}}</span></p>
      <p>Antiguedad:<br> <span class="white-text">{{$cliente->antiguedad['tiempo']." ".$cliente->antiguedad['medida']}}</span></p>
      <p>Frecuencia este mes
        <br><span class="white-text">Compras: {{$cliente->compras()->whereMonth('fecha_hora',date('m'))->whereYear('fecha_hora',date('Y'))->count()}}</span>
        <br><span class="white-text">Citas: {{$cliente->citas()->whereMonth('fecha_hora',date('m'))->whereYear('fecha_hora',date('Y'))->count()}}</span>
      </p>
      @if($cliente->esDeudor)
      <p>Tiene deudas:<br><span style="color:#f36">Si</span></p>
      @else
      <p>Tiene deudas:<br><span style="color:#5f6">No</span></p>
      @endif
    </div>
    <div class="col-xs-12 col-md-3">
      <h5 class="title-card">Cuenta</h5>
      @if($cliente->cuenta)
      <p>Cuenta web: <br><span>Si</span></p>
      <p>Email: <br><span class="white-text">{{$cliente->cuenta->email}}</span></p>
      @else
      <p>Cuenta web: <br><span class="white-text">No</span></p>
      @endif
    </div>
    <div class="col-xs-12 col-md-3" id="options-container">
      <a href="/admin/clientes/edit/{{$cliente->id}}" class="icon-btn icon-square">
        <i class="material-icons">edit</i>
        <span>Modificar</span>
      </a>
      <a href="/admin/citas/agregar/{{$cliente->id}}" class="icon-btn icon-square">
        <i class="material-icons">date_range</i>
        <span>Agendar cita</span>
      </a>
      <a href="/admin/ventas/agregar/{{$cliente->id}}" class="icon-btn icon-square">
        <i class="material-icons">shopping_cart</i>
        <span>Nueva venta</span>
      </a>
      @if($cliente->credito)
      <div class="switch-container" id="modificar-credito" active="1">
        <span>Activar credito</span>
        <div class="switch-bar">
          <div class="switch-btn active"></div>
        </div>
      </div>
      @else
      <div class="switch-container" id="modificar-credito" active="0">
        <span>Activar credito</span>
        <div class="switch-bar">
          <div class="switch-btn inactive"></div>
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="container">
    <div class="col-xs-12 col-md-7">
      <h3 class="title">Citas</h3>
      <div class="col-xs-12 acotacion-container">
        <div class="col-xs-12" style="padding:0">
          <div class="color-box confirmada"></div>
          <span style="float:left">Confirmada</span>
        </div>
        <div class="col-xs-12" style="padding:0">
          <div class="color-box en-curso"></div>
          <span style="float:left">En curso</span>
        </div>
        <div class="col-xs-12" style="padding:0">
          <div class="color-box finalizada"></div>
          <span style="float:left">Finalizada</span>
        </div>
        <div class="col-xs-12" style="padding:0">
          <div class="color-box cancelada"></div>
          <span style="float:left">Cancelada</span>
        </div>
      </div>
      <div class="subcontainer" id="citas-container">
        @if($cliente->citas()->count() < 1)
        <p style="margin: 0; padding:5px;text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);color:#eee;">El cliente no ha programado ninguna cita</p>
        @else
        <table>
          <thead class="white-back">
            <th style="padding-left:5px">Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th class="hidden-xs">Monto</th>
            <th class="hidden-xs">Pagada</th>
            <th></th>
          </thead>
          <tbody style="text-align:center" id="tbody-citas" class="white-back">
            @foreach($cliente->citas as $cita)
            <tr class="@if($cita->estado == 1){{'confirmada'}}@elseif($cita->estado == 2){{'en-curso'}}@elseif($cita->estado == 4){{'finalizada'}}@elseif($cita->estado == 5){{'cancelada'}}@endif" id="cita{{$cita->id}}">
              <td style="padding-left:5px">{{date('d/m/Y',strtotime($cita->fecha_hora))}}</td>
              <td>{{date('g:i a',strtotime($cita->fecha_hora))}}</td>
              <td>{{$estados[$cita->estado]}}</td>
              <td class="hidden-xs">${{$cita->monto}}</td>
              @if($cita->estado == 5)
                <td class="hidden-xs" id="table-cita-pagada">-</td>
              @else
                @if($cita->pagada)
                <td class="hidden-xs" id="table-cita-pagada">Si</td>
                @else
                <td class="hidden-xs" id="table-cita-pagada">No</td>
                @endif
              @endif
              <td style="padding-right:5px"><div class="btn btn-blue btn-xs details-toggle" style="width:100%" id="{{$cita->id}}">Detalles</div></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>

    <div class="col-xs-12 col-md-5">
      <h3 class="title">Compras</h3>
      <div class="subcontainer">
        @if($cliente->compras()->count() < 1)
        <p style="margin: 0; padding:5px;text-shadow: 0 0 2px rgba(0, 0, 0, 0.7), 0 0 10px rgba(0, 0, 0, 1);color:#eee;">El cliente no ha realizado ninguna compra</p>
        @else
        <table>
          <thead class="white-back">
            <th>Fecha</th>
            <th>Hora</th>
            <th>Monto</th>
            <th>Pagada</th>
            <th></th>
          </thead>
          <tbody style="text-align:center" class="white-back">
            @foreach($cliente->compras()->orderBy('fecha_hora','desc')->get() as $compra)
            <tr>
              <td>{{date('d/m/Y',strtotime($compra->fecha_hora))}}</td>
              <td>{{date('g:i a',strtotime($compra->fecha_hora))}}</td>
              <td>${{$compra->monto()}}</td>
              @if($compra->pagos()->sum('cantidad') < $compra->monto())
              <td>No</td>
              @else
              <td>Si</td>
              @endif
              <td>
                <div class="btn btn-xs detalles-venta-toggle btn-blue" id="{{$compra->id}}">Detalles</div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
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

  $(document).ready(function () {

    $('#liquidar-compra-btn').click(function () {
      var id = $(this).attr('compra')
      $.ajax({
        url:"/admin/compras/liquidar",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(response){
        if(!response.result) showMsg('ups!',['Ha ocurrido un error.'])
        else
        {
          showMsg('Ok!',['Venta liquidada con exito.'])
          $tr = $('<tr>')
          $tr.append($('<td>'+response.pago.fecha+'</td>'))
          $tr.append($('<td>'+response.pago.hora+'</td>'))
          $tr.append($('<td>$'+parseFloat(response.pago.cantidad).toFixed(2)+'</td>'))
          $('#pagos-compra-tbody').append($tr)
          $('#pagado-compra').text("$"+response.compra.pagado);
          $('#por-liquidar-compra').text(parseFloat(response.compra.monto - response.compra.pagado))
          $('#compra-no-pagos-msg').hide()
          $('#liquidar-compra-toggle').hide()
          $('#abonar-compra-toggle').hide()
          $('#compra-liquidada-msg').text('LIQUIDADA')
          closeModal('#liquidar-compra-modal-back')
        }
      })
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

    $('.close-abonar-compra-btn').click(function () {
      $('input[name=cantidadAbonarCompra]').val('')
    })

    $('#abonar-compra-btn').click(function () {
      if($('input[name=cantidadAbonarCompra]').val() == '' || $('input[name=cantidadAbonarCompra]').val() < '1')
      {
        showMsg('Ups!',['Proporcione una cantidad a abonar mayor a 0'])
      }
      else {
        var id = $(this).attr('compra')
        $.ajax({
          url:"/admin/compras/abonar",
          type:"post",
          dataType:"json",
          data:{
            _token:"{{csrf_token()}}",
            id: id,
            cantidad: $('input[name=cantidadAbonarCompra]').val()
          }
        }).done(function(response){
          if(response.result == '0') showMsg('Ups!',['Ha ocurrido un error. Intentelo de nuevo.'])
          else if(response.result == '1')
          {
            showMsg('Ups!',['La cantidad ingresada es mayor a la cantidad faltante por pagar.'])
          }
          else {
            $tr = $('<tr>')
            $tr.append($('<td>'+response.pago.fecha+'</td>'))
            $tr.append($('<td>'+response.pago.hora+'</td>'))
            $tr.append($('<td>$'+parseFloat(response.pago.cantidad).toFixed(2)+'</td>'))
            $('#pagos-compra-tbody').append($tr)
            $('#pagado-compra').text("$"+response.compra.pagado);
            $('#por-liquidar-compra').text(parseFloat(response.compra.monto - response.compra.pagado))
            $('#compra-no-pagos-msg').hide()
            if(response.compra.pagado < response.compra.monto)
            {
              $('#abonar-compra-toggle').show()
              $('#abonar-compra-toggle').attr('compra', response.compra.id)
              $('#compra-liquidada-msg').text('NO LIQUIDADA')
            }
            else {
              $('#abonar-compra-toggle').hide()
              $('#abonar-compra-toggle').attr('compra','')
              $('#compra-liquidada-msg').text('LIQUIDADA')
            }
            closeModal('#abonar-compra-modal-back')
          }
        })
      }
    })

    $('#abonar-compra-toggle').click(function () {
      $('#abonar-compra-btn').attr('compra',$(this).attr('compra'))
      showModal('#abonar-compra-modal-back', true)
    })

    $('#liquidar-compra-toggle').click(function () {
      $('#liquidar-compra-btn').attr('compra',$(this).attr('compra'))
      showModal('#liquidar-compra-modal-back', true)
    })

    $('.detalles-venta-toggle').click(function () {
      var id = $(this).attr('id')
      $.ajax({
        url:"/admin/compras/get-by-id",
        type:"post",
        dataType:"json",
        data:{
          _token:"{{csrf_token()}}",
          id: id
        }
      }).done(function(compra){
        $('#fecha-compra').text(compra.fecha);
        $('#hora-compra').text(compra.hora);
        $('#pagado-compra').text("$"+compra.pagado);
        $('#monto-compra').text("$"+compra.monto);
        $('#restante-compra').text("$"+(compra.monto-compra.pagado));
        $('#por-pagar-compra').text("$"+parseFloat(compra.monto - compra.pagado))
        $('#por-liquidar-compra').text(parseFloat(compra.monto - compra.pagado))
        $('#productos-compra-tbody').children().remove()
        $('#pagos-compra-tbody').children().remove()
        if(compra.pagado < compra.monto)
        {
          if(compra.clientHasCredit)
          {
            $('#liquidar-compra-toggle').hide()
            $('#abonar-compra-toggle').show()
            $('#abonar-compra-toggle').attr('compra', compra.id)
          }
          else {
            $('#abonar-compra-toggle').hide()
            $('#liquidar-compra-toggle').show()
            $('#liquidar-compra-toggle').attr('compra', compra.id)
          }
          $('#compra-liquidada-msg').text('NO LIQUIDADA')
        }
        else {
          $('#abonar-compra-toggle').hide()
          $('#liquidar-compra-toggle').hide()
          $('#abonar-compra-toggle').attr('compra', '')
          $('#compra-liquidada-msg').text('LIQUIDADA')
        }
        $.each(compra.productos, function (i, p) {
          $tr = $('<tr>')
          $img = $('<img width="40px" src="'+p.fotografia+'">')
          $tdFoto = $('<td>')
          $tdFoto.append($img)
          $tr.append($tdFoto)
          $tr.append($('<td>'+p.nombre+'</td>'))
          $tr.append($('<td>'+p.codigo+'</td>'))
          $tr.append($('<td>$'+p.pivot.precio_venta+'</td>'))
          $tr.append($('<td>'+p.pivot.cantidad+'</td>'))
          $('#productos-compra-tbody').append($tr)
        })
        if(compra.pagos.length < 1) $('#compra-no-pagos-msg').show()
        else $('#compra-no-pagos-msg').hide()
        $.each(compra.pagos, function (i, pago) {
          $tr = $('<tr>')
          $tr.append($('<td>'+pago.fecha+'</td>'))
          $tr.append($('<td>'+pago.hora+'</td>'))
          $tr.append($('<td>$'+pago.cantidad+'</td>'))
          $('#pagos-compra-tbody').append($tr)
        })
      })
      showModal('#detalles-compra-modal-back')
    })

    $('#modificar-fecha-switcher').click(function () {
      $('input[type=date][name=date-to-change]').fadeToggle(300,function () {
        if($(this).is(':hidden'))
          $(this).val('')
      })
    })

    $('#modificar-hora-switcher').click(function () {
      $('input[type=time][name=time-to-change]').fadeToggle(300,function () {
        if($(this).is(':hidden'))
          $(this).val('')
      })
    })

    $('#update-date-btn').click(function () {
      var $date = $('input[type=date][name=date-to-change]')
      var $time = $('input[type=time][name=time-to-change]')
      if($date.val() == '' && $time.val() == '')
        showMsg('Ups',['Sin cambios. No ha seleccionado cambiar la hora ni la fecha.'])
      else{
        $.ajax({
          url:'/admin/update-appointment-datetime',
          type:'post',
          dataType:'json',
          data:{
            _token:'{{csrf_token()}}',
            citaId:$('input[type=hidden][name=cita-en-cuestion]').val(),
            time:$time.val(),
            date:$date.val()
          }
        }).done(function (response) {
          if(response.result)
          {
            $.ajax({
              url:'/admin/getClientAppointmentsTable',
              type:'post',
              dataType:'html',
              data:{
                id: response.cita.cliente.id,
                _token:'{{csrf_token()}}'
              }
            }).done(function (response1) {
              $('#tbody-citas').children().remove()
              $('#tbody-citas').append(response1)
              $('.details-toggle').click(function () {
                openAppointmentDetails($(this).attr('id'));
              })
              closeModal('#update-date-modal-back')
              showMsg('Ups',['Fecha actualizada con exito.'])
              $('#fecha').text(response.cita.fecha)
              $('#hora').text(response.cita.hora)
              $('#tiempo-restante').text(response.cita.diff)
              $('#horario-aprox').text(response.cita.horarioAprox)
            })
          }
          else
          {
            showMsg('Ups',['Ha ocurrido un error.'])
          }
        })
      }
    })

    $('#update-date-toggle').click(function () {
      showModal('#update-date-modal-back',true)
    })

    $('#cancel-cita-toggle').click(function () {
      showModal('#cancelar-cita-modal-back',true)
    })

    $('#cancelar-cita-btn').click(function () {
      $.ajax({
        url:'/admin/cancel-appointment',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          citaId:$('input[type=hidden][name=cita-en-cuestion]').val()
        }
      }).done(function (response) {
        if(response.result)
        {
          closeModal('#cancelar-cita-modal-back')
          $('#cancel-cita-toggle').hide()
          $('#cambiar-estilista-btn').hide()
          $('#finish-toggle').hide()
          $('#update-date-toggle').hide()
          $('#pagar-toggle').hide()
          $('#abonar-toggle').hide()
          $('#estado').text('Cancelada')
          $('tr#cita'+$('input[type=hidden][name=cita-en-cuestion]').val()).addClass('cancelada')
        }
        else
        {
          showMsg('Ups!',['Ha ocurrido un error. Intente de nuevo.'])
        }
      })
    })

    $('#start-toggle').click(function () {
      $.ajax({
        url:'/admin/start-appointment',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          citaId:$('input[type=hidden][name=cita-en-cuestion]').val()
        }
      }).done(function (response) {
        if(response.result)
        {
          $('#start-toggle').hide()
          $('#finish-toggle').show()
          $('#estado').text('En curso')
          $('tr#cita'+$('input[type=hidden][name=cita-en-cuestion]').val()).addClass('en-curso')
        }
        else
        {
          showMsg('Ups!',['Ha ocurrido un error. Intente de nuevo.'])
        }
      })
    })

    $('#finish-toggle').click(function () {
      $.ajax({
        url:'/admin/end-appointment',
        type:'post',
        dataType:'json',
        data:{
          _token: '{{csrf_token()}}',
          citaId: $('input[type=hidden][name=cita-en-cuestion]').val()
        }
      }).done(function (response) {
        if(response.result)
        {
          $('#finish-toggle').hide()
          $('#estado').text('Finalizada')
          $('tr#cita'+$('input[type=hidden][name=cita-en-cuestion]').val()).addClass('finalizada')
        }
        else
        {
          showMsg('Ups!',['Ha ocurrido un error. Intente de nuevo.'])
        }
      })
    })

    $('#pagar-toggle').click(function () {
      showModal('#pagar-modal-back', true)
    })

    $('#pagar-btn').click(function () {
      $.ajax({
        url:'/admin/liquidar-cita',
        type:'post',
        dataType:'JSON',
        data:{
          _token:'{{csrf_token()}}',
          citaId:$('input#cita-a-pagar').val()
        }
      }).done(function (response) {
        if(response.result)
        {
          if(response.result) closeModal('#pagar-modal-back')
          showMsg('Ok',['Cita liquidada con exito.'])
          $tr = $('<tr>')
          $tr.append('<td>'+response.pago.fecha+'</td>')
          $tr.append('<td>'+response.pago.hora+'</td>')
          $tr.append('<td>$'+response.pago.cantidad+'</td>')
          $('#pagos-container').find('tbody').append($tr)
          $('#pagos-container').show()
          $('#por-pagar').text('$'+response.cita.restante)
          $('#pagado').text('$'+response.cita.pagado)
          $('#costo-liquidacion').text(parseFloat(response.cita.monto - response.cita.pagado).toFixed(2))
          $('#total-modal-pago').text(parseFloat(response.cita.monto-response.cita.pagado).toFixed(2));
          if(response.cita.restante == 0)
            $('#pagar-toggle').hide()
        }
        else showMsg('Ok',['Ha habido un error, intente de nuevo.'])
      })
    })

    $('#abonar-btn').click(function () {
      $.ajax({
        url:'/admin/pay',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          citaId:$('input[type=hidden][name=cita-a-pagar]').val(),
          cantidad:$('input[name=cantidad-a-pagar]').val()
        }
      }).done(function (response) {
        if(response.result) closeModal('#abonar-modal-back')
        showMsg(response.msg.title,[response.msg.body])
        $tr = $('<tr>')
        $tr.append('<td>'+response.pago.fecha+'</td>')
        $tr.append('<td>'+response.pago.hora+'</td>')
        $tr.append('<td>$'+response.pago.cantidad+'</td>')
        $('#pagos-container').find('tbody').append($tr)
        $('#pagos-container').find('table').css('width','100%')
        $('#no-pagos-msg').hide()
        $('#pagos-container').show()
        $('#por-pagar').text('$'+response.cita.restante)
        $('#pagado').text('$'+response.cita.pagado)
        $('#costo-liquidacion').text(parseFloat(response.cita.monto - response.cita.pagado).toFixed(2))
        $('#total-modal-pago').text(parseFloat(response.cita.monto-response.cita.pagado).toFixed(2));
        if(response.cita.restante == 0)
        {
          $('#abonar-toggle').hide()
          $('#liquidada-advice').show()
          $('#table-cita-pagada').text('Si')
        }
      })
    })

    $('input#cantidad-a-abonar').keypress(function (e) {
      if((!$.isNumeric(e.key) && e.key != '.')
      || ($(this).val().indexOf('.') > -1 && e.key == '.')
      || ($(this).val().indexOf('.') > -1 && $(this).val().indexOf('.') + 2 == $(this).val().length -1))
        e.preventDefault();
      if(e.key == '.' && $(this).val().length == 0)
        $(this).val('0')
    })

    $('#abonar-toggle').click(function () {
      showModal('#abonar-modal-back',true);
    })

    function showModal(id,table) {
      $modal = $(id)
      $modal.fadeIn();
      $children = $modal.children('.modal-black-card');
      if(table)
      {
        $children.css('height','auto');
        $children.children('.modal-footer').css('position','relative')
      }
      else
      {
        $children.css('height','100%');
        $children.children('.modal-footer').css('position','absolute')
      }
      $children.fadeIn(400, function () {
        if(!table)
          $children.children('.body').height(($children.height()-($children.children('.header').outerHeight()+$children.children('.modal-footer').outerHeight())-20)+'px');
        else $children.children('.body').height('auto');
      });
      $children.css('-webkit-transform','scale(1)');
    }

    $('#cambiar-estilista-selected').click(function () {
      if($('input[type=hidden][name=estilista]').val() != ''){
        $.ajax({
          url:'/changeStylistFromAppointment',
          type:'post',
          dataType:'json',
          data:{
            _token:'{{csrf_token()}}',
            appointmentId:$('#cambiar-estilista-selected').attr('value'),
            stylistId:$('input[type=hidden][name=estilista]').val()
          }
        }).done(function (estilista) {
          $('#cambiar-estilista-modal').children('.modal-black-card').css('-webkit-transform','scale(.7)');
          $('#cambiar-estilista-modal').children('.modal-black-card').fadeOut(400, function () {
            $(this).parent().fadeOut();
          })
          $('#foto-estilista').attr('src',estilista.foto)
          $('#nombre-estilista').text(estilista.nombre+' '+estilista.apellido)
        });
      }
      else{
        showMsg('Ups!',['Seleccione un estilista para continuar.']);
      }
    })

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

    $('.estilista-card').click(function () {
      var $shadow = $(this).children('.img-container').children('.shadow');
      $.each($('.estilista-card>.img-container>.shadow') ,function (i, e) {
        if($(e).attr('id') != $shadow.attr('id'))
            $(e).hide();
      });
      $shadow.fadeToggle(200, function () {
        if($shadow.is(':visible')){
          $('input[name=estilista]').val($shadow.attr('id'));
        }
        else{
          $('input[name=estilista]').val('');
        }
      });
    });

    $('.cambiar-estilista-btn').click(function () {
      $btn = $(this)
      $modal = $('#cambiar-estilista-modal')
      $modal.fadeIn();
      $children = $modal.children('.modal-black-card');
      $children.fadeIn(400, function () {
        $children.children('.body').height(($children.height()-($children.children('.header').outerHeight()+$children.children('.modal-footer').outerHeight())-20)+'px');
        $('.estilista-card>.img-container>.shadow>i').css('font-size',($('.estilista-card>.img-container>.shadow').width()*.40)+'px');
        $('#cambiar-estilista-selected').attr('value', $btn.attr('id'))
      });
      $children.css('-webkit-transform','scale(1)');
    })

    $('.details-toggle').click(function () {
      openAppointmentDetails($(this).attr('id'));
    })

    $('.close-btn').click(function () {
      var $parent = $(this).parent().parent();
      $parent.css('-webkit-transform','scale(.7)');
      $parent.fadeOut(200, function () {
        $parent.parent().fadeOut();
      });
    })

    $('.modal-back').click(function (e) {
      if(e.target === this){
        $(this).children('.modal-black-card').css('-webkit-transform','scale(.7)');
        $(this).children('.modal-black-card').fadeOut(200, function () {
          $(this).parent().fadeOut();
        });
      }
    });

    function openAppointmentDetails(id) {
      $.ajax({
        url:'/getAppointmentDetails',
        type:'post',
        dataType:'json',
        data:{
          _token:'{{csrf_token()}}',
          id:id
        }
      }).done(function (cita) {
        $('input#cita-a-pagar').val(cita.id)
        $('input[type=hidden][name=cita-en-cuestion]').val(cita.id)
        $('.cambiar-estilista-btn').attr('id',cita.id);
        $('.modal-black-card').find('#foto-estilista').attr('src',cita.estilista.fotografia);
        $('.modal-black-card').find('#nombre-estilista').text(cita.estilista.nombre+" "+cita.estilista.apellido);
        $('.modal-black-card').find('#fecha').text(cita.fecha);
        $('.modal-black-card').find('#hora').text(cita.hora);
        $('.modal-black-card').find('#estado').text(cita.estado);
        $('.modal-black-card').find('#tiempo-total').text(cita.tiempo);
        $('.modal-black-card').find('#horario-aprox').text(cita.horarioAprox);
        $('.modal-black-card').find('#pagado').text("$"+parseFloat(cita.pagado).toFixed(2));
        $('.modal-black-card').find('#total').text("$"+parseFloat(cita.monto).toFixed(2));
        $('.modal-black-card').find('#por-pagar').text("$"+(parseFloat(cita.monto-cita.pagado).toFixed(2)));
        $('#total-modal-pago').text(parseFloat(cita.monto-cita.pagado).toFixed(2));
        if(cita.monto-cita.pagado == 0)
        {
          $('#abonar-toggle').hide();
          $('#pagar-toggle').hide();
          $('#liquidada-advice').show()
        }
        else
        {
          $('#abonar-toggle').show();
          $('#liquidada-advice').hide()
          if(cita.cliente.credito == 1)
          {
            $('#abonar-toggle').show();
            $('#pagar-toggle').hide();
          }
          else
          {
            $('#abonar-toggle').hide();
            $('#pagar-toggle').show();
            $('#costo-liquidacion').text(parseFloat(cita.monto - cita.pagado).toFixed(2))
          }
        }
        if(cita.estado == 'En espera' || cita.estado == 'Confirmada'){
          if(cita.pagado == 0)
          {
            $('#cancel-cita-toggle').show();
          }
          else
          {
            $('#cancel-cita-toggle').hide();
          }
          $('#update-date-toggle').show();
          $('.cambiar-estilista-btn').show();
        }
        else {
          $('#cancel-cita-toggle').hide();
          $('#update-date-toggle').hide();
          $('.cambiar-estilista-btn').hide();
        }
        if(cita.estado == 'En curso' || cita.estado == 'Finalizada' || cita.estado == 'Cancelada')
        {
          $('#update-date-toggle').hide();
        }
        else
        {
          $('#update-date-toggle').show();
        }
        if(cita.estado == 'En curso')
        {
          $('#finish-toggle').show();
        }
        else $('#finish-toggle').hide();
        if(cita.estado == 'Confirmada')
        {
          $('.modal-black-card').find('#tiempo-restante').show()
          $('.modal-black-card').find('#tiempo-restante').text(cita.diff)
          $('#start-toggle').show();
        }
        else
        {
          $('#start-toggle').hide();
          $('.modal-black-card').find('#tiempo-restante').hide()
        }
        if(cita.estado == 'Cancelada')
        {
          $('#pagar-toggle').hide()
          $('#abonar-toggle').hide()
        }
        $('.modal-black-card').find('#servicios-count').text(cita.servicios.length);
        $.each(cita.servicios, function (i, servicio) {
          $('.servicio-item').remove();
          $item = $('<div class="servicio-item">');
          $imgCont = $('<div class="img-container2">')
          $imgCont.append($('<img src="'+servicio.icono+'">'))
          $item.append($imgCont);
          $info = $('<div class="info">')
          $info.append('<span class="nombre">'+servicio.nombre+'</span>')
          if(servicio.pivot.descuento == 0)
          $info.append('<span class="descuento">Sin promoción</span>')
          else $info.append('<span class="descuento">-'+servicio.pivot.descuento+'%</span>')
          $item.append($info);
          $('#servicios-container').append($item);
        })
        $tbody = $('#pagos-container>table>tbody');
        $tbody.children().remove();
        if(cita.pagos.length < 1){
          $('.modal-black-card').find('#no-pagos-msg').show();
          $('.modal-black-card').find('#pagos-container').hide();
        }
        else{
          $('.modal-black-card').find('#no-pagos-msg').hide();
          $('.modal-black-card').find('#pagos-container').show();

          $.each(cita.pagos, function (i, pago) {
            $tr = $('<tr>')
            $tr.append($('<td>'+pago.fecha+'</td>'))
            $tr.append($('<td>'+pago.hora+'</td>'))
            $tr.append($('<td>$'+pago.cantidad+'</td>'))
            $tbody.append($tr);
          })
        }
        $modal = $('#appointment-details-modal')
        $modal.fadeIn();
        $children = $modal.children('.modal-black-card');
        $children.fadeIn(400, function () {
          $children.children('.body').height(($children.height()-($children.children('.header').outerHeight()+$children.children('.modal-footer').outerHeight())-20)+'px');
        });
        $children.css('-webkit-transform','scale(1)');
      })
    }

    $('#modificar-credito').click(function () {
      $.ajax({
        url:'/admin/clientes/update-credit',
        type:'post',
        data:{
          _token:'{{csrf_token()}}',
          id:'{{$cliente->id}}'
        }
      });
    });

    $('#back-btn').css({
      'margin-right':'0px',
      'background-color':'rgba(0,0,0,.5)',
      'border-color':'rgba(255,255,255,.5)'
    });

    $(window).resize(function () {
      $.each($('.modal-back'),function (i, e) {
        $modal = $(e)
        $children = $modal.children('.modal-black-card');
        $children.children('.body').height(($children.height()-($children.children('.header').outerHeight()+$children.children('.modal-footer').outerHeight())-20)+'px');

      })
      $('.estilista-card>.img-container>.shadow>i').css('font-size',($('.estilista-card>.img-container>.shadow').width()*.40)+'px');
      if($('.main-container').height() + $('.footer').outerHeight() + 150 < $(window).height()){
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

    $('.msg-footer>button').click(function () {
      $('.msg-card').css('-webkit-transform','scale(.7)');
      $('.msg-card').parent().fadeOut(400, function () {
        $(this).hide();
      });
    });

    @if(session('msg'))
    showMsg("{{session('msg')['title']}}",["{{session('msg')['body']}}"]);
    @endif

  })
</script>
@endsection
