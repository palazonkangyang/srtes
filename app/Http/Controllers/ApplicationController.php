<?php

namespace App\Http\Controllers;

use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\LibraryFactory;
use App\Http\Requests\NewApplicationRequest;
use Response;
use Validator;
use Carbon\Carbon;
use Storage;
use Mail;
use DB;

class ApplicationController extends ControllerCore
{

	/**
    * Store a newly created resource in storage.
    *
    * @return Response
  */

  public function store(NewApplicationRequest $request)
  {
    if($request->ajax())
    {
      DB::beginTransaction();

    	//remove exisiting
      if($request->appid){
        $approverRemove = ModelFactory::getInstance('Approver')->where('app_id','=',$request->appid)->delete();
        $ccpersonRemove = ModelFactory::getInstance('Ccperson')->where('app_id','=',$request->appid)->delete();
        $docsRemove = ModelFactory::getInstance('Documents')->where('app_id','=',$request->appid)->delete();
        $filesRemove = ModelFactory::getInstance('File')->where('app_id','=',$request->appid)->delete();
    	}

      //end removing
      $app = ModelFactory::getInstance('Application')->findOrNew($request->appid);
      $app->created_id = \Auth::User()->idsrc_login;
      $app->department = $request->department;
      //$app->type_request = $request->type_request;
      $app->type_form = $request->type_form;
      $app->urgency = $request->urgency;

      $app->drafts = 0;

      if($request->type_form == '11')
      {
        $app->total = $request->total_amount;
      }

      else if($request->type_form == '12')
      {
        $app->total = $request->total;
      }

      else if($request->type_form == '13')
      {
        $app->total = $request->amount;
      }

      else if($request->type_form == '14')
      {
        $app->total = $request->total;
      }

      else if($request->type_form == '20')
      {
        $app->total = $request->total;
      }

      else if($request->type_form == '16')
      {
        $app->total = $request->fee;
      }

      else if($request->type_form == '18')
      {
        $app->total = $request->amount;
      }

      else if($request->type_form == '19')
      {
        $app->total =  $request['item_subtotal'][$request->item_checked-1];
      }

      else
      {
			}

      if($app->save())
      {
        $this->id = $app->id;
        $case_number = $request->department.'/'.str_pad($this->id, 6, '0', STR_PAD_LEFT).'/'.date('Y');
        $update_section = ModelFactory::getInstance('Application')->find($this->id);
        $update_section->case_number = $case_number;
        $update_section->type_request = $request->type_request;
        $form_name = ModelFactory::getInstance('Forms')
                    ->where('id',$app->type_form)
                    ->first(['name']);

        /**
         * Conditions form here
        */
        if($request->type_form == '2')
        {
          $form = ModelFactory::getInstance('FormRcp');
          $form->app_id = $this->id;
          $form->copies = $request->number_of_copies;
          $form->reasons = $request->reasons_for_color_printing;
          $form->save();
        }

        else if($request->type_form == '3')
        {
          $form = ModelFactory::getInstance('FormRca');
          $form->app_id = $this->id;
          $form->copies = $request->number_of_copies;
          $form->reasons = $request->reasons_for_request;
          $form->save();
        }

        else if($request->type_form == '4')
        {
          $form = ModelFactory::getInstance('FormArea');
          $form->app_id = $this->id;
          $form->email = $request->email_account_name;
          $form->reasons = $request->reasons;
          $form->save();
        }

        else if($request->type_form == '5')
        {
          $form = ModelFactory::getInstance('FormArge');
          $form->app_id = $this->id;
          $form->type = $request->type;
          $form->group_exist = $request->group_exist;
          $form->group_email = $request->group_email;
          $form->email_address = $request->email_address;
          $form->instructions = $request->instructions;
          $form->save();
        }

        else if($request->type_form == '6')
        {
          $prpo = (isset($request->create_prpo) ? $request->create_prpo : '0');
          $pr = (isset($request->approve_pr) ? $request->approve_pr : '0');
          $others = (isset($request->others) ? $request->others : '0');

          $form = ModelFactory::getInstance('FormCdsaa');
          $form->app_id = $this->id;
          $form->type = $request->type;
          $form->employees_name = $request->employees_name;
          $form->reasons = $request->reasons;
          $form->create_prpo = $prpo;
          $form->approve_pr = $pr;
          $form->others = $others;
          $form->others_name = $request->others_name;
          $form->save();
        }

        else if($request->type_form == '7')
        {
          $au = (isset($request->account_unused) ? $request->account_unused : '0');
          $sd = (isset($request->staff_departure) ? $request->staff_departure : '0');
          $pc = (isset($request->project_closed) ? $request->project_closed : '0');

          $form = ModelFactory::getInstance('FormRdra');
          $form->app_id = $this->id;
          $form->transfer_google_files = $request->transfer_google_files;
          $form->email_destination = $request->email_destination;
          $form->email_address = $request->email_address;
          $form->account_unused = $au;
          $form->staff_departure = $sd;
          $form->project_closed = $pc;
          $form->save();
        }

        else if($request->type_form == '8')
        {
          $srca = (isset($request->srca) ? $request->srca : '0');
          $admin_fr_ccm = (isset($request->admin_fr_ccm) ? $request->admin_fr_ccm : '0');
          $hr_is = (isset($request->hr_is) ? $request->hr_is : '0');
          $mvd_rcy_cs = (isset($request->mvd_rcy_cs) ? $request->mvd_rcy_cs : '0');
          $rear_entrance = (isset($request->rear_entrance) ? $request->rear_entrance : '0');
          $meeting_room = (isset($request->meeting_room) ? $request->meeting_room : '0');
          $thrift_shop = (isset($request->thrift_shop) ? $request->thrift_shop : '0');

          $form = ModelFactory::getInstance('FormAtac');
          $form->app_id = $this->id;
          $form->fullname = $request->fullname;
          $form->nric = $request->nric;
          $form->address = $request->address;
          $form->telephone = $request->telephone;
          $form->mobile = $request->mobile;
          $form->srca = $srca;
          $form->admin_fr_ccm = $admin_fr_ccm;
          $form->hr_is = $hr_is;
          $form->mvd_rcy_cs = $mvd_rcy_cs;
          $form->rear_entrance = $rear_entrance;
          $form->meeting_room = $meeting_room;
          $form->thrift_shop = $thrift_shop;
          $form->access_date_start = date('Y-m-d H:i:s', strtotime($request->access_date_start));
          $form->access_date_end = date('Y-m-d H:i:s', strtotime($request->access_date_end));
          $form->reasons = $request->reasons;
          $form->save();
        }

        else if($request->type_form == '9')
        {
          $form = ModelFactory::getInstance('FormHphcrf');
          $form->app_id = $this->id;
          $form->booking_date_start = date('Y-m-d H:i:s', strtotime($request->booking_date_start));
          $form->booking_date_end = date('Y-m-d H:i:s', strtotime($request->booking_date_end));
          $form->purpose_of_use = $request->purpose_of_use;
          $form->layout_arrangement = $request->layout_arrangement;
          $form->others = $request->others;
          $form->sound_system = $request->sound_system;
          $form->number_of_pax = $request->number_of_pax;
          $form->save();
        }

        else if($request->type_form == '10')
        {
          $form = ModelFactory::getInstance('FormMjr');
          $form->app_id = $this->id;
          $form->date_time_damage = date('Y-m-d H:i:s', strtotime($request->date_time_damage));
          $form->damage_description = $request->damage_description;
          $form->operations_affected = $request->operations_affected;
          $form->save();
        }

        else if($request->type_form == '11')
        {
          $form = ModelFactory::getInstance('FormPgvbf');
          $form->app_id = $this->id;
          $form->booking_date_start = date('Y-m-d H:i:s', strtotime($request->booking_date_start));
          $form->booking_date_end = date('Y-m-d H:i:s', strtotime($request->booking_date_end));
          $form->purpose_of_use = $request->purpose_of_use;
          $form->driver_requested = $request->driver_requested;
          $form->driver_name = $request->driver_name;
          $form->vehicle_type = $request->vehicle_type;
          $form->number_of_hours = $request->number_of_hours;
          $form->total_amount = $request->total_amount;
          $form->save();
        }

        else if($request->type_form == '12')
        {
          $form = ModelFactory::getInstance('FormSorapfca');
          $form->app_id = $this->id;
          $form->date_event = date('Y-m-d H:i:s', strtotime($request->date_event));
          $form->cheque_payable_to = $request->cheque_payable_to;
          $form->request_type = $request->request_type;
          $form->project_name = $request->project_name;
          $form->advance_received = $request->advance_received;
          $form->total = $request->total;
          $form->balance = $request->balance;
          $form->budget_code = $request->budget_code;
          $form->reasons = $request->reasons;
          $form->description = $request->description;
          $form->account_code = $request->p_accountcode_id;
          $form->optional_code = $request->p_optionalcode_id;
          $form->p_accountcode_desc = $request->p_accountcode_desc;
          $form->p_optionalcode_desc = $request->p_optionalcode_desc;
          $form->save();

          //**start of line item insert
          for ($idx = 0; $idx < count($request->item_id); $idx++)
			    {
    				$lineitem = ModelFactory::getInstance('LineItemSorapfca');
    				$lineitem->app_id = $this->id;
    				$lineitem->item_date = date('Y-m-d H:i:s', strtotime($request['item_date'][$idx]));
    				$lineitem->item_company = $request['item_company'][$idx];
    				$lineitem->item_desc = $request['item_desc'][$idx];
    				$lineitem->item_note = $request['item_note'][$idx];
    				$lineitem->item_total = $request['item_total'][$idx];
    				$lineitem->save();
          }
        }

        else if($request->type_form == '13')
        {
          $form = ModelFactory::getInstance('FormAca');
          $form->app_id = $this->id;
          $form->date_required = date('Y-m-d H:i:s', strtotime($request->date_required));
          $form->cheque_payable_to = $request->cheque_payable_to;
          $form->request_type = $request->request_type;
          $form->account_code = $request->p_accountcode_id;
          $form->optional_code = $request->p_optionalcode_id;
          $form->p_accountcode_desc = $request->p_accountcode_desc;
          $form->p_optionalcode_desc = $request->p_optionalcode_desc;
          $form->project_name = $request->project_name;
          $form->amount = $request->amount;
          $form->amount_code = $request->amount_code;
          $form->reasons = $request->reasons;
          $form->description = $request->description;
          $form->save();
        }

        else if($request->type_form == '14')
        {
          $form = ModelFactory::getInstance('FormPcmcf');
          $form->app_id = $this->id;
          $form->title = $request->title;
          $form->payee_name = $request->payee_name;
          $form->project = $request->project;
          $form->total = $request->total;

          $form->save();

          //**start of line item insert
          for ($idx = 0; $idx < count($request->item_id); $idx++)
			    {
            if($request['p_accountcode_id'][$idx] !='')
            {
      				$lineitem = ModelFactory::getInstance('LineItemPcmcf');
      				$lineitem->app_id = $this->id;
      				$lineitem->item_date = date('Y-m-d H:i:s', strtotime($request['item_date'][$idx]));
      				$lineitem->item_desc = $request['item_desc'][$idx];
      				$lineitem->item_total = $request['item_total'][$idx];
              $lineitem->account_code = $request['p_accountcode_id'][$idx];
              $lineitem->optional_code = $request['p_optionalcode_id'][$idx];
              $lineitem->p_accountcode_desc = $request['p_accountcode_desc'][$idx];
              $lineitem->p_optionalcode_desc = $request['p_optionalcode_desc'][$idx];
				      $lineitem->save();
            }
          }
        }

        else if($request->type_form == '20')
        {
          $form = ModelFactory::getInstance('FormPcmcf2');
          $form->app_id = $this->id;
          $form->title = $request->title;

          $form->project = $request->project;
          $form->total = $request->total;

          $form->save();

          //**start of line item insert
          for ($idx = 0; $idx < count($request->item_id); $idx++)
			    {
            if($request['p_accountcode_id'][$idx] !='')
            {
      				$lineitem = ModelFactory::getInstance('LineItemPcmcf2');
      				$lineitem->app_id = $this->id;
      				$lineitem->item_date = date('Y-m-d H:i:s', strtotime($request['item_date'][$idx]));
      				$lineitem->item_desc = $request['item_desc'][$idx];
      				$lineitem->item_total = $request['item_total'][$idx];
              $lineitem->account_code = $request['p_accountcode_id'][$idx];
              $lineitem->optional_code = $request['p_optionalcode_id'][$idx];
              $lineitem->p_accountcode_desc = $request['p_accountcode_desc'][$idx];
              $lineitem->p_optionalcode_desc = $request['p_optionalcode_desc'][$idx];
				      $lineitem->save();
            }
          }
        }

        else if($request->type_form == '15')
        {
          $form = ModelFactory::getInstance('FormMrf');
          $form->app_id = $this->id;
          $form->position = $request->position;
          $form->job_grade = $request->job_grade;
          $form->location = $request->location;
          $form->job_type = $request->job_type;
          $form->full_time_option = $request->full_time_option;
          $form->full_type_desc = $request->full_type_desc;
          $form->full_type_desc3 = $request->full_type_desc3;
          $form->no_months = $request->no_months;
          $form->no_hoursday = $request->no_hoursday;
          $form->no_daysweek = $request->no_daysweek;
          $form->desc_works = $request->desc_works;
          $form->save();
        }

        else if($request->type_form == '16')
        {
          $form = ModelFactory::getInstance('FormTsw');
          $form->app_id = $this->id;
          $form->designation = $request->designation;
          $form->service_status = $request->service_status;
          $form->type_training = $request->type_training;
          $form->title = $request->title;
          $form->provider = $request->provider;
          $form->isfunds = $request->isfunds;
          $form->budget_availability = $request->budget_availability;
          $form->fee = $request->fee;
          $form->funds = $request->funds;
          $form->description = $request->description;
          $form->course_id = $request->course_id ;
          $form->batch_id = $request->item_id[0];
          $form->save();

          //**start of line item insert
          for ($idx = 0; $idx < count($request->item_id); $idx++)
          {
            $lineitem = ModelFactory::getInstance('LineItemTsw');
            $lineitem->app_id = $this->id;
            $lineitem->item_date = date('Y-m-d H:i:s', strtotime($request['item_date'][$idx]));
            $lineitem->save();
          }
        }

        else if($request->type_form == '17')
        {
          $form = ModelFactory::getInstance('FormIrfi');
          $form->app_id = $this->id;
          $form->goods = $request->goods;
          $form->services = $request->services;
          $form->estimate_value = $request->estimate_value;
          $form->type_source = $request->type_source;
          $form->funding_desc = $request->funding_desc;
          $form->type_reason = $request->type_reason;
          $form->reason_desc = $request->reason_desc;
          $form->detailed_information = $request->detailed_information;
          $form->vendor_company = $request->vendor_company;
          $form->vendor_person = $request->vendor_person;
          $form->vendor_contact = $request->vendor_contact;
          $form->date_required = date('Y-m-d H:i:s', strtotime($request->date_required));
          $form->save();
        }

        else if($request->type_form == '18')
        {
          $form = ModelFactory::getInstance('FormCoprpo');
          $form->app_id = $this->id;
          $form->pr_no = $request->pr_no;
          $form->po_no = $request->po_no;
          $form->grn_no = $request->grn_no;
          $form->inv_no = $request->inv_no;
          $form->chk_pr = $request->chk_pr;
          $form->chk_po = $request->chk_po;
          $form->chk_grn = $request->chk_grn;
          $form->chk_inv = $request->inv_no;
          $form->desc_purchased = $request->desc_purchased;
          $form->reasons = $request->reasons;
          $form->vendor = $request->vendor;
          $form->amount = $request->amount;
          $form->save();
        }

        else if($request->type_form == '19')
        {
          $form = ModelFactory::getInstance('FormEoq');
          $form->app_id = $this->id;
          $form->justifications = $request->justifications;
          $form->isBudgeted = $request->isBudgeted;
          $form->isCapex = $request->isCapex;
          $form->accountcode = $request->accountcode;
          $form->description = $request->description;
          $form->selected =  $request->item_checked;
          $form->save();

          //**start of line item insert
          for ($idx = 0; $idx < count($request->item_id); $idx++)
			    {
    				$lineitem = ModelFactory::getInstance('LineItemEoq');
    				$lineitem->app_id = $this->id;
    				$lineitem->item_company = $request['item_company'][$idx];
    				$lineitem->item_subtotal = $request['item_subtotal'][$idx];
    				$lineitem->item_gst = $request['item_gst'][$idx];
            $lineitem->item_total = $request['item_total'][$idx];
            $lineitem->item_paymentterm = $request['item_paymentterm'][$idx];
				    $lineitem->save();
          }
        }

        else {
          $update_section->title = $request->title;
          $update_section->request_details = $request->request_details;
        }

        /**
         * Conditions form ended
        */

        $update_section->save();
        $applicant = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname'));

        if($request->approver)
        {
          $urgency = ModelFactory::getInstance('Urgency')->where('urgency_id','=', $request->urgency)->first();

          foreach ($request->approver as $key => $value)
          {
            $approver = ModelFactory::getInstance('Approver');
            $approver->app_id = $this->id;

            if(substr($value, 0, 6) == 'group_')
            {
              $approver->user_id = 0;
              $approver->group_id = substr($value, 6, 6);
            }

            else
            {
              $approver->user_id = $value;
              $approver->group_id = 0;
            }

            $approver->position = $key;
            $approver->email_log_time = $urgency->set_time;

            if($key == 0)
            {
              $approver->forward = 1;
              $approver->date_to_email = date('Y-m-d H:i:s');

              if(substr($value, 0, 6) == 'group_')
              {
                // Notify first group
                $select = ['id','user_id'];
                $FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson')->where('group_id','=',substr($value, 6, 6))->get($select)->toArray();

                foreach ($FlexiGroupPerson as $key => $value2)
                {
                  $approverpersonToReceiveEmail = $this->selectUserBy($value2['user_id'], array('loginname','emailadd'));

                  if($approverpersonToReceiveEmail)
                  {
                    $setEmail = LibraryFactory::getInstance('Email');
                    $setEmail->personToReceive = $approverpersonToReceiveEmail;
                    $setEmail->subject = '[SRC-AMS] '.$request->title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
                    $setEmail->layout = 'mail.mail_approver';

                    $mailData = [
                      'receiver_name' => $approverpersonToReceiveEmail->loginname,
                      'sender_name' => $applicant->loginname,
                      'date' => date('d/m/Y h:i A'),
                      'url' => url('/application/view_details/'.$this->id, $secure = null),
                    ];

                    $setEmail->send($mailData);
                  }
                }
              }

              else
              {
                // Notify first approver
                $approverpersonToReceiveEmail = $this->selectUserBy($value, array('loginname','emailadd'));

                if($approverpersonToReceiveEmail)
                {
                  $setEmail = LibraryFactory::getInstance('Email');
                  $setEmail->personToReceive = $approverpersonToReceiveEmail;
                  $setEmail->subject = '[SRC-AMS] '.$request->title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
                  $setEmail->layout = 'mail.mail_approver';

                  $mailData = [
                    'receiver_name' => $approverpersonToReceiveEmail->loginname,
                    'sender_name' => $applicant->loginname,
                    'date' => date('d/m/Y h:i A'),
                    'url' => url('/application/view_details/'.$this->id, $secure = null),
                  ];

                  $setEmail->send($mailData);
                }
              }
            }

            else
            {
              $urgency = ModelFactory::getInstance('Urgency')->where('urgency_id','=', $request->urgency)->first();

              $urgency_time = $urgency->set_time * $key;
              $date_now = new Carbon();
              $set_new_date = $date_now->addHours($urgency_time);
              $approver->date_to_email = $set_new_date;
            }

            $approver->save();
          }
        }

        if($request->ccperson)
        {
          foreach ($request->ccperson as $key => $value)
          {
            $ccperson = ModelFactory::getInstance('Ccperson');
            $ccperson->app_id = $this->id;
            $ccperson->user_id = $value;
            $ccperson->position = $key;
            $ccperson->save();

            // Notify ccperson
            $ccpersonToReceiveEmail = $this->selectUserBy($value, array('loginname','emailadd'));

            if($ccpersonToReceiveEmail)
            {
              $setEmail = LibraryFactory::getInstance('Email');
              $setEmail->personToReceive = $ccpersonToReceiveEmail;
              $setEmail->subject = '[SRC-AMS] '.$request->title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
              $setEmail->layout = 'mail.mail_ccperson';
              $mailData = [
                'receiver_name' => $ccpersonToReceiveEmail->loginname,
                'sender_name' => $applicant->loginname,
                'date' => date('d/m/Y h:i A'),
                'url' => url('/application/view_details/'.$this->id, $secure = null),
              ];

              $setEmail->send($mailData);
            }
          }
        }

        if($request->google_doc_name && $request->google_doc_link)
        {
          $merge = array_combine($request->google_doc_name,$request->google_doc_link);

          foreach ($merge as $key => $value)
          {
            $documents = ModelFactory::getInstance('Documents');
            $documents->app_id = $this->id;
            $documents->name = $key;
            $documents->link = $value;
            $documents->save();
          }
        }

        if($request->filename && $request->fileurl && $request->mimetype)
        {
          $count = count($request->filename);

          for($i=0; $i<$count; $i++)
          {
            $files = ModelFactory::getInstance('File');
            $files->app_id = $this->id;
            $files->filename = $request->filename[$i];
            $files->file_url = $request->fileurl[$i];
            $files->mimes = $request->mimetype[$i];

            Storage::move('/public/uploads/tmp/'.$request->fileurl[$i], '/public/uploads/final/'.$request->fileurl[$i]);
            $files->save();
          }
        }

        // Notify applicant
        $personToReceiveEmail = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname','emailadd'));

        if($personToReceiveEmail)
        {
          $setEmail = LibraryFactory::getInstance('Email');
          $setEmail->personToReceive = $personToReceiveEmail;
          $setEmail->subject = '[SRC-AMS] '.$request->title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
          $setEmail->layout = 'mail.mail_creator';
          $mailData = [
            'receiver_name' => $personToReceiveEmail->loginname,
            'sender_name' => $personToReceiveEmail->loginname,
            'date' => date('d/m/Y h:i A'),
            'url' => url('/application/view_details/'.$this->id, $secure = null),
          ];

          $setEmail->send($mailData);
        }
      }

      DB::commit();
      return Response::json(array('form_id' => $this->id), 200);
    }
  }

