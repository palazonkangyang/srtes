<?php

namespace App\Core;

use App\Http\Controllers\Controller;

/**
 * This class is a wrapper class for Laravel's Controller.
 * Its mainly used for the core class for the Controllers.
 * Controllers should extend this class
 * 
 * @author alex
 *
 */

class ControllerCore extends Controller
{
	
	/**
	 * Add customization below
	 */
	
	/**
	 * Returns the Controller Classes directory
	 * @return string
	 */

	public function __construct()
    {
        $this->middleware('auth', ['except' => ['postLogin','execute','resetPassword']]);
    }

	public static function getControllerDirectory()
	{
		return app_path('Http/Controllers/');
	}
	
}