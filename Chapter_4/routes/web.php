<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;



Route::get('/', function () {
    return response("Radhe Radhe");
});


// Route::get('/secure', function(){
//     if(request()->secure()){
//         return "Secure Page";
//     }
//     return "Use HTTPS";
// });

//making named Route
// Route::get('/anshu', function () {
//     return view('anshu');
// })->name('anshuman');//named as anshuman


// Domain Routing, URL Generation- The current URL
// Route::domain('anshu.com')->group(function(){
    
//     Route::get('/', function () {
//         return redirect()->route('anshuman'); //called by named route
//     });    

//     Route::get('/dashboard', function(Request $request){
//         // return url()->current();
//         return [
//             'path'=>$request->path(),
//             'current'=>url()->current(),    
//             'full'=>url()->full(),
//             'previous'=>url()->previous()
//         ];
//     });
// });

//Laravel me action() ka use hota hai controller ke method ka URL generate karne ke liye.

// use App\Http\Controllers\UserController;
// Route::get('/user', [UserController::class, 'index']);


// Route::get('/', function () {
//     return redirect()->action([UserController::class, 'index']);
// });

//or $url = action([UserController::class, 'index']);


// =========================================================================================================
// Request Data-Retrieval

// In Laravel, Request Data Retrieval ka matlab hota hai:
// User (form, URL, API, etc.) se jo data aata hai, usko access karna
Route::domain('anshu.com')->group(function(){
   
    // URL ke ?key=value → Request data
    // $request->input() → single value
    // $request->only() → multiple values
    // $request->filled() → check empty ya nahi
    
    Route::get('/dash', function(Request $request){
        // return $request->name;
        return $request->input('name');
    });

    // //using if conditions
    // Route::get('/dash', function(Request $request){
    //     // return $request->name;
    //     if($request->filled('name')){
    //         return $request->name;
    //     }
    //     return $request->age;
    // });
    
    // //using if conditions
    // Route::get('/dash', function(Request $request){
    //     return $request->only(['age', 'course']);
    // });


    // in one return
    // return[
    //     'except'=> $request->except(['age, course']),
    //     'only'=> $request->only(['age, course']),
    //     'all'=> $request->all(),
    //     'using-input'=> $request->input('name'),
    //     'course'=> $request->course,
    //     'filled'=> $request->filled('name')? 'Filled':'Not filled',
    //     'has'=> $request->has('name')? 'Input Name Exist':'Doed not exist',
    //     'isMethod'=> $request->isMethod('post')?'Post':'Get',
    //     'default-value'=> $request->input('age', 23),
    //     'using-query'=> $request->query('name'),
    //     'headers'=> $request->header('Authorization'),
    // ];
    
});

// =================================================================================

Route::get('/set-cookie', function(){
    return response("Cookies Set")
    // cookie(name, value, minutes)
    //  Parameter	Meaning
    // 'username'	Cookie name
    // 'Anshu'	Cookie value
    ->cookie('username', 'Anshu', 1 );
});

// Get cookies by name
// Method - 1 using Request
Route::get('/get-cookie', function(Request $request){
    return $request->cookie('username');
});

Route::get('/get-cookie', function () {
    return response("Cookies Get")
    ->cookie('username');
});

// Method - 2 using Facade
use Illuminate\Support\Facades\Cookie;

Route::get('/get-cookie', function () {
    return Cookie::get('username');
});


// Delete the cookis
// use Illuminate\Support\Facades\Cookie;
// Method 1: Cookie::forget() 
Route::get('/delete-cookie', function () {
    return response("Cookie Deleted")
        ->withCookie(Cookie::forget('username'));
});

// Method 2: Expire manually
Route::get('/delete-cookie', function () {
    $cookie = Cookie::make('username', '', -1); // past time
    return response("Cookie Deleted")
        ->withCookie($cookie);
});

// Set → cookie(name, value, time)
// Get → Cookie::get(name)
// Delete → Cookie::forget(name) 

// ====================================================================================== Forms (Uploaded Files) 


use App\Http\Controllers\formController;

// Form Route
Route::get('/show-form', [formController::class, 'showform']);
Route::post('/submit-form', [formController::class, 'submitform']);

// File Upload Route
Route::get('/upload-form', [formController::class, 'showuploadform']);
Route::post('/upload-form', [formController::class, 'uploadform']);

// =================================================================================================== Emails

// Email Route
use Illuminate\Support\Facades\Mail;
use App\Mail\AnshuMail;

Route::get('/send-mail', function () {
    Mail::to('anshuman892494@gmail.com')->send(new AnshuMail());
    return "Mail Sent";
});
