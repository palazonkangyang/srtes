<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemPcmcf2 extends Model
{
    //
	protected $table = 'ams_lineitem_pcmcf2';
	
	public $timestamps = true;
	
	public function lineitempcmcf2()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}