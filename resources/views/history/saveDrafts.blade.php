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
    <div class="col-md-12"><h4 class="page-head-line">Saved Drafts</h4></div>
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


@if(count($myapplist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf" id="xls-table">
    <thead class="cf">
        <th>Date</th>
        <th>{!!$myapplist->sortColumn('case_number','S/N')!!}</th>
        <th>{!!$myapplist->sortColumn('type_request','Type')!!}</th>
        <th>{!!$myapplist->sortColumn('title','Title')!!}</th>
        <th>Urgency</th>
        <th>Department</th>
       
    </thead>

    <tbody>
        @foreach($myapplist as $myapp)
        <tr class="clickable-row" data-href="{{ url('history/edit/savedrafts').'/'.$myapp->id}}">

            <td data-title="Date">{{ date('d/m/Y', strtotime($myapp->created_at)) }}</td>
            <td data-title="S/N">{{ $myapp->case_number }}</td>
            <td data-title="Type">{{ $myapp->type_request }}</td>
            <td data-title="Title"><a href="{{url('history/edit/savedrafts').'/'.$myapp->id}}">{{ $myapp->title }}</a></td>
            <td data-title="Urgency">
                    @if($myapp->urgency == 1) 
                        Normal
                    @else 
                        Urgent
                    @endif
            </td>
            <td data-title="Department">{{ $myapp->department }}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$myapplist->sortColumn('','')!!}
</span>
{!!$myapplist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>


@stop