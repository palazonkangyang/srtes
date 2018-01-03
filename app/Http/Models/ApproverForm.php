<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class ApproverForm extends ModelCore
{
    //
	protected $table = 'ams_approver_form';
	
	
	public $timestamps = true;
	
	/**
	 * select user approver list
	 */
	public function Approverlist()
	{
		return $this->belongsto('App\Http\Models\User', 'user_id');
	}
	public function Grouplist()
	{
		return $this->belongsto('App\Http\Models\FlexiGroup', 'group_id');
	}
	/**
	 * select form list
	 */
	public function Formlist()
	{
		return $this->belongsto('App\Http\Models\Forms', 'form_id');
	}
}
