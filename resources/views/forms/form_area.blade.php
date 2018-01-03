
  <div class="form-group">
    <label for="type_of_request">Please indicate desired Email Account name (*)</label>
    {!! Form::text('email_account_name',NULL,['class'=>'form-control width-50', 'id'=>'email_account_name']) !!}
  </div>
  
  
  <div class="form-group">
    <label for="type_of_request">Reasons (*)</label>
     {!! Form::textarea('reasons', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  <div class="form-group">
  	<div id="reasons"></div>
  </div>
  
  <div class="form-group checkbox">
     <label>{!! Form::checkbox('conditions', '1') !!} I have read the <a href="https://docs.google.com/a/redcross.sg/document/d/1-x2LxaeK-Ut8bqS2_OhCKSGX1bVH2dUvklronl6h0oU" target="_blank">IT policy of Singapore Redcross Society</a> and will adhere by it.</label>
     <div id="conditions"></div>
  </div>
  