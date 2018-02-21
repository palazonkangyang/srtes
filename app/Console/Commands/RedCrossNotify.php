<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Core\ControllerCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\LibraryFactory;
use App\Http\Requests\NewApplicationRequest;
use App\Libraries\FileLibrary;
use Response;
use Validator;
use Carbon\Carbon;

class RedCrossNotify extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'redcross:notify';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Red Cross Notification scheduler.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    try
    {
      $this->info("Date Cron Started: ".date('Y-m-d H:m:s'));

      $this->comment("Send Email Notification...");
      $this->execNotification();

      $this->checkCron();

      //$this->comment("Clear all 'yesterday' files in /tmp folder...");
      //$this->clear_files();

      $this->info("Date Cron Finished: ".date('Y-m-d H:m:s'));
    }

    catch (QueryException $e )
    {
      $this->error($e->getMessage());
    }
  }

  public function execNotification()
  {
    $carbon = new Carbon();
    $today = $carbon->format('Y-m-d H');

    $select = ['created_at','urgency','id','created_id','case_number','title'];
    $apps = ModelFactory::getInstance('Application')
            ->where('status', '=', '0')
            ->get($select);

    foreach ($apps as $app)
    {
      $creator =  $this->selectUserBy($app->created_id, array('loginname','emailadd'));
      $to_date =  \Carbon\Carbon::createFromTimeStamp(strtotime($app->created_at))->format('d/m/Y h:i A');
      $app_id = $app->id;
      $link = url('/application/view_details/'.$app_id, '', $secure = null);
      $check = 'approver';
      $subject = 'SRC Approval Management System';

      $form_name = ModelFactory::getInstance('Forms')
                    ->where('id',$app->type_form)
                    ->first(['name']);

      //to check is it last approver so can continue send reminder email
      $finalapprover = ModelFactory::getInstance('Approver')
                        ->where('ams_approver_person.app_id', '=', $app->id)
                        ->where('ams_approver_person.forward', '=', '1')
                        ->orderby('position','desc')
                        ->first();

      $finalapproverdate = \Carbon\Carbon::createFromTimeStamp(strtotime($finalapprover->date_to_email))->format('Y-m-d H');

      if($finalapproverdate == $today)
      {
        $finalapproveruser = $this->selectUserBy($finalapprover->user_id, array('loginname','emailadd'));

        $to_name = $finalapproveruser->loginname;
        $to_mail = $finalapproveruser->emailadd;
        $mail_data = array(
          'to_name' => $to_name,
          'to_email' => $to_mail,
          'name_submitted' => $creator->loginname,
          'date' => $to_date,
          'app_link' => $link,
        );

        $this->send_email('mail.mail_remind_finalapprover', $mail_data, $finalapproveruser, $subject);
      }

      //init skip all approver step to final approver level
      $essentials = ModelFactory::getInstance('Approver')
                    ->where('ams_approver_person.app_id', '=', $app->id)
                    ->where('ams_approver_person.forward', '=', '0')
                    ->get();

      // cron job to by pass the approver
      foreach ($essentials as $ess)
      {
        $cess = \Carbon\Carbon::createFromTimeStamp(strtotime($ess->date_to_email))->format('Y-m-d H');

        if($cess == $today)
        {
          $this_essential = $this->selectUserBy($ess->user_id, array('loginname','emailadd'));

          $upforward = ModelFactory::getInstance('Approver')->find($ess->id);
          $upforward->forward = 1;
          $upforward->save();

          //general email data to skipped approver
          $skippedapproverdata = ModelFactory::getInstance('Approver')
                                  ->where('ams_approver_person.app_id', '=', $app->id)
                                  ->where('ams_approver_person.forward', '=', '1')
                                  ->where('ams_approver_person.read', '=', '0')
                                  ->where('ams_approver_person.status', '=', '0')
                                  ->get();

          $skippedapprover = ModelFactory::getInstance('Approver')
                              ->find($skippedapproverdata->id);

          //update skipped approval read and status
          $skippedapprover->read = 1;
          $skippedapprover->status = 1;
          $skippedapprover->save();

          $skippedapproveruser =  $this->selectUserBy($skippedapprover->user_id, array('loginname','emailadd'));

          $to_name = $skippedapproveruser->loginname;
          $to_mail = $skippedapproveruser->emailadd;

          $mail_data = array(
            'to_name' => $to_name,
            'to_email' => $to_mail,
            'name_submitted' => $creator->loginname,
            'date' => $to_date,
            'app_link' => $link,
          );

          $this->comment("Send skip email...");
          $this->send_email('mail.mail_skipped_approver', $mail_data, $skippedapproveruser, $subject);
          $this->comment("done send skip email");

          //general email data to next approval
          $to_name = $this_essential->loginname;
          $to_mail = $this_essential->emailadd;

          $mail_data = array(
            'to_name' => $to_name,
            'to_email' => $to_mail,
            'name_submitted' => $creator->loginname,
            'date' => $to_date,
            'app_link' => $link,
            'skipped_name' => $skippedapproveruser->loginname ,
          );

          $this->send_email('mail.mail_cron_next_approver', $mail_data, $this_essential, $subject);
        }
      }
    }
  }

  public function clear_files()
  {
    $carbon = new Carbon();

    $configPath = public_path().'/uploads/tmp';
    $files = \File::allFiles($configPath);

    if($files)
    {
      foreach ($files as $file)
      {
        $file_date = (string)date("Y-m-d",filemtime($file));
        $yest_date = $carbon->parse()->subDays(10)->format('Y-m-d');

        if($file_date == $yest_date)
        {
          \File::delete($file);
        }
      }
    }
  }

  public function checkCron()
  {
    $criteria = ['email'=>'kangyang.lau@palazon.com'];
    $subject = 'Cron Running Every One Hour';

    $data = array(
    	'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
    );

    \Mail::send('mail.cronmail',$data,function($message) use ($criteria, $subject){
        $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System Check Cron');
        $message->to($criteria['email'])->subject($subject);
    });
  }

  public function send_email($layout, $data, $criteria, $subject)
  {
    \Mail::send($layout,$data,function($message) use ($criteria, $subject){
      $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System');
      $message->to($criteria->emailadd)->subject($subject);
    });
  }

  public function selectUserBy($id, $select)
  {
    return ModelFactory::getInstance('User')
            ->where('idsrc_login', '=', $id)
            ->first($select);
  }
}
