<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class TypePerson extends ModelCore {


	protected $table = 'person_setting';

	protected $guarded = array('id');
	
	public $timestamps = true;
	
	
	/**
	 * Application
	 */
	public function Application()
	{
		return $this->hasOne('App\Http\Models\Application', 'id');
	}
	
	/**
	 * Get user
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function postperson()
	{
		return $this->belongsto('App\Http\Models\User', 'puser_id');
	}
	public function forms()
	{
		return $this->belongsToMany('App\Http\Models\Forms','ams_request_to_form','request_id','form_id');
	}
        
	/**
	 * Request relation to Forms
	 */
}

