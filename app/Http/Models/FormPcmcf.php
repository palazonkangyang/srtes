<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormPcmcf extends Model
{
    //
	protected $table = 'ams_form_pcmcf';
	
	public $timestamps = true;
	
	public function pcmcf()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}