<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnshuController extends Controller
{
    public function show(){
        $name='Anshu';
        return view('welcome', ['name'=>$name ]);
    }
};

