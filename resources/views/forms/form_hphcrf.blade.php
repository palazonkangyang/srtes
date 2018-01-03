
  <div class="form-group">
    <label for="booking_date">Date(s) and Time of booking</label>
    <div class="range_text row">
      <div class="col-md-12">
      From
      {!! Form::text('booking_date_start',NULL,['class'=>'form-control width-40 start_date_nh']) !!}
      To
      {!! Form::text('booking_date_end',NULL,['class'=>'form-control width-40 end_date_nh']) !!}
      </div>
    </div>
    <div id="booking_date_start"></div>
    <div id="booking_date_end"></div>
  </div>

  <div class="form-group">
    <label for="purpose_of_use">Purpose of Use (*)</label>
    {!! Form::text('purpose_of_use',NULL,['class'=>'form-control', 'id'=>'purpose_of_use']) !!}
  </div>

  <div class="condition-text">
    <h3>Layout Arrangement required - (Please tick one of the below)</h3>
    <ol>
      <li>Theatre room style refers to 5 seats in a row and without tables</li>
      <li>Classroom style refers to 2 tables a row with 2 chairs each</li>
      <li>Sound system refers to the existing Haw Par Hall sound system</li>
      <li>Please inform Admin Dept at least 3 working days in advance for the request of booking</li>
      <li>Requesting Department is to check availability and place their reservation on the Google Calendar</li>
    </ol>
  </div>


  <div class="form-group">
        <div class="radio">
            <label>
                {!! Form::radio('layout_arrangement', 1) !!} Theatre Room Style
            </label>
            <label>
                {!! Form::radio('layout_arrangement', 2) !!} Classroom Style
            </label>
             <label>
                {!! Form::radio('layout_arrangement', 3) !!} Others
            </label>
        </div>
    <div id="layout_arrangement"></div>
  </div>

  <div class="form-group ind-others hide">
    <label for="others">Indicate Others (*)</label>
    {!! Form::text('others',NULL,['class'=>'form-control width-50', 'id'=>'others']) !!}
    <span style="font-size:11px">[Submit desired configuration via attachment below]</span>
  </div>

  <div class="form-group">
    <label for="sound_system" style="padding-right:10px;">Sound system</label>
   <div class="radio">
     <label> {!! Form::radio('sound_system', 1,True) !!} Yes </label>     <label> {!! Form::radio('sound_system', 0) !!} No </label>
  </div>
     <div id="sound_system"></div>
  </div>

  <div class="form-group">
    <label for="number_of_pax">Number of Seating (*)</label>
    {!! Form::text('number_of_pax',NULL,['class'=>'form-control width-20', 'id'=>'number_of_pax']) !!}
  </div>

  <script type="text/javascript">
    $(document).ready(function(){

        $('input[name=layout_arrangement]').on('change', function(){
           var getVal =  $(this).val();

           if(getVal == '3'){
              $('.ind-others').removeClass('hide').addClass('show');
           } else {
              $('.ind-others').addClass('hide').removeClass('show');
           }
        });
     });
  </script>

  
