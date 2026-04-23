<div>
    <h2>Upload Form</h2>
    <form method="POST" action="/upload-form" enctype="multipart/form-data">
        @csrf 
        Select File: <br>
        <input type="file" name="file">
        <br><br>
        <button type="submit">Submit</button>
    </form>
</div>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@if(session('file'))
    <h3>Uploaded File:</h3>
    <img src="{{ asset('uploads/'.session('file')) }}" width="200">
@endif