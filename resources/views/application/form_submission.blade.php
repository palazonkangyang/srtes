@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">New Application</h4></div>
</div>

<div class="wrap-content">
<div class="alert-danger">
      @foreach($errors->all() as $error)
          <div class="error-list">{!!$error!!}</div>
      @endforeach
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading"><h4>NEW FORM REQUEST ({{$request[0]->name}} - {{ $form[0]->name }})</h4></div>
<div class="panel-body">

{!!Form::open(['class'=>'submit_now', 'files'=>true])!!}

{!! Form::hidden('type_request', $request[0]->name )!!}
{!! Form::hidden('type_form', $form[0]->id )!!}
{!! Form::hidden('department', $department[0]->department )!!}
<div class="alert alert-info alert-dismissible fade in fixed-error">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong> Message to Requestors : {{ $form[0]->message }}</strong>
  </div>
<div class="row form-details">
	<div class="col-md-6">
		<div class="clear-both box-scale">
			<h4>My Form Details</h4>
			<div class="info">
				<span class="labeler">Type of Request:</span>
				<span> {{ $request[0]->name }} </span>
			</div>
			<div class="info">
				<span class="labeler">Form:</span>
				<span> {{ $form[0]->name }} </span>
			</div>
			<div class="info">
				<span class="labeler">*Note: </span><span>We will notify your email address regarding the updates of forms</span>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="clear-both box-scale">
			<h4>My Information</h4>
			<div class="info">
				<span class="labeler">Full Name:</span>
				<span> {{ Auth::user()->loginname }} </span>
			</div>
			<div class="info">
				<span class="labeler">Email:</span>
				<span> {{ Auth::user()->emailadd }} </span>
			</div>
			<div class="info">
				<span class="labeler">Department:</span>
				<span> {{ $department[0]->department }} ({{$department[0]->deptdesc}}) </span>
			</div>
		</div>
	</div>
</div>

