<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Recommend extends Model {

	protected $table = 'ams_recommend';

	public $timestamps = true;

	public function Recommend()
	{
		return $this->belongsTo('User', 'idsrc_login');
	}

}