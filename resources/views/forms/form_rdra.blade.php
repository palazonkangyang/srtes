  <div class="form-group">
      <label for="email_address">Please indicate email address (*)</label>
      {!! Form::text('email_address',NULL,['class'=>'form-control width-50', 'id'=>'email_address']) !!}
    </div>
    
  <div class="form-group">
    <label for="type">Reasons: (*)</label>
        <div class="radio">   
            <label class="display-block">
                {!! Form::checkbox('account_unused', 1) !!} Account unused / underutilised
            </label>
            <label class="display-block">
                {!! Form::checkbox('staff_departure', 1) !!} Staff Departure
            </label>
            <label class="display-block">
                {!! Form::checkbox('project_closed', 1) !!} Project closed / archived
            </label>
        </div>
    <div id="account_unused"></div>
    <div id="staff_departure"></div>
    <div id="project_closed"></div>
  </div>


  <div class="form-group">
    <label for="transfer_google_files">Transfer Google Drive Files? (*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('transfer_google_files', 1) !!} Yes
            </label>
            <label>
                {!! Form::radio('transfer_google_files', 2) !!} No
            </label>
        </div>
    <div id="transfer_google_files"></div>
  </div>

  <div class="form-group email-destination hide">
    <label for="email_destination">If yes, indicate destination email account:</label>
     {!! Form::text('email_destination', null, ['class' => 'width-50 form-control', 'id'=>'email_destination']) !!}
  </div>
  

  <script type="text/javascript">
    $(document).ready(function(){

        $('input[name=transfer_google_files]').on('change', function(){
           var getVal =  $(this).val();

           if(getVal == '1'){
              $('.email-destination').removeClass('hide').addClass('show');
             
           } else {

              $('.email-destination').addClass('hide').removeClass('show');
           }
        });
    });
  </script>