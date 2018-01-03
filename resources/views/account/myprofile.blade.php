@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">My Profile</h4></div>
</div>

<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Edit My Profile</h4></div>
        <div class="panel-body">

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

            {!!Form::open(['url'=>'/controller/updateprofile','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id', $user['0']->idsrc_login ) !!}

              <div class="form-group row">
                <label for="fullname" class="col-sm-2 form-control-label">Full Name</label>
                <div class="col-sm-9">
                 
                  {!! Form::input('text','fullname', $user['0']->loginname , array('placeholder' => 'Full Name', 'id' => 'fullname', 'class' => 'form-control')) !!}
                
                  
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 form-control-label">Email Address</label>
                <div class="col-sm-9">
                  
                  {!! Form::input('text','email', $user['0']->emailadd , array('placeholder' => 'Email Address', 'id' => 'email', 'class' => 'form-control')) !!}
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

                  {!! Form::input('text','username', $user['0']->loginid , array('placeholder' => 'Username / Login ID', 'id' => 'username', 'class' => 'form-control')) !!}
                </div>
              </div>


              <hr />

              <div class="form-group row">
                <label for="status" class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-9">
                    {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), $user['0']->isactive, array('class'=>'form-control', 'id' => 'status')); !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="role" class="col-sm-2 form-control-label">Role</label>
                <div class="col-sm-9">
                @if($user['0']->roleid == -1) 
                    <strong>SUPER ADMINISTRATOR</strong>
                @else
                    {!! Form::select('role',  $role_list, NULL, ['class'=>'form-control', 'id'=>'role', 'disabled'=>'']  ); !!}
                @endif
                </div>
              </div>



            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <button type="submit" class="btn btn-default">Save Changes</button>
              </div>
            </div>
             
            {!!Form::close()!!}
        </div>
             
            {!!Form::close()!!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop