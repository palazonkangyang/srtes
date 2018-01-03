<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Ccperson extends ModelCore {

	protected $table = 'ams_cc_person';

	public $timestamps = true;

	
	public function CCPerson()
	{
		return $this->belongsTo('User', 'idsrc_login');
	}

}