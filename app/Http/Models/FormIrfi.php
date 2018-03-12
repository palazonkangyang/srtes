<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormIrfi extends Model
{
    //
	protected $table = 'ams_form_irfi';
	
	public $timestamps = true;
	
	public function irfi()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}