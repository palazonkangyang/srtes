<div class="form-group">
  <label for="designation">Present Designation  (*)</label>
  <select class="form-control" name="designation" id="designation">
    <option value="">-- Select Designation --</option>
      @foreach($designation as $data)
      <option value="{{ $data->name }}">{{ $data->name }}</option>
      @endforeach
  </select>
</div>

<div class="form-group">
  <label for="service_status">Service Status in SRC  (Please tick*)</label>
  <div class="radio">
    <label>{!! Form::radio('service_status', 1) !!} Confirmed</label>
    <label>{!! Form::radio('service_status', 2) !!} Probation</label>
    <label>{!! Form::radio('service_status', 3) !!} Part-Time</label>
  </div>
  <div id="service_status"></div>
</div>

<hr/>

<div class="form-group">
  <label for="select-course-type">Program Type</label>
  {!! Form::select('course_type_id', $course_type_list_array,'',array('id'=>'select-course-type','placeholder' => '-- Select Programme Type --','class' => 'form-control')) !!}
</div>

<div class="form-group">
  <label for="select-programme">Course (*)</label>

  {!! Form::select('course-id', [],'', array('id'=>'select-programme','placeholder' => '-- Select Programme --','class' => 'form-control')) !!}
  {!! Form::hidden('course_id','',array('id'=>'course_id')) !!}
  {!! Form::hidden('title','',array('id'=>'title')) !!}
</div>

<div class="form-group new-course">
  {!! Form::text('new_course_name', '', array('id' => 'new-course-name' ,'class' => 'form-control', 'placeholder' => '-- Course Name --')) !!}
</div>

<div class="form-group new-date-time-programme">
  <label for="date_required">Date and Time of Programme (*)</label>
  <div class="clear"></div>

  {!! Form::text('start_date', '', array('class' => 'form-control column new-item-date')) !!}
  {!! Form::text('end_date', '', array('class' => 'form-control column new-item-date2')) !!}
</div>

<div class="form-group date-time-programme">
  <label for="date_required">Date and Time of Programme (*)</label>

  {!! Form::select('timetable-id',[],'', array('id' => 'select-timetable' ,'class' => 'form-control','disabled' => 'true','placeholder' => '-- Select Date and Time of Programme --')) !!}
  {!! Form::hidden('item_id[]','',array('id'=>'item_id')) !!}
  {!! Form::hidden('item_date[]','',array('id'=>'item_date')) !!}
  {!! Form::hidden('to_date[]','',array('id'=>'to_date')) !!}
</div>

<div class="form-group">
  <label for="provider">Lecturer:&nbsp;</label><span class="range_text" id="provider-text">-</span>{!! Form::hidden('provider','',array('id'=>'provider')) !!}
</div>

<div class="form-group">
  <label for="type-training-text">Course Type:&nbsp;</label><span class="range_text" id="type-training-text">-</span>{!! Form::hidden('type_training', '',array('id'=>'type_training')) !!}
</div>

<div class="form-group">
   <label for="budget_availability_text">Budget Availability:&nbsp;</label><span class="range_text" id="budget_availability_text">-</span>{!! Form::hidden('budget_availability', '',array('id'=>'budget_availability')) !!}
</div>

<div class="form-group">
  <label for="isfunds-text">Funds or grant:&nbsp;</label><span class="range_text" id="isfunds-text">-</span>{!! Form::hidden('isfunds', '',array('id'=>'isfunds')) !!}
</div>

<div id="funds-section" class="form-group hide">
  <label for="funds-text">Amount of Funds / grant:&nbsp;</label><span class="range_text" id="funds-text">-</span>{!! Form::hidden('funds', '',array('id'=>'funds')) !!}
</div>

<div class="form-group">
  <label for="fee">Course Fee:&nbsp;</label><span class="range_text" id="fee-text">-</span>{!! Form::hidden('fee', '',array('id'=>'fee')) !!}
</div>

<div class="form-group">
  <label for="description">Description:&nbsp;</label>
   {!! Form::textarea('description', '-', ['class' => 'ckeditor form-control','readonly' => 'true','id' => 'description']) !!}
</div>

