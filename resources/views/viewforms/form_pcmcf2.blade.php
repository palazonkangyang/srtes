  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Title </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->title !!}
  </div>
  </div>


<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Project </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->project !!}
  </div>
  </div>


<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Form Detail Table </div>
  <div class="col-md-10 bg-ff">
        <table class="table table-striped table-condensed" id="itemsTable">

  <thead>
            <tr>
               
                <th style="width: 10%">S/N</th>
                <th style="width: 15%">Date of Expenditure</th>
                <th style="width: 35%">Description of Expense</th>
                 <th style="width: 15%">Account Code</th>
                   <th style="width: 15%"> Cost Centre </th>
                <th style="width: 15%">Total</th>		
               
            </tr>
            </thead>
       <tbody >
        @if (count($formlineitem) > 0)
                  
                    @foreach ($formlineitem as $lineitem)
                    <tr>
                        <td>{!! $lineitem->item_note !!} </td>
                          <td>{!! date('Y-m-d', strtotime($lineitem->item_date))!!} </td>
                          <td>{!! $lineitem->item_desc !!} </td>
                          <td><span title="{{ $lineitem->p_accountcode_desc }}">{!! $lineitem->account_code !!}</span></td>
                          <td><span title="{{ $lineitem->p_optionalcode_desc }}">{!! $lineitem->optional_code !!}</span></td>
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