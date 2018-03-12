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
<div class="panel-heading"><h4>NEW FORM REQUEST</h4></div>
<div class="panel-body">

{!!Form::open(['class'=>'submit_now', 'files'=>true])!!}

  <div class="form-group">
    <label for="type_of_request">Type of Request (*)</label>
    {!! Form::select('type_of_request',  $type_req_list, NULL, ['class'=>'form-control', 'id'=>'type_of_request']  ); !!}
  </div>


  <div class="form-group">
    <label for="department">Department (*)</label>
    {!! Form::select('department',  $department_list, NULL, ['class'=>'form-control', 'id'=>'department']  ); !!}
  </div>

  <div class="form-group">
    <label for="urgency">Urgency (*)</label>
  </div>


  @foreach($urgency as $urg)
  <div class="radio">
    <label>
      {!! Form::radio('urgency', $urg->urgency_id) !!}
      {{$urg->urgency_name}}
      <span> ( {{$urg->set_time}} hrs ) </span>
    </label>
  </div>
  @endforeach
  <div id="urgency"></div>
  <hr />

  <div class="form-group">
    <label for="approver">Approver(s) (*)</label>
    {!! Form::text('',NULL,['class'=>'form-control approver', 'id'=>'approver']) !!}
      <div class="approver-selected"></div>
      <br />
      <div class="approver-added">
          <h5 class="selecttitle">Approver: </h5>
      </div>
  </div>

  <div class="form-group">
    <label for="ccperson">CC Person(s) (*)</label>
    {!! Form::text('ccperson',NULL,['class'=>'form-control ccperson', 'id'=>'ccperson']) !!}
    <div class="ccperson-selected"></div>
    <br />
    <div class="ccperson-added">
      <h5 class="selecttitle">CC Persons : </h5>
    </div>
  </div>

  <hr />

  <div class="form-group">
    <label for="title">Title (*)</label>
    {!! Form::text('title',NULL,['class'=>'form-control', 'id'=>'title']) !!}
  </div>

  <div class="form-group">
    <label for="request_details">Request Details (*)</label>
    {!! Form::textarea('request_details', null, ['class' => 'ckeditor form-control', 'id'=>'request_details']) !!}
  </div>

  <div class="form-group">
    <label for="urgency">Document(s) Upload</label>
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
<button type="submit" class="btn btn-default" id="submit">Submit</button>
<button type="submit" class="btn btn-default" id="save_drafts" style="display:none">Save Drafts</button>
<hr />

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
  } else {

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
