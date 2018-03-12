<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Approver extends ModelCore {

	protected $table = 'ams_approver_person';

	public $timestamps = true;

	public function Approver()
	{
		return $this->belongsTo('User', 'idsrc_login');
	}
}
