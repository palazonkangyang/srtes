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
	public function addFilter($model, $name, $scope='', $report_type = '')
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

		return $scope ? $this->$scope($model, $report_type) : $model->where($name,'=',$this->getValue());
	}

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

		return $join->whereNested(function($query) use ($values) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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
				return $model->whereNested(function($query) use ($values) {
					$query->where('ams_applications.case_number','like', '%'.$values.'%');
				});

			case 'department':
				return $model->whereNested(function($query) use ($values) {
					$query->where('ams_applications.department','like', '%'.$values.'%');
				});

			case 'title':
				return $model->whereNested(function($query) use ($values) {
					$query->where('ams_applications.title','like', '%'.$values.'%');
				});

			case 'date':
				return $model->whereNested(function($query) use ($values) {
					$ndate = date('Y-d-m', strtotime($values));
					$query->where('ams_applications.created_at','like', '%'.$ndate.'%');
				});

			default:
				return $model->whereNested(function($query) use ($values) {
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

		return $model->whereNested(function($query) use ($values) {
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

		return $model->whereNested(function($query) use ($values) {
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

		return $model->whereNested(function($query) use ($values, $table) {
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
	public function searchReports($model, $report_type, $values='')
	{
		if(!$values)
		{
			$values = $this->getValue();
		}

		if($report_type == 'myapp')
		{
			return $model->whereNested(function($query) use ($values) {
				$query->where('ams_applications.case_number','like', '%'.$values.'%');
				$query->orWhere('ams_applications.title','like', '%'.$values.'%');
			});
		}

		else if($report_type == 'ad-hoc')
		{
			return $model->whereNested(function($query) use ($values) {
				$query->where('ams_applications.case_number','like', '%'.$values.'%');
				$query->orWhere('ams_applications.title','like', '%'.$values.'%');
				$query->orWhere('ams_applications.request_details','like', '%'.$values.'%');
				$query->orWhere('ams_applications.type_request','like', '%'.$values.'%');
				$query->orWhere('ams_applications.department','like', '%'.$values.'%');
				$query->orWhere('ams_forms.name','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.title','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.provider','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.description','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.designation','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.fee','like', '%'. $values.'%');
				$query->orWhere('ams_form_tsw.funds','like', '%'. $values.'%');
				$query->orWhere('ams_form_pcmcf2.title','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf2.project','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.cheque_payable_to','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.project_name','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.advance_received','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.total','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.balance','like', '%'.$values.'%');
				$query->orWhere('ams_form_sorapfca.budget_code','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_sorapfca.item_company','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_sorapfca.item_desc','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_sorapfca.item_total','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_sorapfca.item_note','like', '%'.$values.'%');
				$query->orWhere('srcusers.users.loginname','like', '%'. $values.'%');
			});
		}

		else if($report_type == 'finance')
		{
			return $model->whereNested(function($query) use ($values) {
				$query->where('ams_applications.case_number','like', '%'.$values.'%');
				$query->orWhere('ams_applications.title','like', '%'.$values.'%');
				$query->orWhere('ams_applications.total','like', '%'.$values.'%');
				$query->orWhere('ams_applications.department','like', '%'.$values.'%');
				$query->orWhere('ams_forms.name','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf.title','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf.project','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf.payee_name','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf2.title','like', '%'.$values.'%');
				$query->orWhere('ams_form_pcmcf2.project','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf.item_desc','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf.account_code','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf.optional_code','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf.item_total','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf2.item_desc','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf2.account_code','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf2.optional_code','like', '%'.$values.'%');
				$query->orWhere('ams_lineitem_pcmcf2.item_total','like', '%'.$values.'%');
				$query->orWhere('srcusers.users.loginname','like', '%'. $values.'%');
			});
		}

		else if($report_type == 'hr')
		{
			return $model->whereNested(function($query) use ($values) {
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

		else if($report_type == 'admin')
		{
			return $model->whereNested(function($query) use ($values) {
				$query->where('ams_applications.case_number','like', '%'.$values.'%');
				$query->orWhere('ams_applications.title','like', '%'.$values.'%');
				$query->orWhere('ams_applications.total','like', '%'.$values.'%');
				$query->orWhere('ams_applications.type_request','like', '%'.$values.'%');
				$query->orWhere('ams_applications.department','like', '%'.$values.'%');
				$query->orWhere('ams_forms.name','like', '%'. $values.'%');
				$query->orWhere('ams_form_hphcrf.purpose_of_use','like', '%'. $values.'%');
				$query->orWhere('ams_form_hphcrf.number_of_pax','like', '%'. $values.'%');
			});
		}

		else
		{}
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
