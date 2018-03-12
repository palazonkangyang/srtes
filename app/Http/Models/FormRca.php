<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormRca extends Model
{
    //
	protected $table = 'ams_form_rca';
	
	public $timestamps = true;
	
	public function rca()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}