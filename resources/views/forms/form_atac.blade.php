  <div class="form-group">
    <label for="fullname">Fullname as in NRIC (*)</label>
    {!! Form::text('fullname',NULL,['class'=>'form-control width-50 ', 'id'=>'fullname']) !!}
  </div>

  <div class="form-group">
    <label for="nric">NRIC (*)</label>
    {!! Form::text('nric',NULL,['class'=>'form-control width-20', 'id'=>'nric']) !!}
  </div>

  <div class="form-group">
    <label for="address">Address (*)</label>
    {!! Form::textarea('address',NULL,['class'=>'form-control width-50', 'id'=>'address', 'rows'=>'5']) !!}
  </div>

  <div class="form-group">
    <label for="telephone">Tel #</label>
    {!! Form::text('telephone',NULL,['class'=>'form-control width-20', 'id'=>'telephone']) !!}
  </div>

  <div class="form-group">
    <label for="mobile">Mobile #</label>
    {!! Form::text('mobile',NULL,['class'=>'form-control width-20', 'id'=>'mobile']) !!}
  </div>

  <div class="form-group">
    <label for="type">Access Areas Applied: (*)</label>
        <div class="radio">   
            <label class="display-block">
                {!! Form::checkbox('srca', 1) !!} SRCA
            </label>
            <label class="display-block">
                {!! Form::checkbox('admin_fr_ccm', 1) !!} Admin/FR/CCM
            </label>
            <label class="display-block">
                {!! Form::checkbox('hr_is', 1) !!} HR/IS
            </label>
            <label class="display-block">
                {!! Form::checkbox('mvd_rcy_cs', 1) !!} MVD/RCY/CS
            </label>
            <label class="display-block">
                {!! Form::checkbox('rear_entrance', 1) !!} Rear Entrance
            </label>
            <label class="display-block">
                {!! Form::checkbox('meeting_room', 1) !!} Meeting Room 1
            </label>
            <label class="display-block">
                {!! Form::checkbox('thrift_shop', 1) !!} Thrift Shop
            </label>
        </div>
    <div id="srca"></div>
    <div id="admin_fr_ccm"></div>
    <div id="hr_is"></div>
    <div id="mvd_rcy_cs"></div>
    <div id="rear_entrance"></div>
    <div id="meeting_room"></div>
    <div id="thrift_shop"></div>
  </div>

  <div class="form-group">
    <label for="booking_date">Access Period (Date)</label>
    <div class="range_text row">
      <div class="col-md-12">
      From
      {!! Form::text('access_date_start',NULL,['class'=>'form-control width-40 start_date_only']) !!}
      To
      {!! Form::text('access_date_end',NULL,['class'=>'form-control width-40 end_date_only']) !!}
      </div>
    </div>
    <div id="access_date_start"></div>
    <div id="access_date_end"></div>
  </div>

  <div class="form-group">
    <label for="reasons">Reasons (*)</label>
     {!! Form::textarea('reasons', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  <div class="form-group">
  	<div id="reasons"></div>
  </div>
  
  
  <div class="condition-text">
  	<h3>Conditions</h3>
  	<ol>
  		<li>Any loss of Access Cards must be report to Administration Department immediately</li>
      <li>Applicant must lodge a police report for the lost Card and submit the report to Administration Department</li>
      <li>Applicant will have to pay a fee of $30.00 for the lost Access Card</li>
  	</ol>
  </div>
  
  
  <div class="form-group checkbox">
     <label>{!! Form::checkbox('conditions', '1') !!} I understand and accept all the terms and conditions as stated.</label>
     <div id="conditions"></div>
  </div>
  