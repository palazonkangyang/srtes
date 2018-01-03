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
		<h4 class="page-head-line">Course Completion Status</h4>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Course List</li>
    </ol>
	</div>
</div>

<div class="wrap-content">

@if(count($course_list))
	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th>Course Name</th>
          <th>Number of Batch</th>

				</thead>
				<tbody>
@foreach($course_list as $course)
					<tr>
						<td data-title="name" class="clickable-row" data-href="/tes/course/course-list/edit-course/{{ $course->id }}">{{ $course->name }}</td>
            <td data-title="name" class="clickable-row" data-href="/tes/course/course-completion-status/course-{{ $course->id }}/batch">{{ $course->number_of_batch }}</td>
					</tr>
@endforeach
				</tbody>
			</table>
		</div>
	</div>



@else

	<span class="no-data-display">No data to display.</span>
@endif

</div>

@stop
