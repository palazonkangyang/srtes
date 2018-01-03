<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;
use OwenIt\Auditing\AuditingTrait;
class User extends ModelCore {
 use AuditingTrait;

     public static $logCustomMessage = '{user.loginname|Anonymous} login   {elapsed_time}'; // with default value
 
	protected $connection = 'mysql2';
	
	protected $table = 'users';

	protected $primaryKey = 'idsrc_login';
	
	public $timestamps = true;

	/**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'moddate';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'moddate';


	public function CreatedTypeRequest()
	{
		return $this->hasMany('TypeRequest', 'created_id');
	}


	public function CreatedApplications()
	{
		return $this->hasMany('Application', 'created_id');
	}

}