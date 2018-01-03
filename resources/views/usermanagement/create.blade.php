@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Create new user</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Add user form</h4>
        <span class="pos-add-back pull-right"><a href="/management">Back to User List</a></span>
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

            {!!Form::open(['url'=>'/controller/adduser','class'=>'accountsettings',])!!} 

              <div class="form-group row">
                <label for="fullname" class="col-sm-2 form-control-label">Full Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','fullname', Input::old('fullname') , array('placeholder' => 'Full Name', 'id' => 'fullname', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 form-control-label">Email Address</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','email', Input::old('email') , array('placeholder' => 'Email Address', 'id' => 'email', 'class' => 'form-control')) !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 form-control-label">Department</label>
                <div class="col-sm-9">
                  
                  {!! Form::select('department',  $department_list, NULL, ['class'=>'form-control', 'id'=>'department']  ); !!}
                </div>
              </div>

                  

              <hr />

              <div class="form-group row">
                <label for="username" class="col-sm-2 form-control-label">Username / Login ID</label>
                <div class="col-sm-9">

                  {!! Form::input('text','username', Input::old('username') , array('placeholder' => 'Username / Login ID', 'id' => 'username', 'class' => 'form-control')) !!}
                </div>
              </div>
              
                 <div class="form-group row">
                <label for="employeeid" class="col-sm-2 form-control-label">Employee ID</label>
                <div class="col-sm-9">

                  {!! Form::input('text','employeeid', Input::old('employeeid') , array('placeholder' => 'Employee ID', 'id' => 'employeeid', 'class' => 'form-control')) !!}
                </div>
              </div>
         
{!! Form::hidden('new_password', 'nopassword' )!!}
{!! Form::hidden('new_password_confirmation', 'nopassword' )!!}

              <hr />
               <div class="form-group row">
                <label for="role" class="col-sm-2 form-control-label">Role</label>
                <div class="col-sm-9">
                    {!! Form::select('role',  $role_list, NULL, ['class'=>'form-control', 'id'=>'role']  ); !!}
                    
                </div>
              </div>
              
              <div class="form-group row">
                <label for="status" class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-9">
                    {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), Input::old('status'), array('class'=>'form-control', 'id' => 'status')); !!}
                </div>
              </div>

             

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <button type="submit" class="btn btn-default">Create User</button>
              </div>
            </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop