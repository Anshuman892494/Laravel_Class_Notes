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

    public function showData() {
    $names = ['Anshu', 'Rahul', 'Krish', 'Harsh', 'Utkarsh'];
       return view('home', compact('names'));
    }

    public function showmulti() {
        $students = [
            ['id' => '1', 'name' => 'Anshu', 'age' => '20'],
            ['id' => '2', 'name' => 'Utkarsh', 'age' => '25'],
            ['id' => '3', 'name' => 'Vaibhav', 'age' => '24'],
            ['id' => '4', 'name' => 'Harsh', 'age' => '22'],
            ['id' => '5', 'name' => 'Sujeet', 'age' => '23'],
        ];
        return view('home',compact('students'));
    }

}
