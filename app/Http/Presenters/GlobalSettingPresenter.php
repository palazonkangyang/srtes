<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class GlobalSettingPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $prepare = ModelFactory::getInstance('GlobalSetting')
        		
                ->where('id', '!=', '0');
       
        // add search filter for global setting
        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordGlobalSetting');
        $this->view->searchFilter = $searchFilter;
        
        $this->view->globalsettinglist = $this->paginate($prepare);
        
        $this->view->title = 'Global Setting Management';
        return $this->view('globalsetting.index');
    }


  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $prepare = ModelFactory::getInstance('GlobalSetting')
        		
                ->where('id', '=', $id)->get();

        $this->view->id = $id;
        $this->view->globalsetting = $prepare;
        $this->view->title = 'Edit Global Setting';
        return $this->view('globalsetting.edit');
    }
}
