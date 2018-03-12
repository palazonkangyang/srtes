<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use App\Http\Models\CourseType;
use App\Http\Models\Questionnaire;
use Illuminate\Http\Request;
use Response;
use DB;

class CourseTypePresenter extends PresenterCore
{
  public function getCourseTypeList()
  {
    $prepare = ModelFactory::getInstance('CourseType')->query();

    // add search filter for course type
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchCourseType');
    $this->view->searchFilter = $searchFilter;

    $this->view->course_type_list = $this->paginate($prepare);
    $this->view->title = 'Course Type List';

    return $this->view('tes.course.course-type.index');
  }

  public function getAddCourseType()
  {
    $this->view->title = "Add Course Type";
    return $this->view('tes.course.course-type.add-course-type');
  }

  public function editCourseType($id)
  {
    $this->view->selected_course_type_list = CourseType::selectedCourseTypeList($id);

    $this->view->title = 'Edit Course Type';
    return $this->view('tes.course.course-type.edit-course-type');
  }

  public function editQuestionnaire($id)
  {
    $this->view->selected_course_type_list = CourseType::selectedCourseTypeList($id);

    $this->view->QuestionnaireDetailList = ModelFactory::getInstance("CourseTypeQuestionnaireDetail")
                                           ->where('course_type_id', $id)
                                           ->get();

    $this->view->QuestionnaireAnswerList = ModelFactory::getInstance("QuestionnaireAnswer")
                                           ->leftjoin('tes_course_type_questionnaire_detail', 'tes_course_type_questionnaire_detail.id', '=', 'tes_questionnaire_answer.questionnairedetail_id')
                                           ->where('tes_course_type_questionnaire_detail.id', $id)
                                           ->get();

    $this->view->title = 'Edit Questionnaire';
    return $this->view('tes.course.course-type.edit-questionnaire');
  }
}
