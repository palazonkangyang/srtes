@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Change Password</h4></div>
</div>

<div class="wrap-content">

@if(Session::has('success'))
    <div class="alert-success" style="margin-bottom:10px;">
        <div class="success-msg"><span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}</div>
    </div>
@elseif($errors->all())
  <div class="alert-danger padding" style="margin-bottom:10px;">
  @foreach($errors->all() as $error)
    <div class="error-list"> <span class="glyphicon glyphicon-remove"></span> {!!$error!!}</div>
  @endforeach
  </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>CHANGE PASSWORD FORM</h4></div>
        <div class="panel-body">

            {!!Form::open(['url'=>'/controller/changepassword','class'=>'change-password',])!!} 

                <div class="form-group">
                  {!! Form::label('old_password', 'Old Password') !!}
                  {!! Form::input('password','old_password', '',array('id' => 'old_password', 'class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                  {!! Form::label('new_password', 'New Password') !!}
                  {!! Form::input('password','new_password', '',array('id' => 'new_password', 'class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                  {!! Form::label('new_password_confirmation', 'Confirm New Password') !!}
                  {!! Form::input('password','new_password_confirmation', '',array('id' => 'new_password_confirmation', 'class' => 'form-control')) !!}
                </div>
                <hr />
            
            <button type="submit" class="btn btn-default" id="submit">Submit</button>
            {!!Form::close()!!}
      
        </div>
      </div>
    </div>
  </div>
</div>
@stop