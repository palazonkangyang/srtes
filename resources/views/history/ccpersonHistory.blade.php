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
    <div class="col-md-12"><h4 class="page-head-line">CCperson History</h4></div>
    @if(count($ccpersonhistorylist))<div class="print-table"><a href="javascript:window.print()" id="print-page" class="btn btn-default">print</a></div>@endif
</div>

<div class="wrap-content"> 

{!!Form::open(['class'=>'form-horizontal filter_field fontsizing'])!!} 
<div class="form-group">
  <label class="col-md-1 control-label" for="textinput">Filter</label>  
  <div class="col-md-10">
      <div class="form-inline">
        {!! Form::select('department', $departmentFilter->getOptions(), $departmentFilter->getValue(), ['class'=>'form-control filter-select']  ) !!}
        {!! Form::select('typeofrequest', $tofFilter->getOptions(), $tofFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
        {!! Form::select('urgency', $urgencyFilter->getOptions(), $urgencyFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
        {!! Form::select('status', $statusFilter->getOptions(), $statusFilter->getValue(), ['class'=>'form-control filter-select'] ) !!}
      </div>
</div>
</div>
<div class="form-group">
<label class="col-md-1 control-label" for="textinput">Date: </label>  
<div class="col-md-3">
    <div class="input-daterange input-group" id="datepicker">
        <input class="input-sm form-control from_date" name="startdate" value="{{$fromtoFilter->getfrom()}}" type="text">
        <span class="input-group-addon">to</span>
        <input class="input-sm form-control to_date" name="startdate_to" value="{{$fromtoFilter->getto()}}" type="text">
    </div>
</div>
<label class="col-md-3 control-label" for="search_field">Keyword: </label>
  <div class="col-md-5"> 
    {!! Form::text('search',$searchFilter->getValue(),['class'=>'form-control','id'=>'search_field']) !!}
    {!!Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!} 
    <a href="" class="btn btn-default btn-cs">Clear</a>
  </div>
</div>
{!!Form::close()!!}
 

@if(count($ccpersonhistorylist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>Date</th>
        <th>{!!$ccpersonhistorylist->sortColumn('case_number','S/N')!!}</th>
        <th>{!!$ccpersonhistorylist->sortColumn('type_request','Type of Request')!!}</th>
        <th>Title</th>
        <th>Creator</th>
        <th>Urgency</th>
        <th>Department</th>
        <th>Status</th>
    </thead>

    <tbody>
        @foreach($ccpersonhistorylist as $ccperson)
        <tr class="clickable-row" data-href="/application/view_details/{{$ccperson->id}}">

            <td data-title="Date">{{ date('d/m/Y', strtotime($ccperson->created_at)) }}</td>
            <td data-title="S/N">{{ $ccperson->case_number }}</td>
            <td data-title="Type of Request">{{ $ccperson->type_request }}</td>
            <td data-title="Title">@if($ccperson->title){{ $ccperson->title }} @else {{ $ccperson->form_name }} @endif</td>
            <td data-title="Creator">{{ $ccperson->name }}</td>
            <td data-title="Type">
                    @if($ccperson->urgency == 1) 
                        Normal
                    @else 
                        Urgent
                    @endif
            </td>
            <td data-title="Department">{{ $ccperson->department }}</td>
            <td data-title="Status">
                @if($ccperson->status == 0) 
                    <span class="alert-black">Pending</span>
                @elseif($ccperson->status == 1)
                    <span class="alert-black">Approved</span>
                @elseif($ccperson->status == 2)
                    <span class="alert-black">Rejected</span>
                @elseif($ccperson->status == 3)
                    <span class="alert-black">Cancelled</span>
                 @elseif($ccperson->status == 4)
                    <span class="alert-black">Forwarded</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$ccpersonhistorylist->sortColumn('','')!!}
</span>
{!!$ccpersonhistorylist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>


@stop