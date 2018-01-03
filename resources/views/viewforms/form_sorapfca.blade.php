<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Request Type</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->request_type == 1)
     Normal
    @elseif($forminfo->request_type == 2)
     Overseas Travel
 
    @endif
   
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Account Code </div>
  <div class="col-md-10 bg-ff">

<span title="{{ $forminfo->p_accountcode_desc }}">{!! $forminfo->account_code !!}</span>
  </div>
  </div>

@if($forminfo->optional_code)

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Cost Centre </div>
  <div class="col-md-10 bg-ff">
    <span title="{{ $forminfo->p_optionalcode_desc }}">{!! $forminfo->optional_code !!}</span>
  </div>
  </div>
@endif



<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Cheque Payable To </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->cheque_payable_to !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Project Name </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->project_name !!}
  </div>
  </div>


 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Form Detail Table </div>
  <div class="col-md-10 bg-ff">
        <table class="table table-striped table-condensed" id="itemsTable">

  <thead>
            <tr>
               
                <th style="width: 20%">Date</th>
                <th style="width: 30%">Company</th>
                <th style="width: 30%">Description</th>
                <th style="width: 10%">Note</th>		
                 <th style="width: 10%">Total</th>
               
            </tr>
            </thead>
       <tbody >
        @if (count($formlineitem) > 0)
                  
                    @foreach ($formlineitem as $lineitem)
                    <tr>
                        <td>{!! date('Y-m-d', strtotime($lineitem->item_date))!!} </td>
                         <td>{!! $lineitem->item_company !!} </td>
                          <td>{!! $lineitem->item_desc !!} </td>
                             <td>{!! $lineitem->item_note !!} </td>
                                  <td>{!! $lineitem->item_total !!} </td>
                    </tr>
                       @endforeach
                    @endif
                   
                      </tbody >
                       </table>
  </div>
    </div>


<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Total </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->total !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Advanced Received </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->advance_received !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Balance </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->balance !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Budget Code </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->budget_code !!}
  </div>
  </div>


<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date Event</div>
  <div class="col-md-10 bg-ff">  
    {!! date('j F Y', strtotime($forminfo->date_event)) !!}
  </div>
  </div>

@if($forminfo->reasons != "")
<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->reasons !!}
  </div>
  </div>
@endif

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Description </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->description !!}
  </div>
  </div>