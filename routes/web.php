<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

Route::resource('/classrooms', App\Http\Controllers\ClassroomController::class);
Route::resource('/majors', App\Http\Controllers\MajorController::class);
Route::resource('/students', App\Http\Controllers\StudentController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);