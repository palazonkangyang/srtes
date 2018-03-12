@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">

	<div class="col-md-12">
		<h4 class="page-head-line">Fill in form</h4>
	</div><!-- end col-md-12 -->

</div><!-- end row -->

<div class="wrap-content">

	<div class="row">

		<div class="col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading">
					<h4>{!! $course->name !!}</h4>
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

					{!!Form::open(['url'=>'controller/application/view_details/{id}/feedback/','class'=>'',])!!}

					{!! Form::hidden('app_id', $app_id, array("id"=>"app_id"))!!}
					{!! Form::hidden('course_id', $course_id, array("course_id"=>"course_id"))!!}

						@foreach($selected_questionnaire_detail as $key=>$a)

						<div class="form-group">

							<div id="questionnaire-builder">

								<div class="question-row">
									<div class="question-row">

										<div class="form-group">
											<label>Question {!! $key+1 !!} : {!! $a->question !!} </label>
											{!! Form::hidden('question[]', $a->id )!!}

											@if ($a->answer_input_type == 1)

												{!! Form::input('text','answer['.$key.']', '', array('id' => 'answer', 'class' => 'form-control')) !!}

											@elseif ($a->answer_input_type == 2)

												@foreach (explode(",", $a->answer_input_value) as $b)
													{{--*/ @$c[$b] = $b  /*--}}
												@endforeach

												{!! Form::select('answer['.$key.']',$c,'0',array('id' => 'answer', 'class' => 'form-control')) !!}

											@elseif ($a->answer_input_type == 3)

												@foreach (explode(",",$a->answer_input_value) as $index=>$d)
												<div>
													{!! Form::checkbox('answer['.$key.'][]', $d); !!} {!! $d !!}
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

											<p>{{ $a->additional_text }}</p>

											{{-- */ $i=0; /* --}}

											<table class="table table-bordered">
												<tr>
													<th class="col-md-4">Description</th>
													@foreach (explode(",", $a->description_value) as $description_value)
													<th class="col-md-2">{{ $description_value }}</th>
													@endforeach
												</tr>

												@foreach(explode(",", $a->description_title) as $description_title)
												<tr>
													<td>{{ $description_title }}</td>
													<td class="text-center">{!! Form::radio('answer['.$key.'][' . $i . ']', 'Strongly Agree') !!}</td>
													<td class="text-center">{!! Form::radio('answer['.$key.'][' . $i . ']', 'Agree') !!}</td>
													<td class="text-center">{!! Form::radio('answer['.$key.'][' . $i . ']', 'Disagree') !!}</td>
													<td class="text-center">{!! Form::radio('answer['.$key.'][' . $i . ']', 'Strongly Disagree') !!}</td>
												</tr>

												{{-- */ $i++ /* --}}

												@endforeach
											</table>

											@else

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
								<button type="submit" class="btn btn-default" id="submit">Submit</button>
							</div>
						</div><!-- end form-group row -->

						{!!Form::close()!!}

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {

	});

</script>
@stop
