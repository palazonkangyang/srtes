<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class UserManagementPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $userid = \Auth::User()->idsrc_login;

        $prepare = ModelFactory::getInstance('User')
                ->where('idsrc_login', '!=', $userid)
                ->where('roleid', '!=', '-1');
        
        $prepare = $prepare->join('departments', function ($join) {
                            $join->on('users.deptid', '=', 'departments.idsrc_departments');
        });

        // add search filter for users
        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordUser');
        $this->view->searchFilter = $searchFilter;
        
        $this->view->userlist = $this->paginate($prepare);

        $this->view->title = 'User Management';
    	return $this->view('usermanagement.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->view->department_list = $this->getDepartmentOptID();
        $this->view->role_list = $this->getRoleOptID();
           
        $this->view->title = 'Create New User';
        return $this->view('usermanagement.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $prepare = ModelFactory::getInstance('User')
                ->where('idsrc_login', '=', $id);

        $prepare = $prepare->join('departments', function ($join) {
                            $join->on('users.deptid', '=', 'departments.idsrc_departments');
        })->get();

        $this->view->department_list = $this->getDepartmentSelected($prepare);
        $this->view->role_list = $this->getRoleSelected($prepare);

        $this->view->id = $id;
        $this->view->user = $prepare;
        $this->view->title = 'Edit User';
        return $this->view('usermanagement.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function getDepartmentOptID($excludeIds=[])
    {
        $department = ModelFactory::getInstance('Department');
    
        if($excludeIds)
        {
            $department->whereNotIn('id',$excludeIds);
        }
        $department->orderBy('department','asc');        
        $depdata = $department->get();

        $this->newdepdata = array('' => '-- Select Department --');
        foreach ($depdata as $data) {
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
        foreach ($depdata as $data) {
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

    public function getRoleOptID($excludeIds=[])
    {
        $roles = ModelFactory::getInstance('Roles');
    
        if($excludeIds)
        {
            $roles->whereNotIn('id',$excludeIds);
        }
        $roles->orderBy('id','asc');        
        $depdata = $roles->get();

        $this->newdepdata = array('' => '-- Select User Level --');
        foreach ($depdata as $data) {
            $this->newdepdata[$data->id] = $data->name;
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
        foreach ($depdata as $data) {
            $this->newdepdata[$data->id] = $data->name;
        }

        return $this->newdepdata;
    }
}
