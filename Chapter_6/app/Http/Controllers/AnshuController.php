<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnshuController extends Controller
{
      public function show($id)
    {
        return view('profile', ['user' => $id]);
    }
}
