<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DesiginationController;
use App\Http\Controllers\Admin\MyOfficeController;
use App\Http\Controllers\Admin\MyOfficeTaskController;
use App\Http\Controllers\Admin\MyOfficeAttendanceController;
use App\Http\Controllers\Admin\MyOfficeSalaryController;
use App\Http\Controllers\Admin\MyOfficeLeadsController;

use App\Http\Controllers\employee\OfficeLoginController;
use App\Http\Controllers\employee\OfficeDashboardController;
use App\Http\Controllers\employee\MyOfficeLeadsEmployeeController;
use App\Http\Controllers\employee\MyOfficeChatsEmployeeController;
use App\Http\Controllers\Admin\FacebookController;
use App\Http\Controllers\Admin\MyOfficeLeadsIntegrationController;
use App\Http\Controllers\Admin\MyOfficeAssignIntegratedLeadsCronJobController;
use App\Http\Controllers\ArtisanTerminalController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Admin\AllowedIpController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CampaignController;
use App\Mail\MeetingReminderMail;
use App\Models\OfficeLeadFollowups;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admins
Route::any('/', [LoginController::class, 'login'])->name('login');
Route::any('/login', [LoginController::class, 'submit'])->name('admin.login');
Route::any('/sign-up', [LoginController::class, 'signup'])->name('signup');
Route::any('/forget', [LoginController::class, 'forget'])->name('forget');
Route::any('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
Route::any('/set-password', [LoginController::class, 'setPassword'])->name('setPassword');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('client')->name('client.')->controller(ClientController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::any('/create', 'create')->name('create');
            Route::any('/update/{id}', 'update')->name('update');
            Route::any('/save', 'save')->name('save');
            Route::any('/delete/{id}', 'delete')->name('delete');
            Route::any('/detail/{id}', 'detail')->name('detail');
        });

        Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::any('/create', 'create')->name('create');
            Route::any('/update/{id}', 'update')->name('update');
            Route::any('/save', 'save')->name('save');
            Route::any('/delete/{id}', 'delete')->name('delete');
            Route::any('/detail/{id}', 'detail')->name('detail');
        });

        Route::prefix('desigination')->name('desigination.')->controller(DesiginationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::any('/create', 'create')->name('create');
            Route::any('/update/{id}', 'update')->name('update');
            Route::any('/save', 'save')->name('save');
            Route::any('/delete/{id}', 'delete')->name('delete');
            Route::any('/detail/{id}', 'detail')->name('detail');
        });

        // My Office
        Route::prefix('office')->name('office.')->controller(MyOfficeController::class)->group(function () {
            // Start Employee Route
            Route::get('/', 'index')->name('index');
            Route::get('/employee-list/{department_id}/{designation_id?}', 'employee_list')->name('employee_list');
            Route::get('/roles-responsibility', 'roles_responsibility')->name('roles_responsibility');
            Route::any('/create', 'create')->name('create');
            Route::any('/delete-employee/{id}', 'delete_employee')->name('delete_employee');
            Route::any('/profile/{id}', 'profile')->name('profile');
            Route::any('/edit-employee/{id}', 'edit_employee')->name('edit_employee');
            Route::any('/update-employee/{id}', 'update_employee')->name('update_employee');

            Route::any('/delete-department/{id}', 'delete_department')->name('delete_department');
            Route::any('/edit-department/{id}', 'edit_department')->name('edit_department');
            Route::any('/update-department/{id}', 'update_department')->name('update_department');

            Route::any('/edit-designation/{id}', 'edit_designation')->name('edit_designation');
            Route::any('/delete-designation/{id}', 'delete_designation')->name('delete_designation');
            Route::any('/update-designation/{id}', 'update_designation')->name('update_designation');

            Route::post('/create-teams', 'create_teams')->name('create_teams');
            Route::any('/edit-teams/{id}', 'edit_teams')->name('edit_teams');
            Route::any('/delete-teams/{id}', 'delete_teams')->name('delete_teams');

            Route::post('/create-department', 'create_department')->name('create_department');
            Route::post('/create-designation', 'create_designation')->name('create_designation');

            Route::any('/edit-shift/{id}', 'edit_shift')->name('edit_shift');

            Route::post('/change-status', 'change_status')->name('change_status');

            Route::any('/change-employee-status/{statusId}', 'change_employee_status')->name('change_employee_status');

            Route::get('/meetings', 'meetinglist')->name('meetings');

            // End Employee Route

        });
        Route::prefix('projects')->name('projects.')->controller(ProjectController::class)->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{id}', 'update')->name('update');
            Route::any('/detail/{id}', 'detail')->name('detail');
            Route::post('/update-status/{id}', 'updateStatus')->name('updateStatus');
        });

        Route::prefix('office-task-management')->name('task_management.')->controller(MyOfficeTaskController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/create/task', 'store')->name('store');
            Route::post('/task/update/{id}', 'update')->name('update');
            Route::post('/task/delete', 'delete')->name('delete');
            Route::get('/view/{id}', 'view')->name('view');
            Route::post('/task/update-status/{id}', 'updateStatus')->name('updateStatus');
        });
        Route::prefix('office-attendance')->name('attendance.')->controller(MyOfficeAttendanceController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/attendance2', 'attendance2')->name('attendance2');
            Route::post('/create-attendance', 'create_attendance')->name('create_attendance');
            Route::post('/create-leave', 'create_leave')->name('create_leave');
            Route::post('/change-leave-status', 'change_leave_status')->name('change_leave_status');
            Route::post('/attendance2-update/{id?}', 'attendance2_update')->name('attendance2_update');
            Route::post('/assign-leave-to', 'assign_leave_to')->name('assign_leave_to');
        });
        Route::prefix('office-leads')->name('leads.')->controller(MyOfficeLeadsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/create-lead', 'create_lead')->name('create_lead');
            Route::post('/update-lead-remark/{id}', 'update_lead_remark')->name('update_lead_remark');
            Route::get('/lead/{id}', 'single_lead')->name('single_lead');
            Route::post('/create-folder', 'create_folder')->name('create_folder');
            Route::post('/edit-folder/{id}', 'edit_folder')->name('edit_folder');
            Route::get('/folder/{slug}', 'single_folder')->name('single_folder');
            Route::post('/upload-lead-csv', 'upload_lead_csv')->name('upload_lead_csv');

            Route::post('/change-lead-assign/{id}', 'change_lead_assign')->name('change_lead_assign');
            Route::post('/assign-multiple-leads', 'assign_multiple_leads')->name('assign_multiple_leads');
            Route::get('/trash/{id}', 'trash')->name('trash');
            Route::get('/delete-lead/{id}', 'delete_lead')->name('delete_lead');
            Route::get('/trash', 'trash_leads')->name('trash_leads');
            Route::get('/trash-restore/{id}', 'trash_restore')->name('trash_restore');
            Route::get('/lead-cron-history/{id}', 'cron_history')->name('cron_restore');
            Route::get('/lead-cron-history/delete/{id}', 'delete_cron')->name('cron.trash');
            Route::get('/lead-excel-leads/{id}', 'excel_leads')->name('excel');
            Route::get('/uploaded-excels', 'uploaded_excel')->name('uploaded_excels');
            Route::post('/uploaded-excels/schedule-distribution', 'scheduleDistribution')->name('uploaded-excels.schedule');
            Route::get('/lead-assiged-emp/{id}', 'assiged_employee')->name('assiged-employee');
        });

        // Route::post('/run-campaign/{folder}', [CampaignController::class, 'run'])
        //     ->name('campaign.run');

        Route::prefix('leads-integration')->name('leads_integration.')->controller(MyOfficeLeadsIntegrationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/callback', 'callback')->name('callback');
            Route::get('/token', 'token')->name('token');
            Route::get('/pages/{token}', 'pages')->name('pages');
            Route::get('/get-lead-folders', 'getLeadFolders')->name('getLeadFolders');
            Route::post('/save-fb-integration', 'saveFbIntegration')->name('saveFbIntegration');
            Route::post('/save-im-integration', 'saveImIntegration')->name('saveImIntegration');
            Route::post('/save-webhook-integration', 'saveWebHookIntegration')->name('saveWebHookIntegration');
            Route::get('/integrations', 'integrations')->name('integrations')->middleware('officeAssignIntegLeads');
            Route::get('/integrations/{integration_id}', 'single_integration')->name('single_integration');


            // Route::post('/indiamart-webhook', 'indiamart_webhook')->name('indiamart_webhook');
        });
        Route::prefix('office-salary')->name('salary.')->controller(MyOfficeSalaryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });

        Route::prefix('Ip-address')->name('ip.')->controller(AllowedIpController::class)->group(function () {
            Route::get('/', [AllowedIpController::class, 'index'])->name('index');
            Route::get('/create', [AllowedIpController::class, 'create'])->name('create');
            Route::post('/store', [AllowedIpController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AllowedIpController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AllowedIpController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [AllowedIpController::class, 'destroy'])->name('delete');
        });
    });
});
// End Admin

