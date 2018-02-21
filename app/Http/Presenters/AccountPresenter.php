<?php

namespace App\Http\Presenters;

use Auth;
use Session;
use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\TypeFactory;
use Illuminate\Http\Request;
use DB;

class AccountPresenter extends PresenterCore
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    if (Auth::check())
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $cnt = ModelFactory::getInstance('Approver')
              ->join('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
              ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
              ->where('ams_approver_person.user_id', '=', $user_id)
              ->where('ams_approver_person.read', '=', 0)
              ->where('ams_approver_person.forward', '=', 1)
              ->whereNotIn('ams_applications.status', [ 2, 3 ])
              ->where('ams_applications.drafts', '=', 0)
              ->orWhere('ams_applications.created_id', '=', $user_id)
              ->distinct()
              ->whereNotIn( 'ams_applications.status', [0, 1, 2, 3, 4])
              ->count();

      $this->view->cnt = $cnt;
      $this->view->data = Session::all();

      return $this->view('account.dashboard');
    }

    else
    {
      return redirect('/login');
    }
  }

  public function tes_index()
  {
    if (Auth::check())
    {
      $user_id = \Auth::User()->idsrc_login;
      $role = \Auth::User()->roleid;

      $cnt = ModelFactory::getInstance('Approver')
              ->join('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
              ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
              ->where('ams_approver_person.user_id', '=', $user_id)
              ->where('ams_approver_person.read', '=', 0)
              ->where('ams_approver_person.forward', '=', 1)
              ->whereNotIn('ams_applications.status', [ 2, 3 ])
              ->where('ams_applications.drafts', '=', 0)
              ->orWhere('ams_applications.created_id', '=', $user_id)
              ->distinct()
              ->whereNotIn( 'ams_applications.status', [0, 1, 2, 3, 4])
              ->count();

      $this->view->cnt = $cnt;
      $this->view->data = Session::all();

      return $this->view('tes.account.dashboard');
    }

    else
    {
      return redirect('/login');
    }
  }

  /**
   * Display change password form
   * @return \Illuminate\View\View
   */
  public function accountSettings()
  {
    if(Auth::check())
    {
      $user = ModelFactory::getInstance('User')
              ->where('idsrc_login', '=', \Auth::User()->idsrc_login)
              ->get()->toArray();

      $this->view->user = $user;
      $this->view->title = 'Account Settings';

      return $this->view('account.settings');
    }

    else
    {
      return redirect('/login');
    }
  }

  /**
   * Display change password form
   * @return \Illuminate\View\View
   */
  public function myProfile()
  {
    if(Auth::check())
    {
      $user = ModelFactory::getInstance('User')
              ->where('idsrc_login', '=', \Auth::User()->idsrc_login);

      $user = $user->join('departments', function ($join) {
                $join->on('users.deptid', '=', 'departments.idsrc_departments');
              })->get();

      $this->view->user = $user;
      $this->view->department_list = $this->getDepartmentSelected($user);
      $this->view->role_list = $this->getRoleSelected($user);
      $this->view->title = 'Account Settings';

      return $this->view('account.myprofile');
    }

    else
    {
      return redirect('/login');
    }
  }

  /**
   * Display change password form
   * @return \Illuminate\View\View
   */
  public function changePassword()
  {
    if(Auth::check())
    {
            $this->view->data = Session::all();
            $this->view->title = 'Change Password';
            return $this->view('account.change');
    }

    else
    {
      return redirect('/login');
    }
  }

  /**
   * Display viewlogin form
   * @return \Illuminate\View\View
   */
  public function viewLogin()
  {
    if (!Auth::check())
    {
      return view('account.login');
    }

    else
    {
      return back();
    }
  }

  /**
   * Display login form
   * @return \Illuminate\View\View
   */
  public function resetPassword()
  {
    if(!Auth::check())
    {
      return view('account.reset');
    }

    else
    {
      return back();
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */

  public function getDepartmentSelected($prepare, $excludeIds=[])
  {
    $department = ModelFactory::getInstance('Department');
    $getResult = ModelFactory::getInstance('Department');

    if($excludeIds)
    {
      $department->whereNotIn('id',$excludeIds);
    }

    $getResult = $getResult->where('idsrc_departments' , '=' , $prepare['0']->deptid)->get();
    $department = $department->where('idsrc_departments' , '!=' , $prepare['0']->deptid);
    $department = $department->orderBy('idsrc_departments','asc');
    $depdata = $department->get();

    $this->newdepdata = array($getResult['0']->idsrc_departments => $getResult['0']->deptdesc.'('.$getResult['0']->department.')');

    foreach ($depdata as $data)
    {
      $this->newdepdata[$data->idsrc_departments] = $data->deptdesc.' ('.$data->department.') ';
    }

    return $this->newdepdata;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */

  public function getRoleSelected($prepare, $excludeIds=[])
  {
    $department = ModelFactory::getInstance('Roles');
    $getResult = ModelFactory::getInstance('Roles');

    if($excludeIds)
    {
      $department->whereNotIn('id',$excludeIds);
    }

    $getResult = $getResult->where('id' , '=' , $prepare['0']->roleid)->get();
    $department = $department->where('id' , '!=' , $prepare['0']->roleid);
    $department = $department->orderBy('id','asc');
    $depdata = $department->get();

    $this->newdepdata = array($getResult['0']->id => $getResult['0']->name);

    foreach ($depdata as $data)
    {
      $this->newdepdata[$data->id] = $data->name;
    }
    return $this->newdepdata;
  }
  
}
