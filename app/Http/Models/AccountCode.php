<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class AccountCode extends Model {
	protected $table = 'ams_accountcode';


	public $timestamps = true;
	
	

}