@extends('layout.master')
@section('title','Dashboard')
@section('content')

@if(Session::has('not_allowed'))
<div class="alert alert-danger alert-dismissible fade in fixed-error">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong> {{ Session::get('not_allowed') }}</strong>
</div>
@endif

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Dashboard</h4></div>
</div>

<div class="row">

  <div class="col-md-3 col-sm-3 col-xs-6">
  	<a href="/dashboard" class="magic-link">
  		<div class="dashboard-div-wrapper bk-clr-four">
  			<i  class="fa fa-check dashboard-div-icon" ></i>
  			<div class="progress progress-striped active">
  				<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
  			</div>
  			<h5>Approval Management System</h5>
  		</div>
  	</a>
  </div>

</div>

@stop
