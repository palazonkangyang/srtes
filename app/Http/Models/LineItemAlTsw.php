<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemAlTsw extends Model
{
    //
	protected $table = 'ams_lineitem_al_tsw';
	
	public $timestamps = true;
	
	public function lineitemaltsw()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}