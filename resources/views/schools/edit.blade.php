<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit School</title>

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
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: flex-end; /* Aligns the content to the right */
            align-items: center; /* Vertically centers the content */
            height: 100vh; /* Full viewport height */
            padding: 20px;
        }
        .content {
            width: 60%; /* Adjusted width of the content */
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            width: 30%; /* Adjust this width as needed */
            font-weight: bold;
            margin-right: 10px;
        }
        .form-group input {
            flex: 1; /* Takes up the remaining space */
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
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
@include('components.navbar')
@include('components.sidebar')
    <div class="container">
        <div class="content">
            <h1>Edit School</h1>
            <form action="{{ route('schools.update', $school->schoolRegistrationNumber) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="schoolRegistrationNumber">School Registration Number</label>
                    <input type="text" id="schoolRegistrationNumber" name="schoolRegistrationNumber" value="{{ $school->schoolRegistrationNumber }}" >
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
    </div>
</body>
</html>