    public function closeapp(Request $request){

        DB::beginTransaction();

        $app_id = $request->app_id;
        $case_number = $request->case_number;
        $case_title = $request->case_title;
        $status = $request->status;
        $remarks = $request->remarks;
        $title = $request->title;
        $type_form = $request->type_form ;
           $request_details= $request->request_details;
           if ($status !=""){
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'remarks' => 'required',
        ]);

        if (!$validator->fails()) {
            $app = ModelFactory::getInstance('Application')->find($app_id);
            $app->close_remarks = $remarks;
            $app->status = $status;

            if($app->save()){

                $applicant = $getform = ModelFactory::getInstance('Application')
                ->where('id',$app_id)
                ->with(['getApplicant' => function($query){ $query->select('*'); },
                        'getApprovers' => function($query){ $query->select('*'); },
                        'getCcpersons' => function($query){ $query->select('*'); },
                        'getAppForms' => function($query){ $query->select('*'); },
                        ])
                ->first();

                //notify to applicant
                if($applicant->getApplicant){
                    $setEmail = LibraryFactory::getInstance('Email');
                    $setEmail->personToReceive = $applicant->getApplicant;
                    $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                    $setEmail->layout = 'mail.mail_cancel';
                    $mailData = [
                        'receiver_name' => $applicant->getApplicant->loginname,
                        'case_number' => $case_number,
                        'date' => date('d/m/Y h:i A'),
                        'url' => url('/application/view_details/'.$app_id, $secure = null),
                    ];
                    $setEmail->send($mailData);
                }

                //notify to all approvers
                if($applicant->getApprovers){
                    foreach ($applicant->getApprovers as $approver) {
                        //Notify to group
                               if($approver->group_id > 0)
                    {

                      $select = ['id','user_id'];
                     $FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson')->where('group_id','=',$approver->group_id)->get($select)->toArray();

                foreach ($FlexiGroupPerson as $key => $value2) {

                        $personReceiveEmail = $this->selectUserBy($value2['user_id'], array('loginname','emailadd'));
                        if($personReceiveEmail){

                            $setEmail = LibraryFactory::getInstance('Email');
                             $setEmail->personToReceive = $personReceiveEmail;
                            $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                            $setEmail->layout = 'mail.mail_cancel';
                             $mailData = [
                                   'receiver_name' => $personReceiveEmail->loginname,
                            'case_number' => $case_number,
                            'date' => date('d/m/Y h:i A'),
                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                            ];
                            $setEmail->send($mailData);
                        }
                }
                   // Notify to normal
                         }else{
                        ///
                        $personReceiveEmail = $this->selectUserBy($approver->user_id, array('loginname','emailadd'));
                        $setEmail = LibraryFactory::getInstance('Email');
                        $setEmail->personToReceive = $personReceiveEmail;
                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                        $setEmail->layout = 'mail.mail_cancel';
                        $mailData = [
                            'receiver_name' => $personReceiveEmail->loginname,
                            'case_number' => $case_number,
                            'date' => date('d/m/Y h:i A'),
                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                        ];
                        $setEmail->send($mailData);

                         }
                    }
                }

                //notify to all ccpersons
                $result_ccperson = [];
                if($applicant->getCcpersons){
                     foreach($applicant->getCcpersons as $ccperson_unq) {
                        $result_ccperson[] = $ccperson_unq->user_id;
                    }
                    if($result_ccperson){
                        $ccpersons = array_unique($result_ccperson);
                        foreach ($ccpersons as $ccperson) {
                            $personReceiveEmail = $this->selectUserBy($ccperson, array('loginname','emailadd'));
                            $setEmail = LibraryFactory::getInstance('Email');
                            $setEmail->personToReceive = $personReceiveEmail;
                            $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                            $setEmail->layout = 'mail.mail_cancel';
                            $mailData = [
                                'receiver_name' => $personReceiveEmail->loginname,
                                'case_number' => $case_number,
                                'date' => date('d/m/Y h:i A'),
                                'url' => url('/application/view_details/'.$app_id, $secure = null),
                            ];
                            $setEmail->send($mailData);
                        }
                    }
                }

                DB::commit();
                return redirect('/application/view_details/'.$app_id)
                    ->with('success_message', 'Case '.$case_number.' has been cancelled!');
            }

         } else {

           return redirect('/application/view_details/'.$app_id)
                        ->withErrors($validator)
                        ->withInput();
         }

           }else
           {
                if ($type_form == '2'){
                 $validator = Validator::make($request->all(), [
                'number_of_copies' => 'required|numeric',
                'reasons_for_color_printing' => 'required',
                 ]);
                 }else if ($type_form == '3'){
                 $validator = Validator::make($request->all(), [
                'number_of_copies' => 'required|numeric',
    		'reasons_for_request' => 'required',
                 ]);
                }else if ($type_form == '4'){
                 $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'reasons' => 'required',
                 ]);
                } else if ($type_form == '5'){
                 $validator = Validator::make($request->all(), [
                'type' => 'required',
                'email_address' => 'required|email',
                'group_exist' => 'required',
                'group_email' => 'required|email',
                'instructions' => 'required',
                 ]);
                }else if($type_form  == '6') {

             $validator = Validator::make($request->all(), [

                 ]);
                } else if($type_form  == '7')
                {
            $validator = Validator::make($request->all(), [
                 'email_address' => 'required',
                'account_unused' => 'required_without_all:staff_departure,project_closed',
                'staff_departure' => 'required_without_all:account_unused,project_closed',
                'project_closed' => 'required_without_all:staff_departure,account_unused',

                 ]);
                } else if($type_form  == '8')
                 {
            $validator = Validator::make($request->all(), [
                'srca' => 'required_without_all:admin_fr_ccm,hr_is,mvd_rcy_cs,rear_entrance,meeting_room,thrift_shop',
                'admin_fr_ccm' => 'required_without_all:srca,hr_is,mvd_rcy_cs,rear_entrance,meeting_room,thrift_shop',
                'hr_is' => 'required_without_all:srca,admin_fr_ccm,mvd_rcy_cs,rear_entrance,meeting_room,thrift_shop',
                'mvd_rcy_cs' => 'required_without_all:srca,admin_fr_ccm,hr_is,rear_entrance,meeting_room,thrift_shop',

                'rear_entrance' => 'required_without_all:srca,admin_fr_ccm,hr_is,mvd_rcy_cs,meeting_room,thrift_shop',
                'meeting_room' => 'required_without_all:srca,admin_fr_ccm,hr_is,mvd_rcy_cs,rear_entrance,thrift_shop',
                'thrift_shop' => 'required_without_all:srca,admin_fr_ccm,hr_is,mvd_rcy_cs,rear_entrance,meeting_room',

                'access_date_start' => 'required',
                'access_date_end' => 'required',
                'reasons' => 'required',
                'address' => 'required',
                'nric' => 'required',
                'fullname' => 'required',
                 ]);

        }
        else if($type_form  == '9')
        {

            $validator = Validator::make($request->all(), [
                'booking_date_start' => 'required',
                'booking_date_end' => 'required',
                'purpose_of_use' => 'required',
                'layout_arrangement' => 'required',
                'number_of_pax' => 'required|numeric',
              ]);
           }
        else if($type_form  == '10')
        {

             $validator = Validator::make($request->all(), [
                'date_time_damage' => 'required',
                'damage_description' => 'required',
                'operations_affected' => 'required',
              ]);

        }
        else if($type_form  == '11')
        {

            $validator = Validator::make($request->all(), [
                'booking_date_start' => 'required',
                'booking_date_end' => 'required',
                'purpose_of_use' => 'required',
                'driver_requested' => 'required',
                'vehicle_type' => 'required',
                'number_of_hours' => 'required',
                'total_amount' => 'required|numeric',
            ]);

        }
                else{
                          $validator = Validator::make($request->all(), [
                'title' => 'required',
                'request_details' => 'required',
                ]);

                }
                   if (!$validator->fails()) {
            if ($type_form == '2'){
                 $form = ModelFactory::getInstance('FormRcp')->where('app_id', $app_id)->first();
                 $form->copies = $request->number_of_copies;
                 $form->reasons = $request->reasons_for_color_printing;
                 $form->save();
            } else if ($type_form == '3'){
                 $form = ModelFactory::getInstance('FormRca')->where('app_id', $app_id)->first();
                 $form->copies = $request->number_of_copies;
                 $form->reasons = $request->reasons_for_request;
                 $form->save();
            } else if ($type_form == '4'){
                 $form = ModelFactory::getInstance('FormArea')->where('app_id', $app_id)->first();
                 $form->email = $request->email;
                 $form->reasons = $request->reasons;
                 $form->save();
            } else if ($type_form == '5'){
                 $form = ModelFactory::getInstance('FormArge')->where('app_id', $app_id)->first();
                 $form->type = $request->type;
                 $form->email_address = $request->email_address;
                 $form->group_exist = $request->group_exist;
                 $form->group_email = $request->group_email;
                 $form->instructions = $request->instructions;
                $form->save();
            }
             else if($type_form == '6'){
                $prpo = (isset($request->create_prpo) ? $request->create_prpo : '0');
                $pr = (isset($request->approve_pr) ? $request->approve_pr : '0');
                $others = (isset($request->others) ? $request->others : '0');

                $form = ModelFactory::getInstance('FormCdsaa')->where('app_id', $app_id)->first();

                $form->employees_name = $request->employees_name;
                $form->reasons = $request->reasons;
                $form->create_prpo = $prpo;
                $form->approve_pr = $pr;
                $form->others = $others;
                $form->others_name = $request->others_name;
                $form->save();

            }
            else if($type_form == '7'){
                $au = (isset($request->account_unused) ? $request->account_unused : '0');
                $sd = (isset($request->staff_departure) ? $request->staff_departure : '0');
                $pc = (isset($request->project_closed) ? $request->project_closed : '0');

                $form = ModelFactory::getInstance('FormRdra')->where('app_id', $app_id)->first();
                 $form->transfer_google_files = $request->transfer_google_files;
                $form->email_destination = $request->email_destination;
                $form->email_address = $request->email_address;
                $form->account_unused = $au;
                $form->staff_departure = $sd;
                $form->project_closed = $pc;
                $form->save();

            }
            else if($type_form == '8'){
                $srca = (isset($request->srca) ? $request->srca : '0');
                $admin_fr_ccm = (isset($request->admin_fr_ccm) ? $request->admin_fr_ccm : '0');
                $hr_is = (isset($request->hr_is) ? $request->hr_is : '0');
                $mvd_rcy_cs = (isset($request->mvd_rcy_cs) ? $request->mvd_rcy_cs : '0');
                $rear_entrance = (isset($request->rear_entrance) ? $request->rear_entrance : '0');
                $meeting_room = (isset($request->meeting_room) ? $request->meeting_room : '0');
                $thrift_shop = (isset($request->thrift_shop) ? $request->thrift_shop : '0');

                $form = ModelFactory::getInstance('FormAtac')->where('app_id', $app_id)->first();
                $form->fullname = $request->fullname;
                $form->nric = $request->nric;
                $form->address = $request->address;
                $form->telephone = $request->telephone;
                $form->mobile = $request->mobile;
                $form->srca = $srca;
                $form->admin_fr_ccm = $admin_fr_ccm;
                $form->hr_is = $hr_is;
                $form->mvd_rcy_cs = $mvd_rcy_cs;
                $form->rear_entrance = $rear_entrance;
                $form->meeting_room = $meeting_room;
                $form->thrift_shop = $thrift_shop;
                $form->access_date_start = date('Y-m-d H:i:s', strtotime($request->access_date_start));
                $form->access_date_end = date('Y-m-d H:i:s', strtotime($request->access_date_end));
                $form->reasons = $request->reasons;
                $form->save();

            }
            else if($type_form == '9'){
                $form = ModelFactory::getInstance('FormHphcrf')->where('app_id', $app_id)->first();
                $form->booking_date_start = date('Y-m-d H:i:s', strtotime($request->booking_date_start));
                $form->booking_date_end = date('Y-m-d H:i:s', strtotime($request->booking_date_end));
                $form->purpose_of_use = $request->purpose_of_use;
                $form->layout_arrangement = $request->layout_arrangement;
                $form->others = $request->others;
                $form->sound_system = $request->sound_system;
                $form->number_of_pax = $request->number_of_pax;
                $form->save();

            }
            else if($type_form == '10'){
                $form = ModelFactory::getInstance('FormMjr')->where('app_id', $app_id)->first();
                $form->date_time_damage = date('Y-m-d H:i:s', strtotime($request->date_time_damage));
                $form->damage_description = $request->damage_description;
                $form->operations_affected = $request->operations_affected;
                $form->save();

            }
            else if($type_form == '11'){
                $form = ModelFactory::getInstance('FormPgvbf')->where('app_id', $app_id)->first();
                $form->booking_date_start = date('Y-m-d H:i:s', strtotime($request->booking_date_start));
                $form->booking_date_end = date('Y-m-d H:i:s', strtotime($request->booking_date_end));
                $form->purpose_of_use = $request->purpose_of_use;
                $form->driver_requested = $request->driver_requested;
                $form->driver_name = $request->driver_name;
                $form->vehicle_type = $request->vehicle_type;
                $form->number_of_hours = $request->number_of_hours;
                $form->total_amount = $request->total_amount;
                $form->save();

            }
            else {
                    $app = ModelFactory::getInstance('Application')->find($app_id);
                    $app->title = $title;
                    $app->request_details = $request_details;
                    $app->save();
            }
              DB::commit();
               return redirect('/application/view_details/'.$app_id)
                    ->with('success_message', 'Case '.$case_number.' has been changed!');
                   }else {

            return redirect('/application/view_details/'.$app_id)
                        ->withErrors($validator)
                        ->withInput();
         }
           }
    }

    /**
     * Approve, recommend, reject, cancelled status
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function approveapp(Request $request){

        DB::beginTransaction();

        $app_id = $request->app_id;
        $creator_id = $request->creator_id;
        $case_status = $request->case_status;
        $case_title = $request->case_title;
        $case_number = $request->case_number;
        $forward_person_id = $request->selected_recommend;
         $type_form = $request->type_form ;
        $app = ModelFactory::getInstance('Application')->find($app_id);
        $form_name = ModelFactory::getInstance('Forms')->where('id',$app->type_form)->first(['name']);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'remarks' => 'required',
        ]);

        if (!$validator->fails()) {

            $approver = ModelFactory::getInstance('Approver')->find($request->approver_id);
            if($request->status == '1' || $request->status == '2'){
                $approver->remarks = $request->remarks;
                $approver->status = $request->status;
                $approver->case_status = ($request->status == 2 ? $request->status : $case_status);
                $approver->read = 1;
            }
            else if($request->status == 4) {
                $valid_to_forward = true;
                $getAllrecommendUser = ModelFactory::getInstance('Recommend')
                                        ->where('app_id', $app_id)
                                        ->get();
                if($getAllrecommendUser){
                    foreach ($getAllrecommendUser as $forward) {

                    }
                }
                //Condition: True valid to forward  and False not valid.
                $forward_person = $this->selectUserBy($forward_person_id, ['loginname','emailadd']);
                $forward_sender = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname','emailadd'));
                if($valid_to_forward){
                    $forward = ModelFactory::getInstance('Recommend');
                    $forward->app_id = $app_id;
                    $forward->user_id = $approver->user_id;
                    $forward->remarks = $request->remarks;
                    $forward->recommend_user_id = $forward_person_id;
                    $forward->user_status = 4;
                        if($forward->save()){
                            //replace current approver to new forward id
                            $approver->user_id = $forward_person_id;
                            //removing user exist in ccperson
                            ModelFactory::getInstance('Ccperson')
                                            ->where('app_id', '=', $app_id)
                                            ->where('user_id', '=', $request->selected_recommend)
                                            ->delete();

                            // Notify forward person
                            if($forward_person){
                                $setEmail = LibraryFactory::getInstance('Email');
                                $setEmail->personToReceive = $forward_person;
                                $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
                                $setEmail->layout = 'mail.mail_forward';
                                $mailData = [
                                    'receiver_name' => $forward_person->loginname,
                                    'sender_name' => $forward_sender->loginname,
                                    'case_number' => $case_number,
                                    'date' => date('d/m/Y h:i A'),
                                    'url' => url('/application/view_details/'.$app_id, $secure = null),
                                ];
                                $setEmail->send($mailData);
                            }
                        }
                    } else {
                        return redirect('/application/view_details/'.$app_id)
                                    ->with('error_message', 'You cannot forward '.$forward_person->loginname.'. Already forwarded this case.');
                    }
            }


            if($approver->save()){

                //checking main application if its valid to change status.
                $valid_to_change = true;
                $checking_status = ModelFactory::getInstance('Approver')->where('app_id', $app_id)->get();

                    $counter = 1 ;
                foreach($checking_status as $st) {
                   if($counter++ < 4) continue ;
                     // Loop code
                     if($st->status == 0){ $valid_to_change = false; }
                }



                //saving application result on checking
                $save_app = ModelFactory::getInstance('Application')->find($app_id);
                if($valid_to_change) {
                    $save_app->status = $request->status;
                    $save_app->approved_at = Carbon::now()->format('Y-m-d H:i:s');
                    //change the case status
                    $up_case = ModelFactory::getInstance('Approver')->find($request->approver_id);
                    $up_case->case_status = $request->status;
                    $up_case->save();
                } else {
                    $save_app->status = ($request->status == 2 ? $request->status : $case_status);
                }

                //another method
                if($save_app->save()){

                    //notification persons getting all data of applicant
                    $applicant = $getform = ModelFactory::getInstance('Application')
                                ->where('id',$app_id)
                                ->with(['getApplicant' => function($query){ $query->select('*'); },
                                        'getApprovers' => function($query){ $query->select('*'); },
                                        'getCcpersons' => function($query){ $query->select('*'); },
                                        'getAppForms' => function($query){ $query->select('*'); },
                                        ])
                                ->first();

                    if($request->status == 1){
                        $current_approver = ModelFactory::getInstance('Approver')
                            ->where('app_id', $app_id)
                            ->where('id', $request->approver_id)
                            ->first();


                        if($current_approver){

                            $current_position = $current_approver->position + 1;

                            $next_approver = ModelFactory::getInstance('Approver')
                                                ->where('app_id', $app_id)
                                                ->where('position', $current_position)
                                                ->where('read', 0)
                                                ->where('forward', 0)
                                                ->first();
                            if($next_approver){

                                //notify next approver
                                $next_approver_save = ModelFactory::getInstance('Approver')->firstOrNew(array('app_id' => $app_id, 'user_id' => $next_approver->user_id, 'position' => $current_position, 'read' => '0'));
                                $next_approver_save->forward = 1;
                                $next_approver_save->save();
                                  if($current_approver->group_id > 0)
                    {

                                $CurrentFlexiGroup = ModelFactory::getInstance('FlexiGroup')->where('id','=',$current_approver->group_id)->get()->toArray();
                               $datapersonsendemail =  $CurrentFlexiGroup[0]['name'];

                                }else{
                                      $personSendEmail = $this->selectUserBy($current_approver->user_id, array('loginname','emailadd'));
                                       $datapersonsendemail = $personSendEmail->loginname;

                                }
                                  //Notify to group
                               if($next_approver->group_id > 0)
                    {

                      $select = ['id','user_id'];
                     $FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson')->where('group_id','=',$next_approver->group_id)->get($select)->toArray();
                      $FlexiGroup = ModelFactory::getInstance('FlexiGroup')->where('id','=',$next_approver->group_id)->get($select)->toArray();


                    foreach ($FlexiGroupPerson as $key => $value2) {

                        $personToReceiveEmail = $this->selectUserBy($value2['user_id'], array('loginname','emailadd'));
                        if($personToReceiveEmail){

                                $setEmail = LibraryFactory::getInstance('Email');
                                $setEmail->personToReceive = $personToReceiveEmail;
                                $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
                                $setEmail->layout = 'mail.mail_next_approver';
                                $mailData = [
                                    'receiver_name' => '['.$FlexiGroup->name.'] '.$personToReceiveEmail->loginname,
                                    'sender_name' => $datapersonsendemail,
                                    'case_number' => $case_number,
                                    'date' => date('d/m/Y h:i A'),
                                    'url' => url('/application/view_details/'.$app_id, $secure = null),
                                ];
                                $setEmail->send($mailData);
                        }
                }
                   // Notify to normal
                         }else{


                                $personToReceiveEmail = $this->selectUserBy($next_approver->user_id, array('loginname','emailadd'));
                                $setEmail = LibraryFactory::getInstance('Email');
                                $setEmail->personToReceive = $personToReceiveEmail;
                                $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$form_name->name;
                                $setEmail->layout = 'mail.mail_next_approver';
                                $mailData = [
                                    'receiver_name' => $personToReceiveEmail->loginname,
                                    'sender_name' => $datapersonsendemail,
                                    'case_number' => $case_number,
                                    'date' => date('d/m/Y h:i A'),
                                    'url' => url('/application/view_details/'.$app_id, $secure = null),
                                ];
                                $setEmail->send($mailData);

                         }

                            }
                            else {
                                //notify to all approvers application is now approve
                                if($applicant->getApprovers){
                                    foreach ($applicant->getApprovers as $approver) {
                                           //Notify to group
                               if($approver->group_id > 0)
                    {

                      $select = ['id','user_id'];
                     $FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson')->where('group_id','=',$approver->group_id)->get($select)->toArray();
                      $FlexiGroup = ModelFactory::getInstance('FlexiGroup')->where('id','=',$approver->group_id)->get($select)->toArray();


                    foreach ($FlexiGroupPerson as $key => $value2) {

                        $personReceiveEmail = $this->selectUserBy($approver->user_id, array('loginname','emailadd'));
                            if($personReceiveEmail){

                                        $setEmail = LibraryFactory::getInstance('Email');
                                        $setEmail->personToReceive = '['.$FlexiGroup->name.'] '.$personReceiveEmail;
                                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                                        $setEmail->layout = 'mail.mail_approved';
                                        $mailData = [
                                            'receiver_name' => $personReceiveEmail->loginname,
                                            'case_number' => $case_number,
                                            'date' => date('d/m/Y h:i A'),
                                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                                        ];
                                        $setEmail->send($mailData);
                        }
                }
                   // Notify to normal
                         }else
                         {

                                        $personReceiveEmail = $this->selectUserBy($approver->user_id, array('loginname','emailadd'));
                                        $setEmail = LibraryFactory::getInstance('Email');
                                        $setEmail->personToReceive = $personReceiveEmail;
                                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                                        $setEmail->layout = 'mail.mail_approved';
                                        $mailData = [
                                            'receiver_name' => $personReceiveEmail->loginname,
                                            'case_number' => $case_number,
                                            'date' => date('d/m/Y h:i A'),
                                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                                        ];
                                        $setEmail->send($mailData);
                         }
                                    }
                                }
                            }
                        }
                    }

                    //notification area
                    if($request->status == 1){ $status = 'approved'; }
                    elseif($request->status == 2){ $status = 'rejected'; }
                    elseif($request->status == 4){ $status = 'forwarded'; }

                    //notify to applicant
                    if($applicant->getApplicant){
                        $setEmail = LibraryFactory::getInstance('Email');
                        $setEmail->personToReceive = $applicant->getApplicant;
                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                        $setEmail->layout = 'mail.mail_notification';
                        $mailData = [
                            'receiver_name' => $applicant->getApplicant->loginname,
                            'sender_name' => \Auth::User()->loginname,
                            'case_number' => $case_number,
                            'status' => $status,
                            'date' => date('d/m/Y h:i A'),
                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                        ];
                        $setEmail->send($mailData);
                    }

                    //notify to all ccpersons
                    //added control bt phase 4 ( jerry to reduce the size of ccs)
                       $checkapprover = ModelFactory::getInstance('Approver')
                    ->where('ams_approver_person.app_id', '=', $app_id)
                 ->where('ams_approver_person.id', $request->approver_id)

                    ->first();

              $checkfinalapprover = ModelFactory::getInstance('Approver')
                    ->where('ams_approver_person.app_id', '=', $app_id)
                     ->orderby('position','DESC')
                    ->first();
                    if(($request->status == 1 && $checkfinalapprover->id == $checkapprover->id) || $request->status == 2)
                    {
                    $result_ccperson = [];
                    if($applicant->getCcpersons){
                        foreach($applicant->getCcpersons as $ccperson_unq) {
                            $result_ccperson[] = $ccperson_unq->user_id;
                        }
                        if($result_ccperson){
                            $ccpersons = array_unique($result_ccperson);
                            foreach ($ccpersons as $ccperson) {
                                $loginname = ( $ccperson != \Auth::User()->idsrc_login ? \Auth::User()->loginname : '');
                                $personReceiveEmail = $this->selectUserBy($ccperson, array('loginname','emailadd'));
                                $setEmail = LibraryFactory::getInstance('Email');
                                $setEmail->personToReceive = $personReceiveEmail;
                                $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                                $setEmail->layout = 'mail.mail_notification';
                                $mailData = [
                                    'receiver_name' => $personReceiveEmail->loginname,
                                    'sender_name' => $loginname,
                                    'status' => $status,
                                    'case_number' => $case_number,
                                    'date' => date('d/m/Y h:i A'),
                                    'url' => url('/application/view_details/'.$app_id, $secure = null),
                                ];
                                $setEmail->send($mailData);
                            }
                        }
                    }
                    }

                    DB::commit();
                    switch ($request->status) {
                        case '1':
                            return redirect('/application/view_details/'.$app_id)
                                    ->with('success_message', 'Case '.$case_number.' has been approved!');
                        case '4':
                            return redirect('/application/view_details/'.$app_id)
                                    ->with('info_message', 'Case '.$case_number.' has been forwarded!');
                        case '2':
                            return redirect('/application/view_details/'.$app_id)
                                ->with('success_message', 'Case '.$case_number.' has been rejected!');
                    }
                }
            }
        } else {
            return redirect('/application/view_details/'.$app_id)
                        ->withErrors($validator)
                        ->withInput();
        }

    }

    /**
     * comment post
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function commentapp(Request $request){

        DB::beginTransaction();

        $app_id = $request->app_id;
        $status = $request->case_status;
        $case_number = $request->case_number;
        $case_title = $request->case_title;

        $validator = Validator::make($request->all(), [
            'comments' => 'required',
        ]);

        if (!$validator->fails()) {
            $app = ModelFactory::getInstance('Ccperson');
            $app->user_id = \Auth::User()->idsrc_login;
            $app->app_id = $request->app_id;
            $app->remarks = $request->comments;
            $app->case_status = $request->case_status;
            $app->status = 5;

            if($app->save()){

                $applicant = $getform = ModelFactory::getInstance('Application')
                ->where('id',$app_id)
                ->with(['getApplicant' => function($query){ $query->select('*'); },
                        'getApprovers' => function($query){ $query->select('*'); },
                        'getCcpersons' => function($query){ $query->select('*'); },
                        'getAppForms' => function($query){ $query->select('*'); },
                        ])
                ->first();

                //notify to applicant
                if($applicant->getApplicant){
                    $setEmail = LibraryFactory::getInstance('Email');
                    $setEmail->personToReceive = $applicant->getApplicant;
                    $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                    $setEmail->layout = 'mail.mail_comment';
                    $mailData = [
                        'receiver_name' => $applicant->getApplicant->loginname,
                        'sender_name' => \Auth::User()->loginname,
                        'case_number' => $case_number,
                        'date' => date('d/m/Y h:i A'),
                        'url' => url('/application/view_details/'.$app_id, $secure = null),
                    ];
                    $setEmail->send($mailData);
                }

                //notify to all approvers
                if($applicant->getApprovers){
                    foreach ($applicant->getApprovers as $approver) {
                                                //Notify to group
                               if($approver->group_id > 0)
                    {

                      $select = ['id','user_id'];
                     $FlexiGroupPerson = ModelFactory::getInstance('FlexiGroupPerson')->where('group_id','=',$approver->group_id)->get($select)->toArray();
                      $FlexiGroup = ModelFactory::getInstance('FlexiGroup')->where('id','=',$approver->group_id)->get($select)->toArray();


                    foreach ($FlexiGroupPerson as $key => $value2) {

                        $personReceiveEmail = $this->selectUserBy($approver->user_id, array('loginname','emailadd'));
                            if($personReceiveEmail){

                        $setEmail = LibraryFactory::getInstance('Email');
                        $setEmail->personToReceive = '['.$FlexiGroup->name.'] '.$personReceiveEmail;
                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                        $setEmail->layout = 'mail.mail_comment';
                        $mailData = [
                            'receiver_name' => $personReceiveEmail->loginname,
                            'sender_name' => \Auth::User()->loginname,
                            'case_number' => $case_number,
                            'date' => date('d/m/Y h:i A'),
                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                        ];
                        $setEmail->send($mailData);
                        }
                }
                   // Notify to normal
                         }else{


                        $personReceiveEmail = $this->selectUserBy($approver->user_id, array('loginname','emailadd'));
                        $setEmail = LibraryFactory::getInstance('Email');
                        $setEmail->personToReceive = $personReceiveEmail;
                        $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                        $setEmail->layout = 'mail.mail_comment';
                        $mailData = [
                            'receiver_name' => $personReceiveEmail->loginname,
                            'sender_name' => \Auth::User()->loginname,
                            'case_number' => $case_number,
                            'date' => date('d/m/Y h:i A'),
                            'url' => url('/application/view_details/'.$app_id, $secure = null),
                        ];
                        $setEmail->send($mailData);
                         }
                    }
                }

                //notify to all ccpersons
              /* due to changes of phase 4 ( reduce the size of cc ( comment)
               *  $result_ccperson = [];
                if($applicant->getCcpersons){
                    foreach($applicant->getCcpersons as $ccperson_unq) {
                        $result_ccperson[] = $ccperson_unq->user_id;
                    }
                    if($result_ccperson){
                        $ccpersons = array_unique($result_ccperson);
                        foreach ($ccpersons as $ccperson) {
                            $loginname = ( $ccperson != \Auth::User()->idsrc_login ? \Auth::User()->loginname : '');
                            $personReceiveEmail = $this->selectUserBy($ccperson, array('loginname','emailadd'));
                            $setEmail = LibraryFactory::getInstance('Email');
                            $setEmail->personToReceive = $personReceiveEmail;
                            $setEmail->subject = '[SRC-AMS] '.$case_title.' [Case #'.$case_number.']'. ' - ' .$applicant->getAppForms->name;
                            $setEmail->layout = 'mail.mail_comment';
                            $mailData = [
                                'receiver_name' => $personReceiveEmail->loginname,
                                'sender_name' => $loginname,
                                'case_number' => $case_number,
                                'date' => date('d/m/Y h:i A'),
                                'url' => url('/application/view_details/'.$app_id, $secure = null),
                            ];
                            $setEmail->send($mailData);
                        }
                    }
                } */

                DB::commit();
                return redirect('/application/view_details/'.$app_id)
                            ->with('success_message', 'You have successfully comment Case '.$case_number.'!');
            }

         } else {

            return redirect('/application/view_details/'.$app_id)
                        ->withErrors($validator)
                        ->withInput();
         }

    }

    /**
     * send email function
     * @param  [type] $layout   [description]
     * @param  [type] $data     [description]
     * @param  [type] $criteria [description]
     * @param  [type] $subject  [description]
     * @return [type]           [description]
     */
    public function send_email($layout, $data, $criteria, $subject){
        Mail::send($layout,$data,function($message) use ($criteria, $subject){
            $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $message->to($criteria->emailadd)->subject($subject);
        });
    }

    /**
     * delay email function
     * @param  [type] $sec      [description]
     * @param  [type] $layout   [description]
     * @param  [type] $data     [description]
     * @param  [type] $criteria [description]
     * @param  [type] $subject  [description]
     * @return [type]           [description]
     */
    public function delay_email($sec, $layout, $data, $criteria, $subject){
        Mail::later($sec, $layout,$data,function($message) use ($criteria, $subject){
            $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
            $message->to($criteria->emailadd)->subject($subject);
        });
    }

    /**
     * select user by ID
     * @param  [type] $id     [description]
     * @param  [type] $select [description]
     * @return [type]         [description]
     */
    public function selectUserBy($id, $select){
        return ModelFactory::getInstance('User')
                    ->where('idsrc_login', '=', $id)
                    ->first($select);
    }

    public function questionnaireStore(Request $request)
    {
      $input = array_except($request->all(), '_token');

      // dd($input);

      $verifier = \App::make('validation.presence');
      $verifier->setConnection('mysql');

      $validator = \Validator::make($request->all(), [
        'question' => \App\Http\Models\QuestionnaireAnswer::questionRule(),
        'answer' => \App\Http\Models\QuestionnaireAnswer::answerRule(),
      ]);

      $validator->setPresenceVerifier($verifier);

      if ($validator->fails()) {
        return redirect('/application/view_details/'.$request->app_id.'/feedback')
                ->withErrors($validator)
                ->withInput();
      }

      else {

        $this->sendMailToRO($input);

        // foreach($request->question as $index=>$row)
        // {
        //   $model = ModelFactory::getInstance('QuestionnaireAnswer');
        //
        //   if(is_array($request->answer[$index]))
        //   {
        //     $model->answer = implode(",", $request->answer[$index]);
        //   }
        //
        //   else
        //   {
        //     $model->answer = $request->answer[$index];
        //   }
        //
        //   $model->question = $request->question[$index];
        //   $model->questionnairedetail_id = $request->question[$index];
        //   $model->app_id = $request->app_id;
        //   $model->questionnaire_id = $request->questionnaire_id;
        //   $model->save();
        // }
        //
        // // update application status from 6(Feedback Required) to 7(Feedback Given)
        // $applicationModel = ModelFactory::getInstance('Application')->where('id','=',$request->app_id)->first();
        // $applicationModel->status = 7;
        // $applicationModel->save();

        return redirect('/application/view_details/'. $request->app_id)
               ->with('success', 'Successfully submitted form.');
      }
    }

    public function sendMailToRO($input)
    {
      $result = ModelFactory::getInstance('QuestionnaireDetail')
                    ->where('questionnaire_id','=',$input['questionnaire_id'])
                    ->select('question', 'answer_input_type')
                    ->get();

      foreach($result as $data)
      {
        $input['questions'][] = $data->question;
        $input['answer_input_type'][] = $data->answer_input_type;
      }

      $feedback['questions'] = $input['questions'];
      $feedback['answers'] = $input['answer'];
      $feedback['answer_input_type'] = $input['answer_input_type'];

      $dept_ro = ModelFactory::getInstance('User')
                  ->leftjoin('departments', 'users.deptid', '=', 'departments.idsrc_departments')
                  ->where('users.idsrc_login', \Auth::user()->idsrc_login)
                  ->select('departments.dept_ro as id', 'loginname')
                  ->first();

      $ro_email = ModelFactory::getInstance('User')
                  ->where('users.idsrc_login', $dept_ro->id)
                  ->select('loginname', 'emailadd')
                  ->first();

      $setEmail = LibraryFactory::getInstance('Email');
      $setEmail->personToReceive = $ro_email->emailadd;
      $setEmail->subject = "Summary of Questionnaire";
      $setEmail->layout = 'mail.mail_summary';

      $mailData = [
        'receiver_name' => $dept_ro->loginname,
        'sender_name' => "RO",
        'date' => date('d/m/Y h:i A'),
        'feedback' => $feedback
      ];

      $setEmail->send($mailData);
    }
}
