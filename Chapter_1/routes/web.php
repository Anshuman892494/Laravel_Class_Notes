<?php

/*
    Workflow
    Index.php ->  kernal call bootstrap App.php -> middleware -> Route(Web.php) -> Controller -> Response View then all
*/



// Imports
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

// ==========================================================================
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

// Direct view without any function
// Route::view('/anshu', 'student');


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



// Route::get('/students', [studentController::class, 'show']);

// Route::get('/student/{name?}', function($name="N/A"){
//     return view('student',['name'=>$name] );
// });

// Route::get('/course/{course?}', function($course="No Course Selected"){
//     return view('course',['course'=>$course] );
// });


// // Data from Controller
// use App\Http\Controllers\studentController;
// Route::get('/students', [studentController::class, 'student']);

// Route::get('/course/{course?}', [studentController::class, 'course']);

// Route::get('/student/{name?}', [studentController::class, 'studentname']);

// ======================================================================================== 16/03/2026

// JSON Response

// Make Simple Response in API
Route::get('/', function(){
    return response("Radhe Radhe!!");
});

// Make Header response in API
// Route::get('/', function(){
//     return response("Radhe Radhe!!")
//     ->header('Content-Type', 'text/plain')
//     ->header('X-Custom-Header', 'Laravel');
// });

// // Make JSON response on API
// Route::get('/json', function(){
//     return response()->json([
//         'name'=>'Anshuman',
//         'Class'=>'10th',
//         'Subject'=>'Laravel',
//     ]);
// });


// =====================================================================================

// Attaching Cookies

// /set-cookie   → Cookie created
//       ↓
// Browser stores cookie
//       ↓
// /get-cookie   → Cookie read


// Set the Cookies

// Route::get('/set-cookie', function(){
//     return response("Cookies Set")
//     // cookie(name, value, minutes)
//     //  Parameter	Meaning
//     // 'username'	Cookie name
//     // 'Anshu'	Cookie value
//     ->cookie('username', 'Anshu', 1 );
// });

// // Get cookies by name

// Route::get('/get-cookie', function(Illuminate\Http\Request $request){
//     return $request ->cookie('username');
// });


// use Illuminate\Http\Request;

// Route::get('/get-cookie', function(Request $request){
//     return $request->cookie('username');
// });

// Route::get('/get-cookie', function () {
//     return response("Cookies Get")
//     ->cookie('username');
// });


// ==================================================================================

// Apply Redirect 
// User → /login  
// Login success  
//       ↓  
// Redirect → /dashboard

// Route::get('/dashboard', function(){
//     return "This is my Dashboard Page";
// });


// Redirect with message as Login Successful
Route::get('/dashboard', function(){
    return view('dashboard');
});

// Route::get('/home', function(){
//     return redirect('/dashboard')->with('success','Login Successful');
// });

// Route::get('/old-dashboard', function(){
//     return "Old Dashboard";
// });

// Route::get('/new-dashboard', function(){
//     return "New Dashboard";
// })->name('dashboard');   

// Route::get('/new-dashboard', function(){
//     return view('dashboard');
// })->name('dashboard');


// Route::get('/login', function(){
//     return redirect('/old-dashboard')
//     ->with('success', 'Login Successful');
// });

// Route::get('/login', function(){
//     return redirect()->route('dashboard');
// });


// Redirect Type        	            Use
// redirect('/page')	            Go to another URL
// redirect()->route()	            Redirect using route name
// redirect()->back()	            Go back to previous page
// redirect()->with()	            Redirect with message
// ->name('dashboard')              Route name

// ========================================================================

// Route::get('/login/{email?}/{pass?}', function($email="abc@123"){
//        return view('login',['email'=>$email]);
// });

// Route::get('/', function(){
//     return redirect('/login')->with('success','Login Successful');
// });


// Error
// Route::get('/login', function(){
    
//     $email = request('email');
//     $password = request('password');

//     if($email == "admin@gmail.com" && $password == "123"){
//         return redirect()->route('dashboard')
//             ->with('success','Login Successfull');
//     }

//     return redirect()->back();
// });

// ===============================================================================================19/03

// Redirect To Controller

// Route::get('/studentController', [studentController::class, 'student']); //Make the specific route for controller

// Route::get('/go', function(){
//     return redirect()->action([studentController::class, 'student']); //redirect from /go to /ab by using action to controller
// });


// Example 1

// Route::get('/studentprofie', function(){
//     return view('studentprofile');
// });


// Data come from UserControllers
// Route::get('/student-profile/{id?}/{name?}', [studentController::class, 'profile']);


// Example 2
// Route::get('/product/{id?}', function(){
//     return view('product');
// });

// Route::get('/product', function(){
//     return view('product');
// })->name('product');


// use App\Http\Controllers\productController;
// // Route::get('/product/{id?}', [productController::class, 'product']);

// Route::get('/product/{id?}', [ProductController::class, 'product'])
//     ->name('product');





/* 
===============================================================================
UNIT 3 - 
=============================================================================== 23/03
*/

// RESOURCE CONTROLLER
use App\Http\Controllers\ProductsController;
// Route::get('/index', [ProductsController::class, 'index']); //from Index() function 
// Route::get('/create', [ProductsController::class, 'create']); //from Create() function 
// Route::get('/show', [ProductsController::class, 'show']); //from Show() function
// Route::get('/edit', [ProductsController::class, 'edit']); //from Edit() function
Route::resource('product', ProductsController::class); //Resource Controller


// API CONTROLLER
use App\Http\Controllers\BookController;
// Route::get('/books', [BookController::class, 'index']); //Default
// Route::post('/books', [BookController::class, 'store']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::put('/books/{id}', [BookController::class, 'update']);
// Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::apiResource('books', BookController::class); //Api controller


// SINGLE ACTION CONTROLLER
use App\Http\Controllers\ActionController;
Route::get('/action/{id?}/{name?}', ActionController::class);

// Example

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MoviesController;
Route::get('/login/{username?}/{pass?}', LoginController::class);//Single Action Controller
Route::apiResource('/course', CourseController::class); //Api controller
Route::Resource('/movies', MoviesController::class); //Resource controller
