<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormArge extends Model
{
    //
	protected $table = 'ams_form_arge';
	
	public $timestamps = true;
	
	public function arge()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}