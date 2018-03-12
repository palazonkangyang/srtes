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
		<h4 class="page-head-line">Questionnaire List</h4>
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
				<a href="/tes/form-management/questionnaire-list/add-questionnaire" id="add-button" class="btn btn-default">Add Questionnaire</a>
			</span>
		</div>
	</div>
{!!Form::close()!!}
{{--
@if(count($course_list))

	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th>{!!$course_list->sortColumn('id','ID')!!}</th>
					<th>{!!$course_list->sortColumn('name','Name')!!}</th>
					<th>{!!$course_list->sortColumn('description','Description')!!}</th>
					<th>{!!$course_list->sortColumn('course_type_id','Type')!!}</th>
					<th>{!!$course_list->sortColumn('code','Code')!!}</th>
					<th>{!!$course_list->sortColumn('duration','Duration')!!}</th>
					<th>{!!$course_list->sortColumn('minimum_attendee','Minimum Attendee')!!}</th>
					<th>{!!$course_list->sortColumn('maximum_attendee','Maximum Attendee')!!}</th>
				</thead>
				<tbody>
@foreach($course_list as $course)

					<tr class="clickable-row" data-href="/tes/course/course-list/edit-course/{{$course->id}}">
						<td data-title="id">{{ $course->id }}</td>
						<td data-title="name">{{ $course->name }}</td>
						<td data-title="description">{{ $course->description }}</td>
						<td data-title="course_type_id">{{ $course->course_type_name }}</td>
						<td data-title="code">{{ $course->code }}</td>
						<td data-title="duration">{{ $course->duration }}</td>
						<td data-title="minimum_attendee">{{ $course->minimum_attendee }}</td>
						<td data-title="maximum_attendee">{{ $course->maximum_attendee }}</td>
					</tr>
@endforeach

				</tbody>
			</table>
		</div>
	</div>

	<span style="display:none">
	    {!!$course_list->sortColumn('','')!!}
	</span>

	{!!$course_list->paginate()!!}

@else

	<span class="no-data-display">No data to display.</span>
@endif






</div>

--}}
@stop
