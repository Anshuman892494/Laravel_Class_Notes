
@foreach($students as $student)
    <p>{{ $student['id'] }} - {{$student['name']}} - {{$student['age']}}</p>
@endforeach


