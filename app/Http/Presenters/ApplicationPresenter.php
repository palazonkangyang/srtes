<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\FilterFactory;
use App\Filters\SelectFilter;
use Response;
use Validator;
use DB;
use Illuminate\Support\Facades\Auth;
class ApplicationPresenter extends PresenterCore
{

	/**
	 * Application Process
	 *
	 * @param Request $request
	 */
	public function ApplicationProcess(Request $request)
	{
		$this->view->title = 'New Application';

		if($request->get('type_of_request') && $request->get('forms'))
		{
			$groupidcnt = 0;
			$form = ModelFactory::getInstance('Forms')->where('id', $request->get('forms'))->get();
			$request = ModelFactory::getInstance('TypeRequest')->where('id', $request->get('type_of_request'))->get();
			$department = ModelFactory::getInstance('Department')->where('idsrc_departments', \Auth::user()->deptid)->get();
      $HRdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','9')->get();
      $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
      $HRdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','9')->get();
      $RCHDdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','5')->get();

			// dd($form->toArray());

      $DSG = ModelFactory::getInstance('TypePerson')->where('id','1')->get();
			$SecGen = ModelFactory::getInstance('TypePerson')->where('id','2')->get();

      $Acquittal_Verifier =  ModelFactory::getInstance('TypePerson')->where('id','6')->get();
			$urgency = $this->getUrgency();
			$this->view->request = $request;
			$this->view->form = $form;
			$this->view->urgency = $urgency;
			$this->view->department = $department;

			/**
			 * Get approvers in form with conditions
			 */
			if($form['0']->id == 1 || $form['0']->id == 15)
			{
        $this->view->approverlist = [];
        $this->view->cclist = [];
      }

			else
			{
				$set = [];

				foreach ($form as $pre)
				{
					$getform = ModelFactory::getInstance('ApproverForm')
										 ->where('form_id',$pre->id)
										 ->with([
											 'Approverlist' => function($query){
												 $query->select('idsrc_login','loginname','emailadd');
											 }
											])->get()->toArray();

					$set[$pre->id] = [
						'form_name'=>$pre->name,
						'approvers'=> $getform
					];
				}

			 	$getDSG = $DSG['0']->puser_id;
      	$getHrHead = $HRdepartment['0']->dept_head;
       	$getSecGen = $SecGen['0']->puser_id;
				$getRCHDHead = $RCHDdepartment['0']->dept_head;
        $getAcquittal_Verifier = $Acquittal_Verifier['0']->puser_id;
        $getFinHead = $FINdepartment['0']->dept_head;

				if($department['0']->dept_head != \Auth::user()->idsrc_login)
				{
          if($form['0']->id == 11 || $form['0']->id == 10)
					{
            $getHod = NULL;
          }
					else {
            $getHod = $department['0']->dept_head;
          }
				}

				if($department['0']->dept_ro != \Auth::user()->idsrc_login)
				{
          if($form['0']->id == 11 || $form['0']->id == 10)
					{
            $getRO = NULL;
          }

					else
					{
            $getRO = $department['0']->dept_ro;
          }
				}

        //Get hod and append
				$list = [];

				foreach($set as $appr)
				{
					foreach($appr['approvers'] as $key => $app )
					{
						if($form['0']->id == 12)
						{
              if($department['0']->dept_head != \Auth::user()->idsrc_login)
							{
                $list[0] = $getAcquittal_Verifier;
                $list[1] = $getHrHead;
                $list[2] = $getDSG;
              }

							else
							{
                return redirect('/application/new/process')->with('error_message', 'This form is not available for HOD');
              }
            }

						else if($form['0']->id == 13)
						{
              if($department['0']->dept_head != \Auth::user()->idsrc_login)
							{
                $list[0] = $getHod;
                $list[1] = $getFinHead;
                $list[2] = $getDSG;
              }
							else
							{
                return redirect('/application/new/process')->with('error_message', 'This form is not available for HOD');
              }
            }

						else if($form['0']->id == 14 )
						{
              $list[0] = $getDSG;
            }

						else if($form['0']->id == 20 )
						{
              if($department['0']->dept_head != \Auth::user()->idsrc_login)
							{
                $list[0] = $getHod;
              }

							else
							{
                $list[0] = $getRO;
              }
						}

            else if($form['0']->id == 19)
						{
							if($department['0']->dept_head != \Auth::user()->idsrc_login)
							{
								//for BDRP    &    SRCA
                if($department['0']->idsrc_departments == 1 || $department['0']->idsrc_departments == 6)
								{
                  $list[0] =$getHod;
                  //$list[1] = $getCPU1;
                  // $list[2] = $getCPU2;
                  // $list[3] = $getCPU3;
                  $list[4] = $getDSG;
                }

								else
								{
                  $list[0] =$getHod;
                  //$list[1] = $getCPU1;
                  // $list[2] = $getCPU2;
                  // $list[3] = $getCPU3;
                  $list[4] = $getRO;
                	$list[5] = $getDSG;
                }
              }

							else
							{
                return redirect('/application/new/process')->with('error_message', 'Requester can not be HOD');
              }
						}

						else
						{
							if(isset($getHod))
							{
								$list[0] = $getHod;

								if($app['user_id'] != $getHod)
								{
									$list[] = $app['user_id'];

									if($app['user_id'] == 0)
                  {
                    $listgroup[] = $app['group_id'];
                  }
								}
							}

							else
							{
								if($app['user_id'] != \Auth::user()->idsrc_login)
								{
									$list[] = $app['user_id'];

							    if($app['user_id'] == 0)
                  {
                    $listgroup[] = $app['group_id'];
                  }
								}
							}
						}
          }
				}

        if($list)
				{
          $userlist = implode(',', $list);
          $approverlist = ModelFactory::getInstance("User")
                          ->whereIn('idsrc_login', $list)
                          ->orderByRaw(DB::raw("FIELD(idsrc_login, $userlist)"))
                          ->get();

          foreach($list as $key => $listitem)
          {
            if($listitem != 0)
						{
              $approverlistindividual = ModelFactory::getInstance("User")
                                  			->where('idsrc_login','=',$listitem)
                                  			->first();

              $approverlist_mod[$key]['emailadd']=$approverlistindividual->emailadd;
              $approverlist_mod[$key]['loginname']=$approverlistindividual->loginname;
              $approverlist_mod[$key]['idsrc_login']=$approverlistindividual->idsrc_login;
            }

						else
						{
              $approverlistgroup = ModelFactory::getInstance("FlexiGroup")
                                  	->where('id','=',$listgroup[$groupidcnt])
                                  	->first();

							$approverlist_mod[$key]['emailadd']='url';
              $approverlist_mod[$key]['loginname']=$approverlistgroup->name;
              $approverlist_mod[$key]['idsrc_login']=$listgroup[$groupidcnt];
              $groupidcnt = $groupidcnt+1;
            }
          }

					if($form['0']->id == 12 || $form['0']->id ==13|| $form['0']->id ==14 || $form['0']->id ==15 || $form['0']->id == 19 || $form['0']->id == 20)
          {
            $this->view->approverlist = $approverlist;
          }

					else
          {
            $this->view->approverlist = $approverlist_mod;
          }

          /**start CC conditions
           *
          */

					$set2 = [];
					foreach ($form as $pre2)
					{
						$getform2 = ModelFactory::getInstance('CCForm')
												->where('form_id',$pre->id)
												->with([
													'CClist' => function($query){
														$query->select('idsrc_login','loginname','emailadd');
													}
												])
												->get()->toArray();

					$set2[$pre2->id] = [
						'form_name'=>$pre2->name,
						'ccs'=> $getform2
					];
				}

        //Get cc and append
				$list2 = [];

				foreach($set2 as $appr2)
				{
					foreach($appr2['ccs'] as $key => $app2 )
					{
						if($app2['user_id'] != \Auth::user()->idsrc_login)
						{
							$list2[] = $app2['user_id'];
						}
					}
        }

				if($list2)
				{
          $userlist2 = implode(',', $list2);
          $cclist = ModelFactory::getInstance("User")
                    ->whereIn('idsrc_login', $list2)
                    ->orderByRaw(DB::raw("FIELD(idsrc_login, $userlist2)"))
                    ->get();
        }

				else
				{
          $cclist = [];
        }

				$this->view->cclist = $cclist;

				/**
			 		* end here cc conditions
			 	*/
      }

			else
			{
        return redirect('/application/new/process')->with('error_message', 'There is no approver in the form. Please contact Redcross Singapore administrator.');
      }
		}

		/**
		 * End here approvers conditions
		 */

		/**
		 * Start NEW FORM REQUEST (HR Matters - Application For Training / Seminar / Workshop)
		*/

		if($form['0']->id == 16) {
			 $this->view->course_list_array = \App\Http\Models\Course::courseListArray();
			 $this->view->course_type_list_array = \App\Http\Models\CourseType::courseTypeListArray();

			 for($i = 0; $i < count($this->view->approverlist); $i++)
			 {
				 if($this->view->approverlist[$i]['idsrc_login'] != 237)
				 {
					 unset($this->view->approverlist[$i]);
				 }
			 }
		}

		/**
			* End NEW FORM REQUEST (HR Matters - Application For Training / Seminar / Workshop)
		*/

		return $this->view('application.form_submission');
	}

	$this->view->request = $this->getRequest();
	return $this->view('application.form_process');
}

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function newapplication()
  {
    $department_list = $this->getDepartment();
    $type_req_list = $this->getTypeRequest();
    $urgency = $this->getUrgency();

    $this->view->title = 'New Application';

    return $this->view('application.new', compact('department_list','type_req_list','urgency'));
  }

