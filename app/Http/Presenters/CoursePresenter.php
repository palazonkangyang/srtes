<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use App\Http\Models\Course;
use App\Http\Models\Questionnaire;
use App\Http\Models\CourseType;
use App\Http\Models\Timetable;
use Illuminate\Http\Request;
use Response;
use DB;

class CoursePresenter extends PresenterCore
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $this->view->title = 'Course';
    return $this->view('tes.course.index');
  }

  public function courseList()
  {
    $course_array = [];

    $prepare = ModelFactory::getInstance('Course')->query();
    $prepare = $prepare->join('tes_course_type', function ($join) {
               $join->on('tes_course.course_type_id', '=', 'tes_course_type.id');})
                    ->select(
                     'tes_course.id',
                     'tes_course.name',
                     'tes_course.description',
                     'tes_course.course_type_id',
                     'tes_course_type.name as course_type_name',
                     'tes_course.code',
                     'tes_course.duration',
                     'tes_course.minimum_attendee',
                     'tes_course.maximum_attendee',
                     'tes_course.questionnaire_id'
                    );

    $result = $prepare->get();

    foreach($result as $data)
    {
      array_push($course_array, $data->id);
    }

    // add search filter for course
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchCourse');
    $this->view->searchFilter = $searchFilter;
    $this->view->course_list = $this->paginate($prepare);
    $this->view->title = 'Course List';

    for($i = 0; $i < count($course_array); $i++)
    {
      $result = ModelFactory::getInstance('FormTsw')->where('course_id')->first();

      if($result)
      {
        $this->view->course_list[$i]->register = ModelFactory::getInstance('FormTsw')->where('course_id', $course_array[$i])->count();
      }

      else
      {
        $this->view->course_list[$i]->register = 0;
      }

      $this->view->course_list[$i]->complete = ModelFactory::getInstance('Application')
                                                ->leftjoin('ams_form_tsw', 'ams_form_tsw.app_id', '=', 'ams_applications.id')
                                                ->where('course_id', $course_array[$i])
                                                ->where('status', 7)
                                                ->count();
    }

    $this->view->questionarie_answer_no = ModelFactory::getInstance('QuestionnaireAnswer')
                                          ->select('questionnaire_id')
                                          ->groupBy('questionnaire_id')
                                          ->get();

    for($i = 0; $i < count($this->view->course_list); $i++)
    {
      for($j = 0; $j < count($this->view->questionarie_answer_no); $j++)
      {
        if($this->view->course_list[$i]->questionnaire_id == $this->view->questionarie_answer_no[$j]->questionnaire_id)
        {
          $this->view->course_list[$i]->hasreport = "true";
        }
      }
    }

    return $this->view('tes.course.course-list.index');
  }

  public function questionnaire_reportList($id)
  {
    // add search filter for course
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;
    $questionnaire = Questionnaire::find($id);
    $this->view->selected_course_list = Course::selectedCourseList($questionnaire->course_id);

    $this->view->QuestionnaireDetailList = ModelFactory::getInstance("QuestionnaireDetail")
                                           ->where('questionnaire_id', $id)
                                           ->get();

    $this->view->QuestionnaireAnswerList = ModelFactory::getInstance("QuestionnaireAnswer")
                                            ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_detail.id', '=', 'tes_questionnaire_answer.questionnairedetail_id')
                                            ->where('tes_questionnaire_detail.questionnaire_id', $id)
                                            ->get();

    // show 15 questionnaire list
    for ($z = 0; $z < count($this->view->QuestionnaireDetailList); $z++)
    {
      if($z == 0)
      {
        $this->view->answerReport1 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 1)
      {
        $this->view->answerReport2 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 2)
      {
        $this->view->answerReport3 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 3)
      {
        $this->view->answerReport4 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 4)
      {
        $this->view->answerReport5 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 5)
      {
        $this->view->answerReport6 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 6)
      {
        $this->view->answerReport7 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 7)
      {
        $this->view->answerReport8 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 8)
      {
        $this->view->answerReport9 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else if($z == 9)
      {
        $this->view->answerReport10 = ModelFactory::getInstance('QuestionnaireAnswer')
                                      ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_answer.questionnairedetail_id', '=', 'tes_questionnaire_detail.id')
                                      ->where('tes_questionnaire_answer.questionnairedetail_id', '=', $this->view->QuestionnaireAnswerList[$z]->id)
                                      ->where('tes_questionnaire_detail.questionnaire_id', '=', $id)
                                      ->get();
      }

      else{
      }
    }

    $prepare = ModelFactory::getInstance('FormTsw')
                ->leftjoin('ams_applications', 'ams_applications.id', '=', 'ams_form_tsw.app_id')
                ->leftjoin('srcusers.users', 'ams_applications.created_id', '=', 'srcusers.users.idsrc_login')
                ->whereIn('ams_applications.status', [6,7])
                ->where('ams_applications.type_form', '=', 16)
                ->select(
                  'ams_applications.id',
                  'ams_applications.department',
                  'ams_applications.status',
                  'srcusers.users.loginname',
                  'ams_applications.case_number',
                  'ams_applications.status'
                );

    // add search filter for course
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $this->view->searchFilter = $searchFilter;
    $this->view->questionnaire_list = $this->paginate($prepare);
    $this->view->title = 'Questionnaire Report - '.$this->view->selected_course_list->name.'('.$this->view->selected_course_list->code.')';

    return $this->view('tes.course.course-list.questionnaire_report');
  }

  public function create()
  {
    $this->view->course_type_list = CourseType::courseTypeList();
    $this->view->title = 'Add Course';
    return $this->view('tes.course.course-list.add-course');
  }

  public function edit($id)
  {
    $this->view->selected_course_list = Course::selectedCourseList($id);
    $this->view->course_type_list = CourseType::courseTypeList();
    $this->view->selected_timetable_list = Timetable::selectedTimetableList($id);

    $this->view->title = 'Edit Course';
    return $this->view('tes.course.course-list.edit-course');
  }


  public function editquestionnaire($id)
  {
    $questionnaire = Questionnaire::find($id);
    $this->view->selected_course_list = Course::selectedCourseList($questionnaire->course_id);
    $this->view->QuestionnaireDetailList = ModelFactory::getInstance("QuestionnaireDetail")
                                           ->where('questionnaire_id', $id)
                                           ->get();

    $this->view->QuestionnaireAnswerList = ModelFactory::getInstance("QuestionnaireAnswer")
                                           ->leftjoin('tes_questionnaire_detail', 'tes_questionnaire_detail.id', '=', 'tes_questionnaire_answer.questionnairedetail_id')
                                           ->where('tes_questionnaire_detail.questionnaire_id', $id)
                                           ->get();

    $this->view->title = 'Edit Questionnaire';
    return $this->view('tes.course.course-list.edit-questionnaire');
  }

  public function courseTimetable()
  {
    $this->view->title = 'Course Timetable';
    return $this->view('tes.course.timetable.index');
  }

  public function courseCompletionStatus()
  {
    $prepare = ModelFactory::getInstance('Course')->get();

    foreach($prepare as $a){
      $a["number_of_batch"] = \App\Http\Models\Timetable::where("course_id", "=", $a->id)->count();
    }

    $this->view->course_list = $prepare;
    $this->view->title = 'Course Completion Status';
    return $this->view('tes.course.course-completion-status.index');
  }

  public function courseCompletionStatusBatch($id)
  {
    $course['id'] = $id;
    $course['name'] = ModelFactory::getInstance('Course')->select("name")->where("id", "=", $id)->first()['name'];
    $prepare = ModelFactory::getInstance('Timetable')->where("course_id", "=", $id)->get();

    // Completion Status calculation for each batch
    foreach($prepare as $a){

      $batch_id = $a['id'];
      $incomplete = 0;
      $complete = 0;
      $app_id_list = \App\Http\Models\FormTsw::select("app_id")->where("batch_id", "=", $batch_id)->get();

      foreach($app_id_list as $b)
      {
        $status = \App\Http\Models\Application::select("status")->where("id", "=", $b->app_id)->get()[0]['status'];

        if($status == 7)
        {
          $complete ++;
        }

        else{
          $incomplete ++;
        }
      }

      $a['completion_status'] = ($complete / ($complete + $incomplete)) *100 ;
    }

    $this->view->batch_list = $prepare;

    $this->view->course = $course;
    $this->view->title = 'Course Batch List';
    return $this->view('tes.course.course-completion-status.batch.index');
  }

  public function courseCompletionStatusBatchQuestionnaire($id,$batch_id)
  {
    $course['id'] = $id;
    $course['name'] = ModelFactory::getInstance('Course')->select("name")->where("id", "=", $id)->first()['name'];

    $batch['id'] = $batch_id;

    // Completion Status calculation for each batch
    $prepare = \App\Http\Models\FormTsw::select("app_id")->where("batch_id", "=", $batch_id)->get();

    foreach($prepare as $b)
    {
      $status_id = \App\Http\Models\Application::select("status")->where("id", "=", $b->app_id)->get()[0]['status'];

      $b['status_id'] = $status_id;

      if($status_id == 6){
        $b['status_name'] = 'Feedback Required';
      }

      else if($status_id == 7)
      {
        $b['status_name'] = 'Feedback Given';
      }

      else
      {
        $b['status_name'] = '';
      }
    }

    $this->view->attendee_list = $prepare;

    $this->view->course = $course;
    $this->view->batch = $batch;
    $this->view->title = 'Status';
    return $this->view('tes.course.course-completion-status.batch.questionnaire.index');
  }

  public function getjsonCourse(Request $request)
  {
    $result = \App\Http\Models\Course::selectedCourseList($request->course_id);
    $result['timetable'] = \App\Http\Models\Timetable::selectedTimetableList($request->course_id);

    return Response::json($result);
  }

  public function getjsonCourseByCourseTypeId(Request $request)
  {
    $result = \App\Http\Models\Course::searchCourseByCourseTypeId($request->course_type_id);

    return Response::json($result);
  }
}
