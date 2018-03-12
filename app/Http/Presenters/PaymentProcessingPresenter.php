<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\FilterFactory;
use App\Filters\SelectFilter;
use Response;
use Validator;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentProcessingPresenter extends PresenterCore
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
  */
  public function index()
  {
    $this->view->title = 'Payment Processing';
    return $this->view('paymentprocessing.index');
  }

  // reimbursement
  public function reimbursement()
  {
    $this->view->title = 'Reimbursement Dashboard';
    return $this->view('paymentprocessing.reimbursement');
  }

  public function reimbursement_pending()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_pcmcf.project as pcmcf_project_name',
      'ams_form_pcmcf2.project as pcmcf2_project_name',
      'ams_form_pcmcf.payee_name as pcmcf_cheque_payable_to',
    ];

    //Project and other claims/ staff claims only
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [14, 20])
                      ->where('request_id', 1)->get()->toArray();

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_pcmcf', 'ams_form_pcmcf.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_pcmcf2', 'ams_form_pcmcf2.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 0)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Reimbursement - pending';
    return $this->view('paymentprocessing.reimbursement_pending');
  }

  public function reimbursement_processing()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_pcmcf.project as pcmcf_project_name',
      'ams_form_pcmcf.payee_name as pcmcf_cheque_payable_to'
    ];

    //Project and other claims / staff claims only
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm')->select('form_id')
                      ->whereIn('form_id', [14])
                      ->where('request_id', 1)
                      ->get()->toArray();

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_pcmcf', 'ams_form_pcmcf.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 1)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Reimbursement - processing';
    return $this->view('paymentprocessing.reimbursement_processing');
  }

  public function reimbursement2_processing()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_pcmcf2.project as pcmcf2_project_name',
    ];

    //Project and other claims/ staff claims only
    $forms = ModelFactory::getInstance('Forms');

    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [20])
                      ->where('request_id', 1)->get()->toArray();

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_pcmcf2', 'ams_form_pcmcf2.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 1)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Reimbursement - processing';
    return $this->view('paymentprocessing.reimbursement2_processing');
  }

  public function reimbursement_exported()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_pcmcf.project as pcmcf_project_name',
      'ams_form_pcmcf2.project as pcmcf2_project_name',
      'ams_form_pcmcf.payee_name as pcmcf_cheque_payable_to',
    ];

    //Project and other claims / staff claims only
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [14, 20])
                      ->where('request_id', 1)->get()->toArray();

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_pcmcf', 'ams_form_pcmcf.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_pcmcf2', 'ams_form_pcmcf2.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 2)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Reimbursement - exported';
    return $this->view('paymentprocessing.reimbursement_exported');
  }

  public function reimbursement_pending_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/reimbursement_pending')
              ->with('error_message', 'Please select at least one pending reimbursement.');
    }

    $applications = ModelFactory::getInstance('Application')
                     ->whereIn('ams_applications.id', $request->get( '$reports' ))
                     ->get()->toArray();

    //start new
    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his reimbursement is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		    'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'case_number' =>  $pp->case_number,
            'title' =>  $pp->title,
            'name' =>  $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_reimbursement_pending', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your reimbursement is rejected by financial in payment processing!');
        });
      }

      return redirect('/paymentprocessing/reimbursement_pending')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <rejected> and notification email(s) have been send to requestor(s).');
       // processing action
    }

    elseif($request->input('processing'))
    {
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 1;
        $pp->save();

        //send email to inform user that his reimbursement is been processing
        $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    			'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
    	   );

        $email = $user->emailadd;

        \Mail::send('mail.mail_reimbursement_pending', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your reimbursement is processing now!');
        });
      }

      return redirect('/paymentprocessing/reimbursement_pending')
                    ->with('success_message', 'Status of Reimbursement(s) selected have been updated to <processing> and notification email(s) have been send to requestor(s).');
    }
  }

  public function reimbursement_processing_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/reimbursement_processing')
              ->with('error_message', 'Please select at least one processing reimbursement.');
    }

    $applications = ModelFactory::getInstance('Application')
                     ->whereIn('ams_applications.id', $request->get( '$reports' ))
                     ->get()->toArray();

    //start new
    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ( $applications as $application )
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his reimbursement is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_reimbursement_processing', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your reimbursement is rejected by financial in payment processing!');
        });

      }

      return redirect('/paymentprocessing/mail_reimbursement_processing')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <rejected> and notification email(s) have been send to requestor(s).');
      }

      // export action
      elseif($request->input('export'))
      {
        foreach ($applications as $application)
        {
          $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
          $pp->pp_status = 2;
          $pp->save();

          //send email to inform user that his reimbursement is been processing
          $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

          $data = array(
    			  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'case_number' =>  $pp->case_number,
            'title' =>  $pp->title,
            'name' =>  $user->loginname
    	    );

          $email = $user->emailadd;

          \Mail::send('mail.mail_reimbursement_processing', $data , function ($m) use ($email) {
            $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $m->to($email)->subject('Your reimbursement will be inserted into payroll next month!');
          });

        }

        //export line item to sage
        $select = [
          'srcusers.users.idsrc_login as id',
          'srcusers.users.loginname as name',
          'srcusers.users.emailadd as email',
          'srcusers.users.employeeid as employeeid',
          'ams_applications.id',
          'ams_applications.department',
          'ams_applications.type_request',
          'ams_applications.title',
          'ams_applications.urgency',
          'ams_applications.case_number',
          'ams_applications.created_at as created_at',
          'ams_applications.approved_at as approved_at',
          'ams_applications.status',
          'ams_applications.pp_status',
          'ams_applications.total',
          'ams_lineitem_pcmcf.item_total',
          'ams_lineitem_pcmcf.account_code',
          'ams_lineitem_pcmcf.optional_code',
          'ams_forms.name as form_name'
        ];

        $applicationslineitem = ModelFactory::getInstance('LineItemPcmcf')
                                ->leftjoin('ams_applications', 'ams_lineitem_pcmcf.app_id', '=', 'ams_applications.id')
                                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                                ->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
                                ->leftjoin('ams_form_aca', 'ams_form_aca.app_id', '=', 'ams_applications.id')
                                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                                ->whereIn('ams_applications.id', $request->get( '$reports' ))
                                ->select($select)
                                ->get()->toArray();

        \Excel::create('Sage HRM Export', function($excel) use($applicationslineitem) {

          $excel->sheet('Sheetname', function($sheet) use($applicationslineitem) {

            // Array that will be used to generate the sheet
            $sheetArray = array();

            // Add the headers
            $sheetArray[] = array('Case Number','Pay Record ID','Pay Element ID','Amount','Paid Date','Declared Date');

            // Add the results
            foreach($applicationslineitem  as $row)
            {
              $currentmonth15=date('Y-m-d', strtotime(date('Y').'-'.date('m').'-15'));
              $approveddate=date('Y-m-d', strtotime($row['approved_at']));

              if ($approveddate <= $currentmonth15)
              {
                $paiddate = date('Y-m-d', strtotime(date('Y').'-'.date('m').'-28'));
              }

              else
              {
                $nextmonth =date('m') +1 ;
                $paiddate = date('Y-m-d', strtotime(date('Y').'-'.$nextmonth.'-28'));
              }
            }

            $sheetArray[] = array($row['case_number'],'Normal','CLAIMS',$row['item_total'],$paiddate,date('Y-m-d', strtotime($row['created_date'])));

            // Generating the sheet from the array
            $sheet->fromArray($sheetArray, null, 'A1', false, false);
          });

        })->export('xls');

        return redirect('/paymentprocessing/reimbursement_processing')
                ->with('success_message', 'Status of Reimbursement(s) selected have been updated to <exported> and notification email(s) have been send to requestor(s).');
      }
              //end new
  }

  public function reimbursement2_processing_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/reimbursement2_processing')
                    ->with('error_message', 'Please select at least one processing reimbursement.');
    }

    $applications = ModelFactory::getInstance('Application')
                     ->whereIn('ams_applications.id', $request->get( '$reports' ))
                     ->get()->toArray();

    //start new
    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his reimbursement is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.reimbursement2_processing', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your reimbursement is rejected by financial in payment processing!');
        });
      }

      return redirect('/paymentprocessing/reimbursement2_processing')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <rejected> and notification email(s) have been send to requestor(s).');
      }
      // export action
    elseif($request->input('export'))
    {
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 2;
        $pp->save();

        //send email to inform user that his reimbursement is been processing
        $user = ModelFactory::getInstance('User')->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
    	  );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_reimbursement_processing', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your reimbursement will be inserted into payroll next month!');
        });
      }

      //export line item to sage
      $select = [
        'srcusers.users.idsrc_login as id',
        'srcusers.users.loginname as name',
        'srcusers.users.emailadd as email',
        'srcusers.users.employeeid as employeeid',
        'ams_applications.id',
        'ams_applications.department',
        'ams_applications.type_request',
        'ams_applications.title',
        'ams_applications.urgency',
        'ams_applications.case_number',
        'ams_applications.created_at as created_at',
        'ams_applications.approved_at as approved_at',
        'ams_applications.status',
        'ams_applications.pp_status',
        'ams_applications.total',
        'ams_lineitem_pcmcf2.item_total',
        'ams_lineitem_pcmcf2.account_code',
        'ams_lineitem_pcmcf2.optional_code',
        'ams_forms.name as form_name'
      ];

      $applicationslineitem = ModelFactory::getInstance('LineItemPcmcf2')
                              ->leftjoin('ams_applications', 'ams_lineitem_pcmcf2.app_id', '=', 'ams_applications.id')
                              ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                              ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                              ->whereIn('ams_applications.id', $request->get( '$reports' ))
                              ->select($select)
                              ->get()->toArray();

      \Excel::create('Sage HRM Export', function($excel) use($applicationslineitem) {

        $excel->sheet('Sheetname', function($sheet) use($applicationslineitem) {

          // Array that will be used to generate the sheet
          $sheetArray = array();

          // Add the headers
          $sheetArray[] = array('Case Number','Pay Record ID','Pay Element ID','Amount','Paid Date','Declared Date');

          // Add the results
          foreach($applicationslineitem as $row)
          {
            $currentmonth15=date('Y-m-d', strtotime(date('Y').'-'.date('m').'-15'));
            $approveddate=date('Y-m-d', strtotime($row['approved_at']));

            if ($approveddate <= $currentmonth15)
            {
              $paiddate = date('Y-m-d', strtotime(date('Y').'-'.date('m').'-28'));
            }
            else
            {
              $nextmonth =date('m') +1 ;
              $paiddate = date('Y-m-d', strtotime(date('Y').'-'.$nextmonth.'-28'));
            }
          }

          $sheetArray[] = array($row['case_number'],'Normal','CLAIMS',$row['item_total'],$paiddate,date('Y-m-d', strtotime($row['created_date'])));

          // Generating the sheet from the array
          $sheet->fromArray($sheetArray, null, 'A1', false, false);
        });

      })->export('xls');

      return redirect('/paymentprocessing/reimbursement2_processing')
              ->with('success_message', 'Status of Reimbursement(s) selected have been updated to <exported> and notification email(s) have been send to requestor(s).');
    }
    //end new
  }
   //cash advance

  public function cashadvance()
  {
    $this->view->title = 'Cash Advance Dashboard';
    return $this->view('paymentprocessing.cashadvance');
  }

  public function cashadvance_pending()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_sorapfca.project_name as sorapfca_project_name',
      'ams_form_aca.project_name as aca_project_name',
      'ams_form_sorapfca.cheque_payable_to as sorapfca_cheque_payable_to',
      'ams_form_aca.cheque_payable_to as aca_cheque_payable_to'
    ];

    //cash advance( request / acquittal only)
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [12, 13])
                      ->where('request_id', 1)->get()->toArray();

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_aca', 'ams_form_aca.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 0)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Cash Advance - pending';
    return $this->view('paymentprocessing.cashadvance_pending');
  }

  public function cashadvance_processing()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_sorapfca.project_name as sorapfca_project_name',
      'ams_form_aca.project_name as aca_project_name',
      'ams_form_sorapfca.cheque_payable_to as sorapfca_cheque_payable_to',
      'ams_form_aca.cheque_payable_to as aca_cheque_payable_to'
    ];

    //cash advance( request / acquittal only)
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [12, 13])
                      ->where('request_id', 1)->get()->toArray();

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_aca', 'ams_form_aca.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 1)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Cash Advance - processing';
    return $this->view('paymentprocessing.cashadvance_processing');
  }

  public function cashadvance_readyforcollection()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_sorapfca.project_name as sorapfca_project_name',
      'ams_form_aca.project_name as aca_project_name',
      'ams_form_sorapfca.cheque_payable_to as sorapfca_cheque_payable_to',
      'ams_form_aca.cheque_payable_to as aca_cheque_payable_to'
    ];

    //cash advance( request / acquittal only)
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                     ->whereIn('form_id', [12, 13])
                     ->where('request_id', 1)->get()->toArray();

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_aca', 'ams_form_aca.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 3)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Cash Advance - ready for collection';
    return $this->view('paymentprocessing.cashadvance_readyforcollection');
  }

  public function cashadvance_pending_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/cashadvance_pending')
              ->with('error_message', 'Please select at least one pending Cash Advance.');
    }

    $applications = ModelFactory::getInstance('Application')
                    ->whereIn('id', $request->get( '$reports' ))
                    ->get()->toArray();

    //start new
    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ( $applications as $application )
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his cash advance is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')
                ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' => $pp->case_number,
          'title' => $pp->title,
          'name' => $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_pending', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is rejected by financial in payment processing!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_pending')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <rejected> and notification email(s) have been send to requestor(s).');
    }

    // processing action
    elseif($request->input('processing'))
    {
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 1;
        $pp->save();

        //send email to inform user that his cash advance is been processing
        $user = ModelFactory::getInstance('User')
                 ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' => $pp->case_number,
          'title' => $pp->title,
          'name' => $user->loginname
    	  );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_pending', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is processing now!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_pending')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <processing> and notification email(s) have been send to requestor(s).');
    }
  }

  public function cashadvance_processing_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/cashadvance_processing')
              ->with('error_message', 'Please select at least one processing Cash Advance.');
    }

    $applications = ModelFactory::getInstance('Application')
                     ->whereIn('id', $request->get( '$reports' ))
                     ->get()->toArray();

    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his cash advance is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')
                ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' => $pp->case_number,
          'title' => $pp->title,
          'name' => $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_processing', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is rejected by financial in payment processing!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_processing')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <rejected> and notification email(s) have been send to requestor(s).');
    }

    //readyforcollection action
    elseif($request->input('readyforcollection'))
    {
      foreach($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 3;
        $pp->save();

        //send email to inform user that his cash advance is read for collection.
        $user = ModelFactory::getInstance('User')
                ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    	    'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' => $pp->case_number,
          'title' => $pp->title,
          'name' => $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_processing', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is ready for collection now!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_processing')
                ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <ready for collection> and notification email(s) have been send to requestor(s).');
    }
  }

  public function cashadvance_readyforcollection_store( \Illuminate\Http\Request $request)
  {
    $input = $request->all();

    if(count($request->get( '$reports' )) == 0)
    {
      return redirect('/paymentprocessing/cashadvance_readyforcollection')
              ->with('error_message', 'Please select at least one Ready for collection Cash Advance.');
    }

    $applications = ModelFactory::getInstance('Application')
                     ->whereIn('id', $request->get( '$reports' ))
                     ->get()->toArray();

    //START new
    //payment processing reject action
    if($request->input('reject'))
    {
      // reject action
      foreach ($applications as $application)
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 5;
        $pp->save();

        //send email to inform user that his cash advance is rejected by financial in payment processing.
        $user = ModelFactory::getInstance('User')
                 ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    		  'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_readyforcollection', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is rejected by financial in payment processing!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_readyforcollection')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <collected> and notification email(s) have been send to requestor(s).');
    }

    // collect action
    elseif($request->input('collect'))
    {
      foreach ( $applications as $application )
      {
        $pp = ModelFactory::getInstance('Application')->where('id', $application['id'])->first();
        $pp->pp_status = 3;
        $pp->save();

        //send email to inform user that his cash advance is collected
        $user = ModelFactory::getInstance('User')
                ->where('idsrc_login', '=', $pp->created_id)->first();

        $data = array(
    	    'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
          'case_number' =>  $pp->case_number,
          'title' =>  $pp->title,
          'name' =>  $user->loginname
        );

        $email =  $user->emailadd;

        \Mail::send('mail.mail_cashadvance_readyforcollection', $data , function ($m) use ($email) {
          $m->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
          $m->to($email)->subject('Your cash advance is collected!');
        });
      }

      return redirect('/paymentprocessing/cashadvance_readyforcollection')
              ->with('success_message', 'Status of Cash Advance(s) selected have been updated to <collected> and notification email(s) have been send to requestor(s).');
    }
  }

  public function cashadvance_collected()
  {
    $user_id = \Auth::User()->idsrc_login;
    $role = \Auth::User()->roleid;

    $select = [
      'srcusers.users.idsrc_login as id',
      'srcusers.users.loginname as name',
      'srcusers.users.emailadd as email',
      'ams_applications.id',
      'ams_applications.department',
      'ams_applications.type_request',
      'ams_applications.title',
      'ams_applications.urgency',
      'ams_applications.case_number',
      'ams_applications.created_at',
      'ams_applications.status',
      'ams_applications.pp_status',
      'ams_applications.print_date',
      'ams_applications.total',
      'ams_forms.name as form_name',
      'ams_form_sorapfca.project_name as sorapfca_project_name',
      'ams_form_aca.project_name as aca_project_name',
      'ams_form_sorapfca.cheque_payable_to as sorapfca_cheque_payable_to',
      'ams_form_aca.cheque_payable_to as aca_cheque_payable_to'
    ];

    //cash advance only
    $forms = ModelFactory::getInstance('Forms');
    $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                      ->whereIn('form_id', [12, 13])
                      ->where('request_id', 1)->get()->toArray();

    //get finance HOD
    $FINdepartment = ModelFactory::getInstance('Department')->where('idsrc_departments','12')->get();
    $getFinHead = $FINdepartment['0']->dept_head;
    $this->view->FinHead =  $getFinHead;

    $prepare = ModelFactory::getInstance('Application')
                ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
                ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
                ->leftjoin('ams_form_sorapfca', 'ams_form_sorapfca.app_id', '=', 'ams_applications.id')
                ->leftjoin('ams_form_aca', 'ams_form_aca.app_id', '=', 'ams_applications.id')
                ->orderBy('ams_applications.created_at','DESC')
                ->where('ams_applications.drafts', '=', 0)
                ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 4)
                ->whereIn('ams_applications.type_form', $requestToForm)
                ->select($select);

    $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
    $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
    $this->view->fromtoFilter = $fromtoFilter;

    $searchFilter = FilterFactory::getInstance('Text','Search');
    $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
    $this->view->searchFilter = $searchFilter;

    $this->view->reports = $this->paginate($prepare);
    $reports = $this->paginate($prepare);

    $this->view->title = 'Cashadvance - collected';
    return $this->view('paymentprocessing.cashadvance_collected');
  }
}
