<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/classrooms', App\Http\Controllers\ClassroomController::class);
Route::resource('/majors', App\Http\Controllers\MajorController::class);
Route::resource('/students', App\Http\Controllers\StudentController::class);