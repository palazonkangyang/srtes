@extends('layout.master')
@section('title', $title)
@section('content')
<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Course</h4>
	</div>
</div><!-- end row -->

<div class="wrap-content">

	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-gray">
				<strong>Course.</strong> Click each thumbnails link below.
			</div><!-- end alert -->
		</div><!-- end col-md-12 -->
	</div><!-- end row -->

	<div class="row">

		<div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/tes/course/course-type" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-file dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Course Type</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

		<div class="col-md-3 col-sm-3 col-xs-6">
			<a href="/tes/course/course-list" class="magic-link">
				<div class="dashboard-div-wrapper bk-clr-one">
					<i  class="fa fa-file dashboard-div-icon" ></i>
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
					</div>
					<h5>Course List</h5>
				</div><!-- end dashboard-div-wrapper -->
			</a>
		</div><!-- end col-md-3 -->

    <div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/tes/course/course-completion-status" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i  class="fa fa-file dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Course Completion Status</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

		<div class="col-md-3 col-sm-3 col-xs-6">
      <a href="/tes/course/designation" class="magic-link">
        <div class="dashboard-div-wrapper bk-clr-one">
          <i class="fa fa-file dashboard-div-icon" ></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <h5>Designation</h5>
        </div><!-- end dashboard-div-wrapper -->
      </a>
    </div><!-- end col-md-3 -->

	</div><!-- end row -->

</div><!-- end wrap-content -->
@stop
