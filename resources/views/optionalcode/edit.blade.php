@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Edit Cost Centre</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Edit Cost Centre form</h4>
        <span class="pos-add-back pull-right"><a href="/accountcode">Back to Cost Centre List</a></span>
      </div>
        <div class="panel-body">

          @if(Session::has('success'))
              <div class="alert-success" style="margin-bottom:20px;">
                  <div class="success-msg"><span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}</div>
              </div>
          @elseif($errors->all())
            <div class="alert-danger padding" style="margin-bottom:20px;">
            @foreach($errors->all() as $error)
              <div class="error-list"> <span class="glyphicon glyphicon-remove"></span> {!!$error!!}</div>
            @endforeach
            </div>
          @endif

            {!!Form::open(['url'=>'/controller/updateoptionalcode','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id', $id) !!}
 

              <div class="form-group row">
                <label for="name" class="col-sm-3 form-control-label">Cost Centre Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','name', $optionalcode['0']->name , array('placeholder' => 'Cost Centre Name', 'id' => 'name', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-sm-3 form-control-label">Description</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','description', $optionalcode['0']->description , array('placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control')) !!}
                </div>
              </div>
              
             
             

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <button type="submit" class="btn btn-default">Save Changes</button> 
                 &nbsp; 
                 <a href="#" class="btn btn-danger"  data-href="/controller/removeoptionalcode/{{$id}}" data-toggle="modal" data-target="#confirm-delete">Remove Optional Code</a>
              </div>
            </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <strong>{{$optionalcode['0']->name}}</strong>, this procedure is irreversible.</p>
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

	$('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

	
  
  });
</script>
@stop