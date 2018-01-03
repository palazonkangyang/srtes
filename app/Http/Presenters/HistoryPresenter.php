<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use Illuminate\Http\Request;
use App\Factories\FilterFactory;
use App\Factories\PresenterFactory;
use App\Filters\SelectFilter;
use App\Http\Presenters\ApplicationPresenter;
use Response;

class HistoryPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->view->title = 'History';
        return $this->view('history.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function approverHistory()
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
            'ams_forms.name as form_name'
        ];

        $prepare = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_applications.id', '=', 'ams_approver_person.app_id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
            ->where('ams_approver_person.user_id', '=', $user_id)
            ->where('ams_approver_person.read', '=', 1)
            ->where('ams_approver_person.forward', '=', 1)
            ->orderBy('ams_applications.created_at','DESC')
            ->select($select); 

            $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
            $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
            $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
            $this->view->urgencyFilter = $urgencyFilter;
            
            $this->view->department = PresenterFactory::getInstance('Application')->getDepartment();
            $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
            $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
            $departmentFilter->setOptions($this->view->department);
            $this->view->departmentFilter = $departmentFilter;
            
            $this->view->tof = PresenterFactory::getInstance('Application')->getTypeRequest();
            $tofFilter = FilterFactory::getInstance('Select','Typeofrequest',SelectFilter::SINGLE_SELECT);
            $prepare = $tofFilter->addFilter($prepare,'typeofrequest','byTof');
            $tofFilter->setOptions($this->view->tof);
            $this->view->tofFilter = $tofFilter;
            
            $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
            $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
            $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
            $this->view->statusFilter = $statusFilter;
            
            $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
            $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
            $this->view->fromtoFilter = $fromtoFilter;
            
            $searchFilter = FilterFactory::getInstance('Text','Search');
            $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
            $this->view->searchFilter = $searchFilter;
            
            //add search filter
            $searchFilter = FilterFactory::getInstance('Text','Search');
            $prepare = $searchFilter->addFilter($prepare,'search','searchMyApplication');
            $this->view->searchFilter = $searchFilter;
        
        $this->view->approverhistorylist = $this->paginate($prepare);
        $this->view->title = 'Approver History';
        return $this->view('history.approverHistory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function ccpersonHistory()
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
            'ams_forms.name as form_name'
        ];

        $prepare = ModelFactory::getInstance('Ccperson')
            ->leftjoin('ams_applications', 'ams_applications.id', '=', 'ams_cc_person.app_id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->leftjoin('ams_forms', 'ams_forms.id', '=', 'ams_applications.type_form')
            
            ->where('ams_cc_person.user_id', '=', $user_id)
            ->distinct()
            ->orderBy('ams_applications.created_at','DESC')
            ->select($select); 

            $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);
            $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
            $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
            $this->view->urgencyFilter = $urgencyFilter;
            
            $this->view->department = PresenterFactory::getInstance('Application')->getDepartment();
            $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);
            $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
            $departmentFilter->setOptions($this->view->department);
            $this->view->departmentFilter = $departmentFilter;
            
            $this->view->tof = PresenterFactory::getInstance('Application')->getTypeRequest();
            $tofFilter = FilterFactory::getInstance('Select','Typeofrequest',SelectFilter::SINGLE_SELECT);
            $prepare = $tofFilter->addFilter($prepare,'typeofrequest','byTof');
            $tofFilter->setOptions($this->view->tof);
            $this->view->tofFilter = $tofFilter;
            
            $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);
            $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
            $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
            $this->view->statusFilter = $statusFilter;
            
            $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
            $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
            $this->view->fromtoFilter = $fromtoFilter;
            
            $searchFilter = FilterFactory::getInstance('Text','Search');
            $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
            $this->view->searchFilter = $searchFilter;
            
            //add search filter
            $searchFilter = FilterFactory::getInstance('Text','Search');
            $prepare = $searchFilter->addFilter($prepare,'search','searchMyApplication');
            $this->view->searchFilter = $searchFilter;
        $this->view->ccpersonhistorylist = $this->paginate($prepare);

        $this->view->title = 'CCperson History';
        return $this->view('history.ccpersonHistory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function saveDrafts()
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
            'ams_applications.status'
        ];

        $prepare = ModelFactory::getInstance('Application')
            ->join('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_applications.created_id')
            ->where('ams_applications.created_id', '=', $user_id)
            ->where('ams_applications.drafts', '=', 1)
                 ->where('ams_applications.status', '!=', 3)
            ->orderBy('ams_applications.created_at','DESC')
            ->select($select);

        $urgencyFilter = FilterFactory::getInstance('Select','Urgency',SelectFilter::SINGLE_SELECT);   
        $prepare = $urgencyFilter->addFilter($prepare,'urgency','byUrgency');
        $urgencyFilter->setOptions(array('' => '-- Select Urgency --', '1' => 'Normal', '2' => 'Urgent'));
        $this->view->urgencyFilter = $urgencyFilter;

        $this->view->department = PresenterFactory::getInstance('Application')->getDepartment();
        $departmentFilter = FilterFactory::getInstance('Select','Department',SelectFilter::SINGLE_SELECT);   
        $prepare = $departmentFilter->addFilter($prepare,'department','byDepartment');
        $departmentFilter->setOptions($this->view->department);
        $this->view->departmentFilter = $departmentFilter;

        $this->view->tof = PresenterFactory::getInstance('Application')->getTypeRequest();
        $tofFilter = FilterFactory::getInstance('Select','Typeofrequest',SelectFilter::SINGLE_SELECT);   
        $prepare = $tofFilter->addFilter($prepare,'typeofrequest','byTof');
        $tofFilter->setOptions($this->view->tof);
        $this->view->tofFilter = $tofFilter;

        $statusFilter = FilterFactory::getInstance('Select','Status',SelectFilter::SINGLE_SELECT);   
        $prepare = $statusFilter->addFilter($prepare,'status','byStatus');
        $statusFilter->setOptions(array('' => '-- Select Status --', '5' => 'Pending', '1' => 'Approved', '2' => 'Rejected', '4' => 'Forwarded', '3' => 'Cancelled' ));
        $this->view->statusFilter = $statusFilter;

        $fromtoFilter = FilterFactory::getInstance('Multiple','Search');
        $prepare = $fromtoFilter->addFilter($prepare,'startdate','fromtoSearch');
        $this->view->fromtoFilter = $fromtoFilter;

        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchReports');
        $this->view->searchFilter = $searchFilter;

        //add search filter
        $searchFilter = FilterFactory::getInstance('Text','Search');
        $prepare = $searchFilter->addFilter($prepare,'search','searchMyApplication');
        $this->view->searchFilter = $searchFilter;
                
        $this->view->myapplist = $this->paginate($prepare);

        $this->view->title = 'Save Drafts';
        return $this->view('history.saveDrafts');
    }

     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function editSaveDrafts($id){
        
        $select = [
            'srcusers.users.idsrc_login as creator_id',
            'srcusers.users.loginname as creator_name',
            'srcusers.users.emailadd as creator_email', 
            'ams_applications.id', 
            'ams_applications.status', 
            'ams_applications.close_remarks', 
            'ams_applications.department', 
            'ams_applications.type_request',
            'ams_applications.title', 
            'ams_applications.urgency', 
            'ams_applications.case_number', 
            'ams_applications.request_details', 
            'ams_applications.created_at',
            'ams_applications.updated_at',
            'ams_applications.status',
            'ams_applications.user_status as user_status'
        ];

        $select_doc = [
            'ams_documents.id as document_id', 
            'ams_documents.name as document_name', 
            'ams_documents.link as document_link',
            'ams_documents.app_id as app_id',
        ];

         $select_files = [
            'ams_files.id as files_id', 
            'ams_files.filename as files_filename', 
            'ams_files.mimes as files_mimes', 
            'ams_files.file_url as files_fileurl',
            'ams_files.app_id as app_id',
        ];

        //select for list of cc and approver
        $select_approver = [
            'srcusers.users.idsrc_login as approver_user_id',
            'srcusers.users.loginname as approver_name',
            'srcusers.users.emailadd as approver_email', 
            'ams_approver_person.id as approver_id', 
            'ams_approver_person.remarks as approver_remarks', 
            'ams_approver_person.status as approver_status', 
            'ams_approver_person.case_status as approver_case_status', 
            'ams_approver_person.updated_at as approver_date'
        ];
        $select_cc = [
            'srcusers.users.idsrc_login as ccperson_user_id',
            'srcusers.users.loginname as ccperson_name',
            'srcusers.users.emailadd as ccperson_email', 
            'ams_cc_person.id as ccperson_id', 
            'ams_cc_person.remarks as ccperson_remarks', 
            'ams_cc_person.status as ccperson_status', 
            'ams_cc_person.case_status as ccperson_case_status', 
            'ams_cc_person.updated_at as ccperson_date' 
        ];

        $user_id = \Auth::User()->idsrc_login;

        $myapp = ModelFactory::getInstance('Application')
                    ->where('ams_applications.id', '=', $id)
                    ->where('ams_applications.drafts', '=', 1)
                    ->where('ams_applications.created_id', '=', $user_id)
                    ->first();

        $mydoc = ModelFactory::getInstance('Documents')
            ->join('ams_applications', 'ams_documents.app_id', '=', 'ams_applications.id')
            ->where('ams_documents.app_id', '=', $id)
            ->select($select_doc)->get();

        $myfiles = ModelFactory::getInstance('File')
            ->join('ams_applications', 'ams_files.app_id', '=', 'ams_applications.id')
            ->where('ams_files.app_id', '=', $id)
            ->select($select_files)->get();

        $myapprover = ModelFactory::getInstance('Approver')
            ->leftjoin('ams_applications', 'ams_approver_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_approver_person.user_id')
            ->where('ams_approver_person.app_id', '=', $id)
            ->orderBy('ams_approver_person.position', 'asc')
            ->select($select_approver)->get();

        $myccperson = ModelFactory::getInstance('Ccperson')
            ->leftjoin('ams_applications', 'ams_cc_person.app_id', '=', 'ams_applications.id')
            ->leftjoin('srcusers.users', 'srcusers.users.idsrc_login', '=', 'ams_cc_person.user_id')
            ->where('ams_cc_person.app_id', '=', $id)
            ->orderBy('ams_cc_person.position', 'asc')
            ->select($select_cc)->get();

        $application_form_name = ModelFactory::getInstance('Forms')
                    ->where('id',$myapp->type_form)
                    ->first(['name','id']);

        $department = ModelFactory::getInstance('Department')->where('idsrc_departments', \Auth::user()->deptid)->get();

        $this->view->app = $myapp;
        $this->view->afm =  $application_form_name;
        $this->view->department =  $department;
        $this->view->doc = $mydoc;
        $this->view->files = $myfiles;
        $this->view->approver = $myapprover;
        $this->view->ccperson = $myccperson;
        $this->view->department_list = PresenterFactory::getInstance('Application')->getDepartment();
        $this->view->type_req_list = PresenterFactory::getInstance('Application')->getTypeRequest();
        $this->view->urgency = PresenterFactory::getInstance('Application')->getUrgency();
        $this->view->title = 'History Details';

        return $this->view('history.editSaveDrafts');
     }
}
