<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Roles extends Model {

	protected $connection = 'mysql2';
	
	protected $table = 'users_group';


	public $timestamps = true;
	

}