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
    background-color: white;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    height: 300px;
    box-shadow: 2px 2px 2px 2px #1F1F1F;
  }
  .nav li a{
    border-radius: 0px;
    color: white;
    background-color: #3F3F3F;
    font-family: 'Lobster Two';
    margin-top: -2px;
  }
  .nav li.title-nav a:hover{

  }
  .nav li a:hover{
    color: black;
    border-bottom: 1.5px solid #DFDFDF;
    background-color: black;
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

  .item{
    background-color: #151515;
  }
</style>
@endsection
@section('body')
<div class="container">
  <div class="cuenta col-md-12">
    <div class="col-xs-3">
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active title-nav"><a href="#">Home</a></li>
        <li role="presentation" class="item item-perfil"><a href="#">Profile</a></li>
        <li role="presentation" class="item item-mensaje"><a href="#">Messages</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection
