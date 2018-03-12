<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;
use OwenIt\Auditing\AuditingTrait;

class Application extends Model {

  use AuditingTrait;

  public static $logCustomMessage = '{user.loginname|Anonymous} submit a {new.type_request} form  {elapsed_time}'; // with default value

  public static $logCustomFields = [
    'case_number' => [
      'updated' => 'Case Number: {new.case_number} ',
    ],

    'title' => [
      'updated' => 'title: {new.title} ',
    ]

  ];

	protected $table = 'ams_applications';

	const PENDING_STATUS = 0;
  const APPROVED_STATUS = 1;
  const REJECETED_STATUS = 2;
  const CANCELLED_STATUS = 3;
  const FORWARDED_STATUS = 4;

  const AMS_FORM_DEFAULT = 1; /*Default form*/
  const AMS_FORM_RCP = 2; 	/*Request For Color Printing*/
  const AMS_FORM_RCA = 3; 	/*Request For Certificate of Appreciation*/
  const AMS_FORM_AREA = 4; 	/*Application For RedCross Email Account*/
  const AMS_FORM_ARGE = 5; 	/*Application For RedCross Group Email*/
  const AMS_FORM_CDSAA = 6; 	/*Creation/Deletion For SAGE ACCPAC Account*/
  const AMS_FORM_RDRA = 7; 	/*Request For Deletion Of RedCross Account*/
  const AMS_FORM_ATAC = 8; 	/*Application For Temporary Access Card*/
  const AMS_FORM_HPHCRF = 9; 	/*Haw Par Hall Configuration Request Form*/
  const AMS_FORM_MJR = 10; 	/*Maintenance Job Request*/
  const AMS_FORM_PGVBF= 11; 	/*Passenger/Goods Van Booking Form*/
  const AMS_FORM_SORAPFCA = 12; 	/*Statement Of Receipts And Payments For Cash Advance*/
  const AMS_FORM_ACA = 13; 	/*Advance Cash Application*/
  const AMS_FORM_PCMCF = 14; 	/*Petty Cash / Miscellaneous Claim Form*/
  const AMS_FORM_MRF = 15; 	/*Manpower Request Form*/
  const AMS_FORM_TSW = 16; 	/*Application For Training / Seminar / Workshop*/
  const AMS_FORM_IRFI = 17; 	/*Internal Request For Information (RFI)*/
  const AMS_FORM_COPRPO = 18; 	/*Request For Cancellation Of PR/PO*/
  const AMS_FORM_EOQ = 19; 	/*Evaluation of Quatations*/

  public $statusNames = [
    self::PENDING_STATUS => 'Pending',
    self::APPROVED_STATUS => 'Approved',
    self::REJECETED_STATUS => 'Rejected',
    self::CANCELLED_STATUS => 'Cancelled',
    self::FORWARDED_STATUS => 'Forwarded',
  ];

	public $timestamps = true;

	/**
	 * @Applications relation to approver
	 *
	 */
	public function getApplicant()
	{
		return $this->belongsTo('App\Http\Models\User','created_id');
	}

	/**
	 * @Applications relation to approver
	 *
	 */
	public function getApprovers()
	{
		return $this->hasMany('App\Http\Models\Approver','app_id');
	}

	/**
	 * @Applications relation to ccperson
	 *
	 */
	public function getCcpersons()
	{
		return $this->hasMany('App\Http\Models\Ccperson','app_id');
	}

	/**
	 * @Applications relation to ccperson
	 *
	 */
	public function getAppForms()
	{
		return $this->belongsTo('App\Http\Models\Forms','type_form');
	}
}
