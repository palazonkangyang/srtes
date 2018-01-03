@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Setting up request form</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Request form field</h4>
        <span class="pos-add-back pull-right"><a href="/settings/request">Back to request List</a></span>
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

            {!!Form::open(['url'=>'/controller/settings/setforms','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id',$typerequestdetails->id) !!}
			
			
			<div class="form-group row">
                <label for="deptdesc" class="col-sm-2 form-control-label">Order #</label>
                <div class="col-sm-9">
                  	<p class="label-ops">{{ $typerequestdetails->order_number }}</p>
                </div>
              </div>

              <div class="form-group row">
                <label for="deptname" class="col-sm-2 form-control-label">Request Name</label>
                <div class="col-sm-9">
                	<p class="label-ops">{{ $typerequestdetails->name }}</p>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="deptname" class="col-sm-2 form-control-label">Select Form</label>
                <div class="col-sm-5">
                	{!! Form::select('size', $formlist, '', ['id'=>'form-select', 'class'=>'form-control margbot' ]); !!}
                	<button type="button" class="btn btn-success add-request">Add this to request</button>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="selected_form_list" class="col-sm-2 form-control-label">List Of Selected Form </label>
                <div class="col-sm-4">
                	<div class="selected_form">
                	  @foreach($forms as $form)
                	  	<div class="per_form_list"> <i class="glyphicon glyphicon-minus-sign minus-form"></i>{{$form->Formlist->name}}</div>
			            <input type="hidden" name="form[]" class="{{$form->Formlist->id}}" value="{{$form->Formlist->id}}" />
			          @endforeach
                	</div>
                </div>
              </div>

            <div class="form-group row">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-default">Save Changes</button> 
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
		$('.add-request').on('click',function(){
			var form_val = $('#form-select').val();
			var form_opt = $('#form-select option:selected').text();
			var current = $('input[name^="form"]');
			    
			if(form_val != ''){
				if(!checkDuplicate(current, form_val) ){
					console.log('duplicate found!');
				} else {
					$('.selected_form').append('<div class="per_form_list"> <i class="glyphicon glyphicon-minus-sign minus-form"></i>'+form_opt+'</div>');
					$('.selected_form').append('<input type="hidden" name="form[]" class="'+form_opt+'" value="'+form_val+'" />');
				}
			}
		});

		$('.selected_form .per_form_list')
		$('.selected_form').on( "click", ".minus-form", function() {
			$(this).parent().next().remove();
			$(this).parent().remove();
		});
	});

	function checkDuplicate(a,b){
		isValid = true;
			a.each(function() {
			  if(b == this.value){
			  	isValid = false;
			  }
			});
		return isValid;
	}
</script>
@stop