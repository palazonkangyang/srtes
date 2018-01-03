  
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Desired Email Account</div>
    <div class="col-md-10 bg-ff">
  @if($myapplist[0]->status == 0 && $mark == 'creator')
                  {!! Form::input('text','email', $forminfo->email , array( 'id' => 'email', 'class' => 'form-control')) !!}
        @else
    {{ $forminfo->email }}
                  @endif
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons</div>
  <div class="col-md-10 bg-ff">
     @if($myapplist[0]->status == 0 && $mark == 'creator')
       {!! Form::textarea('reasons', $forminfo->reasons, array( 'id' => 'reasons', 'class' => 'ckeditor form-control')) !!}
  @else
        {!!  $forminfo->reasons !!}
                  @endif
  </div>
  </div>
  