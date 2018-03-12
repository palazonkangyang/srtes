<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LineItemTsw extends Model
{
  //
	protected $table = 'ams_lineitem_tsw';

	public $timestamps = true;

	public function lineitemtsw()
	{
		return $this->belongsTo('App\Http\Models\Application','app_id');
	}
}
