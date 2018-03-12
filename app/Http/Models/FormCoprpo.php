<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormCoprpo extends Model
{
    //
	protected $table = 'ams_form_coprpo';
	
	public $timestamps = true;
	
	public function coprpo()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}