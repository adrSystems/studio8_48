@extends('layouts.master')
@section('title')
Mi cuenta
@endsection
@section('css')
<style>
  .cuenta{
    margin-top: 100px;
  }
  .footer{
    margin-top: 40%;
  }
  .nav{
    background-color: #1F1F1F;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    height: 300px;
  }
  .nav li.item a{
    border-radius: 0px;
    color: white;
    background-color: #3F3F3F;
    font-family: 'Lobster Two';
    margin-top: -2px;
    font-size: 16px;
    -webkit-transition: 0.3s ease;
  }
  .nav li.title-nav a{
    font-family: 'Lobster Two';
  }
  .nav li.title-nav a:hover{

  }
  .nav li.item a:hover{
    color: white;
    background-color: black;
  }
  .nav li.item a::after{
    content: '';
    display: block;
    width: 0px;
    height: 2px;
    background: white;
    transition: width .3s;
  }
  .nav li.item a:hover::after{
    width: 100%;
  }
  .title-nav{
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    text-align: center;
    font-size: 18px;
  }
  .nav-pills li.active a,
  .nav-pills li.active a:hover,
  .nav-pills li.active a:focus{
    background-color: #1F1F1F;
  }
  .material-icons{
    margin-top: 3px;
    float: left;
  }
  .panel{
    border: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 6px;
  }
  .panel .panel-heading{
    background-color: #1F1F1F;
    color: white;
  }
  .panel-heading{

    font-family: 'Lobster Two';
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="cuenta col-md-12">
    <div class="col-xs-3">
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active title-nav"><a href="#">Home</a></li>
        <li role="presentation" class="item item-perfil"><a href="#" class="item-nav"><i class="material-icons">person</i><p> Profile</p></a></li>
        <li role="presentation" class="item item-mensaje"><a href="#" class="item-nav"><i class="material-icons">forum</i><p> Messages</p></a></li>
      </ul>
    </div>
    <div class="col-xs-offset-1 col-xs-8">
      <div class="perfil">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Perfil</h3>
          </div>
          <div class="panel-body">
            <div class="col-xs-offset-2 col-xs-8">
              <div class="" data-toggle="collapse" data-target="#nombre">
                Hola<a href="#" class="pull-right">Hola</a>
              </div>
              <div id="nombre" class="collapse">
                Hola
              </div>
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

</script>
@endsection
