<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemSorapfca extends Model
{
    //
	protected $table = 'ams_lineitem_sorapfca';
	
	public $timestamps = true;
	
	public function lineitemsorapfca()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}