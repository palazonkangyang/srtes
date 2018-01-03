<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MultipleFilter extends TextFilter
{

	/**
	 * (non-PHPdoc)
	 * @see \App\Core\FilterCore::addFilter()
	 */
	public function addFilter($model, $name, $scope='')
	{
		$this->setName($name);
		$this->value = $this->get();
		
		if(!$this->request->has($name) && !$this->getValue())
		{
			return $model;
		}
		elseif($this->request->get($name))
		{
			$this->setValue( array('from' => $this->request->get($name), 'to' => $this->request->get($name.'_to')) );
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
		
		return $scope ? $this->$scope($model) : $model->where($name,'=',$this->getValue());
	}

	public function getfrom (){
		if(isset($this->value['from']))
			return $this->value['from'];
		else
			return '';
	}


	public function getto (){
		if(isset($this->value['to']))
			return $this->value['to'];
		else
			return '';
	}


}