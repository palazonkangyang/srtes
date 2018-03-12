  @if($myapplist[0]->status == 0 && $mark == 'creator')
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Address</div>
  <div class="col-md-10 bg-ff">
     {!! Form::text('email_address',$forminfo->email_address,['class'=>'form-control width-50', 'id'=>'email_address']) !!}
 
  </div>
  </div>
   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
       <div class="radio">   
            <label class="display-block">
                 @if($forminfo->account_unused == 1)
                   {!! Form::checkbox('account_unused', 1,true) !!}  Account unused / underutilised
                  @else
                {!! Form::checkbox('account_unused', 1) !!}  Account unused / underutilised
                @endif
            </label>
            <label class="display-block">
                  @if($forminfo->staff_departure == 1)
                   {!! Form::checkbox('staff_departure', 1,true) !!} Staff Departure
                  @else
                {!! Form::checkbox('staff_departure', 1) !!} Staff Departure
                @endif
            </label>
         <label class="display-block">
                  @if($forminfo->project_closed == 1)
                   {!! Form::checkbox('project_closed', 1,true) !!} Project closed / archived
                  @else
                {!! Form::checkbox('project_closed', 1) !!} Project closed / archived
                @endif
            </label>
  
    </div>
  </div>
  </div>
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Transfer Google Drive Files</div>
  <div class="col-md-10 bg-ff">
       <div class="radio">
    @if($forminfo->transfer_google_files == '1')
        <label>
                {!! Form::radio('transfer_google_files', 1,True) !!} Yes
            </label>
           <label>
                {!! Form::radio('transfer_google_files', 2) !!} No
            </label>
    @else
      <label>
                {!! Form::radio('transfer_google_files', 1) !!} Yes
            </label>
           <label>
                {!! Form::radio('transfer_google_files', 2,True) !!} No
            </label>
    @endif
    <br />
    </div>
  </div>
  </div>

  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Destination</div>
  <div class="col-md-10 bg-ff">
     @if($forminfo->transfer_google_files == '1')
    {!! Form::text('email_destination',$forminfo->email_destination,['class'=>'form-control', 'id'=>'email_destination']) !!} </div>
   @else 
      {!! Form::text('email_destination',$forminfo->email_destination,['class'=>'form-control hide', 'id'=>'email_destination']) !!} </div>
  
   @endif
  </div>
  </div>
 
    @else
<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Address</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->email_address }}
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->account_unused == 1)
       Account unused / underutilised
    @endif
    @if($forminfo->staff_departure == 1)
       , Staff Departure
    @endif
    @if($forminfo->project_closed == 1)
       , Project closed / archived
    @endif
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Transfer Google Drive Files</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->transfer_google_files == 1)
      Yes 
    @else
      No
    @endif
    <br />
    &nbsp;
  </div>
  </div>

  @if($forminfo->transfer_google_files == 1)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Email Destination</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->email_destination }}
  </div>
  </div>
  @endif
    @endif
     <script type="text/javascript">
    $(document).ready(function(){

   $('input[name=transfer_google_files]').on('change', function(){
   var getVal =  $(this).val();  
           if(getVal == '1'){
          
              $('#email_destination').addClass('show').removeClass('hide');
           } else {
              $('#email_destination').removeClass('show').addClass('hide');
           }
        });
        
        });
  </script>
  