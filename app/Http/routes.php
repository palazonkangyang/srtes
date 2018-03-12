<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Add routes to Presenters below. The URL should not contain /controller & /service
 * at the first url because this is reserved for controllers and webservices
 */

//google route
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['after' => 'no-cache'], function() {
  Route::get('/login', ['as' => 'login','uses' => 'AccountPresenter@viewLogin']);
	Route::get('/', ['as' => 'login','uses' => 'AccountPresenter@viewLogin']);
	Route::get('/resetpassword', ['as' => 'reset-password','uses' => 'AccountPresenter@resetPassword']);
});

Route::get('/changepassword', ['as' => 'change-password','uses' => 'AccountPresenter@changePassword']);

Route::group(['prefix' => 'dashboard'],function(){
	Route::get('/', ['uses' => 'AccountPresenter@index']);
});

Route::group(['prefix' => 'account'],function(){
	Route::get('/myprofile', ['uses' => 'AccountPresenter@myProfile']);
	Route::get('/account-settings', ['uses' => 'AccountPresenter@accountSettings']);
});

Route::get('/pdf', ["as" => "pdfa", 'uses' => 'PdfPresenter@pdf']);

// Core Module: Training Evaluation System
// tes/*
Route::group(['prefix' => 'tes'],function(){
  Route::get('/dashboard', ['uses' => 'AccountPresenter@tes_index']);

  // Training Evaluation System -> Course
  // tes/course/*
  Route::group(['prefix' => 'course'],function(){

    Route::get('/', ['uses' => 'CoursePresenter@index']);
    Route::get('/get_json_course', ['uses' => 'CoursePresenter@getjsonCourse']);
    Route::get('/get_json_course_by_course_type_id', ['uses' => 'CoursePresenter@getjsonCourseByCourseTypeId']);

    // Training Evaluation System -> Course
    // tes/course/course-type/*
    Route::group(['prefix' => 'course-type'],function(){

      Route::get('/', ['uses' => 'CourseTypePresenter@getCourseTypeList']);
      Route::post('/', ['uses' => 'CourseTypePresenter@getCourseTypeList']);
      Route::get('/add-course-type', ['uses' => 'CourseTypePresenter@getAddCourseType']);
      Route::get('/edit-course-type/{id}', ['uses' => 'CourseTypePresenter@editCourseType']);
      Route::get('/edit-questionnaire/{id}', ['uses' => 'CourseTypePresenter@editQuestionnaire']);
    });

    // Training Evaluation System -> Course -> Course List
    // tes/course/course-list/*
    Route::group(['prefix' => 'course-list'],function(){
      Route::get('/', ['uses' => 'CoursePresenter@courseList']);
      Route::post('/', ['uses' => 'CoursePresenter@courseList']);
      Route::get('/questionnaire_report/{id}', ['uses' => 'CoursePresenter@questionnaire_reportList']);
      Route::post('/questionnaire_report/{id}', ['uses' => 'CoursePresenter@questionnaire_reportList']);
      Route::get('/add-course', ['uses' => 'CoursePresenter@create']);
      Route::get('/edit-course/{id}', ['uses' => 'CoursePresenter@edit']);
      Route::get('/edit-questionnaire/{id}', ['uses' => 'CoursePresenter@editquestionnaire']);
      Route::get('/remove-course/{id}', ['uses' => 'CourseController@destroy']);
    });

    // Training Evaluation System -> Course -> Designation
    // tes/course/designation/*
    Route::group(['prefix' => 'designation'],function(){
      Route::get('/', ['uses' => 'DesignationPresenter@getDesignation']);
      Route::get('/add-designation', ['uses' => 'DesignationPresenter@addDesignation']);
      Route::get('/edit-designation/{id}', ['uses' => 'DesignationPresenter@editDesignation']);
      Route::get('/remove-designation/{id}', ['uses' => 'DesignationController@deleteDesignation']);
    });

    Route::get('/course-completion-status', ['uses' => 'CoursePresenter@courseCompletionStatus']);
    Route::get('/course-completion-status/course-{id}/batch', ['uses' => 'CoursePresenter@courseCompletionStatusBatch']);
    Route::get('/course-completion-status/course-{id}/batch-{batch_id}/questionnaire', ['uses' => 'CoursePresenter@courseCompletionStatusBatchQuestionnaire']);
  });

  // Training Evaluation System -> Form Management
  // tes/form-management/*
  Route::group(['prefix' => 'form-management'], function() {
    Route::get('/', ['uses' => 'FormManagementPresenter@index']);
    Route::get('/questionnaire/{id}', ['uses' => 'FormManagementPresenter@questionnaire']);

    // tes/form-management/questionnaire-list/*
    Route::group(['prefix' => 'questionnaire-list'], function() {
      Route::get('/', ['uses' => 'FormManagementPresenter@questionnaireList']);
      Route::get('/add-questionnaire', ['uses' => 'FormManagementPresenter@create']);
    });
  });

  // Training Evaluation System -> Report
  // tes/application/*
  Route::group(['prefix' => 'reports'],function(){
    Route::get('/', ['uses' => 'ReportsPresenter@index']);
    Route::get('/training-evaluation', ['uses' => 'ReportsPresenter@trainingEvaluation']);
  });

  // Training Evaluation System -> Settings
  // tes/settings/*
  Route::group(['prefix' => 'settings'],function(){
    Route::get('/', ['uses' => 'SettingsPresenter@tes_index']);
  });
});

