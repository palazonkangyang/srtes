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

class PaymentProcessingNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paymentprocessing:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Red Cross Payment processing scheduler.';

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
        try {
            $this->info("Date Cron Started: ".date('Y-m-d H:m:s'));

            $this->comment("Send Email Notification...");
          $this->execNotification();
			
            $this->checkCron();
            
            //$this->comment("Clear all 'yesterday' files in /tmp folder...");
            //$this->clear_files();

            $this->info("Date Cron Finished: ".date('Y-m-d H:m:s'));
        } catch (QueryException $e ) {
            $this->error($e->getMessage());
        }

    }

    public function execNotification()
    {
        $carbon = new Carbon();
        $today = $carbon->format('Y-m-d H');

       

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
            'ams_applications.total',
            'ams_forms.name as form_name'
        ];
        //cash advance( request / acquittal only)
              $forms = ModelFactory::getInstance('Forms');    
          $requestToForm = ModelFactory::getInstance('RequestToForm') ->select('form_id')
                   ->whereIn('form_id', [12, 13,14,20])
               
            ->where('request_id', 1)->get()->toArray();
         
        $prepare = ModelFactory::getInstance('Application')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')  
            ->orderBy('ams_applications.created_at','DESC')
            ->where('ams_applications.drafts', '=', 0)
             ->where('ams_applications.status', '=', 1)
                ->where('ams_applications.pp_status', '=', 0)
             ->whereIn('ams_applications.type_form', $requestToForm)
            ->select($select)
                ->get()->toArray();

                 $GlobalSetting = ModelFactory::getInstance('GlobalSetting')   
                    ->where('id','=',1)
                    ->first();
                          	$criteria = ['email'=>$GlobalSetting->value];
    	$subject = 'PaymentProcessingNotify';
                          $mail_data = array(                     
                            'date' => $today  
                        );

                          
                              \Excel::create('PaymentProcessingNotify_'.$today, function($excel) use($prepare) {

    $excel->sheet('Sheetname', function($sheet) use($prepare) {

      // Array that will be used to generate the sheet
$sheetArray = array();

// Add the headers
$sheetArray[] = array('Case Number','Name','Email','Total');

// Add the results
foreach($prepare  as $row){
   
    $sheetArray[] = array($row['case_number'],$row['name'],$row['email'],$row['total']);
}

// Generating the sheet from the array
$sheet->fromArray($sheetArray);

    });

})->store('xls', storage_path('excel/payment_processing_exports'));
                          
                          
\Mail::send('mail.paymentprocessingnotify',$mail_data,function($message) use ($criteria, $subject,$today){
            $message->from('do-not-reply@redcross.sg', 'SRC Approval Management System Check Cron');
$message->attach(storage_path('excel/payment_processing_exports/').'PaymentProcessingNotify_'.$today.'.xls');
            $message->to($criteria['email'])->subject($subject);
 });
    
    }

    public function clear_files(){
        $carbon = new Carbon();

        $configPath = public_path().'/uploads/tmp';
        $files = \File::allFiles($configPath);

        if($files){
            foreach ($files as $file){
                $file_date = (string)date("Y-m-d",filemtime($file));
                $yest_date = $carbon->parse()->subDays(10)->format('Y-m-d');

                if($file_date == $yest_date){
                    \File::delete($file);
                }
            }
        }
    }
    
    public function checkCron(){
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


  

    public function selectUserBy($id, $select){

        return ModelFactory::getInstance('User')
                    ->where('idsrc_login', '=', $id)
                    ->first($select);

    }

}
