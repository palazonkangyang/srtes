<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\TypeFactory;
use Illuminate\Http\Request;
use App\Factories\FilterFactory;
use App\Factories\PresenterFactory;

class SettingsPresenter extends PresenterCore
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $this->view->title = 'Settings';
    return $this->view('settings.index');
  }

  public function tes_index()
  {
    $this->view->title = 'Settings';
    return $this->view('tes.settings.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function urgency()
  {
    $this->view->urgency = $this->getUrgencyData();

    $this->view->title = 'Settings - Urgency';
    return $this->view('settings.urgency');
  }

  public function glcode_setting()
  {
    $this->view->title = 'Settings - Glcode Setting';

    return $this->view('settings.glcode_setting');
  }

  public function user_department_setting()
  {
    $this->view->title = 'Settings - User & Department Setting';

    return $this->view('settings.user_department_setting');
  }

  public function group_fixed_setting()
  {
    $this->view->title = 'Settings - Group & Fixed Setting';

    return $this->view('settings.group_fixed_setting');
  }

  public function forms_typerequest_setting()
  {
    $this->view->title = 'Settings - Forms & Type of request Setting';

    return $this->view('settings.forms_typerequest_setting');
  }

  public function outOfOfficeSettings()
  {
    $this->view->title = 'Settings - Out Of Office';

    return $this->view('settings.out_of_office_setting');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function typeRequest()
  {
    $select = [ 'ams_type_request.id',
                'ams_type_request.name',
                'ams_type_request.created_at'];

    $prepare = ModelFactory::getInstance('TypeRequest');

    $prepare = $prepare->with([
                'forms' => function($query){
                          $query->select('*');
                }
                ]);

    $prepare->orderBy('order_number','asc')->get();

    // add search filter
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','search');
    $this->view->searchFilter = $searchFilter;

    $this->view->typerequests = $this->paginate($prepare);

    $this->view->title = 'Type of Request List';
    return $this->view('settings.request');
  }

  public function typePerson()
  {
    $select = [ 'person_setting.id',
                'person_setting.post',
                'person_setting.created_at'];

    $prepare = ModelFactory::getInstance('TypePerson');

    $prepare = $prepare->with([
                 'postperson' => function($query){
        				       $query->select('idsrc_login','loginname');
                  }
                ]);

    $prepare->orderBy('post','asc')->get();

    // add search filter
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','search');
    $this->view->searchFilter = $searchFilter;

    $this->view->typepersons = $this->paginate($prepare);

    $this->view->title = 'Post Setting List';
    return $this->view('settings.person');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function editableRequest($id, $name, $data)
  {
    $typerequest = ModelFactory::getInstance('TypeRequest')->findOrNew($id);

    $typerequest->$name = $data;
    $typerequest->created_id = \Auth::User()->idsrc_login;

    if($typerequest->save()){
      echo "Successfully Edited!";
    }
  }


  public function editperson($id)
  {
    $prepare = ModelFactory::getInstance('TypePerson')
      		      ->with([
              		'postperson' => function($query){
              			$query->select('idsrc_login','loginname');
              		}
        		      ])
                  ->where('id', '=', $id)->get();

    $this->view->id = $id;
    $this->view->typeperson = $prepare;
    $this->view->title = 'Edit Type Person';

    return $this->view('settings.editperson');
  }

  /**
   * Urgency Data
   */
  public function getUrgencyData($excludeIds=[])
  {
    $urgency = ModelFactory::getInstance('Urgency')->select(['urgency_id','urgency_name','set_time']);

    if($excludeIds)
    {
      $urgency->whereNotIn('id',$excludeIds);
    }

    $urgency->orderBy('urgency_name','asc');

    return  $urgency->get();
  }

  /**
   * Set Request
   *
   * @return Reponse
   */
  public function setRequest($id)
  {
    $forms = PresenterFactory::getInstance('Application')->getForms();

    $selectForms = array('' => '-- Select Forms --');

    foreach ($forms as $form)
    {
    	$selectForms[$form->id] = $form->name;
    }

    $this->view->formlist = $selectForms;

    $typerequest = ModelFactory::getInstance('TypeRequest')->find($id);

    $getForms = ModelFactory::getInstance('RequestToForm')
        			 ->where('request_id', $id)
            			->with([
            				'Formlist' => function($query){
            					$query->select('id','name');
            				}
            			])
    			        ->get();

    	$this->view->typerequestdetails = $typerequest;
    	$this->view->forms = $getForms;

    	$this->view->title = 'Setting up Form Request';
    	return $this->view('settings.setrequest');
    }

    /**
     * Forms
     *
     * @return list of forms
     */
    public function forms()
    {
    	$select = [
    			'ams_forms.id as form_id',
    			'ams_forms.name as form_name',
          'ams_forms.approvallogic as approvallogic',
      		'srcusers.users.loginname as user_name',
    			'srcusers.users.emailadd as user_email'];

    	$prepare = ModelFactory::getInstance('Forms')
                   ->where('id','!=',1)
                   ->where('status','!=',0)
                   ->get();
    	$set = [];

      foreach ($prepare as $pre)
      {
    		$getform = ModelFactory::getInstance('ApproverForm')
    					->where('form_id',$pre->id)
    					->with([
    							'Approverlist' => function($query){
    								$query->select('idsrc_login','loginname','emailadd');
    							}
    						])
    					->get();

    		$getformcc = ModelFactory::getInstance('CCForm')
    					->where('form_id',$pre->id)
    					->with([
    							'CClist' => function($query){
    								$query->select('idsrc_login','loginname','emailadd');
    							}
    						])
    					->get();

    		$set[$pre->id] = [
            							'form_name'=>$pre->name,
                          'form_approvallogic'=>$pre->approvallogic,
            							'approvers'=> $getform,
                          'ccs'=> $getformcc
    		                  ];
    	}

    	$this->view->forms = $set;

    	$this->view->title = 'Type of forms';
    	return $this->view('settings.forms');
    }

    public function setApprovers($id)
    {
    	$select = ['id'];
    	$getforms = ModelFactory::getInstance('Forms')->find($id);
    	$getApprovers = ModelFactory::getInstance('ApproverForm')
            					->where('form_id', $id)
            					->with([
            							'Approverlist' => function($query){
            								$query->select('idsrc_login','loginname','emailadd');
            							},
                            'Grouplist' => function($query){
            								$query->select('name','id');
            							}
            					])
						->get();

    	$getCCs = ModelFactory::getInstance('CCForm')
      					->where('form_id', $id)
      					->with([
      							'CClist' => function($query){
      								$query->select('idsrc_login','loginname','emailadd');
      							}
      					])
						    ->get();

    	$this->view->approver = $getApprovers;
      $this->view->ccs = $getCCs;
    	$this->view->form = $getforms;

    	$this->view->title = 'Setting up Form Request';
    	return $this->view('settings.setformapprovers');
    }
}
