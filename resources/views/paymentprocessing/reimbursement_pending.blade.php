@extends('layout.master')
@section('title', $title)
@section('content')

<script type="text/javascript">
  $(function() {
    $('.filter-select').change(function() {
      this.form.submit();
    });
  });
</script>

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible fade in fixed-error">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <strong>{{Session::get('success_message')}}</strong>
</div><!-- end alert -->

@elseif(Session::has('error_message'))
<div class="alert alert-danger alert-dismissible fade in fixed-error">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <strong>{{Session::get('error_message')}}</strong>
</div><!-- end alert -->

@elseif(Session::has('info_message'))
<div class="alert alert-info alert-dismissible fade in fixed-error">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <strong>{{Session::get('info_message')}}</strong>
</div><!-- end alert -->

@endif

<div class="row pos-rel">
  <div class="col-md-12"><h4 class="page-head-line">Pending Reimbursement</h4></div>
  <div class="print-table">
    @if(count($reports))
    <a download="reports.xls" href="#" onclick="return ExcellentExport.excel(this, 'xls-table', 'Report');" class="btn btn-default">export to Excel</a>
    <a download="reports.csv" href="#" onclick="return ExcellentExport.csv(this, 'xls-table');" class="btn btn-default">export to CSV</a>
    <a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
    @endif
  </div>
</div><!-- end row -->

<div class="wrap-content">

  <div class="hide">{{ $grant_total = 0 }} </div>

  {!!Form::open(['class'=>'form-horizontal filter_field fontsizing'])!!}

  <div class="form-group">
    <label class="col-md-2 control-label" for="textinput">Date: </label>

    <div class="col-md-3">
      <div class="input-daterange input-group" id="datepicker">
        <input class="input-sm form-control from_date" name="startdate" value="{{$fromtoFilter->getfrom()}}" type="text">
        <span class="input-group-addon">to</span>
        <input class="input-sm form-control to_date" name="startdate_to" value="{{$fromtoFilter->getto()}}" type="text">
      </div><!-- end input-daterange -->
    </div><!-- end col-md-3 -->

    <label class="col-md-2 control-label" for="search_field">Keyword: </label>
    <div class="col-md-5">
      {!! Form::text('search',$searchFilter->getValue(),['class'=>'form-control','id'=>'search_field']) !!}
      {!!Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!}
      <a href="" class="btn btn-default btn-cs">Clear</a>
    </div><!-- end col-md-5 -->

  </div><!-- end form-group -->

  {!!Form::close()!!}

  {!!Form::open(['route' => 'reimbursement_pending_store','method'=>'post']) !!}

   @if(count($reports))
   <div class="row">

     <div id="no-more-tables">

       <table class="col-md-12 table-bordered table-striped table-condensed cf" id="xls-table">
         <thead class="cf">
           <th></th>
           <th>{!!$reports->sortColumn('created_at','Date')!!}</th>
           <th>{!!$reports->sortColumn('case_number','S/N')!!}</th>
           <th>Type of Form</th>
           <th>Payee's Name</th>
           <th>Project Name</th>
           <th>Department</th>
           <th>Print Date</th>
           <th>{!!$reports->sortColumn('status','Status')!!}</th>
           <th>{!!$reports->sortColumn('ppstatus','PP Status')!!}</th>
           <th>{!!$reports->sortColumn('total','total')!!}</th>
         </thead>

         <tbody>

          @foreach($reports as $report)
          <tr>
            <td>
              <input type="checkbox" name="$reports[]" value="{{ $report->id }}">
            </td>
            <td data-title="Date">{{ date('d/m/Y', strtotime($report->created_at)) }}</td>
            <td data-title="S/N" ><a target="_blank" href="/application/view_reports/{{$report->id}}">{{ $report->case_number }}</a></td>
            <td data-title="FormType">{{ $report->form_name }}</td>
            <td data-title="cheque_payable_to">{{ $report->pcmcf_cheque_payable_to }}</td>
            <td data-title="project_name">{{ $report-> pcmcf_project_name }}{{ $report->pcmcf2_project_name }}</td>
            <td data-title="Department">{{ $report->department }}</td>
            <td data-title="print_date">
              @if(isset($report->print_date))
                {{ \Carbon\Carbon::parse($report->print_date)->format("d M Y") }}
              @endif
            </td>
            <td data-title="Status">
              @if($report->status == 0)
                <span class="alert-black">Pending</span>
              @elseif($report->status == 1)
                <span class="alert-black">Approved</span>
              @elseif($report->status == 2)
                <span class="alert-black">Rejected</span>
              @elseif($report->status == 3)
                <span class="alert-black">Cancelled</span>
              @elseif($report->status == 4)
                <span class="alert-black">Forwarded</span>
              @endif
            </td>
            <td data-title="PPStatus">
            @if($report->pp_status == 0)
              <span class="alert-black">Pending</span>
            @elseif($report->pp_status == 1)
              <span class="alert-black">Processing</span>
            @elseif($report->pp_status == 2)
              <span class="alert-black">Exported</span>
            @elseif($report->pp_status == 3)
              <span class="alert-black">Ready for Collection</span>
            @elseif($report->pp_status == 4)
              <span class="alert-black">Collected</span>
            @elseif($report->pp_status == 5)
              <span class="alert-black">Rejected</span>
            @endif
            </td>
            <td data-title="Total">{{ $report->total }}</td>
            <div class='hide'>{{$grant_total =$grant_total + $report->total }}</div>
          </tr>
          @endforeach

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Grant Total:</td>
            <td>{{$grant_total}}</td>
          </tr>
        </tbody>
      </table>
    </div><!-- end no-more-tables -->
  </div><!-- end row -->

  <span style="display:none">
    {!!$reports->sortColumn('','')!!}
  </span>

  {!!$reports->paginate()!!}

  @else
    <span class="no-data-display">No data to display.</span>
  @endif

</div><!-- end wrap-content -->

</br></br>

<div style='width: 100%; text-align: center;'>
  <div style=' display: inline-block;'>
    <input type="submit" name="processing" value="Processing" class="btn btn-default btn-cs">
    <input type="submit" name="reject" value="Reject" class="btn btn-default btn-cs">
    <a href="{{ URL::route('reimbursement') }}"  class="btn btn-default">Back</a>
    <a href="{{ URL::route('reimbursement_processing') }}"  class="btn btn-default">Next</a>
    {!! Form::close() !!}
  </div>
</div>

@stop
