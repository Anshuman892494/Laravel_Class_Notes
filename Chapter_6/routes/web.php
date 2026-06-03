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

// Route::get('/set-cookie', function(){
//     return response("Cookies Set")
//     // cookie(name, value, minutes)
//     //  Parameter	Meaning
//     // 'username'	Cookie name
//     // 'Anshu'	Cookie value
//     ->cookie('username', 'Anshu', 1 );
// });

// // Get cookies by name
// // Method - 1 using Request
// Route::get('/get-cookie', function(Request $request){
//     return $request->cookie('username');
// });

// Route::get('/get-cookie', function () {
//     return response("Cookies Get")
//     ->cookie('username');
// });

// // Method - 2 using Facade
// use Illuminate\Support\Facades\Cookie;

// Route::get('/get-cookie', function () {
//     return Cookie::get('username');
// });


// // Delete the cookis
// // use Illuminate\Support\Facades\Cookie;
// // Method 1: Cookie::forget() 
// Route::get('/delete-cookie', function () {
//     return response("Cookie Deleted")
//         ->withCookie(Cookie::forget('username'));
// });

// // Method 2: Expire manually
// Route::get('/delete-cookie', function () {
//     $cookie = Cookie::make('username', '', -1); // past time
//     return response("Cookie Deleted")
//         ->withCookie($cookie);
// });

// // Set → cookie(name, value, time)
// // Get → Cookie::get(name)
// // Delete → Cookie::forget(name) 

// // ====================================================================================== Forms (Uploaded Files) 


// use App\Http\Controllers\formController;

// // Form Route
// Route::get('/show-form', [formController::class, 'showform']);
// Route::post('/submit-form', [formController::class, 'submitform']);

// // File Upload Route
// Route::get('/upload-form', [formController::class, 'showuploadform']);
// Route::post('/upload-form', [formController::class, 'uploadform']);

// // =================================================================================================== Emails

// // Email Route
// use Illuminate\Support\Facades\Mail;
// use App\Mail\AnshuMail;

// Route::get('/send-mail', function () {
//     Mail::to('ishikaishika1603@gmail.com')->send(new AnshuMail());
//     return "Mail Sent";
// });


// ================================================================================================= Sessions

// Get Session	session('key')
// Store Session	session(['key' => 'value'])
// Delete Session	session()->forget('key')
// Flash Message	session()->flash()
// Translate	__('file.key')
// Change Language	App::setLocale()


// Route::get('/session', function (Request $request) {

//     // store single
//     $request->session()->put('name', 'Anshu');

//     // store multiple
//     $request->session()->put([
//         'age' => 12,
//         'section' => 'SO',
//         'lang' => 'en'
//     ]);

//     // initialize array
//     $request->session()->put('city', []);

//     // push values
//     $request->session()->push('city', 'Ludhiana');
//     $request->session()->push('city', 'Jalandhar');

//     // helper method
//     session(['course' => 'PHP']);

//     return [
//         'name' => $request->session()->get('name'),
//         'all_data' => $request->session()->all()
//     ];
// });


// Route::get('/set', function(Request $request){
//     $request->session()->flash('message', 'Data saved successfully!');
//     return redirect('/get');
// });

// Route::get('/get', function(Request $request){
//     return $request->session()->get('message');
// });


// ===============================================================================================

Route::get('/set', function(Request $request){
    // $request->session()->now('info', 'Radhe Radhe');    //message is not showing because of NOW function could not work when url get changed
    $request->session()->flash('info', 'Radhe Radhe');  //now message showing (when we change the NOW function to FLASH function then it work)
    // return redirect('/now-test');
    // return view('now');
});

Route::get('/now-test', function(Request $request){
    return view('now');
});

// Function	        Works After Redirect?   	Use Case
// now()	        ❌ No	                    Same page
// flash()	        ✅ Yes	                    Redirect



Route::get('/so', function(Request $request){
    return [
        'get' => $request->session()->get('country'),

        // Passing Parameter        
        'default-value' => $request->session()->get('domain', 'AB'),

        // Session Helper Method        
        'session' => $request->session('company-name'),

        // All Method 
        'all' => $request->session()->all()

    ];
});


// has() method check karta hai ki key exist karti hai aur value null nahi hai, 
// jabki exists() method sirf key exist karti hai ya nahi check karta hai, chahe value null ho.

// // has() method
// session()->put('info', 'Radhe Radhe');
// session()->has('info'); // ✅ true

// session()->put('info', null);
// session()->has('info'); // ❌ false

// // exists() method
// session()->exists('info');

// session()->put('info', null);
// session()->exists('info'); // ✅ true

Route::get('/session-test', function (Request $request) {

    // Case 1: Normal value
    $request->session()->put('info', 'Radhe Radhe');

    $has1 = $request->session()->has('info');       // true
    $exists1 = $request->session()->exists('info'); // true

    // Case 2: Null value
    $request->session()->put('info', null);

    $has2 = $request->session()->has('info');       // false
    $exists2 = $request->session()->exists('info'); // true

    return view('session-test', compact('has1', 'exists1', 'has2', 'exists2'));
});

