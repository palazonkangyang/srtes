@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Type of Request</h4></div>
</div>


<div class="wrap-content">

{!!Form::open(['class'=>'form-horizontal filter_field'])!!} 
<div class="form-group">
  <label class="col-md-2 control-label" for="search_field">Search</label>
  <div class="col-md-5"> 
    {!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
    {!!Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!} 
  </div>

</div>
{!!Form::close()!!}  


{!!Form::open(['url'=>'/controller/settings/storetyperequest','class'=>'form-horizontal add_field_type'])!!} 
<div class="form-group">
<label class="col-md-2 control-label" for="textinput">[Add] Type of Request :</label>  
<div class="col-md-5">
    {!! Form::text('name','',['class'=>'form-control add_input_type']) !!}
    {!!Form::submit('Add',['class'=>'btn btn-default btn-cs add_submit'])!!}
</div>             
</div>
{!!Form::close()!!}


@if(Session::has('rmsg')) <div class="alert alert-success"> {{ Session::get('rmsg') }} </div> @endif
@if(Session::has('dmsg')) <div class="alert alert-danger"> {{ Session::get('dmsg') }} </div> @endif

@if(count($typerequests))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>Order ID</th>
        <th>{!!$typerequests->sortColumn('name','Name ')!!}</th>
        <th>Forms Available</th>
        <th class="table-actions">Action</th>
    </thead>

    <tbody>
        @foreach($typerequests as $typerequest)
        <tr>
            <td data-title="Order"><span class="xedit" id="{{ $typerequest->id }}" data-name="order_number">{{ $typerequest->order_number }}</span></td>
            <td data-title="Name"><span class="xedit" id="{{ $typerequest->id }}" data-name="name">{{ $typerequest->name }}</span></td>
            
            <td>
            @if(isset($typerequest->forms))
	            @foreach($typerequest->forms as $key => $form)
	            	[{{$key+1}}] {{ $form->name }} <br />
	            @endforeach
            @endif
            </td>
            <td data-title="Action" class="twine">
            	<a href="/settings/request/setrequest/{{$typerequest->id}}" data-hover="tooltip" data-placement="top" title="Setup Request"><i class="glyphicon glyphicon-list-alt"></i></a>
                <a class="remove-link" data-name="{{ $typerequest->name }}" data-href="/controller/settings/removerequest/{{$typerequest->id}}" data-toggle="modal" data-target=".confirm-delete" href="#" data-hover="tooltip" data-placement="top" title="Remove"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$typerequests->sortColumn('','')!!}
</span>
{!!$typerequests->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>


<div class="modal fade confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <strong class="append-name"></strong>, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Remove</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $('.confirm-delete').on('show.bs.modal', function(e) {
        console.log($(e.relatedTarget).data('name'));
    	$(this).find('.append-name').html($(e.relatedTarget).data('name'));
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  });
</script>
@stop