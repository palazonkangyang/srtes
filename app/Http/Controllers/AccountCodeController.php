<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class AccountCodeController extends ControllerCore
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
            'name' => 'required|Size:6|unique:ams_accountcode,name'

        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('accountcode/createaccountcode')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        // save accountcode info
            $accountcode = ModelFactory::getInstance('AccountCode');

            $accountcode->name = $request->name;
            $accountcode->description = $request->description;
            $accountcode->is3alpha = $request->is3alpha;
            $accountcode->example = $request->example;

       

            if($accountcode->save()){
                 return redirect('accountcode/createaccountcode')
                        ->with('success', 'Successfully created account code.');
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

        $validator = \Validator::make($request->all(), [
            'name' => 'required|Size:6'

        ]);



        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('accountcode/editaccountcode/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save accountcode info
            $accountcode = ModelFactory::getInstance('AccountCode')
                         ->find($request->id);

            $accountcode->name = $request->name;
            $accountcode->description = $request->description;
            $accountcode->is3alpha = $request->is3alpha;
            $accountcode->example = $request->example;

            if($accountcode->save()){
                 return redirect('accountcode/editaccountcode/'.$request->id)
                        ->with('success', 'Successfully updated account code.');
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
                $accountcode = ModelFactory::getInstance('AccountCode')
                        ->where('id','=',$id)
                        ->delete();

                return redirect('accountcode')
                        ->with('success', 'Successfully deleted account code #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }
}
