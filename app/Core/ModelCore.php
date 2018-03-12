<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model;


/**
 * This class is a wrapper class for Laravel's Model Class.
 * Its mainly used for the core class for Models.
 * Models should extend this class
 *
 * @author alex
 *
 */
class ModelCore extends Model
{
	
	/**
	 * Save the model to the database.
	 * Overriden the parent so that customization can be added
	 *
	 * @param  array  $options
	 * @return bool
	 */
	public function save(array $options = [])
	{
		
		// Auto populate creator 
		/*if($this->__isset('created_id') && !$this->created_id && \Auth::user())
		{
			$this->setAttribute('created_id', \Auth::user()->idsrc_login);
		} */
		
		return parent::save($options);
	}
	
	
}