Route::group(['prefix' => 'settings'], function() {
	//access right super admin
	Route::get('/', ['uses' => 'SettingsPresenter@index']);
  Route::get('/out_of_office_settings', ['uses' => 'SettingsPresenter@outOfOfficeSettings']);
	Route::get('/request', ['middleware' => 'access','uses' => 'SettingsPresenter@typeRequest']);
	Route::post('/request', ['middleware' => 'access','uses' => 'SettingsPresenter@typeRequest']);
  Route::get('/person', ['middleware' => 'access','uses' => 'SettingsPresenter@typePerson']);
	Route::post('/person', ['middleware' => 'access','uses' => 'SettingsPresenter@typePerson']);

	Route::get('/request/editrequest/{id}', ['middleware' => 'access','uses' => 'SettingsPresenter@edittypeRequest']);
	Route::get('/request/editablerequest/{id}/{name}/{data}', ['middleware' => 'access','uses' => 'SettingsPresenter@editableRequest']);
	Route::get('/urgency', ['middleware' => 'access','uses' => 'SettingsPresenter@urgency']);
	Route::get('/glcode_setting', ['middleware' => 'access','uses' => 'SettingsPresenter@glcode_setting']);
	Route::get('/user_department_setting', ['middleware' => 'access','uses' => 'SettingsPresenter@user_department_setting']);
	Route::get('/group_fixed_setting', ['middleware' => 'access','uses' => 'SettingsPresenter@group_fixed_setting']);
	Route::get('/forms_typerequest_setting', ['middleware' => 'access','uses' => 'SettingsPresenter@forms_typerequest_setting']);

	Route::get('/request/setrequest/{id}', ['middleware' => 'access','uses' => 'SettingsPresenter@setRequest']);
	Route::get('/person/editperson/{id}', ['middleware' => 'access','uses' => 'SettingsPresenter@editPerson']);

	//forms
	Route::get('/request/forms', ['middleware' => 'access','uses' => 'SettingsPresenter@forms']);
	Route::get('/request/setapprovers/{id}', ['middleware' => 'access','uses' => 'SettingsPresenter@setApprovers']);
});

