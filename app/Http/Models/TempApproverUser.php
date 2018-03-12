<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class TempApproverUser extends ModelCore {

	protected $connection = 'mysql2';

	protected $table = 'temp_approver_users';

	protected $primaryKey = 'id';

	public $timestamps = true;

	/**
	* Get Department Head
	*
	*/
	/**
	 * select user approver list
	 */
	// public function hod()
	// {
	// 	return $this->hasOne('App\Http\Models\User', 'dept_head');
	// }
}
