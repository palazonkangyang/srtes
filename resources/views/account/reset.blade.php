@extends('layout.master')
@section('title','Login')
@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />

<div class="container">
<div class="row login_box">
      <div class="col-md-12 col-xs-12 login_control">
        {!!Form::open(['url'=>'/controller/resetpassword'])!!}  
              
             <div class="alert-danger no-padding" style="margin:10px 0; padding-left:5px; padding-left:5px;">
                @foreach($errors->all() as $error)
                    <div class="error-list">{!!$error!!}</div>
                @endforeach
             </div>

            {{--*/ $msg = session('successMsg') ?  session('successMsg') : ''; /*--}}

            @if($msg)
                <div class="alert-success no-padding">{{$msg}}</div>
            @endif
            
              <div class="ins_sub control">Reset Password</div>

              <div class="control">
                  {!! Form::text('email',Input::old('email'),['class'=>'form-control','placeholder'=>'Type your Email address', 'autofocus'=>'']) !!}
              </div>

              <div align="center">
                   {!!Form::submit('Submit',['class'=>'btn btn-default login-btn'])!!}
              </div>
         {!!Form::close()!!}   
      </div>
  </div>
</div>  

@stop