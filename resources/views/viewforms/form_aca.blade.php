<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Request Type</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->request_type == 1)
     Normal
    @elseif($forminfo->request_type == 2)
     Facilities Maintenance and Cashcard
 
    @endif
   
  </div>
  </div>

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Account Code</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->amount_code !!}
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
  <div class="col-md-2 bg-cc">Cheque Payable </div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->cheque_payable_to }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Project Name</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->project_name !!}
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Amount</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->amount !!}
  </div>
  </div>



 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date Required</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->date_required !!}
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
  <div class="col-md-2 bg-cc">Description</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->description !!}
  </div>
  </div>