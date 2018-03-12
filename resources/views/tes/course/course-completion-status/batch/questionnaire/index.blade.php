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
		<h4 class="page-head-line">Status</h4>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="/tes/course/course-completion-status">Course List</a></li>
			<li class="breadcrumb-item"><a href="/tes/course/course-completion-status/course-{{$course['id']}}/batch">{{ $course['name'] }}</a></li>
			<li class="breadcrumb-item">Batch - {{ $batch['id'] }}</li>
		</ol>
	</div>
</div>
<div class="wrap-content">

@if(count($attendee_list))

	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th>Attendee</th>
					<th>Status</th>
				</thead>
				<tbody>
@foreach($attendee_list as $a)
					<tr>
						<td data-title="attendee">{{$a->app_id}}</td>
						<td data-title="status">{{$a->status_name}}</td>
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
