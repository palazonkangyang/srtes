@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Setting approver form</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Set Approvers</h4>
        <span class="pos-add-back pull-right"><a href="/settings/request/forms">Back to form List</a></span>
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

            {!!Form::open(['url'=>'/controller/settings/setapprovers','class'=>'formssettings',])!!} 
            {!! Form::input('hidden','id', $form->id) !!}	
			
			<div class="form-group row">
                <label class="col-sm-2 form-control-label">ID #</label>
                <div class="col-sm-9">
                  	<p class="label-ops">{{ $form->id }}</p>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Form Name</label>
                <div class="col-sm-9">
                	<p class="label-ops">{{ $form->name }}</p>
                </div>
              </div>
             <div class="form-group row">
                <label class="col-sm-2 form-control-label">Approval Logic</label>
                <div class="col-sm-9">
                  {!! Form::textarea('approvallogic', $form->approvallogic , ['class' => 'ckeditor form-control', 'id'=>'approvallogic']) !!}
 	
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Message to Approver(s)</label>
                <div class="col-sm-9">
                	    {!! Form::input('text','message', $form->message , array( 'id' => 'message', 'class' => 'form-control')) !!}
            
                </div>
              </div>  
            @if($form->id == 12 || $form->id ==13|| $form->id ==14 || $form->id ==15 || $form->id ==16|| $form->id ==19|| $form->id ==20)
            @else
              <div class="form-group col-md-8" style="padding:0">
                     <label for="group">Flexi Group (*)</label>
          {!! Form::text('flexigroup',NULL,['class'=>'form-control flexigroup', 'id'=>'flexigroup']) !!}
            <br />
			    <label for="approver">Approver(s) (*)</label>
			      {!! Form::text('',NULL,['class'=>'form-control approver-with-me', 'id'=>'approver']) !!}
			      <div class="approver-selected"></div>
			      <br />
			      <div class="approver-added">
			          <h5 class="selecttitle">Approver: </h5>
			          @foreach($approver as $key => $appr)
			             <div><i class="glyphicon glyphicon-minus-sign minus-approver"></i>
			             	<span class="numbering_method"> <strong>[{{$key+1}}st Approver] </strong> <span></span></span> 
			             	@if($appr->Approverlist)
                                        {{$appr->Approverlist->loginname}} 
			             	<small><b>{{$appr->Approverlist->emailadd}}</b></small>
			             	<input type="hidden" name="approver[]" value="{{$appr->Approverlist->idsrc_login}}">
                                        @else
                                        <small><b>{{$appr->Grouplist->name}}</b></small>
                                        <a target="_blank" href="{{url('/flexigroup/viewflexigroup/'.$appr->group_id)}}">click to view</a>                   
                                        <input type="hidden" name="approver[]" value="group_{{$appr->group_id}}">
                                        @endif
			             </div>
			          @endforeach
			      </div>
			  </div>    
            @endif
                    <div class="form-group col-md-8" style="padding:0">
			    <label for="cc">CC(s) (*)</label>
			      {!! Form::text('',NULL,['class'=>'form-control approver-with-me', 'id'=>'ccperson']) !!}
			      <div class="ccperson-selected"></div>
			      <br />
			      <div class="ccperson-added">
			          <h5 class="selecttitle">CC: </h5>
			          @foreach($ccs as $key => $cc)
			             <div><i class="glyphicon glyphicon-minus-sign minus-ccperson"></i>
			             	<span class="numbering_method"> <strong>[{{$key+1}}st CC] </strong> <span></span></span> 
			             	{{$cc->CClist->loginname}} 
			             	<small><b>{{$cc->CClist->emailadd}}</b></small>
			             	<input type="hidden" name="ccperson[]" value="{{$cc->CClist->idsrc_login}}">
			             </div>
			          @endforeach
			      </div>
			  </div>    

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:left">
                <button type="submit" class="btn btn-default">Save Changes</button> 
              </div>
            </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ URL::asset('components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
 var approver_limit = 3;
 var cc_limit = 5;
 
 $(function () {

  $('.minus-approver').on('click', function(e,i){
    $('span.numbering_method').remove();
    $(this).parent().remove();
    append_numbering();
  });
   $('.minus-ccperson').on('click', function(e,i){
    $('span.numbering_method').remove();
    $(this).parent().remove();
    append_numbering();
  });

 });

 </script>
@stop