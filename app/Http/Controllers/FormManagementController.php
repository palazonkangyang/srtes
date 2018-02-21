<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use Hash;

class FormManagementController extends ControllerCore
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
         'name' => \App\Http\Models\Questionnaire::nameRule(),
         'question' => \App\Http\Models\QuestionnaireDetail::questionRule(),
        'answer_input_type' => \App\Http\Models\QuestionnaireDetail::answerInputTypeRule(),
        'answer_input_value' => \App\Http\Models\QuestionnaireDetail::answerInputValueRule(),
      ]);

      $validator->setPresenceVerifier($verifier);

      if ($validator->fails()) {
        return redirect('tes/form-management/questionnaire-list/add-questionnaire')
                ->withErrors($validator)
                ->withInput();
      }

      else {
        $model = ModelFactory::getInstance('Questionnaire');
        $model->name = $request->name;
        $model->course_id = $request->course_id;
        if($model->save()){

          foreach($request->question as $index=>$row){
            $model2 = ModelFactory::getInstance('QuestionnaireDetail');
            $model2->questionnaire_id = $model->id ;
            $model2->question = $request->question[$index];
            $model2->answer_input_type = $request->answer_input_type[$index];
            $model2->answer_input_value = $request->answer_input_value[$index];
            $model2->save();
          }
        }
         return redirect('tes/form-management/questionnaire-list/add-questionnaire')
                ->with('success', 'Successfully added questionnaire.');
      }
    }


    public function questionnaireStore(Request $request,$id){
      $verifier = \App::make('validation.presence');
      $verifier->setConnection('mysql');

      $validator = \Validator::make($request->all(), [
        'question' => \App\Http\Models\QuestionnaireAnswer::questionRule(),
        'answer' => \App\Http\Models\QuestionnaireAnswer::answerRule(),
      ]);

      $validator->setPresenceVerifier($verifier);
      if ($validator->fails()) {
        return redirect('tes/form-management/questionnaire/'.$id)
                ->withErrors($validator)
                ->withInput();
      }

      else {

        foreach($request->question as $index=>$row){
          $model = ModelFactory::getInstance('QuestionnaireAnswer');
          $model->question = $request->question[$index];
          if(is_array($request->answer[$index])){
            $model->answer = implode(",",$request->answer[$index]);
          }
          else{
            $model->answer = $request->answer[$index];
          }

          $model->save();
        }

        return redirect('tes/form-management/questionnaire/'.$id)
               ->with('success', 'Successfully submitted form.');
      }

    }

    public function questionnaire_update(Request $request)
    {
      $input = array_except($request->all(), '_token');

      $verifier = \App::make('validation.presence');
      $verifier->setConnection('mysql');
      $validator = \Validator::make($request->all(), [
        'question' => \App\Http\Models\QuestionnaireDetail::questionRule(),
        'answer_input_type' => \App\Http\Models\QuestionnaireDetail::answerInputTypeRule(),
        'answer_input_value' => \App\Http\Models\QuestionnaireDetail::answerInputValueRule(),
     ]);

     $validator->setPresenceVerifier($verifier);

     if ($validator->fails()) {
       return redirect('tes/course/course-list/edit-questionnaire/'.$request->course_id)
               ->withErrors($validator)
               ->withInput();
     }

     else {
       //Remove QuestionnaireDetail Line and Insert again
       $QuestionnaireDetailRemove = ModelFactory::getInstance('QuestionnaireDetail')->where('course_id','=',$request->course_id)->delete();

       foreach($request->question as $index=>$row)
       {
         $model = ModelFactory::getInstance('QuestionnaireDetail');

         if($request->answer_input_type[$index] == 5)
         {
           $model->course_id = $request->course_id;
           $model->question = $request->question[$index];
           $model->answer_input_type = $request->answer_input_type[$index];
           $model->additional_text = $request->additional_text[$index];
           $model->description_title = $request->description_title[$index];
           $model->description_value = $request->answer_input_value[$index];
           $model->save();
         }

         else
         {
           $model->course_id = $request->course_id;
           $model->question = $request->question[$index];
           $model->answer_input_type = $request->answer_input_type[$index];
           $model->answer_input_value = $request->answer_input_value[$index];
           $model->save();
         }
       }

       return redirect('tes/course/course-list/edit-questionnaire/'.$request->course_id)
               ->with('success', 'Successfully edited questionnaire.');
     }
    }

    public function update(Request $request)
    {
      // $verifier = \App::make('validation.presence');
      //
      // $verifier->setConnection('mysql');
      // $validator = \Validator::make($request->all(), [
      //   'name' => Course::editNameRule($request->id),
      //   'code' => Course::editCodeRule($request->id),
      //   'course_type_id' => Course::courseTypeIdRule(),
      //   'duration' => Course::durationRule(),
      //   'minimum_attendee' => Course::minimumAttendeeRule(),
      //   'maximum_attendee' => Course::maximumAttendeeRule(),
      //   'description' => Course::descriptionRule(),
      // ]);
      //
      // $validator->setPresenceVerifier($verifier);
      //
      // if ($validator->fails()) {
      //     return redirect('tes/course/course-list/edit-course/'.$request->id)
      //                 ->withErrors($validator)
      //                 ->withInput();
      //   } else {
      //       // save user info
      //       // save course
      //       $courseModel = ModelFactory::getInstance('Course')
      //                   ->find($request->id);
      //
      //       $courseModel->name = $request->name;
      //       $courseModel->code = $request->code;
      //       $courseModel->course_type_id = $request->course_type_id;
      //       $courseModel->duration = $request->duration;
      //       $courseModel->minimum_attendee = $request->minimum_attendee;
      //       $courseModel->maximum_attendee = $request->maximum_attendee;
      //       $courseModel->description = $request->description;
      //       if($courseModel->save()){
      //
      //         // save timetable
      //         $course_id = $request->course_id;
      //
      //         //update
      //         $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
      //         foreach($selectedTimetableModel as $row){
      //           if(in_array($row->id,$course_id)){
      //             $index = array_search($row->id,$course_id);
      //             $timetableModel = ModelFactory::getInstance('Timetable')->find($row->id);
      //             $timetableModel->start_date = $request->start_date[$index];
      //             $timetableModel->end_date = $request->end_date[$index];
      //             $timetableModel->location = $request->location[$index];
      //             $timetableModel->save();
      //           }
      //         }
      //
      //         //update old
      //         // $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
      //         // foreach($selectedTimetableModel as $rowx){
      //         //   foreach($request->course_id as $index=>$rowy){
      //         //     if($rowx->id = $rowy){
      //         //       $timetableModel = ModelFactory::getInstance('Timetable')->find($rowx->id);
      //         //       $timetableModel->start_date = $request->start_date[$index];
      //         //       $timetableModel->end_date = $request->end_date[$index];
      //         //       $timetableModel->location = $request->location[$index];
      //         //       $timetableModel->save();
      //         //     }
      //         //   }
      //         // }
      //
      //         // create
      //         foreach($request->course_id as $index=>$row){
      //           if($row == 'new'){
      //             $timetableModel = ModelFactory::getInstance('Timetable');
      //             $timetableModel->course_id = $courseModel->id;
      //             $timetableModel->start_date = $request->start_date[$index];
      //             $timetableModel->end_date = $request->end_date[$index];
      //             $timetableModel->location = $request->location[$index];
      //             $timetableModel->save();
      //             $course_id[$index] = (string)$timetableModel->id;
      //           }
      //         }
      //
      //         // delete
      //         $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
      //         foreach($selectedTimetableModel as $rowx){
      //           if(!in_array($rowx->id,$course_id)){
      //             $user = Timetable::find($rowx->id);
      //             $user->delete();
      //           }
      //         }
      //
      //            return redirect('tes/course/course-list/edit-course/'.$request->id)
      //                   ->with('success', 'Successfully edited course.');
      //       }
      //   }
    }

    public function destroy($id)
    {
        // // delete user device
        // try {
        //         $user = ModelFactory::getInstance('Course')
        //                 ->where('id','=',$id)
        //                 ->delete();
        //
        //         return redirect('tes/course/course-list/')
        //                 ->with('success', 'Successfully removed course.');
        //
        // }catch (QueryException $e ) {
        //     $this->error($e->getMessage());
        // }
    }

}
