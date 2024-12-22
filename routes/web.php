<?php
use App\Mail\NewLeaveNotification;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/staffs', 'StaffController@index');
Route::get('/staffs/{id}', 'StaffController@show');
Route::get('/staffs/create', 'StaffController@create');


// Route::get('/staffs', 'StaffController@index');
// Route::get('/staffs/{id}', 'StaffController@show');
// Route::get('/staffs/create', 'StaffController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/createstaff', 'StaffController@createStaff');
Route::POST('/createstaff', 'StaffController@store');
Route::get('/allstaffs', 'StaffController@allStaff');
Route::delete('/allstaffs/{id}', 'StaffController@destroy');
Route::get('/editstaffs/{id}', 'StaffController@editStaff');
Route::POST('/editstaffs/{id}', 'StaffController@updateStaff');

//Leave routes
Route::get('/createleave', 'LeaveController@createLeave');
Route::POST('/createleave', 'LeaveController@store');

//route for individuals
Route::get('/staff/approval', 'LeaveController@approval');

Route::PUT('/approval/{id}', 'LeaveController@approve');
Route::PUT('/rejection/{id}', 'LeaveController@reject');

//admin
Route::get('/staff/adminLeaveHistory', 'LeaveController@adminLeaveHistory');
//linemanager
Route::get('/staff/managerLeaveHistory', 'LeaveController@managerLeaveHistory');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [AdminDashboardController::class, 'index'])->name('home');

