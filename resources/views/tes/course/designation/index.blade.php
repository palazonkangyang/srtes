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
	</div><!-- end alert -->
</div><!-- end container -->
@endif

<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Designation List</h4>
	</div><!-- end col-md-12 -->
</div><!-- end row -->

<div class="wrap-content">

	{!! Form::open(['class'=>'form-horizontal filter_field']) !!}

	<div class="form-group">
		<label class="col-md-1 control-label"></label>

		<div class="col-md-5">
		</div><!-- end col-md-5 -->

		<div class="col-md-6">
			<span class="pull-right">
				<a href="/tes/course/designation/add-designation" id="add-button" class="btn btn-default">Add Designation</a>
			</span>
		</div><!-- end col-md-6 -->

	</div><!-- end form-group -->

	{!! Form::close() !!}

	@if(count($designation_list))

	<div class="row">

		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<th>{!! $designation_list->sortColumn('id','ID') !!}</th>
					<th>{!! $designation_list->sortColumn('name','Name') !!}</th>
					<th>Action</th>
				</thead>

				<tbody>

					@foreach($designation_list as $designation)
					<tr>
						<td data-title="id">{{ $designation->id }}</td>
						<td data-title="name">{{ $designation->name }}</td>
						<td class="special-td">
							<a title='Edit' href="/tes/course/designation/edit-designation/{{ $designation->id }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
          	</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div><!-- end no-more-tables -->

	</div><!-- end row -->

	<span style="display:none">
	  {!! $designation_list->sortColumn('','') !!}
	</span>

	{!! $designation_list->paginate() !!}

	@else

		<span class="no-data-display">No data to display.</span>

	@endif

</div><!-- end wrap-content -->

@stop
