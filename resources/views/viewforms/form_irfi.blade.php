@if($forminfo->goods != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Goods </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->goods !!}
  </div>
  </div>
@endif

@if($forminfo->services != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Services </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->services !!}
  </div>
  </div>
@endif

    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Estimate Value of Purchase</div>
  <div class="col-md-10 bg-ff">
    ${!! $forminfo->estimate_value !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Type of Training</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->type_source == 1)
      Budgeted
    @elseif($forminfo->type_source == 2)
      Unbudgeted
    @elseif($forminfo->type_source == 3)
      Funding
    @endif
   
  </div>
  </div>

  @if($forminfo->type_source == 3)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Funding</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->funding_desc }}
 
  </div>
  </div>
  @endif
  
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons for new purchase</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->type_reason == 1)
      Replacement of new goods/services
    @elseif($forminfo->type_reason == 2)
      New goods/services
    @elseif($forminfo->type_reason == 3)
      Others
    @endif
  
  </div>
  </div>
  
   @if($forminfo->type_reason == 3)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Others</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->reason_desc }}
 
  </div>
  </div>
  @endif
  
 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Detailed Information</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->detailed_information !!}
  </div>
  </div>
  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Required by / Event Date</div>
  <div class="col-md-10 bg-ff">
   
    {!! date('j F Y', strtotime($forminfo->date_required)) !!}
 
  </div>
  </div>
  
  @if($forminfo->vendor_company != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vendor company</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->vendor_company }}
  </div>
  </div>
  @endif
  
    @if($forminfo->vendor_person != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vendor person</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->vendor_person }}
  </div>
  </div>
  @endif
  
   @if($forminfo->vendor_contact != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Vendor contact</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->vendor_contact }}
  </div>
  </div>
  @endif