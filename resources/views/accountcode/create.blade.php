@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Create New GL Code</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Add GL Code form</h4>
        <span class="pos-add-back pull-right"><a href="/accountcode">Back to GL Code List</a></span>
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

            {!!Form::open(['url'=>'/controller/createaccountcode','class'=>'accountsettings',])!!} 

            <div class="form-group row">
            <label for="is3alpha" class="col-sm-3 form-control-label">Has Cost Centre (Please tick*)</label>
        <div class="radio col-sm-9">   
            <label>
                {!! Form::radio('is3alpha', 1 , null, ['id' => 'is3alpha']) !!} Yes
            </label>
            <label>
                {!! Form::radio('is3alpha', 0 , null, ['id' => 'is3alpha']) !!} No
            </label>  
        </div>
    <div id="is3alpha"></div>
  </div>
            
              <div class="form-group row">
                <label for="name" class="col-sm-3 form-control-label">GL Code Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('number','name', Input::old('name') , array('placeholder' => 'Account Code Name', 'id' => 'name', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-sm-3 form-control-label">Description</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','description', Input::old('description') , array('placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control')) !!}
                </div>
              </div>
				
		
                <div class="form-group row">
                <label for="example" class="col-sm-3 form-control-label">Example</label>
                <div class="col-sm-9">
                  
                  {!! Form::textarea('example', Input::old('example') , array('placeholder' => 'Example', 'id' => 'example', 'class' => 'form-control')) !!}
                </div>
              </div>
			
              <div class="form-group row">
                <div class="col-sm-12" style="text-align:center">
                  <button type="submit" class="btn btn-default">Create GL Code</button>
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