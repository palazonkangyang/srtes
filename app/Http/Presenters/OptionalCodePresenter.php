<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class OptionalCodePresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $prepare = ModelFactory::getInstance('OptionalCode')
        		
                ->where('id', '!=', '0');
       
        // add search filter for optional code
        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordOptionalCode');
        $this->view->searchFilter = $searchFilter;
        
        $this->view->optionalcodelist = $this->paginate($prepare);
        
        $this->view->title = 'Optional Code Management';
        return $this->view('optionalcode.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
           
        $this->view->title = 'Create New Optional Code';
        return $this->view('optionalcode.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $prepare = ModelFactory::getInstance('OptionalCode')
        		
                ->where('id', '=', $id)->get();

        $this->view->id = $id;
        $this->view->optionalcode = $prepare;
        $this->view->title = 'Edit Optional Code';
        return $this->view('optionalcode.edit');
    }
}
