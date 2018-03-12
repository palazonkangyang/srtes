<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemEoq extends Model
{
    //
	protected $table = 'ams_lineitem_eoq';
	
	public $timestamps = true;
	
	public function lineitemeoq()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}