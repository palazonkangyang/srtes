@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Set Urgency</h4></div>
</div>


<div class="wrap-content">

{!!Form::open(['url'=>'/controller/settings/urgencystore','class'=>'form-horizontal filter_field'])!!} 
<div class="form-group">
  <label class="col-md-1 control-label"></label>
  <div class="col-md-3">
    @if(Session::has('rmsg')) <div class="alert alert-success"> {{ Session::get('rmsg') }} </div> @endif
    @foreach($errors->all() as $error)
      <div class="error-list alert-danger alert">{!!$error!!}</div>
    @endforeach
  </div>
</div>
@foreach($urgency as $urg)
<div class="form-group">
  <label class="col-md-2 control-label">{{$urg->urgency_name}}</label>
  <div class="col-md-2"> 
    {!! Form::text($urg->urgency_id,$urg->set_time,['class'=>'form-control width-control-hour']) !!} Hour(s)
  </div>
</div>
@endforeach

<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-2"> 
    {!!Form::submit('Set Time',['class'=>'btn btn-default btn-cs search_btn'])!!}
    <a href="" class="btn btn-default btn-cs">Refresh</a>
  </div>
</div>
{!!Form::close()!!}  
</div>

@stop