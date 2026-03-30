<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function content(){
        return view('content');
    }

    // public function __construct(){
    //     $this->middleware('check.user');
    // }

    // public function profile(){
    // return "Welcome";
    // }

}
