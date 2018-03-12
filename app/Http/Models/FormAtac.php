<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormAtac extends Model
{
    //
	protected $table = 'ams_form_atac';
	
	public $timestamps = true;
	
	public function atac()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}