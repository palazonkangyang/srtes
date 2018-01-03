<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Position </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->position !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Job Grade </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->job_grade !!}
  </div>
  </div>

<div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Location </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->location !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Job Type</div>
  <div class="col-md-10 bg-ff">
    @if($forminfo->job_type == 1)
      Full Time
    @elseif($forminfo->job_type == 2)
      Part Time
    @elseif($forminfo->job_type == 3)
      Temporary
    @elseif($forminfo->job_type == 4)
     Contract of Service
     @elseif($forminfo->job_type == 5)
     Auxilliary Staff
    @endif

  </div>
  </div>

  @if($forminfo->job_type == 1)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Full Time Option</div>
  <div class="col-md-10 bg-ff">
  @if($forminfo->full_time_option == 1)
      Replacement due to resignation /termination / transfer / end of contract
    @elseif($forminfo->full_time_option == 2)
      Filling a newly approved and budgeted
    @elseif($forminfo->full_time_option == 3)
      Filling a newly non-approved and non-budgeted position
   
    @endif
   
  </div>
  </div>
  @else 
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of Months  </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->no_months !!}
  </div>
  </div>
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of hours/day  </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->no_hoursday !!}
  </div>
  </div>
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of days/week  </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->no_daysweek !!}
  </div>
  </div>
   <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Describe Hours of work </div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->desc_works !!}
  </div>
  </div>
  @endif
  
    @if($forminfo->full_time_option == 1)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Replacement for / & Designation</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->full_type_desc }}
   
  </div>
  </div>
     @elseif($forminfo->full_time_option == 3)
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Please provide justification for option</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->full_type_desc3 }}
   
  </div>
  </div>
  @endif