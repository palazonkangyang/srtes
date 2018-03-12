
  <div class="form-group">
            <label for="type">Please indicate the following to be cancelled (Please tick*)</label>
        <div class="radio">   
            <label>
                {!! Form::checkbox('chk_pr',1, null, ['id' => 'chk_pr']) !!} Purchase Requisition (PR)
            </label>
            <label>
                {!! Form::checkbox('chk_po',1, null, ['id' => 'chk_po']) !!} Purchase Order (PO)
            </label>
            <label>
                {!! Form::checkbox('chk_grn',1, null, ['id' => 'chk_grn']) !!} Receiving Slip (GRN)
            </label>
            <label>
                {!! Form::checkbox('chk_inv',1, null, ['id' => 'chk_inv']) !!} Invoice (INV)
            </label>
        </div>
    <div id="type"></div>
  </div>
  
     <div class="form-group hide pr_no">
    <label for="pr_no">Purchase Requisition No  (*)</label>
    {!! Form::text('pr_no',NULL,['class'=>'form-control ', 'id'=>'pr_no']) !!}
  </div>
  
   <div class="form-group hide po_no">
    <label for="po_no">Purchase Order No  (*)</label>
    {!! Form::text('po_no',NULL,['class'=>'form-control ', 'id'=>'po_no']) !!}
  </div>
  
  <div class="form-group hide grn_no">
    <label for="grn_no">Receiving Slip No  (*)</label>
    {!! Form::text('grn_no',NULL,['class'=>'form-control ', 'id'=>'grn_no']) !!}
  </div>
 
 <div class="form-group hide inv_no">
    <label for="inv_no">Invoice No  (*)</label>
    {!! Form::text('inv_no',NULL,['class'=>'form-control ', 'id'=>'inv_no']) !!}
  </div>
  
 <div class="form-group ">
    <label for="desc_purchased">Description of Purchase (*)</label>
    {!! Form::text('desc_purchased',NULL,['class'=>'form-control ', 'id'=>'desc_purchased']) !!}
  </div>
  
  <div class="form-group">
    <label for="reasons">Reasons for cancellation (*) </label>
     {!! Form::textarea('reasons', null, ['class' => 'form-control' ,'id'=>'reasons']) !!}
  </div>

 <div class="form-group ">
    <label for="vendor">Vendor (*)</label>
    {!! Form::text('vendor',NULL,['class'=>'form-control ', 'id'=>'vendor']) !!}
  </div>

 <div class="form-group ">
    <label for="amount">Amount (* omit $ sign)</label>
    {!! Form::text('amount',NULL,['class'=>'form-control ', 'id'=>'amount']) !!}
  </div>

  <script type="text/javascript">
      
        function Coprpoevent()
{
     var $set = $('.approver-list > span');
var len = $set.length;
 document.getElementById("chk_pr").disabled = false;
    document.getElementById("chk_po").disabled = false;
	  document.getElementById("chk_grn").disabled = false;
	    document.getElementById("chk_inv").disabled = false;
               if (!$('input[name=chk_po]').is(':checked') && !$('input[name=chk_grn]').is(':checked') && ! $('input[name=chk_inv]').is(':checked') ) {
        
                
                     $('#approver_'+len).addClass('hide').removeClass('show');
                   document.getElementById("approverfield_"+len).disabled = true;
           }
}
      
    $(document).ready(function(){
        var $set = $('.approver-list > span');
var len = $set.length;
   $('#approver_'+len).addClass('hide').removeClass('show');
 document.getElementById("approverfield_"+len).disabled = true;
 
  $('input[name=chk_pr]').on('change', function(){
       if(this.checked) {
              $('.pr_no').removeClass('hide').addClass('show');
           } else {
              $('.pr_no').addClass('hide').removeClass('show');
           }
    
        });
   
  $('input[name=chk_po]').on('change', function(){
       if(this.checked) {
            $('#approver_'+len).removeClass('hide').addClass('show');
             document.getElementById("approverfield_"+len).disabled = false;
              $('.po_no').removeClass('hide').addClass('show');
                $('.pr_no').removeClass('hide').addClass('show');
              
           } else {
            
              
               $('.po_no').addClass('hide').removeClass('show');
                if (!$('input[name=chk_po]').is(':checked') && !$('input[name=chk_grn]').is(':checked') && ! $('input[name=chk_inv]').is(':checked') ) {
        
                
                     $('#approver_'+len).addClass('hide').removeClass('show');
                   document.getElementById("approverfield_"+len).disabled = true;
           }
       }
        });
 
    $('input[name=chk_grn]').on('change', function(){
       if(this.checked) {
                      $('#approver_'+len).removeClass('hide').addClass('show');
         document.getElementById("approverfield_"+len).disabled = false;
            $('.grn_no').removeClass('hide').addClass('show');
               $('.po_no').removeClass('hide').addClass('show');
                $('.pr_no').removeClass('hide').addClass('show');
                
           } else {
              
               $('.grn_no').addClass('hide').removeClass('show');
                   if (!$('input[name=chk_po]').is(':checked') && !$('input[name=chk_grn]').is(':checked') && ! $('input[name=chk_inv]').is(':checked') ) {
     
                
                     $('#approver_'+len).addClass('hide').removeClass('show');
                   document.getElementById("approverfield_"+len).disabled = true;
           }
           }
    
        });
        
     $('input[name=chk_inv]').on('change', function(){
       if(this.checked) {
                       $('#approver_'+len).removeClass('hide').addClass('show');
               document.getElementById("approverfield_"+len).disabled = false;
           $('.inv_no').removeClass('hide').addClass('show');
            $('.grn_no').removeClass('hide').addClass('show');
              $('.po_no').removeClass('hide').addClass('show');
                $('.pr_no').removeClass('hide').addClass('show');
            
            
           } else {
              
               $('.inv_no').addClass('hide').removeClass('show');
                   if (!$('input[name=chk_po]').is(':checked') && !$('input[name=chk_grn]').is(':checked') && ! $('input[name=chk_inv]').is(':checked') ) {
   
                     $('#approver_'+len).addClass('hide').removeClass('show');
                   document.getElementById("approverfield_"+len).disabled = true;
           }
           }
    
        });
     
     });
  </script>
  
  