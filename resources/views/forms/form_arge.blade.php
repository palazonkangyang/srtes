  
    <div class="form-group">
        <label for="type_of_request">Select type (*)</label>
        {!! Form::select('type',  [''=>'-- Select Type --', 'Create'=>'Create','Add Member'=>'Add Member','Remove Member'=>'Remove Member'], NULL, ['class'=>'form-control width-50', 'id'=>'type']  ); !!}
    </div>

    <div class="form-group">
      <label for="email_address">Please indicate email address (*)</label>
      {!! Form::text('email_address',NULL,['class'=>'form-control width-50', 'id'=>'email_address']) !!}
    </div>

    <div class="form-group">
    <label for="group_exist">Does the group exist? (*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('group_exist', 1) !!} Yes
            </label>
            <label>
                {!! Form::radio('group_exist', 0) !!} No
            </label>
        </div>
    <div id="group_exist"></div>
    </div>
    
     <div class="form-group">
        <label for="type_of_request">Please indicate group email address (*)</label>
        {!! Form::text('group_email',NULL,['class'=>'form-control width-50', 'id'=>'group_email']) !!}
      </div>
  
  <div class="form-group">
    <label for="type_of_request">Instructions (*)</label>
     {!! Form::textarea('instructions', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  <div class="form-group">
  	<div id="instructions"></div>
  </div>
  
  <div class="form-group checkbox">
     <label>{!! Form::checkbox('conditions', '1') !!} I have read the <a href="https://docs.google.com/a/redcross.sg/document/d/1-x2LxaeK-Ut8bqS2_OhCKSGX1bVH2dUvklronl6h0oU" target="_blank">IT policy of Singapore Redcross Society</a> and will adhere by it.</label>
     <div id="conditions"></div>
  </div>
  