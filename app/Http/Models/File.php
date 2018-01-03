<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class File extends ModelCore {

	protected $table = 'ams_files';

	public $timestamps = true;

	
	public function Files()
	{
		return $this->belongsTo('Applications', 'id');
	}

}