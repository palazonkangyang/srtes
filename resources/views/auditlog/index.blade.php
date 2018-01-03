@extends('layout.master')

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
    <div class="col-md-12"><h4 class="page-head-line">Audit Log</h4></div>
</div>
<div class="wrap-content">
   {!! Form::open(['method'=>'GET','url'=>'auditlog','class'=>'form-horizontal filter_field','role'=>'search'])  !!}

<div class="form-group">
  <label class="col-md-1 control-label" for="search_field">Username</label>
  <div class="col-md-2"> 
    {!! Form::text('search','',['class'=>'form-control','id'=>'search_field']) !!}
  </div>
   <label class="col-md-2 control-label" for="search_from_field">From</label>
    <div class="col-md-2">
    {!! Form::text('search_start',"{{ old('search_start') }}",['class'=>'form-control  start_date_hour']) !!}
    </div>
   <label class="col-md-1 control-label" for="search_from_field">To</label>
    <div class="col-md-2">
  {!! Form::text('search_end',NULL,['class'=>'form-control  end_date_hour']) !!}
    </div>
 <div class="col-md-2">
    {!! Form::submit('Search',['class'=>'btn btn-default btn-cs search_btn'])!!} 
  </div>
    </span>
</div>
{!! Form::close() !!}

<ol>
        @forelse ($logs as $log)
       
            
                @if($log->type=="updated")
                <li>
                     @if($log->route=="http://9testmachine.redcross.sg/controller/account/logout")
                {{ str_replace("login","logout",$log->customMessage) }} {{ $log->created_at}}
                @else
                {{$log->customMessage}}   {{ $log->created_at}}
                @endif
              @if($log->owner_type!=="App\Http\Models\User")
                <ul>
                    @forelse ($log->customFields as $custom)
                        <li>{{ $custom }}</li>
                    @empty
                        <li>No details</li>
                    @endforelse
                </ul>
                @endif
            </li>
              @endif
        @empty
            <p>No logs</p>
      
        @endforelse
    </ol>
    
</div>

@stop



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    //grab the entire query string
    var query = document.location.search.replace('?', '');
    
    //extract each field/value pair
    query = query.split('&');
    
    //run through each pair
    for (var i = 0; i < query.length; i++) {
    
      //split up the field/value pair into an array
      var field = query[i].split("=");
      
      //target the field and assign its value
      $("input[name='" + field[0] + "'], select[name='" + field[0] + "']").val(field[1]);
    
    }
  });
</script>
