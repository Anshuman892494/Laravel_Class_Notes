<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Rules\checkUpperCase;

class formController extends Controller
{








    // public function submitform(Request $request){
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
    //     print_r($request->all());           //TO GETTING THE CSRF TOKENS VISIBLE
    //     return "Form Submitted Successfully";
    // }
    // public function showform(Request $request){
    //     return view('simpleForm');
    // }










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



//===================================================================
//validateForm.blade.php

    public function submitform(StoreUserRequest $request){
//     public function submitform(Request $request){
//         
        // $request->validate([
        //     // 'name' => 'required | min:2 | new checkUpperCase' ,
            
        //     // Normal rules → string me  (" ")
        //     // Custom class rules → array me ([ ])
            
        //     // 'name' => ['required', 'min:2', new checkUpperCase],
        //     // 'email' => 'required | email',
        //     // 'phone'=> 'required | digits:10',
        //     // 'gender'=>'required',
        //     // 'dob'=>'required',
        //     // 'age'=>'required | min:18',
        //     // 'address'=>'required',
        //     // 'pincode'=>'required | digits:6',
        //     // 'course'=>'required',
        //     // 'marks'=>'required | min:33 | max:100',
        //     // 'signature'=>'required|file|mimes:jpg,png,pdf|max:2048',
        //     // 'password'=>'required | min:6',
        //     // 'confpassword'=>'required | same:password',
        //     // 'terms'=>'required' 
        // ],
        // [
        //     'name.required' => 'Bhai Name to enter kro',
        //     'name.min' => 'Name kam se kam 2 characters ka hona chahiye',
            
        //     'email.required' => 'Bhai Email Check kro pahle',
        //     'email.email' => 'Valid email address enter kro na bhai',

        //     'phone.required' => 'Phone number to zaroori hai',
        //     'phone.digits' => 'Phone exactly 10 digits ka hona chahiye',

        //     'gender.required' => 'Gender select kro bhai',

        //     'dob.required' => 'Date of birth enter kro',

        //     'age.required' => 'Age enter kro bhai',
        //     'age.min' => 'Age 18 sal se zyada hona chahiye, bache',

        //     'address.required' => 'Address to likhna padega',

        //     'pincode.required' => 'Pincode enter kro na',
        //     'pincode.digits' => 'Pincode exactly 6 digits ka hona chahiye',

        //     'course.required' => 'Course select kro bhai',

        //     'marks.required' => 'Marks enter kro',
        //     'marks.min' => 'Marks kam se kam 33 hone chahiye pass hone ke liye',
        //     'marks.max' => 'Marks 100 se zyada nahi ho sakte',

        //     'signature.required' => 'Apna signature upload kro',
        //     'signature.mimes' => 'Image/pdf file upload kro',
        //     'signature.max' => 'Image/pdf file 2 mb se jyada na ho',

        //     'password.required' => 'Password enter kro bhai',
        //     'password.min' => 'Password kam se kam 6 characters ka hona chahiye',

        //     'confpassword.required' => 'Confirm password enter kro',
        //     'confpassword.same' => 'Password aur Confirm Password match nahi ho rahe',

        //     'terms.required' => 'Terms and Conditions ko accept kro bhai'
        // ]);
        // print_r($request->all());           //TO GETTING THE CSRF TOKENS VISIBLE
        return "Form Submitted Successfully";
    } 
    public function showform(Request $request){
        return view('validateForm');
    }













}
