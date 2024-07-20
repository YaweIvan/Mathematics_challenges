<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add School</title>

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="/assets/vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="/assets/vendor/quill/quill.bubble.css">
    <link rel="stylesheet" href="/assets/vendor/remixicon/remixicon.css">
    <link rel="stylesheet" href="/assets/vendor/simple-datatables/style.css">

    <!-- Template Main CSS File -->
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
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%; /* Adjusted to occupy 60% of the page */
            margin: auto;
            overflow: hidden;
            padding: 20px;
            text-align: right; /* Align content to the right */
        }
        .container h1 {
            text-align: center; /* Center align the heading */
            font-size: 24px; /* Adjusted font size */
            margin-bottom: 20px; /* Added margin for spacing */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 16px; /* Adjusted font size */
        }
        table th {
            background-color: #f2f2f2;
        }
        table tbody tr:hover {
            background-color: #f2f2f2;
            cursor: pointer;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: none;
            border-radius: 3px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
@include('components.navbar')
    @include('components.sidebar')
    <div class="container">
        <h1>Edit School</h1>
        <form action="{{ route('schools.update', $school->schoolRegistrationNumber) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="schoolRegistrationNumber">School Registration Number</label>
                <input type="text" id="schoolRegistrationNumber" name="schoolRegistrationNumber" value="{{ $school->schoolRegistrationNumber }}" readonly>
            </div>
            <div class="form-group">
                <label for="schoolName">School Name</label>
                <input type="text" id="schoolName" name="schoolName" value="{{ $school->schoolName }}" required>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" id="district" name="district" value="{{ $school->district }}" required>
            </div>
            <div class="form-group">
                <label for="repName">Representative Name</label>
                <input type="text" id="repName" name="repName" value="{{ $school->repName }}" required>
            </div>
            <div class="form-group">
                <label for="repEmail">Representative Email</label>
                <input type="email" id="repEmail" name="repEmail" value="{{ $school->repEmail }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update School</button>
        </form>
    </div>
</body>
</html>
