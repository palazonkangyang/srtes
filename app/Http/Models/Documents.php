<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Documents extends ModelCore {

	protected $table = 'ams_documents';

	public $timestamps = true;

	
	public function Documents()
	{
		return $this->belongsTo('Applications', 'id');
	}

}