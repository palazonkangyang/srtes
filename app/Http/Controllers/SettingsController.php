<?php

namespace App\Http\Controllers;

use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use App\Factories\PresenterFactory;
use Illuminate\Http\Request;
use App\Http\Requests\AddTypeRequest;
use App\Http\Requests\AddUrgencyRequest;
use App\Http\Requests\AddApprovers;
use App\Http\Requests\AddForms;
use Response;

class SettingsController extends ControllerCore
{

	/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function StoreTypeRequest(AddTypeRequest $request)
    {

        $name = $request->get('name');
        
        $typerequest = ModelFactory::getInstance('TypeRequest');
        $typerequest->name = $name;
        $typerequest->created_id = \Auth::User()->idsrc_login;

        if($typerequest->save()){
            return \Redirect::back()->with('rmsg', $name.' has been added.');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function StoreUrgency(AddUrgencyRequest $request)
    {

        $rg = $request->only('1', '2');
        foreach ($rg as $key => $value) {
            $urgency = ModelFactory::getInstance('Urgency')->find($key);
            $urgency->set_time = $value;
            $urgency->save();
        }
       
        return \Redirect::back()->with('rmsg', 'Urgency time has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function RemoveTypeRequest($id)
    {   
        $getdata = ModelFactory::getInstance('TypeRequest')
                        ->find($id);

        $typerequest = ModelFactory::getInstance('TypeRequest')
                        ->where('id','=',$id)
                        ->delete();

        if($typerequest) {
            return \Redirect::back()->with('dmsg', $getdata->name.' has been successfully DELETED! ');
        } 
                    
    }
    
    /**
     * Set all approver in a forms.
     *
     * @return Response
     */
    public function SetApprovers(AddApprovers $request)
    {
        
           $Forms_ams = ModelFactory::getInstance('Forms')
                                  ->find($request->id);
         $Forms_ams->message =  $request->message;
          $Forms_ams->approvallogic =  $request->approvallogic;
        $Forms_ams->save();
        
    		
            
    		  $removeExistingCC = ModelFactory::getInstance('CCForm')
					    		->where('form_id','=',$request->id)
					    		->delete();
               
            
         
                if($request->approver){
                   $removeExisting = ModelFactory::getInstance('ApproverForm')
					    		->where('form_id','=',$request->id)
					    		->delete();
	    	foreach ($request->approver as $key => $value) {
	    		$form_approver_id = ModelFactory::getInstance('ApproverForm');
	    		$form_approver_id->form_id = $request->id;
                         if(substr($value, 0, 6) == 'group_')
                    {
                     $form_approver_id->user_id = 0;
                     $form_approver_id->group_id = substr($value, 6, 6);
                    }
                    else{
                    $form_approver_id->user_id = $value;
                    $form_approver_id->group_id = 0;
                    }
	    		
	    		$form_approver_id->updated_id = \Auth::User()->idsrc_login;
	    	
	    		$form_approver_id->save();
                       
	    	}
                }
                if($request->ccperson){
                       
                     foreach ($request->ccperson as $key => $value) {
	    		$form_cc_id = ModelFactory::getInstance('CCForm');
	    		$form_cc_id->form_id = $request->id;
	    		$form_cc_id->user_id = $value;
	    		$form_cc_id->updated_id = \Auth::User()->idsrc_login;
	    	
	    		$form_cc_id->save();
                       
	    	}
                }
    	
    	return \Redirect::back()->with('success',  'Form approvers has been updated.');
    }
    
    /**
     * Set all forms in a request.
     *
     * @return Response
     */
    public function SetForms(AddForms $request)
    {
    	
    	if($request->form){
    
    		$removeExisting = ModelFactory::getInstance('RequestToForm')
    		->where('request_id','=',$request->id)
    		->delete();
    
    		foreach ($request->form as $key => $value) {
    			$request_form = ModelFactory::getInstance('RequestToForm');
    			$request_form->request_id = $request->id;
    			$request_form->form_id = $value;
    			$request_form->updated_id = \Auth::User()->idsrc_login;
    
    			$request_form->save();
    		}
    	}
    	return \Redirect::back()->with('success',  'Request form has been updated.');
    }
    
    /**
     * Get all forms in a request.
     *
     * @return Response
     */
    public function GetForms(Request $request)
    {	
    	if($request->request_id){
    		
    		$forms = PresenterFactory::getInstance('Application')->getFormbyRequestID($request->request_id);
    		
    		return Response::json(array('forms' => $forms), 200);
    	}
    }
    
     public function updatepost(Request $request)
    {
        $verifier = \App::make('validation.presence');

        $verifier->setConnection('mysql2');

        $validator = \Validator::make($request->all(), [
           
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('settings/person/editperson/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save department info
            $TypePerson= ModelFactory::getInstance('TypePerson')
                         ->find($request->id);
            
          
             $TypePerson->puser_id = $request->user_id;

            if($TypePerson->save()){
                 return redirect('settings/person/editperson/'.$request->id)
                        ->with('success', 'Successfully edit Post Setting.');
            }
        }
    }
}
