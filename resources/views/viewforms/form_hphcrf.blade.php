  @if($myapplist[0]->status == 0 && $mark == 'creator')
   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date(s) and Time of booking</div>
  <div class="col-md-10 bg-ff">
        &nbsp;From
      {!! Form::text('booking_date_start',$forminfo->booking_date_start,['class'=>'form-control width-40 start_date_nh']) !!}
         &nbsp;To
      {!! Form::text('booking_date_end',$forminfo->booking_date_end,['class'=>'form-control width-40 end_date_nh']) !!}
      </div>
    </div>


  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Purpose of Use</div>
  <div class="col-md-10 bg-ff">
    {!! Form::text('purpose_of_use',$forminfo->purpose_of_use,['class'=>'form-control', 'id'=>'purpose_of_use']) !!}
  </div>
  </div>

    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Layout Arrangement required</div>
  <div class="col-md-10 bg-ff">
   <ol>
      <li>Theatre room style refers to 5 seats in a row and without tables</li>
      <li>Classroom style refers to 2 tables a row with 2 chairs each</li>
      <li>Sound system refers to the existing Haw Par Hall sound system</li>
      <li>Please inform Admin Dept at least 3 working days in advance for the request of booking</li>
      <li>Requesting Department is to check availability and place their reservation on the Google Calendar</li>
    </ol>
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Layout Arrangement</div>
  <div class="col-md-10 bg-ff">
     <div class="radio">
    @if($forminfo->layout_arrangement == '1')
        <label>
                {!! Form::radio('layout_arrangement', 1,True) !!} Theatre Room Style
            </label>
           <label>
                {!! Form::radio('layout_arrangement', 2) !!} Classroom Style
            </label>
              <label>
                {!! Form::radio('layout_arrangement', 3) !!}  Others
            </label>
    @elseif($forminfo->layout_arrangement == '2')
        <label>
                {!! Form::radio('layout_arrangement', 1) !!}     Classroom Style
            </label>
           <label>
                {!! Form::radio('layout_arrangement', 2,True) !!}     Theatre Room Style
            </label>
           <label>
                {!! Form::radio('layout_arrangement', 2) !!}      Others
            </label>
    @else
       <label>
                {!! Form::radio('layout_arrangement', 1) !!}     Classroom Style
            </label>
           <label>
                {!! Form::radio('layout_arrangement', 2) !!}     Theatre Room Style
            </label>
           <label>
                {!! Form::radio('layout_arrangement', 3,True) !!}      Others
            </label>
    @endif
    <br />
    </div>
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Sound System</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->sound_system == 1)
       {!! Form::checkbox('sound_system', 1,True) !!}
    @else
      {!! Form::checkbox('sound_system', 1) !!}
    @endif
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of Seating </div>
  <div class="col-md-10 bg-ff">
     {!! Form::text('number_of_pax',$forminfo->number_of_pax,['class'=>'form-control width-20', 'id'=>'number_of_pax']) !!}
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
  <div class="col-md-2 bg-cc">Layout Arrangement</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->layout_arrangement == 1)
       Theatre Room Style
    @elseif($forminfo->layout_arrangement == 2)
       Classroom Style
    @elseif($forminfo->layout_arrangement == 3)
       Others ({{$forminfo->others}})
    @endif
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Sound System</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->sound_system == 1)
       With Sound System
    @else
      None
    @endif
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of Seating </div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->number_of_pax }}
  </div>
  </div>
  @endif
