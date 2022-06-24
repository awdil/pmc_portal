<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;
//

//Controllers
use App\Http\Controllers\ExamCenterController;
use App\Http\Controllers\DeskServiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CandidateDocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamCalendarController;
use App\Http\Controllers\ExamCalendarTimeSlotController;
use App\Http\Controllers\ExaminerExamCenterController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesAssignmentController;
use App\Http\Controllers\TeamController;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 //$user = User::where(['id' => 8])->with(['roles'])->first();
 //$user->attachRole(4);
// $user->detachRole(3);
 //dd($user->toArray());


// Auth::routes(['verify' => true]);
//

Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class,'index']);

Route::group(['middleware' => ['verified']], function() {
	Route::get('/home', [HomeController::class,'index'])->name('home');
});

Route::group(['middleware' => ['role:administrator', 'verified']], function() {
	Route::get('/admin-reports', [ExamRegistrationController::class,'getReports'])->name('admin-reports');
	Route::get('/admin-dashboard', [HomeController::class,'getAdminDashboardView'])->name('admin-dashboard');
	Route::get('/nadra-verification-reports', [ExamRegistrationController::class,'nadraVerificationReports'])->name('nadra-verification-reports');
	
	// Exam name content begins
	Route::get('/exam-list', [ExamController::class,'index'])->name('exam-list');
	Route::get('/exams', [ExamController::class,'index'])->name('exams');
	Route::post('/add-new-exam', [ExamController::class,'store'])->name('add-new-exam');
	Route::get('/edit-exam/{id}', [ExamController::class,'edit'])->name('edit-exam');
	Route::post('/update-exam/{id}', [ExamController::class,'update'])->name('update-exam');
	// Exam name content end


	// Exam Center Routers
	Route::get('exam-centers', [ExamCenterController::class,'index'])->name('exam-centers');
	Route::post('save-exam-center', [ExamCenterController::class,'store'])->name('save-exam-center');
	Route::get('get-exam-centers', [ExamCenterController::class, 'getExamCeter'])->name('get-exam-centers');
	Route::get('/edit-exam-center/{id}', [ExamCenterController::class,'edit'])->name('edit-exam-center');
	Route::post('/update-exam-center/{id}', [ExamCenterController::class,'update'])->name('update-exam-center');
	Route::delete('/delete-exam-center/{id}', [ExamCenterController::class,'delete'])->name('delete-exam-center');
	// Exam Center Routes End

	// Exam Calender content begins
	Route::get('/exams-calender', [ExamCalendarController::class,'index'])->name('exams-calender');
	Route::post('/save-new-exam-calender', [ExamCalendarController::class,'store'])->name('save-new-exam-calender');
	Route::get('/edit-exam-calender/{id}', [ExamCalendarController::class,'edit'])->name('edit-exam-calender');
	Route::post('/update-exam-calender/{id}', [ExamCalendarController::class,'update'])->name('update-exam-calender');
	// Exam Calender content end

	// Exam Calender Time Slot content begins
	Route::get('/exams-calender-time-slots', [ExamCalendarTimeSlotController::class,'index'])->name('exams-calender-time-slots');
	Route::post('/save-new-exam-calender-time-slot', [ExamCalendarTimeSlotController::class,'store'])->name('save-new-exam-calender-time-slot');
	Route::get('/edit-exam-calender-time-slot/{id}', [ExamCalendarTimeSlotController::class,'edit'])->name('edit-exam-calender-time-slot');
	Route::post('/update-exam-calender-time-slot/{id}', [ExamCalendarTimeSlotController::class,'update'])->name('update-exam-calender-time-slot');
	// Exam Calender Time Slot content end
	
	// Examiner content begins
	Route::get('/examiners-list', [UserController::class,'examiners'])->name('examiners-list');
	Route::post('/export-examiners', [UserController::class,'ExportExaminers'])->name('export-examiners');
	Route::get('/edit-examiner', [ExaminerExamCenterController::class,'edit'])->name('edit-examiner');
	Route::get('assign-exam-center/{id}', [ExaminerExamCenterController::class,'assignExamCenter'])->name('assign-exam-center');
	Route::get('examiner-exam-centers', [UserController::class,'examinerExamCenters'])->name('examiner-exam-centers');

	Route::post('update-assign-exam-center', [ExaminerExamCenterController::class,'update'])->name('update-assign-exam-center');
	Route::get('/delete-examiner', [ExaminerExamCenterController::class,'delete'])->name('delete-examiner');
	// Examiner content end 
	//Route::get('/candidates', [UserController::class,'candidates'])->name('candidates');
	Route::get('/edit-candidate/{id}', [UserController::class,'edit'])->name('edit-candidate');
	Route::get('/delete-candidate/{id}', [UserController::class,'delete'])->name('delete-candidate');


	//Permissions content
	// Route::name('permissions.')->group(function () {
	// 	Route::get('permissions', [PermissionController::class,'index'])->name('permissions');
	// 	Route::get('permissions/create-permission', [PermissionController::class,'create'])->name('create-permission');
	// 	Route::post('permissions/store', [PermissionController::class,'store'])->name('store');
	// 	Route::get('permissions/edit-permission/{id}', [PermissionController::class,'edit'])->name('edit-permission');
	// 	Route::post('permissions/update', [PermissionController::class,'update'])->name('update');
	// 	Route::get('permissions/show-permission', [PermissionController::class,'show'])->name('show-permission');
	// 	Route::get('permissions/delete-permission/{id}', [PermissionController::class,'destroy'])->name('delete-permission');
	// });

	//Role content
	// Route::name('roles.')->group(function () {
		// Route::get('roles', [RoleController::class,'index'])->name('roles');
		// Route::get('roles/create', [RoleController::class,'create'])->name('create');
		// Route::post('roles/store', [RoleController::class,'store'])->name('store');
		// Route::get('roles/edit/{id}', [RoleController::class,'edit'])->name('edit');
		// Route::post('roles/update', [RoleController::class,'update'])->name('update');
		// Route::get('roles/show', [RoleController::class,'show'])->name('show');
		// Route::get('roles/delete/{id}', [RoleController::class,'destroy'])->name('delete');
		//Route::resource('roles', RoleController::class);
		
	// });

	Route::resources([
		'permissions' => PermissionController::class,
	]);

	Route::resources([
		'roles' => RoleController::class,
	]);

	Route::get('edit-with-role-permissions/{id}', [UserController::class,'editUseRolesPermissions'])->name('edit-with-role-permissions');
	Route::post('assign-role-permissions/{id}', [UserController::class,'updateUseRolesPermissions'])->name('assign-role-permissions');

	Route::get('/roles-permission-assignment-list', [UserController::class,'userRolesPermissionList'])->name('roles-permission-assignment-list');
	//roles-permission-assignment-list
	
});

