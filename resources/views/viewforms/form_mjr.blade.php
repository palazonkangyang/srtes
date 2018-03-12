  @if($myapplist[0]->status == 0 && $mark == 'creator')  
 <div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Date/Time of Damage</div>
	  <div class="col-md-10 bg-ff">
	      {!! Form::text('date_time_damage',$forminfo->date_time_damage,['class'=>'form-control datetimepicker', 'id'=>'date_time_damage']) !!}
	    </div>
	  </div>

	  <div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Damage Description</div>
	  <div class="col-md-10 bg-ff">
	      {!! Form::textarea('damage_description',$forminfo->damage_description, ['class' => 'ckeditor form-control']) !!}
	  </div>
	  </div>

	  <div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Operation(s) affected by damage </div>
	  <div class="col-md-10 bg-ff">
	   {!! Form::textarea('operations_affected', $forminfo->operations_affected, ['class' => 'ckeditor form-control']) !!}
	  </div>
	  </div>
  @else
<div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Date/Time of Damage</div>
	  <div class="col-md-10 bg-ff">
	    {!! date('j F Y, g:i a', strtotime($forminfo->date_time_damage)) !!}
	    <br /> &nbsp;
	  </div>
	  </div>

	  <div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Damage Description</div>
	  <div class="col-md-10 bg-ff">
	    {!! $forminfo->damage_description !!}
	  </div>
	  </div>

	  <div class="row bg-cc-only">
	  <div class="col-md-2 bg-cc">Operation(s) affected by damage </div>
	  <div class="col-md-10 bg-ff">
	    {!! $forminfo->operations_affected !!}
	  </div>
	  </div>
  @endif