Route::get('/session-all', function(Request $request){

    $request->session()->put('info', 'Radhe Radhe');
    $request->session()->put('user', 'Anshu');
    $request->session()->put('role', 'admin');

    $request->session()->forget('info');        //forget() → specific delete

    $pulled = $request->session()->pull('user');    //pull() → nikalo + delete // Anshu

    $request->session()->flush();               //flush() → sab uda do

    return response()->json([
        'pulled_user' => $pulled,
        'has_info' => $request->session()->has('info'),     // false
        'has_user' => $request->session()->has('user'),     // false
        'has_role' => $request->session()->has('role'),     // false
    ]);
});

// =============================================================================================== Localization

Route::get('/lang', function(Request $request){
    return view('lang');
});


Route::get('/lang/{locale}', function($locale){
    Session::put('locale',$locale);
    $value = Session::get('locale'); //getting the value of locale from sessions
    App::setlocale($value);
    return view('dynamic_lang');
});


// ================================================================================================

// Route::get('/dash', function(){
//     return view('dashboard');
// });

Route::get('/dash/{locale}', function($locale){
    Session::put('locale',$locale);
    $value = Session::get('locale'); //getting the value of locale from sessions
    App::setlocale($value);
    return view('dashboard',['locale'=>$locale]); //passing data dynamically for next page
});


Route::get('/about/{locale}', function($locale){
    Session::put('locale',$locale);
    $value = Session::get('locale'); //getting the value of locale from sessions
    App::setlocale($value);
    return view('about');
});



// ========================================================================================== Chapter 5
// ====================================================================================== Forms (Uploaded Files) 


use App\Http\Controllers\formController;
use App\Http\Controllers\Anshu;
// Form Route
// Route::get('/show-form', [formController::class, 'showform']);
// Route::post('/submit-form', [formController::class, 'submitform']);

// // File Upload Route
// Route::get('/upload-form', [formController::class, 'showuploadform']);
// Route::post('/upload-form', [formController::class, 'uploadform']);



// =============================================================================================


// Route::resource('Anshu', Anshu::class);
// Route::get('/show', [formController::class, 'showform']);

// ==================================================================================================


// Form Route
Route::get('/show-form', [formController::class, 'showform']);
Route::post('/submit-form', [formController::class, 'submitform']);


// ==================================================================================================== Querry Builder DB
// Route::get('/insert', function(){
//     DB::table('sports')->insert([

//     ]);
// });


// FOr inserting the data
Route::get('/insert', function () {

    DB::table('sports')->insert([

        [
            'sports_name' => 'Cricket',
            'category' => 'Outdoor',
            'no_of_players' => 11,
            'description' => 'Bat and ball game',
            'is_olympic' => false,
            'date_of_sport' => '2026-05-21',
        ],

        [
            'sports_name' => 'Football',
            'category' => 'Outdoor',
            'no_of_players' => 11,
            'description' => 'World famous sport',
            'is_olympic' => true,
            'date_of_sport' => '2026-05-22',
        ],

        [
            'sports_name' => 'Chess',
            'category' => 'Indoor',
            'no_of_players' => 2,
            'description' => 'Mind strategy game',
            'is_olympic' => false,
            'date_of_sport' => '2026-05-23',
        ]

    ]);

    return "Multiple Records Inserted";
});


// For getting all the data
Route::get('/fetch-all', function(){
    return DB::table('sports')->get();
});


// For getting filtered the data
Route::get('/fetch-indoor', function(){
    return DB::table('sports')->where('category', 'Indoor')->get();
});


// For getting sorted the data
Route::get('/fetch-sorted', function(){
    return DB::table('sports')->orderBy('sports_name')->get();
});


// For Updating the data
Route::get('/update', function(){
    // lets update the football player 11 to 15
    return DB::table('sports')->where('id', 2)->update([
        'no_of_players'=>11
    ]);
});


// For Deleting the data
Route::get('/delete', function(){
    // lets delete the football sports
    return DB::table('sports')->where('id', 2)->delete();
});

// For Deleting the database
// Route::get('/truncate', function(){
//     return DB::table('sports')->truncate();
// });



// ================================================================================= ORM
use App\Models\Sport;


//For inserting the data by ORM

// it give this error
// Illuminate\Database\Eloquent\MassAssignmentException
// vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model.php:684
// Add [sports_name] to fillable property to allow mass assignment on [App\Models\Sport].


//by default we can not insert data in ORM so we use "PROTECTED $FILLABLE" and pass the ids of scema (sports_name, category etc) in Model file

Route::get('/insert-orm', function () {

    Sport::create([

        'sports_name' => 'BGMI',
        'category' => 'Indoor',
        'no_of_players' => 4,
        'description' => 'Video Game',
        'is_olympic' => false,
        'date_of_sport' => '2026-05-21',

    ]);

    return "Data Inserted Using ORM";
});


// For fetching data using ORM
Route::get('fetch-all-orm', function(){
    return Sport::all();
});

// for fetching a specific id
Route::get('fetch-id-orm', function(){
    return Sport::find(3);
});

// for fetching a specific condition - outdoor
Route::get('fetch-outdoor-orm', function(){
    return Sport::where('category', 'outdoor')->get();
});


//For updating the data using ORM
Route::get('update-orm', function(){
    Sport::find(3)->update([
        'no_of_players'=>20
    ]);
    return 'Data Updated Successfully';
});

//For deleteing the data using ORM
Route::get('delete-orm', function(){
    Sport::find(1)->delete();
    return 'Data Deleted Successfully';
});
