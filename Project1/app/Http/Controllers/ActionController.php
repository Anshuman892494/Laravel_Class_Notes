<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id = null, $name = null)
    {
        return response()->json([
            'id' => $id,
            'name' => $name
    ]);
    }
}
