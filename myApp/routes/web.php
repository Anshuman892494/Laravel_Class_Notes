<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/users/{name}', [UserController::class, 'user'])
        ->where('name', '[A-Za-z]+')
        ->middleware('checkuser');
});