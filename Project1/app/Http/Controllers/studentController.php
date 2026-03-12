<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class studentController extends Controller
{
    public function student(){
        return view('student');
    }

    public function course($course="No Course Selected"){
        return view('course', ['course'=>$course ]);
    }

    public function studentname($name="Anshu"){
        return view('studentname', ['name'=>$name ]);
    }

    // return view('viewname', ['variable'=>value]);
    //same variable name written in view page {{$variable}} for getting output
}