// Office
// Route::middleware(['officeAuth:officeEmployee'])->group(function ()
// {
//     Route::prefix('office-employee')->name('office_employee.')->group(function (){
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     });
// });
Route::middleware(['office_employee'])->group(function () {
    // Route::middleware('ip.restrict')->group(function () {
        Route::prefix('office-employee')->name('office_employee.')->group(function () {
            Route::any('/dashboard', [OfficeDashboardController::class, 'index'])->name('employee_dashboard');

            Route::prefix('leads')->name('leads.')->controller(MyOfficeLeadsEmployeeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/create-lead', 'create_lead')->name('create_lead');
                Route::post('/update-lead-remark/{id}', 'update_lead_remark')->name('update_lead_remark');
                Route::get('/lead/{id}', 'single_lead')->name('single_lead');
                Route::post('/create-folder', 'create_folder')->name('create_folder');
                Route::post('/edit-folder/{id}', 'edit_folder')->name('edit_folder');
                Route::get('/folder/{slug}', 'single_folder')->name('single_folder');
                Route::post('/upload-lead-csv/{folder_id}', 'upload_lead_csv')->name('upload_lead_csv');
                Route::post('/change-lead-assign/{id}', 'change_lead_assign')->name('change_lead_assign');
                Route::post('/assign-multiple-leads', 'assign_multiple_leads')->name('assign_multiple_leads');
                Route::get('/delete-lead/{id}', 'delete_lead')->name('delete_lead');
                Route::get('/trash/{id}', 'trash')->name('trash');
                Route::post('/followup/{lead_id}', 'followup')->name('followup');
            });
            Route::prefix('chats')->name('chats.')->controller(MyOfficeChatsEmployeeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::any('/{emp_base64}', 'singleChat')->name('singleChat');
                // Route::post('/save', 'singleChat')->name('saveChat');
            });

            Route::prefix('task-management')->name('task_management.')->controller(MyOfficeTaskController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/create/task', 'store')->name('store');
                Route::post('/task/update/{id}', 'update')->name('update');
                Route::post('/task/delete', 'delete')->name('delete');
                Route::get('/view/{id}', 'view')->name('view');
                Route::post('/task/update-status/{id}', 'updateStatus')->name('updateStatus');
            });
            Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
            Route::post('/meeting/cancel/{id}', [MeetingController::class, 'cancelMeeting'])->name('meetings.cancel');

        });
    // });
});

