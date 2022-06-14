<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// // });
// Auth::routes();
// Route::get('/',[MainController::class,'logout'])->name('auth.logout');


Route::group(['middleware'=>['AuthCheck']],function(){    
    Route::get('/',[MainController::class,'index'])->name('auth.login');    
    Route::get('/auth/register',[MainController::class,'create'])->name('auth.register');
    Route::get('/admin/dashboard',[MainController::class,'dashboard'])->name('dashboard');
    Route::get('/admin/home',[MainController::class,'home'])->name('home');
    Route::get('/admin/users',[MainController::class,'users'])->name('users');
    Route::get('/modal',[MainController::class,'modal']);

    
Route::post('/auth/save',[MainController::class,'store'])->name('auth.save');
Route::post('/auth/check',[MainController::class, 'check'])->name('auth.check');
  
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
