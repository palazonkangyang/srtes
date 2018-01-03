<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class GlobalSetting extends Model {
	protected $table = 'ams_globalsetting';


	public $timestamps = true;
	
	

}