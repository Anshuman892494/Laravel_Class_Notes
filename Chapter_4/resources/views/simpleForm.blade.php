<div>
    <h2>Laravel Resource Example</h2>
    <p>यह form CRUD के लिए example है।</p>

    <h3>Create (POST)</h3>
    <form method="POST" action="{{ route('Anshu.store') }}">
        @csrf
        Name: <input type="text" name="name" value="{{ old('name') }}">
        <br><br>
        Email: <input type="email" name="email" value="{{ old('email') }}">
        <br><br>
        <button type="submit">Create</button>
    </form>

    <hr>

    <h3>Update with PUT</h3>
    <form method="POST" action="{{ route('Anshu.update', 1) }}">
        @csrf
        @method('PUT')
        Name: <input type="text" name="name" value="{{ old('name', 'Anshu Name') }}">
        <br><br>
        Email: <input type="email" name="email" value="{{ old('email', 'anshu@example.com') }}">
        <br><br>
        <button type="submit">Update (PUT)</button>
    </form>

    <hr>

    <h3>Update with PATCH</h3>
    <form method="POST" action="{{ route('Anshu.update', 1) }}">
        @csrf
        @method('PATCH')
        Name: <input type="text" name="name" value="{{ old('name', 'Partial Name') }}">
        <br><br>
        Email: <input type="email" name="email" value="{{ old('email', 'partial@example.com') }}">
        <br><br>
        <button type="submit">Update (PATCH)</button>
    </form>

    <hr>

    <h3>Delete with DELETE</h3>
    <form method="POST" action="{{ route('Anshu.destroy', 1) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    @if($errors->any())
    <div style="color:red; margin-top: 20px;">
        <strong>Validation Errors:</strong>
        <ul>
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
