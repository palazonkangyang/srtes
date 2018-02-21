<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use App\Http\Models\Designation;
use Hash;

class DesignationController extends ControllerCore
{
  /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
  public function store(Request $request)
  {
    $verifier = \App::make('validation.presence');

    $verifier->setConnection('mysql');
    $validator = \Validator::make($request->all(), [
          'name' => Designation::nameRule()
    ]);

    $validator->setPresenceVerifier($verifier);

    if ($validator->fails())
    {
      return redirect('tes/course/designation/add-designation')
                      ->withErrors($validator)
                      ->withInput();
    }

    else
    {
      // save designation
      $designationModel = ModelFactory::getInstance('Designation');
      $designationModel->name = $request->name;
      $designationModel->save();

      return redirect('tes/course/designation/add-designation')
                      ->with('success', 'Successfully added designation.');
    }
  }

  public function update(Request $request)
  {
    $verifier = \App::make('validation.presence');

    $verifier->setConnection('mysql');
    $validator = \Validator::make($request->all(), [
        'name' => Designation::editNameRule($request->id)
    ]);

    $validator->setPresenceVerifier($verifier);

    if ($validator->fails())
    {
      return redirect('tes/course/designation/edit-designation/'.$request->id)
                      ->withErrors($validator)
                      ->withInput();
    }

    else
    {
      // update designation
      $designationModel = ModelFactory::getInstance('Designation')->find($request->id);
      $designationModel->name = $request->name;
      $designationModel->save();

      return redirect('tes/course/designation/edit-designation/'.$request->id)
                      ->with('success', 'Successfully edited designation.');
    }
  }

  public function deleteDesignation($id)
  {
    // delete designation
    try
    {
      $designation = ModelFactory::getInstance('Designation')
                            ->where('id','=',$id)
                            ->delete();

      return redirect('tes/course/designation/')
              ->with('success', 'Successfully removed designation.');

    }

    catch (QueryException $e )
    {
      $this->error($e->getMessage());
    }
  }
}
