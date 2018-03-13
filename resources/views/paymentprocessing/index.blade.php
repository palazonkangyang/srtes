@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
  <div class="col-md-12"><h4 class="page-head-line">Payment Processing</h4></div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-gray">
        <strong>Payment Processing Option</strong> Click each thumbnails link below.
      </div><!-- end alert -->
    </div><!-- end col-md-12 -->
  </div><!-- end row -->


  <div class="row">

    @if(Auth::User()->idsrc_login != 212)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/reimbursement" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Reimbursement </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->
    @endif

    @if(Auth::User()->idsrc_login != 144)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/cashadvance" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Cash Advance </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->
    @endif

  </div><!-- end row -->
</div><!-- end wrap-content -->

@stop