Route::group(['prefix' => 'paymentprocessing'], function() {

  //access right super admin
	Route::get('/', ['as' => 'paymentprocessing','uses' => 'PaymentProcessingPresenter@index']);

  //reimbursement
  Route::get('/reimbursement', ['as' => 'reimbursement','uses' => 'PaymentProcessingPresenter@reimbursement']);
  Route::get('/reimbursement_pending', ['as'=> 'reimbursement_pending', 'uses' => 'PaymentProcessingPresenter@reimbursement_pending']);
  Route::post('/reimbursement_pending', ['uses' => 'PaymentProcessingPresenter@reimbursement_pending']);
  Route::post( '/reimbursement_pending_store', [ 'as' => 'reimbursement_pending_store', 'uses' => 'PaymentProcessingPresenter@reimbursement_pending_store' ] );
  Route::get('/reimbursement_processing', ['as'=> 'reimbursement_processing', 'uses' => 'PaymentProcessingPresenter@reimbursement_processing']);
  Route::post('/reimbursement_processing', ['uses' => 'PaymentProcessingPresenter@reimbursement_processing']);
  Route::post( '/reimbursement_processing_store', [  'as' => 'reimbursement_processing_store', 'uses' => 'PaymentProcessingPresenter@reimbursement_processing_store' ] );
  Route::get('/reimbursement2_processing', ['as'=> 'reimbursement2_processing', 'uses' => 'PaymentProcessingPresenter@reimbursement2_processing']);
  Route::post('/reimbursement2_processing', ['uses' => 'PaymentProcessingPresenter@reimbursement2_processing']);
  Route::post( '/reimbursement2_processing_store', [  'as' => 'reimbursement2_processing_store', 'uses' => 'PaymentProcessingPresenter@reimbursement2_processing_store' ] );

  Route::get('/reimbursement_exported', ['as'=> 'reimbursement_exported', 'uses' => 'PaymentProcessingPresenter@reimbursement_exported']);
  Route::post('/reimbursement_exported', ['uses' => 'PaymentProcessingPresenter@reimbursement_exported']);

  //cash advance
  Route::get('/cashadvance', ['as' => 'cashadvance','uses' => 'PaymentProcessingPresenter@cashadvance']);
  Route::get('/cashadvance_pending', ['as' => 'cashadvance_pending', 'uses' => 'PaymentProcessingPresenter@cashadvance_pending']);
  Route::post('/cashadvance_pending', ['uses' => 'PaymentProcessingPresenter@cashadvance_pending']);
  Route::post( '/cashadvance_pending_store', [ 'as' => 'cashadvance_pending_store', 'uses' => 'PaymentProcessingPresenter@cashadvance_pending_store' ] );
  Route::get('/cashadvance_processing', ['as' => 'cashadvance_processing', 'uses' => 'PaymentProcessingPresenter@cashadvance_processing']);
  Route::post('/cashadvance_processing', ['uses' => 'PaymentProcessingPresenter@cashadvance_processing']);
  Route::post( '/cashadvance_processing_store', [ 'as' => 'cashadvance_processing_store', 'uses' => 'PaymentProcessingPresenter@cashadvance_processing_store' ] );
  Route::get('/cashadvance_readyforcollection', ['as' => 'cashadvance_readyforcollection', 'uses' => 'PaymentProcessingPresenter@cashadvance_readyforcollection']);
  Route::post('/cashadvance_readyforcollection', ['uses' => 'PaymentProcessingPresenter@cashadvance_readyforcollection']);
  Route::post( '/cashadvance_readyforcollection_store', [ 'as' => 'cashadvance_readyforcollection_store', 'uses' => 'PaymentProcessingPresenter@cashadvance_readyforcollection_store' ] );
  Route::get('/cashadvance_collected', ['as' => 'cashadvance_collected', 'uses' => 'PaymentProcessingPresenter@cashadvance_collected']);
  Route::post('/cashadvance_collected', ['uses' => 'PaymentProcessingPresenter@cashadvance_collected']);
});

