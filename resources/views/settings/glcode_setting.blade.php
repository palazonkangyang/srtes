@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">GL code Settings</h4></div>
</div>


<div class="wrap-content">

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-gray">
            <strong>GL code Settings.</strong> Click each thumbnails link below.
        </div>
    </div>
</div>

 
 <div class="row">
 
               


           

 
  @if(Auth::User()->roleid == 1 || Auth::User()->deptid == 12 || Auth::User()->roleid == -1)
       <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/accountcode" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-two">
                        <i  class="fa fa-code dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>
                           
</div>
                          <h5>GL Code Management </h5>
                    </div>
                    </a>
                </div>
 @endif
 
 @if(Auth::User()->roleid == 1 || Auth::User()->deptid == 12 || Auth::User()->roleid == -1)
       <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/optionalcode" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-two">
                        <i  class="fa fa-plus-circle dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>
                           
</div>
                          <h5>Cost Centre Management </h5>
                    </div>
                    </a>
                </div>
 @endif
 
   
            </div>
</div>
@stop