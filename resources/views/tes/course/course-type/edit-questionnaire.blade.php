@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Edit Questionnaire</h4>
	</div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="row">

		<div class="col-md-12">

      <div class="panel panel-default">

        <div class="panel-heading">
					<h4>Edit questionnaire form</h4>
					<span class="pos-add-back pull-right">
						<a href="/tes/course/course-type">Back to Course Type List</a>
					</span>
				</div><!-- end panel-heading -->

        <div class="panel-body">

          @if(Session::has('success'))

					<div class="alert-success" style="margin-bottom:20px;">
						<div class="success-msg">
							<span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}
						</div>
					</div>

					@elseif($errors->all())

					<div class="alert-danger padding" style="margin-bottom:20px;">

						@foreach($errors->all() as $error)
						<div class="error-list">
							<span class="glyphicon glyphicon-remove"></span> {!!$error!!}
						</div><!-- end error-list -->
						@endforeach

					</div><!-- end alert-danger -->

					@endif

          {!! Form::open(['url'=>'/controller/tes/course/course-type/edit-questionnaire/'.$selected_course_type_list->id,'class'=>'',]) !!}

          <div class="form-group">
						<div class="">
							<label>Course Type</label>
							<h4>{{ $selected_course_type_list->name }}</h4>
						</div>
					</div><!-- end form-group -->

          <hr/>

          <input type="hidden" name="course_type_id" value="{!! $selected_course_type_list->id !!}"/>

          <div class="form-group">

            <div id="questionnaire-builder">

              @if (count($QuestionnaireDetailList) > 0)

                @foreach ($QuestionnaireDetailList as $line)

                <div class="question-row">

                  <div class="form-group">
                    <label>@if(count($QuestionnaireAnswerList) == 0)<i id="deleteRow" class="fa fa-minus-circle">@endif</i> Question</label>
                    <input type="text" name="question[]" value="{{ $line->question }}" class="form-control input-sm" />
                  </div><!-- end form-group -->

                  <div class="form-group">
                    <label>Answer Input Type</label>
                    <div>
                      {!! Form::select('answer_input_type[]', array('1'=>'Text','2' => 'Select', '3' => 'Checkbox', '4' => 'Radio', '5' => 'Table'), $line->answer_input_type  , array('class'=>'form-control answer-input-type')); !!}
                    </div>
                  </div><!-- end form-group -->

                  <div class="form-group additional-text" style="display: none;">
                    <label>Text</label>
                    <input type="text" name="additional_text[]" value="Please √ the box which correctly reflects your learning experience" class="form-control input-sm" />
                  </div><!-- end form-group -->

                  <div class="form-group description-title" style="display: none;">
                    <label>Description</label>
                    <input type="text" name="description_title[]" value="{{ $line->description_title }}" class="form-control input-sm" />
                  </div><!-- end form-group -->

                  <div class="form-group">
                    <label>Answer Input Value</label>
                    @if($line->answer_input_type == 5)
                      <input type="text" name="answer_input_value[]" value="{{ $line->description_value }}" class="form-control input-sm" />
                    @else
                      <input type="text" name="answer_input_value[]" value="{{ $line->answer_input_value }}" class="form-control input-sm" />
                    @endif
                  </div><!-- end form-group -->

                  <hr/>
                </div><!-- end question-row -->
                @endforeach

              @else

              <div class="question-row">
              </div><!-- end question-row -->

              @endif

            </div><!-- end questionaire-builder -->

            @if(count($QuestionnaireAnswerList) == 0)
              <a href="#" id="addRowBtn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add Question</a>
            @endif

          </div><!-- end form-group -->

          <div class="form-group row">
            <div class="col-sm-12" style="text-align:center">

                <button type="submit" class="btn btn-default">Edit Questionnaire</button>

            </div><!-- end col-sm-12 -->
          </div><!-- end form-group -->

          {!! Form::close() !!}

        </div><!-- end panel-body -->

      </div><!-- end panel -->

    </div><!-- end col-md-12 -->

  </div><!-- end row -->

</div><!-- end wrap-content -->

<script type="text/javascript">

  $(document).ready(function(){

    var rowQuestionnaire = [

  		'<div class="question-row">'+
  			'<div class="form-group">'+
  		    '<label><i id="deleteRow" class="fa fa-minus-circle"></i> Question</label>'+
  				'<input type="text" name="question[]" value="" class="form-control input-sm" placeholder="E.g. What is your favourite color?" />'+
  		  '</div>'+
  			'<div class="form-group">'+
  				'<label>Answer Input Type</label>'+
  				'<div>'+
  					'<select class="form-control answer-input-type" name="answer_input_type[]"><option value="1" selected="selected" >Text</option><option value="2" >Select</option><option value="3" >Checkbox</option><option value="4" >Radio</option><option value="5" >Table</option></select>'+
  				'</div>'+
  			'</div>'+
  			'<div class="form-group additional-text" style="display:none;">'+
  				'<label>Text</label>'+
  				'<input type="text" name="additional_text[]" value="Please √ the box which correctly reflects your learning experience" class="form-control input-sm" />'+
  			'</div>'+
  			'<div class="form-group description-title" style="display:none;">'+
  				'<label>Description</label>'+
  				'<input type="text" name="description_title[]" value="" class="form-control input-sm" placeholder="seperate multiple value by using , E.g. White,Black"/>'+
  			'</div>'+
  			'<div class="form-group" id="answer-input-value-wrapper">'+
  				'<label>Answer Input Value</label>'+
  				'<input type="text" name="answer_input_value[]" value="" class="form-control input-sm" placeholder="seperate multiple value by using , E.g. White,Black"/>'+
  			'</div>'+
  			'<hr/>'+
  		'</div>'

  	].join('');

  	$("#addRowBtn").on('click', function (e) {
  		orderLines.addRow();
  		e.preventDefault();
  	});

  	$(document).on('click', '#deleteRow', function () {
  		orderLines.deleteRow(this);
  	});

    // Define variables
  	var orderLines = {
  		addRow: function (lookupSelector) {
  			var $questionnaire_builder = $('#questionnaire-builder');
  			var $row = $(rowQuestionnaire);
  			$('.question-row:last', $questionnaire_builder).after($row);
  		},
  		deleteRow: function (row) {
  			$(row).parents('.question-row').remove();
  		}
  	};

    $('body').delegate('.answer-input-type', 'change', function(event) {

  		event.preventDefault();

  		if($(this).val() == 5)
  		{
  			$(this).closest('.question-row').find(".additional-text").show();
  			$(this).closest('.question-row').find(".description-title").show();
  		}

  		else
  		{
  			$(this).closest('.question-row').find(".additional-text").hide();
  			$(this).closest('.question-row').find(".description-title").hide();
  		}
    });

  	$(".answer-input-type option:selected").each(function(){

  		if($(this).val() == 5)
  		{
  			$(this).closest('.question-row').find(".additional-text").show();
  			$(this).closest('.question-row').find(".description-title").show();
  		}
  	});

  });

</script>

@stop
