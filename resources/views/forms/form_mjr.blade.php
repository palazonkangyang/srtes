	<div class="form-group">
	    <div class="row">
	      <div class="col-sm-3"> 
	        <label for="date_time_damage">Date/Time of Damage (*)</label>
	        {!! Form::text('date_time_damage',NULL,['class'=>'form-control datetimepicker', 'id'=>'date_time_damage']) !!}
	      </div>
	    </div>
	</div>

	<div class="form-group">
	    <label for="reasons">Damage Description (*)</label>
	     {!! Form::textarea('damage_description', null, ['class' => 'ckeditor form-control']) !!}
	</div>
	<div class="form-group">
	  	<div id="damage_description"></div>
	</div>

	<div class="form-group">
	    <label for="reasons">Operation(s) affected by damage (*)</label>
	     {!! Form::textarea('operations_affected', null, ['class' => 'ckeditor form-control']) !!}
	</div>
	<div class="form-group">
	  	<div id="operations_affected"></div>
	</div>