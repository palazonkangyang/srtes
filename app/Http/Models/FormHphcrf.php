<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormHphcrf extends Model
{
    //
	protected $table = 'ams_form_hphcrf';
	
	public $timestamps = true;
	
	public function hphcrf()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}