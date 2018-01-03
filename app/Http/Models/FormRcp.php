<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormRcp extends Model
{
    //
	protected $table = 'ams_form_rcp';
	
	public $timestamps = true;
	
	public function rcp()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}