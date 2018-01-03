  
  <div class="form-group">
    <label for="type">Please tick either 1 or 2 (*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('type', 1) !!} Creation of Account
            </label>
            <label>
                {!! Form::radio('type', 2) !!} Deletion of Account
            </label>
        </div>
    <div id="type"></div>
  </div>

  <div class="creation hide">
  <div class="form-group">
    <label for="employees_name"> Enter Employee's name(*)</label>
    {!! Form::text('employees_name',NULL,['class'=>'form-control width-50', 'id'=>'employees_name']) !!}
  </div>

  <div class="form-group">
    <label for="type">Able to</label>
        <div class="radio">   
            <label>
                {!! Form::checkbox('create_prpo', 1) !!} Create PR and Do Receiving
            </label>
            <label>
                {!! Form::checkbox('approve_pr', 1) !!} Approve PR
            </label>
            <label>
                {!! Form::checkbox('others', 1) !!} Others
            </label>
        </div>
    <div id="create_prpo"></div>
    <div id="approve_pr"></div>
    <div id="others"></div>
  </div>

  
  </div>
  

  <div class="form-group others hide">
    <label for="others_name"> Others(*)</label>
    {!! Form::text('others_name',NULL,['class'=>'form-control', 'id'=>'others_name']) !!}
  </div>

  
  <div class="form-group deletion hide">
    <label for="reasons">Reasons for deletion (*)</label>
     {!! Form::textarea('reasons', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  <div class="form-group">
  	<div id="reasons"></div>
  </div>
  

  <script type="text/javascript">
    $(document).ready(function(){

        $('input[name=type]').on('change', function(){
           var getVal =  $(this).val();

           if(getVal == '1'){
              $('.creation').removeClass('hide').addClass('show');
              $('.deletion').addClass('hide').removeClass('show');
           } else {
              $('.deletion').removeClass('hide').addClass('show');
              $('.creation').addClass('hide').removeClass('show');
           }
        });


        $('input[name=others]').on('change', function(){

           if($(this).prop('checked') == true){
              $('.others').addClass('show').removeClass('hide');
           } else {
              $('.others').removeClass('show').addClass('hide');
           }
        });


    });
  </script>
  