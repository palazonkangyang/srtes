<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormArea extends Model
{
    //
	protected $table = 'ams_form_area';
	
	public $timestamps = true;
	
	public function area()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}