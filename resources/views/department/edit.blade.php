@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Edit Department</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Edit department form</h4>
        <span class="pos-add-back pull-right"><a href="/department">Back to department List</a></span>
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

            {!!Form::open(['url'=>'/controller/updatedepartment','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id', $id) !!}


              <div class="form-group row">
                <label for="deptname" class="col-sm-3 form-control-label">Department Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','deptname', $department['0']->department , array('placeholder' => 'Department Name', 'id' => 'deptname', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Department Description</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','deptdesc', $department['0']->deptdesc , array('placeholder' => 'Department Description', 'id' => 'deptdesc', 'class' => 'form-control')) !!}
                </div>
              </div>
              
              <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Department Head</label>
                <div class="col-sm-9">
                  	@if(isset($department['0']->hod->loginname)) 
                  		{{-- */ $getname = $department['0']->hod->loginname; /* --}}
                  		{{-- */ $getid = $department['0']->hod->idsrc_login; /* --}}
                  	@else  
                  		{{-- */$getname='';/* --}}
                  		{{-- */$getid='';/* --}}
                  	@endif
                  	
                  	{!! Form::text('department_head',$getname,['placeholder' => 'Choose Department Head', 'class'=>'form-control', 'id'=>'select-user']) !!}
                  	{!! Form::hidden('user_id',$getid) !!}
                  
                </div>
              </div>
             <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Reporting Officer</label>
                <div class="col-sm-9">
                  	@if(isset($department['0']->ro->loginname)) 
                  		{{-- */ $getname = $department['0']->ro->loginname; /* --}}
                  		{{-- */ $getid = $department['0']->ro->idsrc_login; /* --}}
                  	@else  
                  		{{-- */$getname='';/* --}}
                  		{{-- */$getid='';/* --}}
                  	@endif
                  	
                  	{!! Form::text('department_ro',$getname,['placeholder' => 'Choose Reporting Officer', 'class'=>'form-control', 'id'=>'select-user2']) !!}
                  	{!! Form::hidden('user2_id',$getid) !!}
                  
                </div>
              </div>

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <button type="submit" class="btn btn-default">Save Changes</button> 
                 &nbsp; 
                 <a href="#" class="btn btn-danger"  data-href="/controller/removedepartment/{{$id}}" data-toggle="modal" data-target="#confirm-delete">Remove department</a>
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
                <p>You are about to delete <strong>{{$department['0']->department}}</strong>, this procedure is irreversible.</p>
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

	$('#select-user').autocomplete({
	    
	    serviceUrl: '/application/getjsonuser/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
	        
	        if(suggestion.data.id != '') {
		       $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="user_id" /> ');
			}
		 

	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
    
    $('#select-user2').autocomplete({
	    
	    serviceUrl: '/application/getjsonuser/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
	        
	        if(suggestion.data.id != '') {
		       $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="user2_id" /> ');
			}
		 

	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
  });
</script>
@stop