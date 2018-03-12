@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Add Course Type</h4>
	</div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">

    <div class="col-md-12">

      <div class="panel panel-default">

        <div class="panel-heading">
					<h4>Add course type form</h4>
					<span class="pos-add-back pull-right">
						<a href="/tes/course/course-type">Back to Course Type List</a>
					</span>
				</div><!-- end panel-heading -->

        <div class="panel-body">

          @if(Session::has('success'))

					<div class="alert-success" style="margin-bottom:20px;">
						<div class="success-msg">
							<span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}
						</div>
					</div>

					@elseif($errors->all())

					<div class="alert-danger padding" style="margin-bottom:20px;">
						@foreach($errors->all() as $error)
						<div class="error-list">
							<span class="glyphicon glyphicon-remove"></span> {!!$error!!}
						</div>
						@endforeach
					</div><!-- end alert-danger -->

					@endif

          {!! Form::open(['url'=>'/controller/tes/course/course-type/add-course-type','class'=>'course-list',]) !!}

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Course Type Name</label>
						<div class="col-sm-9">
							{!! Form::input('text','name', NULL, array('placeholder' => 'Course Type Name', 'id' => 'name', 'class' => 'form-control')) !!}
						</div>
					</div><!-- end form-group -->

          <div class="form-group row">
						<div class="col-sm-12" style="text-align:center">
							<button type="submit" class="btn btn-default">Add Course Type</button>
						</div>
					</div><!-- end form-group -->

          {!! Form::close() !!}

        </div><!-- end panel-body -->

      </div><!-- end panel -->

    </div><!-- end col-md-12 -->

  </div><!-- end row -->

</div><!-- end wrap-content -->

@stop
