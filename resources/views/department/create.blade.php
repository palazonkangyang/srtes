@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Create new department</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Add department form</h4>
        <span class="pos-add-back pull-right"><a href="/department">Back to User List</a></span>
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

            {!!Form::open(['url'=>'/controller/createdepartment','class'=>'accountsettings',])!!} 

              <div class="form-group row">
                <label for="deptname" class="col-sm-3 form-control-label">Department Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','deptname', Input::old('deptname') , array('placeholder' => 'Department Name', 'id' => 'deptname', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Department Description</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','deptdesc', Input::old('deptdesc') , array('placeholder' => 'Department Description', 'id' => 'deptdesc', 'class' => 'form-control')) !!}
                </div>
              </div>
				
			  <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Choose Department Head</label>
                <div class="col-sm-9">
                    {!! Form::text('department_head',NULL,['placeholder' => 'Choose Department Head', 'class'=>'form-control', 'id'=>'select-user']) !!}
                    {!! Form::hidden('user_id') !!}
                </div>
              </div>
                <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Choose Reporting Officer</label>
                <div class="col-sm-9">
                    {!! Form::text('department_ro',NULL,['placeholder' => 'Choose Reporting Officer', 'class'=>'form-control', 'id'=>'select-user2']) !!}
                    {!! Form::hidden('user2_id') !!}
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12" style="text-align:center">
                  <button type="submit" class="btn btn-default">Create Department</button>
                </div>
              </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#select-user').autocomplete({
		    
		    serviceUrl: '/application/getjsonuser',
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
		    
		    serviceUrl: '/application/getjsonuser',
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
	})
</script>
@stop