Route::group(['prefix' => 'application'],function(){
	/**
	 * Phase 3.0
	 */
	Route::get('/new/process', ['uses' => 'ApplicationPresenter@ApplicationProcess']);
	Route::post('/new/process', ['uses' => 'ApplicationPresenter@ApplicationProcess']);

	/**
	 * Phase 1.0
	 */
	/*Route::get('/new', ['uses' => 'ApplicationPresenter@newapplication']);*/
	Route::get('/getjsonuser', 'ApplicationPresenter@jsonGetUser');
  Route::get('/getjsonflexigroup', 'ApplicationPresenter@jsonGetFlexiGroup');
  Route::get('/getjsonaccountcode', 'ApplicationPresenter@jsonGetAccountCode');
  Route::get('/getjsonoptionalcode', 'ApplicationPresenter@jsonGetOptionalCode');
	Route::get('/view_details/{id}', 'ApplicationPresenter@viewDetails');
  Route::get('/view_details/{id}/feedback', 'ApplicationPresenter@fillFeedbackForm');
	Route::get('/pending', 'ApplicationPresenter@pending');
	Route::post('/pending', ['uses' => 'ApplicationPresenter@pending']);
  Route::get('/out_of_office_pending_lists', 'ApplicationPresenter@outOfOfficePendingLists');
	Route::get('/myapp', 'ApplicationPresenter@myapp');
	Route::post('/myapp', ['uses' => 'ApplicationPresenter@myapp']);
	Route::get('/download/file/{name}', ['uses' => 'ApplicationPresenter@file']);
	Route::get('/download/file/tmp/{name}', ['uses' => 'ApplicationPresenter@Tmpfile']);
	Route::get('/viewMinutesFile/{name}', ['uses' => 'ApplicationPresenter@viewMinutesFile']);

	Route::get('/view/file/{name}/{filename}', ['uses' => 'ApplicationPresenter@viewFile']);
	Route::get('/view/file/tmp/{name}/{filename}', ['uses' => 'ApplicationPresenter@viewTmpFile']);

  Route::get('/reportmenu', ['uses' => 'ApplicationPresenter@reportmenu']);

  Route::get('/pending-status', 'ApplicationPresenter@pendingStatus');

  //access right super admin
	Route::get('/reports', ['middleware' => 'access', 'uses' => 'ApplicationPresenter@reports']);
	Route::post('/reports', ['middleware' => 'access', 'uses' => 'ApplicationPresenter@reports']);
  Route::get('/reportsAdmin', ['uses' => 'ApplicationPresenter@reportsAdmin']);
  Route::post('/reportsAdmin', ['uses' => 'ApplicationPresenter@reportsAdmin']);
  Route::get('/reportsHR', ['uses' => 'ApplicationPresenter@reportsHR']);
	Route::post('/reportsHR', ['uses' => 'ApplicationPresenter@reportsHR']);
  Route::get('/reportsFin', ['uses' => 'ApplicationPresenter@reportsFin']);
  Route::post('/reportsFin', ['uses' => 'ApplicationPresenter@reportsFin']);

	Route::get('/view_reports/{id}', ["as" => 'view', 'uses' => 'ApplicationPresenter@viewReports']);

  Route::post('/saveprintdate', ['uses' => 'ApplicationController@saveprintdate']);
});

Route::group(['prefix' => 'management'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'UserManagementPresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'UserManagementPresenter@index']);

	Route::get('/adduser', ['middleware' => 'access','uses' => 'UserManagementPresenter@create']);
	Route::get('/edituser/{id}', ['middleware' => 'access','uses' => 'UserManagementPresenter@edit']);
});

Route::group(['prefix' => 'department'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'DepartmentPresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'DepartmentPresenter@index']);

	Route::get('/createdepartment', ['middleware' => 'access','uses' => 'DepartmentPresenter@create']);
	Route::get('/editdepartment/{id}', ['middleware' => 'access','uses' => 'DepartmentPresenter@edit']);
});

Route::group(['prefix' => 'accountcode'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'AccountCodePresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'AccountCodePresenter@index']);

	Route::get('/createaccountcode', ['middleware' => 'access','uses' => 'AccountCodePresenter@create']);
	Route::get('/editaccountcode/{id}', ['middleware' => 'access','uses' => 'AccountCodePresenter@edit']);
});

Route::group(['prefix' => 'globalsetting'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'GlobalSettingPresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'GlobalSettingPresenter@index']);
	Route::get('/editglobalsetting/{id}', ['middleware' => 'access','uses' => 'GlobalSettingPresenter@edit']);
});

Route::group(['prefix' => 'flexigroup'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'FlexiGroupPresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'FlexiGroupPresenter@index']);

	Route::get('/createflexigroup', ['middleware' => 'access','uses' => 'FlexiGroupPresenter@create']);
	Route::get('/editflexigroup/{id}', ['middleware' => 'access','uses' => 'FlexiGroupPresenter@edit']);
  Route::get('/viewflexigroup/{id}', ['middleware' => 'access','uses' => 'FlexiGroupPresenter@view1']);
});

