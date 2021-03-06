
<div class="form-group">
            <label for="request_type">Request Type  (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('request_type', 1 , null, ['id' => 'request_type']) !!} Normal
            </label>
            <label>
                {!! Form::radio('request_type', 2 , null, ['id' => 'request_type']) !!} Facilities Maintenance and Cashcard
            </label>  
        </div>
    <div id="request_type"></div>
  </div>
<div class="form-group cash hide ">
     <label style="color:red;"> Payment Mode - Cash</label>  
  </div>
<div class="form-group cheque hide">
     <label style="color:red;"> Payment Mode - Cheque</label>  
  </div>
  <div >
       <label for="account_code" style='width: 100%;float:left;'>Account Code  (*)</label>
                <div style='width: 30%;float:left;margin-bottom:15px;'>
              	
                  		{{-- */$getaccountcodename='';/* --}}
                  		{{-- */$getaccountcodeid='';/* --}}
                                {{-- */$getis3lpha='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id',$getaccountcodename,['placeholder' => 'Choose Account Code', 'class'=>'form-control', 'id'=>'select-accountcode']) !!}
                  	{!! Form::hidden('accountcode_id',$getaccountcodeid) !!}
                        {!! Form::hidden('is3alpha',$getis3lpha) !!}
                      
                  
                </div>
                 <div style='width: 70%;float:left;margin-bottom:15px;'>
                 {!! Form::text('p_accountcode_desc',NULL,['class'=>'form-control ','readonly'=>1,  'id'=>'p_accountcode_desc']) !!}
                    </div>
  </div>

  <div class=" hide optionalcode">
       <label for="optional_code" style='width: 100%;float:left;'>Cost Centre  (*)</label>
               <div style='width: 30%;float:left;margin-bottom:15px;'>
              	
                  		{{-- */$getoptionalcodename='';/* --}}
                  		{{-- */$getoptionalcodeid='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id',$getoptionalcodename,['placeholder' => 'Choose Cost Centre','class'=>'form-control', 'id'=>'select-optionalcode']) !!}
                  	{!! Form::hidden('optionalcode_id',$getoptionalcodeid) !!}
                    
                  
                </div>
                   <div style='width: 70%;float:left;margin-bottom:15px;'>
                 {!! Form::text('p_optionalcode_desc',NULL,['class'=>'form-control ','readonly'=>1,  'id'=>'p_optionalcode_desc']) !!}
                    </div>
         <br>
              </div>

  <div class="form-group">
    <label for="cheque_payable_to">Cheque Payable To (As per bank record)  (*)</label>
    {!! Form::text('cheque_payable_to',NULL,['class'=>'form-control ', 'id'=>'cheque_payable_to']) !!}
  </div>
  
  <div class="form-group">
    <label for="project_name">Project Name  (*)</label>
    {!! Form::text('project_name',NULL,['class'=>'form-control ', 'id'=>'project_name']) !!}
  </div>
  
   <div class="form-group">
    <label for="amount">Amount (* omit $ sign)</label>
    {!! Form::text('amount',NULL,['class'=>'form-control width-40', 'id'=>'amount']) !!}
  </div>
  


 <div class="form-group">
    <label for="date_required">Date Required (*)</label>
    <div class="range_text row">
      <div class="col-md-12">
     
      {!! Form::text('date_required',NULL,['class'=>'form-control width-40 date_required_aca']) !!}
    
      </div>
    </div>
    <div id="date_required"></div>
   
  </div>

 <div class="form-group reasons ">
    <label for="reasons">Reasons (*)</label>
     {!! Form::textarea('reasons', null, ['class' => 'form-control' ,'id'=>'reasons']) !!}
  </div>

  <div class="form-group">
    <label for="description">Description</label>
     {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
  </div>
  

  <script type="text/javascript">
      
                  function ACAjevent()
{
  
var amountsubmit = document.getElementById("amount").value;   
 var request_type = document.getElementById("request_type").value;  
     if (parseFloat(amountsubmit) >3000){
              document.getElementById("approverfield_3").disabled = false;
             document.getElementById("approverfield_4").disabled = false;
            document.getElementById("approverfield_2").disabled = true;

          
       }else{
            document.getElementById("approverfield_2").disabled = false;
            document.getElementById("approverfield_3").disabled = true;
            document.getElementById("approverfield_4").disabled = true;
        
            }
            
               if(request_type == '1'){
              $('.cheque').removeClass('hide').addClass('show');
                $('.cash').addClass('hide').removeClass('show');
                
                 if (parseFloat(amountsubmit) >5000){
              alert('Maximum $5000 only');
               $('#amount').val(0);
          }else if(parseFloat(amountsubmit) >3000){
            
            document.getElementById("approverfield_3").disabled = false;
            document.getElementById("approverfield_4").disabled = false;
            document.getElementById("approverfield_2").disabled = true;
            
          }else{
            document.getElementById("approverfield_2").disabled = false;
            document.getElementById("approverfield_3").disabled = true;
            document.getElementById("approverfield_4").disabled = true;
           
          }
    
                
           } else {
              $('.cheque').addClass('hide').removeClass('show');
               $('.cash').removeClass('hide').addClass('show');
               
                if (parseFloat(amountsubmit) >300){
              alert('Maximum $300 only');
               $('#amount').val(0);
          }else{
                document.getElementById("approverfield_2").disabled = false;
            document.getElementById("approverfield_3").disabled = true;
            document.getElementById("approverfield_4").disabled = true;
       
          }  
           }
            
}
      
      
    $(document).ready(function(){
        
               $('#select-accountcode').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc" />  ');
                   $('input[name=p_accountcode_desc]').val(suggestion.data.description);
                    if(suggestion.data.is3alpha == 1){
		    $('.optionalcode').removeClass('hide').addClass('show');  	
                }else{
                    $('.optionalcode').removeClass('show').addClass('hide');  
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc" /> ');   
              	$('input[name=p_optionalcode_desc').val(suggestion.data.description);
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
         $('#approver_1').removeClass('hide').addClass('show');
         
        $('input[name=request_type]').on('change', function(){
           var getVal =  $(this).val();
var amount = document.getElementById("amount").value;  
           if(getVal == '1'){
              $('.cheque').removeClass('hide').addClass('show');
                $('.cash').addClass('hide').removeClass('show');
                
                 if (amount >5000){
              alert('Maximum $5000 only');
               $('#amount').val(0);
          }else if(amount >3000){
         $('#approver_3').removeClass('hide').addClass('show');
          $('#approver_4').removeClass('hide').addClass('show');
                     $('#approver_2').addClass('hide').removeClass('show');
          }else{
               $('#approver_2').removeClass('hide').addClass('show');
                     $('#approver_3').addClass('hide').removeClass('show');
                       $('#approver_4').addClass('hide').removeClass('show');
          }
    
                
           } else {
              $('.cheque').addClass('hide').removeClass('show');
               $('.cash').removeClass('hide').addClass('show');
               
                if (amount >300){
              alert('Maximum $300 only');
               $('#amount').val(0);
          }else{
               $('#approver_2').removeClass('hide').addClass('show');
                     $('#approver_3').addClass('hide').removeClass('show');
                         $('#approver_4').addClass('hide').removeClass('show');
          }  
           }
        });
        
    
       $('.date_required_aca').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});



 
$('input[name=amount]').on('change', function(){
    var request_type = document.getElementById("request_type").value;  
      var getVal =  $(this).val();
     if(request_type == '1' )
     {
   
 if (getVal >5000){
              alert('Maximum $5000 only');
               $('#amount').val(0);
          }else if(getVal >3000){
         $('#approver_3').removeClass('hide').addClass('show');
           $('#approver_4').removeClass('hide').addClass('show');
                     $('#approver_2').addClass('hide').removeClass('show');
          }else{
               $('#approver_2').removeClass('hide').addClass('show');
                     $('#approver_3').addClass('hide').removeClass('show');
                      $('#approver_4').addClass('hide').removeClass('show');
          }
    
        }else{
  
 if (getVal >300){
              alert('Maximum $300 only');
               $('#amount').val(0);
          }else{
               $('#approver_2').removeClass('hide').addClass('show');
                     $('#approver_3').addClass('hide').removeClass('show');
                      $('#approver_4').addClass('hide').removeClass('show');
          }  
        }
 
        });



$(".date_required_aca").on("dp.change", function (e) {
    var getVal =  $(this).val();   
   
var currentDate = new Date();
      var new_date = moment(currentDate, "DD-MM-YYYY").add(14,'days');
   
var day = new_date.format('DD');
var month = new_date.format('MM');
var year = new_date.format('YYYY');
var daysaftertoday = year + '-' + month + '-' +day;
   if(daysaftertoday>getVal){
           $('.reasons').removeClass('hide').addClass('show');
      
       } else {
              $('.reasons').addClass('hide').removeClass('show');
           }
});

    });
  </script>
  
  