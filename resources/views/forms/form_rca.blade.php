
  <div class="form-group">
    <label for="type_of_request">Number of Copies (*)</label>
    {!! Form::text('number_of_copies',NULL,['class'=>'form-control width-20', 'id'=>'number_of_copies']) !!}
  </div>
  
  
  <div class="form-group">
    <label for="type_of_request">Reasons For Request (*)</label>
     {!! Form::textarea('reasons_for_request', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  <div class="form-group">
  	<div id="reasons_for_request"></div>
  </div>
  
  
  <div class="condition-text">
  	<h3>Conditions</h3>
  	<ol>
  		<li>$0.50 per piece will be charged to the Requesting Department</li>
  		<li>Certificate to be collected at Administration Department</li>
  	</ol>
  </div>
  
  
  <div class="form-group checkbox">
     <label>{!! Form::checkbox('conditions', '1') !!} I understand and accept all the terms and conditions as stated.</label>
     <div id="conditions"></div>
  </div>
  