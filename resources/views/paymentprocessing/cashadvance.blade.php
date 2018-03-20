@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
  <div class="col-md-12"><h4 class="page-head-line">Cash Advance</h4></div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-gray">
        <strong>Cash Advance Option</strong> Click each thumbnails link below.
      </div>
    </div>
  </div><!-- end row -->

  <div class="row">

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/cashadvance_pending" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Pending</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/cashadvance_processing" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Processing </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/cashadvance_readyforcollection" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Ready For Collection </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/paymentprocessing/cashadvance_collected" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-money dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Collected </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

  </div><!-- end row -->

  <br></br>

  <div style='width: 100%; text-align: center;'>
    <div style='display: inline-block;'>
      <a href="{{ URL::route('paymentprocessing') }}" class="btn btn-default">Back</a>
    </div>
  </div>

</div><!-- end wrap-content -->

@stop
