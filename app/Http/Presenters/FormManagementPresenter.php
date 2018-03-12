<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class FormManagementPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->view->title = 'Form Management';
        return $this->view('tes.form-management.index');
    }

    //to be deleted
    public function questionnaire($id)
    {
      $this->view->title = 'Fill in the form';
      $this->view->selected_questionnaire = \App\Http\Models\Questionnaire::selectedQuestionnaire($id);
      $this->view->selected_questionnaire_detail = \App\Http\Models\QuestionnaireDetail::selectedQuestionnaireDetail($id);

      return $this->view('tes.form-management.questionnaire');
    }

    public function questionnaireList()
    {
        $this->view->title = 'Questionnaire List';
        return $this->view('tes.form-management.questionnaire-list.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $this->view->course_list_array = \App\Http\Models\Course::courseListArray();
      $this->view->title = 'Add Questionnaire';
      return $this->view('tes.form-management.questionnaire-list.add-questionnaire');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }
}
