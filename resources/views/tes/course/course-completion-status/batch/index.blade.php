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
		<h4 class="page-head-line">Batch List</h4>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="/tes/course/course-completion-status">Course List</a></li>
			<li class="breadcrumb-item">{{ $course['name'] }}</li>
		</ol>
	</div>
</div>
<div class="wrap-content">

@if(count($batch_list))

	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th>Batch ID</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Location</th>
					<th>Completion Status</th>
				</thead>
				<tbody>
@foreach($batch_list as $batch)
					<tr>
						<td data-title="id">{{ $batch->id }}</td>
						<td data-title="start_date">{{ $batch->start_date }}</td>
						<td data-title="end_date">{{ $batch->end_date }}</td>
						<td data-title="location">{{ $batch->location }}</td>
						<td data-title="completion_status" class="clickable-row" data-href="/tes/course/course-completion-status/course-{{ $course['id'] }}/batch-{{ $batch->id }}/questionnaire">{{ $batch->completion_status }}%</td>
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
