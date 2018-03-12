<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormPcmcf2 extends Model
{
    //
	protected $table = 'ams_form_pcmcf2';
	
	public $timestamps = true;
	
	public function pcmcf2()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}