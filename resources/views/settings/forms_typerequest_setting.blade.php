@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Form Settings</h4></div>
</div>


<div class="wrap-content">

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-gray">
            <strong>Form Settings.</strong> Click each thumbnails link below.
        </div>
    </div>
</div>

 
 <div class="row">
 
               


           

 
  @if(Auth::User()->roleid == 1 ||  Auth::User()->roleid == -1)
      	<div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/settings/request/forms" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-list-alt dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Forms Setup</h5>
                    </div>
                    </a>
                </div>
                
                 <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/settings/request" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-keyboard-o dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Forms Category</h5>
                    </div>
                    </a>
                </div>
 @endif
 
   
            </div>
</div>
@stop