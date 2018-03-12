  @if($myapplist[0]->status == 0 && $mark == 'creator')  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date(s) and Time of booking</div>
  <div class="col-md-10 bg-ff">
    From
      {!! Form::text('booking_date_start',$forminfo->booking_date_start,['class'=>'form-control width-40 start_date_hour']) !!}
      To
      {!! Form::text('booking_date_end',$forminfo->booking_date_end,['class'=>'form-control width-40 end_date_hour']) !!}
  </div>
  </div>
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Purpose of Use</div>
  <div class="col-md-10 bg-ff">
 {!! Form::text('purpose_of_use',$forminfo->purpose_of_use,['class'=>'form-control', 'id'=>'purpose_of_use']) !!}
  </div>
  </div>
  
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Driver Requested</div>
  <div class="col-md-10 bg-ff">
   
       <div class="radio">
    @if($forminfo->driver_requested == '1')
        <label>
                {!! Form::radio('driver_requested', 1,True) !!}   With Driver 
            </label>
           <label>
                {!! Form::radio('driver_requested', 2) !!}   Without Driver
            </label>
              <label>
                {!! Form::radio('driver_requested', 3) !!}  Volunteer Driver
            </label>
    @elseif($forminfo->driver_requested == '2')
        <label>
                {!! Form::radio('driver_requested', 1) !!}       With Driver 
            </label>
           <label>
                {!! Form::radio('driver_requested', 2,True) !!}       Without Driver
            </label>
           <label>
                {!! Form::radio('driver_requested', 3) !!}      Volunteer Driver
            </label>
    @else
       <label>
                {!! Form::radio('driver_requested', 1) !!}      With Driver 
            </label>
           <label>
                {!! Form::radio('driver_requested', 2) !!}      Without Driver
            </label>
           <label>
                {!! Form::radio('driver_requested', 3,True) !!}      Volunteer Driver
            </label>
    @endif
    <br />
    </div>
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Name / Designation of Designated Driver</div>
  <div class="col-md-10 bg-ff">
        @if($forminfo->driver_requested == 2 || $forminfo->driver_requested == 3)
      {!! Form::text('driver_name',$forminfo->driver_name,['class'=>'form-control', 'id'=>'driver_name']) !!} 
   @else 
      {!! Form::text('driver_name',$forminfo->driver_name,['class'=>'form-control hide', 'id'=>'driver_name']) !!} 
  
   @endif
 </div>
 </div>
 
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vehicle Type</div>
  <div class="col-md-10 bg-ff">
    <div class="radio">   
         @if($forminfo->vehicle_type == '1')
            <label>
                {!! Form::radio('vehicle_type', 1,true) !!} Passenger Van (PC3570X) @ $45/HR.
            </label>
            <label>
                {!! Form::radio('vehicle_type', 2) !!} Goods Van (GBC9944C) @ $45/HR.
            </label>
         @else
          <label>
                {!! Form::radio('vehicle_type', 1) !!} Passenger Van (PC3570X) @ $45/HR.
            </label>
            <label>
                {!! Form::radio('vehicle_type', 2,true) !!} Goods Van (GBC9944C) @ $45/HR.
            </label>
         @endif
        </div>
    <br />
    &nbsp;
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Time duration</div>
  <div class="col-md-10 bg-ff">
    {!! Form::text('number_of_hours',$forminfo->number_of_hours,['class'=>'form-control width-20', 'readonly'=>'readonly']) !!}
    {!! Form::hidden('number_of_minutes',$forminfo->number_of_minutes,['class'=>'form-control width-20', 'readonly'=>'readonly']) !!}
    <div class="calculation-amount">x $<span class="vehicle_amount">0</span>/hour ($<span class="vehicle_amount_minutes">0</span>/minutes) <span class="vh_m"></span></div>
    <div id="number_of_hours"></div>
  
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Total Payment</div>
  <div class="col-md-10 bg-ff">
    {!! Form::text('total_amount',$forminfo->total_amount,['class'=>'form-control width-20', 'id'=>'total_amount', 'readonly'=>'readonly']) !!}
   </div>
  </div>
  @else 
<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date(s) and Time of booking</div>
  <div class="col-md-10 bg-ff">
    <strong>&nbsp;From:&nbsp;</strong>
    {!! date('j F Y, g:i a', strtotime($forminfo->booking_date_start)) !!}
    <strong>&nbsp;To:&nbsp;</strong>
    {!! date('j F Y, g:i a', strtotime($forminfo->booking_date_end)) !!}
    <br /> &nbsp;
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Purpose of Use</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->purpose_of_use }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Driver Requested</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->driver_requested == 1)
      With Driver 
    @elseif($forminfo->driver_requested == 2)
      Without Driver
    @elseif($forminfo->driver_requested == 3)
      Volunteer Driver
    @endif
    <br />
    &nbsp;
  </div>
  </div>

  @if($forminfo->driver_requested == 2 || $forminfo->driver_requested == 3)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Name / Designation of Designated Driver</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->driver_name }}
    <br />&nbsp;
  </div>
  </div>
  @endif

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vehicle Type</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->vehicle_type == 1)
      Passenger Van (PC3570X) @ $45/HR.
    @elseif($forminfo->vehicle_type == 2)
      Goods Van (GBC9944C) @ $45/HR.
    @endif
    <br />
    &nbsp;
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Time duration</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->number_of_hours !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Total Payment</div>
  <div class="col-md-10 bg-ff">
    ${!! $forminfo->total_amount !!}
  </div>
  </div>

@endif

 <script type="text/javascript">
    $(document).ready(function(){
  $('.vehicle_amount').html('45');
            $('.vehicle_amount_minutes').html('0.75');
        

        $('input[name=vehicle_type]').on('change', function(){
            var getVal =  $(this).val();
            var getInitial =  $('input[name=number_of_minutes]').val();
            getMin = (getInitial != '' ? getInitial : 0 );
            
            $('.vehicle_amount').html('45');
            $('.vehicle_amount_minutes').html('0.75');
            total = parseFloat(getMin, 10) * parseFloat(0.75, 10);
            $('#total_amount').val(total.toFixed(2));

            /*comment out because of the same value */
            // if(getVal == '1'){
            //    $('.vehicle_amount').html('45');
            //    total = parseFloat(getMin, 10) * parseFloat(1.333, 10);
            //    $('#total_amount').val(total);

            // } else {
            //    $('.vehicle_amount').html('45');
            //    total = parseFloat(getMin, 10) * parseFloat(1.333, 10);
            //    $('#total_amount').val(total);
            // }
        });

   $('input[name=driver_requested]').on('change', function(){
   var getVal =  $(this).val();  
           if(getVal == '1'){
           $('#driver_name').removeClass('show').addClass('hide');
             
           } else {
              $('#driver_name').addClass('show').removeClass('hide');
           }
        });
        
        });
  </script>
  