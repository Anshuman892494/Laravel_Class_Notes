<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\http\request;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/secure', function(){
//     if(request()->secure()){
//         return "Secure Page";
//     }
//     return "Use HTTPS";
// });



// Domain Routing, URL Generation- The current URL
Route::domain('anshu.com')->group(function(){
    Route::get('/', function(){
        return 'This is my Home Page';
    });
    Route::get('/dashboard', function(Request $request){
        // return url()->current();
        return [
            'path'=>$request->path(),
            'current'=>url()->current(),
            'full'=>url()->full(),
            'previous'=>url()->previous()
        ];
    });
});


// Parameter Constraints
Route::get('/user/{id}', function($id){
    return 'User Id:'.$id;
// })->where('id','[0-9]+');
})->where('id','[A-Za-z]+');


// Grouping by prefix
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

// Grouping of controllers
Route::controller(StudentController::class)->group(function(){
    Route::get('/details', 'details');
    Route::get('/students', 'students');
    Route::get('/profile', 'profile');
});


require __DIR__.'/auth.php';
