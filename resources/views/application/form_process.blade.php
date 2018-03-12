@extends('layout.master')
@section('title',$title)

@section('content')
  <div class="row">
    <div class="col-md-12"><h4 class="page-head-line align-center">New Application</h4></div>
  </div><!-- end row -->

  <div class="wrap-content">
	   <div class="row">
		     <div class="col-md-12">
		         @if(Session::has('error_message'))
        		  <div class="alert alert-danger alert-dismissible fade in fixed-error">
        		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        		    <strong>{{Session::get('error_message')}}</strong>
        		  </div>
  		        @endif

              <div class="alert alert-danger alert-dismissible fade in fixed-error" id="pending-form" style="display: none;">
        		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        		    <strong>Please complete the respective training evaluation form first.</strong>
        		  </div>

              <div class="panel panel-default">
        				<div class="panel-heading">
                  <h4 class="align-center">CHOOSE TYPE OF REQUEST AND FORMS</h4>
                </div><!-- end panel-heading -->

        				<div class="panel-body">

          				@if(isset($errors) && count($errors))
          				<div class="alert alert-danger margin-bottom-20">
          				  @foreach($errors->all() as $error)
          				   <div class="error-list">{!!$error!!}</div>
          				  @endforeach
          				</div>
          				@endif

        				  {!!Form::open(['method'=>'GET', 'id'=>'new-application', 'files'=>true])!!}
          				<div class="row clear-left request-form">
            				<div>
            					<div class="form-group align-center">
            					   {!! Form::select('type_of_request',  $request, NULL, ['class'=>'form-control margin-bottom-20', 'id'=>'type_of_request']  ); !!}

            					   <div class="form-selected margin-bottom-20">
            					   		<select class="form-control forms-area hide" name="forms" id="type_form">
            					   		</select>
            					   </div>
            					   <button type="submit" class="btn btn-default hide" id="submit">Submit</button>
            					</div>
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

		$('select[name=forms]').on('change', function(){
			getVal = $(this).val();

			if(getVal != '')
      {
				$('#submit').removeClass('hide').addClass('show');
			}

      else
      {
				$('#submit').removeClass('show').addClass('hide');
			}
		});

		$('select[name=type_of_request]').on('change', function() {
			getValue = $(this).val();
			token = $('input[name=_token]').val();

			if(getValue != '')
      {
				$.ajax({
		      type: 'GET',
		      data: {
		       _token: token,
			     request_id: getValue
		      },
		      url:  domain + 'controller/settings/getforms',
		      beforeSend:function()
          {
		      },

          error: function(xhr, textStatus, errorThrown)
          {
		        /*for (var key in xhr.responseJSON.errors) {
		          if (key === 'length' || !xhr.responseJSON.errors.hasOwnProperty(key)) continue;
		            var value = xhr.responseJSON.errors[key];
		            $('#'+key).after('<div class="alert alert-danger error-list">'+value+'</div>')
		          }*/
		       },

		       success : function ( response ) {

		         $('.forms-area').html('');
		         $('.forms-area').addClass('show');

  						for(var i = 0; i < response.forms.length; i++){
  							options = '<option value="'+response.forms[i].id+'">'+response.forms[i].name+'</option>';
  							$('.forms-area').append(options);
  						}

						  var valOfform = $('.forms-area').val();

						if(valOfform != '')
            {
							$('#submit').removeClass('hide').addClass('show');
						}

            else
            {
							$('#submit').removeClass('show').addClass('hide');
						}
		       },

		       complete : function (){
		       }
		     });
			}

      else
      {
				$('.forms-area').html('').removeClass('show').addClass('hide');
			}
		});

    // $("#submit").click(function() {
    //
    //   var trueorfalse = false;
    //   var type_form = $("#type_form").val();
    //
    //   var formData = {
		// 		_token: $('meta[name="csrf-token"]').attr('content'),
		// 		type_form: type_form
		// 	};
    //
    //   $.ajax({
		// 		type: 'GET',
		// 		url: "/application/pending-status",
		// 		data: formData,
    //     async: false,
		// 		dataType: 'json',
		// 		success: function(response)
		// 		{
    //       if(response['no_of_pending'] == 0)
    //       {
    //         $('#pending-form').hide();
    //         trueorfalse = true;
    //       }
    //
    //       else
    //       {
    //         $('#pending-form').show();
    //         trueorfalse = false;
    //       }
		// 		},
    //
		// 		error: function (response) {
		// 			console.log(response);
		// 		}
		// 	});
    //
    //   return trueorfalse;
    // });
	});
</script>
@stop
