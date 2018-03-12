@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Edit Designation</h4>
	</div><!-- end col-md-12 -->
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">

    <div class="col-md-12">

      <div class="panel panel-default">

        <div class="panel-heading">
					<h4>Edit designation form</h4>
					<span class="pos-add-back pull-right">
						<a href="/tes/course/designation/">Back to Designation List</a>
					</span>
				</div><!-- end panel-heading -->

        <div class="panel-body">

          @if(Session::has('success'))

            <div class="alert-success" style="margin-bottom:20px;">
          	   <div class="success-msg">
          		     <span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}
          			</div><!-- end success-msg -->
          	</div><!-- end alert-success -->

          @elseif($errors->all())

            <div class="alert-danger padding" style="margin-bottom:20px;">

              @foreach($errors->all() as $error)
          		  <div class="error-list">
          			  <span class="glyphicon glyphicon-remove"></span> {!! $error !!}
          		  </div><!-- end error-list -->
              @endforeach

            </div><!-- end alert-danger -->

          @endif

          {!! Form::open(['url'=>'/controller/tes/course/designation/edit-designation/'.$selected_designation_list->id,'class'=>'designation-list',]) !!}

            <div class="form-group row">
  						<label for="" class="col-sm-2 form-control-label">Name</label>
  						<div class="col-sm-9">
  							{!! Form::input('text','name', $selected_designation_list->name, array('placeholder' => 'Designation Name', 'id' => 'designation-name', 'class' => 'form-control')) !!}
  						</div><!-- end col-sm-9 -->
  					</div><!-- end form-group -->

            <div class="form-group row">
  						<div class="col-sm-12" style="text-align:center">
  							<button type="submit" class="btn btn-default">Save Changes</button>
  							 &nbsp;
  							 <a href="#" class="btn btn-danger"  data-href="/tes/course/designation/remove-designation/{{ $selected_designation_list->id }}" data-toggle="modal" data-target="#confirm-delete">Remove Designation</a>
  						</div><!-- end col-sm-12 -->
  					</div><!-- end form-group -->

          {!! Form::close() !!}

        </div><!-- end panel-body -->

      </div><!-- end panel panel-default -->

    </div><!-- end col-md-12 -->

  </div><!-- end row -->

</div><!-- end wrap-content -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Delete</h4>
      </div><!-- end modal-header -->

      <div class="modal-body">
        <p>You are about to delete <strong>{{$selected_designation_list->name}}</strong>, this procedure is irreversible.</p>
        <p>Do you want to proceed?</p>
      </div><!-- end modal-body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok">Remove</a>
      </div><!-- end modal-footer -->
    </div><!-- end modal-content -->
  </div><!-- end modal-dialog -->
</div><!-- end modal -->

<script type="text/javascript">

  $(document).ready(function(){

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

  });

</script>

@stop
