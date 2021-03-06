
<div class="form-group">
            <label for="request_type">Request Type  (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::radio('request_type', 1 , null, ['id' => 'request_type']) !!} Normal
            </label>
            <label>
                {!! Form::radio('request_type', 2 , null, ['id' => 'request_type']) !!} Overseas Travel
            </label>  
        </div>
    <div id="request_type"></div>
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
 
  <!-- line item table-->
  
        
                <!--<table class="table table-hover table-condensed" id="example">-->
                <table class="table table-striped table-condensed" id="itemsTable">

<!--                <form action="" method="post" id="invoiceForm">-->
       
            <thead>
            <tr>
                <th class="v-align-middle"  style="width: 5%"></th>
                <th class="v-align-middle"  style="width: 20%">Date (*)</th>
                <th class="v-align-middle"  style="width: 20%">Company (*)</th>
                <th class="v-align-middle"  style="width: 35%">Description (*)</th>
                <th class="v-align-middle"  style="width: 5%">Currency</th>		
                 <th class="v-align-middle"  style="width: 15%">Total (* omit $ sign)</th>
            </tr>
            </thead>
            <tbody class="items">
                    
					<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                      <input type="text" name="item_date[]" value="" class="item_date form-control input-sm" tabindex="1"/></td>
                      <td class="v-align-middle"><input type="text" name="item_company[]" value="" class="item_company form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_desc[]" value="" class="item_desc form-control input-sm" tabindex="3"/></td>
                      <td class="v-align-middle"><input name="item_note[]" class="item_note form-control input-sm" tabindex="4" type="text"></td> 
                      <td class="v-align-middle"><input name="item_total[]" class="item_total form-control input-sm" tabindex="5" type="text" ></td>
                    </tr>
        
                  </tbody>
                </table>
                        <a href="#" id="addRowBtn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add item</a>

<hr/>

  <!--end of line item table-->



  
 
  
<div class="form-group">
    <label for="total">Total  (*)</label>
    {!! Form::text('total',NULL,['class'=>'form-control width-40','readonly' => 'true', 'id'=>'total']) !!}
  </div>

  <div class="form-group">
    <label for="advance_received">Advanced Received  (*)</label>
    {!! Form::text('advance_received',NULL,['class'=>'form-control width-40', 'id'=>'advance_received']) !!}
  </div>

<div class="form-group">
    <label for="balance">Balance  (*)</label>
    {!! Form::text('balance',NULL,['class'=>'form-control width-40','readonly' => 'true', 'id'=>'balance']) !!}
  </div>


 <div class="form-group">
    <label for="budget_code">Budget Code  (*)</label>
    {!! Form::text('budget_code',NULL,['class'=>'form-control width-40', 'id'=>'budget_code']) !!}
  </div>


 <div class="form-group">
    <label for="date_event">Date Event (*)</label>
    <div class="range_text row">
      <div class="col-md-12">
     
      {!! Form::text('date_event',NULL,['class'=>'form-control width-40 date_event_sorapfca']) !!}
    
      </div>
    </div>
    <div id="date_event"></div>
   
  </div>

 <div class="form-group reasons hide">
    <label for="reasons">Reasons (*)</label>
     {!! Form::textarea('reasons', null, ['class' => 'form-control' ,'id'=>'reasons']) !!}
  </div>

  <div class="form-group">
    <label for="description">Description</label>
     {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
  </div>


<script type="text/javascript">
    
       
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
           if(getVal == '1'){          
         $('#approver_3').addClass('hide').removeClass('show');
         $('#approver_4').addClass('hide').removeClass('show');   
           } else {
         $('#approver_3').removeClass('hide').addClass('show');
         $('#approver_4').removeClass('hide').addClass('show');       
           }
        });
//**start of item line

 var rowTemp = [
    "<tr class='item-row'>",
    "<td class='v-align-middle'><i id='deleteRow' class='fa fa-minus-circle'></i></td>"+
    "<td class='v-align-middle'><input type='hidden' class='id' name='item_id[]' value='' />"+
    "<input type='text' name='item_date[]' value='' class='item_date form-control input-sm' tabindex='1'/></td>"+
    "<td class='v-align-middle'><input type='text' name='item_company[]' class='item_company form-control input-sm' tabindex='2'/></td>"+
    "<td class='v-align-middle'><input type='text' name='item_desc[]' value='' class='item_desc form-control input-sm' tabindex='3'/></td>"+
    "<td class='v-align-middle'><input name='item_note[]' class='item_note form-control input-sm' type='text' tabindex='4'></td>"+
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

        $('#total').val(this.roundNumber(total, 2));
             advanceprice = $('#advance_received').val().replace("$", "");
           $('#balance').val(this.roundNumber(total-advanceprice, 2));   
           
  
    },

    /**
     * Add row to invoice to allow for additional items
     * @param lookupSelector
     */
    addRow: function (lookupSelector) {
        var qty = 0;
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
   
    $("#advance_received").on('keyup', function () {
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


       $('.date_event_sorapfca').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});

$(".date_event_sorapfca").on("dp.change", function (e) {
    var getVal =  $(this).val();    
var currentDate = new Date();
      var new_date = moment(currentDate, "DD-MM-YYYY").add(30,'days');

var day = new_date.format('DD');
var month = new_date.format('MM');
var year = new_date.format('YYYY');
var daysaftertoday = year + '-' + month + '-' +day;
   if(getVal>daysaftertoday){
           $('.reasons').removeClass('hide').addClass('show');
      
       } else {
              $('.reasons').addClass('hide').removeClass('show');
           }
});
    });
  </script>