<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\ControllerCore;
use App\Http\Requests\AddUserRequest;
use App\Factories\ModelFactory;
use App\Http\Models\Course;
use App\Http\Models\Timetable;
use Hash;

class CourseController extends ControllerCore
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
          'code' => Course::codeRule(),
          'name' => Course::nameRule(),
          'provider' => Course::providerRule(),
          'course_type_id' => Course::courseTypeIdRule(),
          'duration' => Course::durationRule(),
          'budget_availability' => Course::budgetAvailabilityRule(),
          'isfunds' => Course::isFundsRule(),
          'funds' => Course::fundsRule(),
          'fee' => Course::feeRule(),
          'minimum_attendee' => Course::minimumAttendeeRule(),
          'maximum_attendee' => Course::maximumAttendeeRule(),
          'description' => Course::descriptionRule(),
        ]);

        $validator->setPresenceVerifier($verifier);

        if ($validator->fails()) {
            return redirect('tes/course/course-list/add-course')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            // save course
            $courseModel = ModelFactory::getInstance('Course');
            $courseModel->code = $request->code;
            $courseModel->name = $request->name;
            $courseModel->provider = $request->provider;
            $courseModel->course_type_id = $request->course_type_id;
            $courseModel->duration = $request->duration;
            $courseModel->budget_availability = $request->budget_availability;
            $courseModel->isfunds = $request->isfunds;
            $courseModel->funds = $request->funds;
            $courseModel->fee = $request->fee;
            $courseModel->minimum_attendee = $request->minimum_attendee;
            $courseModel->maximum_attendee = $request->maximum_attendee;
            $courseModel->description = $request->description;
            if($courseModel->save()){
              //auto generate one default questionnaire
              $questonnaireModel = ModelFactory::getInstance('Questionnaire');
              $questonnaireModel->course_id = $courseModel->id;
              $questonnaireModel->name = 'v1';
              $questonnaireModel->save();

              $courseupdateModel = ModelFactory::getInstance('Course')
                          ->find($courseModel->id);

              $courseupdateModel->questionnaire_id = $questonnaireModel->id;
              $courseupdateModel->save();

              // save course success

              // save timetable
              foreach($request->start_date as $index=>$row){
                  $timetableModel = ModelFactory::getInstance('Timetable');
                  $timetableModel->course_id = $courseModel->id;
                  $timetableModel->start_date = $row;
                  $timetableModel->end_date = $request->end_date[$index];
                  $timetableModel->location = $request->location[$index];
                  if($timetableModel->save());
              }

                 return redirect('tes/course/course-list/add-course')
                        ->with('success', 'Successfully added course.');
            }
        }
    }

    public function update(Request $request)
    {
      $verifier = \App::make('validation.presence');

      $verifier->setConnection('mysql');
      $validator = \Validator::make($request->all(), [
        'code' => Course::editCodeRule($request->id),
        'name' => Course::editNameRule($request->id),
        'provider' => Course::providerRule(),
        'course_type_id' => Course::courseTypeIdRule(),
        'duration' => Course::durationRule(),
        'budget_availability' => Course::budgetAvailabilityRule(),
        'isfunds' => Course::isFundsRule(),
        'funds' => Course::fundsRule(),
        'fee' => Course::feeRule(),
        'minimum_attendee' => Course::minimumAttendeeRule(),
        'maximum_attendee' => Course::maximumAttendeeRule(),
        'description' => Course::descriptionRule(),
      ]);

      $validator->setPresenceVerifier($verifier);

      if ($validator->fails()) {
          return redirect('tes/course/course-list/edit-course/'.$request->id)
                      ->withErrors($validator)
                      ->withInput();
        } else {
            // save user info
            // save course
            $courseModel = ModelFactory::getInstance('Course')
                        ->find($request->id);

            $courseModel->code = $request->code;
            $courseModel->name = $request->name;
            $courseModel->provider = $request->provider;
            $courseModel->course_type_id = $request->course_type_id;
            $courseModel->duration = $request->duration;
            $courseModel->budget_availability = $request->budget_availability;
            $courseModel->isfunds = $request->isfunds;
            $courseModel->funds = $request->funds;
            $courseModel->fee = $request->fee;
            $courseModel->minimum_attendee = $request->minimum_attendee;
            $courseModel->maximum_attendee = $request->maximum_attendee;
            $courseModel->description = $request->description;
            if($courseModel->save()){

              // save timetable
              $course_id = $request->course_id;

              //update
              $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
              foreach($selectedTimetableModel as $row){
                if(in_array($row->id,$course_id)){
                  $index = array_search($row->id,$course_id);
                  $timetableModel = ModelFactory::getInstance('Timetable')->find($row->id);
                  $timetableModel->start_date = $request->start_date[$index];
                  $timetableModel->end_date = $request->end_date[$index];
                  $timetableModel->location = $request->location[$index];
                  $timetableModel->save();
                }
              }

              //update old
              // $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
              // foreach($selectedTimetableModel as $rowx){
              //   foreach($request->course_id as $index=>$rowy){
              //     if($rowx->id = $rowy){
              //       $timetableModel = ModelFactory::getInstance('Timetable')->find($rowx->id);
              //       $timetableModel->start_date = $request->start_date[$index];
              //       $timetableModel->end_date = $request->end_date[$index];
              //       $timetableModel->location = $request->location[$index];
              //       $timetableModel->save();
              //     }
              //   }
              // }

              // create
              foreach($request->course_id as $index=>$row){
                if($row == 'new'){
                  $timetableModel = ModelFactory::getInstance('Timetable');
                  $timetableModel->course_id = $courseModel->id;
                  $timetableModel->start_date = $request->start_date[$index];
                  $timetableModel->end_date = $request->end_date[$index];
                  $timetableModel->location = $request->location[$index];
                  $timetableModel->save();
                  $course_id[$index] = (string)$timetableModel->id;
                }
              }

              // delete
              $selectedTimetableModel = ModelFactory::getInstance('Timetable')->where('course_id','=',$request->id)->get();
              foreach($selectedTimetableModel as $rowx){
                if(!in_array($rowx->id,$course_id)){
                  $user = Timetable::find($rowx->id);
                  $user->delete();
                }
              }

                 return redirect('tes/course/course-list/edit-course/'.$request->id)
                        ->with('success', 'Successfully edited course.');
            }
        }
    }

    public function destroy($id)
    {
        // delete user device
        try {
                $user = ModelFactory::getInstance('Course')
                        ->where('id','=',$id)
                        ->delete();

                return redirect('tes/course/course-list/')
                        ->with('success', 'Successfully removed course.');

        }catch (QueryException $e ) {
            $this->error($e->getMessage());
        }
    }

}
