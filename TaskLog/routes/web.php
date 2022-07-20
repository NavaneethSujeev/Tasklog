<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
// });
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/dologin', [LoginController::class, 'dologin'])->name('dologin');

Route::any('/homepage', [HomeController::class, 'homepage'])->name('homepage');
Route::any('/addtask', [HomeController::class, 'addtask'])->name('addtask');
Route::any('/doaddtask', [HomeController::class, 'doaddtask'])->name('doaddtask');
Route::any('/taskdetails', [HomeController::class, 'taskdetails'])->name('taskdetails');
Route::any('/updatetask', [HomeController::class, 'updatetask'])->name('updatetask');
Route::any('/edittask', [HomeController::class, 'edittask'])->name('edittask');
Route::any('/logout', [HomeController::class, 'logout'])->name('logout');

Route::any('/addstaff', [HomeController::class, 'addstaff'])->name('addstaff');
Route::any('/doaddstaff', [HomeController::class, 'doaddstaff'])->name('doaddstaff');
Route::any('/changestatus', [HomeController::class, 'changestatus'])->name('changestatus');












