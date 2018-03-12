

  
    <div class="form-group">
            <label for="type">Type  (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::checkbox('type1',1) !!} Goods
            </label>
            <label>
                {!! Form::checkbox('type2',1) !!} Services
            </label>
       
        </div>
    <div id="type"></div>
  </div>
  
   <div class="form-group hide goods">
    <label for="goods">Goods  (*)</label>
    {!! Form::text('goods',NULL,['class'=>'form-control ', 'id'=>'goods']) !!}
  </div>
  
<div class="form-group hide services">
    <label for="services">Services  (*)</label>
    {!! Form::text('services',NULL,['class'=>'form-control ', 'id'=>'services']) !!}
  </div>

<div class="form-group">
    <label for="estimate_value">Estimate Value of Purchase(*)</label>
    {!! Form::text('estimate_value',NULL,['class'=>'form-control ', 'id'=>'estimate_value']) !!}
  </div>

 

<div class="form-group">
            <label for="type_source">Type of Training  (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('type_source', 1) !!} Budgeted
            </label>
            <label>
                {!! Form::radio('type_source', 2) !!} Unbudgeted
            </label>
            <label>
                {!! Form::radio('type_source', 3) !!} Funding
            </label>
             
        </div>
    <div id="type_source"></div>
  </div>

 <div class="form-group funding_desc hide">
    <label for="funding_desc">Funding  (*)</label>
    {!! Form::text('funding_desc',NULL,['class'=>'form-control ', 'id'=>'funding_desc']) !!}
  </div>

 <div class="form-group">
            <label for="type_reason">Reasons for new purchase  (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('type_reason',1) !!} Replacement of goods/services
            </label>
            <label>
                {!! Form::radio('type_reason',2) !!} New goods/services
            </label>
           <label>
                {!! Form::radio('type_reason',3) !!} Others
            </label>
        </div>
    <div id="type_reason"></div>
  </div>

<div class="form-group reason_desc hide">
    <label for="reason_desc">Others  (*)</label>
    {!! Form::text('reason_desc',NULL,['class'=>'form-control ', 'id'=>'reason_desc']) !!}
  </div>

<div class="form-group detailed_information">
    <label for="detailed_information">Detailed Information (*)</label>
    {!! Form::textarea('detailed_information',NULL,['class'=>'form-control ', 'id'=>'detailed_information']) !!}
  </div>

<div class="form-group">
    <label for="date_required">Required by / Event Date (*)</label>
    <div class="range_text row">
      <div class="col-md-12">
             {!! Form::text('date_required',NULL,['class'=>'form-control width-40 date_required_irfi']) !!}
      </div>
    </div>
  </div>

<div class="form-group">
    <label for="vendor_company"> Recommended vendor company  </label>
    {!! Form::text('vendor_company',NULL,['class'=>'form-control ', 'id'=>'vendor_company']) !!}
  </div>

 <div class="form-group">
    <label for="vendor_person">Vendor person  </label>
    {!! Form::text('vendor_person',NULL,['class'=>'form-control ', 'id'=>'vendor_person']) !!}
  </div>

 <div class="form-group">
    <label for="vendor_contact">Vendor contact  </label>
    {!! Form::text('vendor_contact',NULL,['class'=>'form-control ', 'id'=>'vendor_contact']) !!}
  </div>

  
  

  <script type="text/javascript">
    $(document).ready(function(){
 
 
    $('.date_required_irfi').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});

 
        $('input[name=type1]').on('change', function(){
       if(this.checked) {
              $('.goods').removeClass('hide').addClass('show');
           } else {
              $('.goods').addClass('hide').removeClass('show');
           }
    
        });
    
     $('input[name=type2]').on('change', function(){
       if(this.checked) {
              $('.services').removeClass('hide').addClass('show');
           } else {
              $('.services').addClass('hide').removeClass('show');
           }
    
        });
        
        $('input[name=type_source]').on('change', function(){
           var getVal =  $(this).val();

           if(getVal == '3'){
              $('.funding_desc').removeClass('hide').addClass('show');
           } else {
              $('.funding_desc').addClass('hide').removeClass('show');
           }
        });
        
         $('input[name=type_reason]').on('change', function(){
           var getVal =  $(this).val();

           if(getVal == '3'){
              $('.reason_desc').removeClass('hide').addClass('show');
           } else {
              $('.reason_desc').addClass('hide').removeClass('show');
           }
        });
     });
  </script>
  
  