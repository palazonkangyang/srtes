<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormAca extends Model
{
    //
	protected $table = 'ams_form_aca';
	
	public $timestamps = true;
	
	public function aca()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}