Route::group(['middleware' => ['role:administrator|examiner', 'verified']], function() {
	Route::get('/admin-dashboard', [HomeController::class,'getExaminerDashboardView'])->name('admin-dashboard');
	Route::get('/candidates', [ExamRegistrationController::class,'ExamRegistrationCandidateList'])->name('candidates');
	Route::post('/export-candidates', [UserController::class,'ExportCandidates'])->name('export-candidates');
	Route::get('/candidate-registration-details/{id}', [ExamRegistrationController::class,'candidateRegistrationDetails'])->name('candidate-registration-details');
	Route::get('/generate-exam-credentials/{id}', [ExamRegistrationController::class,'generateExamCredentials'])->name('generate-exam-credentials');
	Route::get('/download-credentials-slip/{id}', [ExamRegistrationController::class,'examCredentialsSlip'])->name('download-credentials-slip');
	Route::post('/face-compare-verify', [ExamRegistrationController::class,'faceCompare'])->name('face-compare-verify');


	Route::name('report.')->group(function () {

		Route::get('reports/exam-centers', [ReportsController::class,'examCenters'])->name('exam-centers');
		Route::get('reports/candidate-states', [ReportsController::class,'candidateStates'])->name('candidate-states');
		Route::get('reports/registrations', [ReportsController::class,'candidateRegistrations'])->name('registrations');
		Route::get('reports/attendance-status', [ReportsController::class,'attendanceStatus'])->name('attendance-status');
		Route::get('reports/payment-status', [ReportsController::class,'paymentStatus'])->name('payment-status');
	});

});


