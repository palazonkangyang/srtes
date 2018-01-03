<?php

namespace App\Http\Controllers;

use App\Core\PresenterCore;
use App\Core\ControllerCore;
use App\Factories\TypeFactory;
use App\Factories\ModelFactory;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Response;
use Carbon\Carbon;
use Storage;
use Mail;

class AccountController extends ControllerCore
{
    public function postLogin(LoginRequest $request){
        
        $user_email = $request->input('username_email');
        $password = $request->input('password');


        if(filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['emailadd' => $user_email , 'password' => $password, 'isactive' => 1])) {
                  $user = ModelFactory::getInstance('User')
                            ->findOrNew(Auth::User()->idsrc_login);
        $user->postlogin =  date('Y-m-d H:i:s');
        if($user->save()){
                return redirect()->intended('/dashboard');
        }
            }
            else {
                return redirect('/login')
                ->withInput($request->only('username_email'))
                ->withErrors([
                    'email' => 'The credentials you entered did not match our records. Try again?',
                ]);
            }
        }
        else {
            if (Auth::attempt(['loginid' => $user_email , 'password' => $password, 'isactive' => 1])) {
                       $user = ModelFactory::getInstance('User')
                            ->findOrNew(Auth::User()->idsrc_login);
        $user->postlogin =  date('Y-m-d H:i:s');
        if($user->save()){
                return redirect()->intended('/dashboard');
        }
            }
            else {
                return redirect('/login')
                    ->withInput($request->only('username_email'))
                    ->withErrors([
                    'email' => 'The credentials you entered did not match our records. Try again?',
                ]);
            }
        }
    }
   
   public function logout(Request $request){            
        $user = ModelFactory::getInstance('User')
                            ->findOrNew(Auth::User()->idsrc_login);
        $user->lastlogin =  date('Y-m-d H:i:s');

        if($user->save()){
            Auth::logout(); 
            Session::flush();
            return redirect('/');
        }
    }

    /**
     * Reset user password
     * @param Request $request
     */
    public function resetPassword(Request $request)
    {
        $user = ModelFactory::getInstance('User')
                    ->where('emailadd','=',$request->get('email'))
                    ->first();
        
        $this->validate($request, [
                'email' => 'required|max:255',
        ]);

        if(!$user)
        {
            return redirect('/resetpassword')
                        ->withInput($request->only('email'))
                        ->withErrors([
                                'error' => 'Email address is invalid'
                        ]);
        }
        
        $newPass = str_random(20);
        $user->passwd = Hash::make($newPass);
        $user->pwdreset = $user->pwdreset + 1;
        $user->save();

        $data = [
                'name' => $user->loginname,
                'from' => 'Redcross System Administration',
                'password' => $newPass,
        ];
        
        $email = $user->emailadd;

        \Mail::send('mail.reset', $data, function ($m) use ($email) {
            $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $m->to($email)->subject('Forgot Password');
        });     
        
        return redirect('/login')->with('successMsg','New password has been send to your email.');
    }

    /**
     * Change user password
     * @param Request $request
     */
    public function changePassword(ChangePasswordRequest $request)
    {   
       if (Auth::attempt(['emailadd' => Auth::user()->emailadd, 'password' => $request->get('old_password')])) {
            $user = ModelFactory::getInstance('User')
                            ->findOrNew(Auth::User()->idsrc_login);
            $user->passwd = bcrypt($request->get('new_password'));

            if($user->save()){
                return redirect('/changepassword')
                    ->withInput()->with('success', 'Successfully changed password.');
            }else {
                return redirect('/changepassword')
                   ->withErrors(['error' => 'Something wrong! failed to change new password',
            ]);  
            }
        } else {
            return redirect('/changepassword')
                   ->withErrors(['error' => 'Old password does not match with your current password',
            ]);
        } 
    }

     /**
     * Acount Settings
     * @param Request $request
     */
    public function accountSettings(Request $request)
    {   
        $id = Auth::User()->idsrc_login;
        $ooo = $request->ooo;

        $user = ModelFactory::getInstance('User')->find($id);
        $user->inoffice = $ooo;

        $getname = $this->selectUserBy(Auth::User()->idsrc_login, array('loginname'));
        $mail_data = array();

        if($user->save()) {

            $getapprover = ModelFactory::getInstance('Approver')
            ->join('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')

            ->where('ams_approver_person.user_id', '=', $id)
            ->where('ams_approver_person.read', '=', 0)
            ->Where('ams_applications.status', '=', 0)

            ->distinct()
            ->get()->toArray(); 

            $prefix = ($ooo == 1 ? 1 : 0);

            foreach ($getapprover as $key => $value) {
                $creator =  $this->selectUserBy($value['created_id'],array('loginname','emailadd'))->toArray();
                $ooo =  $this->selectUserBy($id,array('loginname','emailadd'))->toArray();
                $app_id = $value['app_id'];

                /*notify mail*/
                $name_submitted = $ooo['loginname'];
                $name_submitted_email = $ooo['emailadd'];
                $to_name = $creator['loginname'];
                $to_mail = $creator['emailadd'];
                $to_date =    date('d/m/Y h:i A');

                $link = url('/application/view_details/'.$app_id, '', $secure = null);
                $check = 'inoffice_'.$prefix;
                $subject = '[SRC-AMS] Out Of Office Notification';

                $mail_data = array(
                'to_name' => $to_name, 
                'to_email' => $to_mail,
                'name_submitted' => $name_submitted,
                'name_submitted_email' => $name_submitted_email,
                'date' => $to_date,
                'app_link' => $link,
                'check' => $check );

                $this->send_email('mail.mail', $mail_data, $creator , $subject);

            }

            return Response::json(array('flag' => $ooo), 200);
        }
    }


    public function updateProfile(Request $request){

        $verifier = \App::make('validation.presence');

        $verifier->setConnection('mysql2');

        $validator = \Validator::make($request->all(), [
            'fullname' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|min:3|unique:users,emailadd,'.$request->id . ',idsrc_login',
            'username' => 'required|max:255|min:3|unique:users,loginid,'.$request->id . ',idsrc_login',
            'status' => 'required',
            'department' => 'required',
            // 'role' => 'required',
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('account/myprofile')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save user info
            $userModel = ModelFactory::getInstance('User')
                        ->find($request->id);
            
            $userModel->loginname = $request->fullname;
            $userModel->emailadd = $request->email;
            $userModel->loginid = $request->username;
            $userModel->isactive = $request->status;
            // $userModel->roleid = $request->role;
            $userModel->deptid = $request->department;
            $userModel->modby = \Auth::User()->loginid;

            if($userModel->save()){
                 return redirect('account/myprofile')
                        ->with('success', 'Successfully updated user.');
            }
        }
    }

    public function send_email($layout, $data, $criteria, $subject){

        Mail::send($layout,$data,function($message) use ($criteria, $subject){
            $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $message->to($criteria['emailadd'])->subject($subject);
        });
    }

    public function delay_email($sec, $layout, $data, $criteria, $subject){

        Mail::later($sec, $layout,$data,function($message) use ($criteria, $subject){
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