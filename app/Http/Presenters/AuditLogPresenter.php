<?php

namespace App\Http\Presenters;
use App\Http\Models\Application;
use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use flash;
use OwenIt\Auditing\Log;
class AuditLogPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $search = \Request::get('search'); //<-- we use global request to get the param of URI
      $search_start = \Request::get('search_start');
      $search_end = \Request::get('search_end');
      $user = ModelFactory::getInstance('User')->where('loginid','like','%'.$search.'%')->first();

       // Fetch audits of a Post
      if($user)
      {
        $logs = Log::with(['user'])->where('user_id','=',$user->idsrc_login)
                ->where('created_at','>=',date('Y-m-d H:i:s', strtotime($search_start)))
                ->where('created_at','<=',date('Y-m-d H:i:s', strtotime($search_end)))
                ->get();
      }
      else
      {
        $logs = Log::with(['user'])->get();
      }

      // add search filter for optional code
      $searchFilter = FilterFactory::getInstance('Text','Search');

      $this->view->searchFilter = $searchFilter;
      $this->view->logs = $logs;
      $this->view->title = 'Audit Log ';

      return $this->view('auditlog.index');
    }
}
