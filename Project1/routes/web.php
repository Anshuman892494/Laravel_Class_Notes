<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
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

// Route::get('/user/{id?}/{name}', function ($id="N/A", $name) {
//     return 'User ID:'.$id.', Name: '.$name;
// });

// Route::get('/anshu', function(){
//     return view('anshu');
// });

// use App\Http\Controllers\UserController;
// Route::get('/user', [UserController::class, 'index']);

Route::prefix('admin')->group(function(){

    Route::get('/dashboard', function(){
        return view('dashboard');
    });
    Route::get('/product/list', function(){
        return view('product_list');
    });
    Route::get('/product/category', function(){
        return view('product_category');
    });
});