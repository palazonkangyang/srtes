@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Account Settings</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>SETTINGS</h4></div>
        <div class="panel-body">

            {!!Form::open(['url'=>'/controller/accountsettings','class'=>'accountsettings',])!!} 

                <div class="form-group">   
                  <div class="col-md-2 col-sm-2">{!! Form::label('ooo', 'Out of Office (Settings)') !!}</div>
                  <div class="col-md-2 col-sm-2 success-settings">
                    <div class="btn-group btn-toggle"> 
                        <button class="btn btn-default @if(!empty($user['0']['inoffice'])) active @endif">ON</button>
                        <button class="btn btn-default @if(empty($user['0']['inoffice'])) active @endif">OFF</button>
                    </div>
                    <span class="ooo-value"><input type="hidden" class="ooo" name="ooo" value="@if(!empty($user['0']['inoffice']))1 @endif" /></span>
                  </div>
                </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop