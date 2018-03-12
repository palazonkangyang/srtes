@extends('layout.master')
@section('title', $title)
@section('content')

@if(Session::has('success'))

<div class="container">
	<div class="alert alert-success alert-dismissible fade in fixed-error">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<strong> {{ Session::get('success') }}</strong>
	</div>
</div>
@endif


<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Course List</h4>
	</div>
</div>
<div class="wrap-content">

{!!Form::open(['class'=>'form-horizontal filter_field'])!!}

	<div class="form-group">
		<label class="col-md-1 control-label" for="search_field">Search</label>
		<div class="col-md-5">
{!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
{!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!}
</div>
		<div class="col-md-6">
			<span class="pull-right">
				<a href="/tes/course/course-list/add-course" id="add-button" class="btn btn-default">Add Course</a>
			</span>
		</div>
	</div>
{!!Form::close()!!}

@if(count($course_list))

	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th class="col-md-1">{!!$course_list->sortColumn('id','ID')!!}</th>
					<th class="col-md-2">{!!$course_list->sortColumn('name','Name')!!}</th>
					<th class="col-md-2">{!!$course_list->sortColumn('description','Description')!!}</th>
					<th class="col-md-1">{!!$course_list->sortColumn('course_type_id','Type')!!}</th>
					<th class="col-md-1">{!!$course_list->sortColumn('code','Code')!!}</th>
					<th class="col-md-1">{!!$course_list->sortColumn('duration','Duration')!!}</th>
					<th class="col-md-1">{!!$course_list->sortColumn('minimum_attendee','Minimum Attendee')!!}</th>
					<th class="col-md-1">{!!$course_list->sortColumn('maximum_attendee','Maximum Attendee')!!}</th>
					<th class="col-md-1">Register</th>
					<th class="col-md-1">Complete</th>
					<th class="col-md-1">Action</th>
				</thead>

				<tbody>

					@foreach($course_list as $course)
					<tr class="clickable-row" data-href="/tes/course/course-list/edit-course/{{$course->id}}">
						<td data-title="id">{{ $course->id }}</td>
						<td data-title="name">{{ $course->name }}</td>
						<td data-title="description">{!! $course->description !!}</td>
						<td data-title="course_type_id">{{ $course->course_type_name }}</td>
						<td data-title="code">{{ $course->code }}</td>
						<td data-title="duration">{{ $course->duration }}</td>
						<td data-title="minimum_attendee">{{ $course->minimum_attendee }}</td>
						<td data-title="maximum_attendee">{{ $course->maximum_attendee }}</td>
						<td data-title="register">{{ $course->register }}</td>
						<td data-title="complete">{{ $course->complete }}</td>
						<td class="special-td">
							<a title='Edit Questionnaire' href="/tes/course/course-list/edit-questionnaire/{{$course->id}}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

							@if(isset($course->hasreport))
								<a title='Report' href="/tes/course/course-list/questionnaire_report/{{$course->id}}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-list"></i></a>
							@endif
          	</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>

	<span style="display:none">
	  {!! $course_list->sortColumn('','') !!}
	</span>

	{!! $course_list->paginate() !!}

@else
	<span class="no-data-display">No data to display.</span>
@endif

</div>
<script type="text/javascript">

	$(document).ready(function(){

		$('.clickable-row').on('hover', 'td:not(.special-td)', function(){

		    //get the link from data attribute
		    var the_link = $(this).parent().attr("data-href");

		    //do we have a valid link
		    if (the_link == '' || typeof the_link === 'undefined') {
		      //do nothing for now
		    }
		    else {
		      //open the page
		      window.location = the_link;
		    }
		});

	});

</script>
@stop
