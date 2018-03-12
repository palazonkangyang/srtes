@extends('layout.master')
@section('title','Login')
@section('content')

<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" />

<div class="container">
<div class="row login_box">
      <div class="col-md-12 col-xs-12" align="center">
            <div class="line"><h3>{{ date('h:i A') }}</h3></div>
            <div class="outter">
              <img src="{{ URL::asset('images/red_cross_login.jpg') }}" class="image-circle"/>

            </div>   
            <span class="singapore-login" style="display:none">Singapore</span>

      </div>
      <div class="col-md-12 col-xs-12 login_control">
        {!!Form::open(['url'=>'/controller/account/postLogin'])!!}  
            
            {{--*/ $msg = session('successMsg') ?  session('successMsg') : ''; /*--}}

            @if($msg)
                <div class="alert-success no-padding">{{$msg}}</div>
            @endif

             <div class="alert-danger no-padding" style="margin:10px 0; padding-left:5px; padding-left:5px;">
                @foreach($errors->all() as $error)
                    <div class="error-list">{!!$error!!}</div>
                @endforeach
             </div>

           
              
              <div align="center">
                  <br>
               <div class="ins_sub control">Google One Sign-On</div>
    <br>
        <br>
            <br>
                   <a class='btn btn-default login-btn' href="redirect">Sign In</a>
              </div>
         {!!Form::close()!!}   
      </div>
   
  </div>
</div>  



@stop