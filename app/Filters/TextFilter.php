<?php

namespace App\Filters;

use App\Core\FilterCore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TextFilter extends FilterCore
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
			$this->setValue($this->request->get($name));
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

	// public function addFilter($model, $name, $scope='')
	// {
  //
	// }

	/**
	 * Get the input
	 * @return \App\Core\unknown
	 */
	public function getInput()
	{
		return 'text';
	}

	/**
	 * Query scope for filtering data by buyer fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function search($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		$select = ['ams_type_request.id',
              'ams_type_request.name',
              'ams_type_request.created_at',
              'srcusers.users.idsrc_login as user_id',
              'srcusers.users.loginname as loginname'];

		$join = $model->join('srcusers.users',function($join) use ($table) {
			$join->on($table.'.created_id','=','srcusers.users.idsrc_login');
		})->select($select);

		return  $join->whereNested(function($query) use ($values) {
			$query->where('srcusers.users.loginname','like','%'.$values.'%');
			$query->where('ams_type_request.id','like','%'.$values.'%', 'or');
			$query->where('ams_type_request.name','like','%'.$values.'%', 'or');
		});
	}

	/**
	 * Query scope for filtering data by fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchKeywordUser($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.loginid','like','%'.$values.'%', 'or');
			$query->where($table.'.loginname','like','%'.$values.'%', 'or');
			$query->where($table.'.emailadd','like','%'.$values.'%', 'or');
		});
	}

	/**
	 * Query scope for filtering data by fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchKeywordDepartment($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.department','like','%'.$values.'%', 'or');
			$query->where($table.'.deptdesc','like','%'.$values.'%', 'or');
		});
	}

  public function searchKeywordAccountCode($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.name','like','%'.$values.'%', 'or');
			$query->where($table.'.description','like','%'.$values.'%', 'or');
		});
	}

  public function searchKeywordFlexiGroup($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.name','like','%'.$values.'%', 'or');
			$query->where($table.'.description','like','%'.$values.'%', 'or');
		});
	}

  public function searchKeywordAuditLog($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.user_id','like','%'.$values.'%', 'or');
		});

	}

  public function searchKeywordOptionalCode($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.name','like','%'.$values.'%', 'or');
			$query->where($table.'.description','like','%'.$values.'%', 'or');
		});
	}

  public function searchKeywordGlobalSetting($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.name','like','%'.$values.'%', 'or');
			$query->where($table.'.description','like','%'.$values.'%', 'or');
		});
	}

	/**
	 * Query scope for filtering data by buyer fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchPending($model, $values='')
	{

	if(!$values)
	{
		$values = $this->getValue();
	}

	$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();


	$condition = $this->request->get('filterSelect');

		switch ($condition) {
				case 'case_number':
					return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.case_number','like', '%'.$values.'%');
					});

				case 'department':
					return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.department','like', '%'.$values.'%');
					});

				case 'title':
					return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.title','like', '%'.$values.'%');
					});

				case 'date':
					return  $model->whereNested(function($query) use ($values) {
							$ndate = date('Y-d-m', strtotime($values));
							$query->where('ams_applications.created_at','like', '%'.$ndate.'%');
					});

				default:
					return  $model->whereNested(function($query) use ($values) {
							$query->where('ams_applications.case_number','like', '%'.$values.'%');
							$query->orWhere('ams_applications.title','like', '%'.$values.'%');

					});
		}
	}

	/**
	 * Query scope for filtering data by buyer fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchHistory($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		return  $model->whereNested(function($query) use ($values) {
				$query->where('ams_applications.case_number','like', '%'.$values.'%');
				$query->orWhere('ams_applications.title','like', '%'.$values.'%');
		});
	}

	/**
	 * Query scope for filtering data by buyer fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchMyApplication($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		return  $model->whereNested(function($query) use ($values) {
			$query->where('ams_applications.case_number','like', '%'.$values.'%');
			$query->orWhere('ams_applications.title','like', '%'.$values.'%');
		});
	}

	public function searchCourse($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$table = ($model instanceof Model) ? $model->getTable() : $model->getModel()->getTable();

		return  $model->whereNested(function($query) use ($values, $table) {
			$query->where($table.'.id','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.name','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.description','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.code','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.duration','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.minimum_attendee','like','%'.$values.'%', 'or');
			$query->Orwhere($table.'.maximum_attendee','like','%'.$values.'%', 'or');
		});
	}

	/**
	 * Query scope for filtering data by buyer fullname
	 * @param unknown $model
	 * @param string $values
	 */
	public function searchReports($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		return  $model->whereNested(function($query) use ($values) {
			$query->where('ams_applications.case_number','like', '%'.$values.'%');
			$query->orWhere('ams_applications.title','like', '%'.$values.'%');
			$query->orWhere('ams_applications.total','like', '%'.$values.'%');
			$query->orWhere('ams_applications.department','like', '%'.$values.'%');
			$query->orWhere('ams_forms.name','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.title','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.provider','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.description','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.designation','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.fee','like', '%'. $values.'%');
			$query->orWhere('ams_form_tsw.funds','like', '%'. $values.'%');
			$query->orWhere('srcusers.users.loginname','like', '%'. $values.'%');
		});
	}

	public function fromtoSearch($model, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		$startdate = $values['from'];
		$endate = $values['to'];

		return  $model->whereNested(function($query) use ($startdate, $endate) {
			$query->whereBetween('ams_applications.created_at', array($startdate,$endate));
		});
	}
}