  public function getFormbyRequestID($id)
  {
    $prepare = ModelFactory::getInstance('TypeRequest')
    						->where('id', $id);

    $prepare = $prepare->with([
    	'forms' => function($query){
    		$query->select('*');
    	}
    ]);

    $typerequest = $prepare->orderBy('order_number','asc')->get();

    $this->newtypedata[] = ['id'=>'','name'=>'-- Select Type --'];

    foreach ($typerequest as $data)
		{
    	//$this->newtypedata[$data->id] = $data->name;
    	foreach ($data->forms as $key => $form)
			{
    		$this->newtypedata[] = ['id'=>$form->form_id,'name'=>$form->name];
    	}
    }

    return $this->newtypedata;
  }

  public function getRequest($excludeIds=[])
  {
    $typerequest = ModelFactory::getInstance('TypeRequest');

    if($excludeIds)
    {
    	$typerequest->whereNotIn('id',$excludeIds);
    }

    $typedata = $typerequest->orderBy('order_number', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Type --');

		foreach ($typedata as $data)
		{
    	$this->newtypedata[$data->id] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getDepartment($excludeIds=[])
  {
    $department = ModelFactory::getInstance('Department');

    if($excludeIds)
    {
    	$department->whereNotIn('id',$excludeIds);
    }

		$department->orderBy('department','asc');
    $depdata = $department->get();

    $this->newdepdata = array('' => '-- Select Department --');

		foreach ($depdata as $data)
		{
      $this->newdepdata[$data->department] = $data->deptdesc.' ('.$data->department.') ';
    }

    return $this->newdepdata;
  }

  public function getTypeRequest($excludeIds=[])
  {
    $typerequest = ModelFactory::getInstance('TypeRequest');

    if($excludeIds)
    {
      $typerequest->whereNotIn('id',$excludeIds);
    }

    $typedata = $typerequest->orderBy('order_number', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Type --');

		foreach ($typedata as $data)
		{
      $this->newtypedata[$data->name] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getAppForms($excludeIds=[])
  {
    $forms = ModelFactory::getInstance('Forms');

    if($excludeIds)
    {
      $forms->whereNotIn('id',$excludeIds);
    }

    $typedata = $forms->orderBy('id', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Form --');

		foreach ($typedata as $data)
		{
      $this->newtypedata[$data->id] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getAdminAppForms($excludeIds=[])
  {
    $forms = ModelFactory::getInstance('Forms');

    if($excludeIds)
    {
      $forms->whereNotIn('id',$excludeIds);
    }

		$requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
            					->where('request_id', 7)->get()->toArray();

		$typedata = $forms->whereIn('id',$requestToForm)->where('id','!=',1)->orderBy('id', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Form--');

		foreach ($typedata as $data)
		{
      $this->newtypedata[$data->id] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getHrAppForms($excludeIds=[])
  {
    $forms = ModelFactory::getInstance('Forms');

    if($excludeIds)
    {
      $forms->whereNotIn('id',$excludeIds);
    }

		$requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
            					->where('request_id', 4)->get()->toArray();

		$typedata = $forms->whereIn('id',$requestToForm)->where('id','!=',1)->orderBy('id', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Form --');

		foreach ($typedata as $data)
		{
      $this->newtypedata[$data->id] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getFinAppForms($excludeIds=[])
  {
    $forms = ModelFactory::getInstance('Forms');

    if($excludeIds)
    {
      $forms->whereNotIn('id',$excludeIds);
    }

		$requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
            					->where('request_id', 1)->get()->toArray();

		$typedata = $forms->whereIn('id',$requestToForm)->where('id','!=',1)->orderBy('id', 'ASC')->get();

    $this->newtypedata = array('' => '-- Select Form --');

		foreach ($typedata as $data)
		{
      $this->newtypedata[$data->id] = $data->name;
    }

    return $this->newtypedata;
  }

  public function getUrgency($excludeIds=[])
  {
    $urgency = ModelFactory::getInstance('Urgency')->select(['urgency_id','urgency_name','set_time']);

    if($excludeIds)
    {
      $urgency->whereNotIn('id',$excludeIds);
    }

    return  $urgency->orderBy('urgency_name','asc')->get();
  }


  public function getForms($excludeIds=[])
  {
    $forms = ModelFactory::getInstance('Forms')
            	->where('status',1)
              ->select(['id','name','keyword']);

    if($excludeIds)
    {
    	$forms->whereNotIn('id',$excludeIds);
    }

    return  $forms->orderBy('id','asc')->get();
  }

  public function jsonGetUser()
  {
    $user_id = \Auth::User()->idsrc_login;

    $select = ['idsrc_login','loginname','emailadd'];
    $filter = $this->request->get('query');

    if($this->request->get('with'))
		{
      $users = ModelFactory::getInstance('User')
                ->where('roleid', '!=', -1)
                ->where('isactive', '=', 1)
                ->where('loginname','like', '%'.$filter.'%')->get($select)->toArray();
    }

		else
		{
      $users = ModelFactory::getInstance('User')
              	->where('idsrc_login', '!=', $user_id)
                ->where('roleid', '!=', -1)
                ->where('isactive', '=', 1)
              	->where('loginname','like', '%'.$filter.'%')->get($select)->toArray();
    }

		$usersdata = $users;
    $autocomplete =[];

		if($usersdata)
		{
            foreach ($usersdata as $key => $value) {
                $autocomplete['suggestions'][] = ['value'=>$value['loginname'], 'data' => [ 'id'=> $value['idsrc_login'], 'name'=>$value['loginname'], 'email'=>$value['emailadd']]];
            }
  	}

		else
		{
      $autocomplete['suggestions'][] = ['value'=>'Sorry, no matching results', 'data' => [ 'id'=> '', 'name'=>'', 'email'=>'']];
    }

    return Response::json($autocomplete);
  }

  public function jsonGetFlexiGroup()
  {
    $select = ['id','name','full_name'];
    $filter = $this->request->get('query');
    $flexigroup = ModelFactory::getInstance('FlexiGroup')
        					->where('name','like', '%'.$filter.'%')->get($select)->toArray();

    $flexigroupdata = $flexigroup;
    $autocomplete =[];

		if($flexigroupdata)
		{
      foreach ($flexigroupdata as $key => $value)
			{
        $link =  url('/flexigroup/viewflexigroup/'.$value['id']) ;
        $alink = "<a target='_blank' href='$link'>click to view</a>";
        $autocomplete['suggestions'][] = ['value'=>$value['name'].'', 'data' => ['description'=> $value['full_name'], 'id'=> 'group_'.$value['id'], 'name'=>$value['name'],'email'=>$alink]];
      }
    }

		else
		{
      $autocomplete['suggestions'][] = ['value'=>'Sorry, no matching results', 'data' => ['description'=>'', 'id'=> '', 'name'=>'']];
    }

    return Response::json($autocomplete);
  }

  public function jsonGetAccountCode()
  {
    $select = ['id','name','is3alpha','description','example','costcentre_detail'];
    $filter = $this->request->get('query');
    $accountcode = ModelFactory::getInstance('AccountCode')
        						->where('name','like', '%'.$filter.'%')->get($select)->toArray();

    $accountcodedata = $accountcode;
    $autocomplete =[];

		if($accountcodedata)
		{
      foreach ($accountcodedata as $key => $value)
			{
        $autocomplete['suggestions'][] = ['value'=>$value['name'].'', 'data' => ['description'=> $value['description'].': '.$value['example'],'is3alpha'=> $value['is3alpha'], 'id'=> $value['id'], 'name'=>$value['name']]];
      }
    }

		else
		{
      $autocomplete['suggestions'][] = ['value'=>'Sorry, no matching results', 'data' => ['description'=>'', 'id'=> '', 'name'=>'']];
    }

    return Response::json($autocomplete);
  }

  public function jsonGetOptionalCode()
  {
    $select = ['id','name','description'];
    $filter = $this->request->get('query');
    $optionalcode = ModelFactory::getInstance('OptionalCode')
        						->where('name','like', '%'.$filter.'%')->get($select)->toArray();

		$optionalcodedata = $optionalcode;
    $autocomplete =[];

		if($optionalcodedata)
		{
      foreach ($optionalcodedata as $key => $value)
			{
        $autocomplete['suggestions'][] = ['value'=>$value['name'].'', 'data' => ['description'=> $value['description'],'id'=> $value['id'], 'name'=>$value['name']]];
      }
    }

		else
		{
      $autocomplete['suggestions'][] = ['value'=>'Sorry, no matching results', 'data' => [ 'id'=> '', 'name'=>'']];
    }

    return Response::json($autocomplete);
  }

    /**
     * Show pending a new resource.
     *
     * @return Response
     */
    public function pending()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

			$updateapprovetopendingquestionnaire = ModelFactory::getInstance('Application')
																							->where('type_form',16)
																							->where('status',1)
																							->where('created_id',$user_id)
																							->update(['status' => 6]);

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_forms.name as form_name'
      ];

      // 0 for group
      $firstprepare = ModelFactory::getInstance('Approver')
					         		->leftjoin('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
					            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
					            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
					            ->leftjoin('ams_flexigroup', 'ams_flexigroup.id', '=', 'ams_approver_person.group_id')
					            ->leftjoin('ams_flexigroup_person', 'ams_flexigroup_person.group_id', '=', 'ams_flexigroup.id')
					            ->where('ams_approver_person.user_id', '=', 0)
					            ->where('ams_approver_person.read', '=', 0)
					            ->where('ams_approver_person.forward', '=', 1)
					            ->where('ams_approver_person.group_id', '>', 0)
					            ->whereNotIn('ams_applications.status', [ 2, 3 ])
					            ->where('ams_applications.drafts', '=', 0)
					            ->where('ams_flexigroup_person.user_id', '=', $user_id)
					            ->orWhere('ams_applications.created_id', '=', $user_id)
					            ->distinct()
					            ->whereNotIn( 'ams_applications.status', [0, 1, 2, 3, 4, 7])
					            ->select($select);

      $secondprepare = ModelFactory::getInstance('Approver')
						            ->leftjoin('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
						            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
						            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
						            ->leftjoin('ams_flexigroup', 'ams_flexigroup.id', '=', 'ams_approver_person.group_id')
						            ->leftjoin('ams_flexigroup_person', 'ams_flexigroup_person.group_id', '=', 'ams_flexigroup.id')
						            ->where('ams_approver_person.user_id', '=', $user_id)
						            ->where('ams_approver_person.read', '=', 0)
						            ->where('ams_approver_person.forward', '=', 1)
						           	->whereNotIn('ams_applications.status', [ 2, 3 ])
						            ->where('ams_applications.drafts', '=', 0)
						           	->orWhere('ams_applications.created_id', '=', $user_id)
						            ->distinct()
						            ->whereNotIn('ams_applications.status', [0, 1, 2, 3, 4, 6, 7])
						            ->select($select);

 			$prepare = $firstprepare->unionAll($secondprepare)->get();

      //add search filter
      $this->view->pendinglist = $prepare;

      $this->view->title = 'Pending List';

      return $this->view('application.pending');
    }

		public function pendingStatus(Request $request)
		{
			$type_form = $_GET['type_form'];

			$status = ModelFactory::getInstance('Application')
								->where('type_form', $type_form)
								->where('status', 6)
								->where('created_id', Auth::user()->idsrc_login)
								->get();

			if(count($status) > 0)
			{
				$no_of_pending = count($status);
			}

			else
			{
				$no_of_pending = 0;
			}

			return response()->json(array(
				'no_of_pending' => $no_of_pending
			));
		}

    /**
     * Show pending a new resource.
     *
     * @return Response
     */
    public function myapp()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_forms.name as form_name'
      ];

      $prepare = ModelFactory::getInstance('Application')
            			->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
			            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
			            ->where('ams_applications.drafts', '=', 0)
			            ->where('ams_applications.created_id', '=', $user_id)
			            ->orderBy('ams_applications.created_at','DESC')
			            ->select($select);

      $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
      $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
      $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
      $this->view->urgencyFilter = $urgencyFilter;

      $this->view->department = $this->getDepartment();
      $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
      $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
      $departmentFilter->setOptions($this->view->department);
      $this->view->departmentFilter = $departmentFilter;

      $this->view->tof = $this->getTypeRequest();
      $tofFilter = FilterFactory::getInstance('Select','Typeofrequest',SelectFilter::SINGLE_SELECT);
      $prepare = $tofFilter->addFilter($prepare,'typeofrequest','byTof');
      $tofFilter->setOptions($this->view->tof);
      $this->view->tofFilter = $tofFilter;

      $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
      $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
      $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
      $this->view->statusFilter = $statusFilter;

      $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
      $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
      $this->view->fromtoFilter = $fromtoFilter;

      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchReports', 'myapp');
      $this->view->searchFilter = $searchFilter;

      //add search filter
      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchMyApplication');
      $this->view->searchFilter = $searchFilter;

      $this->view->myapplist = $this->paginate($prepare);

      $this->view->title = 'My Application';
      return $this->view('application.myapp');
    }

    public function reports()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_forms.name as form_name'
      ];

      $prepare = ModelFactory::getInstance('Application')
			            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
			            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
									->leftjoin('ams_form_tsw', 'ams_form_tsw.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_form_pcmcf2', 'ams_form_pcmcf2.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_lineitem_sorapfca', 'ams_lineitem_sorapfca.app_id', '=', 'ams_applications.id')
			            ->orderBy('ams_applications.created_at','DESC')
			            ->where('ams_applications.drafts', '=', 0)
									->GroupBy('ams_applications.id')
			            ->select($select);

      $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
      $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
      $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
      $this->view->urgencyFilter = $urgencyFilter;

      $this->view->department = $this->getDepartment();
      $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
      $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
      $departmentFilter->setOptions($this->view->department);
      $this->view->departmentFilter = $departmentFilter;

      $this->view->forms = $this->getAppForms();
      $formsFilter = FilterFactory::getInstance('Select','Forms',SelectFilter::SINGLE_SELECT);
      $prepare = $formsFilter->addFilter($prepare,'forms','byForms');
      $formsFilter->setOptions($this->view->forms);
      $this->view->formsFilter = $formsFilter;

      $this->view->tof = $this->getTypeRequest();
      $tofFilter = FilterFactory::getInstance('Select','Typeofrequest',SelectFilter::SINGLE_SELECT);
      $prepare = $tofFilter->addFilter($prepare,'typeofrequest','byTof');
      $tofFilter->setOptions($this->view->tof);
      $this->view->tofFilter = $tofFilter;

      $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
      $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
      $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
      $this->view->statusFilter = $statusFilter;

      $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
      $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
      $this->view->fromtoFilter = $fromtoFilter;

      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchReports', 'ad-hoc');
      $this->view->searchFilter = $searchFilter;

      $this->view->reports = $this->paginate($prepare);
      $reports = $this->paginate($prepare);

      $this->view->title = 'Reports';
      return $this->view('application.reports');
    }

    public function reportmenu()
    {
      $this->view->title = 'Report Menu';
      return $this->view('application.reportmenu');
    }

    public function reportsFin()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_applications.pp_status',
        'ams_applications.total',
        'ams_forms.name as form_name'
      ];

      $forms = ModelFactory::getInstance('Forms');
      $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
						            ->where('form_id', '!=', 1)
						            ->where('request_id', 1)->get()->toArray();

      $prepare = ModelFactory::getInstance('Application')
			            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
			            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
									->leftjoin('ams_form_pcmcf', 'ams_form_pcmcf.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_form_pcmcf2', 'ams_form_pcmcf2.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_lineitem_pcmcf', 'ams_lineitem_pcmcf.app_id', '=', 'ams_applications.id')
									->leftjoin('ams_lineitem_pcmcf2', 'ams_lineitem_pcmcf2.app_id', '=', 'ams_applications.id')
			            ->orderBy('ams_applications.created_at','DESC')
			            ->where('ams_applications.drafts', '=', 0)
			            ->whereIn('ams_applications.type_form', $requestToForm)
									->GroupBy('ams_applications.id')
			            ->select($select);

      $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
      $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
      $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
      $this->view->urgencyFilter = $urgencyFilter;

      $this->view->department = $this->getDepartment();
      $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
      $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
      $departmentFilter->setOptions($this->view->department);
      $this->view->departmentFilter = $departmentFilter;

      $this->view->forms = $this->getFinAppForms();
      $formsFilter = FilterFactory::getInstance('Select','Forms',SelectFilter::SINGLE_SELECT);
      $prepare = $formsFilter->addFilter($prepare,'forms','byForms');
      $formsFilter->setOptions($this->view->forms);
      $this->view->formsFilter = $formsFilter;

      $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
      $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
      $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
      $this->view->statusFilter = $statusFilter;

      $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
      $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
      $this->view->fromtoFilter = $fromtoFilter;

      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchReports', 'finance');
      $this->view->searchFilter = $searchFilter;

      $this->view->reports = $this->paginate($prepare);
      $reports = $this->paginate($prepare);

      $this->view->title = 'Reports';
      return $this->view('application.reportsFin');
    }

    public function reportsHR()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_applications.total',
        'ams_forms.name as form_name'
      ];

      $forms = ModelFactory::getInstance('Forms');
      $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
		                    ->where('form_id', '!=', 1)
		            				->where('request_id', 4)->get()->toArray();

      $prepare = ModelFactory::getInstance('Application')
			            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
			            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
									->leftjoin('ams_form_tsw', 'ams_form_tsw.app_id', '=', 'ams_applications.id')
			            ->orderBy('ams_applications.created_at','DESC')
			            ->where('ams_applications.drafts', '=', 0)
			          	->whereIn('ams_applications.type_form', $requestToForm)
			            ->select($select);

      $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
      $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
      $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
      $this->view->urgencyFilter = $urgencyFilter;

      $this->view->department = $this->getDepartment();
      $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
      $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
      $departmentFilter->setOptions($this->view->department);
      $this->view->departmentFilter = $departmentFilter;

      $this->view->forms = $this->getHrAppForms();
      $formsFilter = FilterFactory::getInstance('Select','Forms',SelectFilter::SINGLE_SELECT);
      $prepare = $formsFilter->addFilter($prepare,'forms','byForms');
      $formsFilter->setOptions($this->view->forms);
      $this->view->formsFilter = $formsFilter;

      $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
      $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
      $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
      $this->view->statusFilter = $statusFilter;

      $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
      $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
      $this->view->fromtoFilter = $fromtoFilter;

      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchReports', 'hr');
      $this->view->searchFilter = $searchFilter;

      $this->view->reports = $this->paginate($prepare);
      $reports = $this->paginate($prepare);

      $this->view->title = 'Reports';
      return $this->view('application.reportsHR');
    }

    public function reportsAdmin()
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at',
        'ams_applications.status',
        'ams_applications.total',
        'ams_forms.name as form_name'
      ];

      $forms = ModelFactory::getInstance('Forms');
      $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                    		->where('form_id', '!=', 1)
            						->where('request_id', 7)->get()->toArray();

      $prepare = ModelFactory::getInstance('Application')
				         ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
				         ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
								 ->leftjoin('ams_form_hphcrf', 'ams_form_hphcrf.app_id', '=', 'ams_applications.id')
				         ->orderBy('ams_applications.created_at','DESC')
				         ->where('ams_applications.drafts', '=', 0)
				         ->whereIn('ams_applications.type_form', $requestToForm)
				         ->select($select);

      $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
      $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
      $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
      $this->view->urgencyFilter = $urgencyFilter;

      $this->view->department = $this->getDepartment();
      $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
      $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
      $departmentFilter->setOptions($this->view->department);
      $this->view->departmentFilter = $departmentFilter;

      $this->view->forms = $this->getAdminAppForms();
      $formsFilter = FilterFactory::getInstance('Select','Forms',SelectFilter::SINGLE_SELECT);
      $prepare = $formsFilter->addFilter($prepare,'forms','byForms');
      $formsFilter->setOptions($this->view->forms);
      $this->view->formsFilter = $formsFilter;

      $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
      $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
      $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
      $this->view->statusFilter = $statusFilter;

      $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
      $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
      $this->view->fromtoFilter = $fromtoFilter;

      $searchFilter = FilterFactory::getInstance('Text','Search');
      $prepare = $searchFilter->addFilter($prepare,'search','searchReports', 'admin');
      $this->view->searchFilter = $searchFilter;

      $this->view->reports = $this->paginate($prepare);
      $reports = $this->paginate($prepare);

      $this->view->title = 'Reports';
      return $this->view('application.reportsAdmin');
    }

    public function viewDetails($id)
    {
        $select = [
            'srcusers.users.idsrc_login as creator_id',
            'srcusers.users.loginname as creator_name',
            'srcusers.users.emailadd as creator_email',
            'ams_applications.id',
            'ams_applications.status',
            'ams_applications.close_remarks',
            'ams_applications.department',
            'ams_applications.type_request',
            'ams_applications.type_form',
            'ams_applications.title',
            'ams_applications.urgency',
            'ams_applications.case_number',
            'ams_applications.request_details',
            'ams_applications.created_at',
            'ams_applications.updated_at',
            'ams_applications.status',
            'ams_applications.pp_status',
            'ams_applications.user_status as user_status'
        ];

        $select_idonly = [
            'ams_approver_person.id as id'
        ];

        $select_doc = [
            'ams_documents.id as document_id',
            'ams_documents.name as document_name',
            'ams_documents.link as document_link',
            'ams_documents.app_id as app_id',
        ];

         $select_files = [
            'ams_files.id as files_id',
            'ams_files.filename as files_filename',
            'ams_files.mimes as files_mimes',
            'ams_files.file_url as files_fileurl',
            'ams_files.app_id as app_id',
        ];

        //select for list of cc and approver
        $select_approver = [
            'srcusers.users.idsrc_login as approver_user_id',
            'srcusers.users.loginname as approver_name',
            'srcusers.users.emailadd as approver_email',
            'ams_approver_person.id as approver_id',
            'ams_approver_person.group_id as group_id',
            'ams_approver_person.remarks as approver_remarks',
            'ams_approver_person.status as approver_status',
            'ams_approver_person.case_status as approver_case_status',
            'ams_approver_person.updated_at as approver_date',
            'ams_flexigroup.name as group_name'
        ];

        $select_cc = [
            'srcusers.users.idsrc_login as ccperson_user_id',
            'srcusers.users.loginname as ccperson_name',
            'srcusers.users.emailadd as ccperson_email',
            'ams_cc_person.id as ccperson_id',
            'ams_cc_person.remarks as ccperson_remarks',
            'ams_cc_person.status as ccperson_status',
            'ams_cc_person.case_status as ccperson_case_status',
            'ams_cc_person.updated_at as ccperson_date'
        ];

        //select for history
        $select_recommend_history = [
            'srcusers.users.idsrc_login as user_id',
            'srcusers.users.loginname as name',
            'srcusers.users.emailadd as email',
            'ams_recommend.id as id',
            'ams_recommend.remarks as remarks',
            'ams_recommend.user_status as status',
            'ams_recommend.case_status as case_status',
            'ams_recommend.recommend_user_id as recommend_user_id',
            'ams_recommend.updated_at as date'
        ];

        $select_approver_history = [
            'srcusers.users.idsrc_login as user_id',
            'srcusers.users.loginname as name',
            'srcusers.users.emailadd as email',
            'ams_approver_person.id as id',
             'ams_approver_person.group_id as group_id',
            'ams_approver_person.position as position',
            'ams_approver_person.remarks as remarks',
            'ams_approver_person.status as status',
            'ams_approver_person.case_status as case_status',
            'ams_approver_person.updated_at as date'
        ];

        $select_cc_history = [
            'srcusers.users.idsrc_login as id',
            'srcusers.users.loginname as name',
            'srcusers.users.emailadd as email',
            'ams_cc_person.id as id',
            'ams_cc_person.remarks as remarks',
            'ams_cc_person.status as status',
            'ams_cc_person.case_status as case_status',
            'ams_cc_person.updated_at as date'
        ];

        //select for only approver and cc
        $select_only_approver = [
            'ams_approver_person.id as approver_id',
            'ams_approver_person.remarks as approver_remarks',
            'ams_approver_person.status as approver_status',
            'ams_approver_person.position as approver_position',
            'ams_approver_person.case_status as approver_case_status',
            'ams_approver_person.read as approver_read',
            'ams_approver_person.updated_at as approver_date'
        ];

        $select_only_cc = [
            'ams_cc_person.id as ccperson_id',
            'ams_cc_person.remarks as ccperson_remarks',
            'ams_cc_person.status as ccperson_status',
            'ams_cc_person.case_status as ccperson_case_status',
            'ams_cc_person.updated_at as ccperson_date'
        ];

        $user_id = \Auth::User()->idsrc_login;
        $role = \Auth::User()->roleid;

        $checkapp = ModelFactory::getInstance('Application')
                    ->where('ams_applications.id', '=', $id)
                    ->where('ams_applications.created_id', '=', $user_id)
                    ->first();

        if( !is_null($checkapp) ){

        //Creator
        $this->view->action_url =  'closeapp';
        $this->view->mark = 'creator';
        $this->view->title_page = 'Case Closing';

        $app = ModelFactory::getInstance('Application')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->where('ams_applications.created_id', '=', $user_id)
            ->where('ams_applications.id', '=', $id)
            ->get($select);

        } else {

            $checkapprover = ModelFactory::getInstance('Approver')
					                    ->where('ams_approver_person.app_id', '=', $id)
					                    ->where('ams_approver_person.user_id', '=', $user_id)
					                    ->first();

             $checkgroupapprover = ModelFactory::getInstance('Approver')
											             	->leftjoin('ams_flexigroup', 'ams_flexigroup.id', '=', 'ams_approver_person.group_id')
											            	->leftjoin('ams_flexigroup_person', 'ams_flexigroup_person.group_id', '=', 'ams_flexigroup.id')
											             	->where('ams_approver_person.group_id', '>', 0)
											            	->where('ams_flexigroup_person.user_id', '=', $user_id)
											            	->where('ams_approver_person.app_id', '=', $id)
											            	->first($select_idonly);

              $checkfinalapprover = ModelFactory::getInstance('Approver')
							                    	->where('ams_approver_person.app_id', '=', $id)
							                     	->orderby('position','DESC')
							                    	->first();


            if( !is_null($checkapprover) || !is_null($checkgroupapprover) ){

            //check approver
                 if( !is_null($checkapprover))
                 {
                 $this->view->currentapprover= $checkapprover->id;
                 }elseif (!is_null($checkgroupapprover))
                 {
                 $this->view->currentapprover= $checkgroupapprover->id;

                 }
                $this->view->finalapprover= $checkfinalapprover->id;
            $this->view->action_url =  'approveapp';
            $this->view->mark = 'approver';
            $this->view->title_page = 'Application Processing';

            $app = ModelFactory::getInstance('Application')
		                ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
		                ->where('ams_applications.id', '=', $id)
		                ->get($select);

            $get_approver = ModelFactory::getInstance('Approver')
				                		->where('ams_approver_person.app_id', '=', $id)
				                    ->where('ams_approver_person.user_id', '=', $user_id)
				                		->first($select_only_approver);

              $get_groupapprover = ModelFactory::getInstance('Approver')
											             	->leftjoin('ams_flexigroup', 'ams_flexigroup.id', '=', 'ams_approver_person.group_id')
											            	->leftjoin('ams_flexigroup_person', 'ams_flexigroup_person.group_id', '=', 'ams_flexigroup.id')
											             	->where('ams_approver_person.group_id', '>', 0)
											            	->where('ams_flexigroup_person.user_id', '=', $user_id)
											            	->where('ams_approver_person.app_id', '=', $id)
											            	->first($select_only_approver);

                    if( !is_null($get_approver))
                 {

                 $this->view->one_approver=  $get_approver;
                 }elseif (!is_null($get_groupapprover))
                 {
                $this->view->one_approver= $get_groupapprover;

                 }




            } else {
                //check ccperson
                 $checkccperson = ModelFactory::getInstance('Ccperson')
                    ->where('ams_cc_person.app_id', '=', $id)
                    ->where('ams_cc_person.user_id', '=', $user_id)
                    ->first();

                    if( !is_null($checkccperson) ){
                    //Ccperson

                    $this->view->action_url =  'commentapp';
                    $this->view->mark = 'ccperson';
                    $this->view->title_page = 'Cc Person Make Comment';

                    $app = ModelFactory::getInstance('Application')
                        ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                        ->where('ams_applications.id', '=', $id)
                        ->get($select);

                    $get_ccperson = ModelFactory::getInstance('Ccperson')
                        ->where('ams_cc_person.app_id', '=', $id)
                        ->where('ams_cc_person.user_id', '=', $user_id)
                        ->get($select_only_cc);

                    $this->view->one_ccperson =  $get_ccperson;
                    }

                    else {

                        //check recommend
                        $checkrecommend = ModelFactory::getInstance('Recommend')
                        ->where('ams_recommend.app_id', '=', $id)
                        ->where('ams_recommend.user_id', '=', $user_id)
                        ->first();

                        if(!is_null($checkrecommend)){
                            $this->view->action_url =  '';
                            $this->view->mark = '';
                            $this->view->title_page = 'View Details';

                             $app = ModelFactory::getInstance('Application')
                            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                            ->where('ams_applications.id', '=', $id)
                            ->get($select);

                        }
                        else {
                            return redirect('/dashboard');
                        }
                    }
            }

        }
        /**
         * forms conditions
         * @var [type]
         */
            $application_form_name = ModelFactory::getInstance('Forms')
                    ->where('id',$app[0]->type_form)
                    ->first(['name']);
            $application_form_message = ModelFactory::getInstance('Forms')
                    ->where('id',$app[0]->type_form)
                    ->first(['message']);

            if($app[0]->type_form == 2)
            {
                $form = ModelFactory::getInstance('FormRcp')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 3)
            {
                $form = ModelFactory::getInstance('FormRca')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 4)
            {
                $form = ModelFactory::getInstance('FormArea')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 5)
            {
                $form = ModelFactory::getInstance('FormArge')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 6)
            {
                $form = ModelFactory::getInstance('FormCdsaa')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
             else if($app[0]->type_form == 7)
            {
                $form = ModelFactory::getInstance('FormRdra')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
             else if($app[0]->type_form == 8)
            {
                $form = ModelFactory::getInstance('FormAtac')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
             else if($app[0]->type_form == 9)
            {
                $form = ModelFactory::getInstance('FormHphcrf')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
             else if($app[0]->type_form == 10)
            {
                $form = ModelFactory::getInstance('FormMjr')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 11)
            {
                $form = ModelFactory::getInstance('FormPgvbf')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 12)
            {
                $form = ModelFactory::getInstance('FormSorapfca')
                        ->where('app_id',$app[0]->id)
                        ->first();

                 $formlineitem = ModelFactory::getInstance('LineItemSorapfca')
                        ->where('app_id',$app[0]->id)
                        ->get();

                 $this->view->formlineitem =  $formlineitem;
            }
            else if($app[0]->type_form == 13)
            {
                $form = ModelFactory::getInstance('FormAca')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 14)
            {
                $form = ModelFactory::getInstance('FormPcmcf')
                        ->where('app_id',$app[0]->id)
                        ->first();

                 $formlineitem = ModelFactory::getInstance('LineItemPcmcf')
                        ->where('app_id',$app[0]->id)
                        ->get();

                 $this->view->formlineitem =  $formlineitem;

            }
             else if($app[0]->type_form == 20)
            {
                $form = ModelFactory::getInstance('FormPcmcf2')
                        ->where('app_id',$app[0]->id)
                        ->first();

                 $formlineitem = ModelFactory::getInstance('LineItemPcmcf2')
                        ->where('app_id',$app[0]->id)
                        ->get();

                 $this->view->formlineitem =  $formlineitem;

            }
            else if($app[0]->type_form == 15)
            {
                $form = ModelFactory::getInstance('FormMrf')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
               else if($app[0]->type_form == 16)
            {
                $form = ModelFactory::getInstance('FormTsw')
                        ->where('app_id',$app[0]->id)
                        ->first();

                  $formlineitem = ModelFactory::getInstance('LineItemTsw')
                        ->where('app_id',$app[0]->id)
                        ->get();

                 $this->view->formlineitem =  $formlineitem;
            }
              else if($app[0]->type_form == 17)
            {
                $form = ModelFactory::getInstance('FormIrfi')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 18)
            {
                $form = ModelFactory::getInstance('FormCoprpo')
                        ->where('app_id',$app[0]->id)
                        ->first();
            }
            else if($app[0]->type_form == 19)
            {
                $form = ModelFactory::getInstance('FormEoq')
                        ->where('app_id',$app[0]->id)
                        ->first();

                 $formlineitem = ModelFactory::getInstance('LineItemEoq')
                        ->where('app_id',$app[0]->id)
                        ->get();

                 $this->view->formlineitem =  $formlineitem;
            }
            else
            {
                $form = (object) [];
            }
        /**
         * end form conditions
         * @var [type]
         */
        $doc = ModelFactory::getInstance('Documents')
            ->join('ams_applications', 'ams_documents.app_id', '=', 'ams_applications.id')
            ->where('ams_documents.app_id', '=', $id)
            ->select($select_doc)->get();

        $files = ModelFactory::getInstance('File')
            ->join('ams_applications', 'ams_files.app_id', '=', 'ams_applications.id')
            ->where('ams_files.app_id', '=', $id)
            ->select($select_files)->get();


        $approver = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
                ->leftjoin('ams_flexigroup', 'ams_flexigroup.id', '=', 'ams_approver_person.group_id')

            ->where('ams_approver_person.app_id', '=', $id)
            ->orderBy('ams_approver_person.position', 'asc')
            ->select($select_approver)->get();



        $ccpersonData = ModelFactory::getInstance('Ccperson')
            ->join('ams_applications', 'ams_cc_person.app_id', '=', 'ams_applications.id')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_cc_person.user_id')
            ->where('ams_cc_person.app_id', '=', $id)
            ->select($select_cc)->get()->toArray();

        $result = array();
        foreach ($ccpersonData as $val) {
            if (!isset($result[$val['ccperson_user_id']]))
                $result[$val['ccperson_user_id']] = $val;
        }
        $ccperson = array_values($result);

        //special request from Jerry when 20042017 to show special word comment on non approver
         $approverhistorycommenter = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
            ->where('ams_approver_person.app_id', '=', $id)
            ->where('ams_approver_person.read', '=', 1)
            ->where('ams_approver_person.id','!=', DB::raw("(select max(`id`) from ams_approver_person where app_id=".$id.")"))

            ->select($select_approver_history)->get()->toArray();

         if($approverhistorycommenter){
             foreach($approverhistorycommenter as $column => $commenter)
             {
        $approverhistorycommenter[$column]['status'] = 5;
         $approverhistorycommenter[$column]['case_status'] = 5;
         }
         }

        $approverhistoryapprover = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
            ->where('ams_approver_person.app_id', '=', $id)
            ->where('ams_approver_person.read', '=', 1)
            ->where('ams_approver_person.id','=', DB::raw("(select max(`id`) from ams_approver_person where app_id=".$id.")"))
            ->orderby('position','desc')
            ->select($select_approver_history)->get()->toArray();

           $approverhistory = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
            ->where('ams_approver_person.app_id', '=', $id)
            ->where('ams_approver_person.read', '=', 1)
              ->select($select_approver_history)->get()->toArray();


        $ccpersonhistory = ModelFactory::getInstance('Ccperson')
            ->join('ams_applications', 'ams_cc_person.app_id', '=', 'ams_applications.id')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_cc_person.user_id')
            ->where('ams_cc_person.app_id', '=', $id)
            ->where('ams_cc_person.status', '=', 5)
            ->select($select_cc_history)->get()->toArray();
        $recommendhistory = ModelFactory::getInstance('Recommend')
            ->join('ams_applications', 'ams_recommend.app_id', '=', 'ams_applications.id')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_recommend.user_id')
            ->where('ams_recommend.app_id', '=', $id)
            ->where('ams_recommend.user_status', '=', 4)
            ->select($select_recommend_history)->get()->toArray();

           if($app[0]['status']== 1 && !$approverhistoryapprover){

             $app[0]['status'] = 5;


        }

        $this->view->myapplist =  $app;


        $this->view->forminfo =  $form;
        $this->view->afm =  $application_form_name;
        $this->view->afmesage =  $application_form_message;

        $this->view->doclist =  $doc;
        $this->view->filelist =  $files;
        $this->view->approverlist =  $approver;
        $this->view->ccpersonlist =  $ccperson;
        $merge_history = array();
         $merge_history = array_merge($merge_history, $approverhistoryapprover);
        $merge_history = array_merge($merge_history, $approverhistorycommenter);
        $merge_history = array_merge($merge_history, $ccpersonhistory);

        $recdump = array();
        foreach ($recommendhistory as $key => $value) {
            $recdump[$key]['user_id'] = $value['user_id'];
            $recdump[$key]['name'] = $value['name'];
            $recdump[$key]['email'] = $value['email'];
            $recdump[$key]['id'] = $value['id'];
            $recdump[$key]['remarks'] = $value['remarks'];
            $recdump[$key]['status'] = $value['status'];
            $recdump[$key]['case_status'] = $value['case_status'];
            $recdump[$key]['recommend_user_id'] = $this->selectUserBy($value['recommend_user_id'],array('loginname as name'))->toArray();
            $recdump[$key]['date'] = $value['date'];
        }
        $merge_history = array_merge($merge_history, $recdump);

        //sort merge by date
        usort($merge_history, function ($a, $b) {
            if ($a['date'] == $b['date']) {
                return 0;
            }
                return ($a['date'] < $b['date']) ? -1 : 1;
        });
        $this->view->historylist = $merge_history;

        $this->view->title = 'View Details';
        return $this->view('application.view');
    }

    public function viewReports($id)
    {
      $select = [
        'srcusers.users.idsrc_login as creator_id',
        'srcusers.users.loginname as creator_name',
        'srcusers.users.emailadd as creator_email',
        'ams_applications.id',
        'ams_applications.status',
        'ams_applications.close_remarks',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.type_form',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.request_details',
        'ams_applications.created_at',
        'ams_applications.updated_at',
        'ams_applications.status',
        'ams_applications.pp_status',
        'ams_applications.user_status as user_status'
      ];

      $select_doc = [
        'ams_documents.id as document_id',
        'ams_documents.name as document_name',
        'ams_documents.link as document_link',
        'ams_documents.app_id as app_id',
      ];

      $select_files = [
        'ams_files.id as files_id',
        'ams_files.filename as files_filename',
        'ams_files.mimes as files_mimes',
        'ams_files.file_url as files_fileurl',
        'ams_files.app_id as app_id',
      ];

      //select for list of cc and approver
      $select_approver = [
        'srcusers.users.idsrc_login as approver_user_id',
        'srcusers.users.loginname as approver_name',
        'srcusers.users.emailadd as approver_email',
        'ams_approver_person.id as approver_id',
        'ams_approver_person.remarks as approver_remarks',
        'ams_approver_person.status as approver_status',
        'ams_approver_person.case_status as approver_case_status',
        'ams_approver_person.updated_at as approver_date'
      ];

			$select_cc = [
        'srcusers.users.idsrc_login as ccperson_user_id',
        'srcusers.users.loginname as ccperson_name',
        'srcusers.users.emailadd as ccperson_email',
        'ams_cc_person.id as ccperson_id',
        'ams_cc_person.remarks as ccperson_remarks',
        'ams_cc_person.status as ccperson_status',
        'ams_cc_person.case_status as ccperson_case_status',
        'ams_cc_person.updated_at as ccperson_date'
      ];

      //select for history
      $select_recommend_history = [
        'srcusers.users.idsrc_login as user_id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_recommend.id as id',
        'ams_recommend.remarks as remarks',
        'ams_recommend.user_status as status',
        'ams_recommend.case_status as case_status',
        'ams_recommend.recommend_user_id as recommend_user_id',
        'ams_recommend.updated_at as date'
      ];

			$select_approver_history = [
        'srcusers.users.idsrc_login as user_id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_approver_person.id as id',
        'ams_approver_person.position as position',
        'ams_approver_person.remarks as remarks',
        'ams_approver_person.status as status',
        'ams_approver_person.case_status as case_status',
        'ams_approver_person.updated_at as date'
      ];

			$select_cc_history = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'ams_cc_person.id as id',
        'ams_cc_person.remarks as remarks',
        'ams_cc_person.status as status',
        'ams_cc_person.case_status as case_status',
        'ams_cc_person.updated_at as date'
      ];

      //select for only approver and cc
      $select_only_approver = [
        'ams_approver_person.id as approver_id',
        'ams_approver_person.remarks as approver_remarks',
        'ams_approver_person.status as approver_status',
        'ams_approver_person.position as approver_position',
        'ams_approver_person.case_status as approver_case_status',
        'ams_approver_person.read as approver_read',
        'ams_approver_person.updated_at as approver_date'
      ];

			$select_only_cc = [
        'ams_cc_person.id as ccperson_id',
        'ams_cc_person.remarks as ccperson_remarks',
        'ams_cc_person.status as ccperson_status',
        'ams_cc_person.case_status as ccperson_case_status',
        'ams_cc_person.updated_at as ccperson_date'
      ];

      $app = ModelFactory::getInstance('Application')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->where('ams_applications.id', '=', $id)
            ->where('ams_applications.drafts', '=', 0)
            ->get($select);

      $application_form_name = ModelFactory::getInstance('Forms')
								                ->where('id',$app[0]->type_form)
								                ->first(['name']);

      $application_form_message = ModelFactory::getInstance('Forms')
							                    ->where('id',$app[0]->type_form)
							                    ->first(['message']);

      if($app[0]->type_form == 2)
      {
        $form = ModelFactory::getInstance('FormRcp')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 3)
      {
        $form = ModelFactory::getInstance('FormRca')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 4)
      {
        $form = ModelFactory::getInstance('FormArea')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 5)
      {
        $form = ModelFactory::getInstance('FormArge')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 6)
      {
        $form = ModelFactory::getInstance('FormCdsaa')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 7)
      {
        $form = ModelFactory::getInstance('FormRdra')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 8)
      {
        $form = ModelFactory::getInstance('FormAtac')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 9)
      {
        $form = ModelFactory::getInstance('FormHphcrf')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 10)
      {
        $form = ModelFactory::getInstance('FormMjr')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 11)
      {
        $form = ModelFactory::getInstance('FormPgvbf')
                ->where('app_id',$app[0]->id)
                ->first();
      }

			else if($app[0]->type_form == 12)
      {
        if(\Auth::User()->deptid != 12 )
        {
          //send email to Finance if non Finance user visit the form
          $FinanceGlobalSetting = ModelFactory::getInstance('GlobalSetting')
							                    ->where('id','=',2)
							                    ->first();

					$Forms = ModelFactory::getInstance('Forms')
                    ->where('id','=',$app[0]->type_form)
                    ->first();

					$Department = ModelFactory::getInstance('Department')
		                    ->where('idsrc_departments','=',\Auth::User()->deptid)
		                    ->first();

          $data = array(
    				'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'loginname' =>  \Auth::User()->loginname,
            'module' =>  $Forms->name,
            'case_number' =>  $app[0]->case_number,
            'department' =>  $Department->department,
    			);

					$email =  $FinanceGlobalSetting->value;

					\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
	            $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
	            $m->to($email)->subject('Email Alert on Viewing Finance Matters');
          	});
          }

					$form = ModelFactory::getInstance('FormSorapfca')
                  ->where('app_id',$app[0]->id)
                  ->first();

        	$formlineitem = ModelFactory::getInstance('LineItemSorapfca')
                        	->where('app_id',$app[0]->id)
                        	->get();

          $this->view->formlineitem =  $formlineitem;
        }

				else if($app[0]->type_form == 13)
        {
          if(\Auth::User()->deptid != 12)
          {
            //send email to Finance if non Finance user visit the form
            $FinanceGlobalSetting = ModelFactory::getInstance('GlobalSetting')
								                    ->where('id','=',2)
								                    ->first();

						$Forms = ModelFactory::getInstance('Forms')
	                    ->where('id','=',$app[0]->type_form)
	                    ->first();

						$Department = ModelFactory::getInstance('Department')
			                    ->where('idsrc_departments','=',\Auth::User()->deptid)
			                    ->first();

					 $data = array(
    				'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'loginname' =>  \Auth::User()->loginname,
            'module' =>  $Forms->name,
            'case_number' =>  $app[0]->case_number,
            'department' =>  $Department->department,
    			 );

					 $email =  $FinanceGlobalSetting->value;

						\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
            	$m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            	$m->to($email)->subject('Email Alert on Viewing Finance Matters');
              });
          }

          $form = ModelFactory::getInstance('FormAca')
                  ->where('app_id',$app[0]->id)
                  ->first();
        }

				else if($app[0]->type_form == 14)
        {
          if(\Auth::User()->deptid != 12)
          {
            //send email to Finance if non Finance user visit the form
            $FinanceGlobalSetting = ModelFactory::getInstance('GlobalSetting')
								                    ->where('id','=',2)
								                    ->first();

						$Forms = ModelFactory::getInstance('Forms')
	                    ->where('id','=',$app[0]->type_form)
	                    ->first();

						$Department = ModelFactory::getInstance('Department')
			                    ->where('idsrc_departments','=',\Auth::User()->deptid)
			                    ->first();

					 $data = array(
    				'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'loginname' =>  \Auth::User()->loginname,
            'module' =>  $Forms->name,
            'case_number' =>  $app[0]->case_number,
            'department' =>  $Department->department,
    				);

						$email =  $FinanceGlobalSetting->value;

						\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
            	$m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            	$m->to($email)->subject('Email Alert on Viewing Finance Matters');
              });
          	}

						$form = ModelFactory::getInstance('FormPcmcf')
                    ->where('app_id',$app[0]->id)
                    ->first();

            $formlineitem = ModelFactory::getInstance('LineItemPcmcf')
		                        ->where('app_id',$app[0]->id)
		                        ->get();

            $this->view->formlineitem =  $formlineitem;

          }

					else if($app[0]->type_form == 20)
          {
            if(\Auth::User()->deptid != 12)
            {
              //send email to Finance if non Finance user visit the form
              $FinanceGlobalSetting = ModelFactory::getInstance('GlobalSetting')
									                    ->where('id','=',2)
									                    ->first();

							$Forms = ModelFactory::getInstance('Forms')
		                    ->where('id','=',$app[0]->type_form)
		                    ->first();

							$Department = ModelFactory::getInstance('Department')
				                    ->where('idsrc_departments','=',\Auth::User()->deptid)
				                    ->first();

							$data = array(
    						'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'loginname' =>  \Auth::User()->loginname,
                'module' =>  $Forms->name,
                'case_number' =>  $app[0]->case_number,
                'department' =>  $Department->department,
    					);

							$email =  $FinanceGlobalSetting->value;

							\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
            		$m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            		$m->to($email)->subject('Email Alert on Viewing Finance Matters');
              });
            }

            $form = ModelFactory::getInstance('FormPcmcf2')
                    ->where('app_id',$app[0]->id)
                    ->first();

            $formlineitem = ModelFactory::getInstance('LineItemPcmcf2')
		                        ->where('app_id',$app[0]->id)
		                        ->get();

            $this->view->formlineitem =  $formlineitem;
          }

					else if($app[0]->type_form == 15)
          {
            if(\Auth::User()->deptid != 9)
            {
              //send email to HR if non Hr user visit the form
              $HRGlobalSetting = ModelFactory::getInstance('GlobalSetting')
							                    ->where('id','=',1)
							                    ->first();

							$Forms = ModelFactory::getInstance('Forms')
		                    ->where('id','=',$app[0]->type_form)
		                    ->first();

              $Department = ModelFactory::getInstance('Department')
				                    ->where('idsrc_departments','=',\Auth::User()->deptid)
				                    ->first();

							$data = array(
    						'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'loginname' =>  \Auth::User()->loginname,
                'module' =>  $Forms->name,
                'case_number' =>  $app[0]->case_number,
                'department' =>  $Department->department,
    					);

							$email =  $HRGlobalSetting->value;

							\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
            		$m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            		$m->to($email)->subject('Email Alert on Viewing HR Matters');
              });
            }

						$form = ModelFactory::getInstance('FormMrf')
                    ->where('app_id',$app[0]->id)
                    ->first();
          }

