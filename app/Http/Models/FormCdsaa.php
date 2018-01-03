<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormCdsaa extends Model
{
    //
	protected $table = 'ams_form_cdsaa';
	
	public $timestamps = true;
	
	public function cdsaa()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}