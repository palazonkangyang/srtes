<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use Hash;

class GlobalSettingController extends ControllerCore
{

	/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
   

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
            'value' => 'required'
           
        ]);



        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('globalsetting/editglobalsetting/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save globalsetting info
            $globalsetting = ModelFactory::getInstance('GlobalSetting')
                         ->find($request->id);
            
           
            $globalsetting->value = $request->value;

            if($globalsetting->save()){
                 return redirect('globalsetting/editglobalsetting/'.$request->id)
                        ->with('success', 'Successfully updated global setting.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

}