<script type="text/javascript">
$(document).ready(function(){

  $('.new-item-date').datetimepicker({
    format:'YYYY-MM-DD hh:mm a',
    sideBySide:true,
    defaultDate: new Date()
  });

  $('.new-item-date2').datetimepicker({
    format:'YYYY-MM-DD hh:mm a',
    sideBySide:true,
    defaultDate: new Date()
  });

$( "#select-course-type" ).change(function() {
  url = '/tes/course/get_json_course_by_course_type_id';
  data = { course_type_id: $( "#select-course-type" ).val()};

  var request = $.ajax({
    url: url,
    type: 'GET',
    data: data ,
    contentType: 'application/json; charset=utf-8'
  });

  request.done(function(data) {
    // your success code here
    var listitems ='<option value=-1>-- Select Programme --</option>';

    $.each(data, function(key, value){
      listitems += '<option value=' + value.id + '>' + value.name + '</option>';
    });

    if($("#select-course-type").val() != "")
    {
      listitems += '<option value=0>Others</option>';
    }

    $("#select-programme").html(listitems);
  });

  request.fail(function(jqXHR, textStatus) {
    // your failure code here
  });
});

$( "#select-programme" ).change(function() {
  url = '/tes/course/get_json_course';
  data = { course_id: $( "#select-programme" ).val()};

  $("#course_id").val($("#select-programme").val());
  $("#title").val($("#select-programme :selected").text());

  var request = $.ajax({
    url: url,
    type: 'GET',
    data: data ,
    contentType: 'application/json; charset=utf-8'
  });

  request.done(function(data) {

    // your success code here
    $( "#select-timetable" ).attr('disabled', false);
    var listitems ='<option value=-1>-- Select Date and Time of Programme --</option>';
    $.each(data.timetable, function(key, value){
      listitems += '<option data-fromdate='+ value.start_date +' data-todate='+ value.to_date +' value=' + value.id + '>From ' + value.start_date + ' to ' + value.end_date +'</option>';
    });

    $("#select-timetable").html(listitems);

    if(data.newcourse == "No")
    {
      $("#provider-text").text(data['provider']);
      $("#provider").val(data['provider']);

      $("#fee-text").text(data['fee']);
      $("#fee").val(data['fee']);

      $("#isfunds").val(data['isfunds']);
      $("#funds").val(data['funds']);

      switch (data['isfunds']) {
        case 1:
            $("#isfunds-text").text('Yes');
            $("div#funds-section").removeClass("hide");
            $("#funds-text").text(data['funds']);
            break;
        case 2:
            $("#isfunds-text").text('No');
            $("div#funds-section").addClass("hide");
            $("#funds-text").text('-');
            break;
      }

      CKEDITOR.instances['description'].setData(data['description']);

      $("#type_training").val(data['course_type_id']);

      switch (data['course_type_id']) {
        case 1:
            $("#type-training-text").text('Core Training');
            break;
        case 2:
            $("#type-training-text").text('Functional');
            break;
        case 3:
            $("#type-training-text").text('Management / Leadership');
            break;
        case 4:
            $("#type-training-text").text('SRC Knowledge');
            break;
      }

      $("#budget_availability").val(data['budget_availability']);

      switch (data['budget_availability']) {
        case 1:
            $("#budget_availability_text").text('Confirmed that Budget is available for the course');
            break;
        case 2:
            $("#budget_availability_text").text('Insufficient Budget left');
            break;
      }

      $( "#select-timetable" ).change(function() {
        $("#item_id").val($("#select-timetable").val());
        $a = $("#item_date").val($("#select-timetable :selected").data('fromdate'));
        console.log($("#select-timetable :selected").data('fromdate'));
        $("#to_date").val($("#select-timetable :selected").data('todate'));
      });
    }

    else
    {
      $("#provider").val('-');
      $("#type_training").val('-');
      $("#fee").val(0.0);
      $("#isfunds").val(0);
      $("#funds").val(0);
      $("#budget_availability").val(0);

      $("#item_id").prop('disabled', true);
      $("#item_date").prop('disabled', true);
      $("#to_date").prop('disabled', true);
    }
  });

  request.fail(function(jqXHR, textStatus) {
    // your failure code here
  });
});

 });

</script>
