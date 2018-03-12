<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use App\Http\Models\Designation;
use Illuminate\Http\Request;
use Response;
use DB;

class DesignationPresenter extends PresenterCore
{
  public function getDesignation()
  {
    $prepare = ModelFactory::getInstance('Designation')->select('id', 'name');

    $this->view->designation_list = $this->paginate($prepare);
    $this->view->title = "Designation List";

    return $this->view('tes.course.designation.index');
  }

  public function addDesignation()
  {
    $this->view->title = "Add Designation";

    return $this->view('tes.course.designation.add-designation');
  }

  public function editDesignation($id)
  {
    $this->view->selected_designation_list = Designation::selectedDesignationList($id);

    $this->view->title = 'Edit Designation';
    return $this->view('tes.course.designation.edit-designation');
  }
}
