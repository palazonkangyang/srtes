<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class DepartmentPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $prepare = ModelFactory::getInstance('Department')
        		->with([
        			'hod' => function($query){
        				$query->select('idsrc_login','loginname');
        			},
                                        'ro' => function($query){
        				$query->select('idsrc_login','loginname');
        			}
        		])
                ->where('idsrc_departments', '!=', '0');
       
        // add search filter for users
        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordDepartment');
        $this->view->searchFilter = $searchFilter;
        
        $this->view->departmentlist = $this->paginate($prepare);
        
        $this->view->title = 'Department Management';
        return $this->view('department.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
           
        $this->view->title = 'Create New Department';
        return $this->view('department.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $prepare = ModelFactory::getInstance('Department')
        		->with([
        		'hod' => function($query){
        			$query->select('idsrc_login','loginname');
        		}
        		])
                ->where('idsrc_departments', '=', $id)->get();

        $this->view->id = $id;
        $this->view->department = $prepare;
        $this->view->title = 'Edit Department';
        return $this->view('department.edit');
    }
}
