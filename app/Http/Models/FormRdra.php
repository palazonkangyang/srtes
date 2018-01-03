<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormRdra extends Model
{
    //
	protected $table = 'ams_form_rdra';
	
	public $timestamps = true;
	
	public function rdra()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}