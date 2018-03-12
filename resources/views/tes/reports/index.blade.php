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
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/tes/reports/training-evaluation" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
            <i  class="fa fa-file dashboard-div-icon" ></i>
            <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>
             <h5>Training Evaluation Report</h5>
        </div>
        </a>
    </div>
  </div>

</div>
@stop
