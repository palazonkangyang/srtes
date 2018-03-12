@extends('layout.master')
@section('title',$title)
@section('content')


@if(Session::has('success'))
<div class="container">
<div class="alert alert-success alert-dismissible fade in fixed-error">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong> {{ Session::get('success') }}</strong>
</div>
</div>
@endif

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">User Management</h4></div>
</div>
<div class="wrap-content">

{!!Form::open(['class'=>'form-horizontal filter_field'])!!} 
<div class="form-group">
  <label class="col-md-1 control-label" for="search_field">Search</label>
  <div class="col-md-5"> 
    {!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
    {!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!} 
  </div>

  <div class="col-md-6">
    <span class="pull-right">
      <a href="/management/adduser" id="add-button" class="btn btn-default">Add User</a>
    </span>
  </div>
</div>
{!!Form::close()!!}

@if(count($userlist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$userlist->sortColumn('loginid','Login ID')!!}</th>
        <th>{!!$userlist->sortColumn('employeeid','Employee ID')!!}</th>
        <th>{!!$userlist->sortColumn('emailadd','Email Address')!!}</th>
        <th>{!!$userlist->sortColumn('loginname','Full Name')!!}</th>
        <th>Department</th>
        <th>Status</th>
    </thead>

    <tbody>
        @foreach($userlist as $users)
        <tr class="clickable-row" data-href="/management/edituser/{{$users->idsrc_login}}">

            <td data-title="loginid">{{ $users->idsrc_login }}</td>
            <td data-title="loginid">{{ $users->loginid }}</td>
            <td data-title="employeeid">{{ $users->employeeid }}</td>
            <td data-title="emailadd">{{ $users->emailadd }}</td>
            <td data-title="loginname">{{ $users->loginname }}</td>

            <td data-title="loginname">{{$users->deptdesc}} ({{$users->department}})</td>
            <td data-title="isactive">
                    @if($users->isactive == 1) 
                        Active
                    @else 
                        <span class="text-danger">Inactive</span>
                    @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$userlist->sortColumn('','')!!}
</span>

{!!$userlist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>

@stop