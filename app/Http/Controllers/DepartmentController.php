<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class DepartmentController extends ControllerCore
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
            'deptname' => 'required|max:255|min:3|unique:departments,department',
            'deptdesc' => 'required|max:255|min:3|unique:departments,deptdesc',
        	'department_head' => 'required'
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('department/createdepartment')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        // save department info
            $department = ModelFactory::getInstance('Department');
            
            $department->department = $request->deptname;
            $department->deptdesc = $request->deptdesc;
            $department->dept_head = $request->user_id;
            $department->dept_ro = $request->user2_id;
            
            if($department->save()){
                 return redirect('department/createdepartment')
                        ->with('success', 'Successfully created department.');
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
            'deptname' => 'required|max:255|min:2|unique:departments,department,'.$request->id . ',idsrc_departments',
            'deptdesc' => 'required|max:255|min:2|unique:departments,deptdesc,'.$request->id . ',idsrc_departments',
        	'department_head' => 'required'
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('department/editdepartment/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save department info
            $department = ModelFactory::getInstance('Department')
                         ->find($request->id);
            
            $department->department = $request->deptname;
            $department->deptdesc = $request->deptdesc;
            $department->dept_head = $request->user_id;
             $department->dept_ro = $request->user2_id;

            if($department->save()){
                 return redirect('department/editdepartment/'.$request->id)
                        ->with('success', 'Successfully created department.');
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
        // delete user device
        try {
                $user = ModelFactory::getInstance('Department')
                        ->where('idsrc_departments','=',$id)
                        ->delete();
                
                return redirect('department')
                        ->with('success', 'Successfully Deleted User #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }
}
