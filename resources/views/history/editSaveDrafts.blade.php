@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">New Application - Save Drafts</h4></div>
</div>

<div class="wrap-content">
    @if(Session::has('success'))
    <div class="container flash">
        <div class="alert alert-success alert-dismissible fade in fixed-error">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong> {{ Session::get('success') }}</strong>
        </div>
    </div>
    @endif
    <div class="alert-danger"> 
        @foreach($errors->all() as $error)
            <div class="error-list">{!!$error!!}</div>
        @endforeach
    </div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>SAVE DRAFTS</h4></div>
                <div class="panel-body">

{!!Form::open(['class'=>'submit_now', 'files'=>true])!!}  
{!! Form::input('hidden','appid',$app->id) !!}
{!! Form::hidden('type_request',  $app->type_request )!!}
{!! Form::hidden('type_form', $afm->id )!!}
{!! Form::hidden('department', $department[0]->department )!!}

<div class="row form-details">
    <div class="col-md-6">
        <div class="clear-both box-scale">
            <h4>My Form Details</h4>
            <div class="info">
                <span class="labeler">Type of Request:</span> 
                <span> {{ $app->type_request }} </span>
            </div>
            <div class="info">
                <span class="labeler">Form:</span> 
                <span> {{ $afm->name }} </span>
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

<div class="row form-area-with-inputs">
    <div class="col-md-12">
    <h4>Please fillup the form below: require(*)</h4>
        <div class="row form-repeated">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="approver">Approver(s) (*)</label>
                    {!! Form::text('',NULL,['class'=>'form-control approver', 'id'=>'approver']) !!}
                    <div class="approver-selected"></div>
                    <br />
                    <div class="approver-added">
                        <h5 class="selecttitle">Approver:</h5>
                        @foreach($approver as $key=>$appr)
                            <div><i class="glyphicon glyphicon-minus-sign minus-approver"></i><span class="numbering_method"> <strong>[{{$key+1}}st Approver] </strong> <span></span></span> {{$appr->approver_name}} <small><b>{{$appr->approver_email}}</b></small><input type="hidden" name="approver[]" value="{{$appr->approver_user_id}}"></div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="urgency">Urgency (*)</label>
                    @foreach($urgency as $urg)
                        <div class="radio">
                            <label>
                                @if($app->urgency == $urg->urgency_id)
                                    {!! Form::radio('urgency', $urg->urgency_id, 'checked') !!}
                                @else
                                    {!! Form::radio('urgency', $urg->urgency_id) !!}
                                @endif
                                {{$urg->urgency_name}} <span> ( {{$urg->set_time}} hrs ) </span>
                            </label>
                        </div>
                    @endforeach
                    <div id="urgency"></div>
                </div>
          </div>
          
          <div class="col-md-6">
                <div class="form-group">
                    <label for="ccperson">CC Person(s) (*)</label>
                        {!! Form::text('ccperson',NULL,['class'=>'form-control ccperson', 'id'=>'ccperson']) !!}
                        <div class="ccperson-selected"></div>  
                        <br />
                    <div class="ccperson-added">
                        <h5 class="selecttitle">CC Persons : </h5>
                        @foreach($ccperson as $key=>$ccper)
                            <div><i class="glyphicon glyphicon-minus-sign minus-ccperson"></i> {{$ccper->ccperson_name}} <small><b>{{$ccper->ccperson_email}}</b></small><input type="hidden" name="ccperson[]" value="{{$ccper->ccperson_user_id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <div class="form-group">
            <label for="title">Title (*)</label>
            {!! Form::text('title',$app->title,['class'=>'form-control', 'id'=>'title']) !!}
        </div>

        <div class="form-group">
            <label for="request_details">Request Details (*)</label>
            {!! Form::textarea('request_details', $app->request_details, ['class' => 'ckeditor form-control', 'id'=>'request_details']) !!}
        </div>
        <div class="margin-top-30"></div>
        <hr />
    </div>
</div>

