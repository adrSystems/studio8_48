@extends('layouts.master')

@section('title')
Información cliente
@endsection

@section('css')
<style media="screen">
  .main-container{
    float: left;
    width: 100%;
    margin-top: 100px;
    margin-bottom: 50px;
  }
  h2.main-title{
    font-family: 'Lobster Two';
  }
  #summary-container{
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
  }
</style>
@endsection

@section('body')
<div class="main-container">
  <h2 class="main-title">Detalles del cliente</h2>
  <div class="col-xs-12" id="summary-container">
    <h3>{{$cliente->nombre}}</h3>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
