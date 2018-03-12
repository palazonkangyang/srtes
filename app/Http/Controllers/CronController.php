<?php

namespace App\Http\Controllers;

use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\LibraryFactory;
use App\Libraries\FileLibrary;
use Response;
use Validator;
use Carbon\Carbon;

class CronController extends ControllerCore
{

	/**
     * execute a newly created resource in storage.
     *
     * @return Response
     */
    public function execute()
    {
        $carbon = new Carbon();
        $today = $carbon->format('Y-m-d H');

        $select = ['created_at','urgency','id','created_id'];
        $apps = ModelFactory::getInstance('Application')
                ->where('status', '=', '0')
                ->get($select);

        foreach ($apps as $app) {

                $app_id = $app->id;

                $essentials = ModelFactory::getInstance('Approver')
                        ->where('ams_approver_person.app_id', '=', $app->id)
                        ->where('ams_approver_person.forward', '=', 0)
                        ->get();

                foreach ($essentials as $ess) {
                   
                    $cess = \Carbon\Carbon::createFromTimeStamp(strtotime($ess->date_to_email))->format('Y-m-d H');

                    if($cess != $today){
                         
                         $this_essential = $this->selectUserBy($ess->user_id, array('loginname','emailadd'));

                         $upforward = ModelFactory::getInstance('Approver')->find($ess->id);
                         $upforward->forward = 1;
                         $upforward->save();

                           //general email data to next approver
                        $nextapproverid = $upforward->id  + 1;   
                          $nextapprover = ModelFactory::getInstance('Approver')->find($nextapproverid);
                        $creator =  $this->selectUserBy($app->created_id, array('loginname','emailadd'));
                        $to_date =  \Carbon\Carbon::createFromTimeStamp(strtotime($app->created_at))->format('d/m/Y h:i A');
                                    
                        $link = url('/application/view_details/'.$app_id, '', $secure = null);
                        $check = 'approver';
                        $subject = 'SRC Approval Management System';
 
                        $to_name = $this_essential->loginname;
                        $to_mail = $this_essential->emailadd;
                        $mail_data = array(
                            'to_name' => $to_name, 
                            'to_email' => $to_mail, 
                            'name_submitted' => $creator->loginname, 
                            'date' => $to_date, 
                            'app_link' => $link, 
                            'check' => $check
                        );

                        $this->send_email('mail.mail', $mail_data, $this_essential, $subject);
                         
                         //general email data to skipped approver
                        $creator =  $this->selectUserBy($app->created_id, array('loginname','emailadd'));
                        $to_date =  \Carbon\Carbon::createFromTimeStamp(strtotime($app->created_at))->format('d/m/Y h:i A');
                                    
                        $link = url('/application/view_details/'.$app_id, '', $secure = null);
                        $check = 'approver';
                        $subject = 'SRC Approval Management System';
 
                        $to_name = $this_essential->loginname;
                        $to_mail = $this_essential->emailadd;
                        $mail_data = array(
                            'to_name' => $to_name, 
                            'to_email' => $to_mail, 
                            'name_submitted' => $creator->loginname, 
                            'date' => $to_date, 
                            'app_link' => $link, 
                            'check' => $check
                        );

                        $this->send_email('mail.mail', $mail_data, $this_essential, $subject);
                         
                         
                        //general email data
                        $creator =  $this->selectUserBy($app->created_id, array('loginname','emailadd'));
                        $to_date =  \Carbon\Carbon::createFromTimeStamp(strtotime($app->created_at))->format('d/m/Y h:i A');
                                    
                        $link = url('/application/view_details/'.$app_id, '', $secure = null);
                        $check = 'approver';
                        $subject = 'SRC Approval Management System';
 
                        $to_name = $this_essential->loginname;
                        $to_mail = $this_essential->emailadd;
                        $mail_data = array(
                            'to_name' => $to_name, 
                            'to_email' => $to_mail, 
                            'name_submitted' => $creator->loginname, 
                            'date' => $to_date, 
                            'app_link' => $link, 
                            'check' => $check
                        );

                        $this->send_email('mail.mail', $mail_data, $this_essential, $subject);

                    }
                }
        }
        $this->clear_files();

        return 'Date Run: '.date('Y-m-d h:i:s');
    }


    public function clear_files(){
        $carbon = new Carbon();

        $configPath = public_path().'/uploads/tmp';
        $files = \File::allFiles($configPath);

        if($files){
            foreach ($files as $file){
                $file_date = (string)date("Y-m-d",filemtime($file));
                $yest_date = $carbon->parse()->subDays(1)->format('Y-m-d');

                if($file_date == $yest_date){
                    \File::delete($file);
                }
            }
        }
    }
    public function send_email($layout, $data, $criteria, $subject){

        \Mail::send($layout,$data,function($message) use ($criteria, $subject){
            $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $message->to($criteria->emailadd)->subject($subject);
        });

    }

    public function selectUserBy($id, $select){

        return ModelFactory::getInstance('User')
                    ->where('idsrc_login', '=', $id)
                    ->first($select);

    }

}
