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

<div class="row pos-rel">
    <div class="col-md-12"><h4 class="page-head-line">Training Evaluation</h4></div>
    <div class="print-table">
{{--  @if(count($reports))
        <a download="reports.xls" href="#" onclick="return ExcellentExport.excel(this, 'xls-table', 'Report');" class="btn btn-default">export to Excel</a>
        <a download="reports.csv" href="#" onclick="return ExcellentExport.csv(this, 'xls-table');" class="btn btn-default">export to CSV</a>
        <a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a>
      @endif
--}}
    </div>
</div>


<div class="wrap-content">


{!!Form::open(['class'=>'form-horizontal filter_field fontsizing'])!!}
<div class="form-group">
  <label class="col-md-1 control-label" for="textinput">Filter</label>
  <div class="col-md-10">
      <div class="form-inline">
{{--
        {!! Form::select('department', $departmentFilter->getOptions(), $departmentFilter->getValue(), ['class'=>'form-control filter-select']  ) !!}
        {!! Form::select('typeofrequest', $tofFilter->getOptions(), $tofFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
          {!! Form::select('forms', $formsFilter->getOptions(), $formsFilter->getValue(), ['class'=>'form-control filter-select']  ) !!}

        {!! Form::select('urgency', $urgencyFilter->getOptions(), $urgencyFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
        {!! Form::select('status', $statusFilter->getOptions(), $statusFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
--}}
      </div>
</div>
</div>
<div class="form-group">
<label class="col-md-1 control-label" for="textinput">Date: </label>
<div class="col-md-3">
    <div class="input-daterange input-group" id="datepicker">
{{--
        <input class="input-sm form-control from_date" name="startdate" value="{{$fromtoFilter->getfrom()}}" type="text">
        <span class="input-group-addon">to</span>
        <input class="input-sm form-control to_date" name="startdate_to" value="{{$fromtoFilter->getto()}}" type="text">
--}}
    </div>
</div>
<label class="col-md-3 control-label" for="search_field">Keyword: </label>
  <div class="col-md-5">
{{--
    {!! Form::text('search',$searchFilter->getValue(),['class'=>'form-control','id'=>'search_field']) !!}
    {!!Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!}
--}}
    <a href="" class="btn btn-default btn-cs">Clear</a>
  </div>
</div>
{!!Form::close()!!}



@if(count($reports))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf" id="xls-table">
    <thead class="cf">
        <th>Date</th>
        <th>{!!$reports->sortColumn('case_number','S/N')!!}</th>
        <th>{!!$reports->sortColumn('type_request','Type of Request')!!}</th>
        <th>Title</th>
        <th>Urgency</th>
        <th>Department</th>
        <th>{!!$reports->sortColumn('status','Status')!!}</th>
    </thead>

    <tbody>

        @foreach($reports as $report)
        <tr class="clickable-row" data-href="/application/view_reports/{{$report->id}}">

            <td data-title="Date">{{ date('d/m/Y', strtotime($report->created_at)) }}</td>
            <td data-title="S/N">{{ $report->case_number }}</td>
            <td data-title="Type">{{ $report->type_request }}</td>
            <td data-title="Title">@if($report->title){{ $report->title }} @else {{ $report->form_name }} @endif</td>
            <td data-title="Urgency">
                    @if($report->urgency == 1)
                        Normal
                    @else
                        Urgent
                    @endif
            </td>
            <td data-title="Department">{{ $report->department }}</td>
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
                @elseif($report->status == 6)
                    <span class="alert-black">Review Required</span>
                @elseif($report->status == 7)
                    <span class="alert-black">Review Given</span>
                @endif
            </td>

        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$reports->sortColumn('','')!!}
</span>
{!!$reports->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>


@stop
