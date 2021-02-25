<?php

use App\Http\Controllers\AdministratorController;
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

Route::get('/login',[AdministratorController::class,'view_login'])->name('view_login');
Route::post('/login',[AdministratorController::class,'login'])->name('login');
Route::get('/users',[AdministratorController::class,'users'])->name('users')->middleware('auth:web');
Route::post('/logout',[AdministratorController::class,'logout'])->name('logout');


Route::post('/user/accept/{id_user}',[AdministratorController::class,'accept'])->name('users.accept')->middleware('auth:web');
Route::post('/user/reject/{id_user}',[AdministratorController::class,'reject'])->name('users.reject')->middleware('auth:web');

