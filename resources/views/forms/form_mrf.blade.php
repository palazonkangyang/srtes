
  <div class="form-group">
    <label for="position">Position  (*)</label>
    {!! Form::text('position',NULL,['class'=>'form-control ', 'id'=>'position']) !!}
  </div>
  
  <div class="form-group">
    <label for="job_grade">Job Grade  (*)</label>
    {!! Form::text('job_grade',NULL,['class'=>'form-control ', 'id'=>'job_grade']) !!}
  </div>
  
   <div class="form-group">
    <label for="location">Location  (*)</label>
    {!! Form::text('location',NULL,['class'=>'form-control ', 'id'=>'location']) !!}
  </div>
  
<div class="form-group">
    <label for="job_type">Job Type  (*)</label>
              {!! Form::select('job_type', array(null=>'Please Select','1' => 'Full Time', '2' => 'Part Time', '3' => 'Temporary', '4' => 'Contract for Service', '5' => 'Auxilliary Staff'),NULL , array('class'=>'form-control', 'id' => 'job_type')); !!}
  </div>

<div class="form-group full_time_option hide">
    <label for="balance">Full Time Option  (*)</label>
       {!! Form::select('full_time_option', array(null=>'Please Select','1' => 'Replacement due to resignation /termination / transfer / end of contract', '2' => 'Filling a newly approved and budgeted', '3' => 'Filling a newly non-approved and non-budgeted position'),NULL , array('class'=>'form-control', 'id' => 'full_time_option')); !!}
 </div>


 <div class="form-group full_type_desc hide">
    <label for="full_type_desc">Replacement for / & Designation    </label>
    {!! Form::text('full_type_desc',NULL,['class'=>'form-control ', 'id'=>'full_type_desc']) !!}
  </div>



 <div class="form-group full_type_desc3 hide">
    <label for="full_type_desc3">Reasons   </label>
    {!! Form::text('full_type_desc3',NULL,['class'=>'form-control ', 'id'=>'full_type_desc3']) !!}
  </div>

<div class="form-group no_months hide">
    <label for="balance">Number of Months  (*)</label>
       {!! Form::select('no_months', array(null=>'Please Select','1'=> 1, '2' =>2,'3' =>3,'4' =>4,'5' =>5,'6' =>6,'7' =>7,'8' =>8,'9' =>9,'10'=>10,'11'=>11,'12'=>12),NULL , array('class'=>'form-control width-40', 'id' => 'no_months')); !!}
 </div>

<div class="form-group no_hoursday hide">
    <label for="balance">Number of hours/day  (*)</label>
      {!! Form::select('no_hoursday', array(null=>'Please Select','4'=> 4, '8' =>8),NULL , array('class'=>'form-control width-40', 'id' => 'no_hoursday')); !!}
 </div>

<div class="form-group no_daysweek hide">
    <label for="balance">Number of days/week  (*)</label>
       {!! Form::select('no_daysweek', array(null=>'Please Select','1'=> 1, '2' =>2,'3' =>3,'4' =>4,'5' =>5),NULL , array('class'=>'form-control width-40', 'id' => 'no_daysweek')); !!}
 </div>

 <div class="form-group desc_works hide">
    <label for="desc_works">Describe Hours of work  (*)</label>
    {!! Form::text('desc_works',NULL,['class'=>'form-control ', 'id'=>'desc_works']) !!}
  </div>



<script type="text/javascript">
$(document).ready(function(){
     
     
    $('#job_type').on('change', function(){
           var getVal =  $(this).val();
     
      if(getVal == '1' ){
              $('.full_time_option').removeClass('hide').addClass('show');
                $('.no_months').addClass('hide').removeClass('show');
                  $('.no_hoursday').addClass('hide').removeClass('show');
                    $('.no_daysweek').addClass('hide').removeClass('show');
                     $('.desc_works').addClass('hide').removeClass('show');
        
                        var full_time_option_value =  $('#full_time_option').val();
                      if(full_time_option_value=1){
                                  $('.full_type_desc').addClass('show').removeClass('hide');
                     
                      }else if(full_time_option_value=2){
            
                      }else if (full_time_option_value=3){
                            $('.full_type_desc3').addClass('show').removeClass('hide');
                             $('.full_type_desc3').addClass('show').removeClass('hide');
                      }
                     
           } else {
             
                $('.no_months').removeClass('hide').addClass('show');
                  $('.no_hoursday').removeClass('hide').addClass('show');
                    $('.no_daysweek').removeClass('hide').addClass('show');
                     $('.full_time_option').addClass('hide').removeClass('show');
                        $('.full_type_desc3').addClass('hide').removeClass('show');
              $('.full_type_desc').addClass('hide').removeClass('show');
         if(getVal == '5' ){
       
         $('.desc_works').addClass('hide').removeClass('show');
           }else{
                $('.desc_works').removeClass('hide').addClass('show');
           }
           }
        });
        
         $('#full_time_option').on('change', function(){
           var getVal =  $(this).val();
        
        if(getVal == '1' ){
              $('.full_type_desc').removeClass('hide').addClass('show');
                $('.full_type_desc3').addClass('hide').removeClass('show');
               
           } else if (getVal == '2') {
                      $('.full_type_desc3').addClass('hide').removeClass('show');
               $('.full_type_desc').addClass('hide').removeClass('show');
       
           } else  {
                  $('.full_type_desc3').removeClass('hide').addClass('show');
              $('.full_type_desc').addClass('hide').removeClass('show');
         
               
           }
               });
});
  </script>