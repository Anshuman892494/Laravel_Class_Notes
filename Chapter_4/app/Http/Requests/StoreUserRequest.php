<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use App\Rules\checkUpperCase;



class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', new checkUpperCase],
            'email' => 'required | email',
            'phone'=> 'required | digits:10',
            'gender'=>'required',
            'dob'=>'required',
            'age'=>'required | min:18',
            'address'=>'required',
            'pincode'=>'required | digits:6',
            'course'=>'required',
            'marks'=>'required | min:33 | max:100',
            'signature'=>'required|file|mimes:jpg,png,pdf|max:2048',
            'password'=>'required | min:6',
            'confpassword'=>'required | same:password',
            'terms'=>'required' 
        ];
    }

    public function messages(){
        return[
            'name.required' => 'Bhai Name to enter kro',
            'name.min' => 'Name kam se kam 2 characters ka hona chahiye',
            
            'email.required' => 'Bhai Email Check kro pahle',
            'email.email' => 'Valid email address enter kro na bhai',

            'phone.required' => 'Phone number to zaroori hai',
            'phone.digits' => 'Phone exactly 10 digits ka hona chahiye',

            'gender.required' => 'Gender select kro bhai',

            'dob.required' => 'Date of birth enter kro',

            'age.required' => 'Age enter kro bhai',
            'age.min' => 'Age 18 sal se zyada hona chahiye, bache',

            'address.required' => 'Address to likhna padega',

            'pincode.required' => 'Pincode enter kro na',
            'pincode.digits' => 'Pincode exactly 6 digits ka hona chahiye',

            'course.required' => 'Course select kro bhai',

            'marks.required' => 'Marks enter kro',
            'marks.min' => 'Marks kam se kam 33 hone chahiye pass hone ke liye',
            'marks.max' => 'Marks 100 se zyada nahi ho sakte',

            'signature.required' => 'Apna signature upload kro',
            'signature.mimes' => 'Image/pdf file upload kro',
            'signature.max' => 'Image/pdf file 2 mb se jyada na ho',

            'password.required' => 'Password enter kro bhai',
            'password.min' => 'Password kam se kam 6 characters ka hona chahiye',

            'confpassword.required' => 'Confirm password enter kro',
            'confpassword.same' => 'Password aur Confirm Password match nahi ho rahe',

            'terms.required' => 'Terms and Conditions ko accept kro bhai'
        ];
    }

    public function attribute(){
        return[
            'name'=>'User Name',
            'email'=>'Email Address'
        ];
    }
}
