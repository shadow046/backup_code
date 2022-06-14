<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DTRController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\UserController;


use Illuminate\Http\Request;
use Validator,Redirect,Response;

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

// Route::get('/login', function () {
//     return view('auth.register');
// });

// Route::get('/', function () {
//     return view('homeview');
// });
Route::get('/', [HomeController::class ,'index']);
Route::get('/dtr', [DTRController::class ,'index']);
Route::get('/employees', [EmployeesController::class ,'index']);
Route::get('/branch', [BranchController::class ,'index']);


Route::get('/user', [UserController::class ,'index']);
Route::any('/user/save', [UserController::class ,'saveuser']);
Route::any('/user/validate/update', [UserController::class ,'validate_updateuser']);
Route::any('/user/validate/user', [UserController::class ,'validate_newuser']);
Route::any('/user/update', [UserController::class ,'updateuser']);
Route::get('/user/data', [UserController::class ,'userTable']);
Route::any('/user/delete', [UserController::class ,'deleteuser']);

Route::get('/holiday', [HolidayController::class ,'index']);
Route::get('/holiday/data', [HolidayController::class ,'holidayTable']);
Route::any('/holiday/save', [HolidayController::class ,'saveholiday']);
Route::put('/holiday/update', [HolidayController::class ,'updateholiday']);
Route::any('/holiday/validate/update', [HolidayController::class ,'validate_updateholiday']);

Route::get('/leave', [LeaveController::class ,'index']);
Route::get('/leave/data', [LeaveController::class ,'leaveTable']);
Route::any('/leave/validate/leave', [LeaveController::class ,'validate_newleave']);
Route::any('/leave/save', [LeaveController::class ,'saveleave']);
Route::any('/leave/validate/update', [LeaveController::class ,'validate_updateleave']);
Route::any('/leave/update', [LeaveController::class ,'updateleave']);

Route::get('/shift', [ShiftController::class ,'index']);
Route::get('/shift/data', [ShiftController::class ,'shiftTable']);
Route::any('/shift/save', [ShiftController::class ,'saveshift']);
Route::any('/shift/update', [ShiftController::class ,'updateshift']);

Route::get('/branch', [BranchController::class ,'index']);
Route::get('/branch/city', [BranchController::class ,'getCity']);
Route::get('/branch/region', [BranchController::class ,'getRegion']);
Route::get('/branch/data', [BranchController::class ,'branchTable']);
Route::post('/branch/save', [BranchController::class ,'savebranch']);
Route::any('/branch/update', [BranchController::class ,'updatebranch']);

Route::get('/employees', [EmployeesController::class ,'index']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
