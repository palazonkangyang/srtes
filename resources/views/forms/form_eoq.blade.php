<div class="form-group">
    <label for="description">Description of Goods/Services Required (*)</label>
     {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
  </div>

 <!-- line item table-->
   <label for="description">For Request of Waiver, Use the first line only</label>
           <table class="table table-striped table-condensed" id="itemsTable">

  <thead>
            <tr>
                <th class="v-align-middle"  style="width: 5%"></th>
                <th class="v-align-middle"  style="width: 35%">Vendor's Name (*)</th>
                <th class="v-align-middle"  style="width: 15%">SubTotal (*)</th>
                <th class="v-align-middle"  style="width: 15%">7%GST</th>
                <th class="v-align-middle"  style="width: 15%">Grant Total (*)</th>		
                 <th class="v-align-middle"  style="width:20%">Payment Term (*)</th>
                 <th class="v-align-middle"  style="width: 5%">Selected</th>
            </tr>
            </thead>
            <tbody class="items">
                    
					<tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide"></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                      <input type="text" name="item_company[]" value="" class="item_company form-control input-sm" tabindex="1"/></td>
                      <td class="v-align-middle"><input type="text" name="item_subtotal[]" value="0" id="item_subtotal1" class="item_subtotal form-control input-sm" tabindex="2" /></td>
                      <td class="v-align-middle"><input type="text" name="item_gst[]" value="0" id="item_gst1" class="item_gst1 form-control input-sm" tabindex="3"/></td>
                      <td class="v-align-middle"><input name="item_total[]" id="item_total1" value="0" class="item_total form-control input-sm" tabindex="4" readonly="1"  type="text"></td> 
                      <td class="v-align-middle">    {!! Form::select('item_paymentterm[]', array('30 days' => '30 days', 'Others' => 'Others'),NULL , array('class'=>'form-control', 'id' => 'item_paymentterm1')); !!}</td>
                          <td class="v-align-middle"> {!! Form::radio('item_checked', 1) !!}</td>
                    </tr>       
                    <tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide "></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                      <input type="text" name="item_company[]" value="" class="item_company form-control input-sm" tabindex="6"/></td>
                      <td class="v-align-middle"><input type="text" name="item_subtotal[]" value="0" id="item_subtotal2" class="item_subtotal form-control input-sm" tabindex="7" /></td>
                      <td class="v-align-middle"><input type="text" name="item_gst[]" id="item_gst2" value="0" class="item_gst form-control input-sm" tabindex="8"/></td>
                      <td class="v-align-middle"><input name="item_total[]" value="0" id="item_total2" class="item_total form-control input-sm" tabindex="9" readonly="1" type="text"></td> 
                      <td class="v-align-middle">{!! Form::select('item_paymentterm[]', array('30 days' => '30 days', 'Others' => 'Others'),NULL , array('class'=>'form-control', 'id' => 'item_paymentterm2')); !!}</td>
                          <td class="v-align-middle"> {!! Form::radio('item_checked', 2) !!}</td>
                    </tr>
                    <tr class="item-row">
                      <td class="v-align-middle"><i id="deleteRow" class="fa fa-minus-circle hide "></i></td>
                      <td class="v-align-middle"><input type="hidden" class="item_id" name="item_id[]" value=""/>
                      <input type="text" name="item_company[]" value="" class="item_company form-control input-sm" tabindex="11"/></td>
                      <td class="v-align-middle"><input type="text" name="item_subtotal[]" id="item_subtotal3" value="0" class="item_subtotal form-control input-sm" tabindex="12" /></td>
                      <td class="v-align-middle"><input type="text" name="item_gst[]" id="item_gst3" value="0" class="item_gst form-control input-sm" tabindex="13"/></td>
                      <td class="v-align-middle"><input name="item_total[]" id="item_total3" value="0" class="item_total form-control input-sm" tabindex="14" readonly="1" type="text"></td> 
                      <td class="v-align-middle">{!! Form::select('item_paymentterm[]', array('30 days' => '30 days', 'Others' => 'Others'),NULL , array('class'=>'form-control', 'id' => 'item_paymentterm3')); !!}</td>
                          <td class="v-align-middle"> {!! Form::radio('item_checked', 3) !!}</td>
                    </tr>
        
                  </tbody>
         </table>
    <div id="item_checked"></div>
          
<hr/>

  <!--end of line item table-->

<div class="form-group">
    <label for="justifications">Justifications for selection or waiver (*)</label>
     {!! Form::textarea('justifications', null, ['class' => 'ckeditor form-control']) !!}
  </div>

  <div class="form-group">
    <label for="isBudgeted">Budgeted for current FY (*)</label>
        <div class="isBudgeted">   
            <label>
                {!! Form::radio('isBudgeted', 1) !!} Yes
            </label>
            <label>
                {!! Form::radio('isBudgeted', 2) !!} No
            </label>
        </div>
    <div id="isBudgeted"></div>
  </div>

  <div class="form-group">
    <label for="isCapex">Purchase consists of GOOD(s) more than $500 per unit(Capex) (*)</label>
        <div class="isCapex">   
            <label>
                {!! Form::radio('isCapex', 1) !!} Yes
            </label>
            <label>
                {!! Form::radio('isCapex', 2) !!} No
            </label>
        </div>
    <div id="isCapex"></div>
  </div>

 <div class="form-group">
    <label for="accountcode">Account Code(s) to be charged  (*)</label>
    {!! Form::text('accountcode',NULL,['class'=>'form-control ', 'id'=>'accountcode']) !!}
  </div>
  <div class="form-group checkbox">
     <label>{!! Form::checkbox('conditions', '1') !!} I do not have any conflict of interest in connection to this evaluation.</label>
     <div id="conditions"></div>
  </div>
  
     <script type="text/javascript">
    
              function EOQjevent()
{
    var rates = document.getElementsByName('item_checked');
var rate_value;
for(var i = 0; i < rates.length; i++){
    if(rates[i].checked){
        rate_value = rates[i].value;
    }
}
var amountsubmit = document.getElementById("item_total"+rate_value).value;   

              
                if (parseFloat(amountsubmit) >50000){
        alert('Currently system only support until maximum 50000');
        }  
        else if (parseFloat(amountsubmit) >30000){
                    document.getElementById("approverfield_3").disabled = false;
                       document.getElementById("approverfield_4").disabled = false;
                       
                    
          }else if (parseFloat(amountsubmit) >3000){

                    document.getElementById("approverfield_3").disabled = false;
                       document.getElementById("approverfield_4").disabled = true;

                 
          }else {

                    document.getElementById("approverfield_3").disabled = true;
                       document.getElementById("approverfield_4").disabled = true;
             
          }
  
}
    $(document).ready(function(){
        
        
 
        
             
             $('#approver_3').addClass('hide').removeClass('show');
               $('#approver_4').addClass('hide').removeClass('show');
              
         $('input[name=item_checked]').on('change', function(){
            var getVal =  $(this).val();
     var amountsubmit = document.getElementById("item_total"+getVal).value;      
   
        if (parseFloat(amountsubmit) >50000){
        alert('Currently system only support until maximum 50000');
        }  
        else if (parseFloat(amountsubmit) >30000){
          
             
                      $('#approver_3').removeClass('hide').addClass('show');
                       $('#approver_4').removeClass('hide').addClass('show');
                      
                    
          }else if (parseFloat(amountsubmit) >3000){
               
                      $('#approver_3').removeClass('hide').addClass('show');
                       $('#approver_4').addClass('hide').removeClass('show');
                       
                 
          }else {
             
                  $('#approver_3').addClass('hide').removeClass('show');
                       $('#approver_4').addClass('hide').removeClass('show');
                  
                 
          }
              
   });
        
//**start of item line
 $("#item_subtotal1").on('keyup', function () {
        
         var subtotal1 = document.getElementById("item_subtotal1").value;
            var gst1 = document.getElementById("item_gst1").value;
             $('#item_total1').val(parseFloat(subtotal1)+parseFloat(gst1));
});

$("#item_gst1").on('keyup', function () {
        
         var subtotal1 = document.getElementById("item_subtotal1").value;
            var gst1 = document.getElementById("item_gst1").value;
             $('#item_total1').val(parseFloat(subtotal1)+parseFloat(gst1));
});

 $("#item_subtotal2").on('keyup', function () {
        
         var subtotal2 = document.getElementById("item_subtotal2").value;
            var gst2 = document.getElementById("item_gst2").value;
             $('#item_total2').val(parseFloat(subtotal2)+parseFloat(gst2));
});

$("#item_gst2").on('keyup', function () {
        
         var subtotal2 = document.getElementById("item_subtotal2").value;
            var gst2 = document.getElementById("item_gst2").value;
             $('#item_total2').val(parseFloat(subtotal2)+parseFloat(gst2));
});

 $("#item_subtotal3").on('keyup', function () {
        
         var subtotal3 = document.getElementById("item_subtotal3").value;
            var gst3 = document.getElementById("item_gst3").value;
             $('#item_total3').val(parseFloat(subtotal3)+parseFloat(gst3));
});

$("#item_gst3").on('keyup', function () {
        
         var subtotal3 = document.getElementById("item_subtotal3").value;
            var gst3 = document.getElementById("item_gst3").value;
             $('#item_total3').val(parseFloat(subtotal3)+parseFloat(gst3));
});
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

        // Get the table object to use for adding a row at the end of the table
        var $itemsTable = $('#itemsTable');
        var $row = $(rowTemp);
        

        // Add row after the first row in table
        $('.item-row:last', $itemsTable).after($row);      
        // save reference to inputs within row
             $('.item_date').datetimepicker({
	format:'YYYY-MM-DD',
	sideBySide:true,
	defaultDate: new Date()
});

    
    },

    /**
     * Delete row if we have more than one row in table
     * @param row
     * @returns {boolean}
     */
    deleteRow: function (row) {

        var rowCount = $('#itemsTable tr').length;

        if (rowCount != 2) {
            $(row).parents('.item-row').remove();
            if ($(".item-row").length < 2) $("#deleteRow").hide();
        
           
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


  });
//end of item line 
 </script>