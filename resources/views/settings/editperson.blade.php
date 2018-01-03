@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Edit Post Setting</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Edit post form</h4>
        <span class="pos-add-back pull-right"><a href="/settings/person">Back to Settings List</a></span>
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

            {!!Form::open(['url'=>'/controller/settings/updatepost','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id', $id) !!}


              <div class="form-group row">
                <label for="deptname" class="col-sm-3 form-control-label">Post</label>
                 <div class="col-sm-9">
                	<p class="label-ops">{{ $typeperson['0']->post }}</p>
                </div>
              </div>

              
              
              <div class="form-group row">
                <label for="deptdesc" class="col-sm-3 form-control-label">Person In Charge</label>
                <div class="col-sm-9">
                  	@if(isset($typeperson['0']->postperson->loginname)) 
                  		{{-- */ $getname = $typeperson['0']->postperson->loginname; /* --}}
                  		{{-- */ $getid = $typeperson['0']->postperson->idsrc_login; /* --}}
                  	@else  
                  		{{-- */$getname='';/* --}}
                  		{{-- */$getid='';/* --}}
                  	@endif
                  	
                  	{!! Form::text('p_userid',$getname,['placeholder' => 'Choose Person In Charge', 'class'=>'form-control', 'id'=>'select-user']) !!}
                  	{!! Form::hidden('user_id',$getid) !!}
                  
                </div>
              </div>
          

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
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
    
  
  });
</script>
@stop