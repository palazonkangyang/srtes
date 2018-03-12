<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Department extends Model {

	protected $connection = 'mysql2';
	
	protected $table = 'departments';

	protected $primaryKey = 'idsrc_departments';

	public $timestamps = true;
	
	
	/**
	* Get Department Head
	*
	*/
	/**
	 * select user approver list
	 */
	public function hod()
	{
		return $this->belongsto('App\Http\Models\User', 'dept_head');
	}

        public function ro()
	{
		return $this->belongsto('App\Http\Models\User', 'dept_ro');
	}
}