<div class="form-group">
    <label for="urgency">Attachment(s) Upload</label>
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
        <div class="google-list">
            @foreach($doc as $key=>$document)
                <div class="eachgooglelist"><i class="glyphicon glyphicon-trash remove-doc"></i> <a href="{{$document->document_link}}" target="_blank">{{$document->document_name}}</a> <input type="hidden" name="google_doc_name[]" value="{{$document->document_name}}"> <input type="hidden" name="google_doc_link[]" value="{{$document->document_link}}"></div>
            @endforeach
        </div>
    </div>
</div>

@if($files->count() != 0)
    <div class="clear-left">
        <div class="display_files col-md-5 nopadding">
            <p class="head-title-file">List of files</p>
            @foreach($files as $file)
                <div class="perfiles"> 
                    @if($file->files_mimes == 'application/pdf')
                        <a href="/application/view/file/tmp/{{ $file->files_fileurl }}/pdf" target="_blank">
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>
                    @elseif($file->files_mimes == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                        <a href="/application/view/file/tmp/{{ $file->files_fileurl }}/docx" target="_blank">
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>    
                    @elseif($file->files_mimes == 'application/msword')
                        <a href="/application/view/file/tmp/{{ $file->files_fileurl }}/doc" target="_blank">
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>
                    @elseif(($file->files_mimes == 'application/vnd.ms-excel'))
                        <a href="/application/view/file/tmp/{{ $file->files_fileurl }}/xls" target="_blank">
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>
                    @elseif($file->files_mimes == 'image/jpeg' || $file->files_mimes == 'image/png')
                        <a href="/application/download/file/tmp/{{ $file->files_fileurl }}" alt="{{ $file->files_filename }}" target="_blank"  data-imagelightbox="bx" > 
                            <img class="hidden-thumb-image" alt="{{ $file->files_filename }}" src="/uploads/tmp/{{ $file->files_fileurl }}" />
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>
                    @else
                        <a href="/application/download/file/tmp/{{ $file->files_fileurl }}" > 
                            <div class="col-md-9"><i class="fa fa-file"></i> {{ str_limit($file->files_filename) }}</div>
                        </a>
                    @endif
                    <a href="#" class="alignright-pos remove-file">Remove File</a>
                    <input data-file-name="{{$file->files_filename}}" type="hidden" name="fileurl[]" value="{{$file->files_fileurl}}"> <input data-file-name="{{$file->files_filename}}" type="hidden" name="filename[]" value="{{$file->files_filename}}"> <input data-file-name="{{$file->files_filename}}" type="hidden" name="mimetype[]" value="{{$file->files_mimes}}">
                </div>
            @endforeach
        </div>
    </div>
@endif
<div class="clear-left"><div class="file-list"></div></div>
<hr />
    <button type="submit" class="btn btn-default" id="submit">Submit</button>
      <button type="submit" class="btn btn-default" id="delete_drafts">Delete Drafts</button>
    <button type="submit" class="btn btn-default" id="save_drafts">Save Drafts</button>
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
  

  $('a.remove-file').on('click',function(e){
    e.preventDefault();
    $(this).parent().fadeOut(function(){
        $(this).remove();
    });
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
         
            $('form').fadeOut().remove();
            $('.panel-body').append('<div class="form-group alert alert-success"> <b>Form</b> has successfully submitted!. To view the details of your submitted form. Please <a href="/application/view_details/'+data.form_id+'"><b>click here</b></a> </div>');                
         
        },

        complete : function (){
            clearTimeout(progressTrigger);
        }   
    })
   } else if (sendAction == 'delete_drafts'){
     
    $('form').attr('action', "/controller/history/delete_drafts");

  } else  {
     
    $('form').attr('action', "/controller/history/save_drafts");

  }
  });
 });
</script>

<script src="{{ URL::asset('components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ URL::asset('js/filepicker.js') }}"></script>
<script src="{{ URL::asset('js/general.config.js') }}"></script>
<script src="https://www.google.com/jsapi?key=AIzaSyCEVf50-oJRzChB7Q_fd8GEf70MKXjeWfA"></script>
<script src="https://apis.google.com/js/client.js?onload=initPicker"></script>


@stop