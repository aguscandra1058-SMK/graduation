<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CekKelulusanController;

Route::get('/', [CekKelulusanController::class, 'index']);
Route::get('/hasil', [CekKelulusanController::class, 'hasil']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CekKelulusanController::class, 'index']);
Route::get('/hasil', [CekKelulusanController::class, 'hasil']);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

Route::resource('/classrooms', App\Http\Controllers\ClassroomController::class);
Route::resource('/majors', App\Http\Controllers\MajorController::class);
Route::resource('/students', App\Http\Controllers\StudentController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);