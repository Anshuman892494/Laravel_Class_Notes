<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formController extends Controller
{
    public function submitform(Request $request){
        return "Form Submitted Successfully";
    }
    public function showform(Request $request){
        return view('simpleForm');
    }

    // Form Uploading

    public function showuploadform(Request $request){
        return view('uploadForm');
    }

    public function uploadform(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048'
        ]);

        $file = $request->file('file');

        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads'), $filename);

        // // return "File Uploaded Successfully";
        return back()
            ->with('file', $filename)
            ->with('success', 'Uploaded successfully'); 
    }
}
