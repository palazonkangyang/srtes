<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use App\Http\Models\Course;
use App\Http\Models\CourseType;
use App\Http\Models\Timetable;
use Illuminate\Http\Request;
use Response;

class ReportsPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $this->view->title = 'Report Menu';
      return $this->view('tes.reports.index');
    }

    public function trainingEvaluation()
   {

     $user_id = \Auth::User()->idsrc_login;
     $role = \Auth::User()->roleid;

     $prepare = ModelFactory::getInstance('Application')
         ->where('ams_applications.type_form', '=', 16);



     $this->view->reports = $this->paginate($prepare);
     $this->view->title = 'Training Evaluation';
     return $this->view('tes.reports.training-evaluation');
   }
}
