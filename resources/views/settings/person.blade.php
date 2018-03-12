@extends('layout.master')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Fixed Position Settings</h4></div>
</div>


<div class="wrap-content">







@if(Session::has('rmsg')) <div class="alert alert-success"> {{ Session::get('rmsg') }} </div> @endif
@if(Session::has('dmsg')) <div class="alert alert-danger"> {{ Session::get('dmsg') }} </div> @endif

@if(count($typepersons))
<div class="row">
<div id="no-more-tables">
 <table class="col-md-12 table-bordered table-striped table-condensed cf">
    <thead class="cf">
        <th>ID</th>
        <th>{!!$typepersons->sortColumn('post','Post ')!!}</th>
        <th>Person In Charge</th>
        <th class="table-actions">Action</th>
    </thead>

    <tbody>
        @foreach($typepersons as $typeperson)
        <tr>
               <td data-title="ID"><span class="xedit" id="{{ $typeperson->id }}" data-name="id">{{ $typeperson->id }}</span></td>
        
            
             <td data-title="Name"><span class="xedit" id="{{ $typeperson->id }}" data-name="post">{{ $typeperson->post }}</span></td>
            
            <td>
  	@if(isset($typeperson->postperson->loginname))
            		{{ $typeperson->postperson->loginname }}
            	@else
            		<span class="alert-danger">No Person set</span>
            	@endif         
            </td>
            <td data-title="Action" class="twine">
            	<a href="/settings/person/editperson/{{$typeperson->id}}" data-hover="tooltip" data-placement="top" title="Setup Request"><i class="glyphicon glyphicon-list-alt"></i></a>
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