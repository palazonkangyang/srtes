<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Factories\ModelFactory;
use Auth;
use Response;

class NewApplicationRequest extends Request
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $general = ['urgency' => 'required'];

    if(Request::get('type_form') == 2)
    {
    	$added_validate = [
    	   'number_of_copies' => 'required|numeric',
    			'reasons_for_color_printing' => 'required',
    			'conditions' => 'required'
    	];

    }

    else if(Request::get('type_form') == 3)
    {
    	$added_validate = [
    	   'number_of_copies' => 'required|numeric',
    			'reasons_for_request' => 'required',
    			'conditions' => 'required'
    	];
    }

    else if(Request::get('type_form') == 4)
    {
      $added_validate = [
          'email_account_name' => 'required|email',
          'reasons' => 'required',
          'conditions' => 'required'
      ];
    }

    else if(Request::get('type_form') == 5)
    {
      $added_validate = [
          'type' => 'required',
          'group_exist' => 'required',
          'email_address' => 'required|email',
          'group_email' => 'required|email',
          'instructions' => 'required',
          'conditions' => 'required'
      ];
    }

    else if(Request::get('type_form') == 6)
    {
      $added_validate = [
          'type' => 'required',
      ];

      if(Request::get('type') == 1)
      {
        $added_validate_extra = [
            'employees_name' => 'required',
            'create_prpo' => 'required_without_all:approve_pr,others',
            'approve_pr' => 'required_without_all:create_prpo,others',
            'others' => 'required_without_all:approve_pr,create_prpo',
        ];

        if(Request::get('others') == 1)
        {
          $added_validate_extra = [
              'others_name' => 'required',
          ];
        }
      }

      else if(Request::get('type') == 2)
      {
        $added_validate_extra = [
            'reasons' => 'required',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 7)
    {
      $added_validate = [
          'email_address' => 'required',
          'account_unused' => 'required_without_all:staff_departure,project_closed',
          'staff_departure' => 'required_without_all:account_unused,project_closed',
          'project_closed' => 'required_without_all:staff_departure,account_unused',
          'transfer_google_files' => 'required',
      ];

      if(Request::get('transfer_google_files') == 1)
      {
        $added_validate_extra = [
            'email_destination' => 'required|email',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 8)
    {
      $added_validate = [
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
      ];
    }

    else if(Request::get('type_form') == 9)
    {
      $added_validate = [
          'booking_date_start' => 'required',
          'booking_date_end' => 'required',
          'purpose_of_use' => 'required',
          'layout_arrangement' => 'required',
          'number_of_pax' => 'required|numeric',
      ];

      if(Request::get('layout_arrangement') == 3)
      {
        $added_validate_extra = [
          'others' => 'required',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 10)
    {
      $added_validate = [
          'date_time_damage' => 'required',
          'damage_description' => 'required',
          'operations_affected' => 'required',
      ];
    }

    else if(Request::get('type_form') == 11)
    {
      $added_validate = [
          'booking_date_start' => 'required',
          'booking_date_end' => 'required',
          'purpose_of_use' => 'required',
          'driver_requested' => 'required',
          'vehicle_type' => 'required',
          'number_of_hours' => 'required',
          'total_amount' => 'required|numeric',
      ];

      if(Request::get('driver_requested') == 2 || Request::get('driver_requested') == 3)
      {
        $added_validate_extra = [
            'driver_name' => 'required',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 12)
    {
      $added_validate = [
          'cheque_payable_to' => 'required',
          'project_name' => 'required',
          'advance_received' => 'required|numeric',
          'total' => 'required|numeric',
          'balance' => 'required|numeric',
          'budget_code' => 'required',
          'date_event' => 'required',
          'request_type' =>'required',
          'p_accountcode_id' => 'required',
      ];

      foreach(Request::get('item_id') as $key => $val)
      {
        $added_validate['item_company.'.$key] = 'required';
        $added_validate['item_total.'.$key] = 'required|numeric';
        $added_validate['item_date.'.$key] = 'required';
      }

      $todaydate = date('Y-m-d');
      $todaydate=date('Y-m-d', strtotime($todaydate. ' + 30 days'));

      $dateeventdate = date('Y-m-d', strtotime(Request::get('date_event')));

      if ($todaydate <$dateeventdate)
      {
        $added_validate_extra = [
            'reasons' => 'required|min:20',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 13)
    {
      $added_validate = [
          'cheque_payable_to' => 'required',
          'project_name' => 'required',
          'amount' => 'required|numeric',
          'date_required' => 'required',
          'request_type' =>'required',
          'p_accountcode_id' => 'required',
      ];

      $todaydate = date('Y-m-d');
      $todaydateafter14=date('Y-m-d', strtotime($todaydate. ' + 14 days'));

      $daterequireddate = date('Y-m-d', strtotime(Request::get('date_required')));

      if ($todaydateafter14 >$daterequireddate)
      {
        $added_validate_extra = [
            'reasons' => 'required|min:20',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 14)
    {
      $added_validate = [
          'title' => 'required',
          'payee_name' => 'required',
          'project' => 'required',
          'total' => 'required|numeric',
      ];

      foreach(Request::get('item_id') as $key => $val)
      {

      }

    }

    else if(Request::get('type_form') == 20)
    {
      $added_validate = [
          'title' => 'required',
          'project' => 'required',
          'total' => 'required|numeric',
      ];

      foreach(Request::get('item_id') as $key => $val)
      {

      }
    }

    else if(Request::get('type_form') == 15)
    {
      $added_validate = [
          'position' => 'required',
          'job_grade' => 'required',
          'location' => 'required',
          'job_type' => 'required',
      ];

      if(Request::get('job_type') == 1 )
      {
        if(Request::get('full_time_option') == 1 )
        {
          $added_validate_extra = [
              'full_time_option' => 'required',
              'full_type_desc' => 'required',
          ];
        }

        else if(Request::get('full_time_option') == 2 )
        {
          $added_validate_extra = [
              'full_time_option' => 'required',
          ];

        }

        else if(Request::get('full_time_option') == 3 )
        {
          $added_validate_extra = [
              'full_time_option' => 'required',
              'full_type_desc3' => 'required',
          ];
        }
      }

      else
      {
        $added_validate_extra = [
            'no_months' => 'required|integer',
            'no_hoursday' => 'required|integer',
            'no_daysweek' => 'required|integer',
        ];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 16)
    {
      $added_validate = [
          'designation' => 'required',
          'service_status' => 'required',
          'type_training' => 'required',
          'title' => 'required',
          // 'provider' => 'required',
          'isfunds' => 'required',
          'fee' => 'required|numeric',
          'budget_availability' => 'required',
      ];

      foreach(Request::get('item_id') as $key => $val)
      {
        $added_validate['item_date.'.$key] = 'required';
      }

      //  foreach(Request::get('item_idal') as $key => $val)
      // {
      //
      //   $added_validate['item_name.'.$key] = 'required';
      //     $added_validate['item_nric.'.$key] = 'required';
      //       $added_validate['item_costcentre.'.$key] = 'required';
      // }

      if(Request::get('isfunds') == 1 )
      {
        $added_validate_extra = [
            'funds' => 'required|numeric',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 17)
    {
      $added_validate = [
          'estimate_value' => 'required',
          'type_source' => 'required',
          'type_reason' => 'required',
          'date_required' => 'required',
          'detailed_information' => 'required',
      ];

      if(Request::get('type1') == 1 )
      {
        $added_validate_extra = [
            'goods' => 'required',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      if(Request::get('type2') == 1 )
      {
        $added_validate_extra2 = [
            'services' => 'required',
        ];
      }

      else
      {
        $added_validate_extra2 = [];
      }

      if(Request::get('type_source') == 3 )
      {
        $added_validate_extra3 = [
            'funding_desc' => 'required',
        ];
      }

      else
      {
        $added_validate_extra3 = [];
      }

      if(Request::get('type_reason') == 3 )
      {
        $added_validate_extra4 = [
            'reason_desc' => 'required',
        ];
      }

      else
      {
        $added_validate_extra4 = [];
      }

      $added_validate = array_merge($added_validate_extra,$added_validate_extra2,$added_validate_extra3,$added_validate_extra4, $added_validate);
    }

    else if(Request::get('type_form') == 18)
    {
      $added_validate = [
          'desc_purchased' => 'required',
          'reasons' => 'required',
          'vendor' => 'required',
          'amount' => 'required|numeric',
      ];

      if(Request::get('chk_inv') == 1 )
      {
        $added_validate_extra = [
            'pr_no' => 'required',
            'po_no' => 'required',
            'grn_no' => 'required',
            'inv_no' => 'required',
        ];
      }

      else if(Request::get('chk_grn') == 1 )
      {
        $added_validate_extra = [
            'pr_no' => 'required',
            'po_no' => 'required',
            'grn_no' => 'required',
        ];
      }

      else if(Request::get('chk_po') == 1 )
      {
        $added_validate_extra = [
            'pr_no' => 'required',
            'po_no' => 'required',
        ];
      }

      else if(Request::get('chk_pr') == 1 )
      {
        $added_validate_extra = [
            'pr_no' => 'required',
        ];
      }

      else
      {
        $added_validate_extra = [];
      }

      $added_validate = array_merge($added_validate_extra, $added_validate);
    }

    else if(Request::get('type_form') == 19)
    {
      $added_validate = [
          'description' => 'required',
          'justifications' => 'required',
          'accountcode' => 'required',
          'isBudgeted' => 'required',
          'isCapex' => 'required',
          'item_checked'=>'required',
          'conditions' => 'required',
      ];
    }

    else
    {
    	$added_validate = [
    			'title' => 'required|max:255',
    		   'request_details' => 'required'
    	];
    }

    $general = array_merge($added_validate, $general);

    return $general;
  }

  public function response(array $errors)
  {
    if ($this->ajax() || $this->wantsJson())
    {
      return Response::json(array('errors' => $errors), 422);
    }

    return $this->redirector->to($this->getRedirectUrl())
                            ->withInput($this->except($this->dontFlash))
                            ->withErrors($errors, $this->errorBag);
    }
}