					else if($app[0]->type_form == 16)
          {
            if(\Auth::User()->deptid != 9)
            {
              //send email to HR if non Hr user visit the form
              $HRGlobalSetting = ModelFactory::getInstance('GlobalSetting')
							                    ->where('id','=',1)
							                    ->first();

							$Forms = ModelFactory::getInstance('Forms')
		                    ->where('id','=',$app[0]->type_form)
		                    ->first();

							$Department = ModelFactory::getInstance('Department')
				                    ->where('idsrc_departments','=',\Auth::User()->deptid)
				                    ->first();

							$data = array(
    						'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'loginname' =>  \Auth::User()->loginname,
                'module' =>  $Forms->name,
                'case_number' =>  $app[0]->case_number,
                'department' =>  $Department->department,
    					);

							$email =  $HRGlobalSetting->value;

							\Mail::send('mail.mail_emailalert', $data , function ($m) use ($email) {
            		$m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            		$m->to($email)->subject('Some one check the report');
              });
            }

						$form = ModelFactory::getInstance('FormTsw')
                    ->where('app_id',$app[0]->id)
                    ->first();

            $formlineitem = ModelFactory::getInstance('LineItemTsw')
		                        ->where('app_id',$app[0]->id)
		                        ->get();

            $formlineitemAl = ModelFactory::getInstance('LineItemAlTsw')
			                        ->where('app_id',$app[0]->id)
			                        ->get();

            $this->view->formlineitem =  $formlineitem;
            $this->view->formlineitemAl =  $formlineitemAl;
          }

