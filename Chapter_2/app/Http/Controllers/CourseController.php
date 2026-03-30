<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('check.course');
    }
 
    public function course(){
    return "Your Course is Laravel";
    }
}
