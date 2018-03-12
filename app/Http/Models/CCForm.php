<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class CCForm extends ModelCore
{
    //
	protected $table = 'ams_cc_form';
	
	
	public $timestamps = true;
	
	/**
	 * select user approver list
	 */
	public function CClist()
	{
		return $this->belongsto('App\Http\Models\User', 'user_id');
	}
	
	/**
	 * select form list
	 */
	public function Formlist()
	{
		return $this->belongsto('App\Http\Models\Forms', 'form_id');
	}
}
