<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;

class AccountCodePresenter extends PresenterCore
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $prepare = ModelFactory::getInstance('AccountCode')->where('id', '!=', '0');

    // add search filter for account code
    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchKeywordAccountCode');
    $this->view->searchFilter = $searchFilter;

    $this->view->accountcodelist = $this->paginate($prepare);

    $this->view->title = 'Account Code Management';
    return $this->view('accountcode.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $this->view->title = 'Create New Account Code';
    return $this->view('accountcode.create');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $prepare = ModelFactory::getInstance('AccountCode')->where('id', '=', $id)->get();

    $this->view->id = $id;
    $this->view->accountcode = $prepare;
    $this->view->title = 'Edit Account Code';

    return $this->view('accountcode.edit');
  }
}
