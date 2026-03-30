<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Middleware\CheckUser;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [StudentController::class, 'profile'])
->middleware('check.user');

Route::get('/course', [CourseController::class, 'course']);
// ->middleware('check.course');

// Route::get('/test', function () {
//     return "Welcome Anshu";
// })->middleware(\App\Http\Middleware\CheckUser::class);

Route::get('/content', [StudentController::class, 'content']);