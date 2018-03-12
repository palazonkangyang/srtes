  @if($myapplist[0]->status == 0 && $mark == 'creator') 
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Type (*)</div>
  <div class="col-md-10 bg-ff">
        {!! Form::select('type',  [''=>'-- Select Type --', 'Create'=>'Create','Add Member'=>'Add Member','Remove Member'=>'Remove Member'], $forminfo->type, ['class'=>'form-control', 'id'=>'type']  ); !!}
  </div>
  </div>
     <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Address (*)</div>
  <div class="col-md-10 bg-ff">
      {!! Form::text('email_address',$forminfo->email_address,['class'=>'form-control', 'id'=>'email_address']) !!}
    </div>
  </div>

   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Group Exist (*)</div>
  <div class="col-md-10 bg-ff">
                @if($forminfo->group_exist == 1)
            <label>             
                {!! Form::radio('group_exist', 1, true) !!} Yes
            </label>
            <label>
                {!! Form::radio('group_exist', 0) !!} No
            </label>
                @else
                  <label>             
                {!! Form::radio('group_exist', 1) !!} Yes
            </label>
            <label>
                {!! Form::radio('group_exist', 0,true) !!} No
            </label>
                @endif
        </div>
   </div>

  
    
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Group Email Address (*)</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('group_email',$forminfo->group_email,['class'=>'form-control ', 'id'=>'group_email']) !!}
      </div>
   </div>
  
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Instructions (*)</div>
  <div class="col-md-10 bg-ff">
     {!! Form::textarea('instructions', $forminfo->instructions, ['class' => 'ckeditor form-control']) !!}
  </div>
    </div>

    @else
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Type</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->type }}
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Address</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->email_address }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Group Exist</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->group_exist == 1)
      Yes
    @else
      No
    @endif
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Group Email Address</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->group_email }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Instructions</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->instructions !!}
  </div>
  </div>
         @endif