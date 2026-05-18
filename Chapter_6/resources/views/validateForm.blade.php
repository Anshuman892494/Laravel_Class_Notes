<div>
    <h2>Simple Form</h2>
    <form method="POST" action="/submit-form">
        @csrf 
        Student Name: <input type="text" name="name" value="{{old('name')}}">
        
        <br>
        @error('name')
        <p >{{$message}}</p>
        @enderror
        <br>

        Email: <input type="email" name="email" value="{{old('email')}}">
        <br><br>
        Mobile Number: <input type="number" name="phone" value="{{old('phone')}}">
        <br><br>
        Alternate Mobile(optional): <input type="number" name="phone" value="{{old('phone')}}">
        <br><br>
        Gender: <input type="texy" name="gender" value="{{old('gender')}}">
        <br><br>
        Date Of Birth: <input type="date" name="dob" value="{{old('dob')}}">
        <br><br>
        Age: <input type="number" name="age" value="{{old('age')}}">
        <br><br>
        Address: <input type="text" name="address" value="{{old('address')}}">
        <br><br>
        Pincode: <input type="number" name="pincode" value="{{old('pincode')}}">
        <br><br>
        Course: <input type="text" name="course" value="{{old('course')}}">
        <br><br>
        Percentage/Marks: <input type="text" name="marks" value="{{old('marks')}}">
        <br><br>
        Signature: <input type="file" name="signature" value="{{old('signature')}}">
        <br><br>
        Password: <input type="password" name="password">
        <br><br>
        Confirm Password: <input type="password" name="confpassword">
        <br><br>
        Terms & Conditions: <input type="checkbox" name="terms">
        <br><br>
        <button type="submit">Submit</button>
    </form>
</div>

@if($errors->any())
<ul>
    @foreach($errors->all() as $err)
    <li>{{$err}}</li>
    @endforeach
</ul>
@endif
