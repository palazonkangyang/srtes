<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class RequestToForm extends ModelCore
{
    //
	protected $table = 'ams_request_to_form';
	
	public $timestamps = true;
	
	/**
	 * select form list
	 */
	public function Formlist()
	{
		return $this->belongsto('App\Http\Models\Forms', 'form_id');
	}
}
