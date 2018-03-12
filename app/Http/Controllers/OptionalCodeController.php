<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class OptionalCodeController extends ControllerCore
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
            'name' => 'required|Size:3|alpha|unique:ams_optionalcode,name'
          
        ]);


        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('optionalcode/createoptionalcode')
                        ->withErrors($validator)
                        ->withInput();
        } else {
        // save optionalcode info
            $optionalcode = ModelFactory::getInstance('OptionalCode');
            
            $optionalcode->name = $request->name;
            $optionalcode->description = $request->description;
         
       
       
            
            if($optionalcode->save()){
                 return redirect('optionalcode/createoptionalcode')
                        ->with('success', 'Successfully created optional code.');
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
            'name' => 'required|Size:3|alpha'
           
        ]);



        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('optionalcode/editoptionalcode/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save optionalcode info
            $optionalcode = ModelFactory::getInstance('OptionalCode')
                         ->find($request->id);
            
            $optionalcode->name = $request->name;
            $optionalcode->description = $request->description;
            

            if($optionalcode->save()){
                 return redirect('optionalcode/editoptionalcode/'.$request->id)
                        ->with('success', 'Successfully updated optional code.');
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
                $optionalcode = ModelFactory::getInstance('OptionalCode')
                        ->where('id','=',$id)
                        ->delete();
                
                return redirect('optionalcode')
                        ->with('success', 'Successfully deleted optional code #'.$id);

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }
}
