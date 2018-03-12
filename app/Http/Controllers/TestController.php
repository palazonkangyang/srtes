<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Core\ControllerCore;

class TestController extends ControllerCore
{
    public function approveapp(Request $request){

        $app_id = $request->app_id;
        $approver_id = $request->approver_id;
        $creator_id = $request->creator_id;
        $status = $request->status;
        $case_status = $request->case_status;
        $case_title = $request->case_title;
        $remarks = $request->remarks;
        $case_number = $request->case_number;
        $selected_recommend_id = $request->selected_recommend;
        $valid_to_change = true;

        $app = ModelFactory::getInstance('Application')->find($app_id);
        $form_name = ModelFactory::getInstance('Forms')
            ->where('id',$app->type_form)
            ->first(['name']);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'remarks' => 'required',
        ]);

        if (!$validator->fails()) {
    
        $appr_up = ModelFactory::getInstance('Approver')->find($approver_id);
            

        if($status == '1' || $status == '2'){
            
            $appr_up->remarks = $remarks;
            $appr_up->status = $status;
            $appr_up->case_status = ($status == 2 ? $status : $case_status);
            $appr_up->read = 1;
        }

        else if($status == '4') {
            
        $check_recommenddb = ModelFactory::getInstance('Recommend')
                            ->where('app_id', '=', $app_id)
                            ->get();

        $condition_recommenddb = true;
        foreach ($check_recommenddb as $rdb) {
            if($selected_recommend_id == $rdb->user_id){
                $condition_recommenddb = false;
            }
        }

        $invalid_person = $this->selectUserBy($selected_recommend_id, array('loginname'));

        if($condition_recommenddb){

            $rec_up = ModelFactory::getInstance('Recommend');
            $rec_up->app_id = $app_id;
            $rec_up->user_id = $appr_up->user_id;
            $rec_up->remarks = $remarks;
            $rec_up->recommend_user_id = $selected_recommend_id;
            $rec_up->user_status = 4;

            if($rec_up->save()) {
                $appr_up->user_id = $selected_recommend_id;
                $check_ccperson = ModelFactory::getInstance('Ccperson')
                      ->where('app_id', '=', $app_id)
                      ->where('user_id', '=', $request->selected_recommend)
                      ->delete();

                //notify recommend person
                $get_rec_person = $this->selectUserBy($selected_recommend_id, array('loginname','emailadd'));
                $mail_data = array();

                $new_rec_info = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname','emailadd'));
                $name_submitted = $get_rec_person->loginname;
                $to_name = $new_rec_info->loginname;
                $to_mail = $new_rec_info->emailadd;
                $to_date =    date('d/m/Y h:i A');

                $link = url('/application/view_details/'.$app_id, '', $secure = null);;
                $check = 'recommend_notification';
                $subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;

                $mail_data = array(
                'to_name' => $to_name, 
                'to_email' => $to_mail,
                'name_submitted' => $name_submitted,
                'case_number' => $case_number,
                'date' => $to_date,
                'app_link' => $link,
                'check' => $check );

                $this->send_email('mail.mail', $mail_data, $get_rec_person, $subject);
            }
        }
        else {
             return redirect('/application/view_details/'.$app_id)
                         ->with('error_message', 'You cannot forward '.$invalid_person->loginname.'. Already forwarded this case.');
        }

        }

        if($appr_up->save()){

            $check_app = ModelFactory::getInstance('Application')->find($app_id);
            $check_status = ModelFactory::getInstance('Approver')
                        ->where('app_id', '=', $app_id)
                        ->get();
            foreach ($check_status as $check) {
                    if($check->status == 0){
                        $valid_to_change = false;
                    }
                }
            if($valid_to_change) {
                $up_case = ModelFactory::getInstance('Approver')->find($approver_id);
                $up_case->case_status = $status;
                $up_case->save();
                $check_app->status = $status;
            } else {
                 $check_app->status = ($status == 2 ? $status : $case_status);
            }

            if($check_app->save()){

                if($status == 1){

                    $curr_appr = ModelFactory::getInstance('Approver')
                        ->where('app_id', '=', $app_id)
                        ->where('id', '=', $approver_id)   
                        ->first();

                    if($curr_appr){
                    $curr_appr->position = $curr_appr->position + 1;

                        $next_appr = ModelFactory::getInstance('Approver')
                                    ->where('app_id', '=', $app_id)
                                    ->where('position', '=', $curr_appr->position) 
                                    ->where('read', '=', 0) 
                                    ->where('forward', '=', 0)
                                    ->first();

                        if($next_appr){
                            
                            //notify next approver
                            $up_forward = ModelFactory::getInstance('Approver')->firstOrNew(array('app_id' => $app_id, 'user_id' => $next_appr->user_id, 'position' => $curr_appr->position, 'read' => '0'));
                            $up_forward->forward = 1;
                            $up_forward->save();

                            $getname = $this->selectUserBy($curr_appr->user_id, array('loginname'));
                            $mail_data = array();

                            $not_ex_info = $this->selectUserBy($next_appr->user_id, array('loginname','emailadd'));
                            $name_submitted = $getname->loginname;
                            $to_name = $not_ex_info->loginname;
                            $to_mail = $not_ex_info->emailadd;
                            $to_date =    date('d/m/Y h:i A');

                            $link = url('/application/view_details/'.$app_id, '', $secure = null);;
                            $check = 'next_approver';
                            $subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;

                            $mail_data = array(
                            'to_name' => $to_name, 
                            'to_email' => $to_mail,
                            'name_submitted' => $name_submitted,
                            'case_number' => $case_number,
                            'date' => $to_date,
                            'app_link' => $link,
                            'check' => $check );

                            $this->send_email('mail.mail', $mail_data, $not_ex_info, $subject);
                        } else {
                            //Approved application notify owner
                            
                        }

                    } 

                }

                //notify self
                $getname = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname','emailadd'));
                $select = [
                    'srcusers.users.loginname as loginname',
                    'srcusers.users.emailadd as emailadd',
                ];
                $app = ModelFactory::getInstance('Application')
                    ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                    ->where('ams_applications.id', '=', $app_id)
                    ->get($select);

                foreach ($app as $app_co) {

                $name_submitted = $app_co->loginname;
                $to_name = $getname->loginname;
                $to_mail = $getname->emailadd;
                $to_date = date('d/m/Y h:i A');
                if($status == 1){
                    $status_word = 'approved';
                }elseif($status == 2){
                    $status_word = 'rejected';
                }elseif($status == 4){
                    $status_word = 'forwarded';
                } 

                $link = url('/application/view_details/'.$app_id, '', $secure = null);;
                $check = 'approve_notification';
                $subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;

                $mail_data = array(
                    'to_name' => $to_name, 
                    'to_email' => $to_mail,
                    'name_submitted' => $name_submitted,
                    'date' => $to_date,
                    'app_link' => $link,
                    'check_status' => $status_word,
                    'case_number' => $case_number,
                    'check' => $check 
                );

                $this->send_email('mail.mail', $mail_data, $app_co, $subject); 
                    
                }

                
                switch ($status) {
                    case '1':
                     return redirect('/application/view_details/'.$app_id)
                        ->with('success_message', 'Case '.$case_number.' has been approved!');
                    case '4':
                     return redirect('/application/view_details/'.$app_id)
                        ->with('info_message', 'Case '.$case_number.' has been forwarded!');
                    case '2':
                     return redirect('/application/view_details/'.$app_id)
                        ->with('success_message', 'Case '.$case_number.' has been rejected!');
                }

            }
        }

        } else {

            return redirect('/application/view_details/'.$app_id)
                        ->withErrors($validator)
                        ->withInput();
         }

    }
}
