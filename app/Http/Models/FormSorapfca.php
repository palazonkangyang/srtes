<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormSorapfca extends Model
{
    //
	protected $table = 'ams_form_sorapfca';

	public $timestamps = true;

	public function sorapfca()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}
