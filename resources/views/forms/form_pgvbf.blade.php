  <div class="form-group">
    <label for="booking_date">Date(s) and Time of booking</label>
    <div class="range_text row">
      <div class="col-md-12">
      From
      {!! Form::text('booking_date_start',NULL,['class'=>'form-control width-40 start_date_hour']) !!}
      To
      {!! Form::text('booking_date_end',NULL,['class'=>'form-control width-40 end_date_hour']) !!}
      </div>
    </div>
    <div id="booking_date_start"></div>
    <div id="booking_date_end"></div>
  </div>


  <div class="form-group">
    <label for="purpose_of_use">Purpose of Use (*)</label>
    {!! Form::text('purpose_of_use',NULL,['class'=>'form-control', 'id'=>'purpose_of_use']) !!}
  </div>


  <div class="form-group">
        <label for="driver_requested">Driver Requested (Please tick*)</label>
        <div class="radio">
            <label class="display-block">
                {!! Form::radio('driver_requested', 1) !!} With Driver
            </label>
            <label class="display-block">
                {!! Form::radio('driver_requested', 2) !!} Without Driver
            </label>
             <label class="display-block">
                {!! Form::radio('driver_requested', 3) !!} Volunteer Driver (Must Attached with volunteer driver form. Please upload the attachment under Attachment column below)
            </label>
        </div>
    <div id="driver_requested"></div>
  </div>


  <div class="form-group driver-name hide">
    <label for="driver_name">Name / Designation of Designated Driver (*)</label>
    {!! Form::text('driver_name',NULL,['class'=>'form-control width-50', 'id'=>'driver_name']) !!}
  </div>


  <div class="form-group">
        <label for="vehicle_type">Vehicle Type (Please tick*)</label>
        <div class="radio">
            <label>
                {!! Form::radio('vehicle_type', 1) !!} Passenger Van (PC3570X) @ $20/HR.
            </label>
            <label>
                {!! Form::radio('vehicle_type', 2) !!} Goods Van (GBC9944C) @ $20/HR.
            </label>
        </div>
    <div id="vehicle_type"></div>
  </div>


  <div class="form-group">
    <label for="number_of_hours">Time duration (*)</label>
    {!! Form::text('number_of_hours',NULL,['class'=>'form-control width-20', 'readonly'=>'readonly']) !!}
    {!! Form::hidden('number_of_minutes',NULL,['class'=>'form-control width-20', 'readonly'=>'readonly']) !!}
    <div class="calculation-amount">x $<span class="vehicle_amount">0</span>/hour ($<span class="vehicle_amount_minutes">0</span>/minutes) <span class="vh_m"></span></div>
    <div id="number_of_hours"></div>
  </div>

  <div class="form-group">
    <label for="total_amount">Total Amount to Pay (* omit $ sign)</label>
    {!! Form::text('total_amount',NULL,['class'=>'form-control width-20', 'id'=>'total_amount', 'readonly'=>'readonly']) !!}
  </div>


  <script type="text/javascript">

      function calculateTotalAmountVan(){
	if($('input[name=vehicle_type]').is(':checked')){
		var getInitial =  $('input[name=number_of_minutes]').val();
	    getMin = (getInitial != '' ? getInitial : 0 );
	    total = parseFloat(getMin, 10) * parseFloat(0.33333334, 10);
	    $('#total_amount').val(total.toFixed(2));
	 }
}

function calculateTime(now, then){
	var diff = moment.duration(moment(then).diff(moment(now)));
	var hrs = parseInt(diff.asHours());
	var mins = Math.floor(diff.asMinutes()) - hrs * 60;
	$('input[name=number_of_hours]').val(hrs + ' hours and ' + mins + ' minutes');

	var calulcatedMinute = parseInt(diff.asMinutes());
	$('input[name=number_of_minutes]').val(calulcatedMinute);
}
    $(document).ready(function(){

        $('input[name=vehicle_type]').on('change', function(){
            var getVal =  $(this).val();
            var getInitial =  $('input[name=number_of_minutes]').val();

     var rates = document.getElementsByName('driver_requested');
var rate_value;
for(var i = 0; i < rates.length; i++){
    if(rates[i].checked){
        getdriver = rates[i].value;
    }
}

            getMin = (getInitial != '' ? getInitial : 0 );

            $('.vehicle_amount').html('20');
            $('.vehicle_amount_minutes').html('0.3334');
            total = parseFloat(getMin, 10) * parseFloat(0.20, 10);
            var now  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);

                var mydate = new Date(now);
    var n = mydate.getDay();

          if( n == 6 || n == 0 ){

              if(getdriver =='2' || getdriver=='3'){
                total = 0;
              }else
              {
                   total = parseFloat(getMin, 10) * parseFloat(0.33333334, 10);
              }

}else{
        total = parseFloat(getMin, 10) * parseFloat(0.33333334, 10);

}

            $('#total_amount').val(total.toFixed(2));

            /*comment out because of the same value */
            // if(getVal == '1'){
            //    $('.vehicle_amount').html('20');
            //    total = parseFloat(getMin, 10) * parseFloat(1.333, 10);
            //    $('#total_amount').val(total);

            // } else {
            //    $('.vehicle_amount').html('20');
            //    total = parseFloat(getMin, 10) * parseFloat(1.333, 10);
            //    $('#total_amount').val(total);
            // }
        });

         $('input[name=driver_requested]').on('change', function(){
           var getVal =  $(this).val();

	var now  = moment($('.start_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);
	var then = moment($('.end_date_hour').val(), ["YYYY-MM-DD hh:mm:ss a"]);

         var mydate = new Date(now);
    var n = mydate.getDay();



           if(getVal == '2' || getVal == '3'){
              $('.driver-name').removeClass('hide').addClass('show');
              	      if( n == 6 || n == 0 ){

calculateTime(now,then);
total = 0;
 $('#total_amount').val(total.toFixed(2));
}
else{

	calculateTime(now,then);
	calculateTotalAmountVan();
    }
           } else {

	calculateTime(now,then);
	calculateTotalAmountVan();

              $('.driver-name').addClass('hide').removeClass('show');
           }
        });
    });
  </script>
