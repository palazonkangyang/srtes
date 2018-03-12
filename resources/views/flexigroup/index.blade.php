@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-6"><h4 class="page-head-line"> Groups Settings</h4></div>
    <div class="col-md-6">
    <span class="pull-right">
      <a href="/flexigroup/createflexigroup" id="add-button" class="btn btn-default">Create Group</a>
    </span>
  </div>
</div>

<div class="wrap-content">

@if(count($groups))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>Name</th>
        <th>Full Name</th>
        <th>List of Members</th>
         
        <th class="table-actions">Action</th>
    </thead>

    <tbody>

        @foreach($groups as $key => $group)
        <tr>
        
            <td>{{ $key }}</td>
            <td>{{ $group['group_name'] }}</td>
            <td>{{ $group['group_full_name'] }}</td>
            <td>
                 
            	@foreach($group['members'] as $keynote => $app )
            		[{{ $keynote+1 }}] {{ $app['memberlist']['loginname'] }} <br />
            	@endforeach
               
            </td>
           
           
           
            <td data-title="Action" class="twine">
            	<a href="/flexigroup/editflexigroup/{{$key}}" data-hover="tooltip" data-placement="top" title="Set Members"><i class="glyphicon glyphicon-list-alt"></i></a>
           
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