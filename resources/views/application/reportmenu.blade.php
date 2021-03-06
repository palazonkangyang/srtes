@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Report Menu</h4></div>
</div>


<div class="wrap-content">

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-gray">
            <strong>Report Menu.</strong> Click each thumbnails link below.
        </div>
    </div>
</div>

 
 <div class="row">
 @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1 || Auth::User()->roleid == 2 )
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/reports" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-users dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Ad-hoc</h5>
                    </div>
                    </a>
                </div>
@endif
@if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1 || Auth::User()->roleid == 2 || Auth::User()->deptid == 12 )

                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/reportsFin" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-share-alt dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Finance</h5>
                    </div>
                    </a>
                </div>
@endif
@if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1 || Auth::User()->roleid == 2 || Auth::User()->deptid == 9 )
				<div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/reportsHR" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-list-alt dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>HR</h5>
                    </div>
                    </a>
                </div>
  @endif
  @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1 || Auth::User()->roleid == 2 || Auth::User()->deptid == 13 )
                 <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/reportsAdmin" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-keyboard-o dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                           
                    </div>
                         <h5>Admin</h5>
                    </div>
                    </a>
                </div>
@endif

               



       


              

            </div>
</div>
@stop