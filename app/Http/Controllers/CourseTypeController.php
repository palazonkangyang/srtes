<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use App\Http\Models\CourseType;
use Hash;

class CourseTypeController extends ControllerCore
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
            'name' => CourseType::nameRule()
      ]);

      $validator->setPresenceVerifier($verifier);

      if ($validator->fails())
      {
        return redirect('tes/course/course-type/add-course-type')
                        ->withErrors($validator)
                        ->withInput();
      }

      else
      {
        // save course type
        $coursetypeModel = ModelFactory::getInstance('CourseType');
        $coursetypeModel->name = $request->name;
        $coursetypeModel->save();

        return redirect('tes/course/course-type/add-course-type')
                        ->with('success', 'Successfully added course type.');
      }
    }

    public function update(Request $request)
    {
      $verifier = \App::make('validation.presence');

      $verifier->setConnection('mysql');
      $validator = \Validator::make($request->all(), [
          'name' => CourseType::editNameRule($request->id)
      ]);

      $validator->setPresenceVerifier($verifier);

      if ($validator->fails())
      {
        return redirect('tes/course/course-type/edit-course-type/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
      }

      else
      {
        // update course type
        $coursetypeModel = ModelFactory::getInstance('CourseType')->find($request->id);
        $coursetypeModel->name = $request->name;
        $coursetypeModel->save();

        return redirect('tes/course/course-type/edit-course-type/'.$request->id)
                        ->with('success', 'Successfully edited course type.');
      }
    }

    public function questionnaire_update(Request $request)
    {
      $input = array_except($request->all(), '_token');

      $verifier = \App::make('validation.presence');
      $verifier->setConnection('mysql');
      $validator = \Validator::make($request->all(), [
        'question' => \App\Http\Models\CourseTypeQuestionnaireDetail::questionRule(),
        'answer_input_type' => \App\Http\Models\CourseTypeQuestionnaireDetail::answerInputTypeRule(),
        'answer_input_value' => \App\Http\Models\CourseTypeQuestionnaireDetail::answerInputValueRule(),
      ]);

       $validator->setPresenceVerifier($verifier);

       if ($validator->fails())
       {
         return redirect('tes/course/course-type/edit-questionnaire/'. $request->course_type_id)
                 ->withErrors($validator)
                 ->withInput();
       }

       else {
         //Remove QuestionnaireDetail Line and Insert again
         $QuestionnaireDetailRemove = ModelFactory::getInstance('CourseTypeQuestionnaireDetail')->where('course_type_id','=',$request->course_type_id)->delete();

           foreach($request->question as $index=>$row)
           {
             $model = ModelFactory::getInstance('CourseTypeQuestionnaireDetail');

             if($request->answer_input_type[$index] == 5)
             {
               $model->course_type_id = $request->course_type_id;
               $model->question = $request->question[$index];
               $model->answer_input_type = $request->answer_input_type[$index];
               $model->additional_text = $request->additional_text[$index];
               $model->description_title = $request->description_title[$index];
               $model->description_value = $request->answer_input_value[$index];
               $model->save();
             }
             
             else
             {
               $model->course_type_id = $request->course_type_id;
               $model->question = $request->question[$index];
               $model->answer_input_type = $request->answer_input_type[$index];
               $model->answer_input_value = $request->answer_input_value[$index];
               $model->save();
             }
           }

         return redirect('tes/course/course-type/edit-questionnaire/'. $request->course_type_id)
                 ->with('success', 'Successfully edited questionnaire.');
       }
    }
}
