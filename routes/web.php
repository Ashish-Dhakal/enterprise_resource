<?php

use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendEmailController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['register' => false]);

//user wont be able to register. Admin would be responsible for creating user

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//routes to only access by admin

Route::middleware(['auth'])->group(function () {
    Route::middleware(['checkRole:Admin'])->group(function () {
        Route::resource('employee', App\Http\Controllers\EmployeeController::class);
        //    Route::resource('leave', App\Http\Controllers\LeaveController::class);
        Route::resource('department', App\Http\Controllers\DepartmentController::class);
        Route::resource('position', App\Http\Controllers\PositionController::class);
        //    Route::resource('holiday', App\Http\Controllers\HolidayController::class);
        Route::resource('project', App\Http\Controllers\ProjectController::class);
        Route::resource('notice', App\Http\Controllers\NoticeController::class);
        Route::resource('appreciation', App\Http\Controllers\AppreciationController::class);
        Route::resource('salary', App\Http\Controllers\SalaryController::class);
        Route::resource('task', App\Http\Controllers\TaskController::class);

        //task
        Route::get('/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('task.create');
        Route::get('/task/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
        Route::put('/task/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
        Route::delete('/task/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task.destroy');




        //leave
        Route::get('/leave/edit/{id}', [App\Http\Controllers\LeaveController::class, 'edit'])->name('leave.edit');
        Route::put('/leave/{id}', [App\Http\Controllers\LeaveController::class, 'update'])->name('leave.update');
        Route::delete('/leave/{id}', [App\Http\Controllers\LeaveController::class, 'destroy'])->name('leave.destroy');

        //holiday
        Route::get('/holiday/edit/{id}', [App\Http\Controllers\HolidayController::class, 'edit'])->name('holiday.edit');
        Route::put('/holiday/{id}', [App\Http\Controllers\HolidayController::class, 'update'])->name('holiday.update');
        Route::delete('/holiday/{id}', [App\Http\Controllers\HolidayController::class, 'destroy'])->name('holiday.destroy');
        Route::get('/holiday/create', [App\Http\Controllers\HolidayController::class, 'create'])->name('holiday.create');
        Route::post('/holiday/store', [App\Http\Controllers\HolidayController::class, 'store'])->name('holiday.store');
    });


    //task
    Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('task.index');

    //notice
    Route::resource('/notice', NoticeController::class)->except(['create']);


    //leave
    Route::get('/leave', [App\Http\Controllers\LeaveController::class, 'index'])->name('leave.index');
    Route::get('/leave/create', [App\Http\Controllers\LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave/store', [App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');
    Route::get('/leave/{id}', [App\Http\Controllers\LeaveController::class, 'show'])->name('leave.show');

    //holiday
    Route::get('/holiday', [App\Http\Controllers\HolidayController::class, 'index'])->name('holiday.index');
    Route::get('/holiday/{id}', [App\Http\Controllers\HolidayController::class, 'show'])->name('holiday.show');



    Route::resource('attendance', App\Http\Controllers\AttendanceController::class)->except(['store']);
    Route::resource('attendance', App\Http\Controllers\AttendanceController::class)->except(['show']);




    //emergencycontact

    Route::resource('emergency', App\Http\Controllers\EmergencyController::class);


    //setting
    Route::resource('setting', App\Http\Controllers\SettingController::class);

    //timesheet
    // Route::resource('timeSheet', App\Http\Controllers\TimeSheetController::class);


    // Route::get('/timeSheet', [App\Http\Controllers\TimeSheetController::class, 'index'])->name('timeSheet.index');
    // Route::get('/timeSheet/edit/{id}', [App\Http\Controllers\TimeSheetController::class, 'edit'])->name('timeSheet.edit');
    // Route::get('/timeSheet/show', [App\Http\Controllers\TimeSheetController::class, 'show'])->name('timeSheet.show');

    Route::resource('timeSheet' , App\Http\Controllers\TimeSheetController::class);

    //for static view for show project
    // Route::get('/project/show', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');


    //changepassword
    Route::resource('changepassword', App\Http\Controllers\ChangePasswordController::class);



    Route::get('clock-in', [App\Http\Controllers\AttendanceController::class, 'store'])->name('clock-in');

    Route::get('notifications/get', [App\Http\Controllers\NotificationsController::class, 'getNotificationsData'])
        ->name('notifications.get');

    Route::get('task/userTask/{id}', [App\Http\Controllers\TaskController::class, 'getTaskInformation'])
        ->name('task.userTask');


    //route to save the the timer information if a task
    Route::resource('timer', App\Http\Controllers\TimerController::class);
    Route::post('/timer/calculation', 'App\Http\Controllers\TimerController@calculation')->name('timer.calculation');

    Route::post('attendance/month', [App\Http\Controllers\AttendanceController::class, 'months'])->name('attendance.months');
    // Route::post('attendance/select', [App\Http\Controllers\AttendanceController::class, 'months'])->name('attendance.months');



    // Route::get('/send/markdown', 'SendEmailController@sendMarkdown');

    Route::get('/send-mail', [SendEmailController::class, 'index'])->name('email');


    // chat
    Route::resource('chat' , App\Http\Controllers\ChatController::class);
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'fetchMessages']);
    Route::post('/messages', [\App\Http\Controllers\ChatController::class, 'storeMessage']);
});
