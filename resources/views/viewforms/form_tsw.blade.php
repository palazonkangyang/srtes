  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Present Designation</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->designation }}
  </div>
  </div>

   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Service Status in SRC</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->service_status == 1)
      Confirmed
    @elseif($forminfo->service_status == 2)
      Probation
    @elseif($forminfo->service_status == 3)
      Part-Time
    @endif

  </div>
  </div>

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Title of Programme</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->title }}
  </div>
  </div>


  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Date and Time of Programme </div>
  <div class="col-md-10 bg-ff">
    <table class="table table-striped table-condensed" id="itemsTable">

  <thead>
            <tr>

                <th >Date</th>


            </tr>
            </thead>
       <tbody >
        @if (count($formlineitem) > 0)

                    @foreach ($formlineitem as $lineitem)
                    <tr>
                        <td>{!! $lineitem->item_date !!} </td>

                    </tr>
                       @endforeach
                    @endif

                      </tbody >
                       </table>

  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Type of Training </div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->type_training == 1)
      Basic Training
    @elseif($forminfo->type_training == 2)
      Functional
    @elseif($forminfo->type_training == 3)
      Management / Leadership
    @elseif($forminfo->type_training == 4)
      SRC Knowledge
    @endif

  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Programme Fee </div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->fee }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Programme Provider  </div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->provider }}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Funds or grant</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->isfunds == 1)
      Yes
    @elseif($forminfo->isfunds == 2)
      No

    @endif

  </div>
  </div>


@if($forminfo->funds != "")
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Amount of Funds / grant </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->funds !!}
  </div>
  </div>
@endif

 <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Description </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->description !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Budget Availability</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->budget_availability == 1)
     Confirmed that Budget is available for the course
    @elseif($forminfo->budget_availability == 2)
      Insufficient Budget left

    @endif

  </div>
  </div>
