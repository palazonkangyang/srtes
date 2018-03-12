<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class FlexiGroupController extends ControllerCore
{

	/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $verifier = \App::make('validation.presence');

        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:ams_flexigroup,name'
          
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('flexigroup/createflexigroup')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        // save flexigroup info
            $flexigroup= ModelFactory::getInstance('FlexiGroup');
            
            $flexigroup->name = $request->name;
            $flexigroup->full_name =  $request->full_name;
       
       
            
            if($flexigroup->save()){
                 return redirect('flexigroup/createflexigroup')
                        ->with('success', 'Successfully created flexible group.');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
         
            $FlexiGroup = ModelFactory::getInstance('FlexiGroup')
                                  ->find($request->id);
            $FlexiGroup->name =  $request->name;
            $FlexiGroup->full_name =  $request->full_name;
            $FlexiGroup->save();
        
            
         
                if($request->approver){
                   $removeExisting = ModelFactory::getInstance('FlexiGroupPerson')
					    		->where('group_id','=',$request->id)
					    		->delete();
	    	foreach ($request->approver as $key => $value) {
	    		$FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson');
	    		$FlexiGroupPerson->group_id = $request->id;
	    		$FlexiGroupPerson->user_id = $value;
	    		$FlexiGroupPerson->updated_id = \Auth::User()->idsrc_login;
	    	
	    		$FlexiGroupPerson->save();
                       
	    	}
                }
          
    	
    	return \Redirect::back()->with('success',  'Flexible group has been updated.');

        
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete user device
        try {
                $flexigroup = ModelFactory::getInstance('FlexiGroup')
                        ->where('id','=',$id)
                        ->delete();
                
                return redirect('flexigroup')
                        ->with('success', 'Successfully deleted flexible group #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }
}
