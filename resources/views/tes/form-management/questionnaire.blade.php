@extends('layout.master')
@section('title',$title)
@section('content')
<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Fill in form</h4>
	</div>
</div>
<div class="wrap-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>{!! $selected_questionnaire->name !!}</h4>
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

{!!Form::open(['url'=>'controller/tes/form-management/questionnaire/'.$selected_questionnaire->id,'class'=>'',])!!}

@foreach($selected_questionnaire_detail as $key=>$a)

<div class="form-group">
	<div id="questionnaire-builder">
		<div class="question-row">
			<div class="question-row">
				<div class="form-group">
					<label>Question {!! $key+1 !!} : {!! $a->question !!} </label>
					{!! Form::hidden('question[]', $a->question )!!}

					@if ($a->answer_input_type == 1)

						{!! Form::input('text','answer['.$key.']', '', array('id' => 'answer', 'class' => 'form-control')) !!}



					@elseif ($a->answer_input_type == 2)
						@foreach (explode(",",$a->answer_input_value) as $b)
							{{--*/ @$c[$b] = $b  /*--}}
						@endforeach
						{!! Form::select('answer['.$key.']',$c,'0',array('id' => 'answer', 'class' => 'form-control')) !!}

					@elseif ($a->answer_input_type == 3)

						@foreach (explode(",",$a->answer_input_value) as $index=>$d)
						<div>
							{!! Form::checkbox('answer['.$key.'][]',$d); !!}{!! $d !!}
							&emsp;
						</div>
						@endforeach

					@elseif ($a->answer_input_type == 4)

						@foreach (explode(",",$a->answer_input_value) as $b)
						<div>
							{!! Form::radio('answer['.$key.']',$b); !!} {!! $b !!}
							&emsp;
						</div>
						@endforeach


					@elseif ($a->answer_input_type == 5)

					@endif
				</div>
				<hr/>
			</div>
		</div>
	</div>
</div>
@endforeach

<div class="form-group row">
	<div class="col-sm-12" style="text-align:center">
		<button type="submit" class="btn btn-default">Submit</button>
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

});
</script>
@stop