					else if($app[0]->type_form == 17)
          {
            $form = ModelFactory::getInstance('FormIrfi')
                    ->where('app_id',$app[0]->id)
                    ->first();
          }

					else if($app[0]->type_form == 18)
          {
            $form = ModelFactory::getInstance('FormCoprpo')
                    ->where('app_id',$app[0]->id)
                    ->first();
          }

					else if($app[0]->type_form == 19)
          {
            $form = ModelFactory::getInstance('FormEoq')
                    ->where('app_id',$app[0]->id)
                    ->first();

            $formlineitem = ModelFactory::getInstance('LineItemEoq')
		                        ->where('app_id',$app[0]->id)
		                        ->get();

            $this->view->formlineitem =  $formlineitem;
          }

					else
          {
            $form = (object) [];
          }

        	$doc = ModelFactory::getInstance('Documents')
			            ->join('ams_applications', 'ams_documents.app_id', '=', 'ams_applications.id')
			            ->where('ams_documents.app_id', '=', $id)
			            ->select($select_doc)->get();

	        $files = ModelFactory::getInstance('File')
				            ->join('ams_applications', 'ams_files.app_id', '=', 'ams_applications.id')
				            ->where('ams_files.app_id', '=', $id)
				            ->select($select_files)->get();

        	$approver = ModelFactory::getInstance('Approver')
					            ->join('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
					            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
					            ->where('ams_approver_person.app_id', '=', $id)
					            ->orderBy('ams_approver_person.position', 'asc')
					            ->select($select_approver)->get();

        	$ccpersonData = ModelFactory::getInstance('Ccperson')
							            ->join('ams_applications', 'ams_cc_person.app_id', '=', 'ams_applications.id')
							            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_cc_person.user_id')
							            ->where('ams_cc_person.app_id', '=', $id)
							            ->select($select_cc)->get()->toArray();

        	$result = array();

					foreach ($ccpersonData as $val) {
            if (!isset($result[$val['ccperson_user_id']]))
              $result[$val['ccperson_user_id']] = $val;
        	}

					$ccperson = array_values($result);

        	//special request from Jerry when 20042017 to show special word comment on non approver
         	$approverhistorycommenter = ModelFactory::getInstance('Approver')
													            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
													            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
													            ->where('ams_approver_person.app_id', '=', $id)
													            ->where('ams_approver_person.read', '=', 1)
													            ->where('ams_approver_person.id','!=', DB::raw("(select max(`id`) from ams_approver_person where app_id=".$id.")"))
            													->select($select_approver_history)->get()->toArray();

          if($approverhistorycommenter)
					{
          	foreach($approverhistorycommenter as $column => $commenter)
            {
        			$approverhistorycommenter[$column]['status'] = 5;
          		$approverhistorycommenter[$column]['case_status'] = 5;
         		}
         	}

        	$approverhistoryapprover = ModelFactory::getInstance('Approver')
													            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
													            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
													            ->where('ams_approver_person.app_id', '=', $id)
													            ->where('ams_approver_person.read', '=', 1)
													            ->where('ams_approver_person.id','=', DB::raw("(select max(`id`) from ams_approver_person where app_id=".$id.")"))
													            ->orderby('position','desc')
													            ->select($select_approver_history)->get()->toArray();

	      	$ccpersonhistory = ModelFactory::getInstance('Ccperson')
									            ->join('ams_applications', 'ams_cc_person.app_id', '=', 'ams_applications.id')
									            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_cc_person.user_id')
									            ->where('ams_cc_person.app_id', '=', $id)
									            ->where('ams_cc_person.status', '=', 5)
									            ->select($select_cc_history)->get()->toArray();

        	$recommendhistory = ModelFactory::getInstance('Recommend')
									            ->join('ams_applications', 'ams_recommend.app_id', '=', 'ams_applications.id')
									            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_recommend.user_id')
									            ->where('ams_recommend.app_id', '=', $id)
									            ->where('ams_recommend.user_status', '=', 4)
									            ->select($select_recommend_history)->get()->toArray();

				$this->view->mark = '';
        if($app[0]['status']== 1 && !$approverhistoryapprover)
				{
        	$app[0]['status'] = 5;
        }

        $this->view->myapplist =  $app;
        $this->view->forminfo =  $form;
        $this->view->afm =  $application_form_name;
        $this->view->afmesage =  $application_form_message;
        $this->view->doclist =  $doc;
        $this->view->filelist =  $files;
        $this->view->approverlist =  $approver;
        $this->view->ccpersonlist =  $ccperson;
        $merge_history = array();
       	$merge_history = array_merge($merge_history, $approverhistoryapprover);
        $merge_history = array_merge($merge_history, $approverhistorycommenter);
        $merge_history = array_merge($merge_history, $ccpersonhistory);

        $recdump = array();
        foreach ($recommendhistory as $key => $value)
				{
          $recdump[$key]['user_id'] = $value['user_id'];
          $recdump[$key]['name'] = $value['name'];
          $recdump[$key]['email'] = $value['email'];
          $recdump[$key]['id'] = $value['id'];
          $recdump[$key]['remarks'] = $value['remarks'];
          $recdump[$key]['status'] = $value['status'];
          $recdump[$key]['case_status'] = $value['case_status'];
          $recdump[$key]['recommend_user_id'] = $this->selectUserBy($value['recommend_user_id'],array('loginname as name'))->toArray();
          $recdump[$key]['date'] = $value['date'];
        }

        $merge_history = array_merge($merge_history, $recdump);

        //sort merge by date
        usort($merge_history, function ($a, $b)
				{
          if ($a['date'] == $b['date'])
					{
            return 0;
          }
          return ($a['date'] < $b['date']) ? -1 : 1;
        });

        $this->view->historylist = $merge_history;
        $this->view->action_url =  'print';
        $this->view->title_page = 'Detail Reports';
        $this->view->title = 'View Details - Reports';
        return $this->view('application.view_reports');
    }

