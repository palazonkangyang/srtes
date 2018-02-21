@extends('layout.master')
@section('title',$title)
@section('content')

<div class="row">
  <div class="col-md-12"><h4 class="page-head-line">Account Settings</h4></div>
</div><!-- end row -->

<div class="wrap-content">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">

        <div class="panel-heading"><h4>SETTINGS</h4></div>

          <div class="panel-body">

              {!!Form::open(['url'=>'/controller/accountsettings','class'=>'accountsettings'])!!}

              <div class="form-group">

                <div class="col-md-2 col-sm-2">{!! Form::label('ooo', 'Out of Office (Settings)') !!}</div>

                <div class="col-md-2 col-sm-2 success-settings">
                  <div class="btn-group btn-toggle">
                    <button class="btn btn-default @if(!empty($user['0']['inoffice'])) active @endif">ON</button>
                    <button class="btn btn-default @if(empty($user['0']['inoffice'])) active @endif">OFF</button>
                  </div><!-- end btn-group btn-toggle -->

                  <span class="ooo-value">
                    <input type="hidden" class="ooo" name="ooo" value="@if(!empty($user['0']['inoffice']))1 @endif" />
                  </span><!-- end ooo-value -->

                </div><!-- end col-md-2 -->
              </div><!-- end form-group -->

              {!!Form::close()!!}

          </div><!-- end panel-body -->
        </div><!-- end panel -->

        {!!Form::open(['url'=>'/controller/tempapproveruser','class'=>'tempapprover'])!!}

        <div class="modal fade" id="temp-approver-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Temporary Approver</h4>
              </div><!-- end modal-header -->

              <div class="modal-body approver">
              </div><!-- end modal-body -->

              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="temp_approver_btn" disabled>Save changes</button>
              </div><!-- end modal-footer -->

            </div><!-- end modal-content -->
          </div><!-- end modal-dialog -->

        </div><!-- end modal -->

        {!!Form::close()!!}

        <div class="modal fade" id="approver-success-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Message</h4>
              </div><!-- end modal-header -->

              <div class="modal-body">
                <p>The temporary approver is successfully saved!</p>
              </div><!-- end modal-body -->

              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div><!-- end modal-footer -->

            </div><!-- end modal-content -->
          </div><!-- end modal-dialog -->

        </div><!-- end modal -->

      </div><!-- end col-md-12 -->

  </div><!-- end row -->
</div><!-- end wrap-content -->
@stop