Route::group(['prefix' => 'optionalcode'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'OptionalCodePresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'OptionalCodePresenter@index']);

	Route::get('/createoptionalcode', ['middleware' => 'access','uses' => 'OptionalCodePresenter@create']);
	Route::get('/editoptionalcode/{id}', ['middleware' => 'access','uses' => 'OptionalCodePresenter@edit']);
});

Route::group(['prefix' => 'auditlog'],function(){
	//access right super admin
	Route::get('/', ['middleware' => 'access', 'uses' => 'AuditLogPresenter@index']);
	Route::post('/', ['middleware' => 'access','uses' => 'AuditLogPresenter@index']);

	Route::get('/createoptionalcode', ['middleware' => 'access','uses' => 'OptionalCodePresenter@create']);
	Route::get('/editoptionalcode/{id}', ['middleware' => 'access','uses' => 'OptionalCodePresenter@edit']);
});

Route::group(['prefix' => 'history'],function(){
	//access right super admin
	Route::get('/', ['uses' => 'HistoryPresenter@index']);

	Route::get('/approver/list', ['uses' => 'HistoryPresenter@approverHistory']);
	Route::post('/approver/list', ['uses' => 'HistoryPresenter@approverHistory']);

	Route::get('/ccperson/list', ['uses' => 'HistoryPresenter@ccpersonHistory']);
	Route::post('/ccperson/list', ['uses' => 'HistoryPresenter@ccpersonHistory']);

	Route::get('/savedrafts/list', ['uses' => 'HistoryPresenter@saveDrafts']);
	Route::post('/savedrafts/list', ['uses' => 'HistoryPresenter@saveDrafts']);

	Route::get('/edit/savedrafts/{id}', ['uses' => 'HistoryPresenter@editSaveDrafts']);
});
/*
 * Add routes to Controller below. The URL should contain /controller
 * at the first. This serves as an identifier for the controller. The controller
 * should only be set on POST method. Avoid using /service in the first of the url since
 * this is exclusively used by the webservice only.
 */

