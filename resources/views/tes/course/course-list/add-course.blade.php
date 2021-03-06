@extends('layout.master')
@section('title',$title)
@section('content')
<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Add Course</h4>
	</div>
</div><!-- end row -->

<div class="wrap-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Add course form</h4>
					<span class="pos-add-back pull-right">
						<a href="/tes/course/course-list">Back to Course List</a>
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
					</div><!-- end alert-danger -->

					@endif

					{!!Form::open(['url'=>'/controller/tes/course/course-list/add-course','class'=>'course-list',])!!}

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Code</label>
						<div class="col-sm-9">
							{!! Form::input('text','code', NULL, array('placeholder' => 'Course Code, e.g. MT001', 'id' => 'code', 'class' => 'form-control')) !!}
						</div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Course</label>
						<div class="col-sm-9">
              {!! Form::input('text','name', NULL, array('placeholder' => 'Course Name', 'id' => 'name', 'class' => 'form-control')) !!}
            </div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Lecturer</label>
						<div class="col-sm-9">
							{!! Form::text('provider',NULL,['class'=>'form-control ', 'id'=>'provider','placeholder' => 'Lecturer Name']) !!}
						</div>
					</div><!-- end form-group -->

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Type</label>
						<div class="col-sm-9">
              {!! Form::select('course_type_id',$course_type_list,'1',array('id' => 'course_type_id', 'class' => 'form-control')) !!}
            </div>
					</div><!-- end form-group -->

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Duration</label>
						<div class="col-sm-9">
              {!! Form::select('duration',['15'=>'15 minutes','30'=>'30 minutes','45'=>'45 minutes','60'=>'60 minutes','75'=>'75 minutes','90'=>'90 minutes','105'=>'105 minutes','120'=>'120 minutes'],'60',array('id' => 'duration', 'class' => 'form-control')) !!}
            </div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Budget Availability</label>
						<div class="col-sm-9">
							<div class="radio">
									<label>{!! Form::radio('budget_availability', 1,true) !!} Confirmed that Budget is available for the course</label>
									<label>{!! Form::radio('budget_availability', 2) !!} Insufficient Budget left</label>
							</div>
						</div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Funds or grant</label>
						<div class="col-sm-6">
							<div class="radio">
								<label>
										{!! Form::radio('isfunds', 2, true ) !!} No
								</label>
								<label>
										{!! Form::radio('isfunds', 1) !!} Yes
								</label>
							</div>
						</div>
					</div><!-- end form-group -->

					<div class="form-group row hide funds">
						<label for="" class="col-sm-2 form-control-label">Amount of Funds / grant</label>
						<div class="col-sm-9">
								{!! Form::number('funds',1, array('id' => 'funds', 'class' => 'form-control', 'min' => 0,'placeholder' => 'Amount of Funds / grant')) !!}
						</div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Fee</label>
						<div class="col-sm-9">
							{!! Form::number('fee',0, array('id' => 'fee', 'class' => 'form-control', 'min' => 0,'placeholder' => 'Course Fee')) !!}
						</div>
					</div><!-- end form-group -->

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Minimum Attendee</label>
						<div class="col-sm-9">
              {!! Form::number('minimum_attendee',1, array('placeholder' => 'Minimum number of attendee required', 'id' => 'minimum_attendee', 'class' => 'form-control', 'min' => 1,'max' => 99)) !!}
            </div>
          </div><!-- end form-group -->

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Maximum Attendee</label>
						<div class="col-sm-9">
              {!! Form::number('maximum_attendee',1, array('placeholder' => 'Maximum number of attendee allowed', 'id' => 'maximum_attendee', 'class' => 'form-control', 'min' => 1,'max' => 99)) !!}
            </div>
					</div><!-- end form-group -->

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Description</label>
						<div class="col-sm-9">
							{!! Form::textarea('description', NULL , array('placeholder' => 'Course Description', 'id' => 'description', 'class' => 'form-control ckeditor')) !!}
						</div>
					</div><!-- end form-group -->

					<div class="form-group">
						<label for="">Timetable</label>

						 <table class="table table-striped table-condensed" id="itemsTable">
							 <thead>
									<tr>
									 <th style="width: 5%"></th>
									 <th class="v-align-middle" style="width: 20%">Start Date</th>
									 <th class="v-align-middle" style="width: 20%">End Date</th>
									 <th class="v-align-middle" style="width: 20%">Location</th>
									</tr>
								</thead>
								<tbody class="items">
									 <tr class="item-row">
										 <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
										 <td class="v-align-middle"><input type="text" name="start_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
										 <td class="v-align-middle"><input type="text" name="end_date[]" value="" class="item_date form-control input-sm" tabindex="3" /></td>
										 <td class="v-align-middle"><input type="text" name="location[]" value="" class="item_nric form-control input-sm" tabindex="4"/></td>
									 </tr>
								</tbody>
						 </table>

							<a href="#" id="addRowBtn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add item</a>
				 			<hr/>
					</div><!-- end form-group -->

					<div class="form-group row">
						<div class="col-sm-12" style="text-align:center">
							<button type="submit" class="btn btn-default">Add Course</button>
						</div>
					</div><!-- end form-group -->

					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>


<script src="{{ URL::asset('components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function() {

		var rowTemp = [
				"<tr class='item-row'>",
					"<td class='v-align-middle'><i id='deleteRow' class='fa fa-minus-circle'></i></td>"+
					"<td class='v-align-middle'><input type='text' name='start_date[]' value='' class='item_date form-control input-sm' tabindex='2' /></td>"+
					"<td class='v-align-middle'><input type='text' name='end_date[]' value='' class='item_date form-control input-sm' tabindex='3' /></td>"+
					"<td class='v-align-middle'><input type='text' name='location[]' value='' class='item_nric form-control input-sm' tabindex='4'/></td>"+
				"</tr>"
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
			/**
			 * Add row to invoice to allow for additional items
			 * @param lookupSelector
			 */
			addRow: function (lookupSelector) {

					// Get the table object to use for adding a row at the end of the table
					var $itemsTable = $('#itemsTable');
					var $row = $(rowTemp);

					// Add row after the first row in table
					$('.item-row:last', $itemsTable).after($row);
					// save reference to inputs within row
					$('.item_date').datetimepicker({
						format:'YYYY-MM-DD hh:mm a',
						sideBySide:true,
						defaultDate: new Date()
					});

			},
			/**
			 * Delete row if we have more than one row in table
			 * @param row
			 * @returns {boolean}
			 */
			deleteRow: function (row) {

					var rowCount = $('#itemsTable tr').length;

					if (rowCount != 1) {
							$(row).parents('.item-row').remove();
							if ($(".item-row").length < 1) $("#deleteRow").hide();

							return true;
					} else {
							alert('you can not delete this row');
							return false;
					}
			}
		};

		 $('.item_date').datetimepicker({
				format:'YYYY-MM-DD hh:mm a',
				sideBySide:true,
				defaultDate: new Date()
		 });

			//end of item line


			$('input[name=isfunds]').on('change', function(){
				 var getVal =  $(this).val();

				 if(getVal == '1'){
						$('.funds').removeClass('hide').addClass('show');
				 } else {
						$('.funds').addClass('hide').removeClass('show');
				 }
			});

	 });

</script>

@stop
