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
    <div class="col-md-12"><h4 class="page-head-line">Department Management</h4></div>
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
      <a href="/department/createdepartment" id="add-button" class="btn btn-default">Create Department</a>
    </span>
  </div>
</div>
{!!Form::close()!!}

@if(count($departmentlist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$departmentlist->sortColumn('department','Department Name')!!}</th>
        <th>{!!$departmentlist->sortColumn('deptdesc','Department Description')!!}</th>
          
        <th>Department Head</th>
         <th>Reporting Officer</th>
    </thead>

    <tbody>
        @foreach($departmentlist as $departments)
        <tr class="clickable-row" data-href="/department/editdepartment/{{$departments->idsrc_departments}}">

            <td data-title="idsrc_departments">{{ $departments->idsrc_departments }}</td>
            <td data-title="department">{{ $departments->department }}</td>
            <td data-title="deptdesc">{{ $departments->deptdesc }}</td>
            <td data-title="deptdesc">
            	@if(isset($departments->hod->loginname))
            		{{ $departments->hod->loginname }}
            	@else
            		<span class="alert-danger">No Department Head set</span>
            	@endif
            </td>    
                <td data-title="deptdesc">
            	@if(isset($departments->ro->loginname))
            		{{ $departments->ro->loginname }}
            	@else
            		<span class="alert-danger">No Reporting Officer set</span>
            	@endif
            </td>    
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$departmentlist->sortColumn('','')!!}
</span>

{!!$departmentlist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>

@stop