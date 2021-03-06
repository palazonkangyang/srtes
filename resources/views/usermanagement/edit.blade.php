@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Edit user</h4></div>
</div>
<div class="wrap-content">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Edit user form</h4>
        <span class="pos-add-back pull-right"><a href="/management">Back to User List</a></span>
      </div>

       @if($user['0']->isactive == 1)
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

            {!!Form::open(['url'=>'/controller/updateuser','class'=>'accountsettings',])!!} 

            {!! Form::input('hidden','id', $id) !!}

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

              <hr />

              <div class="form-group row">
                <label for="username" class="col-sm-2 form-control-label">Username / Login ID</label>
                <div class="col-sm-9">

                  {!! Form::input('text','username', $user['0']->loginid , array('placeholder' => 'Username / Login ID', 'id' => 'username', 'class' => 'form-control')) !!}
                </div>
              </div>

               <div class="form-group row">
                <label for="employeeid" class="col-sm-2 form-control-label">Employee ID</label>
                <div class="col-sm-9">

                  {!! Form::input('text','employeeid', $user['0']->employeeid , array('placeholder' => 'Employee ID', 'id' => 'employeeid', 'class' => 'form-control')) !!}
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
                <label for="status" class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-9">
                    {!! Form::select('status', array('1' => 'Active', '0' => 'Inactive'), $user['0']->isactive, array('class'=>'form-control', 'id' => 'status')); !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="role" class="col-sm-2 form-control-label">Role</label>
                <div class="col-sm-9">
                    {!! Form::select('role',  $role_list, NULL, ['class'=>'form-control', 'id'=>'role']  ); !!}
                </div>
              </div>

            <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <button type="submit" class="btn btn-default">Save Changes</button> 
                 &nbsp; 
                 <a href="#" class="btn btn-danger"  data-href="/controller/removeuser/{{$id}}" data-toggle="modal" data-target="#confirm-delete">Remove User</a>
              </div>
            </div>     
            {!!Form::close()!!}
        </div>
        @else
        <div class="form-group row">
              <div class="col-sm-12" style="text-align:center">
                <p style="font-size:16px; padding:10px 0;">User has been remove by admins if you want to activate this again. Please click the button "Activate User" below.</p>
                 <a class="btn btn-danger"  href="/controller/activate/{{$id}}" >Activate User</a>
              </div>
            </div> 

        @endif

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <strong>{{$user['0']->loginname}}</strong>, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Remove</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  });
</script>
@stop