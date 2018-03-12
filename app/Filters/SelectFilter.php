<?php

namespace App\Filters;

use App\Core\FilterCore;

class SelectFilter extends FilterCore
{
	/**
	 * Single Select Flag
	 * @var unknown
	 */
	const SINGLE_SELECT = 1;
	
	/**
	 * Multiple Select flag
	 * @var unknown
	 */
	const MULTIPLE_SELECT = 2;
	
	/**
	 * Select type value
	 * @var unknown
	 */
	protected $selectType = self::SINGLE_SELECT;
	
	public function __construct($label,$type)
	{
		$this->selectType = $type;
		parent::__construct($label);	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \App\Core\FilterCore::addFilter()
	 */

	public function addFilter($model, $name, $scope='')
	{

		$this->setName($name);
		$this->value = $this->get();
		
		if(!$this->request->has($name) && !is_array($this->value) && !strlen($this->value))
		{
			return $model;
		}
		elseif($this->request->get($name))
		{
			$value = $this->request->get($name);
			if(!is_array($value) && $this->selectType == self::MULTIPLE_SELECT)
			{
				$value = array($value);
			}
			
			$this->setValue($value);
			//$this->store();
		}
		
		if($model instanceof Model)
		{
			$name = $model->getTable().'.'.$name;
		}
		else
		{
			$name = $model->getModel()->getTable().'.'.$name;
		}
		
		$val = $this->getValue();
		if(!is_array($val))
		{
			$val = array($val);
		}
		return $scope ? $this->$scope($model) : $model->whereIn($name,$val);
	}
	
	/**
	 * Render the filter field
	 */
	public function render()
	{
		$multiple = $this->selectType == self::MULTIPLE_SELECT ? true : false;
		return \Form::filterSelect($this->name.'[]',$this->options,$this->label, $this->value, $multiple);
	}
	
	/**
	 * Get select type
	 * @return string
	 */
	public function getSelectType()
	{
		return $this->selectType;
	}
	
	/**
	 * Set select type
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->selectType = $type;
	}	
	
	/**
	 * Query scope for filtering data by category Ids
	 * @param unknown $model
	 * @param string $values
	 */
	public function byUrgency($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

	
		return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.urgency','=', $values);
					});
	}
	/**
	 * Query scope for filtering data by category Ids
	 * @param unknown $model
	 * @param string $values
	 */
	public function byDepartment($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}
	
		return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.department','=', $values);
					});
	}

	/**
	 * Query scope for filtering data by category Ids
	 * @param unknown $model
	 * @param string $values
	 */
	public function byTof($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}
	
		return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.type_request','=', $values);
					});
	}

        
        public function byforms($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}
	
		return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.type_form','=', $values);
					});
	}
	/**
	 * Query scope for filtering data by category Ids
	 * @param unknown $model
	 * @param string $values
	 */
	public function byStatus($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}
	
		return  $model->whereNested(function($query) use ($values) {

							if($values == 5) $values=0;
							$query->where('ams_applications.status','=', $values);
					});
	}
	
	
}
