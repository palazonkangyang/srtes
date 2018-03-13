<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormTsw extends Model
{
	protected $table = 'ams_form_tsw';

	public $timestamps = true;

	public function tsw()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}
