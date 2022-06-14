<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IclockController;

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
Route::get('iclock/cdata', [IclockController::class, 'index']);
Route::post('iclock/cdata', [IclockController::class, 'post']);

Route::get('/test', function () {
    return view('welcome');
});
