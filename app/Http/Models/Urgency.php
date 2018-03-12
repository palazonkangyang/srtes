<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Urgency extends ModelCore {

	protected $table = 'ams_urgency';

	public $timestamps = true;

	
	public function Urgency()
	{
		return $this->belongsTo('Applications', 'id');
	}

}