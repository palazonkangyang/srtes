  <div class="row bg-cc-only"> 
  <div class="col-md-2 bg-cc">Cancelled Item(s)</div>
<div class="radio col-md-10 bg-ff">   
            <label>
                @if($forminfo->chk_pr == 1) 
                {!! Form::checkbox('chk_pr',1, true, ['id' => 'chk_pr2','disabled' =>'true']) !!} Purchase Requisition (PR)
                @else
                  {!! Form::checkbox('chk_pr',1, null, ['id' => 'chk_pr2','disabled' =>'true']) !!} Purchase Requisition (PR)
                @endif
            </label>
            <label>
                  @if($forminfo->chk_po == 1) 
                {!! Form::checkbox('chk_po',1, true, ['id' => 'chk_po2','disabled' =>'true']) !!} Purchase Order (PO)
                @else
                  {!! Form::checkbox('chk_po',1, null, ['id' => 'chk_po2','disabled' =>'true']) !!} Purchase Order (PO)
                @endif
             </label>
            <label>
                    @if($forminfo->chk_grn == 1) 
                {!! Form::checkbox('chk_grn',1, true, ['id' => 'chk_grn2','disabled' =>'true']) !!} Receiving Slip (GRN)
                @else
                  {!! Form::checkbox('chk_grn',1, null, ['id' => 'chk_grn2','disabled' =>'true']) !!} Receiving Slip (GRN)
                @endif
              </label>
            <label>
                           @if($forminfo->chk_inv == 1) 
                {!! Form::checkbox('chk_inv',1, true, ['id' => 'chk_inv2','disabled' =>'true']) !!} Invoice (INV)
                @else
                  {!! Form::checkbox('chk_inv',1, null, ['id' => 'chk_inv2','disabled' =>'true']) !!} Invoice (INV)
                @endif

            </label>
        </div>
  </div>
 <div class="row bg-cc-only"> 
  <div class="col-md-2 bg-cc"></div>
<div class="radio col-md-10 bg-ff">  noted: only checked item(s) needed to be cancelled, items' no. shown below is for references only.
    </div>
  </div>
  @if($forminfo->pr_no != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">PR No.</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->pr_no !!}
  </div>
  </div>
@endif
 
  @if($forminfo->po_no != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">PO No.</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->po_no !!}
  </div>
  </div>
@endif

  @if($forminfo->grn_no != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">GRN No.</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->grn_no !!}
  </div>
  </div>
@endif

 @if($forminfo->inv_no != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">INV No.</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->inv_no !!}
  </div>
  </div>
@endif

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Description</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->desc_purchased !!}
  </div>
  </div>

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->reasons !!}
  </div>
  </div>

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vendor</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->vendor !!}
  </div>
  </div>

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Amount</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->amount !!}
  </div>
  </div>