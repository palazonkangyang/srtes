<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class FlexiGroup extends Model {
	protected $table = 'ams_flexigroup';
	public $timestamps = true;
	
	public function Grouplist()
	{
		return $this->belongsto('App\Http\Models\Forms', 'group_id');
	}

}