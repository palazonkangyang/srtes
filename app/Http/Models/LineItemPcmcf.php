<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemPcmcf extends Model
{
    //
	protected $table = 'ams_lineitem_pcmcf';
	
	public $timestamps = true;
	
	public function lineitempcmcf()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}