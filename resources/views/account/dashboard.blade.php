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
    <div class="col-md-12">
        <div class="alert alert-gray clickable-div" data-href="/application/pending">
            <i class="fa fa-check-circle-o"></i> Welcome, You have <strong><a href="/application/pending" class="underline">{{ $cnt }}</a></strong> pending task(s).
        </div>
    </div>
</div>


 <div class="row">

                 <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/new/process" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-one">
                        <i  class="fa fa-edit dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>

                    </div>
                         <h5>New Application</h5>
                    </div>
                    </a>
                </div>


                 <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/pending" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-two">
                        <i  class="fa fa-list-ol dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>

</div>
                          <h5>Pending Tasks</h5>
                    </div>
                  </a>
                </div>
                 <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/application/myapp" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-three">
                        <i  class="fa fa-th-list dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>

</div>
                          <h5>My Application</h5>
                    </div>
                  </a>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/settings" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-four">
                        <i  class="fa fa-cogs dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>

</div>
                         <h5>Settings</h5>
                    </div>
                    </a>
                </div>
 @if(Auth::User()->roleid == 1 || Auth::User()->deptid == 12 || Auth::User()->roleid == -1)
       <div class="col-md-3 col-sm-3 col-xs-6">
                  <a href="/paymentprocessing" class="magic-link">
                    <div class="dashboard-div-wrapper bk-clr-four">
                        <i  class="fa fa-money dashboard-div-icon" ></i>
                        <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>

</div>
                         <h5>Payment Processing</h5>
                    </div>
                    </a>
                </div>
 @endif

@if(Auth::User()->deptid == 9 || Auth::User()->roleid == -1)
<div class="col-md-3 col-sm-3 col-xs-6">
	<a href="/tes/dashboard" class="magic-link">
		<div class="dashboard-div-wrapper bk-clr-four">
			<i  class="fa fa-mortar-board dashboard-div-icon" ></i>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
			<h5>Training Evaluation System</h5>
		</div>
	</a>
</div>
@endif


            </div>

@stop
