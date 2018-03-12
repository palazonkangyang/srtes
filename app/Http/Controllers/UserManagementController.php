<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class UserManagementController extends ControllerCore
{

	/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $verifier = \App::make('validation.presence');

        $verifier->setConnection('mysql2');

        $validator = \Validator::make($request->all(), [
            'fullname' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|min:3|unique:users,emailadd',
            'username' => 'required|max:255|min:3|unique:users,loginid',
              'employeeid' => 'required|max:255|min:3|unique:users,employeeid',
            'status' => 'required',
            'role' => 'required',
            'department' => 'required',
            'new_password' => 'required|confirmed|max:255|min:7',
            'new_password_confirmation' => 'required|max:255',
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('management/adduser')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save user info
            $userModel = ModelFactory::getInstance('User');
            
            $userModel->loginname = $request->fullname;
            $userModel->emailadd = $request->email;
            $userModel->loginid = $request->username;
            $userModel->employeeid = $request->employeeid;
            $userModel->passwd = Hash::make($request->new_password);
            $userModel->isactive = $request->status;
            $userModel->deptid = $request->department;
            $userModel->roleid = $request->role;
            $userModel->modby = \Auth::User()->loginid;

            if($userModel->save()){
                 return redirect('management/adduser')
                        ->with('success', 'Successfully created user.');
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
      
        $verifier = \App::make('validation.presence');

        $verifier->setConnection('mysql2');

        $validator = \Validator::make($request->all(), [
            'fullname' => 'required|max:255|min:3',
            'email' => 'required|email|max:255|min:3|unique:users,emailadd,'.$request->id . ',idsrc_login',
            'username' => 'required|max:255|min:3|unique:users,loginid,'.$request->id . ',idsrc_login',
             'employeeid' => 'required|max:255|min:3|unique:users,employeeid,'.$request->id . ',idsrc_login',
            'status' => 'required',
            'role' => 'required',
            'department' => 'required',
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('management/edituser/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save user info
            $userModel = ModelFactory::getInstance('User')
                        ->find($request->id);
            
            $userModel->loginname = $request->fullname;
            $userModel->emailadd = $request->email;
            $userModel->loginid = $request->username;
              $userModel->employeeid =$request->employeeid;
            $userModel->isactive = $request->status;
            $userModel->deptid = $request->department;
            $userModel->roleid = $request->role;
            $userModel->modby = \Auth::User()->loginid;

            if($userModel->save()){
                 return redirect('management/edituser/'.$request->id)
                        ->with('success', 'Successfully updated user.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete user 
        try {
                $user = ModelFactory::getInstance('User')
                        ->where('idsrc_login',$id)
                        ->update(['isactive' => 0]);
                        //->delete();
                
                return redirect('management')
                        ->with('success', 'Successfully Deleted User #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function activate($id)
    {
        // delete user 
        try {
                $user = ModelFactory::getInstance('User')
                        ->where('idsrc_login',$id)
                        ->update(['isactive' => 1]);
                        //->delete();
                
                return redirect('management/edituser/'.$id)
                        ->with('success', 'Successfully Activate User #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }

    }
}
