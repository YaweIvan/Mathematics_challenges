@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Challenge Reports</h1>
    <table>
        <thead>
            <tr>
                <th>Participant</th>
                <th>Question ID</th>
                <th>Selected Answer</th>
                <th>Correct Answer</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attempts as $attempt)
            <tr>
                <td>{{ $attempt->Username }}</td>
                <td>{{ $attempt->Question_ID }}</td>
                <td>{{ $attempt->selected_answer }}</td>
                <td>{{ $attempt->correct_answer }}</td>
                <td>{{ $attempt->marks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
