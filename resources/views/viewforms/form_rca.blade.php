    @if($myapplist[0]->status == 0 && $mark == 'creator')
    <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of Copies</div>
  <div class="col-md-10 bg-ff">
        {!! Form::text('number_of_copies',$forminfo->copies,['class'=>'form-control width-20', 'id'=>'number_of_copies']) !!}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons for Color Printing</div>
  <div class="col-md-10 bg-ff">
     {!! Form::textarea('reasons_for_request', $forminfo->reasons, ['class' => 'ckeditor form-control']) !!}
  </div>
  </div>
    
      @else      
  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Number of Copies</div>
  <div class="col-md-10 bg-ff">
    {{ $forminfo->copies }}
  </div>
  </div>

  <div class="row bg-cc-only">
  <div class="col-md-2 bg-cc">Reasons For Request</div>
  <div class="col-md-10 bg-ff">
    {!! $forminfo->reasons !!}
  </div>
  </div>
        @endif