Route::group(['middleware' => ['role:user', 'verified']], function() {

	Route::get('/candidate-tree', [UserController::class,'CandidatetTree'])->name('candidate-tree');
	// Route::get('/home', [UserController::class,'index']);
	Route::get('/candidate-dashboard', [UserController::class,'dashboard'])->name('candidate-dashboard');
	Route::get('/candidate-home', [UserController::class,'index'])->name('candidate-home');
	Route::get('/update-profile', [UserController::class,'index'])->name('update-profile');
	Route::post('/update-candidate-profile', [UserController::class,'store'])->name('update-candidate-profile');
	Route::post('/profile-picture', [UserController::class,'profilePictureUpdate'])->name('profile-picture');
	Route::post('/sms-verification', [UserController::class,'smsVerification'])->name('sms-verification');
	Route::post('update-mobile-verification-status', [UserController::class,'verifyFourDigitCode'])->name('update-mobile-verification-status');

	//service desk begins
	Route::get('/service-desk', [DeskServiceController::class,'index'])->name('service-desk');
	Route::post('/raise-support-ticket', [DeskServiceController::class,'create'])->name('raise-support-ticket');
	//service desk ends

	Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

	Route::get('/documents-upload', [CandidateDocumentController::class,'index'])->name('documents-upload');
	Route::post('/update-education-files', [CandidateDocumentController::class,'store'])->name('update-education-files');
	Route::get('/candidates-doc-list', [CandidateDocumentController::class,'index'])->name('candidates-doc-list');
	Route::get('/view-educational-document/{id}', [CandidateDocumentController::class,'viewDocument'])->name('view-educational-document');
	Route::post('/delete-educational-document/{id}', [CandidateDocumentController::class,'delete'])->name('delete-educational-document');

	Route::get('/exam-registration', [ExamRegistrationController::class,'index'])->name('exam-registration');
	Route::post('/save-registration', [ExamRegistrationController::class,'store'])->name('save-registration');
	Route::get('/application-history', [ExamRegistrationController::class,'examRegistrationHistory'])->name('application-history');

	Route::get('/print-challan/{id}', [ExamRegistrationController::class,'printChallan'])->name('print-challan');
	Route::get('/payonline/{id}', [ExamRegistrationController::class,'payOnline'])->name('payonline');
	Route::post('/payonline-complete', [ExamRegistrationController::class,'payOnlineComplete'])->name('payonline-complete');


	Route::get('/list-states', [CommonController::class,'listStates'])->name('list-states');
	Route::get('/list-cities', [CommonController::class,'listCities'])->name('list-cities');
	Route::get('/list-exam-centers', [CommonController::class,'listExamCenters'])->name('list-exam-centers');
	Route::get('/list-exam-calendar', [CommonController::class,'listExamCalendar'])->name('list-exam-calendar');
	Route::get('/list-time-slots', [CommonController::class,'listTimeSlots'])->name('list-time-slots');
});


Route::group(['middleware' => ['role:administrator|examiner|user', 'verified']], function() {

	Route::get('/download-exam-slip/{id}', [ExamRegistrationController::class,'examSlip'])->name('download-exam-slip');
	Route::get('/reschedule/{id}', [ExamRegistrationController::class,'edit'])->name('reschedule');
	Route::post('/reschedule/{id}', [ExamRegistrationController::class,'update'])->name('reschedule-update');

	Route::get('/list-states', [CommonController::class,'listStates'])->name('list-states');
	Route::get('/list-cities', [CommonController::class,'listCities'])->name('list-cities');

	Route::get('/list-exam-centers', [CommonController::class,'listExamCenters'])->name('list-exam-centers');
	Route::get('/list-exam-calendar', [CommonController::class,'listExamCalendar'])->name('list-exam-calendar');
});



