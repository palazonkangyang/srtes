@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">User & Department Settings</h4></div>
</div>


<div class="wrap-content">

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-gray">
            <strong>User & Department Settings.</strong> Click each thumbnails link below.
        </div>
    </div>
</div>

 
 <div class="row">
 
               


           

 
  @if(Auth::User()->roleid == 1  || Auth::User()->roleid == -1)
       <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/management" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-users dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>User Management</h5>
                    </div>
                    </a>
                </div>


                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/department" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-share-alt dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Department Management</h5>
                    </div>
                    </a>
                </div>
 @endif
 
   
            </div>
</div>
@stop