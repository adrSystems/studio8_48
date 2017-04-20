@extends('layouts.master')
@section('css')
@endsection
@section('body')
<br><br><br><br><br>
<div class="container">
  <div class="row">
    @foreach(App\Tip::get() as $tip)
    <div class="col-md-6">
     {!! Embed::make($tip->video)->parseUrl()->getIframe(); !!}
    </div>
    @endforeach
  </div>
</div>
@endsection
