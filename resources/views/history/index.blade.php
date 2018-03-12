@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">History</h4></div>
</div>


<div class="wrap-content">

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-gray">
            <strong>History.</strong> List of applications if you are "Approver", "CCperson" & "Save Drafts" Click each thumbnails link below.
        </div>
    </div>
</div>

 
 <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6">
            <a href="/history/approver/list" class="magic-link">
              <div class="dashboard-div-wrapper bk-clr-one">
                  <i  class="fa fa-envelope-o dashboard-div-icon" ></i>
                  <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                     
              </div>
                   <h5>As Approver</h5>
              </div>
              </a>
          </div>


           <div class="col-md-3 col-sm-3 col-xs-6">
            <a href="/history/ccperson/list" class="magic-link">
              <div class="dashboard-div-wrapper bk-clr-two">
                  <i  class="fa fa-envelope-square dashboard-div-icon" ></i>
                  <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                      </div>
                                               
                    </div>
                    <h5>As CCperson</h5>
              </div>
              </a>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <a href="/history/savedrafts/list" class="magic-link">
              <div class="dashboard-div-wrapper bk-clr-two">
                  <i  class="fa fa-pencil-square dashboard-div-icon" ></i>
                  <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                      </div>
                                               
                    </div>
                    <h5>Saved Drafts</h5>
              </div>
              </a>
          </div>

  </div>
</div>
@stop