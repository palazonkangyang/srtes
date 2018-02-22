@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
  <div class="col-md-12"><h4 class="page-head-line">Settings</h4></div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-gray">
        <strong>Settings.</strong> Click each thumbnails link below.
      </div>
    </div><!-- end col-md-12 -->
  </div><!-- end row -->

  <div class="row">

    @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/settings/user_department_setting" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-users dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div><!-- end progress -->
          <h5>User and Department Settings</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

		<div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/settings/forms_typerequest_setting" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i  class="fa fa-list-alt dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div>
          <h5>Form Settings</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/settings/urgency" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i  class="fa fa-clock-o dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div>
          <h5>Set Urgency</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

    @endif

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/account/account-settings" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-gear dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div><!-- end progress -->
          <h5>Out of Office Settings</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->



    @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/settings/group_fixed_setting" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i class="fa fa-user dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div><!-- end progress -->
          <h5>Group and Fixed Settings</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div>
    @endif

    @if(Auth::User()->roleid == 1 || Auth::User()->deptid == 12 || Auth::User()->roleid == -1)

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/application/out_of_office_pending_lists" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i class="fa fa-list-alt dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
              </div>
            </div><!-- end progress -->
            <h5>Pending Lists (Out of Office)</h5>
        </div><!-- end col-md-3 -->
      </a>
    </div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/settings/glcode_setting" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i class="fa fa-code dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
              </div>
            </div><!-- end progress -->
            <h5>GL Code setting </h5>
        </div><!-- end col-md-3 -->
      </a>
    </div><!-- end col-md-3 -->

    @endif

    @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/auditlog" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i class="fa fa-book dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div><!-- end progress -->
          <h5>Audit Log </h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->
    @endif

    @if(Auth::User()->roleid == 1 || Auth::User()->roleid == -1)
    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/globalsetting" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-two">
          <i class="fa fa-globe dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
          </div><!-- end progress -->
          <h5>Notification Settings </h5>
        </div>
      </a>
    </div>
    @endif

  </div><!-- end row -->
</div><!-- end wrap-content -->

@stop
