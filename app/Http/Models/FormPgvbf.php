<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FormPgvbf extends Model
{
    //
	protected $table = 'ams_form_pgvbf';
	
	public $timestamps = true;
	
	public function pgvbf()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}