<!-- Select forms here conditional -->
<div class="row form-area-with-inputs">
	<div class="col-md-12">
	<h4>Please fillup the form below: require(*)</h4>

	<div class="row form-repeated">
		<div class="col-md-6">

      @if($form[0]->id == 1 || $form[0]->id == 15)

        <div class="form-group">
      <!--          <label for="group">Flexi Group (*)</label>
          {!! Form::text('flexigroup',NULL,['class'=>'form-control flexigroup', 'id'=>'flexigroup']) !!}
            <br />
       -->
          <label for="approver">Approvers (*)</label>
          {!! Form::text('approver',NULL,['class'=>'form-control approver', 'id'=>'approver']) !!}
            <div class="approver-selected"></div>
            <br />
            <div class="approver-added">
                <h5 class="selecttitle">Verifier/Approvers: </h5>
            </div>
        </div>
       @elseif( $form[0]->id == 14)
       <div class="form-group">
          <label for="approver">Please select one Verifier/approvers only (*)</label>
          {!! Form::text('approver',NULL,['class'=>'form-control approver', 'id'=>'approver_project_claims']) !!}
            <div class="approver-selected"></div>
            <br />
            <div class="approver-added">
                <div class="approver-added1">
                <h5 class="selecttitle">Verifier/Approvers: </h5>
      </div>
     <div class="approver-added2">
		           @foreach($approverlist as $keynote => $appr)

		      			@if($keynote+1 == 1)
		      				{{-- */$word='Approver';/* --}}
		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='2nd Verify';/* --}}
		      			@elseif($keynote+1 == 3)
		      				{{-- */$word='3rd Verify';/* --}}
		      			@else($keynote+1 == 4)
		      				{{-- */$word='th';/* --}}

                                        @endif
		      			<div id="approver_{{$keynote+2}}" class="hide"><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}" value="{{ $appr->idsrc_login }}"></div>
		      			@endforeach
                                          </div>
                </div>
        </div>
      @elseif( $form[0]->id == 12)
       <div class="form-group">
          <label for="approver">Please select one Verifier/approvers only (*)</label>
          {!! Form::text('approver',NULL,['class'=>'form-control approver', 'id'=>'approver_cashadvance_acquittal']) !!}
            <div class="approver-selected"></div>
            <br />
            <div class="approver-added">
                <div class="approver-added1">
                <h5 class="selecttitle">Verifier/Approvers: </h5>
                 @foreach($approverlist as $keynote => $appr)

		      		@if($keynote+1 == 1)
		      				{{-- */$word='1st Verify';/* --}}
                                                	<div id="approver_{{$keynote+1}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}" value="{{ $appr->idsrc_login }}"></div>

		      				@endif
                                        @endforeach
      </div>

                   <div class="approver-added3">
		            @foreach($approverlist as $keynote => $appr)

		      		@if($keynote+1 == 1)

		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='3rd Verify';/* --}}
                                                	<div id="approver_{{$keynote+2}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}" value="{{ $appr->idsrc_login }}"></div>

		      			@elseif($keynote+1 == 3)
                                                {{-- */$word='Approver';/* --}}
                                                	<div id="approver_{{$keynote+2}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}" value="{{ $appr->idsrc_login }}"></div>

		      			@endif
                                        @endforeach
                                          </div>
                </div>
        </div>
        @else

           <div class="form-group">
		   		<label for="approver">Verifier/Approver(s)</label>

		      <div class="approver-added">
		          <h5 class="selecttitle">Verifier/Approvers: </h5>
                            {{-- */$len = count($approverlist);/* --}}

                          @if($form[0]->id == 13)
                          @foreach($approverlist as $keynote => $appr)

		      			@if($keynote+1 == 1)
		      				{{-- */$word='1st Verify';/* --}}
                                                	<div id="approver_{{$keynote+1}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}" value="{{ $appr->idsrc_login }}"></div>

		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='Approver';/* --}}
                                                	<div id="approver_{{$keynote+1}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}" value="{{ $appr->idsrc_login }}"></div>
		      	              	<div id="approver_{{$keynote+2}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[2rd Verify] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}" value="{{ $appr->idsrc_login }}"></div>

		      			@elseif($keynote+1 == 3)
                                                {{-- */$word='Approver';/* --}}
                                  <div id="approver_{{$keynote+2}}" class="hide" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[Approver] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}" value="{{ $appr->idsrc_login }}"></div>


		      			@endif
		      		@endforeach

                          @elseif($form[0]->id == 20)
		           @foreach($approverlist as $keynote => $appr)
		      			  @if ($keynote == $len - 1)
                                     	{{-- */$word='Approver';/* --}}

                                   @else
		      			@if($keynote+1 == 1)
		      				{{-- */$word='1st Verify';/* --}}
		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='2nd Verify';/* --}}
		      			@elseif($keynote+1 == 3)
		      				{{-- */$word='3rd Verify';/* --}}
		      			@else($keynote+1 == 4)
		      				{{-- */$word='th';/* --}}
		      			@endif
                                        @endif
		      			<div id="approver_{{$keynote+1}}" class="hide"><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[{{$word}}] </strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}" value="{{ $appr->idsrc_login }}"></div>
		      		@endforeach
                            @elseif($form[0]->id == 19)
                          @foreach($approverlist as $keynote => $appr)
		      		@if($department[0]->idsrc_departments == 1 || $department[0]->idsrc_departments == 6 )
                                 @if($keynote+1 == 1)
                                    <div id="approver_{{$keynote+1}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[1st Verifier]</strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}"   value="{{ $appr->idsrc_login }}"></div>
		      		    <div id="approver_{{$keynote+2}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[2rd Verifier]</strong> <span></span></span> <a target="_blank" href="{{url('/flexigroup/viewflexigroup/2')}}">click to view</a><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}"   value="group_2"></div>
                                        @elseif($keynote+1 == 2)
                                    <div id="approver_{{$keynote+2}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[Approver]</strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}"   value="{{ $appr->idsrc_login }}"></div>
                                 	@endif
                                @else
                                    @if($keynote+1 == 1)
                                    <div id="approver_{{$keynote+1}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[1st Verifier]</strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}"   value="{{ $appr->idsrc_login }}"></div>
		      		  <div id="approver_{{$keynote+2}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[2rd Verifier]</strong> <span></span></span> <a target="_blank" href="{{url('/flexigroup/viewflexigroup/2')}}">click to view</a><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}"   value="group_2"></div>
                                         @elseif($keynote+1 == 2)
                                     <div id="approver_{{$keynote+2}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[3rd Verifier]</strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}"   value="{{ $appr->idsrc_login }}"></div>
                                      @else($keynote+1 == 3)
                                     <div id="approver_{{$keynote+2}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong>[Approver]</strong> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="approver[]" id="approverfield_{{$keynote+2}}"   value="{{ $appr->idsrc_login }}"></div>
		      			@endif

                                        @endif
                                        @endforeach
                          @else

		           @foreach($approverlist as $keynote => $appr)

		      			  @if ($keynote == $len - 1)
                                     	{{-- */$word='Approver';/* --}}

                                   @else

		      			@if($keynote+1 == 1)
		      				{{-- */$word='1st Verify';/* --}}
		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='2rd Verify';/* --}}
		      			@elseif($keynote+1 == 3)
		      				{{-- */$word='3rd Verify';/* --}}
		      			@else($keynote+1 == 4)
		      				{{-- */$word='4rd Verify';/* --}}
		      			@endif
                                        @endif
                                        @if($appr['emailadd'] !='url')
		      			                           <div class="approver-list" id="approver_{{$keynote+1}}" >
                                             <i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i>
                                             <span class="numbering_method"> <strong></strong> <span></span></span>
                                             {{ $appr['loginname'] }} <small><b>{{ $appr['emailadd'] }}</b></small>
                                             <input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}" value="{{ $appr['idsrc_login'] }}"><br />
                                             <span class="numbering_method"> <strong>[Replacer]</strong> <span></span></span>
                                             {{ $appr['temp_approver_loginname'] }} <small><b>{{ $appr['temp_approver_emailadd'] }}</b></small>
                                             <input type="hidden" name="temp_approver[]" value="{{ $appr['temp_approver_id'] }}">
                                           </div>
                                        @else
                                        <div class="approver-list" id="approver_{{$keynote+1}}" ><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <strong></strong> <span></span></span> {{ $appr['loginname'] }} <a target="_blank" href="{{url('/flexigroup/viewflexigroup/'.$appr['idsrc_login'])}}">click to view</a> <input type="hidden" name="approver[]" id="approverfield_{{$keynote+1}}"  value="group_{{ $appr['idsrc_login'] }}"></div>
                                        @endif
                                        @endforeach


                                @endif
		      </div>
		  	</div>
        @endif



  @if($form[0]->id == 1)
		  	<div class="form-group">
				<label for="urgency">Urgency (*)</label>
				<div class="radio">
				@foreach($urgency as $urg)
				 <label>
				      {!! Form::radio('urgency', $urg->urgency_id) !!}
				      {{$urg->urgency_name}}
				      <span> ( {{$urg->set_time}} hrs ) </span>
				    </label>
				@endforeach
				 </div>
				 <div id="urgency"></div>
			</div>
           @else
            <input type="hidden" name="urgency" value="1">
            @endif
		</div>
		<div class="col-md-6">
		<div class="form-group">
		    <label for="ccperson">Select CC Person(s)</label>
		    {!! Form::text('ccperson',NULL,['class'=>'form-control ccperson', 'id'=>'ccperson']) !!}
		    <div class="ccperson-selected"></div>
		    <br />
		    <div class="ccperson-added">
		      <h5 class="selecttitle">CC Persons : </h5>

                       @foreach($cclist as $keynote => $appr)

		      			@if($keynote+1 == 1)
		      				{{-- */$word='st';/* --}}
		      			@elseif($keynote+1 == 2)
		      				{{-- */$word='nd';/* --}}
		      			@elseif($keynote+1 == 3)
		      				{{-- */$word='rd';/* --}}
		      			@else($keynote+1 == 4)
		      				{{-- */$word='th';/* --}}
		      			@endif
		      			<div><i class="glyphicon glyphicon-minus-sign minus-approver-disabled"></i><span class="numbering_method"> <span></span></span> {{ $appr->loginname }} <small><b>{{ $appr->emailadd }}</b></small><input type="hidden" name="ccperson[]" value="{{ $appr->idsrc_login }}"></div>
		      		@endforeach

		    </div>
		</div>
		</div>
  	</div>
  	<hr />

		@if($form[0]->id == 2)
		 	@include('forms.form_rcp')
		@elseif($form[0]->id == 3)
		 	@include('forms.form_rca')
		@elseif($form[0]->id == 4)
		 	@include('forms.form_area')
		@elseif($form[0]->id == 5)
		 	@include('forms.form_arge')
		@elseif($form[0]->id == 6)
		 	@include('forms.form_cdsaa')
		@elseif($form[0]->id == 7)
		 	@include('forms.form_rdra')
		@elseif($form[0]->id == 8)
		 	@include('forms.form_atac')
		@elseif($form[0]->id == 9)
		 	@include('forms.form_hphcrf')
		@elseif($form[0]->id == 10)
		 	@include('forms.form_mjr')
		@elseif($form[0]->id == 11)
		 	@include('forms.form_pgvbf')
    @elseif($form[0]->id == 12)
		 	@include('forms.form_sorapfca')
    @elseif($form[0]->id == 13)
		 	@include('forms.form_aca')
    @elseif($form[0]->id == 14)
			@include('forms.form_pcmcf')
    @elseif($form[0]->id == 20)
		 	@include('forms.form_pcmcf2')
    @elseif($form[0]->id == 15)
			@include('forms.form_mrf')
    @elseif($form[0]->id == 16)
		 	@include('forms.form_tsw')
    @elseif($form[0]->id == 17)
		 	@include('forms.form_irfi')
    @elseif($form[0]->id == 18)
		 	@include('forms.form_coprpo')
    @elseif($form[0]->id == 19)
		 	@include('forms.form_eoq')

		@else
			@include('forms.form_default')
		@endif


	<div class="margin-top-30"></div>
	<hr />
	</div>
</div>
<!-- end selected forms -->

<div class="form-group margin-top-30">
     @if($form[0]->id == 15)
     <label for="urgency">Please attached JD of this position </label>
    @else
  <label for="urgency">Attachment(s) Upload (optional)</label>
  @endif
</div>
<div class="clear-left">
  <div class="wrap-zone">
  <div id="fileUpload" class="dropzone">
  <div class="dz-message" data-dz-message><span>Drop files here <br />or Click to Upload</span></div>
  </div>
  <div class="err-file"></div>
</div>

<div id="google-box">
  <button type="button" class="btn btn-default btn-lg" id="pick" >
  <i class="glyphicon glyphicon-paperclip"></i> Add Google Doc Links
  </button>
  <div class="google-list"></div>
  </div>
</div>
<div class="clear-left"><div class="file-list"></div></div>



<hr />
@if($form[0]->id == 13)
<button type="submit" class="btn btn-default" id="submit" onclick="return ACAjevent();" >Submit</button>
@elseif($form[0]->id == 14 || $form[0]->id == 20)
<button type="submit" class="btn btn-default" id="submit" onclick="return PCMCFjevent();" >Submit</button>
@elseif($form[0]->id == 19)
<button type="submit" class="btn btn-default" id="submit" onclick="return EOQjevent();" >Submit</button>
@elseif($form[0]->id == 18)
<button type="submit" class="btn btn-default" id="submit" onclick="return Coprpoevent();" >Submit</button>
@else
<button type="submit" class="btn btn-default" id="submit" >Submit</button>
@endif

@if($form[0]->id == 1)
  <button type="submit" class="btn btn-default" style="display: none" id="save_drafts">Save Drafts</button>
@endif

{!!Form::close()!!}
</div>
</div>
</div>
</div>

</div>

<script src="{{ URL::asset('js/dropzone.js') }}"></script>
<script type="text/javascript">
var approver_limit = 4;
var cc_limit = 20;

 $(function () {

	 $('.minus-approver').on('click', function(e,i){
	    $('span.numbering_method').remove();
	    $(this).parent().remove();
	    append_numbering();
	  });

	  $('.minus-ccperson').on('click', function(e,i){
	    $(this).parent().remove();
	  });

	$("input, textarea, select").change(function() {
		$('#save_drafts').fadeIn();
	});

  CKEDITOR.config.removePlugins = 'about,link';
  Dropzone.autoDiscover = false;

  var baseUrl = "{{ url('/') }}";
  var token = "{{ Session::getToken() }}";
  var AppFile = new Dropzone("div#fileUpload", {
            url: baseUrl+"/controller/uploadFiles",
            params: {
              _token: token
            }
      });

      Dropzone.options.AppFile = {
          paramName: "file", // The name that will be used to transfer the file
          addRemoveLinks: true,
      };

      AppFile.on("error", function(file, done) {
          console.log(file);
      });

      AppFile.on("addedfile", function(file, done) {
          var removeButton = Dropzone.createElement('<div class="remove-x"><button>Remove</button></div>');
          var _this = this;
          var name = file.name;

          if (this.files.length) {
              var _i, _len;
              for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
              {
                  if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                  {
                      this.removeFile(file);
                  }
              }
          }
          removeButton.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            _this.removeFile(file);

              filrem =  $('.file-list input[data-file-name="'+name+'"]').val();
              filinput = $('.file-list input[data-file-name="'+name+'"]').parent().remove();

              $.ajax({
                  type: 'GET',
                  url: '/controller/removeFiles/'+filrem,
                  dataType: 'html',
                  success: function(data) {
                     console.log(data);
                  },
              });

          });
          file.previewElement.appendChild(removeButton);
      });

      AppFile.on("success", function(file, responseText) {
         var _ref;

           if(responseText.errors) {
              var errormsg = responseText.errors.file;

              this.removeFile(this.files);
              $('.err-file > span').remove();
              $('.err-file').append('<span class="alert alert-danger">'+errormsg+'<span>');
              setTimeout(function(){
                  $('.err-file > span').remove();
                }, 6000);

              return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
           }

           if(responseText.status){
              $('.file-list').append('<div class="filesperline"><input data-file-name="'+responseText.file_name+'" type="hidden" name="fileurl[]" value="'+responseText.file_url+'" /> <input data-file-name="'+responseText.file_name+'" type="hidden" name="filename[]" value="'+responseText.file_name+'" /> <input data-file-name="'+responseText.file_name+'" type="hidden" name="mimetype[]" value="'+responseText.mimetype+'" /></div>');
           }
           else{

            this.removeFile(this.files);
            $('.err-file > span').remove();
            $('.err-file').append('<span class="alert alert-danger">Error. Size is too big to upload! Limit size: 3MB<span>');
            setTimeout(function(){
                $('.err-file > span').remove();
              }, 6000);
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

           }
      });

$('.google-list').on('click','.remove-doc',function(e){
    e.preventDefault();
    $(this).parent().remove();
});

$('form').submit(function(event) {
  var sendAction = $(this).find("button[type=submit]:focus" ).attr('id');

  if(sendAction == 'submit'){
    event.preventDefault();

    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }
    var form = $(this);
    var formdata = new FormData($("form")[0]);
    var progressTrigger;

    alert(JSON.stringify(formdata));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url     : '/controller/application/store',
        type    : form.attr("method"),
        data    : formdata,
        dataType: "json",
        processData: false,
        contentType: false,
        beforeSend:function(){
            $('.error-list').remove();
            $('.error-beside-submit').remove();
            $('.dz-hidden-input, form input, form textarea, form select, form radio, form button').prop('disabled', true);

            form.find('#submit').after('<span class="processing-time"><i class="fa fa-spinner fa-spin"></i> Submitting request. Please wait for awhile.</span>');
            form.find('#submit').css('display','none');

            progressTrigger = setTimeout(function(){
              $('.processing-time').remove();
              form.find('#submit').after('<span class="processing-time"><i class="fa fa-spinner fa-spin"></i> Sending notifications to selected Approver(s) and CC person(s)</span>');
            }, 4000);

        },

        error: function(xhr, textStatus, errorThrown) {

               for (var key in xhr.responseJSON.errors) {
                    if (key === 'length' || !xhr.responseJSON.errors.hasOwnProperty(key)) continue;
                    var value = xhr.responseJSON.errors[key];
                    $('#'+key).after('<div class="alert alert-danger error-list">'+value+'</div>')
                }

                form.find('.processing-time').remove();
                form.find('#submit').css({'display':'block'});
                form.find('#submit').after('<div class="alert-danger error-beside-submit">Error: Please check your form for an error.</div>')
                $('.dz-hidden-input, form input, form textarea, form select, form radio, form button').prop('disabled', false);

        },


        success : function ( data )
        {
            console.log(data);

            $('form').fadeOut().remove();
            $('.panel-body').append('<div class="form-group alert alert-success"> <b>Form</b> has successfully submitted!. To view the details of your submitted form. Please <a href="/application/view_details/'+data.form_id+'"><b>click here</b></a> </div>');

        },

        complete : function (){
            clearTimeout(progressTrigger);
        }
    })
  } else {

    $('form').attr('action', "/controller/history/save_drafts");

  }
  });
 });
</script>

<script src="{{ URL::asset('components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('js/filepicker.js') }}"></script>
<script src="{{ URL::asset('js/general.config.js') }}"></script>
<script src="https://www.google.com/jsapi?key=AIzaSyCxQ1OXoUZBqgFtFsuTO2a4G1mlcGRCP1g"></script>
<script src="https://apis.google.com/js/client.js?onload=initPicker"></script>

@stop
