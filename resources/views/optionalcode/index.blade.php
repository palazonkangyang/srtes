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
    <div class="col-md-12"><h4 class="page-head-line">Cost Centre Management</h4></div>
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
      <a href="/optionalcode/createoptionalcode" id="add-button" class="btn btn-default">Create Cost Centre</a>
    </span>
  </div>
</div>
{!!Form::close()!!}

@if(count($optionalcodelist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$optionalcodelist->sortColumn('name','Name')!!}</th>
    
         <th>{!!$optionalcodelist->sortColumn('description','Description')!!}</th>
     
    </thead>

    <tbody>
        @foreach($optionalcodelist as $optionalcode)
        <tr class="clickable-row" data-href="/optionalcode/editoptionalcode/{{$optionalcode->id}}">
             <td data-title="id">{{ $optionalcode->id }}</td>
            <td data-title="name">{{ $optionalcode->name }}</td>
         
            <td data-title="description">{{ $optionalcode->description }}</td>
            
                
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$optionalcodelist->sortColumn('','')!!}
</span>

{!!$optionalcodelist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>

@stop