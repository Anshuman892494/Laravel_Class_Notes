<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentController extends Controller
{
    // public function student(){
    //     return view('student');
    // }

    // public function course($course="No Course Selected"){
    //     return view('course', ['course'=>$course ]);
    // }

    // public function studentname($name="Anshu"){
    //     return view('studentname', ['name'=>$name ]);
    // }

    // public function profile($name="Anshu"){
    //     return view('studentprofile', ['name'=>$name ]);
    // }
 
    public function profile($id, $name = "Anshu"){
    return response()->view('studentprofile', [
        'name' => $name,
        'id' => $id
    ])->header('Content-Type', 'text/html');
}

// Route::get('/student/{name?}', function($name="N/A"){
//     return view('student',['name'=>$name] );
// });

    // return view('viewname', ['variable'=>value]);
    //same variable name written in view page {{$variable}} for getting output
}
