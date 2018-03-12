<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormEoq extends Model
{
    //
	protected $table = 'ams_form_eoq';
	
	public $timestamps = true;
	
	public function eoq()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}