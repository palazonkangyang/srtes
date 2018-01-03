<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormMjr extends Model
{
    //
	protected $table = 'ams_form_mjr';
	
	public $timestamps = true;
	
	public function mjr()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}