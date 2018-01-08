  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Present Designation</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $forminfo->designation }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Service Status in SRC</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      @if($forminfo->service_status == 1)
        Confirmed
      @elseif($forminfo->service_status == 2)
        Probation
      @elseif($forminfo->service_status == 3)
        Part-Time
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Title of Programme</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $forminfo->title }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Date and Time of Programme</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      <table class="table table-striped table-condensed" id="itemsTable">
        <thead>
          <tr>
            <th >Date</th>
          </tr>
        </thead>

        <tbody>
          @if(count($formlineitem) > 0)

            @foreach ($formlineitem as $lineitem)
            <tr>
              <td>{!! $lineitem->item_date !!}</td>
            </tr>
            @endforeach

          @endif
        </tbody>
      </table>
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Type of Training</div>
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
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Programme Fee </div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $forminfo->fee }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Programme Provider</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {{ $forminfo->provider }}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Funds or grant</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      @if($forminfo->isfunds == 1)
        Yes
      @elseif($forminfo->isfunds == 2)
        No
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  @if($forminfo->funds != "")
  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Amount of Funds/ grant</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->funds !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->
  @endif

 <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Description</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      {!! $forminfo->description !!}
    </div><!-- end col-md-10 -->
  </div><!-- end row -->

  <div class="row bg-cc-only">
    <div class="col-md-2 bg-cc">Budget Availability</div><!-- end col-md-2 -->
    <div class="col-md-10 bg-ff">
      @if($forminfo->budget_availability == 1)
       Confirmed that Budget is available for the course
      @elseif($forminfo->budget_availability == 2)
        Insufficient Budget left
      @endif
    </div><!-- end col-md-10 -->
  </div><!-- end row -->
