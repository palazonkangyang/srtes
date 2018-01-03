<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormMrf extends Model
{
    //
	protected $table = 'ams_form_mrf';
	
	public $timestamps = true;
	
	public function mrf()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}