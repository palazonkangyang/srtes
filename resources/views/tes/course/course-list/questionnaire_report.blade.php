@extends('layout.master')
@section('title', $title)
@section('content')


@if(Session::has('success'))

<div class="container">
	<div class="alert alert-success alert-dismissible fade in fixed-error">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<strong> {{ Session::get('success') }}</strong>
	</div>
</div>
@endif


<div class="row pos-rel">
	<div class="col-md-12">
		<h4 class="page-head-line">{{$title}}</h4>
	</div>
	<div class="print-table">
		@if(count($questionnaire_list))
			<a download="reports.xls" href="#" onclick="return ExcellentExport.excel(this, 'xls-table', 'Report');" class="btn btn-default">export to Excel</a>
			<a download="reports.csv" href="#" onclick="return ExcellentExport.csv(this, 'xls-table');" class="btn btn-default">export to CSV</a>
			<a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
		@endif
	</div>

</div>
<div class="wrap-content">

{!!Form::open(['class'=>'form-horizontal filter_field'])!!}

	<div class="form-group">
		<label class="col-md-1 control-label" for="search_field">Search</label>
		<div class="col-md-5">
{!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
{!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!}
</div>

	</div>
{!!Form::close()!!}
	<?php   $x = 0; ?>
@if(count($questionnaire_list))

	<div class="row">
		<div id="no-more-tables">
			<table class="col-md-12 table-bordered table-striped table-condensed cf" id="xls-table">
				<thead class="cf">
					<th >{!!$questionnaire_list->sortColumn('id','App ID')!!}</th>
					<th >{!!$questionnaire_list->sortColumn('loginname','Login Name')!!}</th>
					<th >{!!$questionnaire_list->sortColumn('department','Department')!!}</th>
					<th >{!!$questionnaire_list->sortColumn('case_number','Case Number')!!}</th>
					<th >Status</th>

					@if(isset($QuestionnaireDetailList))
	 					@foreach($QuestionnaireDetailList as $QuestionnaireDetail)
			 				<th>{!! $QuestionnaireDetail->question !!}</th>
			 			@endforeach
				 	@endif
				</thead>
				<tbody>

					@foreach($questionnaire_list as $questionnaire)

					<tr class="clickable-row" data-href="/tes/course/course-list/edit-course/{{$questionnaire->id}}">
						<td data-title="id">{{ $questionnaire->id }}</td>
						<td data-title="loginname">{{ $questionnaire->loginname }}</td>
						<td data-title="Department">{{ $questionnaire->department }}</td>
						<td data-title="S/N">{{ $questionnaire->case_number }}</td>
						<td data-title="Status">
              @if($questionnaire->status == 0)
                <span class="alert-black">Pending</span>
              @elseif($questionnaire->status == 1)
                <span class="alert-black">Approved</span>
              @elseif($questionnaire->status == 2)
                <span class="alert-black">Rejected</span>
              @elseif($questionnaire->status == 3)
              	<span class="alert-black">Cancelled</span>
              @elseif($questionnaire->status == 4)
                <span class="alert-black">Forwarded</span>
              @elseif($questionnaire->status == 6)
                <span class="alert-black">Review Required</span>
              @elseif($questionnaire->status == 7)
                <span class="alert-black">Review Given</span>
              @endif
            </td>
					<?php $setvaluez1 = 1; ?>
          <?php $setvaluez2 = 1; ?>
          <?php $setvaluez3 = 1; ?>
          <?php $setvaluez4 = 1; ?>
          <?php $setvaluez5 = 1; ?>
          <?php $setvaluez6 = 1; ?>
          <?php $setvaluez7 = 1; ?>
          <?php $setvaluez8 = 1; ?>
          <?php $setvaluez9 = 1; ?>
          <?php $setvaluez10 = 1; ?>
          <!-- start of questionnaire  -->

					@if(isset($QuestionnaireDetailList))

						@for ($z = 0; $z < count($QuestionnaireDetailList); $z++)

               @if($z == 0)

	               @for ($questionrow1 = 0; $questionrow1 < count($answerReport1); $questionrow1++)
		               @if( $questionnaire_list[$x]->id == $answerReport1[$questionrow1]->app_id )
									 @if($answerReport1[$questionrow1]->answer_input_type == 5)

									 <td>

										 <table class="table table-bordered">

											 {{-- */ $description_title = explode(",", $answerReport1[$questionrow1]->description_title); /* --}}

											 <tr>
												 @for($i = 1; $i <= count($description_title); $i++)
												 <th>Q {!! $i !!}</th>
												 @endfor
											 </tr>

											 <tr>
												 {{-- */ $answers = explode(",", $answerReport1[$questionrow1]->answer); /* --}}

												 @foreach($answers as $answer=>$value)

												 <td>{{$value}}</td>

												 @endforeach
											 </tr>
										 </table>

									 </td>

									 @else
										 <td>{!! $answerReport1[$questionrow1]->answer !!}</td>
									 @endif
		            		<?php $setvaluez1 = 0; ?>
		              	@endif
	               @endfor

									@if($setvaluez1 == 1)
		                <td>-</td>
		              @endif

								@endif

								@if($z == 1)

									@for ($questionrow2 = 0; $questionrow2 < count($answerReport2); $questionrow2++)
										@if( $questionnaire_list[$x]->id == $answerReport2[$questionrow2]->app_id )
										@if($answerReport2[$questionrow2]->answer_input_type == 5)

										<td>

											<table class="table table-bordered">

												{{-- */ $description_title = explode(",", $answerReport2[$questionrow2]->description_title); /* --}}

												<tr>
													@for($i = 1; $i <= count($description_title); $i++)
													<th>Q {!! $i !!}</th>
													@endfor
												</tr>

												<tr>
													{{-- */ $answers = explode(",", $answerReport2[$questionrow2]->answer); /* --}}

													@foreach($answers as $answer=>$value)

													<td>{{$value}}</td>

													@endforeach
												</tr>
											</table>

										</td>

										@else
											<td>{!! $answerReport2[$questionrow2]->answer !!}</td>
										@endif
								 	 	 <?php $setvaluez2 = 0; ?>
									 	@endif
									@endfor

								 @if($setvaluez2 == 1)
								 <td>-</td>
								 @endif

							 @endif

							 @if($z == 2)

								 @for($questionrow3 = 0; $questionrow3 < count($answerReport3); $questionrow3++)
									 	@if( $questionnaire_list[$x]->id == $answerReport3[$questionrow3]->app_id )
										@if($answerReport3[$questionrow3]->answer_input_type == 5)

									 <td>

										 <table class="table table-bordered">

											 {{-- */ $description_title = explode(",", $answerReport3[$questionrow3]->description_title); /* --}}

											 <tr>
												 @for($i = 1; $i <= count($description_title); $i++)
												 <th>Q {!! $i !!}</th>
												 @endfor
											 </tr>

											 <tr>
												 {{-- */ $answers = explode(",", $answerReport3[$questionrow3]->answer); /* --}}

												 @foreach($answers as $answer=>$value)

												 <td>{{$value}}</td>

												 @endforeach
											 </tr>
										 </table>

									 </td>

									 @else
										 <td>{!! $answerReport3[$questionrow3]->answer !!}</td>
									 @endif
											<?php $setvaluez3 = 0; ?>
										@endif
								 @endfor

								@if($setvaluez3 == 1)
									<td>-</td>
								@endif

							@endif

							@if($z == 3)

								@for($questionrow4 = 0; $questionrow4 < count($answerReport4); $questionrow4++)
									@if( $questionnaire_list[$x]->id == $answerReport4[$questionrow4]->app_id )
									@if($answerReport4[$questionrow4]->answer_input_type == 5)

									<td>

										<table class="table table-bordered">

											{{-- */ $description_title = explode(",", $answerReport4[$questionrow4]->description_title); /* --}}

											<tr>
												@for($i = 1; $i <= count($description_title); $i++)
												<th>Q {!! $i !!}</th>
												@endfor
											</tr>

											<tr>
												{{-- */ $answers = explode(",", $answerReport4[$questionrow4]->answer); /* --}}

												@foreach($answers as $answer=>$value)

												<td>{{$value}}</td>

												@endforeach
											</tr>
										</table>

									</td>

									@else
										<td>{!! $answerReport4[$questionrow4]->answer !!}</td>
									@endif
							 	 	 <?php $setvaluez4 = 0; ?>
									 @endif
								@endfor

							 @if($setvaluez4 == 1)
							 <td>-</td>
							 @endif

						 @endif

						 @if($z == 4)

							 @for($questionrow5 = 0; $questionrow5 < count($answerReport5); $questionrow5++)
								 @if($questionnaire_list[$x]->id == $answerReport5[$questionrow5]->app_id)
								 @if($answerReport5[$questionrow5]->answer_input_type == 5)

								 <td>

									 <table class="table table-bordered">

										 {{-- */ $description_title = explode(",", $answerReport5[$questionrow5]->description_title); /* --}}

										 <tr>
											 @for($i = 1; $i <= count($description_title); $i++)
											 <th>Q {!! $i !!}</th>
											 @endfor
										 </tr>

										 <tr>
											 {{-- */ $answers = explode(",", $answerReport5[$questionrow5]->answer); /* --}}

											 @foreach($answers as $answer=>$value)

											 <td>{{$value}}</td>

											 @endforeach
										 </tr>
									 </table>

								 </td>

								 @else
									 <td>{!! $answerReport5[$questionrow5]->answer !!}</td>
								 @endif
								 	<?php  $setvaluez5 = 0; ?>
								 @endif
							 @endfor

							@if($setvaluez5 == 1)
							<td>-</td>
							@endif

						@endif

						@if($z == 5)

							@for ($questionrow6 = 0; $questionrow6 < count($answerReport6); $questionrow6++)
								@if( $questionnaire_list[$x]->id == $answerReport6[$questionrow6]->app_id )
								@if($answerReport6[$questionrow6]->answer_input_type == 5)

								<td>

									<table class="table table-bordered">

										{{-- */ $description_title = explode(",", $answerReport6[$questionrow6]->description_title); /* --}}

										<tr>
											@for($i = 1; $i <= count($description_title); $i++)
											<th>Q {!! $i !!}</th>
											@endfor
										</tr>

										<tr>
											{{-- */ $answers = explode(",", $answerReport6[$questionrow6]->answer); /* --}}

											@foreach($answers as $answer=>$value)

											<td>{{$value}}</td>

											@endforeach
										</tr>
									</table>

								</td>

								@else
									<td>{!! $answerReport6[$questionrow6]->answer !!}</td>
								@endif
						 	 	 <?php $setvaluez6 = 0; ?>
								@endif
							@endfor

						 @if($setvaluez6 == 1)
						 <td>-</td>
						 @endif

					 @endif

					 @if($z == 6)

						 @for ($questionrow7 = 0; $questionrow7 < count($answerReport7); $questionrow7++)
							 @if( $questionnaire_list[$x]->id == $answerReport7[$questionrow7]->app_id )
							 @if($answerReport7[$questionrow7]->answer_input_type == 5)

							 <td>

								 <table class="table table-bordered">

									 {{-- */ $description_title = explode(",", $answerReport7[$questionrow7]->description_title); /* --}}

									 <tr>
										 @for($i = 1; $i <= count($description_title); $i++)
										 <th>Q {!! $i !!}</th>
										 @endfor
									 </tr>

									 <tr>
										 {{-- */ $answers = explode(",", $answerReport7[$questionrow7]->answer); /* --}}

										 @foreach($answers as $answer=>$value)

										 <td>{{$value}}</td>

										 @endforeach
									 </tr>
								 </table>

							 </td>

							 @else
								 <td>{!! $answerReport7[$questionrow7]->answer !!}</td>
							 @endif
								<?php $setvaluez7 = 0; ?>
							 @endif
						 @endfor

						@if($setvaluez7 == 1)
							<td>-</td>
						@endif

					@endif

					@if($z == 7)

						@for ($questionrow8 = 0; $questionrow8 < count($answerReport8); $questionrow8++)
							@if( $questionnaire_list[$x]->id == $answerReport8[$questionrow8]->app_id )
							@if($answerReport8[$questionrow8]->answer_input_type == 5)

							<td>

								<table class="table table-bordered">

									{{-- */ $description_title = explode(",", $answerReport8[$questionrow8]->description_title); /* --}}

									<tr>
										@for($i = 1; $i <= count($description_title); $i++)
										<th>Q {!! $i !!}</th>
										@endfor
									</tr>

									<tr>
										{{-- */ $answers = explode(",", $answerReport8[$questionrow8]->answer); /* --}}

										@foreach($answers as $answer=>$value)

										<td>{{$value}}</td>

										@endforeach
									</tr>
								</table>

							</td>

							@else
								<td>{!! $answerReport8[$questionrow8]->answer !!}</td>
							@endif
					 	 		<?php $setvaluez8 = 0; ?>
							 @endif
						@endfor

					 @if($setvaluez8 == 1)
					 <td>-</td>
					 @endif

				 @endif

				 @if($z == 8)

					 @for($questionrow9 = 0; $questionrow9 < count($answerReport9); $questionrow9++)
						 @if($questionnaire_list[$x]->id == $answerReport9[$questionrow9]->app_id)
						 @if($answerReport9[$questionrow9]->answer_input_type == 5)

						 <td>

							 <table class="table table-bordered">

								 {{-- */ $description_title = explode(",", $answerReport9[$questionrow9]->description_title); /* --}}

								 <tr>
									 @for($i = 1; $i <= count($description_title); $i++)
									 <th>Q {!! $i !!}</th>
									 @endfor
								 </tr>

								 <tr>
									 {{-- */ $answers = explode(",", $answerReport9[$questionrow9]->answer); /* --}}

									 @foreach($answers as $answer=>$value)

									 <td>{{$value}}</td>

									 @endforeach
								 </tr>
							 </table>

						 </td>

						 @else
							 <td>{!! $answerReport9[$questionrow9]->answer !!}</td>
						 @endif
							<?php $setvaluez9 = 0; ?>
							@endif
					 @endfor

					@if($setvaluez9 == 1)
					<td>-</td>
					@endif

				@endif

				@if($z == 9)
					@for ($questionrow10 = 0; $questionrow10 < count($answerReport10); $questionrow10++)
						@if( $questionnaire_list[$x]->id == $answerReport10[$questionrow10]->app_id )
						@if($answerReport10[$questionrow10]->answer_input_type == 5)

						<td>

							<table class="table table-bordered">

								{{-- */ $description_title = explode(",", $answerReport10[$questionrow10]->description_title); /* --}}

								<tr>
									@for($i = 1; $i <= count($description_title); $i++)
									<th>Q {!! $i !!}</th>
									@endfor
								</tr>

								<tr>
									{{-- */ $answers = explode(",", $answerReport10[$questionrow10]->answer); /* --}}

									@foreach($answers as $answer=>$value)

									<td>{{$value}}</td>

									@endforeach
								</tr>
							</table>

						</td>

						@else
							<td>{!! $answerReport10[$questionrow10]->answer !!}</td>
						@endif
				 	 	 <?php $setvaluez10 = 0; ?>
						 @endif
					@endfor

				 @if($setvaluez10 == 1)
				 <td>-</td>
				 @endif

			 @endif

  	 @endfor
  	@endif
	</tr>

	<?php $x = $x+1; ?>
	@endforeach

				</tbody>
			</table>
		</div>
	</div>

	<span style="display:none">
		{!! $questionnaire_list->sortColumn('','') !!}
	</span>

	{!! $questionnaire_list->paginate() !!}

@else
	<span class="no-data-display">No data to display.</span>
@endif

</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('.clickable-row').on('hover', 'td:not(.special-td)', function(){
	    //get the link from data attribute
	    var the_link = $(this).parent().attr("data-href");

	    //do we have a valid link
	    if (the_link == '' || typeof the_link === 'undefined') {
	      //do nothing for now
	    }
	    else {
	      //open the page
	      window.location = the_link;
	    }
		});
	});
</script>
@stop
