<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class OptionalCode extends Model {

	protected $table = 'ams_optionalcode';


	public $timestamps = true;
	
	

}