    public function file($name){

    $filePath   = public_path().'/uploads/final/'.$name;

    if(file_exists($filePath)) {
            $fileName = basename($filePath);
            $fileSize = filesize($filePath);

            // Output headers.
            header("Cache-Control: private");
            header("Content-Type: application/stream");
            header("Content-Length: ".$fileSize);
            header("Content-Disposition: attachment; filename=".$fileName);

            // Output file.
            readfile ($filePath);
            exit();
        }
        else {
            die('The provided file path is not valid.');
        }
    }


    public function Tmpfile($name){

    	$filePath   = public_path().'/uploads/tmp/'.$name;

    	if(file_exists($filePath)) {
    		$fileName = basename($filePath);
    		$fileSize = filesize($filePath);

    		// Output headers.
    		header("Cache-Control: private");
    		header("Content-Type: application/stream");
    		header("Content-Length: ".$fileSize);
    		header("Content-Disposition: attachment; filename=".$fileName);

    		// Output file.
    		readfile ($filePath);
    		exit();
    	}
    	else {
    		die('The provided file path is not valid.');
    	}
    }

    public function viewFile($name, $mime){

    // Fetch the file info.
    $filePath   = public_path().'/uploads/final/'.$name;
    $host = request()->root().'/uploads/final/'.$name;

    if(file_exists($filePath)) {
            $fileName = basename($filePath);
            $fileSize = filesize($filePath);
                if($mime == 'pdf'){
                    // View File
                    header("Cache-Control: private");
                    header("Content-Type: application/".$mime);
                    header("Content-Length: ".$fileSize);
                    header("Content-Disposition: inline; filename=".$fileName);
                     // Output file.
                    readfile ($filePath);
                    exit();
                }
                else{
                    return redirect('https://docs.google.com/viewer?url='.$host.'&embedded=true');
                }
        }
        else {
            die('The provided file path is not valid.');
        }
    }


