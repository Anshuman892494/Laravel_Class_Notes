<div>
    <h2>Simple Form</h2>
    <form method="POST" action="/submit-form">
        @csrf 
        Name: <input type="text" name="name" value="{{old('name')}}">
        <br><br>
        Email: <input type="email" name="email" value="{{old('email')}}">
        <br><br>
        <button type="submit">Submit</button>
    </form>
</div>
