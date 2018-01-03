@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Add Questionnaire</h4>
	</div>
</div>
<div class="wrap-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Add questionnaire form</h4>
					<span class="pos-add-back pull-right">
						<a href="/tes/form-management/questionnaire-list">Back to Questionnaire List</a>
					</span>
				</div>
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
						</div>
@endforeach
					</div>
@endif



{!!Form::open(['url'=>'/controller/tes/form-management/questionnaire-list/add-questionnaire','class'=>'',])!!}

<div class="form-group">
	<div class="">
		<label>Form Name</label>
		<input type="text" name="name" value="" class="form-control input-sm" />
	</div>
</div>

<div class="form-group">
	<div class="">
		<label>Course</label>
		{!! Form::select('course_id',$course_list_array,'',array('id'=>'course_id','placeholder' => '-- Select the course which this questionnaire belongs to --','class' => 'form-control')) !!}
	</div>
</div>

<hr/>

<div class="form-group">
	<div id="questionnaire-builder">
		<div class="question-row">
		</div>
	</div>

	 <a href="#" id="addRowBtn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add Question</a>
	 <hr/>
</div>

<div class="form-group row">
	<div class="col-sm-12" style="text-align:center">
		<button type="submit" class="btn btn-default">Add Questionnaire</button>
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

	var rowQuestionnaire = [

		'<div class="question-row">'+
			'<div class="form-group">'+
		    '<label><i id="deleteRow" class="fa fa-minus-circle"></i> Question</label>'+
				'<input type="text" name="question[]" value="" class="form-control input-sm" placeholder="E.g. What is your favourite color?" />'+
		  '</div>'+
			'<div class="form-group">'+
				'<label>Answer Input Type</label>'+
				'<div>'+
					'<select class="form-control" name="answer_input_type[]"><option value="1" selected="selected" >Text</option><option value="2" >Select</option><option value="3" >Checkbox</option><option value="4" >Radio</option><option value="5" >Table</option></select>'+
				'</div>'+
			'</div>'+
			'<div class="form-group">'+
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


});
</script>
@stop
