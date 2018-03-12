@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">List of all forms</h4></div>
</div>

<div class="wrap-content">

@if(count($forms))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th style='width:5%'>ID</th>
        <th style='width:25%'>Name</th>
          <th style='width:35%'>Approval Logic</th>
        <th style='width:15%'>List of Approvers</th>
          <th style='width:15%'>List of CCs</th>
        <th class="table-actions">Action</th>
    </thead>

    <tbody>

        @foreach($forms as $key => $form)
        <tr>
        
            <td>{{ $key }}</td>
            <td>{{ $form['form_name'] }}</td>
            <td>{!! $form['form_approvallogic'] !!}</td>
            <td>
                 @if($key == 12 || $key ==13|| $key ==14 || $key ==15 || $key ==16|| $key ==19 || $key ==20)
                 @else
            	@foreach($form['approvers'] as $keynote => $app )
                @if($app['approverlist'])
            		[{{ $keynote+1 }}] {{ $app['approverlist']['loginname'] }} <br />
                @else        
                      [{{ $keynote+1 }}]  <a target="_blank" href="{{url('/flexigroup/viewflexigroup/'.$app['group_id'])}}">click to view</a> <br />   
                        @endif
            	@endforeach
                @endif
            </td>
             <td>
            	@foreach($form['ccs'] as $keynote => $app )
            		[{{ $keynote+1 }}] {{ $app['cclist']['loginname'] }} <br />
            	@endforeach
            </td>
           
           
            <td data-title="Action" class="twine">
            	<a href="/settings/request/setapprovers/{{$key}}" data-hover="tooltip" data-placement="top" title="Set Approvers"><i class="glyphicon glyphicon-list-alt"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>
@stop