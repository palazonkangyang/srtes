  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Request Type</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      @if($forminfo->request_type == 1)
       Normal
      @elseif($forminfo->request_type == 2)
       Overseas Travel
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Account Code </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      <span title="{{ $forminfo->p_accountcode_desc }}">{!! $forminfo->account_code !!}</span>
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  @if($forminfo->optional_code)

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Cost Centre </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      <span title="{{ $forminfo->p_optionalcode_desc }}">{!! $forminfo->optional_code !!}</span>
    </div><!-- end col-md-10 -->
  </div><!-- end row -->
  @endif

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Cheque Payable To </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->cheque_payable_to !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Project Name </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->project_name !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Form Detail Table </div><!-- end col-md-2 -->
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
        <tbody>
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
        </tbody>
      </table>
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Total </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->total !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Advanced Received </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->advance_received !!}
    </div><!-- end col-md-2 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Balance </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->balance !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Budget Code </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->budget_code !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Date Event</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! date('j F Y', strtotime($forminfo->date_event)) !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  @if($forminfo->reasons != "")
  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Reasons</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->reasons !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->
  @endif

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Description </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->description !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->
