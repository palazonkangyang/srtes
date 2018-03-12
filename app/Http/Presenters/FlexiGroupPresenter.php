<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class FlexiGroupPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //start
        	$select = [ 
    			'ams_flexigroup.id as form_id',
    			'ams_flexigroup.name as name',
                        'ams_flexigroup.full_name as full_name',
    			'srcusers.users.loginname as user_name', 
    			'srcusers.users.emailadd as user_email'];
    
    	$prepare = ModelFactory::getInstance('FlexiGroup')
                   ->where('id','!=',1)
                   ->get(); 
    	$set = [];
    	foreach ($prepare as $pre){
    		$getperson = ModelFactory::getInstance('FlexiGroupPerson')
    					->where('group_id',$pre->id)
    					->with([
    							'Memberlist' => function($query){
    								$query->select('idsrc_login','loginname','emailadd');
    							}
    						])
    					->get();
       
    		$set[$pre->id] = [
                                                        'group_full_name'=>$pre->full_name,
    							'group_name'=>$pre->name,
    							'members'=> $getperson        
					   ];
    	}

    	
    	$this->view->groups = $set;
    	
    	  $this->view->title = 'Flexible Group Management';
        return $this->view('flexigroup.index');
        
        //end
       /* $prepare = ModelFactory::getInstance('FlexiGroup')
        		
                ->where('id', '!=', '0');
       
        // add search filter for flexible group
        $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordFlexiGroup');
        $this->view->searchFilter = $searchFilter;
        
        $this->view->flexigrouplist = $this->paginate($prepare);
        
        $this->view->title = 'Flexible Group Management';
        return $this->view('flexigroup.index'); */
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
           
        $this->view->title = 'Create New Flexible Group';
        return $this->view('flexigroup.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //start of 
        
        	$select = ['id'];
    	$getflexigroup = ModelFactory::getInstance('FlexiGroup')->find($id);
    	$getGrouppersons = ModelFactory::getInstance('FlexiGroupPerson')
    					->where('group_id', $id)
    					->with([
    							'Memberlist' => function($query){
    								$query->select('idsrc_login','loginname','emailadd');
    							}
    					])
						->get();
				
    	$this->view->grouppersons = $getGrouppersons;
    	$this->view->flexigroup = $getflexigroup;
        $this->view->title = 'Edit Flexible Group';
        return $this->view('flexigroup.edit');
        //end of 
        //origin code
       /* 
        $prepare = ModelFactory::getInstance('FlexiGroup')
        		
                ->where('id', '=', $id)->get();

        $this->view->id = $id;
        $this->view->flexigroup = $prepare;
        $this->view->title = 'Edit Flexible Group';
        return $this->view('flexigroup.edit');
        
        */
    }
    
        public function view1($id)
    {
        //start of 
        
        	$select = ['id'];
    	$getflexigroup = ModelFactory::getInstance('FlexiGroup')->find($id);
    	$getGrouppersons = ModelFactory::getInstance('FlexiGroupPerson')
    					->where('group_id', $id)
    					->with([
    							'Memberlist' => function($query){
    								$query->select('idsrc_login','loginname','emailadd');
    							}
    					])
						->get();
				
    	$this->view->grouppersons = $getGrouppersons;
    	$this->view->flexigroup = $getflexigroup;
        $this->view->title = 'View Flexible Group';
        return $this->view('flexigroup.view1');
        //end of 
        //origin code
       /* 
        $prepare = ModelFactory::getInstance('FlexiGroup')
        		
                ->where('id', '=', $id)->get();

        $this->view->id = $id;
        $this->view->flexigroup = $prepare;
        $this->view->title = 'Edit Flexible Group';
        return $this->view('flexigroup.edit');
        
        */
    }
}
