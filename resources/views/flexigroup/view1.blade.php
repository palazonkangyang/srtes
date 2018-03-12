@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">View Group</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Flexible Group</h4>
        <span class="pos-add-back pull-right"><a href="/flexigroup">Back to Group List</a></span>
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

         		
			<div class="form-group row">
                <label class="col-sm-2 form-control-label">ID #</label>
                <div class="col-sm-9">
                  	<p class="label-ops">{{ $flexigroup->id }}</p>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Flexible Group Name</label>
                <div class="col-sm-9">
                	    {!! Form::input('text','name', $flexigroup->name , array( 'id' => 'name', 'class' => 'form-control ','readonly' => true)) !!}
            
                </div>
              </div>  
            
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Full Name</label>
                <div class="col-sm-9">
                	    {!! Form::input('text','full_name', $flexigroup->full_name , array( 'id' => 'full_name', 'class' => 'form-control','readonly' => true)) !!}
            
                </div>
              </div>  
          
              <div class="form-group col-md-8" style="padding:0">
                  
			    <label for="approver">Group members (*)</label>
			    
			      <div class="approver-added">
			          <h5 class="selecttitle">Group member: </h5>
			          @foreach($grouppersons as $key => $appr)
			             <div><i class="glyphicon glyphicon-minus-sign minus-approver"></i>
			             	<span class="numbering_method"> <strong>[{{$key+1}}. Member] </strong> <span></span></span> 
			             	{{$appr->Memberlist->loginname}} 
			             	<small><b>{{$appr->Memberlist->emailadd}}</b></small>
			             	<input type="hidden" name="approver[]" value="{{$appr->Memberlist->idsrc_login}}">
			             </div>
			          @endforeach
			      </div>
			  </div>    
           

          
             
           
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
 var approver_limit = 10;
 var cc_limit = 5;
 
 $(function () {

  $('.minus-approver').on('click', function(e,i){
    $('span.numbering_method').remove();
    $(this).parent().remove();
    append_numbering_group();
  });


 });
 


 </script>
@stop