Route::any('/employee', [OfficeLoginController::class, 'login'])->name('employee_login');
// Route::any('/employee/dashboard', [OfficeDashboardController::class, 'dashboard'])->name('employee_dashboard');
Route::any('/employee/login', [OfficeLoginController::class, 'submit'])->name('employee_login.login');
// Route::any('/employee/sign-up', [LoginController::class, 'signup'])->name('employee_signup');
Route::any('/employee/forget', [OfficeLoginController::class, 'forget'])->name('employee_forget');
Route::any('/employee/verify-otp', [OfficeLoginController::class, 'verifyOtp'])->name('employee_verifyOtp');
Route::any('/employee/set-password', [OfficeLoginController::class, 'setPassword'])->name('employee_setPassword');
Route::get('/employee/logout', [OfficeLoginController::class, 'logout'])->name('employee_logout');
// End Office

Route::get('/facebook/login', [FacebookController::class, 'redirectToFacebook']);
Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
Route::get('/facebook/insights', [FacebookController::class, 'getFacebookInsights']);

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');      // Clear application cache
    Artisan::call('view:clear');       // Clear compiled views
    Artisan::call('config:clear');     // Clear config cache
    Artisan::call('route:clear');      // Clear route cache
    Artisan::call('optimize:clear');   // Clear optimization caches
    return 'Application cache has been cleared';
});
Route::get('/queue-work', function () {
    Artisan::call('queue:work');
    return 'queue:work';
});

Route::get('/lead-assign-cron', function () {
    Artisan::call('excel:distribute-leads');
    return 'excel:distribute-leads';
});


Route::get('/assign-integrated-lead-job', [MyOfficeAssignIntegratedLeadsCronJobController::class, 'cron_job']);
// Route::get('/assign-integrated-lead-job', [MyOfficeAssignIntegratedLeadsCronJobController::class, 'cron_job']);

Route::get('/sdsdsdsd', function () {
    $now = Carbon::now();
    $reminderTime = $now->copy()->addMinutes(30); // 30 min baad ke followups nikalna
    // dd($reminderTime);
    $followups = OfficeLeadFollowups::with('employee')->where('date', date('Y-m-d'))->where('time', '>', $now->toTimeString())->where('time', '<', $reminderTime->toTimeString())->where('active', 1)->where('notification_count', '<', 3)->get();
    // dd($followups);
    // dd($followups, $reminderTime->toTimeString(),$reminderTime->toDateString(),$now->toTimeString());
    foreach ($followups as $followup) {
        $employee = $followup->employee;
        if ($employee) {
            OfficeLeadFollowups::where('id', $followup->id)->update(['notification_count' => ($followup->notification_count + 1)]);
            Mail::to($employee->email)->send(new MeetingReminderMail($employee, $followup));
            // SmsService::sendSms($employee->phone, "Reminder: Your meeting is at {$followup->time} about {$followup->content}");
        }
    }
});
Route::any('/artisan-terminal', [ArtisanTerminalController::class, 'execute']);
// Route::post('/meetings/store', [MeetingController::class, 'store'])->name('meetings.store');
Route::get('/meetings/create', [MeetingController::class, 'create']);
Route::get('/google/connect', [GoogleController::class, 'redirectToGoogle'])->name('meetings.redirectToGoogle')->middleware('office_employee');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/meeting/schedule', [MeetingController::class, 'scheduleMeeting'])->name('meetings.store')->middleware('office_employee');

// routes/api.php
// Route::any('/employees/offline-all', [ArtisanTerminalController::class, 'offlineAll']);
