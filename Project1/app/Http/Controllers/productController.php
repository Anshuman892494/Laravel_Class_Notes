<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productController extends Controller
{
    public function product($id = "101"){
    return response()
        ->view('product', ['id' => $id])
        ->cookie('product', 'DairyMilk', 2);
    }

    // return view('viewname', ['variable'=>value]);
    //same variable name written in view page {{$variable}} for getting output
}