    public function viewTmpFile($name, $mime){

    	// Fetch the file info.
    	$filePath   = public_path().'/uploads/tmp/'.$name;
    	$host = request()->root().'/uploads/tmp/'.$name;

    	if(file_exists($filePath)) {
    		$fileName = basename($filePath);
    		$fileSize = filesize($filePath);
    		if($mime == 'pdf'){
    			// View File
    			header("Cache-Control: private");
    			header("Content-Type: application/".$mime);
    			header("Content-Length: ".$fileSize);
    			header("Content-Disposition: inline; filename=".$fileName);
    			// Output file.
    			readfile ($filePath);
    			exit();
    		}
    		else{
    			return redirect('https://docs.google.com/viewer?url='.$host.'&embedded=true');
    		}
    	}
    	else {
    		die('The provided file path is not valid.');
    	}
    }

    public function viewMinutesFile($name){

         // Fetch the file info.
    $filePath = public_path().'/uploads/final/'.$name;

    if(file_exists($filePath)) {
            return file_get_contents($filePath);
            exit();
        }
        else {
            die('The provided file path is not valid.');
        }
    }

    public function selectUserBy($id, $select){
        return ModelFactory::getInstance('User')
                    ->where('idsrc_login', '=', $id)
                    ->first($select);
    }

		public function fillFeedbackForm($id){
			$app_id = $id;
			$course_id = \App\Http\Models\FormTsw::select("course_id")->where("app_id","=",$app_id)->first()['course_id'];
			$questionnaire_id = \App\Http\Models\Questionnaire::select("id")->where("course_id","=",$course_id)->first()['id'];
			$this->view->selected_questionnaire = \App\Http\Models\Questionnaire::selectedQuestionnaire($questionnaire_id);
			$this->view->selected_questionnaire_detail = \App\Http\Models\QuestionnaireDetail::selectedQuestionnaireDetail($questionnaire_id);
			$this->view->app_id = $app_id;
			$this->view->questionnaire_id = $questionnaire_id;
			$this->view->title = 'Fill in the form';

			return $this->view('application.feedback');
		}

}
