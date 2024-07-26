<!DOCTYPE html>
<html>
<head>
    <title>Participant Report</title>
</head>
<body>
    <h1>Participant Report for {{ $participant->firstName }} {{ $participant->lastName }}</h1>
    <table>
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Selected Answer</th>
                <th>Correct Answer</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attempts as $attempt)
            <tr>
                <td>{{ $attempt->Question_ID }}</td>
                <td>{{ $attempt->selected_answer }}</td>
                <td>{{ $attempt->correct_answer }}</td>
                <td>{{ $attempt->marks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
