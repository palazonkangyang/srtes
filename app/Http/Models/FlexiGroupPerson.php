<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class FlexiGroupPerson extends ModelCore
{
    //
	protected $table = 'ams_flexigroup_person';
	
	
	public $timestamps = true;
	
	/**
	 * select user group list
	 */
	public function Memberlist()
	{
		return $this->belongsto('App\Http\Models\User', 'user_id');
	}
	
	/**
	 * select form list
	 */
	public function Grouplist()
	{
		return $this->belongsto('App\Http\Models\FlexiGroup', 'group_id');
	}
}
