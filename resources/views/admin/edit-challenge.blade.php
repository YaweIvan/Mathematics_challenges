<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Challenge</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #0061f2;
            border-color: #0061f2;
        }
        .btn-primary:hover {
            background-color: #004bbd;
            border-color: #004bbd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Challenge</h1>
        <form action="{{ route('admin.challenge.update', $challenge->challengeID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="openingDate">Opening Date</label>
                <input type="date" id="openingDate" name="openingDate" class="form-control" value="{{ $challenge->openingDate }}">
            </div>
            <div class="form-group">
                <label for="closingDate">Closing Date</label>
                <input type="date" id="closingDate" name="closingDate" class="form-control" value="{{ $challenge->closingDate }}">
            </div>
            <div class="form-group">
                <label for="number_of_questions">Number of Questions</label>
                <input type="number" id="number_of_questions" name="number_of_questions" class="form-control" value="{{ $challenge->number_of_questions }}">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
