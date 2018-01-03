 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Description</div>
  <div class="col-md-10 bg-ff">
        {!! $forminfo->description !!}
  </div>
    </div>
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Purchase Value Table </div>
  <div class="col-md-10 bg-ff">
        <table class="table table-striped table-condensed" id="itemsTable">

  <thead>
            <tr>
               
                <th style="width: 20%">Vendor's Name</th>
                <th style="width: 20%">SubTotal</th>
                <th style="width: 20%">7%GST</th>
                <th style="width: 20%">Grant Total</th>		
                 <th style="width: 20%">Payment Term</th>
               
            </tr>
            </thead>
       <tbody >
        @if (count($formlineitem) > 0)
                  
                    @foreach ($formlineitem as $lineitem)
                    <tr>
                        <td>{!! $lineitem->item_company !!} </td>
                         <td>{!! $lineitem->item_subtotal !!} </td>
                          <td>{!! $lineitem->item_gst !!} </td>
                             <td>{!! $lineitem->item_total !!} </td>
                                  <td>{!! $lineitem->item_paymentterm !!} </td>
                    </tr>
                       @endforeach
                    @endif
                   
                      </tbody >
                       </table>
  </div>
    </div>
<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vendor selected</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->selected == 1)
    {!!  $formlineitem[0]->item_company !!} 
    @elseif($forminfo->selected == 2)
    {!!  $formlineitem[1]->item_company !!} 
      @else
      {!!  $formlineitem[2]->item_company !!} 
    @endif
  </div>
  </div>
     
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Justifications</div>
  <div class="col-md-10 bg-ff">
        {!! $forminfo->justifications !!}
  </div>
    </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Budgeted for current FY</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->isBudgeted == 1)
      Yes
    @else
      No
    @endif
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Capex</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->isCapex == 1)
      Yes
    @else
      No
    @endif
  </div>
  </div>


  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Account Code(s) to be charged </div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->accountcode }}
  </div>
  </div>