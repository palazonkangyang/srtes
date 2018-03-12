@extends('layout.master')
@section('title',$title)
@section('content')
<div class="row">
	<div class="col-md-12">
		<h4 class="page-head-line">Edit Course</h4>
	</div>
</div>
<div class="wrap-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Edit course form</h4>
					<span class="pos-add-back pull-right">
						<a href="javascript:history.back()">Back to Course List</a>
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

{!!Form::open(['url'=>'/controller/tes/course/course-list/edit-course/'.$selected_course_list->id,'class'=>'course-list',])!!}

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Code</label>
						<div class="col-sm-9">
							{!! Form::input('text','code', $selected_course_list->code, array('placeholder' => 'Course Code, e.g. MT001', 'id' => 'code', 'class' => 'form-control')) !!}
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Course</label>
						<div class="col-sm-9">
              {!! Form::input('text','name', $selected_course_list->name, array('placeholder' => 'Course Name', 'id' => 'name', 'class' => 'form-control')) !!}
            </div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Lecturer</label>
						<div class="col-sm-9">
							{!! Form::text('provider',$selected_course_list->provider,['class'=>'form-control ', 'id'=>'provider','placeholder' => 'Lecturer Name']) !!}
						</div>
					</div>

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Type</label>
						<div class="col-sm-9">
              {!! Form::select('course_type_id',$course_type_list,$selected_course_list->course_type_id,array('id' => 'course_type_id', 'class' => 'form-control')) !!}
            </div>
					</div>

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Duration</label>
						<div class="col-sm-9">
              {!! Form::select('duration',['15'=>'15 minutes','30'=>'30 minutes','45'=>'45 minutes','60'=>'60 minutes','75'=>'75 minutes','90'=>'90 minutes','105'=>'105 minutes','120'=>'120 minutes'],$selected_course_list->duration,array('id' => 'duration', 'class' => 'form-control')) !!}
            </div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Budget Availability</label>
						<div class="col-sm-9">
							<div class="radio">
									<label>{!! Form::radio('budget_availability', 1,($selected_course_list->budget_availability == '1' ? 'true' : '')) !!} Confirmed that Budget is available for the course</label>
									<label>{!! Form::radio('budget_availability', 2,($selected_course_list->budget_availability == '2' ? 'true' : '')) !!} Insufficient Budget left</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Funds or grant</label>
						<div class="col-sm-6">
							<div class="radio">
								<label>
										{!! Form::radio('isfunds', 2,($selected_course_list->isfunds == '2' ? 'true' : '') ) !!} No
								</label>
								<label>
										{!! Form::radio('isfunds', 1,($selected_course_list->isfunds == '1' ? 'true' : '')) !!} Yes
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row {!! $selected_course_list->isfunds == '1' ? '' : 'hide' !!} funds">
						<label for="" class="col-sm-2 form-control-label">Amount of Funds / grant</label>
						<div class="col-sm-9">
								{!! Form::number('funds',$selected_course_list->funds, array('id' => 'funds', 'class' => 'form-control', 'min' => 0,'placeholder' => 'Amount of Funds / grant')) !!}
						</div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Fee</label>
						<div class="col-sm-9">
							{!! Form::number('fee',$selected_course_list->fee, array('id' => 'fee', 'class' => 'form-control', 'min' => 0,'placeholder' => 'Course Fee')) !!}
						</div>
					</div>

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Minimum Attendee</label>
						<div class="col-sm-9">
              {!! Form::number('minimum_attendee',$selected_course_list->minimum_attendee, array('placeholder' => 'Minimum number of attendee required', 'id' => 'minimum_attendee', 'class' => 'form-control', 'min' => 1,'max' => 99)) !!}
            </div>
          </div>

          <div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Maximum Attendee</label>
						<div class="col-sm-9">
              {!! Form::number('maximum_attendee',$selected_course_list->maximum_attendee, array('placeholder' => 'Maximum number of attendee allowed', 'id' => 'maximum_attendee', 'class' => 'form-control', 'min' => 1,'max' => 99)) !!}
            </div>
					</div>

					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Description</label>
						<div class="col-sm-9">
							{!! Form::textarea('description', $selected_course_list->description, array('placeholder' => 'Course Description', 'id' => 'description', 'class' => 'form-control ckeditor')) !!}
						</div>
					</div>

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
										 @if ($selected_timetable_list->count())
											 @foreach ($selected_timetable_list as $index=>$stl)
											  <tr class="item-row">
												@if ($index == 0 )
													<td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
												@else
													<td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle"></i></td>
												@endif
													<input type="hidden" name="course_id[]" value="{!!$stl->id!!}"/>
													<td class="v-align-middle"><input type="text" name="start_date[]" value="{!!$stl->start_date!!}" class="item_date form-control input-sm" tabindex="2" /></td>
													<td class="v-align-middle"><input type="text" name="end_date[]" value="{!!$stl->end_date!!}" class="item_date form-control input-sm" tabindex="3" /></td>
													<td class="v-align-middle"><input type="text" name="location[]" value="{!!$stl->location!!}" class="item_nric form-control input-sm" tabindex="4"/></td>
												</tr>
											 @endforeach

										 @else
										 		<tr class="item-row">
												 <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
												 <input type="hidden" name="course_id[]" value="new"/>
												 <td class="v-align-middle"><input type="text" name="start_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
												 <td class="v-align-middle"><input type="text" name="end_date[]" value="" class="item_date form-control input-sm" tabindex="3" /></td>
												 <td class="v-align-middle"><input type="text" name="location[]" value="" class="item_nric form-control input-sm" tabindex="4"/></td>
											 </tr>
										 @endif


								 </tbody>
						 </table>
										 <a href="#" id="addRowBtn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add item</a>
									 <hr/>
					</div>

					<div class="form-group row">
						<div class="col-sm-12" style="text-align:center">
							<button type="submit" class="btn btn-default">Save Changes</button>
							 &nbsp;
							 <a href="#" class="btn btn-danger"  data-href="/tes/course/course-list/remove-course/{{$selected_course_list->id}}" data-toggle="modal" data-target="#confirm-delete">Remove Course</a>
						</div>
					</div>


{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <strong>{{$selected_course_list->name}}</strong>, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Remove</a>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

		//** start of item line

		var rowTemp = [
				"<tr class='item-row'>",
					"<td class='v-align-middle'><i id='deleteRow' class='fa fa-minus-circle'></i></td>"+
					"<input type='hidden' name='course_id[]' value='new'/>"+
					"<td class='v-align-middle'><input type='text' name='start_date[]' value='' class='item_date form-control input-sm' tabindex='2' /></td>"+
					"<td class='v-align-middle'><input type='text' name='end_date[]' value='' class='item_date form-control input-sm' tabindex='3' /></td>"+
					"<td class='v-align-middle'><input type='text' name='location[]' value='' class='item_nric form-control input-sm' tabindex='4'/></td>"+
				"</tr>"



		].join('');

			$("#addRowBtn").on('click', function (e) {
			orderLines.addRow();
			e.preventDefault();
		}
		);

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
