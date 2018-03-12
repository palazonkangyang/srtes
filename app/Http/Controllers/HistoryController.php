<?php

namespace App\Http\Controllers;

use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use App\Factories\PresenterFactory;
use Illuminate\Http\Request;
use Response;
use Storage;
use DB;

class HistoryController extends ControllerCore
{

	/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function saveDrafts(Request $request)
    {	
        DB::beginTransaction();

        $app = ModelFactory::getInstance('Application')->findOrNew($request->appid);
        $app->created_id = \Auth::User()->idsrc_login;
        $app->department = $request->department;
        $app->type_request = $request->type_request;
        $app->urgency = ( $request->urgency ? $request->urgency : 1 );
        $app->title = $request->title;
        $app->request_details = $request->request_details;

        $app->type_form = 1;
        $app->drafts = 1;
        

        if($request->appid){
        	$approverRemove = ModelFactory::getInstance('Approver')->where('app_id','=',$request->appid)->delete();
        	$ccpersonRemove = ModelFactory::getInstance('Ccperson')->where('app_id','=',$request->appid)->delete();
        	$docsRemove = ModelFactory::getInstance('Documents')->where('app_id','=',$request->appid)->delete();
        	$filesRemove = ModelFactory::getInstance('File')->where('app_id','=',$request->appid)->delete();
        }
        
        $getname = PresenterFactory::getInstance('Application')->selectUserBy(\Auth::User()->idsrc_login, array('loginname'));

        if($app->save())
        {
            $this->id = $app->id;

            $case_number = $request->department.'/'.str_pad($this->id, 6, '0', STR_PAD_LEFT).'/'.date('Y');
            $update_section = ModelFactory::getInstance('Application')->find($this->id);
            $update_section->case_number = $case_number;
            $update_section->save();

            if($request->approver){

            $urgency = ModelFactory::getInstance('Urgency')->where('urgency_id','=', $request->urgency)->first();

                foreach ($request->approver as $key => $value) {
                    $approver = ModelFactory::getInstance('Approver');
                    $approver->app_id = $this->id;
                    $approver->user_id = $value;
                    $approver->position = $key;
                    $approver->email_log_time = $urgency->set_time;
                    $approver->save();
                }
            }

            if($request->ccperson){

                foreach ($request->ccperson as $key => $value) {
                    $ccperson = ModelFactory::getInstance('Ccperson');
                    $ccperson->app_id = $this->id;
                    $ccperson->user_id = $value;
                    $ccperson->position = $key;
                    $ccperson->save();
                }
            }

            if($request->google_doc_name && $request->google_doc_link){
                $merge = array_combine($request->google_doc_name,$request->google_doc_link);
        
                foreach ($merge as $key => $value) {
                    $documents = ModelFactory::getInstance('Documents');
                    $documents->app_id = $this->id;
                    $documents->name = $key;
                    $documents->link = $value;
                    $documents->save();
                }
            }

            if($request->filename && $request->fileurl && $request->mimetype){       
                 $count = count($request->filename);
                 for($i=0; $i<$count; $i++) {
                    $files = ModelFactory::getInstance('File');
                    $files->app_id = $this->id;
                    $files->filename = $request->filename[$i];
                    $files->file_url = $request->fileurl[$i];
                    $files->mimes = $request->mimetype[$i];
                    /*Storage::move('/public/uploads/tmp/'.$request->fileurl[$i], '/public/uploads/final/'.$request->fileurl[$i]);*/
                    $files->save();
                 }
            }        
        }

        DB::commit();
        
        return redirect(url('history/edit/savedrafts/'.$this->id))->with('success','Application has been saved to draft');
    }
    
     public function DeleteDrafts(Request $request)
    {	
        DB::beginTransaction();

        $app = ModelFactory::getInstance('Application')->findOrNew($request->appid);
       
        $app->status = 3;
        $app->drafts = 1;
        $app->save();

      
        DB::commit();
        
        return redirect(url('history/savedrafts/list'))->with('success','Draft application has been deleted');
    }
}
