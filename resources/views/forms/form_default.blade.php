<div class="form-group">
    <label for="title">Title (*)</label>
    {!! Form::text('title',NULL,['class'=>'form-control', 'id'=>'title']) !!}
  </div>

<div class="form-group">
    <label for="request_details">Request Details (*)</label>
    {!! Form::textarea('request_details', null, ['class' => 'ckeditor form-control']) !!}
</div>
<div class="form-group">
  	<div id="request_details"></div>
  </div>