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
		<h4 class="page-head-line">Course Type List</h4>
	</div>
</div><!-- end row -->

<div class="wrap-content">

  {!!Form::open(['class'=>'form-horizontal filter_field'])!!}

  	<div class="form-group">
  		<label class="col-md-1 control-label" for="search_field">Search</label>
  		<div class="col-md-5">
        {!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
        {!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!}
      </div><!-- end col-md-5 -->

  		<div class="col-md-6">
  			<span class="pull-right">
  				<a href="/tes/course/course-type/add-course-type" id="add-button" class="btn btn-default">Add Course Type</a>
  			</span>
  		</div><!-- end col-md-6 -->
  	</div><!-- end form-group -->

  {!!Form::close()!!}

  @if(count($course_type_list))

  <div class="row">

    <div id="no-more-tables">

      <table class="col-md-12 table-bordered table-striped table-condensed cf">
        <thead class="cf">
          <th>{!! $course_type_list->sortColumn('id','ID') !!}</th>
          <th>{!! $course_type_list->sortColumn('name','Name') !!}</th>
          <th>Action</th>
        </thead>

        <tbody>

					@foreach($course_type_list as $coursetype)
					<tr class="clickable-row" data-href="/tes/course/course-type/edit-course-type/{{ $coursetype->id }}">
						<td data-title="id">{{ $coursetype->id }}</td>
						<td data-title="name">{{ $coursetype->name }}</td>
						<td class="special-td">
							<a title='Edit Questionnaire' href="/tes/course/course-type/edit-questionnaire/{{ $coursetype->id }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
          	</td>
					</tr>
					@endforeach

				</tbody>
      </table>

    </div><!-- end no-more-tables -->

  </div><!-- end row -->

  <span style="display:none">
	  {!! $course_type_list->sortColumn('','') !!}
	</span>

	{!! $course_type_list->paginate() !!}

  @else

  <span class="no-data-display">No data to display.</span>

  @endif

</div><!-- end wrap-content -->

@stop