// This is only for testing purpose. In actual it should be post
Route::group(['prefix' => 'controller'],function(){

	Route::post('/account/postLogin', ['as' => 'postlogin','uses' => 'AccountController@postLogin']);
	Route::get('/account/logout', ['as' => 'logout','uses' => 'AccountController@logout']);

	Route::get('/settings/removerequest/{id}', 'SettingsController@RemoveTypeRequest');
	Route::post('/settings/updatedrequest/{id}', 'SettingsController@UpdateTypeRequest');
	Route::post('/settings/storetyperequest', 'SettingsController@StoreTypeRequest');
	Route::post('/settings/urgencystore', ['uses' => 'SettingsController@StoreUrgency']);
  Route::post('/settings/urgencystore', ['uses' => 'SettingsController@StoreUrgency']);
	Route::post('/application/store', 'ApplicationController@store');
	Route::post('/application/closeapp', 'ApplicationController@closeapp');
	Route::post('/application/approveapp', 'ApplicationController@approveapp');
	Route::post('/application/commentapp', 'ApplicationController@commentapp');

	Route::post('/uploadFiles', 'UploadFileController@uploadFiles');
	Route::get('/removeFiles/{name}', 'UploadFileController@removeFiles');

	Route::post('/resetpassword', ['as' => 'reset-password-controller','uses' => 'AccountController@resetPassword']);
	Route::post('/changepassword', ['as' => 'change-password-controller','uses' => 'AccountController@changePassword']);

	Route::post('/accountsettings', ['uses' => 'AccountController@accountSettings']);
	Route::post('/updateprofile', ['uses' => 'AccountController@updateProfile']);

  Route::post('/tempapproveruser', ['uses' => 'AccountController@tempapproveruser']);

	/*usermanagement*/
	Route::post('/adduser', ['uses' => 'UserManagementController@store']);
	Route::post('/updateuser', ['uses' => 'UserManagementController@update']);
	Route::get('/removeuser/{id}', ['uses' => 'UserManagementController@destroy']);
	Route::get('/activate/{id}', ['uses' => 'UserManagementController@activate']);

	/*accountcode*/
	Route::post('/createaccountcode', ['uses' => 'AccountCodeController@store']);
	Route::post('/updateaccountcode', ['uses' => 'AccountCodeController@update']);
	Route::get('/removeaccountcode/{id}', ['uses' => 'AccountCodeController@destroy']);

  /*globalsetting*/
	Route::post('/updateglobalsetting', ['uses' => 'GlobalSettingController@update']);

  /*flexigroup*/
	Route::post('/createflexigroup', ['uses' => 'FlexiGroupController@store']);
	Route::post('/updateflexigroup', ['uses' => 'FlexiGroupController@update']);
	Route::get('/removeflexigroup/{id}', ['uses' => 'FlexiGroupController@destroy']);

  /*optionalcode*/
	Route::post('/createoptionalcode', ['uses' => 'OptionalCodeController@store']);
	Route::post('/updateoptionalcode', ['uses' => 'OptionalCodeController@update']);
	Route::get('/removeoptionalcode/{id}', ['uses' => 'OptionalCodeController@destroy']);

  /*department*/
	Route::post('/createdepartment', ['uses' => 'DepartmentController@store']);
	Route::post('/updatedepartment', ['uses' => 'DepartmentController@update']);
	Route::get('/removedepartment/{id}', ['uses' => 'DepartmentController@destroy']);

	/*history*/
	Route::post('/history/save_drafts', ['uses' => 'HistoryController@saveDrafts']);
	Route::post('/history/delete_drafts', ['uses' => 'HistoryController@deleteDrafts']);

	/*forms*/
	Route::post('/settings/setapprovers', 'SettingsController@SetApprovers');
	Route::post('/settings/setforms', 'SettingsController@SetForms');
	Route::get('/settings/getforms', 'SettingsController@GetForms');

  /*post*/
  Route::post('/settings/updatepost','SettingsController@updatepost');

  // Core Module: Training Evaluation System
  // Training Evaluation System -> Course -> Course Type -> Add Course Type
  Route::post('/tes/course/course-type/add-course-type', ['uses' => 'CourseTypeController@store']);
  Route::post('/tes/course/course-type/edit-course-type/{id}', ['uses' => 'CourseTypeController@update']);
  Route::post('/tes/course/course-type/edit-questionnaire/{id}', ['uses' => 'CourseTypeController@questionnaire_update']);

  // Core Module: Training Evaluation System
  // Training Evaluation System -> Course -> Course List -> Add Course
  Route::post('/tes/course/course-list/add-course', ['uses' => 'CourseController@store']);
  Route::post('/tes/course/course-list/edit-course/{id}', ['uses' => 'CourseController@update']);

  // Training Evaluation System -> Designation -> Designation List -> Add Designation
  Route::post('/tes/course/designation/add-designation', ['uses' => 'DesignationController@store']);
  Route::post('/tes/course/designation/edit-designation/{id}', ['uses' => 'DesignationController@update']);

  // Training Evaluation System -> Form Management -> Questionnaire List -> Add Questionnaire
  Route::post('/tes/course/course-list/edit-questionnaire/{id}', ['uses' => 'FormManagementController@questionnaire_update']);

  // Training Evaluation System -> Form Management -> Questionnaire List -> Add Questionnaire
  Route::post('/tes/form-management/questionnaire-list/add-questionnaire', ['uses' => 'FormManagementController@store']);

  Route::post('/application/view_details/{id}/feedback/', ['uses' => 'ApplicationController@questionnaireStore']);
});

Route::group(['prefix' => 'test'],function() {
	Route::get('/mail', 'TestPresenter@index');
});


/*
 * Add routes to WebServices below. The URL should contain /service
 * at the first. This serves as an identifier for the Web Services.
 * Avoid using /controller in the first of the url since
 * this is exclusively used by the controllers only.
 */
Route::group(['prefix' => 'service'],function() {
	Route::get('/', 'TestWebService@index');
});

/*
 * Add routes to Cronservices below. The URL should contain /cron
 * at the first. This serves as an identifier for the CRON services.
 * Avoid using /controller or /service in the first of the url since
 * this is exclusively used by the controllers and webserivces only.
 */

Route::group(['prefix' => 'cron'],function(){
	Route::get('/execute/now', ['uses' => 'CronController@execute']);
});

/*
* Create custom filter below.
*/

Route::filter('no-cache',function($route, $request, $response){
  $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
  $response->headers->set('Pragma','no-cache');
  $response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
});
