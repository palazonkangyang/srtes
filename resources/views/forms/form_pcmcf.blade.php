
<div class="form-group payee_name">
    <label for="payee_name">Bank Payee Name  (*)</label>
    {!! Form::text('payee_name',NULL,['class'=>'form-control ', 'id'=>'payee_name']) !!}
  </div>


  <div class="form-group">
    <label for="title">Title  (*)</label>
    {!! Form::text('title',NULL,['class'=>'form-control ', 'id'=>'title']) !!}
  </div>
  

  
 
  






 <div class="form-group">
    <label for="project">Project  (*)</label>
    {!! Form::text('project',NULL,['class'=>'form-control ', 'id'=>'project']) !!}
  </div>

  <!-- line item table-->
  
        <div class="form-group">
     <label for="date_required">Form Detail Table (*)</label>
                <!--<table class="table table-hover table-condensed" id="example">-->
                <table class="table table-striped table-condensed" id="itemsTable">

<!--                <form action="" method="post" id="invoiceForm">-->
       
            <thead>
            <tr>
                <th class="v-align-middle"  style="width: 5%"></th>
                <th class="v-align-middle"  style="width: 15%">Date of Expenditure (*)</th>
                <th class="v-align-middle"  style="width: 30%">Description of Expense (*)</th>
                 <th class="v-align-middle"  style="width: 10%">GL Code(*)</th>
                  <th class="v-align-middle"  style="width: 10%">AC Desc</th>
                    <th class="v-align-middle"  style="width: 10%">Cost Centre(*)</th>
                  <th class="v-align-middle"  style="width: 10%">CC Desc</th>
                 <th class="v-align-middle"  style="width: 10%">Total (* omit $ sign)</th>
            </tr>
            </thead>
            <tbody class="items">
                    
					<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                       <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                           <td class="v-align-middle">{{-- */$getaccountcodename[0]='';/* --}}
                  		{{-- */$getaccountcodeid[0]='';/* --}}
                                {{-- */$getis3lpha[0]='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id[0]',$getaccountcodename[0],['placeholder' => 'Choose', 'class'=>'form-control', 'id'=>'select-accountcode0']) !!}
                  	{!! Form::hidden('accountcode_id[0]',$getaccountcodeid[0]) !!}
                        {!! Form::hidden('is3alpha[0]',$getis3lpha[0]) !!}</td>
                           <td class="v-align-middle">   
                               {!! Form::text('p_accountcode_desc[0]',NULL,['class'=>'form-control ','data-toggle'=>'tooltip', 'title'=>'','readonly'=>1,  'id'=>'p_accountcode_desc0']) !!}
              </td>
               <td class="v-align-middle">   
              	{{-- */$getoptionalcodename[0]='';/* --}}
                  		{{-- */$getoptionalcodeid[0]='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id[0]',$getoptionalcodename[0],['class'=>'form-control','readonly'=>1, 'id'=>'select-optionalcode0']) !!}
                  	{!! Form::hidden('optionalcode_id[0]',$getoptionalcodeid[0]) !!}
                     </td>
                     <td>
                             {!! Form::text('p_optionalcode_desc[0]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_optionalcode_desc0']) !!}
            
                         
                     </td>
                     
                     
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
                    		<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                       <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                           <td class="v-align-middle">{{-- */$getaccountcodename[1]='';/* --}}
                  		{{-- */$getaccountcodeid[1]='';/* --}}
                                {{-- */$getis3lpha[1]='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id[1]',$getaccountcodename[1],['placeholder' => 'Choose', 'class'=>'form-control', 'id'=>'select-accountcode1']) !!}
                  	{!! Form::hidden('accountcode_id[1]',$getaccountcodeid[1]) !!}
                        {!! Form::hidden('is3alpha[1]',$getis3lpha[1]) !!}</td>
                           <td class="v-align-middle">   
                               {!! Form::text('p_accountcode_desc[1]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_accountcode_desc1']) !!}
                        </td>
               <td class="v-align-middle">   
              	{{-- */$getoptionalcodename[1]='';/* --}}
                  		{{-- */$getoptionalcodeid[1]='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id[1]',$getoptionalcodename[1],['class'=>'form-control','readonly'=>1, 'id'=>'select-optionalcode1']) !!}
                  	{!! Form::hidden('optionalcode_id[1]',$getoptionalcodeid[1]) !!}
                     </td>
                     <td>
                             {!! Form::text('p_optionalcode_desc[1]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_optionalcode_desc1']) !!}
            
                         
                     </td>
                     
                     
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
                    		<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                       <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                           <td class="v-align-middle">{{-- */$getaccountcodename[2]='';/* --}}
                  		{{-- */$getaccountcodeid[2]='';/* --}}
                                {{-- */$getis3lpha[2]='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id[2]',$getaccountcodename[2],['placeholder' => 'Choose', 'class'=>'form-control', 'id'=>'select-accountcode2']) !!}
                  	{!! Form::hidden('accountcode_id[2]',$getaccountcodeid[2]) !!}
                        {!! Form::hidden('is3alpha[2]',$getis3lpha[2]) !!}</td>
                           <td class="v-align-middle">   
                               {!! Form::text('p_accountcode_desc[2]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_accountcode_desc2']) !!}
              </td>
               <td class="v-align-middle">   
              	{{-- */$getoptionalcodename[2]='';/* --}}
                  		{{-- */$getoptionalcodeid[2]='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id[2]',$getoptionalcodename[2],['class'=>'form-control','readonly'=>1, 'id'=>'select-optionalcode2']) !!}
                  	{!! Form::hidden('optionalcode_id[2]',$getoptionalcodeid[2]) !!}
                     </td>
                     <td>
                             {!! Form::text('p_optionalcode_desc[2]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_optionalcode_desc2']) !!}
            
                         
                     </td>
                     
                     
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
                    		<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                       <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                           <td class="v-align-middle">{{-- */$getaccountcodename[3]='';/* --}}
                  		{{-- */$getaccountcodeid[3]='';/* --}}
                                {{-- */$getis3lpha[3]='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id[3]',$getaccountcodename[3],['placeholder' => 'Choose', 'class'=>'form-control', 'id'=>'select-accountcode3']) !!}
                  	{!! Form::hidden('accountcode_id[3]',$getaccountcodeid[3]) !!}
                        {!! Form::hidden('is3alpha[3]',$getis3lpha[3]) !!}</td>
                           <td class="v-align-middle">   
                               {!! Form::text('p_accountcode_desc[3]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_accountcode_desc3']) !!}
              </td>
               <td class="v-align-middle">   
              	{{-- */$getoptionalcodename[3]='';/* --}}
                  		{{-- */$getoptionalcodeid[3]='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id[3]',$getoptionalcodename[3],['class'=>'form-control','readonly'=>1, 'id'=>'select-optionalcode3']) !!}
                  	{!! Form::hidden('optionalcode_id[3]',$getoptionalcodeid[3]) !!}
                     </td>
                     <td>
                             {!! Form::text('p_optionalcode_desc[3]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_optionalcode_desc3']) !!}
            
                         
                     </td>
                     
                     
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
        		<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                       <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                           <td class="v-align-middle">{{-- */$getaccountcodename[4]='';/* --}}
                  		{{-- */$getaccountcodeid[4]='';/* --}}
                                {{-- */$getis3lpha[4]='';/* --}}
                      
                  	{!! Form::text('p_accountcode_id[4]',$getaccountcodename[4],['placeholder' => 'Choose', 'class'=>'form-control', 'id'=>'select-accountcode4']) !!}
                  	{!! Form::hidden('accountcode_id[4]',$getaccountcodeid[4]) !!}
                        {!! Form::hidden('is3alpha[4]',$getis3lpha[4]) !!}</td>
                           <td class="v-align-middle">   
                               {!! Form::text('p_accountcode_desc[4]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_accountcode_desc4']) !!}
              </td>
               <td class="v-align-middle">   
              	{{-- */$getoptionalcodename[4]='';/* --}}
                  		{{-- */$getoptionalcodeid[4]='';/* --}}
                            
                  	
                  	{!! Form::text('p_optionalcode_id[4]',$getoptionalcodename[4],['class'=>'form-control','readonly'=>1, 'id'=>'select-optionalcode4']) !!}
                  	{!! Form::hidden('optionalcode_id[4]',$getoptionalcodeid[4]) !!}
                     </td>
                     <td>
                             {!! Form::text('p_optionalcode_desc[4]',NULL,['class'=>'form-control ','readonly'=>1,'data-toggle'=>'tooltip', 'title'=>'',  'id'=>'p_optionalcode_desc4']) !!}
            
                         
                     </td>
                     
                     
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
                  </tbody>
                </table>
                     
<hr/>
        </div>
  <!--end of line item table-->


<div class="form-group">
    <label for="total">Total  (*)</label>
    {!! Form::text('total',NULL,['class'=>'form-control width-40','readonly'=>1, 'id'=>'total']) !!}
  </div>

  <script type="text/javascript">
      
      
                       function PCMCFjevent()
{
  
var amountsubmit = document.getElementById("total").value;   



     if (parseFloat(amountsubmit) >= 3000){
                document.getElementById("approverfield_2").disabled = false;
           
       }else{
                 document.getElementById("approverfield_2").disabled = true;
         
          
            }
}
      
      
    $(document).ready(function(){
        
     
    $("[data-toggle=tooltip]").mouseenter(function () {
        var $this = $(this);
        $this.attr('title', $this.val());
    });   

        /*     $('input[name=SOP]').on('change', function(){
       if(this.checked) {
              $('.payee_name_no').removeClass('hide').addClass('show');
                $('.payee_name').addClass('hide').removeClass('show');
           } else {
               $('.payee_name').removeClass('hide').addClass('show');
                $('.payee_name_no').addClass('hide').removeClass('show');
           }
    
        }); */
//** start of item line
     $('#select-accountcode0').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	      	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id[0]" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha[0]" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc[0]" />  ');
                  $('#p_accountcode_desc0').val(suggestion.data.description);   
                    if(suggestion.data.is3alpha == 1){
		 
                    $('#select-optionalcode0').prop('readonly',false);  	
                }else{
                    $('#select-optionalcode0').prop('readonly',true);   
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode0').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id[0]" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc[0]" /> ');   
                     $('#p_optionalcode_desc0').val(suggestion.data.description);
                
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
     
     //2
         $('#select-accountcode1').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	      	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id[1]" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha[1]" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc[1]" />  ');
                  $('#p_accountcode_desc1').val(suggestion.data.description);
               
                    if(suggestion.data.is3alpha == 1){
		 
                    $('#select-optionalcode1').prop('readonly',false);  	
                }else{
                    $('#select-optionalcode1').prop('readonly',true);   
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode1').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id[1]" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc[1]" /> ');   
                     $('#p_optionalcode_desc1').val(suggestion.data.description);
             
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
     //3
        $('#select-accountcode2').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	      	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id[2]" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha[2]" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc[2]" />  ');
                  $('#p_accountcode_desc2').val(suggestion.data.description);
    
                    if(suggestion.data.is3alpha == 1){
		 
                    $('#select-optionalcode2').prop('readonly',false);  	
                }else{
                    $('#select-optionalcode2').prop('readonly',true);   
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode2').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id[2]" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc[2]" /> ');   
                     $('#p_optionalcode_desc2').val(suggestion.data.description);
             
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
     //4
       $('#select-accountcode3').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	      	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id[3]" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha[3]" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc[3]" />  ');
                  $('#p_accountcode_desc3').val(suggestion.data.description);
           
                    if(suggestion.data.is3alpha == 1){
		 
                    $('#select-optionalcode3').prop('readonly',false);  	
                }else{
                    $('#select-optionalcode3').prop('readonly',true);   
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode3').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id[3]" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc[3]" /> ');   
                     $('#p_optionalcode_desc3').val(suggestion.data.description);
              
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
     
     //5
     
       $('#select-accountcode4').autocomplete({
	    
	    serviceUrl: '/application/getjsonaccountcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	      	$(this).next().remove();
	        $(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
                   $(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="accountcode_id[4]" /><input type="hidden" value="'+suggestion.data.is3alpha+'" name="is3alpha[4]" /><input type="hidden" value="'+suggestion.data.description+'" name="accountcode_desc[4]" />  ');
                  $('#p_accountcode_desc4').val(suggestion.data.description);
               
                    if(suggestion.data.is3alpha == 1){
		 
                    $('#select-optionalcode4').prop('readonly',false);  	
                }else{
                    $('#select-optionalcode4').prop('readonly',true);   
                   }     
                   }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});
        
           $('#select-optionalcode4').autocomplete({
	    
	    serviceUrl: '/application/getjsonoptionalcode/?with=true',
	    dataType: 'json',
	    contentType: "application/json; charset=utf-8",
	    type: 'GET',


	    onSelect: function (suggestion) {
	    	$(this).next().remove();
                $(this).next().remove();
	        if(suggestion.data.id != '') {
		$(this).after('<input type="hidden" value="'+suggestion.data.id+'" name="optionalcode_id[4]" /><input type="hidden" value="'+suggestion.data.description+'" name="optionalcode_desc[4]" /> ');   
                     $('#p_optionalcode_desc4').val(suggestion.data.description);
             
                        }
	    },
	    showNoSuggestionNotice: true,
	    noSuggestionNotice: 'Sorry, no matching results'
	});



 var rowTemp = [
    "<tr class='item-row'>",
    "<td class='v-align-middle'><i id='deleteRow' class='fa fa-minus-circle'></i></td>"+
    "<td class='v-align-middle'><input type='hidden' class='id' name='item_id[]' value='' />"+
    "<input type='text' name='item_date[]' class='item_date form-control input-sm' tabindex='2'/></td>"+
    "<td class='v-align-middle'><input type='text' name='item_desc[]' value='' class='item_desc form-control input-sm' tabindex='3'/></td>"+
      "<td class='v-align-middle'><input name='item_total[]' class='item_total form-control input-sm'type='text' tabindex='5' ></td>"+
    "</tr>"
].join('');
     
    $("#addRowBtn").on('click', function (e) {
    orderLines.addRow(); 
    e.preventDefault();
}
);

$(document).on('click', '#deleteRow', function () {
    orderLines.deleteRow(this);
});

// Define variables
var orderLines = {

    /**
     * Handle the total calculation
     */
    updateTotal: function () {

        var total = 0;
        $('input.item_total').each(function (i) {
            price = $(this).val().replace("$", "");
            if (!isNaN(price)) total += Number(price);
        });

       
            if (total >= 5000){
                alert('Maximum is SGD4999.99 , Please enter again');
                 $('input.item_total').val(0);
                      $('#total').val(0);
          }else if(total>=3000){
                        $('#approver_2').removeClass('hide').addClass('show');  
               
                    $('#total').val(this.roundNumber(total, 2));
          }
          
        else{
                   $('#approver_2').addClass('hide').removeClass('show'); 
               
                    $('#total').val(this.roundNumber(total, 2));
          }  
    },

    /**
     * Add row to invoice to allow for additional items
     * @param lookupSelector
     */
    addRow: function (lookupSelector) {

        // Get the table object to use for adding a row at the end of the table
        var $itemsTable = $('#itemsTable');
        var $row = $(rowTemp);
        var rowCount = $('#itemsTable tr').length;
         
         if(rowCount == 5 )
         {        
            alert('Maximum is 5 item rows.');      
                  $('#addRowBtn').addClass('hide');
         }else{          
         } 

        // Add row after the first row in table
        $('.item-row:last', $itemsTable).after($row);      
        // save reference to inputs within row
             $('.item_date').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});

         $(".item_total").on('keyup', function () {
         orderLines.updateTotal();
});
   
 

    },

    /**
     * Delete row if we have more than one row in table
     * @param row
     * @returns {boolean}
     */
    deleteRow: function (row) {
        $('#addRowBtn').removeClass('hide');
        var rowCount = $('#itemsTable tr').length;

        if (rowCount != 2) {
            $(row).parents('.item-row').remove();
            if ($(".item-row").length < 2) $("#deleteRow").hide();
        
            orderLines.updateTotal();
            return true;
        } else {
            alert('you can not delete this row');
            return false;
        }
    },

    /**
     * Function cleans up the number passed and returns the cleaned up value
     * @param number
     * @param decimals
     * @returns {*}
     */
    roundNumber: function (number, decimals) {
        var newString;// The new rounded number
        decimals = Number(decimals);
        if (decimals < 1) {
            newString = (Math.round(number)).toString();
        } else {
            var numString = number.toString();
            if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
                numString += ".";// give it one at the end
            }
            var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
            var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
            var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want
            if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
                if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                    while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                        if (d1 != ".") {
                            cutoff -= 1;
                            d1 = Number(numString.substring(cutoff, cutoff + 1));
                        } else {
                            cutoff -= 1;
                        }
                    }
                }
                d1 += 1;
            }
            if (d1 == 10) {
                numString = numString.substring(0, numString.lastIndexOf("."));
                var roundedNum = Number(numString) + 1;
                newString = roundedNum.toString() + '.';
            } else {
                newString = numString.substring(0, cutoff) + d1.toString();
            }
        }
        if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
            newString += ".";
        }
        var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;
        for (var i = 0; i < decimals - decs; i++) newString += "0";
        //var newNumber = Number(newString);// make it a number if you like
        return newString; // Output the result to the form field (change for your purposes)
    },

    setPathValue: function (path) {
        window.filePath = path
    }

};

       $('.item_date').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});

 
 $(".item_total").on('keyup', function () {
         orderLines.updateTotal();
});

    $("#advance_received").on('keyup', function () {
         orderLines.updateTotal();
});

//end of item line 
        


     $('#approver_1').removeClass('hide').addClass('show');
     
  

});
  </script>