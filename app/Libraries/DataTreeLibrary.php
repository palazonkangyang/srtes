<?php

namespace App\Libraries;

use App\Core\LibraryCore;


class DataTreeLibrary extends LibraryCore
{
	
	/**
	 * The subject model
	 * @var $subjectModel
	 */
	protected $subjectModel;
	
	/**
	 * The relational field to parent
	 * @var $parentField
	 */
	protected $parentField;
	
	
	
	/**
	 * The class contructor
	 */
	public function __construct()
	{
		
	}
	
	
}

