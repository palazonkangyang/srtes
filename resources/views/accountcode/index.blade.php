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
    <div class="col-md-12"><h4 class="page-head-line">GL Code Management</h4></div>
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
      <a href="/accountcode/createaccountcode" id="add-button" class="btn btn-default">Create GL Code</a>
    </span>
  </div>
</div>
{!!Form::close()!!}

@if(count($accountcodelist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$accountcodelist->sortColumn('name','Name')!!}</th>
        <th>{!!$accountcodelist->sortColumn('is3alpha','Has Cost Centre')!!}</th>
         <th>{!!$accountcodelist->sortColumn('description','Description')!!}</th>
         <th>Example</th>
    </thead>

    <tbody>
        @foreach($accountcodelist as $accountcode)
        <tr class="clickable-row" data-href="/accountcode/editaccountcode/{{$accountcode->id}}">
             <td data-title="id">{{ $accountcode->id }}</td>
            <td data-title="name">{{ $accountcode->name }}</td>
            <td data-title="is3alpha">
                @if($accountcode->is3alpha  ==1)
                
                Yes 
                @else
                 No 
                @endif
                
            </td>
            <td data-title="description">{{ $accountcode->description }}</td>
              <td >{!! $accountcode->example !!}</td>
           
                
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$accountcodelist->sortColumn('','')!!}
</span>

{!!$accountcodelist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>

@stop