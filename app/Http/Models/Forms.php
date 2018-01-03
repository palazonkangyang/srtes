<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    //
	protected $table = 'ams_forms';
	
	
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
	
        
        public function CClist()
	{
		return $this->belongsto('App\Http\Models\User', 'user_id');
	}
        
	/**
	 * Forms relation to request
	 */
	public function request()
	{
		return $this->belongsToMany('App\Http\Models\TypeRequest','ams_request_to_form','form_id','request_id');
	}
	
}
