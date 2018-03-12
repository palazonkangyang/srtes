@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Create New Cost Centre</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Add Cost Centre form</h4>
        <span class="pos-add-back pull-right"><a href="/optionalcode">Back to Cost Centre List</a></span>
      </div>
        <div class="panel-body">

          @if(Session::has('success'))
              <div class="alert-success" style="margin-bottom:20px;">
                  <div class="success-msg"><span class="glyphicon glyphicon-ok"></span> {{ Session::get('success') }}</div>
              </div>
          @elseif($errors->all())
            <div class="alert-danger padding" style="margin-bottom:20px;">
            @foreach($errors->all() as $error)
              <div class="error-list"> <span class="glyphicon glyphicon-remove"></span> {!!$error!!}</div>
            @endforeach
            </div>
          @endif

            {!!Form::open(['url'=>'/controller/createoptionalcode','class'=>'accountsettings',])!!} 

      
            
              <div class="form-group row">
                <label for="name" class="col-sm-3 form-control-label">Cost Centre Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','name', Input::old('name') , array('placeholder' => 'Cost Centre Name', 'id' => 'name', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-sm-3 form-control-label">Description</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','description', Input::old('description') , array('placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control')) !!}
                </div>
              </div>
				
			 
               
              <div class="form-group row">
                <div class="col-sm-12" style="text-align:center">
                  <button type="submit" class="btn btn-default">Create Cost Centre</button>
                </div>
              </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	
</script>
@stop