<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userCon;
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
    return view('home');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/userdata',[userCon::class,'showUser']);
Route::post('/userInfo',[userCon::class,'saveUser']);
Route::get('/userInfo/{id}',[userCon::class,'editUser']);
Route::patch('/saveuserInfo/{id}',[userCon::class,'saveeditUser']);