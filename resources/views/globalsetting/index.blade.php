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
    <div class="col-md-12"><h4 class="page-head-line">Notification Settings </h4></div>
</div>
<div class="wrap-content">

{!!Form::open(['class'=>'form-horizontal filter_field'])!!} 
<div class="form-group">
  <label class="col-md-1 control-label" for="search_field">Search</label>
  <div class="col-md-5"> 
    {!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
    {!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!} 
  </div>


</div>
{!!Form::close()!!}

@if(count($globalsettinglist))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$globalsettinglist->sortColumn('name','Name')!!}</th>
        <th>{!!$globalsettinglist->sortColumn('value','Value')!!}</th>
         <th>{!!$globalsettinglist->sortColumn('description','Description')!!}</th>
     
    </thead>

    <tbody>
        @foreach($globalsettinglist as $globalsetting)
        <tr class="clickable-row" data-href="/globalsetting/editglobalsetting/{{$globalsetting->id}}">
             <td data-title="id">{{ $globalsetting->id }}</td>
            <td data-title="name">{{ $globalsetting->name }}</td>
            <td data-title="value">{{ $globalsetting->value }} </td>
            <td data-title="description">{{ $globalsetting->description }}</td>    
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

<span style="display:none">
    {!!$globalsettinglist->sortColumn('','')!!}
</span>

{!!$globalsettinglist->paginate()!!}
@else
    <span class="no-data-display">No data to display.</span>
@endif

</div>

@stop