<div class="row bg-cc-only">
<div class="col-md-2 bg-cc">Title</div>
<div class="col-md-10 bg-ff">
  @if($myapplist[0]->status == 0 && $mark == 'creator')
                  {!! Form::input('text','title', $myapplist[0]->title , array( 'id' => 'title', 'class' => 'form-control')) !!}
        @else
        {{ $myapplist[0]->title }}
                  @endif

</div>
</div>

<div class="row bg-cc-only">
<div class="col-md-2 bg-cc">Request Details</div>
<div class="col-md-10 bg-ff">
     @if($myapplist[0]->status == 0 && $mark == 'creator')
       {!! Form::textarea('request_details', $myapplist[0]->request_details, array( 'id' => 'request_details', 'class' => 'ckeditor form-control')) !!}
  @else
        {!! $myapplist[0]->request_details !!}
                  @endif
</div>
</div>