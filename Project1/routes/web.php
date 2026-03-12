<?php

use Illuminate\Support\Facades\Route;
// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/services', function () {
//     return view('services');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/user/{id?}', function ($id="N/A") {
//     return 'User ID:'.$id;
// });

// To print specifc name on page
// Route::get('/name', function(){
//     $name = 'Radhe';
//     return view('welcome',['name'=>$name]);

// });

// Route::get('/anshu', function(){
//     return view('anshu');
// });


// Data come from UserControllers
// use App\Http\Controllers\UserController;
// Route::get('/user', [UserController::class, 'index']);

// use App\Http\Controllers\AnshuController;
// Route::get('/anshu', [AnshuController::class, 'show']);



// Route::prefix('admin')->group(function(){
//     Route::get('/dashboard', function(){
//         return view('dashboard');
//     });
//     Route::get('/product/list', function(){
//         return view('product_list');
//     });
//     Route::get('/product/category', function(){
//         return view('product_category');
//     });
// });



// use App\Http\Controllers\studentController;
// Route::get('/students', [studentController::class, 'show']);

// Route::get('/student/{name?}', function($name="N/A"){
//     return view('student',['name'=>$name] );
// });

// Route::get('/course/{course?}', function($course="No Course Selected"){
//     return view('course',['course'=>$course] );
// });


// Data from Controller
use App\Http\Controllers\studentController;
Route::get('/students', [studentController::class, 'student']);

Route::get('/course/{course?}', [studentController::class, 'course']);

Route::get('/student/{name?}', [studentController::class, 'studentname']);
